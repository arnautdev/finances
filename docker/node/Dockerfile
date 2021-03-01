FROM node:14

WORKDIR /var/www/html/

RUN npm cache verify \
    && npm install -g npm \
    && npm start \
    && npm install \
    && npm run watch
