<?php
require_once("../includes/initialize.php");
$page_title = "Login";
include("../layout/header.php");



if(isset($_POST['submit'])){
    $username = $database->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    
    // try to find user in db

    $user_array = User::find_by_username($username);
    $found_user = $user_array['username'];
    $hashed_password = $user_array['hashed_password'];

    if ($found_user && $hashed_password) {
	    if ($username == $found_user && password_verify($password, $hashed_password)) {
	          $session->message("Login successful");
	          $session->user($found_user);
	          redirect_to("account.php");
	    } else {
        	$session->message("Username or password incorect");
      	} 
    } else {
    	$session->message("User was not found");
    }
}



?>

		<section class="adverts">
	    <?php
	      $session->show_message();
	    ?>
			

			<form method="post" action="login.php">
			<div class="box">
			<h1>Login</h1>

			<input type="text" name="username" value="" placeholder="Username" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
			  
			<input type="password" name="password" value="" placeholder="password" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
			  
			<button type="submit" name="submit" class="btn">Log in</button> <!-- End Btn -->

			<button id="btn2"><a href="register.php">Register</a></button> <!-- End Btn2 -->

			<p>Forgot your password? <a href="" style="color:#f1c40f;">Click Here!</a></p>
			  
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

