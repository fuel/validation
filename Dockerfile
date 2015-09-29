FROM php:7.0-cli
MAINTAINER team@fuelphp.com

# Make sure mbstring is installed, composer needs this
RUN docker-php-ext-install mbstring

# Make sure our files exist
WORKDIR /fuel

# Set the default entry point so tests will run automatically
ENTRYPOINT /fuel/vendor/bin/codecept run unit
