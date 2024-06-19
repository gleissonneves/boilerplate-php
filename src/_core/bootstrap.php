<?php
/*
 * ------------------------------------------------------
 *  Should we use a Composer autoloader?
 * ------------------------------------------------------
 * 
 * Configurar php autoload aqui...
 */

if (file_exists(FCPATH . 'autoload.php'))
{
  require_once(FCPATH . 'autoload.php');
  Autoloader::register();
}



/** 
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
require_once('Common.php');


/*
 * ------------------------------------------------------
 *  LOAD ROUTES FUNCTIONS
 * ------------------------------------------------------
 * 
 */

require_once('http/Routes.php');
require_once(APPPATH . 'config/routes.php');

/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
/* set_error_handler('_error_handler');
set_exception_handler('_exception_handler');
register_shutdown_function('_shutdown_handler'); */

