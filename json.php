<?php 

include_once 'vendor/autoload.php';

use App\Utils\Debug;

Debug::$log = true;
Debug::$log_file = 'log.log';
Debug::$active = false;

$json = file_get_contents('https://www.etnassoft.com/api/v1/get/?id=589');

Debug::print($json);

 ?>