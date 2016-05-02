<?php

// Default route for this module.
// Feel free to change it.
$app->get('/Settings',function() use ($app){

(new ProjectManager\Settings\Controller\SettingsController($app))->changePassword();

})->via('GET','POST')->name('Settings');