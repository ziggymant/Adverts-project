<?php
require_once("database.php");

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function __autoload($class_name) {
  $class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
    die("The file {$class_name}.php could not be found.");
  }
}

function mysql_prep($string) {
  global $connection;
  // $connection = $connection->open_connection();
  
  $escaped_string = $connection->real_escape_string($string);
  return $escaped_string;
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}


function include_layout_template($template = ""){
  include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function log_actions($action, $message = ""){
  //does file exist?
  $dt = time();
  $time = strftime("%Y-%m-%d %H:%M:%S", $dt);
  $file = SITE_ROOT.DS."logs".DS."logs.txt";
  $content = "Time: {$time} | {$action}: {$message}".PHP_EOL;
  if($handle = fopen($file, 'a')){
      if(is_writable($file)){
          fwrite($handle, $content);
          fclose($handle);
      }
  }
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%d %B, %Y at %I:%M %p", $unixdatetime);
}

//admin logfile.php
//output logged entries
// get link to clear the log file

function categories($category) {
  $sql = "SELECT * FROM advertisements WHERE subject=".$category;

  global $database;
  $result_set = $database->query($sql);
  $result_array = array();
  while ($row = $database->fetch_array($result_set)) {
    $result_array[] = $row;
  }
  return $result_array;

}

?>