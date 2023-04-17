FROM php:7.4-cli
COPY ./script.php /usr/src/app/script.php
CMD ["php", "/usr/src/app/script.php"]
