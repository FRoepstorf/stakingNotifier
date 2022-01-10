FROM bref/php-81 as base

CMD [ "index.php" ]

FROM base as prod

COPY . $LAMBDA_TASK_ROOT

FROM base as dev

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=bref/extra-xdebug-php-81 /opt /opt

RUN yum install -y git

FROM base as coverage

COPY --from=bref/extra-pcov-php-81 /opt /opt
