#
# Cookbook:: golfathonWebApp
# Recipe:: install
#
# Copyright:: 2019, Keziah Zhou, All Rights Reserved.

# Uses another cookbook to install PHP and Apache
include_recipe 'phpInstall::default'

execute 'Get files from S3' do
    command "aws s3 cp s3:://golfathon-web-app-dev/ #{node['phpInstall']['htmlRootDir'l} --recursive"
    not_if { ::File.exist?("#{node['phpInstall']['htmlRootDir'l}/default_site") }
end