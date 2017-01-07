<?php 
session_start();
require_once("../includes/database.php");
require_once("../includes/functions.php");

$id = $_GET['id'];


$sql = "DELETE FROM advertisements WHERE id={$id} LIMIT 1";

if($database->query($sql)){
	$_SESSION['message'] = "Advert was deleted successfuly";
	redirect_to('account.php');
} else {
	$_SESSION['message'] = "Error: could not delete selected advert";
	redirect_to('account.php');
}



?>