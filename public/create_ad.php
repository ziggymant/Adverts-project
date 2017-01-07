<?php
require_once("../includes/initialize.php");
$page_title = "Post ad";
if($session->is_logged_in()){ 
  include("../layout/user-header.php");
} else {
  include("../layout/header.php");
}

$max_file_size = 1048576;   // expressed in bytes
                            //     10240 =  10 KB
                            //    102400 = 100 KB
                            //   1048576 =   1 MB
                            //  10485760 =  10 MB
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
    $price = $database->real_escape_string($_POST['price'])." Eur";
    // $file = $_FILES['file_upload'];

    $file_array = array($_FILES['file_upload1'], $_FILES['file_upload2'], $_FILES['file_upload3']);

    // $upload = new Upload($file);

    if(!empty($_POST['author']) && !empty($_POST['body'])) {
      global $database;
      $sql = "INSERT INTO advertisements (";
      $sql .= "author, user_id, created, title, body, subject, location, price";
      $sql .= ") VALUES (";
      $sql .= "'{$author}', '{$user_id}', '{$created}', '{$title}', '{$advert}', '{$subject}', '{$location}', '{$price}'";
      $sql .= ")";

      if ($database->query($sql)) {
        $session->message("Advert uploaded successfuly");
        $ad_id = $database->insert_id();
        foreach ($file_array as $file) {
          $upload = new Upload($file);
          $upload->upload_file($ad_id);
        }
      }else {
        $session->message("Advert upload failed");
        $session->show_errors();

      }

    } else {
      $session->message = "Error: fields can not be empty!";
    }
}


?>


    <section class="adverts">
        <h1> Upload your advertisement</h1>

        <?php
        $session->show_message();
        // if(isset($_SESSION['sql'])){echo $_SESSION['sql'];} //for testing
        ?>

          <form action="create_ad.php" enctype="multipart/form-data" method="POST">
            <table>

                <input class="input" type="hidden" name="author" value="<?php echo $session->username;?>" />

              <tr>
                <td>Ad Title:</td>
                <td><input class="input" type="text" name="title" value="" /></td>
              </tr>
              <tr>
                <td>Advertisement:</td>
                <td><textarea class="input_ad" name="body" cols="40" rows="8"></textarea></td>
              </tr>

              <tr>
              	<td>Category:</td>
              	<td> 
              		<select name="category">
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
                  <select name="location">
                    <option value="stockholm">Stockholm</option>
                    <option value="vilnius">Vilnius</option>
                    <option value="london">London</option>
                    <option value="lentvaris">Lentvaris</option>
                 </select>
                </td>
              </tr>
              <tr>
                <td>Price:</td>
                <td><input name="price" type="text" value="" ></td>
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
                  <?php
                  if($session->is_logged_in()) {
                    echo " <td><input class=\"submit-ad\" type=\"submit\" name=\"submit\" value=\"Submit Advert\" /></td>";
                  } else {
                    echo "<td><h3>Please log in in order to submit your ad</h3> </td>";
                  }

                  ?>
                </tr>
            </table>
          </form>


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
