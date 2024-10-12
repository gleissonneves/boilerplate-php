<?php

/**
 * routes exibem ou agem
 * é composto por texto, parametros e query params;
 * dado o acesso a rota deve executar algo.
 * deve ser verificado o parametro e a composição da rota
 * 
 * 
 * use src\application\controller\UsuarioController as UsuarioController
 * 
 * exemplo:
 * [
 *  '/bem-vindo/' => [
 *  '/login' => [
 *    'GET' => [
 *      'views' => [
 *         'auth/login',
 *       ],
 *     ],
 *    'POST' => 'index',
 *    'controller' => UsuarioController::class,
 *   ],
 *   ],
 *   '/usuarios/visualizar/(:id)' => [
 *    'middleware' => 'AuthMiddleware',
 *     'GET' => 'show',
 *     'controller' => FinanceiroController::class,
 *   ],
 *   '/teste/(:meu-parametro)' => [
 *     'GET' => 'handleParam',
 *     'controller' => 'TesteController',
 *   ],
 *   '/teste/(:meu-parametro)/testado/(:meu-segundo-parametro)' => [
 *     'GET' => 'handleMultipleParams',
 *     'controller' => 'TesteController',
 *   ],
 *   '/teste/(?:id)' => [
 *     'GET' => 'handleOptionalParam',
 *     'controller' => 'TesteController',
 *   ],
 * ]
 * 
 */

$routes = [
  '/' => [
    'redirect' => '/home'
  ],
  '/home' => [
    'GET' => [
      'views' => [
        'home',
      ],
    ],
  ],
];

_initialize_router($routes);
