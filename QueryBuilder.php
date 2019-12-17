<?php 

require_once "Config.php";

class QueryBuilder 
{ 
	static private $instance = null;
	private $mysqli; 
	private $query_znak = "-b-"; 
	static private $error = false;

	private function __construct($db_name) 
	{
		$this->mysqli= @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $db_name) ;
		if (mysqli_connect_errno()) { 
			echo "Подключение невозможно: " . mysqli_connect_error() . "<br>";
			self::$error = true;
		} 
	} 
 
 	public static function getInstance($db_name) 
 	{
	 	if(self::$instance == null) 
	 	{
			self::$instance = new self($db_name);
		}
		return self::$instance;
	}

	public function selectAll($query, $inpelements = false) 
	{
		if (!self::$error) 
		{
			$result_query = $this->mysqli->query($this->getQuery($query, $inpelements));
			if (!$result_query) 
				return "Ошибка";
		 	return $this->resSelectAll($result_query);
		}
		else 
			return "Запрос не выполнен. Ошибка подключения в БД <br>";
	}

	public function selectRow($query, $inpelements = false) 
	{
		if (!self::$error) 
		{
			$result_query = $this->mysqli->query($this->getQuery($query, $inpelements));
			if ($result_query->num_rows != 1) 
				return "Ошибка. В таблице несколько строк с данными параметрами";
		 	else 
			 	return $result_query->fetch_assoc();
		}
		else 
			return "Запрос не выполнен. Ошибка подключения в БД <br>";
	}

	public function selectCell($query, $inpelements = false) 
	{
		if (!self::$error) 
		{
			$result_query = $this->mysqli->query($this->getQuery($query, $inpelements));
			if ((!$result_query) || ($result_query->num_rows != 1)) 
				return "Ошибка. В таблице несколько ячеек с данными параметрами";
			else 
			{
				$arr = array_values($result_query->fetch_assoc());
				return $arr[0];
			}
		}
		else 
			return "Запрос не выполнен. Ошибка подключения в БД <br>";
	}

	public function UpdateInsertDelete($query, $inpelements = false) 
	{
		if (!self::$error) 
		{
			$success = $this->mysqli->query($this->getQuery($query, $inpelements));
			if ($success) 
			{
				if ($this->mysqli->insert_id === 0) 
					return true;
			 	else 
				 	return $this->mysqli->insert_id;
			}
		 	else 
				return "Ошибка";
		}
		else 
			return "Запрос не выполнен. Ошибка подключения в БД <br>";
	}

	private function resSelectAll($result_query) 
	{
		$array = array();
		while (($row = $result_query->fetch_assoc()) != false) 
		{
			$array[] = $row;
		}
		return $array;
	} 

	private function getQuery($query, $inpelements) 
	{
		if ($inpelements) 
		{
			for ($i = 0; $i < count($inpelements); $i++) 
			{
				$pos = strpos($query, $this->query_znak);
				$arg = "'" . $this->mysqli->real_escape_string($inpelements[$i]) . "'";
				$query = substr_replace($query, $arg, $pos, strlen($this->query_znak));
			}
		}
		return $query;	
	}

	public function __destruct() 
	{
	 if (!self::$error) 
		$this->mysqli->close();
 	}
}