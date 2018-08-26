<?php

namespace Feeds\Database;

class QueryBuilder{

	protected $db = null;

	protected $table = null;

	public function __construct()
	{

		$this->db = Connections::get();

	}

	public function table($table)
	{

		$this->table = $table;

		return $this;

	}

	public function get()
	{

		return $this->table;

	}

	public function create($data)
	{

		$fields = $this->arrayToFields($data);

		$values = $this->arrayToValues($data);

		$query = "insert ignore into $this->table($fields) values($values)";

		$this->db->prepare($query)->execute($data);

		return $this->db->lastInsertId();

	}

	public function createRawBulk($data)
	{

		$fields = $this->arrayToFields($data[0]);

		$values = $this->getRawValues($data);

		// $query = "insert into $this->table ($fields)
		// values $values
		// ON DUPLICATE KEY UPDATE
		// p_price=VALUES(p_price),
		// p_delivery_cost=VALUES(p_delivery_cost)";

		try{
			$this->db->query(

				"insert ignore into $this->table ($fields)
				values $values"
			);
		}catch(\PDOException $ex){
			dd($ex->getMessaget());
		}

	}

	public function arrayToFields($array)
	{

		return implode(',', array_keys($array));

	}

	public function arrayToValues($array)
	{

		return ':'.implode(',:', array_keys($array));

	}

	public function getRawValues($data)
	{
		$total = count($data);

		$values = "";

		$i = 1;

		foreach($data as $d){

			$values .= "('" . implode("','", $d) . "')";

			if($i<$total)
				$values .= ",";

			$i++;
		}

		return $values;

	}

	public function truncate($table)
	{

		$this->db->query("truncate table $table");

	}

}
