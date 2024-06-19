<?php

if (!function_exists('load_class'))
{
  function &load_class($class, $directory = 'application', $param = NULL)
  {
    $name = FALSE;
    $location_path_for_find = array(APPPATH, BASEPATH);

    static $_classes = array();

    if (isset($_classes[$class])) {
			return $_classes[$class];
		}

    foreach ($location_path_for_find as $path) {
			if (file_exists($path . $directory.'/'.$class.'.php')) {
				$name = $class . '.php';

				if (class_exists($name, FALSE) === FALSE) {
					require_once($path.$directory.'/'. $name);
				}

				break;
			}
		}

    if ($name === FALSE) {
      set_status_header(503);
      echo 'Unable to locate the specified class: '.$class.'.php';
      exit();
    }


    is_loaded($class);

		$_classes[$class] = isset($param) ? new $class($param): new $class();

		return $_classes[$class];
  }
}

// --------------------------------------------------------------------

if (!function_exists('is_loaded'))
{
	/**
	 * Keeps track of which libraries have been loaded. This function is
	 * called by the load_class() function above
	 *
	 * @param	string
	 * @return	array
	 */
	function &is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class !== '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}
}

// --------------------------------------------------------------------

if (!function_exists('assets'))
{
	function assets($resource, $path = 'assets')
	{

    $server_path = APPPATH . 'assets\\' . $resource;
    $public_url = APP_URL . 'src\assets\\' . $resource;
    
    if($path !== 'assets') {
      $server_path = APPPATH . $path . $resource;
      $public_url = APP_URL . 'src\\' . $path . $resource;
    }

    if (file_exists($server_path)) {
      return $public_url;
    } 
		

    $_error =& load_class('Exceptions', '_core/http');
    echo $_error->show_error(
      'Error', 
      "O arquivo " . $public_url . " não existe", 
      'error_general', 
      404
    );
    exit();
	}
}


require_once('Log.php');

/* HTTP functions genericas */
require_once('http/Exceptions.php');
require_once('http/Http.php');
