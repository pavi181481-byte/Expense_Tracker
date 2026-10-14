FROM php:8.4-cli-alpine

WORKDIR /app

RUN docker-php-ext-install sockets

COPY . .

EXPOSE 10000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t /app"]
