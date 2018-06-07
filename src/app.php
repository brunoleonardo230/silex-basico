<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['view.config'] = [
    'path_templates' => __DIR__ . '/../templates'
];

$app['view.renderer'] = function() use($app){
    $pathTemplates = $app['view.comfig']['path_templates'];
    return new ViewRenderer($pathTemplates);
};

$app->get('/', function(Silex\Application $app){
    echo $app['get_date_time']->fotmat(\DateTime::W3C);
    echo "<br/>";
    sleep(10);
    echo $app['get_date_time']->fotmat(\DateTime::W3C);
    return "Hello Word!{$app['valor1']}";
});

$app->get('/home', function(){
    return $app['view.renderer']->render('home',[]);
});

$app->post('/get-name/{param1}/{param2}', function(Request $request, Silex\Application $app, $param1, $param2){
    $name = $request->get('name','sem nome');
    ob_start();
    include __DIR__ . '/../templates/get-name.php';
    $saida = ob_get_clean();
    return $saida;
});

$app->run();