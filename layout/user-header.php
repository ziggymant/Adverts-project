<?php

$pages = array (
"logout.php" => "Log out",
"account.php"=> "My account",
"index.php"=> "Help",
"create_ad.php" => "Post ad"
);

?>


<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title><?php echo $page_title ?></title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/user.css">
  <link rel="stylesheet" href="styles/slider.css">

  <script src="js/jquery-1.8.0.min.js"></script>
  <script src="js/search.js"></script>
  
  <?php
  if($page_title == "Login" || $page_title == "Register") {
    echo  "<link rel=\"stylesheet\" href=\"styles/login-form.css\">";
  }
  ?>


  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>



  <div class="header">
    <div class="inner-header">
      <nav class="header-nav">
        <ul>
          <li class="logo"><a href="index.php"><img src="../img/wv.svg"></a></li>
          <?php
          foreach ($pages as $link => $page) {
            if($page == $page_title){
              echo "<li class=\"drop\"><a class=\"selected\" href=\"{$link}\">{$page}</a>";
                if($page == "My account"){
                  echo "<div class=\"menu-drop\">
                    <ul>
                      <li><a href=\"\">Manage my ads</a></li>
                      <li><a href=\"\">Messages</a></li>
                      <li><a href=\"\">Favourites</a></li>
                      <li><a href=\"\">My details</a></li>
                    </ul>
                  </div>";
                }

              echo "</li>";
            } elseif($page == "My account") {
              echo "<li class=\"drop\"><a href=\"{$link}\">{$page}</a>

                <div class=\"menu-drop\">
                  <ul>
                    <li><a href=\" \">Manage my ads</a></li>
                    <li><a href=\" \">Messages</a></li>
                    <li><a href=\" \">Favourites</a></li>
                    <li><a href=\" \">My details</a></li>
                  </ul>
                </div>

              </li>";
            }else {
              echo "<li><a href=\"{$link}\">{$page}</a></li>";
            }
          }
          ?>

        </ul>
      </nav>

    </div> <!-- end inner_header-->
    <div class="header-bottom">
      <div class="inner-header">
        <div class="header-search">
          <div class="search-field">
          <form action="search_result.php" method="POST">
            <ul>
              <li>
                <select name="category" class="select-ad">
                    <option value="Darbo skelbimai">All</option>
                    <option value="Darbo skelbimai">Darbo skelbimai</option>
                    <option value="Auto">Auto skelbimai</option>
                    <option value="Buitine">Buitine technika</option>
                    <option value="Slamstas">Slamstas</option>
                </select>
              </li>
              <li>
                <input name="search_field" id="searchid" class="search" type="search" placeholder="Search">
                <div id="result"></div>
              </li>
              <li>
                <input name="location" class="search2" type="search" placeholder="Location">
              </li>
              <li>
                <button name="submit" class="button" type="submit">Search</button>
              </li>
                

          </form>
          </div>
        </div>
        
      </div>
      
    </div>
  </div> <!-- end of header -->

  <div class="category-header">
    <div class="categories">
      <ul>
        <li><a href="ad_categories.php?category=auto">Auto</a></li>
        <li><a href="ad_categories.php?category=slamstas">Slamstas</a></li>
        <li><a href="ad_categories.php?category=buitine">Buitine technika</a></li>
        <li><a href="ad_categories.php?category=darbo_skelbimai">Darbo skelbimai</a></li>
        <li><a href="">Placeholder</a></li>
      </ul>
    </div>
    
  </div> <!-- end of category header -->

  <main class="content-main">
    <div class="banner">
      <?php 
      if($page_title != "My account") {
      echo "<img src=\"../img/banner3.jpg\">";
      } else {
        echo "";
      }
      ?>

    </div> <!--end banner-->