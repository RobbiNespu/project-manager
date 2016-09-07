<?php

require_once __DIR__ . '/vendor/autoload.php';

use \Doctrine\ORM\Tools\Console\ConsoleRunner;

// Loads the Slim app
$app = new \Slim\Slim();

// Loads configurations
require __DIR__ . '/conf/bootstrap.php';

// Returns the EntityManager for console running
return ConsoleRunner::createHelperSet($app->container->get('orm'));
