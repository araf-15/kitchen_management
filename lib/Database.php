<?php
	/**
	* Database Class
	*/
	class Database{
		private $hostdb = "localhost";
		private $userdb = "root";
		private $passdb = "";
		private $namedb = "kms";

		public $pdo;
		public $sampConn, $error;

		function __construct(){
			if (!isset($this->pdo)) {
				try{
				 $link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
				 $link->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				 $link->exec("SET CHARACTER SET utf8");
				 $this->pdo = $link;
				}catch(PDOException $e){
					die("Failed to connect with Database".$e->getMessage());
				}
			}
			$this->connectDB();
		}

		public function connectDB(){
			$this->sampConn = new mysqli($this->hostdb, $this->userdb, $this->passdb, $this->namedb);
			if(!$this->sampConn){
				$this->error = "Connection Error".$this->sampConn->connect_error;
			}else{
				return false;
			}
		}

		public function selectData($data){
			$result = $this->sampConn->query($data) or die ($this->link->error.__LINE__);
			if($result->num_rows > 0){
				return $result;
			}else{
				return false;
			}
		}
	}
?>