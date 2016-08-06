<?php

// Default route for this module.
// Feel free to change it.
$app->get('/Dashboard',function() use ($app){
	
	(new ProjectManager\Dashboard\Controller\DashboardController($app))->index();

})->via('GET','POST')->name('Dashboard');