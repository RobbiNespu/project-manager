<?php

// The Migration configuration
return array (

    'module' => 'Projects', // One of your SIOFramework models. E.g.: Acl

    'name' => 'Project', // Must be the same as the file name
    'table_name' => 'pm_project', // The database table name

    'package' => 'ProjectManager\Projects\Model', // Your package. E.g.: SIOFramework\Common\Model

    'parameters' => array( // Map as 'name'=>'type'
        'name' => 'string',
        'shortDescription' => 'string',
        'startingDate' => 'date',
    ),
);