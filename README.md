# Descripcion

Pequeño tool para hacer debug, tanto en pantalla como en logfile.

## Instalacion

```
git clone git@github.com:cortadoverde/debug.git

cd debug 

composer dumpautoload

php -S localhost:8000

```

Navegar a la url http://localhost:8000


# Debug silencioso

En ocaciones necesitamos saber que valor tiene una variable, sin interrumpir en el contenido de nuestro sitio web. 
Es aca donde el log nos permite debuguear el contenido sin imprimir en pantalla.

```
<?php 

use App\Utils\Debug;

Debug::$log = true;
Debug::$log_file = 'log.log';
Debug::$active = false;

$json = file_get_contents('https://www.etnassoft.com/api/v1/get/?id=589');

Debug::print($json);

```

Esto va a guardar el contenido captura en la variable json y lo imprime en el log

si queremos observar el log, con el comando tailt -f podemos leer constantemente 
el archivo y tener un debug en tiempo real

![jsonDemo](/doc/img1.png)

