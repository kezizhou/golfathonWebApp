# golfathonWebApp
golfathonWebApp is a web application for a Golfathon Event. This application features enhancements that allow for increased security against XSS attacks, hashed password validation, and session timeout.

### AWS
This web app utilizes AWS for infrastructure and security. The "aws" folder contains CloudFormation templates used to setup this application. 

### Jenkins
The Jenkinsfile allows for the automated build and push of images to Docker Hub, as well as pushing files to S3.

There are 2 methods that could be used to automate this application:

### 1. Docker
This repo contains a Dockerfile that is used to build a Docker image of the application. This image can then be pulled from Docker Hub to the server(s). 

### 2. Chef
This repo contains a sample Chef cookbook that could be ued to setup this web app. This becomes advantageous for larger applications, since this allows for better automation of the server install and setup. Even if the server is damaged, Chef can run the cookbook and bring the server back to the desired state.