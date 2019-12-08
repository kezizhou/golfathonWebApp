#!groovy

pipeline {
    agent any

    stages {
        stage('Push to S3') {
            options {
                timeout( time: 5, unit: "MINUTES")
            }
            when {
                // Push to master
                beforeAgent true
                branch "dev"
            }
            steps {
                // withAWS(region: 'us-east-1', credentials: 'AWSJenkinsUser') {
                //     s3Upload(file: '/root/', bucket: 'golfathon-web-app-dev', path: '/')
                // }
                sh "ls -la"
            }
        }
    }
}