<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['valor1'] = "Teste";

$app['get_date_time'] = function(){
    return new \DateTime();
};

$app->get('/', function(Silex\Application $app){
    echo $app['get_date_time']->fotmat(\DateTime::W3C);
    echo "<br/>";
    sleep(10);
    echo $app['get_date_time']->fotmat(\DateTime::W3C);
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