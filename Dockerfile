# A nginx webserver for the world record app
FROM debian:wheezy

MAINTAINER Emeric Kasbarian, emerick42@gmail.com

# Make sure the package repository is up to date
RUN apt-get update

# Install project dependencies
RUN apt-get install -y curl

# Install php and nginx
RUN apt-get install -y php5-cli php5-fpm php5-curl php5-mysql
RUN apt-get install -y nginx
RUN rm -v /etc/nginx/sites-enabled/default
ADD docker/nginx.conf /etc/nginx/sites-enabled/
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# Install the project
RUN mkdir -p /var/www/project
ADD . /var/www/project
WORKDIR /var/www/project

# Set permissions for cache and logs (should be done in a better way)
RUN rm -rf app/cache/* app/logs/*
RUN chown -R www-data app/cache
RUN chown -R www-data app/logs

# Setup the symfony project
RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install --optimize-autoloader
RUN php app/console cache:clear --env=prod --no-debug

RUN php app/console assetic:dump --env=prod --no-debug
RUN php app/console doctrine:migrations:migrate

# Add the start script
ADD docker/start.sh /
RUN chmod 755 /start.sh

EXPOSE 80

CMD /start.sh