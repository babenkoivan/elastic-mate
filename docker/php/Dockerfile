ARG version

FROM php:${version}-cli

# Install system libraries
RUN apt-get update -y && apt-get install -y \
    unzip \
    zlib1g-dev \
    git

# Install Xdebug
RUN pecl install \
    xdebug

# Install php extensions
RUN docker-php-ext-install \
    zip

# Enable php extentions
RUN docker-php-ext-enable \
    xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin/ --filename=composer

# Set workdir
WORKDIR /app

# Install dependencies
CMD composer install --no-interaction --optimize-autoloader && php -a
