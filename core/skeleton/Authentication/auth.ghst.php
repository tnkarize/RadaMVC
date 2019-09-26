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
	class auth
	{
		private $properties = array();
		public $dbname;
		public function __construct($n)
		{
			$this->dbname = $n;
		}
		function __get($property)
		{
			return $this->properties[$property];
		}
		function __set($property, $value)
		{
			$this->properties[$property]=$value;
		}
		public function getCredentials($n, $p, $d, $dbtable, $path)
		{
			$n = addslashes($n);
			$p = addslashes($p);
			$n = trim($n);
			$p = trim($p);
			$this->dbname .= ".".$dbtable;
			$q = "select name, password from ".$this->dbname." where name = ? && password = ?";
			$this->check_credentials($q, $d, $n, $p, $path);
		
		}
		public function check_credentials($q, $d, $n, $p, $path)
		{
			$r = $d->prepare($q); 
			$r->bind_param("ss", $n, $p);
			$r->execute();
			$r->bind_result($rr, $rw);
			$r->store_result();
			$l = $r->num_rows;
			if($l == 1)
			{
			    $q1 = 'UPDATE credentials set ip = "'.long2ip(ip2long($_SERVER['REMOTE_ADDR']) & ip2long("255.255.0.0")).'" where Name = "'.$n.'"';
			  if($d->query($q1))
			  {
				$_SESSION['login_user'] = $n;
				header("location: $path");
			}
			}
			else
			{	
			
				echo 'credentials invalid';
			}
			$r->close();
		}
		public function verify_credentials($d, $dbtable, $path)
		{
		$this->dbname .= ".".$dbtable;
		$query = "select name from ".$this->dbname." where name = ?";
		$result = $d->prepare($query);
		$result->bind_param("s", $_SESSION['login_user']);
		$result->execute();
		$result->bind_result($lg);
		$result->fetch();
		if(!isset($lg))
		{
		
			header("location: $path");
			exit();
		}
		}
	}
?>