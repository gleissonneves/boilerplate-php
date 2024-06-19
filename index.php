<?php
date_default_timezone_set("America/Sao_paulo");

if (!function_exists('normalize_path')) {
  /**
   * Normaliza um caminho de diretório.
   *
   * @param string $path O caminho do diretório a ser normalizado.
   * @param bool $add_separator Se verdadeiro, adiciona um DIRECTORY_SEPARATOR ao final do caminho.
   * @return string O caminho normalizado.
   */
  function normalize_path($path, $add_separator = false) {
    if (($_temp = realpath($path)) !== false) {
        $path = $_temp;
    } else {
        $path = strtr(
            rtrim($path, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        );
    }

    if ($add_separator) {
        $path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR;
    }

    return $path;
  }
}


define('APP_URL', 'http://127.0.0.1:8001/');


define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));


/* LOCAL, HOMOLOG, PROD */
define('ENVIRONMENT', 'LOCAL');


/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */
switch (ENVIRONMENT) {
  case 'LOCAL':
    error_reporting(E_ALL & ~E_DEPRECATED);
    ini_set('error_reporting', E_ALL);
    break;

  case 'HOMOLOG':
  case 'PROD':
    ini_set('display_errors', 0);
    if (version_compare(PHP_VERSION, '5.3', '>=')) {
      error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
    } else {
      error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
    }
    break;

  default:
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'The application environment is not set correctly.';
    exit(1); // EXIT_ERROR
}


/**
 *------------------------------------------------------------------ 
 * Caminho para o diretório do front controller (este arquivo) 
 *------------------------------------------------------------------
 */
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);


/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 * O caminho para o diretório do "aplicativo"
 */
$application_folder = 'src';

if (is_dir($application_folder)) {
  $application_folder = normalize_path($application_folder);
} elseif (is_dir($application_folder . DIRECTORY_SEPARATOR)) {
  $application_folder = normalize_path($application_folder . DIRECTORY_SEPARATOR);
} else {
  header('HTTP/1.1 503 Service Unavailable.', true, 503);
  echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
  exit(3);
}
define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);


/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * Esta variável deve contem recursos gerais que em si, não faz parte do sistema.
 * Contúdo, faz parte das configurações gerais do sistema.
 */;
$system_path = normalize_path(
  $system_path = $application_folder . DIRECTORY_SEPARATOR . '_core', 
  true
);

if (!is_dir($system_path)) {
  header('HTTP/1.1 503 Service Unavailable.', true, 503);
  echo 'Sua instalação está incompleta, por favor instale as dependências utilizando o composer. A pasta system não foi localizada.';
  exit(3); // EXIT_CONFIG
}
define('BASEPATH', $system_path);


/*
*---------------------------------------------------------------
* APPLICATION DIRECTORY VIEWS
*---------------------------------------------------------------
*/
if (!isset($view_folder[0]) && is_dir(APPPATH . 'views' . DIRECTORY_SEPARATOR)) {
  $view_folder = APPPATH . 'views';
} elseif (is_dir($view_folder)) {
  $view_folder = normalize_path($view_folder);
} elseif (is_dir(APPPATH . $view_folder . DIRECTORY_SEPARATOR)) {
  $view_folder = normalize_path(APPPATH . $view_folder . DIRECTORY_SEPARATOR);
} else {
  header('HTTP/1.1 503 Service Unavailable.', true, 503);
  echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
  exit(3);
}
define('VIEWPATH', $view_folder . DIRECTORY_SEPARATOR);


/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 */
require_once './src/_core/bootstrap.php';
