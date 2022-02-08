FROM nginx
ARG PROJECT_NAME=PROJECT_NAME

ADD docker/config/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/$PROJECT_NAME
