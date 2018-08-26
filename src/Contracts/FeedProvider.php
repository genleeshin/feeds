<?php 

namespace Feeds\Contracts;

interface FeedProvider{
	
	public function setApp($app);

	public function getProvider();

	public function mapFieldsToDb();
}