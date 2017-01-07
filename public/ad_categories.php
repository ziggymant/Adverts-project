<?php
require_once("../includes/initialize.php");
$page_title = "Home";
if($session->is_logged_in()){ 
  include("../layout/user-header.php");
} else {
  include("../layout/header.php");
}






//categories
$category = "'".$_GET['category']. "'";
$cat = $_GET['category'];
$count = count(categories($category));
$per_page = 8;
$page = (int)empty($_GET['page']) ? 1 : $_GET['page']; // how to know page no. ?

$pagination = new Pagination($page, $per_page, $count);
$offset = $pagination->offset();


$sql = "SELECT * FROM advertisements WHERE subject = {$category} ORDER BY id DESC LIMIT {$per_page} OFFSET {$offset}";
$result_set = $database->query($sql);
$result_array = array();
while ($row = $database->fetch_array($result_set)) {
  $result_array[] = $row;
}

//end categories


?>
    <section class="adverts">
      <h1> Ads category: <?php echo $_GET['category'] . " (". $count .")";?> </h1>

          <?php

          if ($pagination->has_previous_page()){
              echo "<a href=\"ad_categories.php?page=". $pagination->previous_page() . "&category={$cat}"."\">&laquo; Previous page  </a>";
          } elseif($pagination->has_next_page()) {
            echo "<a href=\"ad_categories.php?page=". $pagination->next_page() ."&category={$cat}" ."\">Next page &raquo; </a>";
          } 
          if($pagination->total_pages() > 1) {
          echo "<br>";
          echo "<p id=\"pages\">Page: {$page} / {$pagination->total_pages()}</p>";            
          }

          echo "<br>";

          ?>

          
          <?php
          foreach ($result_array as $advert) {
        $image = Adverts::find_image_by_id($advert['id']);

        echo 
        "<div class=\"single-ad\">
            
            <a href=\"single_ad.php?id={$advert['id']}\">
              {$advert['title']} <br>
              ({$advert['created']}) <br>
              <img style=\"width:250px; height:150px\" src=\"../images/{$image}\">
              
            </a>
            <br>

        </div>";
          }

          ?>
          <br>
          <br>
          <?php

          if ($pagination->has_previous_page()){
              echo "<a href=\"ad_categories.php?page=". $pagination->previous_page() . "&category={$cat}"."\">&laquo; Previous page  </a>";
          } elseif($pagination->has_next_page()) {
            echo "<a href=\"ad_categories.php?page=". $pagination->next_page() ."&category={$cat}". "\">Next page &raquo; </a>";
          } 
          echo "<br>";
          echo "<p id=\"pages\">Page: {$page} / {$pagination->total_pages()}</p>";            
          
          ?>





    </section> <!-- end of section adverts -->

    <section class="bottom-section">
      <div>
        bottom section /categories
      </div>
      <div class="search-tags">
        search tags
      </div>
      

    </section><!-- end of section bottom  -->
    

  </main>

<?php
include("../layout/footer.php")

?>
