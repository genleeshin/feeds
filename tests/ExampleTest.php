<?php 
use Feeds\Feed;
use Feeds\Providers\Amazon;

class ExampleTest extends PHPUnit_Framework_TestCase{

	protected $provider;

	public function setUp()
	{
	
		$this->provider = new Amazon;
	
	}
    public function testNewFoo() {

    	$this->assertEquals('Amazon', $this->provider->getProvider());

        $feed = new Feed($this->provider);

        $this->assertInstanceOf('Feeds\Feed', $feed);  
    }
}
