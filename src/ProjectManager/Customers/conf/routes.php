<?php

// Default route from scaffolding
// Feel free to change it.

$app->get('/Customers/Customer/list',function() use ($app){

(new ProjectManager\Customers\Controller\CustomerController($app))->listCustomer();

})->via('GET','POST')->name('Customers-Customer-List');

$app->get('/Customers/Customer/create',function() use ($app){

(new ProjectManager\Customers\Controller\CustomerController($app))->createCustomer();

})->via('GET','POST')->name('Customers-Customer-Create');

$app->get('/Customers/Customer/edit/:id',function($id) use ($app){

(new ProjectManager\Customers\Controller\CustomerController($app))->editCustomer($id);

})->via('GET','POST')->name('Customers-Customer-Edit');

$app->get('/Customers/Customer/delete/:id',function($id) use ($app){

(new ProjectManager\Customers\Controller\CustomerController($app))->deleteCustomer($id);

})->via('GET','POST')->name('Customers-Customer-Delete');