FROM nginx:1.19.6

LABEL maintainer="Satake Ryota <satake00157@gmail.com>"
LABEL description="htmlを閲覧するためのnginxのDockerfile"

# logフォルダとファイルを生成
RUN mkdir -p /var/www/log && \
    touch /var/www/log/access.log && \
    touch /var/www/log/error.log

# nginx conf file deploy
RUN rm /etc/nginx/conf.d/default.conf
ADD ./conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html/
