<?php
$page_title = "Register";
require_once("../includes/initialize.php");
include("../layout/header.php");

if(isset($_POST['submit'])){
    $username = $database->real_escape_string($_POST['username']);
    $first_name = $database->real_escape_string($_POST['first_name']);
    $last_name = $database->real_escape_string($_POST['last_name']);
    $email = $database->real_escape_string($_POST['email']);
    $password = $database->real_escape_string($_POST['password']);
    $hashed_pw = password_hash($password, PASSWORD_BCRYPT);
    $repeat = $database->real_escape_string($_POST['password2']);

    $user_array = User::find_by_username($_POST['username']); // find user if exists
    

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
      if(isset($user_array['username'])){
        $session->message("Username {$user_array['username']} already exists.");
        redirect_to('register.php');
      }
      if(isset($user_array['email'])) {
        $session->message("Email {$user_array['username']} is being used by existing user.");
        redirect_to('register.php');
      }

      global $database;
      $sql = "INSERT INTO users (";
      $sql .= "username, first_name, last_name, email, hashed_password, active";
      $sql .= ") VALUES (";
      $sql .= "'{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$hashed_pw}', 0";
      $sql .= ")";

      if ($database->query($sql)) {
        $session->message("User {$username} created successfuly");
      }else {
        $session->message("User creation failed");
      }

    } else {
      $session->message("Error: fields can not be empty!");
    }


} 

?>
    <section class="adverts">
    <?php
      $session->show_message();
    ?>
      

      <form method="post" action="register.php">
      <div class="box">
      <h1>Register</h1>

      <input type="text" name="username" value="" placeholder="Username" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />

      <input type="text" name="first_name" value="" placeholder="First name" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />

      <input type="text" name="last_name" value="" placeholder="Last name" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />

      <input type="email" name="email" value="" placeholder="Email" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
        
      <input type="password" name="password" value="" placeholder="Password" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />

      <input type="password" name="password2" value="" placeholder="Repeat Password" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
        
      <button type="submit" name="submit" class="btn">Register</button> <!-- End Btn -->

      <button id="btn2"><a href="login.php">Login</a></button> <!-- End Btn2 -->
        
      </div> <!-- End Box -->
        
      </form>

        
      

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
