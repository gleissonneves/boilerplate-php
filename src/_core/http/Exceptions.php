<?php

class Exceptions {

	/**
	 * Nesting level of the output buffering mechanism
	 *
	 * @var	int
	 */
	public $ob_level;

	/**
	 * List of available error levels
	 *
	 * @var	array
	 */
	public $levels = array(
		E_ERROR			=>	'Error',
		E_WARNING		=>	'Warning',
		E_PARSE			=>	'Parsing Error',
		E_NOTICE		=>	'Notice',
		E_CORE_ERROR		=>	'Core Error',
		E_CORE_WARNING		=>	'Core Warning',
		E_COMPILE_ERROR		=>	'Compile Error',
		E_COMPILE_WARNING	=>	'Compile Warning',
		E_USER_ERROR		=>	'User Error',
		E_USER_WARNING		=>	'User Warning',
		E_USER_NOTICE		=>	'User Notice',
		E_STRICT		=>	'Runtime Notice'
	);

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->ob_level = ob_get_level();
	}


	/**
	 * General Error Page
	 *
	 * Takes an error message as input (either as a string or an array)
	 * and displays it using the specified template.
	 *
	 * @param	string		$heading	Page heading
	 * @param	string|string[]	$message	Error message
	 * @param	string		$template	Template name
	 * @param 	int		$status_code	(default: 500)
	 *
	 * @return	string	Error page output
	 */
	public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
    $templates_path = BASEPATH. 'template' . DIRECTORY_SEPARATOR . 'errors' . DIRECTORY_SEPARATOR;

    set_status_header($status_code);
    $message = '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>';
		
    if (ob_get_level() > $this->ob_level + 1) {
			ob_end_flush();
		}
    
		ob_start();
      include($templates_path . $template . '.php');
      $buffer = ob_get_contents();
		ob_end_clean();
    
		return $buffer;		
	}
}
