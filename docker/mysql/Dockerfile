FROM mysql:5.7.27

ADD my.cnf /etc/my.cnf

RUN apt-get update
RUN apt-get install -y tzdata

RUN rm /etc/localtime && \
    echo Asia/Tokyo > /etc/timezone \
    dpkg-reconfigure -f noninteractive tzdata
