<?php 

// Autoload generado con composer
// $ composer dumpautoload
// toma la definicion para el PSR-4
include_once 'vendor/autoload.php';

use App\Utils\Debug;

Debug::$log_file = 'log.log';
Debug::$die = false;
Debug::$log = true;
Debug::$active = false;

Debug::print('hola mundo');
Debug::print(['key' => 'value'], new \stdClass, 1);

