FROM phpdockerio/php73-fpm
RUN apt-get update \
    && apt-get -y install php-xdebug \
    php7.3-sqlite3 \
    php7.3-pgsql \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && echo "zend_extension=/usr/lib/php/20160303/xdebug.so" > /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.idekey=docker" >> /etc/php/7.1/mods-available/xdebug.ini
ENV XDEBUG_CONFIG="remote_host=host.docker.internal remote_port=9000 remote_enable=1 idekey=artisan"
ARG user=master
RUN useradd -m $user || echo "User alredy exists!"
ENV USERPATH=/home/$user
RUN echo "root:Docker" | chpasswd
USER $user
RUN composer global require laravel/installer
USER 'root'
EXPOSE 8000
RUN mkdir /data
VOLUME /data
#USER $user
WORKDIR /data

