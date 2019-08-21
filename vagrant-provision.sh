#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

# Update packages
sudo apt-get -y update
sudo apt-get -y upgrade

# Install MySQL
sudo -E apt-get -q -y install mysql-server
sudo mysql -e "
CREATE DATABASE spicy;
CREATE USER 'spicy'@'localhost' IDENTIFIED BY PASSWORD '*E08B761CB1BB7FB9B7B69288033942C1396B4D15';
GRANT ALL PRIVILEGES ON spicy.* TO 'spicy'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;"

# Install PHP
sudo apt-get -y install \
    php-bcmath \
    php-bz2 \
    php-cli \
    php-common \
    php-curl \
    php-dba \
    php-fpm \
    php-gettext \
    php-mbstring \
    php-mcrypt \
    php-mysql \
    php-soap \
    php-xml \
    php-zip

# Install Nginx
sudo apt-get -y install nginx
sudo ufw allow 'Nginx HTTP'

cat > /etc/nginx/sites-available/default << EOF
server {
    listen 80 default_server;
    listen [::]:80 default_server;

    root /var/www/html;
    index index.php index.html index.htm index.nginx-debian.html;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOF

sudo systemctl reload nginx

# Install composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer
php -r "unlink('composer-setup.php');"

