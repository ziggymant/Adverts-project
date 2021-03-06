﻿<?php
require_once("../includes/initialize.php");

$page_title = "Home";
if($session->is_logged_in()){ 
	include("../layout/user-header.php");
} else {
	include("../layout/header.php");
}



$total_ads = (int)Adverts::count_all();
$per_page = 12;
$page = (int)empty($_GET['page']) ? 1 : $_GET['page']; // how to know page no. ?

$pagination = new Pagination($page, $per_page, $total_ads);
$offset = $pagination->offset();


$sql = "SELECT * FROM advertisements ORDER BY id DESC LIMIT {$per_page} OFFSET {$offset}";

$result_set = $database->query($sql);
$result_array = array();
while ($row = $database->fetch_array($result_set)) {
  $result_array[] = $row;
}

?>



		<section class="adverts">
			<div class="ads-box">
				<h1> Advertisements (<?php echo $total_ads; ?>)</h1>


		        <?php
		        $session->show_message();
		        ?>

		        
		        <?php
		        foreach ($result_array as $advert) {
					$image = Adverts::find_image_by_id($advert['id']);

					echo 
					"<div class=\"single-ad\">
							
							<a href=\"single_ad.php?id={$advert['id']}\">
								{$advert['title']} <br>
								{$advert['price']} <br>
								({$advert['created']}) <br>
								<img style=\"width:200px; height:150px\" src=\"../images/{$image}\">
							  
							</a>
							<br>

					</div>";
		        }

		        ?>
		       	<br>
		       	<br>

		    </div>

	        <div class="side-ads">
			
			</div>
			<nav>
			<?php
	        if ($pagination->has_previous_page()){
	          	echo "<a href=\"index.php?page=". $pagination->previous_page() . "\">&laquo; Previous page  </a>";
	        } elseif($pagination->has_next_page()) {
	        	echo "<a href=\"index.php?page=". $pagination->next_page() . "\">Next page &raquo; </a>";
	        }
	        echo "<br>";
	        echo "<p id=\"pages\">Page: {$page} / {$pagination->total_pages()}</p>";
	        ?>
			</nav>

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

