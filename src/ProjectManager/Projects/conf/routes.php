<?php

// Default route from scaffolding
// Feel free to change it.

$app->get('/Projects/Project/list',function() use ($app){

    (new ProjectManager\Projects\Controller\ProjectController($app))->listProject();

})->via('GET','POST')->name('Projects-Project-List');

$app->get('/Projects/Project/create',function() use ($app){

    (new ProjectManager\Projects\Controller\ProjectController($app))->createProject();

})->via('GET','POST')->name('Projects-Project-Create');

$app->get('/Projects/Project/edit/:id',function($id) use ($app){

    (new ProjectManager\Projects\Controller\ProjectController($app))->editProject($id);

})->via('GET','POST')->name('Projects-Project-Edit');

$app->get('/Projects/Project/delete/:id',function($id) use ($app){

    (new ProjectManager\Projects\Controller\ProjectController($app))->deleteProject($id);

})->via('GET','POST')->name('Projects-Project-Delete');


// Products
$app->get('/Projects/Products/:projectId',function($projectId) use ($app){

    (new ProjectManager\Projects\Controller\ProductController($app))->listProduct($projectId);

})->via('GET','POST')->name('Projects-Products-List');

// Products
$app->get('/Projects/Products/create/:projectId',function($projectId) use ($app){

    (new ProjectManager\Projects\Controller\ProductController($app))->createProduct($projectId);

})->via('GET','POST')->name('Projects-Product-Create');

$app->get('/Projects/Products/edit/:projectId/:id',function($projectId,$id) use ($app){

    (new ProjectManager\Projects\Controller\ProductController($app))->editProduct($projectId, $id);

})->via('GET','POST')->name('Projects-Product-Edit');

$app->get('/Projects/Products/delete/:projectId/:id',function($projectId,$id) use ($app){

    (new ProjectManager\Projects\Controller\ProductController($app))->editProduct($projectId, $id);

})->via('GET','POST')->name('Projects-Product-Delete');
