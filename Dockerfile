FROM webdevops/php-nginx:8.2-alpine

WORKDIR /app
COPY . /app

RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

ENV WEB_DOCUMENT_ROOT=/app/public
ENV WEB_DOCUMENT_INDEX=index.php