<?php

namespace Feeds\Core;

use Feeds\Contracts\FeedProvider;

use Feeds\Contracts\FeedHandler;

use Feeds\Database\Db;

class Feed{

	protected $provider;

	protected $handler;

	protected $data = [];

	protected $fields = [];

	public function __construct(FeedProvider $provider, FeedHandler $handler)
	{
		$this->provider = $provider;

		$this->provider->setApp($this);

		$this->handler = $handler;

		$this->handler->setApp($this);
	}

	public function parse($file)
	{

		return $this->handler
			->setFile($file)
			->run();

	}

	public function process($fields)
	{

		$this->fields = $fields;

		$this->store($this->provider->mapFieldsToDb());

		if(count($this->data) >= 500)
			$this->insert();

	}

	public function finish()
	{
		if(count($this->data)>0)
			$this->insert();

	}

	public function insert()
	{

		Db::table($this->provider->getTable())->createRawBulk($this->data);

		$this->data = [];

		cout('inserted');

	}

	public function store($data)
	{
		// if price is empty ignore

		$price = (int)$data['p_price'];

		if($price<1) return false;

		$this->data[] = $data;

	}

	public function getFields()
	{

		return $this->fields;

	}

	public function getField($key)
	{

		if($key && array_key_exists($key, $this->fields))
			return $this->fields[$key];


		return null;


	}

	public function getData()
	{

		return $this->data;

	}

	public function handler()
	{

		return $this->handler;

	}


	public function provider()
	{

		return $this->provider;

	}

}
