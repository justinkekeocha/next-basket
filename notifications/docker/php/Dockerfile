#https://github.com/emad-zaamout/laravel-docker-aws-deployment-course-start/blob/main/Dockerfile

# Used for production build.
FROM php:8.3-fpm

# Install dependencies.
RUN apt-get update && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev nginx libonig-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#Mine

# Install PHP extensions.
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath curl opcache mbstring


###########################################################################
# Composer:
###########################################################################

# Copy composer executable.
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Create the directory for composer cache
RUN mkdir -p /var/www/.composer/cache/repo/https---repo.packagist.org/
RUN chown -R www-data:www-data /var/www/.composer/cache/repo/https---repo.packagist.org/

###########################################################################
# Opcache:
###########################################################################

# Keep this here so that the change of argument APP_ENV value does not cause a reinstall of extensions image layer, since it is below that layer.
ARG APP_ENV=local

# TODO
# Reset opcache after code is pushed
# https://php.net/manual/en/function.opcache-reset.php
# https://www.php.net/manual/fr/opcache.configuration.php#ini.opcache.validate-timestamps

# Copy configuration files.
COPY php.ini /usr/local/etc/php/php.ini
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY *.ini /usr/local/etc/php/temp/

# Check if APP_ENV is set to production and set opposite values for environment variables
# Adjust ini configration based on APP_ENV
RUN if [ "$APP_ENV" = "production" ]; then \
    # echo adds a new line in file before appending contents.
    { echo; cat /usr/local/etc/php/temp/php-production.ini; } >> /usr/local/etc/php/php.ini; \
    else \
    # echo adds a new line in file before appending contents.
    { echo; cat /usr/local/etc/php/temp/php-development.ini; } >> /usr/local/etc/php/php.ini; \
    fi \
    && rm -rf /usr/local/etc/php/temp



###########################################################################
# Application:
###########################################################################


# Set working directory to /var/www/html.
WORKDIR /var/www/html

# Copy existing application directory contents into the working directory
COPY . .

# Copy existing application directory permissions
COPY --chown=www-data:www-data . .
# #https://stackoverflow.com/a/50553093/9780071
# RUN chown -R www-data:www-data *

# Adjust user permission & group
RUN usermod --uid 1000 www-data
RUN groupmod --gid 1001 www-data

# Change current user to www-data
USER www-data

#Start php-fpm server
#Since we are starting php-fpm in entrypoint file, we can then comment this out
CMD ["php-fpm"]

# Expose port 9000
#Port 9000 is for fpm upstream
EXPOSE 9000