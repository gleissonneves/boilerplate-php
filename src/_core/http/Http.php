<?php

// ------------------------------------------------------------------------
if (!function_exists('set_status_header'))
{
	/**
	 * Set HTTP Status Header
	 *
	 * @param	int	the status code
	 * @param	string
	 * @return	void
	 */
	function set_status_header($code = 200, $text = '')
	{
		if (empty($code) || !is_numeric($code))
		{
			show_error('Status codes must be numeric', 500);
		}

		if (empty($text)) {
			is_int($code) OR $code = (int) $code;
			$state = array(
				100	=> 'Continue',
				101	=> 'Switching Protocols',

				200	=> 'OK',
				201	=> 'Created',
				202	=> 'Accepted',
				203	=> 'Non-Authoritative Information',
				204	=> 'No Content',
				205	=> 'Reset Content',
				206	=> 'Partial Content',

				300	=> 'Multiple Choices',
				301	=> 'Moved Permanently',
				302	=> 'Found',
				303	=> 'See Other',
				304	=> 'Not Modified',
				305	=> 'Use Proxy',
				307	=> 'Temporary Redirect',

				400	=> 'Bad Request',
				401	=> 'Unauthorized',
				402	=> 'Payment Required',
				403	=> 'Forbidden',
				404	=> 'Not Found',
				405	=> 'Method Not Allowed',
				406	=> 'Not Acceptable',
				407	=> 'Proxy Authentication Required',
				408	=> 'Request Timeout',
				409	=> 'Conflict',
				410	=> 'Gone',
				411	=> 'Length Required',
				412	=> 'Precondition Failed',
				413	=> 'Request Entity Too Large',
				414	=> 'Request-URI Too Long',
				415	=> 'Unsupported Media Type',
				416	=> 'Requested Range Not Satisfiable',
				417	=> 'Expectation Failed',
				422	=> 'Unprocessable Entity',
				426	=> 'Upgrade Required',
				428	=> 'Precondition Required',
				429	=> 'Too Many Requests',
				431	=> 'Request Header Fields Too Large',

				500	=> 'Internal Server Error',
				501	=> 'Not Implemented',
				502	=> 'Bad Gateway',
				503	=> 'Service Unavailable',
				504	=> 'Gateway Timeout',
				505	=> 'HTTP Version Not Supported',
				511	=> 'Network Authentication Required',
			);

			if (isset($state[$code])) {
				$text = $state[$code];
			} else {
				show_error('No status text available. Please check your status code number or supply your own message text.', 500);
			}
		}

		if (strpos(PHP_SAPI, 'cgi') === 0)
		{
			header('Status: '.$code.' '.$text, TRUE);
			return;
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2', 'HTTP/2.0'), TRUE))
			? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		header($server_protocol.' '.$code.' '.$text, TRUE, $code);
	}
}

// ------------------------------------------------------------------------
if (!function_exists('show_error'))
{
	/**
	 * Error Handler
	 *
	 * @param	string
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function show_error(string $message, int $status_code = 500, $heading = 'An Error Was Encountered')
	{
    $state = array(
      100, 101, 
      200, 201, 202, 203, 204, 205, 206, 
      300, 301, 302, 303, 304, 305, 307, 
      400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 422, 426, 428, 429, 431, 
      500, 501, 502, 503, 504, 505, 511 
    );

		$status_code = (int) $status_code;

    if (!in_array($status_code, $state)) {
      exit("O erro status code $status_code não faz parte do protocolo HTTP");
    }

    $_error =& load_class('Exceptions', '_core/http');
    echo $_error->show_error($heading, $message, 'error_general', $status_code);
	}
}

if (!function_exists('_GET')) {
  //Processa dados da requisição GET
  function _GET()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {    
      $sanitizedData = [];
      foreach ($_GET as $key => $value) {
          $sanitizedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
          $sanitizedData[$key] = $sanitizedValue;
      }
      return $sanitizedData;
    }

    return []; 
  }
}


// ------------------------------------------------------------------------
if (!function_exists('_POST')) {
//Processa dados da requisição _POST
  function _POST()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
      $sanitizedData = [];
      foreach ($_POST as $key => $value) {
          $sanitizedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
          $sanitizedData[$key] = $sanitizedValue;
      }
      return $sanitizedData;
    }

    return []; 
  }
}

// ------------------------------------------------------------------------
if (!function_exists('_PUT')) {
  //Processa dados da requisição DELETE
  function _PUT()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {    
      $data = [];
      parse_str(file_get_contents("php://input"), $data);
      return $data;
    }

    return []; 
  }
}

// ------------------------------------------------------------------------
if (!function_exists('_DELETE')) {
  //Processa dados da requisição DELETE
  function _DELETE()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {    
      $data = [];
      parse_str(file_get_contents("php://input"), $data);
      return $data;
    }

    return []; 
  }
}


// ------------------------------------------------------------------------
if (!function_exists('_get_request')) {
  //Obter e combinar dos dados de $_GET, $_POST, $_COOKIE, _PUT, _DELETE da requisição
  function _get_request()
  {
    return array_merge(_GET(), _POST(), $_COOKIE, _PUT(),_DELETE());
  }
}