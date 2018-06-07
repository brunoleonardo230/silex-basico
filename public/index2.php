<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ .'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function(){
    return "Hello Word";
});


$app->get('/home', function(){
    return "<form method='post' action='/home'>
                <input type type='text' name='name'/>
                <button type='submit'>Enviar</button>
            </form>";
});

$app->post('/home', function(Request $request){
    $name = $request->get('name','sem nome');
    return new Response("Post enviado! Name: $name");
});

//ENVIO DE FORMULARIO POR POST=============================================================
$app->get('/post', function(){
    return "<form method='post' action='/home'>
                <input type type='text' name='name'/>
                <button type='submit'>Enviar</button>
            </form>";
});

$app->post('/post', function(Request $request){
    $name = $request->get('name','sem nome');
    //$data = $request->request->all();  pega todos parametros enviados por post
    return "Post enviado! Name: $name";
});

//ENVIO DE FORMULARIO POR GET============================================================
$app->get('/get', function(){
    return "<form method='get' action='/get-name'>
                <input type type='text' name='name'/>
                <button type='submit'>Enviar</button>
            </form>";
});

$app->get('/get-name', function(Request $request){
    $name = $request->get('name','sem nome');
    //$data = $request->query->all();  pega todos parametros enviados por get
    return "Post enviado! Name: $name";
});

//PARAMETROS ============================================================================
$app->get('/parametro', function(){
    return "<form method='post' action='/parametro/valor1/valor2'>
                <input type type='text' name='name'/>
                <button type='submit'>Enviar</button>
            </form>";
});

$app->post('/parametro/{param1}/{param2}', function(Request $request, $param1, $param2){
    $name = $request->get('name','sem nome');
    return new Response("Post enviado!
    </br>Name: $name
    </br>Param1: $param1
    </br>Param2: $param2
    ");
});

//TEMPLATES ============================================================================
$app->get('/templates', function(){
    ob_start();
    include __DIR__ . '/../templates/home.php';
    $saida = ob_get_clean();
    return $saida;
});

$app->post('/templates/{param1}/{param2}', function(Request $request, $param1, $param2){
    $name = $request->get('name','sem nome');
    ob_start();
    include __DIR__ . '/../templates/get-name.php';
    $saida = ob_get_clean();
    return $saida;
});

$app->run();