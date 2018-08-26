<?php 

return [

	'amazon' => [

		'handler' => 'Feeds\Handlers\CsvHandler',

		'provider' => 'Feeds\Providers\Amazon',

		'storage' => '/mnt/d/SERVER/WWW/pric.co.uk/feeds/old/feed_files/az',

		'table' => 'productsaz',
	],

];
