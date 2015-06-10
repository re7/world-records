#!/bin/sh

# Re-set proper permissions
chown -R www-data app/cache
chown -R www-data app/logs

# Start the php5-fpm daemon
service php5-fpm start

# Start the nginx service (in foreground)
service nginx start
