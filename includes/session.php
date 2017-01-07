<?php
session_start();

class Session {

	public $errors = array();
	public $username;
	public $id;
	public $messages = array();

	public function __construct() {
		isset($_SESSION['username']) ? $this->username = $_SESSION['username'] : $this->username = "";
		isset($_SESSION['messages']) ? $this->messages = $_SESSION['messages'] : $this->message = "";
		
	}

	public function errors($error){
		$this->errors[] = $error;
	}

	public function show_errors(){
		if(!empty($this->errors)){
			foreach ($this->errors as $error) {
				echo $error;
			}
		}

	}

	public function message($message) {
		$this->messages[] = $message;
		$_SESSION['messages'] = $this->messages;

	}



	public function show_message(){
		if(!empty($this->messages)){
			foreach ($this->messages as $message) {
				echo "<div class=\"message\"><h3>". $message. "</h3></div>";
				unset($_SESSION['messages']);
			}
			
		}
	}

	public function user($username) {
		$_SESSION['username'] = $username;

	}

	public function is_logged_in() {
		global $database;
		if(isset($_SESSION['username'])){
			$user_array = User::find_by_username($_SESSION['username']);
			$existing_user = $user_array['username'];
			if($existing_user) {
				return true;
			}
		}
		else {
			return false;
		}
	}

}

$session = new Session();


?>