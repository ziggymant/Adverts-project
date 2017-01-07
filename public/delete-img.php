<?php 
require_once("../includes/initialize.php");

// must have an ID
if(empty($_GET['id'])) {
  $session->message("No photograph ID was provided.");
  redirect_to("edit_ad.php?id={$_GET['advert']}");
}


if(Upload::destroy($_GET['id'])) {
  $session->message("Image has been deleted");
  redirect_to("edit_ad.php?id={$_GET['advert']}");
} else {
  $session->message("Error: image could not be deleted");
  redirect_to("edit_ad.php?id={$_GET['advert']}");
}