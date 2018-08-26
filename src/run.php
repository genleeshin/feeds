<?php

// set up app

require __DIR__ . '/../bootstrap/autoload.php';

require __DIR__ . '/../bootstrap/app.php';

use Feeds\Core\Feed;

use Feeds\Database\Db;

if( count($argv) < 2 )
	cout("Arguments missing");

config('args', $argv);


$src = $argv[1];

$provider_class = config('feed.' . $src . '.provider');

$handler_class = config('feed.' . $src . '.handler');

$provider = new $provider_class;

$handler = new $handler_class;

// truncate table

// Db::truncate($amazon->getTable());

if( !$file = $provider->getFile() )
	return;

if( !file_exists($file))
	return;


$feed = new Feed($provider, $handler);

$start_time = time();

//$feed->handler()->lineEnd(5);

$feed->parse($file);

$data = $feed->getData();


cout('Time took: ' . (time() - $start_time));

cout('done');

