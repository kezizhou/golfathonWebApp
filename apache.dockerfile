FROM httpd:2.4-alpine
# Starts Apache service by default

RUN apk update; \
    apk upgrade;
# Copy apache vhost file to proxy php requests to php-fpm container
COPY golfathonapache.conf /usr/local/apache2/conf/golfathonapache.conf
RUN echo "Include /usr/local/apache2/conf/golfathonapache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

EXPOSE 80