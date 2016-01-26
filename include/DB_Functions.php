<?php

class DB_Functions
{
	private $db;
	
	// constructor
	function __construct()
	{
		require_once 'DB_Connect.php';
		// connecting to database
		$this->db = new DB_Connect();
		$this->db->connect();
	}
	
	// destructor
	function __destruct()
	{
		
	}
	
	// 添加用户信息
	public function storeUser($name, $email, $password)
	{
		$uuid = uniqid('', true);
		$hash = $this->hashSSHA($password);
		$encrypted_password = $hash["encrypted"]; // 加密后的密文
		$salt = $hash["salt"];
		$result = mysqli_query($this->db->con, "INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at) VALUES('$uuid', '$name', '$email', '$encrypted_password', '$salt', NOW())");		
		// 检查结果
		if ($result)
		{
			// 获取用户信息
			$uid = mysqli_insert_id($this->db->con); // 获取最新的id
			$result = mysqli_query($this->db->con, "SELECT * FROM users WHERE uid=$uid");
			// 返回刚插入的用户信息
			return mysqli_fetch_array($result);
		}
		else
		{
			return false;
		}
	}

    /**
     * 通过email和password获取用户信息
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysqli_query($this->db->con,"SELECT * FROM users WHERE email = '$email'") or die(mysqli_connect_errno());
        // check for result 
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysqli_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password
            if ($encrypted_password == $hash) {
                return $result;
            }
        } else {
            return false;
        }
    }
 
    /**
     * 通过email判断用户是否存在
     */
    public function isUserExisted($email) {
        $result = mysqli_query($this->db->con,"SELECT email from users WHERE email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // 用户存在
            return true;
        } else {
            //用户不存在
            return false;
        }
    }
 
    /**
     * 加密
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * 解密
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
 
}

?>