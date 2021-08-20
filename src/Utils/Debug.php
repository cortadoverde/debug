<?php

namespace App\Utils;

class Debug
{
  
  // Output que se va definiendo en cada llamada del print
  public static $output = '';
  
  // Indica si se imprime el debug en la ejecucion
  public static $active = 1;
  // Frena la ejecucion con die despues de una llamada al metodo
  public static $die = 0;
  // Guarda el log en un archivo   
  public static $log = 1;
  // Limpia el archivo log antes de escribir, solo queda visible la ultima llamada que se haga en el runtime de la app
  public static $clean = 0;
  
  // Directorio las constantes PATH_ROOT es el directorio Root del proyecto, DS es una abreviacion de directory_separator
  // para tener compatibilidad con sistemas de archivos linux y windows   
  public static $log_file = PATH_ROOT . DS . 'log' . DS . 'debug.log';
  
  /**
    * Metodo estatico que recorre los argumentos recibidos
    * y muestra el backtrace de la llamada para idenficar en donde se pidio el debug 
   */
  public static function print()
  {
    $args = func_get_args();
    $dbt  = debug_backtrace();
    
    self::$output = '<pre>';
    // Capturar el clousure imprimiendo los argumentos que recibe el metodo 
    self::$output.= self::obContent( function() use ($args) {
      foreach( $args AS $debug_item ) {
        echo "\n".PHP_EOL;
        echo "(".gettype($debug_item).")";
        echo "\n".PHP_EOL;
        echo "\n".PHP_EOL;
        print_r($debug_item);
        echo "\n".PHP_EOL;
      }
    });
    
    // Captura el clousure imprimiendo el backtrace de la llamada del metodo identificando donde lo llamamos
    self::$output.= self::obContent( function() use ($dbt) {
      echo "Backtrace:\n".PHP_EOL;
      echo "==============";
      foreach( $dbt AS $n => $dbt_item ) {
        // 0 
        echo "\n".PHP_EOL;
        echo "[{$n}] " . str_replace(PATH_ROOT, '', $dbt_item['file']) . "::{$dbt_item['line']}";
        echo " ( {$dbt_item['class']}{$dbt_item['type']}{$dbt_item['function']} )";
          
      }
    });
    
    self::$output .= '</pre>'.PHP_EOL;
    
    if( self::$active ) echo self::$output;
    if( self::$clean ) self::cleanLog();
    if( self::$log ) self::logOutput();
    if( self::$die ) die;
    
  }
  
  /**
   * Captura el contenido que suceda dentro del bloque ob_star y ob_get_clean,
   * @callback callback
   *  function() {
   *   echo 'Hola Mundo';
   *  }
   *  
   */
  public static function obContent( $callback )
  {
    ob_start();
    $callback();
    return ob_get_clean();
  }
  
  /**
   * Guarda el log en un archivo 
   */
  public static function logOutput()
  {
    file_put_contents(self::$log_file, self::$output, FILE_APPEND);
  }
  
  /*
   * Cuando esta este el flag clean 
   * trunca el archivo 
   */
  public static function cleanLog()
  {
    file_put_contents(self::$log_file, null);  
  }
  
}