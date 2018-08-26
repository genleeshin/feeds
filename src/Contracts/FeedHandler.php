<?php 

namespace Feeds\Contracts;

interface FeedHandler{

	public function setApp($app);

	public function getHandler();

	public function setFile($file);

	public function getFile();

	public function getData();
}