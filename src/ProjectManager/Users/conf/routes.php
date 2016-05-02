<?php

$app->post('/admin/users/list', function() use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->listSystemUsers();

})->name('admin-users-list')->via('GET','POST');

$app->post('/admin/users/create', function() use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->createUser();

})->name('admin-users-create')->via('GET','POST');

$app->post('/admin/users/disable/:userId', function($userId) use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->disableUser($userId);

})->name('admin-users-disable')->via('GET','POST');

$app->post('/admin/users/enable/:userId', function($userId) use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->enableUser($userId);

})->name('admin-users-enable')->via('GET','POST');

$app->post('/admin/users/roles/:userId', function($userId) use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->userRoles($userId);

})->name('admin-users-roles')->via('GET','POST');


$app->post('/admin/roles/add', function() use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->addRole();

})->name('admin-roles-add')->via('GET','POST');

$app->post('/admin/roles/remove/:userId/:roleId', function($userId,$roleId) use ($app){

    $adminController = new \ProjectManager\Users\Controller\UsersController($app);
    $adminController->removeRole($userId,$roleId);

})->name('admin-roles-remove')->via('GET','POST');