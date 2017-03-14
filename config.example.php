<?php

/**
 * Project configuration
 */
 
return [
	/**
	 * Database 
	 */
    'database' => [
        'name' => 'todo',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
