FROM xachman/cakephp3

RUN curl -sL https://deb.nodesource.com/setup_4.x | bash - && \
apt-get install -y nodejs


COPY ./composer.lock /var/www/
COPY ./composer.json /var/www/
COPY ./package.json /var/www/
WORKDIR /var/www
ARG COMPOSER_INSTALL
ARG NPM_INSTALL
RUN chown www-data:www-data -R ./; chmod 775 -R ./; 
USER www-data
RUN composer install ${COMPOSER_INSTALL}; npm install ${NPM_INSTALL}

COPY . /var/www/
USER root

RUN chown www-data:www-data -R ./; chmod 775 -R ./; 