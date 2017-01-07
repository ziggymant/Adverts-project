<?php
require_once("../includes/initialize.php");
$page_title = "My account";

if($session->is_logged_in()){ 
  include("../layout/user-header.php");
} else {
  $session->message('Please log in.');
  redirect_to('login.php'); 
}

$ad_id = $_GET['id'];
$user_array = User::find_by_username($session->username);
$user_id = $user_array['id'];

if($_POST['submit']){
    $author = $database->real_escape_string($_POST['author']);
    $created = strftime("%Y-%m-%d %H:%M:%S", time());
    $title = $database->real_escape_string($_POST['title']);
    $advert = nl2br($_POST['body']);
    $advert = $database->real_escape_string($advert);
    $subject = $database->real_escape_string($_POST['category']);
    $location = $_POST['location'];
    $currency = $_POST['currency'];
    $price = $database->real_escape_string($_POST['price']). " " .$currency;

    // $file = $_FILES['file_upload'];

    $file_array = array($_FILES['file_upload1'], $_FILES['file_upload2'], $_FILES['file_upload3']);

    // $upload = new Upload($file);

    if(!empty($_POST['author']) && !empty($_POST['body'])) {
      global $database;
      $sql = "UPDATE advertisements ";
      $sql .= "SET author = '{$author}', user_id = '{$user_id}', created = '{$created}', title = '{$title}', body = '{$advert}', subject = '{$subject}', location = '{$location}', price = '{$price}'";
      $sql .= " WHERE id = {$ad_id}";


      if ($database->query($sql)) {
        $session->message("Advert updated successfuly");
        foreach ($file_array as $file) {
          $upload = new Upload($file);
          $upload->upload_file($ad_id);
        }
        redirect_to("account.php?page=my_ads");
      }else {
        $session->message("Advert update failed");
        $session->show_errors();

      }

    } else {
      $session->message("Error: fields can not be empty!");
    }
} 
// tdelete img


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
        <li><a href=""><div class="user-btn">Acc settin</div></a></li>
        <li><a href=""><div class="user-btn">Other</div></a></li>
        
      </ul>

    </div>

    <div class="user-content">
    <?php
    $advert = Adverts::find_by_id($ad_id)[0];
    ?>

              <form action="edit_ad.php?id=<?php echo $ad_id; ?>" enctype="multipart/form-data" method="POST">
            <table>

                <input class="input" type="hidden" name="author" value="<?php echo $advert['author'];?>" />

              <tr>
                <td>Ad Title:</td>
                <td><input class="input" type="text" name="title" value="<?php echo $advert['title'];?>" /></td>
              </tr>
              <tr>
                <td>Advertisement:</td>
                <td><textarea class="input_ad" name="body" cols="40" rows="8"><?php echo $advert['body'];?></textarea></td>
              </tr>

              <tr>
                <td>Category:</td>
                <td> 
                  <select class="select" name="category">
                    <option value="Darbo_skelbimai">Darbo skelbimai</option>
                    <option value="Auto">Auto skelbimai</option>
                    <option value="Buitine">Buitine technika</option>
                    <option value="Slamstas">Slamstas</option>
                 </select>
                </td>
                </tr>
              <tr>
                <td>City:</td>
                <td> 
                  <select class="select" name="location">
                    <option value="stockholm">Stockholm</option>
                    <option value="vilnius">Vilnius</option>
                    <option value="london">London</option>
                    <option value="lentvaris">Lentvaris</option>
                 </select>
                </td>
              </tr>
              <tr>
                <td>Price:</td>
                <td><input name="price" type="text" class="input" value="<?php echo (int)$advert['price'];?>" ></td>
                <td> 
                  <select class="select" name="currency">
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="SEK">SEK</option>
                 </select>
                </td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>

              <tr>
                <td>Upload picture</td>
                <td><input class="file" type="file" name="file_upload1" /></td>
              <tr>
                <td>&nbsp;</td>
                <td><input class="file" type="file" name="file_upload2" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input class="file" type="file" name="file_upload3" /></td>
              </tr>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
              </tr>
              <tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
                <td>&nbsp;</td>
                <td><input class="submit-ad" type="submit" name="submit" value="Save changes" /></td>
              </tr>
            </table>
          </form>

          <?php
          $img_array = Upload::find_img_by_ad($ad_id);
          foreach ($img_array as $img) {

          echo 
          "<div class=\"single-ad\">
            <a href=\"delete-img.php?id={$img['id']}&advert={$_GET['id']}\"><img src=\"../img/delete.svg\"></a>
            <img style=\"width:250px; height:150px\" src=\"../images/{$img['name']}\">
          </div>";
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
