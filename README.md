# Navi

Proyecto para la facultad de Nutrición

## Instalación de requisitos
Si ya cuentes con MariDB, composer y PHP, o lo estás utilizando con XAMPP o similar,
omite esto y ve a la siguiente sección.
### Windows
Para instalar los programas, para todos los casos se debe de ir a los enlaces que proporcionan
las mismas páginas
#### MariaDB
Ir al siguiente enlace para descargar MariaDB
``https://mariadb.org/download/?t=mariadb&p=mariadb&r=11.4.2``
Se deben de seguir las instrucciones del instalador
#### PHP
Ir al siguiente enlace para descargar PHP
``https://windows.php.net/download#php-8.3``
Para este enlace, se debe de descargar el PHP Thread safe, descargar el zip
Este es el enlace para las plataformas x64:
``https://windows.php.net/downloads/releases/php-8.3.7-Win32-vs16-x64.zip``
Enlace para plataformas x86
``https://windows.php.net/downloads/releases/php-8.3.7-Win32-vs16-x86.zip``

#### nginx
Ir al siguiente enlace para descargar nginx
``https://nginx.org/download/nginx-1.26.1.zip``

Para poder instalarlo, se puede seguir el siguiente tutorial para tener la instalación
``https://www.youtube.com/watch?v=DKXdkXCgtCQ``

Una vez que se haya instalado nginx, se tiene que agregar el dominio en los dominios registrados de windows.
Para esto se debe de ir a la carpeta ``C:\System32\local\hosts``
Se debe de editar el archivo de hosts y poner la dirección de 127.0.0.1 y el nombre de host navi.local

Luego de configurar el host, se tiene que volver a configurar nginx, se tiene que agregar la configuración
del servidor
Ejemplo de configuración
```sh
server{
    listen 80;
    listen [::]:80;
    server_name navi.local www.navi.local;
    charset utf-8;

    client_max_body_size 75M;
    root /var/www/Navi/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    include /etc/nginx/default.d/*.conf;
    location / {
            try_files $uri $uri/ /index.php?$args /index.php?$query_string;
    }
}
```
En el ejemplo de arriba, utiliza la configuración que ya instala php-fpm al momento de instalarlo en Linux.

Otro ejemplo de configuración se puede encontrar en la documentación de Laravel:
`https://laravel.com/docs/11.x/deployment#nginx`

### Linux
Para la instalación en Linux es más sencillo, dependiendo de la distribución se usará el gestor de paquetes que trae por defecto, se mostrará el ejemplo para
fedora.
Para instalar MariaDB se tiene que ejecutar el siguiente comando, para MariaDB no pedirá una contraseña por defecto, pero se tienen que establecer
para el usuario root
#### MariaDB
```sh
sudo dnf install mariadb
```

#### PHP
Para instalar PHP, se tiene que ejecutar el siguiente comando:

```sh
sudo dnf install php
```

#### Nginx
Para instalar nginx, se tiene que ejecutar el siguiente comando
```sh
sudo dnf install nginx
```

Para poder configurar php con nginx, se tiene que instalar los siguiente
```sh
sudo dnf install php-fpm
```
Una vez que se ha instalado PHP-FPM, se tienen que configurar el servidor de Nginx, para esto se tiene que ir a la ruta de instalación que es
```sh
/etc/nginx/
```
Una vez en la ruta de instalación, se modifica el archivo `nginx.confg`, y se va agregará las siguientes lineas, sustituyendo 
el nombre del dominio por el de preferencia (tenga en cuenta que ese nombre de dominio lo tendrá que configurar en el archivo host)

```sh
server{
    listen 80;
    listen [::]:80;
    server_name navi.local www.navi.local;
    charset utf-8;

    client_max_body_size 75M;
    root /var/www/Navi/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    include /etc/nginx/default.d/*.conf;
    location / {
            try_files $uri $uri/ /index.php?$args /index.php?$query_string;
    }
}
```

Ahora se tiene que agregar el nombre de dominio en el archivo hosts, para eso puede usar el editor de texto que desee, en este caso se usará
nvim
```sh
sudo nvim /etc/hosts
```
Para que pueda funcionar la edición, tienen que ejecutar el editor como root, ya sea con sudo o accediendo al root

## Levantamiento de proyecto
Clona el proyecto en la carpeta que se definió en la configuración de nginx.
Una vez que se tenga todos los componentes listos, se tiene que hacer lo siguiente para la base de datos.

### Base de datos
Para configurar la base de datos en el proyecto, se debe de copiar y renombrar el archivo .env.example, y renombrarlo a .env, en este se tienen que sustituir las variables 
correspondientes.

- DB_CONNECTION=`mysql`
- DB_HOST=`127.0.0.1`
- DB_PORT=`3306`
- DB_DATABASE=`navi`
- DB_USERNAME=`root`
- DB_PASSWORD=`123456`

Estos son los datos para la base de datos

- user: `navi`
- password: `1>fCT)},dfVZ6Rbv9q*.`
- port: `3306`
- host: `localhost`

Para crear el usuario en la base de datos, en caso de que no esté creado, desde la terminal de mariadb o
desde un cliente SQL que esté conectado a la base de datos, ejecutar el siguiente comando (el usuario que debe de ejecutar esto debe de ser root o 
un usuario con suficientes privilegios para hacerlo).

```sh
CREATE USER 'navi'@localhost IDENTIFIED BY '1>fCT)},dfVZ6Rbv9q*.';
```

Luego, se debe de ejecutar el siguiente comando para conceder los privilegios al usuario que se
acaba de crear de hacer todas las operaciones dentro de la base de datos.

```sh
GRANT USAGE ON *.* TO 'navi'@localhost IDENTIFIED BY '1>fCT)},dfVZ6Rbv9q*.';
```

Se da acceso al usuario a la base de datos

```sh
GRANT ALL ON `navi`.* TO 'navi'@localhost;
```

Para aplicar los cambios que se han hecho, se tiene que ejecutar el siguiente comando

```sh 
FLUSH PRIVILEGES;
```


### Composer
Se puede instalar de manera local como también de manera global, para instalarlo con windows, es seguir
los pasos de su instalador

### NodeJS
Laravel utiliza npm, un administrador de paquetes de JavaScript, para instalarlo, se puede hacer instalando
NodeJS.

### En el proyecto
Una vez que se haya instalado todo y se tenga la configuración correcta, ahora se tiene que instalar todas las dependencias, para esto
se tiene que ejecutar los siguientes comando estando en la raíz del proyecto
```sh
composer install
npm install
php artisan optimize
php artisan config:cache
```

