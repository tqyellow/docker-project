FROM php:7.3.5-fpm

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y \
    g++ \
    libbz2-dev \
    libc-client-dev \
    libcurl4-gnutls-dev \
    libedit-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libkrb5-dev \
    libldap2-dev \
    libmagickwand-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libpq-dev \
    libsqlite3-dev \
    libssl-dev \
    libreadline-dev \
    libxslt1-dev \
    libzip-dev \
    memcached \
    wget \
    unzip \
    zlib1g-dev \
    && docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && docker-php-ext-install -j$(nproc) \
    bcmath \
    bz2 \
    calendar \
    exif \
    gettext \
    mysqli \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    soap \
    sockets \
    xmlrpc \
    xsl \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && pecl install memcached && docker-php-ext-enable memcached \
    && pecl install mongodb && docker-php-ext-enable mongodb \
    && pecl install redis && docker-php-ext-enable redis \
    && yes '' | pecl install imagick && docker-php-ext-enable imagick \
    && docker-php-source delete \
    && apt-get remove -y g++ wget \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* /var/tmp/*
	
# install oci
COPY ./var/instantclient-basic-linux.x64-11.2.0.4.0.zip \
     ./var/instantclient-sdk-linux.x64-11.2.0.4.0.zip \
     ./var/instantclient-sqlplus-linux.x64-11.2.0.4.0.zip /tmp/

ENV LD_LIBRARY_PATH /usr/local/instantclient

RUN apt-get update && apt-get install -y unzip zip libaio-dev && unzip -o /tmp/instantclient-basic-linux.x64-11.2.0.4.0.zip -d /usr/local/ \
     && unzip -o /tmp/instantclient-sdk-linux.x64-11.2.0.4.0.zip -d /usr/local/ \
     && unzip -o /tmp/instantclient-sqlplus-linux.x64-11.2.0.4.0.zip -d /usr/local/ \
     && ln -s /usr/local/instantclient_11_2 /usr/local/instantclient \
     && ln -s /usr/local/instantclient/libclntsh.so.11.1 /usr/local/instantclient/libclntsh.so \
     && ln -s /usr/local/instantclient/sqlplus /usr/bin/sqlplus \
     && echo 'export LD_LIBRARY_PATH="/usr/local/instantclient"' >> /root/.bashrc \
     && echo 'export ORACLE_HOME="/usr/local/instantclient"' >> /root/.bashrc \
     && echo 'umask 002' >> /root/.bashrc \
     && docker-php-ext-configure oci8 -with-oci8=instantclient,/usr/local/instantclient \
&& docker-php-ext-install oci8 