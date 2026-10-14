FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libaio-dev \
    && docker-php-ext-install sockets \
    && rm -rf /var/lib/apt/lists/*

COPY . .

EXPOSE 10000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t /app"]
