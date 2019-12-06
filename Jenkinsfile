#!groovy

pipeline {
    // No default agent
    agent none

    environment {
        IMAGE_REPOSITORY="kezizhou"
        IMAGE_NAME="golfathon-web-app"
        VERSION="1.0.0"
    }

    stages {
        stage('Build') {
            agent {
                dockerfile {
                    filename "Dockerfile"
                }
            }
            options {
                timeout(time: 5, unit: "MINUTES")
            }
            when {
                beforeAgent true
                anyof {
                    // Push to master
                    branch "master"
                    // Pull request to master
                    // changeRequest target: "master"
                }
            }
            steps {
                echo 'Building..'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('S3 Push') {
            agent any
            options {
                timeout( time: 5, unit: "MINUTES")
            }
            when {
                // Push to master
                beforeAgent true
                branch "master"
            }
            steps {
                withCredentials([usernamePassword(credentialsID: 'AWSUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "aws s3 cp s3:://golfathon-web-app-dev/ /var/www/html --recursive"
                }
            }
        }
        stage('Docker Image Push') {
            agent any
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