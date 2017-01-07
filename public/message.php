<?php
require_once("../includes/initialize.php");
$page_title = "My account";

if($session->is_logged_in()){ 
  include("../layout/user-header.php");
} else {
  $session->message('Please log in.');
  redirect_to('login.php'); 
}


$title = $_POST['title'];
$body = $_POST['body'];
$to_id = Adverts::find_by_id($_GET['ad_id'])[0]['user_id'];
$from_id = User::find_by_username($session->username)['id'];
$created = strftime("%Y-%m-%d %H:%M:%S", time());

if($_POST['submit']) {
	$sql = "INSERT INTO messages (to_id, user_id, title, body, created, author) ";
	$sql .= "VALUES ({$to_id}, {$from_id}, '{$title}', '{$body}', '{$created}', '{$session->username}')";
  if($database->query($sql)){
    $session->message("Your message has been sent");
    redirect_to("single_ad.php?id={$_GET['ad_id']}");
  }
  else {
    $session->message("Your message could not be sent");
  }
}



?>

    <section class="adverts">
      <h1> User account </h1>

      <?php
        $session->show_message();
      ?>

    <div class="message-content">

          <form action="message.php?ad_id=<?php echo $_GET['ad_id'];?>" method="POST">
            <table>

                <input class="input" type="hidden" name="author" value="<?php echo $session->username;?>" />

              <tr>
                <td>Title:</td>
                <td><input class="input" type="text" name="title" value="" /></td>
              </tr>
              <tr>
                <td>Message:</td>
                <td><textarea class="input_ad" name="body" cols="40" rows="8"></textarea></td>
              </tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input class="submit-ad" type="submit" name="submit" value="Submit Message" /></td>
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
