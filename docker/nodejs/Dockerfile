FROM node:15.9.0-buster as node

WORKDIR /var/www/html

ADD ./docker-entrypoint.sh /tmp
ENTRYPOINT ["/tmp/docker-entrypoint.sh"]
CMD [ "/sbin/init" ]
