# golfathonWebApp
golfathonWebApp is a web application for a Golfathon Event. This application features enhancements that allow for increased security against XSS attacks, hashed password validation, and session timeout.

### AWS
This web app utilizes AWS for infrastructure and security. The "aws" folder contains CloudFormation templates used to setup this application. 

### Jenkins
The Jenkinsfiles allow for the automated build and push of images to Docker Hub, as well as pushing files to S3.

There are 2 methods that could be used to automate this application, which have been separated by Git branches:

### 1. Chef - "master" Branch
This branch contains a sample Chef cookbook that could be used to set up this web app. This becomes advantageous for larger applications, since this allows for better automation of the server install and setup. Even if the server is damaged, Chef can run the cookbook and bring the server back to the desired state.
In this method, the page can be viewed by going to the public DNS of the EC2 instance the server is running on. 
The Jenkinsfile in this branch pushes the PHP files from the repo to an S3 bucket.

!["master" Branch Diagram](documentation/diagrams/golfathonWebAppMaster.png)

### 2. Docker - "docker" Branch
This branch contains a Dockerfile that is used to build a Docker image of the application. This Dockerfile installs Apache, PHP, and MySQL, and starts the Apache web server. It copies the PHP scripts and files from the repo to the container. This image can then be pulled from Docker Hub to the server(s). 
In this method, the Docker container is exposed on ports 80 and 443, and the page can be viewed by going to http://localhost:80 or http://localhost:443.

!["docker" Branch Diagram](documentation/diagrams/golfathonWebAppDocker.png)

### Enhancements and Best Practices
This project started as a basic web app that allowed for user interaction to submit data to a MySQL database. Since then, some enhancements have been made to follow best practices and to add features:
* Best Practices:
    * HTML headers have been moved to the default_header.php and admin_header.php files to avoid redundancy in code.
    * The mySQLConnect() function was created.
    * A custom InvalidCredentialException class was created to allow for catching invalid login exceptions as a specific exception.
* Security:
    * Use of the password_verify() PHP function was added to allow for verification of hashed user passwords in the database.
    * The charConvert() function was created to guard against XSS attacks, and converts special characters to HTML entities anytime user input is output to the page.
* Enhancements:
    * A 60 minute session timeout was added to the admin page, which automatically redirects the user back to login.php along with a timeout message upon expiration. 

### Demonstration
Default Page:
!["Default Page Demo"](documentation/demos/defaultPageDemo.gif)

Admin Page:
!["Default Page Demo"](documentation/demos/adminPageDemo.gif)

Sample Login Timeout Page:
!["Login Timeout Screen"](documentation/demos/loginTimeout.png)

Responsive Design for Mobile:
!["Responsive Design for Mobile"](documentation/deos/responsiveMobile.png)