FROM phpmyadmin:5.2

COPY config.user.inc.php /etc/phpmyadmin/config.user.inc.php

# Add volume for sessions to allow session persistence
VOLUME /sessions

# We expose phpMyAdmin on port 80
EXPOSE 80