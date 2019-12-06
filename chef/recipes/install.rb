#
# Cookbook:: golfathonWebApp
# Recipe:: install
#
# Copyright:: 2019, Keziah Zhou, All Rights Reserved.

include_recipe 'phpInstall::default'

execute 'Run Docker container' do
    command "docker run –d –p 80:80 golfathonWebApp"
end