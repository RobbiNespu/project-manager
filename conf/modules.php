<?php

$base = __DIR__ . '/../';

return array(
    // Framework
    'Common' => $base . 'src/SIOFramework/Common',
    'Acl' => $base . 'src/SIOFramework/Acl',

    // Project Manager
	'Default' => $base . 'src/ProjectManager/Default', // Layout stuff
	'Widgets' => $base . 'src/ProjectManager/Widgets', // Widget stuff
	
    'AccessController' => $base . 'src/ProjectManager/AccessController',
    'Dashboard' => $base . 'src/ProjectManager/Dashboard',
    'Users' => $base . 'src/ProjectManager/Users',
    'Settings' => $base . 'src/ProjectManager/Settings',
    'Customers' => $base . 'src/ProjectManager/Customers',
    'Projects' => $base . 'src/ProjectManager/Projects',
    'Reports' => $base . 'src/ProjectManager/Reports',

    // Customer Relationship
    'Relationship' => $base . 'src/ProjectManager/Relationship',

);
