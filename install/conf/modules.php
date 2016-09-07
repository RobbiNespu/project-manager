<?php

$base = __DIR__ . '/../';

return array(
		
    // Framework
    'Common' => $base . 'src/SIOFramework/Common',
	'Acl' => $base . 'src/SIOFramework/Acl',

    // Project Manager
	'Default' => $base . 'src/ProjectManager/Default', // Layout stuff
	
	// Just models for sample data
	'Customers' => $base . 'src/ProjectManager/Customers',
	'Projects' => $base . 'src/ProjectManager/Projects',
		
    // Installer
    'Installer' => $base . 'src/ProjectManager/Installer',
	

);
