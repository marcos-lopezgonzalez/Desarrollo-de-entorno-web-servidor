# Pasos a seguir para construir la aplicación

## En la carpeta app utilizar

```bash
    composer init
    composer require *nombre del paquete*
    composer dump-autoload
```

## Configurar los parámetros para la conexión con la BBDD en config.json

```json
{
  "dbMotor": "mysql",
  "mysqlHost": "127.0.0.1",
  "mysqlUser": "root",
  "mysqlPassword": "",
  "mysqlDatabase": "todo_db"
}
```

## Para cada archivo en el que se vaya a usar una clase necesitaremos añadir el autoload.php

```php
require __DIR__ . "/../../vendor/autoload.php";
```
