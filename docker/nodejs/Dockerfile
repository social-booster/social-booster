FROM node:15.8.0-alpine3.10 as node

RUN apt update

WORKDIR /work/public/

ADD . .

RUN npm install
