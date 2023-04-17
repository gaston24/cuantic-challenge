# cuantic-challenge
Cuantic challenge - php docker up

Crear un directorio y dentro 3 files (Dockerfile, docker-compose.yml y script.php)


1 --
Dockerfile
El archivo Dockerfile es utilizado para definir la configuración del contenedor que se creará a partir de él. En este caso, crearemos un archivo llamado Dockerfile en una carpeta llamada php-setup, y en él agregaremos lo siguiente:

/*
FROM php:7.4-cli
COPY ./script.php /usr/src/app/script.php
CMD ["php", "/usr/src/app/script.php"]
*/

Este archivo utiliza la imagen oficial de PHP 7.4 CLI como base. Luego, copia un archivo llamado script.php a la carpeta /usr/src/app dentro del contenedor. Por último, se configura el contenedor para ejecutar el archivo script.php al iniciarse.


2--

docker-compose.yml
El archivo docker-compose.yml se utiliza para definir la configuración de varios contenedores y sus interacciones. En este caso, crearemos un archivo llamado docker-compose.yml en la carpeta php-setup y agregaremos lo siguiente:

/*
version: "3"
services:
  php:
    build: .
    volumes:
      - ./script.php:/usr/src/app/script.php
*/

Este archivo define un servicio llamado php que se construirá utilizando el Dockerfile que se encuentra en la carpeta actual. Además, se agrega un volumen que mapea el archivo script.php desde el host al contenedor.


3--

Script de prueba
Para comprobar que nuestro contenedor funciona correctamente, crearemos un archivo llamado script.php en la carpeta php-setup con el siguiente contenido:

/*
<?php
echo "La fecha actual es: " . date('Y-m-d H:i:s') . "\n";
*/

Este archivo simplemente muestra la fecha actual al ejecutarse.


4--

Levantando el contenedor
Para levantar el contenedor, simplemente necesitamos navegar a la carpeta php-setup y ejecutar el siguiente comando:

/*
docker-compose up
*/

Esto construirá la imagen del contenedor y lo iniciará. Al iniciarse, ejecutará el archivo script.php y mostrará la fecha actual.


5--

para chequearlo por consola, se puede utilizar el comando:

/*
docker logs --tail 1000 -f <id-del-contenedor>
*/