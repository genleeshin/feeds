<?php

namespace Feeds\Handlers;

use Feeds\Contracts\FeedHandler;

/**
* Handles csv datafeeds
*/
class CsvHandler implements FeedHandler
{
	protected $app;

	protected $provider;

	protected $file;

	protected $data;

	protected $line = 1;

	// stop reading after line

	protected $line_end = 0;

	protected $fields = [];

	/**
	 * stores csv headers
	 * @var array
	 */
	protected $header = [];

	public function setApp($app)
	{

		$this->app = $app;

	}

	/**
	* get handler name
	*
	* @var string
	*/
	public function getHandler()
	{

		return 'csv';

	}

	/**
	* set csv file to be processed
	*
	* @var object
	*/
	public function setFile($file)
	{

		if(! file_exists($file))
			d('File not found');

		$this->file = $file;

		return $this;

	}

	/**
	* file currently processing
	*
	* @var string
	*/
	public function getFile()
	{

		return basename($this->file);

	}

	public function run(){
		$fp = gzopen($this->file,"r");

		while (($data = gzgets($fp)) !== FALSE):

			$this->data = str_getcsv($data);

			if($this->line == 1):

				$this->setHeaders();

			else:

				$this->process();

			endif;

			if($this->line_end > 0 && $this->line == $this->line_end)
				break;

			$this->line++;

		endwhile;

		gzclose($fp);

		$this->app->finish();
	}

	public function process()
	{

		$this->mapDataToHeaders();

		$this->app->process($this->fields);

	}

	public function getData()
	{

		return $this->data;

	}

	// get fields

	public function getFields()
	{

		return $this->fields;

	}

	// Extract headers from the first line

	public function setHeaders()
	{
		foreach($this->data as $d){
			$this->headers[]=trim($d);
		}

	}

	public function getHeaders()
	{
		return $this->headers;

	}

	public function mapDataToHeaders()
	{
		$fields = [];
		for($i=0;$i<count($this->data);$i++){

			if(isset($this->headers[$i])){

				$header = $this->headers[$i];

				$fields[$header] = $this->data[$i];
			}
		}

		$this->fields = $fields;

	}

	// set where to stop reading file

	public function lineEnd($line)
	{

		$this->line_end = $line;

		return $this;

	}
}
