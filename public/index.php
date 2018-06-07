<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ .'/../vendor/autoload.php';

$app = new Silex\Application();

$app['valor1'] = "Teste";

$app['get_date_time'] = function(){
    return new \DateTime();
};

$app->get('/', function(Silex\Application $app){
    echo $app['get_date_time']->fotmat('Y-m-d\TH:i:s');die();
    return "Hello Word!{$app['valor1']}";
});

$app->get('/home', function(){
    ob_start();
    include __DIR__ . '/../templates/home.php';
    $saida = ob_get_clean();
    return $saida;
});

$app->post('/get-name/{param1}/{param2}', function(Request $request, Silex\Application $app, $param1, $param2){
    $name = $request->get('name','sem nome');
    ob_start();
    include __DIR__ . '/../templates/get-name.php';
    $saida = ob_get_clean();
    return $saida;
});

$app->run();