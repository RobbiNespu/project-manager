<?php

// The Migration configuration
return array (

    'module' => 'Customers', // One of your SIOFramework models. E.g.: Acl

    'name' => 'Customer', // Must be the same as the file name
    'table_name' => 'pm_customer', // The database table name

    'package' => 'ProjectManager\Customers\Model', // Your package. E.g.: SIOFramework\Common\Model

    'parameters' => array( // Map as 'name'=>'type'
        'name' => 'string',
        'nickname' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'state' => 'string',
    ),
);