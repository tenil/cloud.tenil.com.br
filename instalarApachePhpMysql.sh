#!/bin/bash

############ SCRIPT PARA INSTALAR APACHE, PHP E MYSQL ############
# Roberto Tenil <roberto.tenil@gmail.com>                        #
# Created Feb, 2014                                              #
# Update Feb, 2014                                               #
##################################################################

# Atualizar Ubuntu
sudo apt-get update -y
sudo apt-get upgrade -y

# Instalar Apache
sudo apt-get install apache2 -y
sudo a2enmod rewrite

#Instalar PHP
sudo apt-get install php5 php5-cli php5-dev php5-mcrypt php5-curl php5-gd libapache2-mod-php5 -y
sudo apt-get install php5-json -y
sudo apt-get install php5-xdebug -y

# Instalar MySql Client only
sudo apt-get install mysql-client-5.5 php5-mysql -y

# Reiniciar o Serviço do Apache
sudo service apache2 restart
