# Use a lightweight, modern PHP base image with FPM
# FPM (FastCGI Process Manager) is used to process PHP requests,
# which are proxied by a web server like Nginx.
FROM php:8.2-fpm-alpine

# Set the working directory inside the container
WORKDIR /var/www/html

# Install required system dependencies (e.g., git, required for some extensions)
# and common PHP extensions.
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    libpq-dev \
    mysql-client \
    git \
    openssl

# Install essential PHP extensions for a typical application
RUN docker-php-ext-install pdo pdo_mysql mysqli opcache

# Copy the application source code into the container's web root
# The assumption is that the Dockerfile is in the root of the dmonv project.
COPY . /var/www/html

# Adjust permissions for the web root (important for Alpine/FPM)
# The user:group 82:82 is common for www-data on Debian/Alpine
RUN chown -R www-data:www-data /var/www/html

# Expose the FPM port
EXPOSE 9000

# The default entrypoint for php-fpm base images usually starts the FPM server.
# No CMD needed here unless customization is required.
