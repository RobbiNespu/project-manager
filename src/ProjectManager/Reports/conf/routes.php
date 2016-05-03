<?php

// Default route for this module.
// Feel free to change it.
$app->get('/Reports/Projects',function() use ($app){

(new ProjectManager\Reports\Controller\ReportsController($app))->projectReport();

})->via('GET','POST')->name('Reports-Projects');