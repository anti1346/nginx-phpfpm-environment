# docker/php/Dockerfile
FROM php:8.3-fpm-alpine

# 1. 시스템 패키지 설치
RUN apk update && apk add --no-cache \
    # 기본 도구
    curl git unzip vim \
    # PHP 확장 의존성
    libpng-dev libjpeg-turbo-dev libwebp-dev freetype-dev \
    libxml2-dev oniguruma-dev libzip-dev postgresql-dev \
    # Redis 빌드 도구(일시적)
    autoconf g++ make

# 2. PHP 확장 설치
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install -j$(nproc) \
    pdo_mysql mbstring xml zip bcmath pcntl gd

# 3. Redis 확장 설치
RUN pecl install redis && docker-php-ext-enable redis

# 4. 빌드 도구 정리 (이미지 용량 최적화)
RUN apk del autoconf g++ make && \
    rm -rf /tmp/pear && \
    docker-php-source delete

# 5. Composer 설치
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. 작업 디렉토리 및 권한 설정
WORKDIR /var/www/html

# 7.권한 설정
RUN chmod -R 775 /var/www/html

# PHP-FPM 사용자 생성 및 권한 설정
#RUN chown -R www-data:www-data /var/www/html
#USER www-data

# 8. health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=30s --retries=3 \
    CMD curl -f http://localhost/ping || exit 1
