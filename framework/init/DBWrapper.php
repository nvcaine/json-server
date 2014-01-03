<?php
/*
 * PDO Wrappper for DB access
 */
class DBWrapper
{
	static protected $host = "";
	static protected $user = "";
	static protected $pass = "";
	static protected $dbName = "";

	static protected $instace;

	private $pdo;

	protected function DBWrapper()
	{
		if($this->configured())
			$this->open();
	}

	// **************************** Singleton methods ********************************************

	static public function configure($dbHost, $username, $password, $databaseName)
	{
		DBWrapper::$host = $dbHost;
		DBWrapper::$user = $username;
		DBWrapper::$pass = $password;
		DBWrapper::$dbName = $databaseName;
	}

	static public function cloneInstance()
	{
		if(!DBWrapper::$instace)
			DBWrapper::$instace = new DBWrapper();

		return clone DBWrapper::$instace;
	}

	// **************************** Public methods ********************************************

	public function query($queryTemplate, $params = null, $class = null)
	{
		$query = $this->pdo->prepare($queryTemplate); // prepare query statement
		$query->execute($params);

		if(isset($class))
			return $query->fetchAll(PDO::FETCH_CLASS, $class); // return DTO-specific data

		return $query->fetchAll(PDO::FETCH_ASSOC); // return dynamic objects
	}

	// **************************** Private methods ********************************************

	private function open()
	{
		try
		{
			$this->pdo = new PDO("mysql:host=".DBWrapper::$host.";dbname=".DBWrapper::$dbName, DBWrapper::$user, DBWrapper::$pass);
    		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}
    	catch(PDOException $e)
    	{
    		echo "PDO Error:" . $e->getMessage();
    	}

    	DBWrapper::$instace = $this;

	}

	private function configured()
	{
		return (isset(DBWrapper::$host) && isset(DBWrapper::$user) && isset(DBWrapper::$pass) && isset(DBWrapper::$dbName));
	}
}
?>