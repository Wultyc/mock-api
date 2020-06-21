# Base image
FROM ubuntu:latest

# Update DNS server
RUN echo "nameserver 1.1.1.1" > /etc/resolv.conf
RUN echo "nameserver 1.0.0.1" >> /etc/resolv.conf

# Set timezone
RUN ln -fs /usr/share/zoneinfo/Europe/Lisbon /etc/localtime

# Install required software /bin/bash -c 
RUN apt-get update; \
    apt-get install apache2 mariadb-server php libapache2-mod-php php-mysql php-bcmath php-ctype php-mbstring php-json php-tokenizer php-xml composer -y;\
    rm -rf /var/www/*; \
    git clone https://github.com/Wultyc/mock-api.git /var/www/mockapi

# Configure httpd server
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY apache2.conf /etc/apache2/apache2.conf
RUN a2enmod rewrite; chown -R www-data:www-data /var/www; /etc/init.d/apache2 restart

# Create database and change MariaDB server settings
RUN /etc/init.d/mysql restart; mysql -uroot --execute="ALTER USER 'root'@'localhost' IDENTIFIED BY 'mock-api-pw';";  mysql -uroot "-pmock-api-pw" --execute="CREATE DATABASE mockapi;"

# Copy the .env file
COPY .env /var/www/mockapi/.env

# Install app dependencies
RUN /etc/init.d/mysql restart; cd /var/www/mockapi; composer install; php artisan key:generate; php artisan migrate:fresh

#expose ports on host
EXPOSE 8080:80

ENTRYPOINT /etc/init.d/mysql start; /etc/init.d/apache2 start; bash