<?php

use src\_core\template\TemplateEngine;

if (!function_exists('view')) {
  function view($template, $data = array(), $templateDir = 'views')
  {
    $path = APPPATH . $templateDir . '/' . $template . '.php';
    if (!file_exists($path)) {
      throw new Exception("Template file not found: $path");
    }

    extract($data);
    include($path);

    if (isset($template)) {
      $extendedPath = 'src/' . $templateDir . '/' . $template . '.php';

      if (!file_exists($extendedPath)) {
        throw new Exception("Extended template file not found: $extendedPath");
      }
      include($extendedPath);
    }
  }
}
//----------------------------------------------------------
// Verifica se a URI existe entre as rotas
if(!function_exists('_match_route'))
{
  function _match_route($router, $uri)
  {
    foreach ($router as $route_uri => $route) {
      // Transforma a rota em regex para extrair parâmetros
      $pattern = preg_replace('/\(\:\w+\)/', '([^/]+)', $route_uri);
      $pattern = preg_replace('/\(\?\:\w+\)/', '([^/]*)', $pattern);
      $pattern = '#^' . $pattern . '$#';

      if (preg_match($pattern, $uri, $matches)) {
        // Remove o primeiro elemento, que é a string completa
        array_shift($matches);

        // Associa os parâmetros extraídos com a rota
        $param_names = [];
        preg_match_all('/\(\:\w+\)|\(\?\:\w+\)/', $route_uri, $param_names);
        $param_names = array_map(function($param) {
          return trim($param, '(:)?');
        }, $param_names[0]);

        foreach ($param_names as $index => $param_name) {
          $route[$param_name] = $matches[$index] ?? null;
        }

        return $route;
      }
    }
    return null;
  }
}

//----------------------------------------------------------
// faz a leitura do verbo
if(!function_exists('_get_request_method')) 
{
  function _get_request_method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }
}

//----------------------------------------------------------
// faz a leitura da requisição
if(!function_exists('_get_request_uri')) 
{
  function _get_request_uri()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $uri = parse_url($uri, PHP_URL_PATH);
    $uri = rtrim($uri, '/');
    
    // Se a URI for vazia após remover a barra final, defina-a como "/"
    if (empty($uri)) {
      $uri = '/';
    }

    return $uri;
    
  }
}


//----------------------------------------------------------
//
if(!function_exists('_get_request_query_string'))
{
  function _get_request_query_string()
  {
    if(!isset($_SERVER['QUERY_STRING'])) {
      return [];
    }
    
    $query_string = $_SERVER['QUERY_STRING'];
    $query_array = [];
    parse_str($query_string, $query_array);

    return $query_array;
  }
}

//----------------------------------------------------------
// Verifica se a URI existe entre as rotas
if(!function_exists('_check_uri_exists'))
{
  function _check_uri_exists($router, $uri)
  {
    return array_key_exists($uri, $router);
  }
}

//----------------------------------------------------------
// Verifica se o namespace do controller existe
if(!function_exists('_check_redirect_exists'))
{
  function _check_redirect_exists($route)
  {
    if(isset($route['redirect'])) {
      return true;
    }

    return false;
  }
}

//----------------------------------------------------------
// Verifica se o método HTTP é aceito na rota correspondente
if(!function_exists('_check_method_allowed'))
{
  function _check_method_allowed($router, $uri, $method)
  {
    return isset($router[$uri][$method]);
  }
}

//----------------------------------------------------------
// Verifica se o namespace do controller existe
if(!function_exists('_check_controller_exists'))
{
  function _check_controller_exists($route)
  {
    $controller_name = $route['controller'];
    return class_exists($controller_name);
  }
}

//----------------------------------------------------------
// Verifica se um método existe em uma determinada classe.
if(!function_exists('_check_method_exists'))
{
  function _check_method_exists($controller, $method)
  {
    return method_exists($controller, $method);
  }
}

//----------------------------------------------------------
// Verifica se um método existe em uma determinada classe.
if(!function_exists('_check_view_exists'))
{
  function _check_views_exists($router, $uri)
  {
    return isset($router[$uri]['GET']['views']);
  }
}


//----------------------------------------------------------
// inicializa as urls e verificações
if(!function_exists('_initialize_router'))
{
  function _initialize_router($router)
  {
    $uri = _get_request_uri();
    $method = _get_request_method();
    $route = _match_route($router, $uri);
    
    if ($route === null) {
      http_response_code(404);
      echo "Not Found";
      return;
    }

    //
    if(_check_redirect_exists($route)) {
      header('Location: '. $route['redirect']);
      return;
    }

    if (!_check_method_allowed($router, $uri, $method)) {
      http_response_code(405);
      echo "Not Allowed";
      return;
    }

    if(_check_views_exists($router, $uri)) {
      $view = $router[$uri][$method]['views'];
      $block = new TemplateEngine('views');


      if(!isset($view[0])) {
        http_response_code(500);
        echo "Em $uri, $router[$uri][$method]['views'] deve ter pelo menos 1 (rota) para views";
        return;
      }
      
      if(isset($view[1])) {
        $block->view($view[0], $view[1]);
        return;
      }

      $block->view($view[0]);
      return;
    }

    if (!_check_controller_exists($route)) {
      http_response_code(500);
      echo "Controller Not Found";
      return;
    }

    if (!_check_method_exists($route['controller'], $route[$method])) {
      http_response_code(500);
      echo "Method ". $route[$method] ." Not Found";
      return;
    }

    $controller_name = $route['controller'];
    $controller = new $controller_name();
    $action = $route[$method];
    $controller->$action((object) ['request' => _get_request(), 'query_string' => _get_request_query_string()]);
  }
}
