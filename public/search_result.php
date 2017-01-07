<?php
require_once("../includes/initialize.php");
$page_title = "Search result";
if($session->is_logged_in()){ 
	include("../layout/user-header.php");
} else {
	include("../layout/header.php");
}





$search = $database->real_escape_string($_POST['search_field']);
$location = $database->real_escape_string($_POST['location']);
$category = $_POST['category'];

$count = count(General::search($search));
$per_page = 10;
$page = (int)empty($_GET['page']) ? 1 : $_GET['page']; // how to know page no. ?
$pagination = new Pagination($page, $per_page, $count);
$offset = $pagination->offset();

$sql = "SELECT * FROM advertisements WHERE title LIKE '%$search%' or body LIKE '%$search%' ORDER BY id LIMIT {$per_page} OFFSET {$offset}  ";
$result = $database->query($sql);

$ads_array = array ();
while($row=$database->fetch_array($result)){
	$ads_array[] = $row;
}







?>
		<section class="adverts">
			<h1> Search results of "<?php echo $search. "\" (" . $count . ")"; ?> </h1>

	        <?php
	        $session->show_message();
	        ?>

	        <?php
			foreach ($ads_array as $ad) {
				$image = Adverts::find_image_by_id($ad['id']);
				$body = substr($ad['body'], 0 , 300);
				$body = preg_replace( "/\r|\n/", "", $body );
				echo 
				"<a href=\"single_ad.php?id={$ad['id']}\" >
					<div id=\"search-listing\">
						<div id=\"search-img\">
							<img src=\"../images/{$image}\"> 
						</div>

						<div id=\"search-content\">
							<h3>{$ad['title']}</h3>
							<p>{$ad['created']}</p>
							<p> {$body} </p>
						</div>
					</div>
				</a>";
				
			}

	        ?>
	       	<br>
	       	<br>
	        <?php
	        if ($pagination->has_previous_page()){
	          	echo "<a href=\"search_result.php?page=". $pagination->previous_page() . "\">&laquo; Previous page  </a>";
	        } elseif($pagination->has_next_page()) {
	        	echo "<a href=\"search_result.php?page=". $pagination->next_page() . "\">Next page &raquo; </a>";
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

