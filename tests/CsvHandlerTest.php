<?php 
use Feeds\Handlers\CsvHandler;

use Feeds\Providers\Amazon;

class CsvHandlerTest extends PHPUnit_Framework_TestCase{

	protected $handler;

	protected $file = __DIR__ . '/../storage/test/test.csv.gz';

	public function setUp()
	{
        //set csv hander

		$this->handler = new CsvHandler(new Amazon);

        // file to process

		$this->handler->setFile($this->file);
	
	}
    public function testHandler() {

    	$this->assertEquals('csv', $this->handler->getHandler());  
    }

    // set the file name and get back instance
    
    public function testSetFile()
    {    	

    	$this->assertInstanceOf(Feeds\Handlers\CsvHandler::class, $this->handler->setFile($this->file));
    
    }

    // getFile() should return the file name we set

    public function testGetFile()
    {    	

    	$this->assertEquals(basename($this->file), $this->handler->getFile());
    
    }

    // read file and get the first line
    // check if first line contains a string

    public function testHeaders()
    {
    	$this->handler->lineEnd(1)->run();

    	$headers = $this->handler->getHeaders();

    	$this->assertContains('asin', $headers);
    }

    public function testField()
    {

    	$this->handler->lineEnd(2)->run();

    	$fields = $this->handler->getFields();

    	$this->assertArrayHasKey('asin', $fields);
    }
}
