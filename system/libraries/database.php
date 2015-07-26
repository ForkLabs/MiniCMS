<?php require(PROTECT);

class Database extends Libraries {
	function database() {
		parent::libraries();

		# This is our handler; connects us to the database using PDO
		$this->handler = false;
		$this->connect(DB_HOST, DB_DATABASE, DB_USER, DB_PASSWORD);
		$this->handler = $this->getHandler();
	}

	function connect($host, $dbname, $username, $password) {
		$conn_str = 'mysql:host='.$host.';dbname='.$dbname;
		
		try{
			$handler = new PDO($conn_str, $username, $password);
			$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			//echo $e->getMesssage();
			die("Database connection issue. Please contact your systems administrator about this message.");
		}

		#echo '<br><b>[DATABASE TEST]</b>: Database Connection Established...</br>';
		$this->handler = $handler;
		return true;
	}

	public function test() {
		echo 'Database Test Works';
		#echo $this->handler;
	}

	function getHandler() {
		return $this->handler;
	}
}
