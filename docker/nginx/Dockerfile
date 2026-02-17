FROM nginx:1.27-alpine

WORKDIR /var/www

COPY public ./public
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
