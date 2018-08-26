<?php 
use Feeds\Handlers\CsvHandler;

use Feeds\Providers\Amazon;

use Feeds\Core\Feed;

class FeedTest extends PHPUnit_Framework_TestCase{

	protected $feed;

	protected $file = __DIR__ . '/../storage/test/test.csv.gz';

	public function setUp()
	{
	
		$this->feed = new Feed(new Amazon, new CsvHandler);
	
	}
    public function testParse() {
    	
    	$this->feed->handler()->lineEnd(5);

    	$this->feed->parse($this->file);

    	$data = $this->feed->getData();

    	$this->assertCount(4, $data);  
    }
}
