<?php

// Default route for this module.
// Feel free to change it.
$app->get('/Relationship/Dashboard',function() use ($app){

(new ProjectManager\Relationship\Controller\RelationshipController($app))->dashboard();

})->via('GET','POST')->name('Relationship-Dashboard');

$app->get('/Relationship/Projects',function() use ($app){

(new ProjectManager\Relationship\Controller\RelationshipController($app))->listProjects();

})->via('GET','POST')->name('Relationship-Projects');

$app->get('/Relationship/Products/:projectId',function($projectId) use ($app){

(new ProjectManager\Relationship\Controller\RelationshipController($app))->listProducts($projectId);

})->via('GET','POST')->name('Relationship-Products');