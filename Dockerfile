FROM php:7.0-cli
MAINTAINER team@fuelphp.com

# Make sure mbstring is installed, composer needs this
RUN docker-php-ext-install mbstring

# Make sure our files exist
RUN mkdir -p /fuel
WORKDIR /fuel
ADD . ./

# Set the default entry point so tests will run automatically
ENTRYPOINT ./vendor/bin/codecept run unit

