<?php
require_once("../includes/initialize.php");
$page_title = "My account";

if($session->is_logged_in()){ 
  include("../layout/user-header.php");
} else {
  $session->message('Please log in.');
  redirect_to('login.php'); 
}

$page = isset($_GET['page']) ? $_GET['page'] : "";
$user_id = User::find_by_username($session->username)['id'];

$total_ads = count(Adverts::find_by_user_id($user_id));
$per_page = 4;
$page_id = (int)empty($_GET['page_id']) ? 1 : $_GET['page_id']; // how to know page no. ?

$pagination = new Pagination($page_id, $per_page, $total_ads);
$offset = $pagination->offset();


?>



    <section class="adverts">
      <h1> User account </h1>


      <?php
        $session->show_message();
      ?>

    <h3> <?php echo "Hello ". $session->username. "!"; ?> </h3>

    <div class="user-menu">

      <ul>
        <li><a href="account.php?page=my_ads"><div class="user-btn"> My ads </div></a></li>
        <li><a href="account.php?page=all_ads"><div class="user-btn">All ads (admin option)</div></a></li>
        <li><a href="account.php?page=my_messages"><div class="user-btn">Messages</div></a></li>
        <li><a href=""><div class="user-btn">Other</div></a></li>
        
      </ul>

    </div>

    <div class="user-content">

      <?php
      if($page == "my_ads") {
        $sql = "SELECT * FROM advertisements WHERE user_id = {$user_id} ORDER BY id DESC LIMIT {$per_page} OFFSET {$offset}";
        $query = $database->query($sql);
        $ad_array = array ();
        while ($row = $database->fetch_array($query)) {
            $ad_array[] = $row;
        }
        $result_array= $database->fetch_array($query);

        foreach ($ad_array as $advert) {
          $image = Adverts::find_image_by_id($advert['id']);

          echo 
          "<div class=\"single-ad\">
              
              <a href=\"single_ad.php?id={$advert['id']}\">
                {$advert['title']} <br>
                ({$advert['created']}) <br>
                <img style=\"width:250px; height:150px\" src=\"../images/{$image}\">
                
              </a>
              <br>
              <a href=\"delete_ad.php?id={$advert['id']}\">Delete advert</a><br>
              <a href=\"edit_ad.php?id={$advert['id']}\">Edit advert</a>

          </div>";
        } ?>
          <nav>
          <?php
              if ($pagination->has_previous_page()){
                  echo "<a href=\"account.php?page=my_ads&page_id=". $pagination->previous_page() . "\">&laquo; Previous page  </a>";
              } elseif($pagination->has_next_page()) {
                echo "<a href=\"account.php?page=my_ads&page_id=". $pagination->next_page() . "\">Next page &raquo; </a>";
              }
              echo "<br>";
              echo "<p id=\"pages\">Page: {$page_id} / {$pagination->total_pages()}</p>";
              ?>
          </nav>
        <?php
      } elseif ($page == "all_ads") {
        $adverts = Adverts::find_all_ads();

        echo "<ol>";
        foreach ($adverts as $advert) {
          echo 
          " <li><a href=\"single_ad.php?id={$advert['id']}\">". $advert['title']. " (" . $advert['created'] . ")</a> 
          <a href=\"delete_ad.php?id={$advert['id']}\">Delete advert</a>
          </li> <br>";
        }
        echo "</ol>";

      } elseif($page == "my_messages") {
        $messages = Messages::find_by_user_id($user_id);

        echo "<ol>";
        foreach ($messages as $message) {
          echo 
          "<li>
          <div class=\"my-messages\">
          <a href=\"\">". $message['title']. " (" . $message['created'] . ") From: {$message['author']} </a> 
          <p> {$message['body']} </p>
          <a href=\"\">Reply</a><br>
          <a href=\"\">Delete message</a>
          </div>
          </li> 

          <br>";
        }
        echo "</ol>";

      }

      ?>
      
    </div>

          
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
