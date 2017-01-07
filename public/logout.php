<?php
require_once("../includes/initialize.php");


	session_unset();
	$session->message('logged out successfuly');
	redirect_to('login.php');




?>