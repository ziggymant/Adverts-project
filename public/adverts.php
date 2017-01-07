<?php
session_start();
$page_title = "Advertisements";
include("../layout/header.php");
require_once("../includes/initialize.php");


$total_ads = (int)Adverts::count_all();
$per_page = 20;
$page = (int)empty($_GET['page']) ? 1 : $_GET['page']; // how to know page no. ?

$pagination = new Pagination($page, $per_page, $total_ads);
$offset = $pagination->offset();


$sql = "SELECT * FROM advertisements LIMIT {$per_page} OFFSET {$offset}";

$result_set = $database->query($sql);
$result_array = array();
while ($row = $database->fetch_array($result_set)) {
  $result_array[] = $row;
}

?>


      <div id="content">
        <h1> Advertisements</h1>

        <?php

        if(isset($message)){
          echo "<h3> {$message} </h3><br>";
          unset($_SESSION['message']);
        }

        ?>

        <ol>
        <?php
        foreach ($result_array as $advert) {
          echo "<li><a href=\"single_ad.php?id={$advert['id']}\"> {$advert['title']} ({$advert['created']}) </a><a href=\"delete_ad.php?id={$advert['id']}\">      Delete advert</a></li>";
        }



        ?>
        </ol>
        <?php
        if ($pagination->has_next_page()){
          echo "<a href=\"adverts.php?page=". $pagination->next_page() . "\">Next page</a>";
        } else {
          echo "error . Page: " .$page . "<br>" ;
          echo $pagination->next_page() . "<br>";
          echo $pagination->has_next_page();
        }
        ?>

        

          </div>
      </div> <!-- end of div content-->

<?php
include("../layout/footer.php")

?>
