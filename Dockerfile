FROM alphp/alphp:base

RUN mkdir /app \
    && cd /app \
    && wget https://github.com/composer/composer/releases/download/1.6.5/composer.phar \
    && mv composer.phar /usr/bin/composer \
    && export PATH="$PATH:~/.composer/vendor/bin" \
    && composer require toolkit/swagphp \
    && swagphp -V

WORKDIR /app