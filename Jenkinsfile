#!groovy

pipeline {
    agent any

    stages {
        stage('Push to S3') {
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
                withCredentials([usernamePassword(credentialsID: 'AWSJenkinsUser', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh "aws s3 cp s3:://golfathon-web-app-dev/ /var/www/html --recursive"
                }
            }
        }
    }
}