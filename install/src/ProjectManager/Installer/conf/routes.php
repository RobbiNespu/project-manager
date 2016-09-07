<?php

use ProjectManager\Installer\Controller\InstallerController;

$app->get('/', function() use ($app){

	(new InstallerController($app))->quickstart();
    
})->name('quickstart');

$app->post('/start', function() use ($app){

	(new InstallerController($app))->install();

})->name('install');
