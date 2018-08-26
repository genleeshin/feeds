<?php 

// set config files

foreach (glob(__DIR__.'/../config/*.php') as $filename):
		$name = basename($filename, '.php');
        \Feeds\Core\Config::set($name, $value = require $filename);
endforeach;

// set up database connection

Feeds\Database\Connections::make();
