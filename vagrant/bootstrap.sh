#!/usr/bin/env bash

echo "########### System ########"
date > /etc/vagrant_provisioned_at
apt-get update
apt-get autoremove -y
apt-get upgrade -y
cd /vagrant/

echo "########### Install Apache ######"
apt-get install -y apache2


echo "########### Install PHP ######"
apt-get install -y php7.0 php7.0-cli php7.0-xml php7.0-zip
apt-get install -y libapache2-mod-php7.0

echo "########### Install Tools ######"
apt-get install -y unzip zip nodejs npm git

echo "########### Rewrite mod ########"
a2enmod php7.0
a2enmod rewrite

echo "########## [7/] - Install Composer ########"
php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
#php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '070854512ef404f16bac87071a6db9fd9721da1684cd4589b1196c3faf71b9a2682e2311b36a5079825e155ac7ce150d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php /tmp/composer-setup.php --install-dir=/usr/local/bin/ --filename=composer
php -r "unlink('/tmp/composer-setup.php');"
#composer create-project symfony/framework-standard-edition extranetv2 "3.*"

echo "########## Config ########"
npm cache clean -f
npm install -g n
source /etc/profile
n lts
npm cache clean -f
npm install -g npm
npm install typings -g
source /etc/profile
npm cache clean -f
npm install -g npm
cd /var/www && rm -rf html/ && ln -s /vagrant html
cp /vagrant/vagrant/000-default.conf /etc/apache2/sites-available/

cd /vagrant/
service apache2 restart
