<?php
require_once("initialize.php");

class General {

public static $table_name;

public static function search($search) {
	global $database;
	$sql = "SELECT * FROM advertisements WHERE title LIKE '%$search%' or body LIKE '%$search%' ORDER BY id  ";
	$result = $database->query($sql);

	$ads_array = array ();
	while($row=$database->fetch_array($result)){
		$ads_array[] = $row;
	}
	return $ads_array;
}

public static function delete($id){
	global $database;
	$sql = "DELETE FROM ". static::$table_name. " WHERE id = {$id}";
	$query = $database->query($sql);
	if($query){
		return true;
	}
}

public static function find_by_id($id){
	global $database;
	$sql = "SELECT * FROM ". static::$table_name. " WHERE id = {$id}";
	$result = $database->query($sql);
	$array = array ();
	while($row=$database->fetch_array($result)){
		$array[] = $row;
	}
	return $array;
}

public static function find_by_user_id($id){
	global $database;
	$sql = "SELECT * FROM ". static::$table_name. " WHERE user_id = {$id} ORDER BY id DESC";
	$result = $database->query($sql);
	$array = array ();
	while($row=$database->fetch_array($result)){
		$array[] = $row;
	}
	return $array;
}

	public static function find_by_username($username) {
		global $database;
		$sql = "SELECT * FROM ". static::$table_name. " WHERE username = '{$username}' LIMIT 1";
		$result = $database->query($sql);
		$result_set = $database->fetch_array($result);
		return $result_set;
	
	}



}



?>