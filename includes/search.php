<?php
require_once("../includes/initialize.php");
if(isset($_POST['search'])) {
    $q = $database->real_escape_string($_POST['search']);
    $strSQL_Result = $database->query("SELECT id, title FROM advertisements WHERE title LIKE '%$q%' or body LIKE '%$q%' ORDER BY id LIMIT 6");
    while($row=$database->fetch_array($strSQL_Result))
    {
        $title   = $row['title'];
        $id = $row['id'];
        ?>
            <div class="show" align="left">
                <a href="single_ad.php?id=<?php echo $id; ?>" class="name"><?php echo $title; ?></a>
            </div>
        <?php
    }
} else {
    // sth
}
?>