#!groovy

pipeline {
    agent any

    environment {
        IMAGE_LOCATION="kezizhou/golfathon-web-app"
        VERSION="1.0.1"
    }

    stages {
        stage('Docker Image Push') {
            options {
                timeout( time: 10, unit: "MINUTES" )
            }
            when {
                // Push to docker branch
                // GitHub webook "Payload URL" format: http://<EC2 Public DNS>:8080/github-webhook/
                beforeAgent true
                branch "master"
            }
            steps {
                withCredentials([usernamePassword(credentialsId: 'DockerUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "docker login -u $USERNAME -p $PASSWORD"
                }
                sh "docker build -t $IMAGE_LOCATION:$VERSION ."
                sh "docker push $IMAGE_LOCATION:$VERSION"
                sh "docker tag $IMAGE_LOCATION:$VERSION $IMAGE_LOCATION:latest"
                sh "docker push $IMAGE_LOCATION:latest"
            }
            post {
                always {
                    // Clean images
                    sh "docker rmi $IMAGE_LOCATION:$VERSION"
                    sh "docker rmi $IMAGE_LOCATION:latest"
                    sh "docker image prune -f"
                }
            }
        }
        stage('Start Docker Server') {
            options {
                timeout( time: 5, unit: "MINUTES" )
            }
            when {
                // Push to docker branch
                beforeAgent true
                branch "docker"
            }
            steps {
                script {
                    try {
                        // If swarm does not exist
                        sh "docker swarm init"
                    }
                    catch( Exception e ) {
                        // Otherwise continue 
                        echo "This node is already part of a swarm."
                    }
                    try {
                        // If credentials do not exist
                        withCredentials([string(credentialsId: 'golfathonMySQLServerName', variable: 'mySQLServerName')]) {
                            sh "echo $mySQLServerName | docker secret create mySQLServerName -"
                        }
                        withCredentials([usernamePassword(credentialsId: 'golfathonMySQLUser', usernameVariable: 'mySQLUsername', passwordVariable: 'mySQLPassword')]) {
                            sh "echo $mySQLUsername | docker secret create mySQLUsername -"
                            sh "echo $mySQLPassword | docker secret create mySQLPassword -"
                        }
                        withCredentials([string(credentialsId: 'golfathonMySQLDBName', variable: 'mySQLDBName')]) {
                            sh "echo $mySQLDBName | docker secret create mySQLDBName -"
                        }
                    }
                    catch ( Exception e ) {
                        // Otherwise continue
                        echo "The secrets already exist."
                    }
                }
                sh "docker stack deploy -c docker-compose.yml golfathon-web-app"
            }
        }
    }
}