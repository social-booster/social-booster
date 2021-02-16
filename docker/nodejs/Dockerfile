FROM node:15.8.0-alpine3.10 as node

RUN apt update

WORKDIR /var/www/html

ADD /package.json ./
ADD /package-lock.json ./

RUN npm install
