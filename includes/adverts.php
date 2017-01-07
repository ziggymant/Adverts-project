<?php
require_once("initialize.php");

class Adverts extends General {

	public static $table_name = "advertisements";

	public static function count_all() {
		global $database;
		$sql = "SELECT COUNT(*) FROM advertisements";
		$result_set = $database->query($sql);
		$result_array = $database->fetch_array($result_set);
		return array_shift($result_array);
	}

	 //don't need this  because adverts inherit from general
	// public static function find_by_id($id) {
	// 	global $database;
	// 	$sql = "SELECT * FROM advertisements WHERE id = '{$id}' LIMIT 1";
	// 	$query = $database->query($sql);
	// 	$array = $database->fetch_array($query);
	// 	return $array;
	// }

	public static function find_image_by_id($id) {
		global $database;
		$img_sql = "SELECT * FROM photos WHERE ad_id = {$id} LIMIT 1";
		$img_query = $database->query($img_sql);
		$array = $database->fetch_array($img_query);
		if(!empty($array['name'])) {
			return $array['name'];
		} else {
			return "default2.jpg";
		}

	}

	public static function find_all_ads() {
		global $database;
		$sql = "SELECT * FROM advertisements ORDER BY id DESC";
        $query = $database->query($sql);
        $ad_array = array ();
        while ($row = $database->fetch_array($query)) {
            $ad_array[] = $row;
        }
        return $ad_array;
	}

}



?>