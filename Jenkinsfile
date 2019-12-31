#!groovy

pipeline {
    agent any

    environment {
        IMAGE_LOCATION="kezizhou/golfathon-web-app"
        EC2_DNS="ec2-54-86-40-176.compute-1.amazonaws.com"
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
                branch "docker"
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
                    // Create Docker swarm
                    // If already exists, exit 0
                    sh "ssh -o StrictHostKeyChecking=no -l ec2-user $EC2_DNS -a 'docker swarm init' || exit 0"
                    // Create Docker secrets
                    // If already exists, exit 0
                    withCredentials([string(credentialsId: 'golfathonMySQLServerName', variable: 'mySQLServerName')]) {
                        sh "ssh -o StrictHostKeyChecking=no -l ec2-user $EC2_DNS -a 'echo $mySQLServerName | docker secret create mySQLServerName' - || exit 0"
                    }
                    withCredentials([usernamePassword(credentialsId: 'golfathonMySQLUser', usernameVariable: 'mySQLUsername', passwordVariable: 'mySQLPassword')]) {
                        sh "ssh -o StrictHostKeyChecking=no -l ec2-user $EC2_DNS -a 'echo $mySQLUsername | docker secret create mySQLUsername' - || exit 0"
                        sh "ssh -o StrictHostKeyChecking=no -l ec2-user $EC2_DNS -a 'echo $mySQLPassword | docker secret create mySQLPassword' - || exit 0"
                    }
                    withCredentials([string(credentialsId: 'golfathonMySQLDBName', variable: 'mySQLDBName')]) {
                        sh "ssh -o StrictHostKeyChecking=no -l ec2-user $EC2_DNS -a 'echo $mySQLDBName | docker secret create mySQLDBName' - || exit 0"
                    }
                    // Build and deploy from Docker Compose file
                    sh "scp docker-compose.yml ec2-user@$EC2_DNS:/home/ec2-user"
                    sh "scp -r root/ ec2-user@$EC2_DNS:/home/ec2-user/golfathon/"
                    sh "ssh -o StrictHostKeyChecking=no -l ec2-user $EC2_DNS -a 'docker stack deploy -c docker-compose.yml golfathon-web-app'"
                }
            }
        }
    }
}