FROM php:7.3-apache

RUN apt-get update && apt-get install -y ssmtp
RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libzip-dev

ADD ./httpd/httpd.conf /etc/apache2/apache2.conf
ADD ./php/php.ini /usr/local/etc/php/php.ini

RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=mr.andrey.sd@gmail.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=89501209653a" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
#apt-get install javascript-common
RUN a2enmod rewrite

RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
    --enable-gd-native-ttf
RUN docker-php-ext-install pdo pdo_mysql gd