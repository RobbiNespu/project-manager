<?php

// Default route from scaffolding
// Feel free to change it.

$app->group('/Projects', function() use ($app){
	
	$app->group('/Project/', function() use ($app){
	
		$app->get('list',function() use ($app){
		
			(new ProjectManager\Projects\Controller\ProjectController($app))->listProject();
		
		})->via('GET','POST')->name('Projects-Project-List');
		
		$app->get('create',function() use ($app){
		
			(new ProjectManager\Projects\Controller\ProjectController($app))->createProject();
		
		})->via('GET','POST')->name('Projects-Project-Create');
		
		$app->get('edit/:id',function($id) use ($app){
		
			(new ProjectManager\Projects\Controller\ProjectController($app))->editProject($id);
		
		})->via('GET','POST')->name('Projects-Project-Edit');
		
		$app->get('delete/:id',function($id) use ($app){
		
			(new ProjectManager\Projects\Controller\ProjectController($app))->deleteProject($id);
		
		})->via('GET','POST')->name('Projects-Project-Delete');
		
	});
	
	
	
	$app->group('/Products/', function() use ($app){
	
		$app->get(':projectId',function($projectId) use ($app){
		
			(new ProjectManager\Projects\Controller\ProductController($app))->listProduct($projectId);
		
		})->via('GET','POST')->name('Projects-Products-List');
		
		$app->get('create/:projectId',function($projectId) use ($app){
		
			(new ProjectManager\Projects\Controller\ProductController($app))->createProduct($projectId);
		
		})->via('GET','POST')->name('Projects-Product-Create');
		
		$app->get('edit/:projectId/:id',function($projectId,$id) use ($app){
		
			(new ProjectManager\Projects\Controller\ProductController($app))->editProduct($projectId, $id);
		
		})->via('GET','POST')->name('Projects-Product-Edit');
		
		$app->get('delete/:projectId/:id',function($projectId,$id) use ($app){
		
			(new ProjectManager\Projects\Controller\ProductController($app))->deleteProduct($projectId, $id);
		
		})->via('GET','POST')->name('Projects-Product-Delete');
		
		$app->get('Overview/',function() use ($app){
		
			(new ProjectManager\Projects\Controller\ProductController($app))->productsOverview();
		
		})->via('GET','POST')->name('Projects-Products-Overview');
		
		
		$app->get('Ajax/List(/:projectId)',function($projectId=NULL) use ($app){
		
			(new ProjectManager\Projects\Controller\ProductController($app))->selectProductsFromProject($projectId);
		
		})->name('Projects-Products-Ajax-List');
		
	});
	
	
	
	$app->group('/Allocation/', function() use ($app){
		
		$app->get('Overview/',function() use ($app){
		
			(new ProjectManager\Projects\Controller\AllocationController($app))->allocationOverview();
		
		})->via('GET','POST')->name('Projects-Allocation-Overview');
		
		$app->get('edit/(:allocationId)',function($allocationId=NULL) use ($app){
		
			(new ProjectManager\Projects\Controller\AllocationController($app))->editAllocation($allocationId);
		
		})->via('GET','POST')->name('Projects-Allocation-Edit');
		
	});

});



