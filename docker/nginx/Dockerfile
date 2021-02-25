FROM nginx:1.19.6

LABEL maintainer="Satake Ryota <satake00157@gmail.com> \
    Hisashi SOGA=<sogaoh@ant-in-giant.work>" \
    description="htmlを閲覧するためのnginxのDockerfile"

# logフォルダとファイルを生成
RUN mkdir -p /var/www/log && \
    touch /var/www/log/access.log && \
    touch /var/www/log/error.log

WORKDIR /var/www/html
