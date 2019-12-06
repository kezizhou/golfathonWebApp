#!groovy

pipeline {
    agent any

    environment {
        IMAGE_REPOSITORY="kezizhou"
        IMAGE_NAME="golfathon-web-app"
        VERSION="1.0.0"
    }

    stages {
        stage('Docker Image Push') {
            options {
                timeout( time: 5, unit: "MINUTES")
            }
            when {
                // Push to master
                beforeAgent true
                branch "master"
            }
            steps {
                withCredentials([usernamePassword(credentialsID: 'DockerUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "docker login -u $USERNAME -p $PASSWORD"
                }
                sh "docker build -t $IMAGE_NAME:$VERSION"
                sh "docker push $IMAGE_NAME:$VERSION"
                sh "docker tag $IMAGE_NAME:$VERSION $_IMAGE_NAME:latest"
                sh "docker push $IMAGE_NAME:latest"
            }
        }
    }
}