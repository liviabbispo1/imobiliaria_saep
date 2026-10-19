<?php
//Rotas Públicas
// Rotas Login
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/autenticar', 'LoginController::autenticar');
$routes->get('logout', 'LoginController::logout');

//Rotas Protegidas
$routes->group('', ['filter' => 'auth'], function($routes){
    // Rota Inicio
    $routes->get('inicio', 'InicioController::index');



    // Rotas PROPRIETARIOS
    $routes->match(['get', 'post'], 'proprietarios',  'ProprietariosController::index');
    $routes->get('proprietarios/novo',                'ProprietariosController::novo');
    $routes->post('proprietarios/inserir',            'ProprietariosController::inserir');
    $routes->get('proprietarios/editar/(:num)',       'ProprietariosController::editar/$1');
    $routes->post('proprietarios/atualizar/(:num)',   'ProprietariosController::atualizar/$1');
    $routes->get('proprietarios/excluir/(:num)',      'ProprietariosController::excluir/$1');


    // Rotas IMOVEIS
    $routes->match(['get', 'post'], 'imoveis',  'ImoveisController::index');
    $routes->get('imoveis/novo',                'ImoveisController::novo');
    $routes->post('imoveis/inserir',            'ImoveisController::inserir');
    $routes->get('imoveis/editar/(:num)',       'ImoveisController::editar/$1');
    $routes->post('imoveis/atualizar/(:num)',   'ImoveisController::atualizar/$1');
    $routes->get('imoveis/excluir/(:num)',      'ImoveisController::excluir/$1');


    // Rotas Agendamentos
    $routes->match(['get', 'post'], 'agendamentos',     'AgendamentosController::index');
    $routes->get('agendamentos/novo',                   'AgendamentosController::novo');
    $routes->post('agendamentos/inserir',               'AgendamentosController::inserir');
    $routes->get('agendamentos/editar/(:num)',          'AgendamentosController::editar/$1');
    $routes->post('agendamentos/atualizar/(:num)',      'AgendamentosController::atualizar/$1');
    $routes->get('agendamentos/excluir/(:num)',         'AgendamentosController::excluir/$1');
});
