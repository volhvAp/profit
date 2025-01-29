FROM php:8.2-fpm

ENV PHP_EXTENSIONS \
    mbstring \
    pdo \
    pdo_mysql \
    dom \
    intl \
    json \
    tokenizer \
    xsl \
    zip \
    pcntl \
    bcmath \
    sockets \
    gd

RUN curl -s \
    https://api.github.com/repos/mlocati/docker-php-extension-installer/releases/latest | \
    grep browser_download_url | \
    grep -oE 'https://.*[^"]' | \
    xargs curl -sL --output /usr/local/bin/install-php-extensions &&\
    chmod +x /usr/local/bin/install-php-extensions

RUN set -x &&\
    install-php-extensions ${PHP_EXTENSIONS}

RUN curl -sS https://getcomposer.org/installer > composer-setup.php &&\
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

COPY . /app

RUN install-php-extensions https://github.com/xdebug/xdebug/archive/refs/tags/3.2.0.tar.gz &&\
    docker-php-ext-enable xdebug
ENV PHP_IDE_CONFIG 'serverName=profit.local'
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
    echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
    echo "xdebug.client_host=docker.for.mac.localhost" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
    echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
    echo "xdebug.log=/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
    echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /app

EXPOSE 9000
CMD ["php-fpm"]