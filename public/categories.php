<?php
$page_title = "Categories";
include("../layout/header.php");
require_once("../includes/initialize.php");



$message = "";

$auto = categories("'Auto'");
$slamstas = categories("'Slamstas'");

?>


      <div id="content">
        <h1> Advertisements</h1>

        <?php

        if(isset($message)){
          echo "<h3> {$message} </h3><br>";

        }

        ?>

        <ol>
            <li>Darbo skelbimai</li>
            <li><a href="ad_categories.php?category=auto">Auto skelbimai <?php echo "(". count($auto). ")"; ?> </a></li>
            <li>Buitine technika</li>
            <li><a href="ad_categories.php?category=slamstas">Slamstas <?php echo "(". count($slamstas). ")"; ?></a></li>
        </ol>

          </div>
      </div> <!-- end of div content-->

<?php
include("../layout/footer.php")

?>
