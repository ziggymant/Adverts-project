<?php
require_once("../includes/initialize.php");
$page_title = "My account";

if($session->is_logged_in()){ 
  include("../layout/user-header.php");
} else {
  $session->message('Please log in.');
  redirect_to('login.php'); 
}



// find adds
$ad_id = $_GET['id'];
$sql = "SELECT * FROM advertisements WHERE id={$ad_id} LIMIT 1";

$ad_query = $database->query($sql);
$ad_array1 = array();

foreach ($ad_query as $key => $value) {
  $ad_array1[] = $value;
}
$ad_array = $ad_array1[0];


// find comments
$comm_sql = "SELECT * FROM comments WHERE ad_id={$ad_id} ORDER BY id DESC";
$comm_query = $database->query($comm_sql);
$comm_array = array();
while ($row = $database->fetch_array($comm_query)) {
  $comm_array[] = $row;
}
// find images
$img_sql = "SELECT * FROM photos WHERE ad_id ={$ad_id}";
$img_query = $database->query($img_sql);
$img_array = array();
while ($row = $database->fetch_array($img_query)) {
  $img_array[] = $row;
}

?>


      <div id="content">
        <h1> Advertisements</h1>

        <?php
        $session->show_message();
        ?>

        <div class="advert-box">
        <?php
          echo "<h3>Advert title: {$ad_array['title']}</li>";
          echo "<p>Category: {$ad_array['subject']}</p>";
          echo "<p>Location: ". ucfirst($ad_array['location']). "</p>";
          echo "<p>Created: {$ad_array['created']}</p>";
          echo "<p>Price: {$ad_array['price']}</p>";
          echo "<p>Author: {$ad_array['author']}</p>";
          echo "<p>Advert: </p> <p> {$ad_array['body']} </p>";
          ?>
          <div><a href="message.php?ad_id=<?php echo $ad_id; ?>">Message advertiser</a></div>
          <br><hr>
          <div class="ad_images">
          <?php
        foreach ($img_array as $img) {
          echo "<img style=\"width:200px\" src=\"../images/{$img['name']}\">";
        }
        ?>

          </div> <!-- end images-->
          <hr>
        </div>
        

        <h1> Comments </h1>

        <?php 
        foreach ($comm_array as $comment) {
          echo "Author: ". $comment['author']. "<br>";
          echo "Created: ". $comment['created'] . "<br>";
          echo "Comment: ". $comment['comments'] . "<br><hr>";
        }
        ?>
        <br>
        <?php
        if($session->is_logged_in()) {
            echo "<a href=\"new_comment.php?id={$_GET['id']}\"> Write a acomment </a>";
            echo "<br>"; 
        } else {
            echo "<h3> Write a comment (only for registert users) </h3>"; 
            echo "<br>";         
        }

        ?>

          </div>
      </div> <!-- end of div content-->

<?php
include("../layout/footer.php")

?>
