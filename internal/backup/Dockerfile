FROM php:7.4-apache

COPY . /var/www/html/

RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/errors.ini

RUN chown -R www-data:www-data /var/www/html

EXPOSE 8000

RUN sed -i 's/80/8000/g' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:8000>/g' /etc/apache2/sites-available/000-default.conf
