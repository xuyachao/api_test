<?php

/**
 * 用于连接数据库的类
 *
 */
class DB_Connect
{
	public $con;
	
	function __construct()
	{
		
	}
	
	function __destruct()
	{
		
	}
	
	// 连接数据库
	public function connect()
	{
		require_once 'Config.php';
		// 连接mysql
		$this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_error($this->con));
		if (mysqli_connect_errno())
		{
			die("Database connection failed");
		}
		
		// 返回database handler
		return $this->con;
	}
	
	// 关闭数据库连接
	public function close()
	{
		mysqli_close($this->con);
	}
}

?>