#
# Cookbook:: golfathonWebApp
# Recipe:: install
#
# Copyright:: 2019, Keziah Zhou, All Rights Reserved.

include_recipe 'phpInstall::default'

# Install Docker
docker_service 'default' do
    action [:create, :start]
end

execute 'Run Docker container' do
    command "docker run –d –p 8080:80 golfathonWebApp"
end