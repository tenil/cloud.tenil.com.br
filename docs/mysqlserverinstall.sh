#!/bin/bash
echo debconf-set-selections | 'mysql-server mysql-server/root_password password root'
echo debconf-set-selections | 'mysql-server mysql-server/root_password_again password root'
apt-get -y install mysql-server
