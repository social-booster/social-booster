FROM nginx:1.19.6

ENV TZ=Asia/Tokyo

RUN mkdir -p /var/www/log && \
    touch /var/www/log/access.log && \
    touch /var/www/log/error.log

# nginx config file
ADD ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /work/public/
