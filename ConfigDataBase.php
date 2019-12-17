<?php

require_once 'Config.php';

Class ConfigDataBase
{
	protected static $db = null; 
  	protected $mysqli; 
 	protected $sym_query = "{?}"; 

	protected function __construct() {
		$this->mysqli= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) ;
		/* Проверка соединения */ 
		if (mysqli_connect_errno()) { 
		    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
		} 
	}	

	public function __destruct() {
    	if ($this->mysqli) 
    		$this->mysqli->close();
  	}
}