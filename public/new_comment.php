<?php
include("../layout/header.php");
$page_title = "Create ad";
require_once("../includes/initialize.php");


if($_POST['submit']){
    $author = $session->username;
    $created = strftime("%Y-%m-%d %H:%M:%S", time());
    $ad_id = $database->real_escape_string($_POST['ad_id']);
    $comment = $database->real_escape_string($_POST['comment']);


    if(!empty($_POST['comment'])) {
      global $database;
      $sql = "INSERT INTO comments (";
      $sql .= "author, created, ad_id, comments";
      $sql .= ") VALUES (";
      $sql .= "'{$author}', '{$created}', '{$ad_id}', '{$comment}'";
      $sql .= ")";

      if ($database->query($sql)) {
        $session->message("Comment has been saved");
        redirect_to("single_ad.php?id={$_POST['ad_id']}");

      }else {
        $session->message("Error: comment was not saved");
      }

    } else {
      $session->message("Error: fields can not be empty!");
      echo $_POST['author'] . $_POST['comment'] . $_SESSION['username'];
    }


}


?>

      <div id="content">
        <h1> Create a new comment</h1>

        <?php
        // $session->show_message();

        ?>

          <form action="new_comment.php" method="post">
            <table>
              <tr>
                <td>Comment:</td>
                <td><textarea name="comment" cols="40" rows="8"></textarea></td>
                <td><input type="hidden" name="ad_id" value="<?php echo $_GET['id']; ?>" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Submit Comment" /></td>
              </tr>
            </table>
          </form>
          </div>
        </div> <!-- end of div content-->

<?php
include("../layout/footer.php")

?>
