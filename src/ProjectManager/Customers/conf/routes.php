<?php

// Customer Routes
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

// Customer Relationship Users
$app->get('/Customers/User/list',function() use ($app){

    (new ProjectManager\Customers\Controller\CustomerController($app))->listCustomerUsers();

})->via('GET','POST')->name('Customers-User-List');

$app->get('/Customers/User/create',function() use ($app){

    (new ProjectManager\Customers\Controller\CustomerController($app))->createCustomerUser();

})->via('GET','POST')->name('Customers-User-Create');

$app->get('/Customers/User/delete/:id',function($id) use ($app){

    (new ProjectManager\Customers\Controller\CustomerController($app))->deleteCustomerUser($id);

})->via('GET','POST')->name('Customers-User-Delete');