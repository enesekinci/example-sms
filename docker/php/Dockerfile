# İmage tabanını belirleyin, örneğin resmi PHP-Apache imajı
FROM php:8.1-apache

# Gerekli bağımlılıkları kurun
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev zip git && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql


# composer use super user
ENV COMPOSER_ALLOW_SUPERUSER=1

# İş çalışma dizinini belirleyin
WORKDIR /var/www/html


# get composer from official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# set git global config
RUN git config --global user.name "Enes Ekinci"
RUN git config --global user.email "enes.eknc.96@gmail.com"

# Apache yapılandırmasını ayarlayın
COPY ./docker/apache/site.conf /etc/apache2/sites-available/000-default.conf

# Mod Rewrite'ı etkinleştirin ve Apache'yi başlatın
RUN a2enmod rewrite && service apache2 restart

# Docker içinde uygulamayı çalıştırın
CMD ["apache2-foreground"]
