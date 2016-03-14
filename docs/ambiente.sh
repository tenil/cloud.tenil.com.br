#!/bin/bash

echo Atualizando Ubuntu
apt-get update -y
apt-get upgrade -y
echo Atualização finalizada

# Instalar Apache
echo Instalando o Apache 2
apt-get install apache2 -y
echo Habilitando o mod rewrite
a2enmod rewrite
echo Apache instalado

#Instalar PHP
echo Instalando PHP 5
apt-get install php5 php5-cli php5-dev php5-mcrypt php5-curl php5-gd libapache2-mod-php5 -y
apt-get install php5-json -y
apt-get install php5-xdebug -y
apt-get install php5-intl -y
echo PHP instalado

# Instalar MySql Client only
echo Instalando o MySQL 5.5 client
apt-get install mysql-client-5.5 php5-mysql -y
echo MySQL 5.5 client instalado

# Reiniciar o Serviço do Apache
echo Reiniciando Apache 2
service apache2 restart
echo Apache Renicia
echo Fim do script de instalação

