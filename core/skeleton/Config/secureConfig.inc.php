<?php
	/*!
 * _Ghst_ Framework-
 *
 * Created By: Arize V.
 * Realesd under the _ghst_ framework-
 * Copyright of N-Aspire-
 *
 * Date: 2016-07-19.
 */
	// Database Config File
	define('LOCALHOST', 'localhost');
	class Config
	{
		public function __construct($user, $password, $main, $record, $ware, $settings, $customers)
		{
			$this->dbname = $main;
			$this->dbrec = $record;
			$this->dbware = $ware;
			$this->dbsetings = $settings;
			$this->dbcustomers = $customers;
			$this->user = $user;
			$this->password = $password;
	define('USER', $this->user);
	define('PASSWORD', $this->password);
	define('MAIN', $this->dbname);
	define('RECORDS', $this->dbrec);
	define('CUSTOMERS', $this->dbcustomers);
	define('WAREHOUSE', $this->dbware);
	define('SETTINGS', $this->dbsetings);
		}
	}

?>