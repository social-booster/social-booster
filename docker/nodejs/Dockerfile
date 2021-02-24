FROM node:15.9.0-buster as node

LABEL maintainer="Satake Ryota <satake00157@gmail.com>"
LABEL description="vueをビルドするためnodejsのDockerfile"

WORKDIR /var/www/html

ADD ./docker-entrypoint.sh /tmp
ENTRYPOINT ["/tmp/docker-entrypoint.sh"]
CMD [ "/sbin/init" ]
