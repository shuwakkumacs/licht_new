<?php
class MyDBClass_mysql{
	public $mysqli;
	function __construct(){
		$this->mysqli = new mysqli('localhost', 'root', 'iseebi3014', 'licht') or die('Could not connect to DB');
	}

	function executeQuery($sql){
		$data = $this->mysqli->query($sql);
		if($data === false){
			return 'SQL failure';
		}
		else if($data === true){
			return $data;
		}
		else {
			$retArray = array();
			$i = 0;
			while($datum = $data->fetch_assoc()){
				$datumArray = array();
				foreach($datum as $key => $val){
					$datumArray[$key] = $val;
				}
				$retArray[$i] = $datumArray;
				$i++;
			}
			return $retArray;
		}
	}
}
