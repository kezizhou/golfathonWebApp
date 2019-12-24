#!groovy

pipeline {
    agent any

    environment {
        IMAGE_LOCATION="kezizhou/golfathon-web-app"
    }

    stages {
        stage('Docker Image Push') {
            options {
                timeout( time: 5, unit: "MINUTES" )
            }
            when {
                // Push to "docker" branch
                // GitHub webook "Payload URL" format: http://<EC2 Public DNS>:8080/github-webhook/
                beforeAgent true
                branch "master"
            }
            steps {
                withCredentials([usernamePassword(credentialsId: 'DockerUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "docker login -u $USERNAME -p $PASSWORD"
                }
                // Build and push apache and php images to Docker Hub
                sh "docker build -t $IMAGE_LOCATION:apache -f apache.dockerfile ."
                sh "docker push $IMAGE_LOCATION:apache"
                sh "docker build -t $IMAGE_LOCATION:php -f php.dockerfile ."
                sh "docker push $IMAGE_LOCATION:php"
            }
            post {
                always {
                    // Clean images
                    sh "docker rmi $IMAGE_LOCATION:apache"
                    sh "docker rmi $IMAGE_LOCATION:php"
                    sh "docker image prune -f"
                }
            }
        }
        stage('Start Docker Server') {
            options {
                timeout( time: 5, unit: "MINUTES" )
            }
            when {
                // Push to "docker" branch
                beforeAgent true
                branch "docker"
            }
            steps {
                sshagent(['golfathonEC2SSH']) {
                    // 3 quotes required for multiline strings
                    sh """ssh -o StrictHostKeyChecking=no -l ec2-user ec2-3-91-38-255.compute-1.amazonaws.com -a <<EOF
                        whoami
                        docker swarm init
EOF"""
                    // Create Docker swarm
                    // If already exists, exit 0
                    sh "docker swarm init || exit 0"
                    // Create Docker secrets
                    // If already exists, exit 0
                    withCredentials([string(credentialsId: 'golfathonMySQLServerName', variable: 'mySQLServerName')]) {
                        sh "echo $mySQLServerName | docker secret create mySQLServerName - || exit 0"
                    }
                    withCredentials([usernamePassword(credentialsId: 'golfathonMySQLUser', usernameVariable: 'mySQLUsername', passwordVariable: 'mySQLPassword')]) {
                        sh "echo $mySQLUsername | docker secret create mySQLUsername - || exit 0"
                        sh "echo $mySQLPassword | docker secret create mySQLPassword - || exit 0"
                    }
                    withCredentials([string(credentialsId: 'golfathonMySQLDBName', variable: 'mySQLDBName')]) {
                        sh "echo $mySQLDBName | docker secret create mySQLDBName - || exit 0"
                    }
                    // Build and deploy from Docker Compose file
                    sh "docker stack deploy -c docker-compose.yml golfathon-web-app"
                }
            }
        }
    }
}