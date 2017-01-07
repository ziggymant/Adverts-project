<?php
require_once("initialize.php");

class User extends General {

	public static $table_name = "users";

	// public static function find_by_username($username) {
	// 	global $database;
	// 	$sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
	// 	$result = $database->query($sql);
	// 	$result_set = $database->fetch_array($result);
	// 	return $result_set;
	
	// }

}



?>