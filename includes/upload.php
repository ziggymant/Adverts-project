<?php
require_once("initialize.php");

class Upload extends General {
	public static $table_name = "photos";
	public $tmp_path;
	public $file_type;
	public $file_size;
	public $file_name ="";
	public $time;

	public $upload_dir= "images";

	function __construct($file){
			$this->tmp_path = $file['tmp_name'];
			$this->file_type = $file['type'];
			$this->file_size = $file['size'];
			$this->file_name = (strftime("%Y-%m-%d_%H-%M-%S", time())). "_" . basename($file['name']);

	}

	public function upload_file($ad_id) {
		$target_path = SITE_ROOT.$this->upload_dir.DS.$this->file_name;

		if(!file_exists($target_path)){
			if(move_uploaded_file($this->tmp_path, $target_path)){
				global $database;

				$sql = "INSERT INTO photos (";
				$sql .= "name, ad_id, type, size, path) ";
				$sql .= "VALUES (";
				$sql .= "'{$this->file_name}', '{$ad_id}', '{$this->file_type}', '{$this->file_size}', '{$target_path}'";
				$sql .= ")";
				$_SESSION['sql'] = $sql;
				if($database->query($sql)){
					return true;
				} else {
					$session->message("File upload failed ({$sql})");
					return true;
				}

				
			}

		} else {
			global $session;
			$session->errors("File already exist");
			return false;
		} 
	}
	 

	public static function find_img_by_ad($id) {	
		global $database;
		$sql = "SELECT * FROM photos WHERE ad_id ={$id}";
		$query = $database->query($sql);
		$img_array = array();
		while ($row = $database->fetch_array($query)) {
			$img_array[] = $row;
		}
		return $img_array;
	}

	public static function find_img_by_id($id) {	
		global $database;
		$sql = "SELECT * FROM photos WHERE id = {$id}";
		$query = $database->query($sql);
		$img_array = $database->fetch_array($query);
		return $img_array;
	}

	public function destroy($id) {
		global $database;
		$img_array = static::find_img_by_id($id);
		$target_path = $img_array['path'];
		if(static::delete($id)){
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
	}



}




?>