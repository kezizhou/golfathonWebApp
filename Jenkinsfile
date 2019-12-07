#!groovy

pipeline {
    agent any

    environment {
        IMAGE_LOCATION="kezizhou/golfathon-web-app"
        VERSION="1.0.0"
    }

    stages {
        stage('Docker Image Push') {
            options {
                timeout( time: 5, unit: "MINUTES")
            }
            when {
                // Push to docker branch
                beforeAgent true
                branch "docker"
            }
            steps {
                withCredentials([usernamePassword(credentialsID: 'DockerUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "docker login -u $USERNAME -p $PASSWORD"
                }
                sh "docker build -t $IMAGE_LOCATION:$VERSION"
                sh "docker push $IMAGE_LOCATION:$VERSION"
                sh "docker tag $IMAGE_LOCATION:$VERSION $IMAGE_LOCATION:latest"
                sh "docker push $IMAGE_LOCATION:latest"
            }
        }
        stage('Start Server') {
            options {
                timeout( time: 5, unit: "MINUTES")
            }
            when {
                // Push to docker branch
                beforeAgent true
                branch "docker"
            }
            steps {
                withCredentials([usernamePassword(credentialsID: 'DockerUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "docker login -u $USERNAME -p $PASSWORD"
                }
                sh "docker run –d –p 80:80 -p 443:443 $IMAGE_LOCATION"
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
    }
}