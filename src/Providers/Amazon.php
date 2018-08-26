<?php

namespace Feeds\Providers;

use Feeds\Contracts\FeedProvider;

class Amazon implements FeedProvider
{
	protected $app;

	protected $table = null;

	protected $file = null;

	public function __construct(){

		$this->table = config('feed.amazon.table');

		$this->setFile();
	}

	protected function setFile(){

		$path = config('feed.amazon.storage');

		$args = config('args');

		if(isset($args[2]) && isset($args[3]))
			$this->file = $path . '/' . trim($args[2]) . '_' . trim($args[3]) .'.gz';
	}

	public function getFile(){
		return $this->file;
	}

	public function setApp($app)
	{

		$this->app = $app;

	}

	public function getProvider()
	{

		return 'Amazon';

	}

	public function mapFieldsToDb()
	{

		$merchant = trim(strtolower($this->app->getField('itemMerchantName')));

		$merchant = addslashes($merchant);

		$data['p_net'] = 'az';

		if($merchant == 'amazon.co.uk'):
			$data['m_host'] = 'amazon.co.uk';
			$data['m_name'] = 'Amazon.co.uk';
			$data['m_id'] = 938;
			$data['p_price'] = $this->app->getField('amazonPrice');
			$data['p_delivery_cost'] = $this->getDeliveryCost('amazonShippingCharge');
		else:
			$data['m_host'] = 'marketplace.amazon.co.uk';
			$data['m_name'] = 'Amazon Marketplace';
			$data['m_id'] = 958;
			$data['p_price'] = $this->app->getField('itemPrice');
			$data['p_delivery_cost'] = $this->getDeliveryCost('itemShippingCharge');
		endif;

		$asin = trim($this->app->getField('asin'));

		$data['p_sku'] = $data['m_id'] . '_' . $asin;

		$data['m_sku'] = $asin;

		$data['p_key'] = $asin;

		$data['p_name'] = addslashes($this->app->getField('title'));

		return $data;

	}

	public function getDeliveryCost($key)
	{

		$value = trim($this->app->getField($key));

		if(is_numeric($value))
			return $value;

		if($value == 'Free!')
			return 0.00;

		return -1;

	}

	public function getTable()
	{

		return $this->table;

	}
}
