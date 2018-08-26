<?php
	//exmple use: #php azfeed.php ce_mp,ce_retail
	//include('fu.php');
	
	$arg = $_SERVER['argv'];

	$dept = trim($argv[1]);

	//$f = "https://assoc-datafeeds-eu.amazon.com/datafeed/getFeed?filename=uk_amazon_{$dept}.xml.gz";
	$f = "https://tls-assoc-datafeeds-eu.amazon.com/datafeed/getFeed?filename=uk_standardized_{$dept}.csv.gz";

	$o = "/mnt/d/SERVER/WWW/pric.co.uk/feeds/old/feed_files/az/{$dept}.gz";

	$out = fopen($o, 'w+');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	curl_setopt($ch, CURLOPT_USERPWD, 'username:pass');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FILE, $out);
	//curl_setopt($ch, CURLOPT_HEADER, false);
	//curl_setopt($ch, CURLOPT_NOBODY, false);
	curl_setopt($ch, CURLOPT_URL, $f);
	curl_exec($ch);
	fclose($out);
?>
