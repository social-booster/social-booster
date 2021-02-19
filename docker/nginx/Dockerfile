FROM nginx:1.19.6

RUN mkdir -p /var/www/log && \
    touch /var/www/log/access.log && \
    touch /var/www/log/error.log

# nginx conf file deploy
RUN rm /etc/nginx/conf.d/default.conf
ADD ./social_booster.conf /etc/nginx/conf.d/social_booster.conf
