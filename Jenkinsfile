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
                timeout( time: 8, unit: "MINUTES")
            }
            when {
                // Push to docker branch
                // GitHub webook "Payload URL" format: http://<EC2 Public DNS>:8080/github-webhook/
                beforeAgent true
                branch "docker"
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
    }
}