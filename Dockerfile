FROM php:7.3.6-fpm

RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git php7.3-mysql/stable &&\
    rm -rf /var/lib/apt/lists/*

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
#RUN pecl install xdebug-2.7.2 && docker-php-ext-enable xdebug
#RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini
RUN echo 'extension=/usr/lib/php/20180731/pdo_mysql.so' >> /usr/local/etc/php/php.ini
