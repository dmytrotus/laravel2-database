FROM nginx

ADD conf/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/project2-database