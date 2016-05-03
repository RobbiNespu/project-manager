<?php

// Default route from scaffolding
// Feel free to change it.


$app->get('/login',function() use ($app){

(new SIOFramework\Acl\Controller\AccessController(
    $app, new \SIOFramework\Common\Factory\StandardFactory($app)
))->login('Dashboard');

})->via('GET','POST')->name('AccessController-login');

$app->get('/logout',function() use ($app){

(new SIOFramework\Acl\Controller\AccessController(
    $app, new \SIOFramework\Common\Factory\StandardFactory($app)
))->logout('AccessController-login');

})->via('GET','POST')->name('AccessController-logout');
