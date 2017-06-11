Instrucciones de instalación en local
========================================

Para la instalación de la aplicación en local son necesarios una serie de requisitos:

*   php >= 7.0.0
*   PostgreSQL >= 9.5
*   composer
*   Servidor bien configurado, por ejemplo Apache2

Una vez cumplidos estos requisitos deberás realizar los siguientes pasos para llevar a cabo la instalación de la aplicación:

1.  Tener el Apache2 (u otro servidor) configurado con un nombre de dominio creado (por ejemplo: `animas.local`) y enlazado a `animas/web/`.

2.  Instalar `composer`.

3.  Realizar los siguientes comandos en consola:
```
git clone https://github.com/FedeFranco/animas.git
cd animas
composer install
composer run-script post-create-project-cmd
```

4.  Instalar *PostgreSQL* y ejecutar los siguientes comandos desde la raíz del proyecto:
```
cd db
./create.sh
./load.sh
```
> Después de realizar estos comandos se habrá creado una base de datos llamada `animas` con un usuario `animas` y contraseña `animas`.

5.  Cambiar la siguiente configuración dentro del proyecto:

    *   Correo electrónico:
        -   Cambiar el correo electrónico del administrador en `/config/params.php`.
        -   `SMTP_PASS`: crear esta variable de entorno para la contraseña del correo electrónico.
