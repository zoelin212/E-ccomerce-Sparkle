<?php
//session_start();
if(!(isset($_SESSION['bag']))){
    session_start();
}else {
    $_SESSION['bag'];
}
    //Connect to the database
    $server = "localhost";
    $database = "";
    $user = "";
    $pass = "";

    $connection = mysqli_connect($server,$user,$pass,$database);

    if(!$connection){
        //If we can't connect, print an error
        die(mysqli_connect_error());
    }

    if(isset($_SESSION['bag']) && is_array($_SESSION['bag'])) {
        $num_items_in_bag = 0;
        foreach($_SESSION['bag'] AS $productId => $itemQuanity) {
            $num_items_in_bag = $num_items_in_bag + $itemQuanity;
        }
    }
    else {
        $num_items_in_bag = 0;
    }
    // echo $num_items_in_bag

    // $num_items_in_bag = isset($_SESSION['bag']) ? count($qty) : 0;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet"  href="styles.css">
        <script src="https://kit.fontawesome.com/6fa380ccb2.js" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <div class="announcement">
            <p>FREE SHIPPING on orders CA$99+</p>
        </div>
        <header>
        <div id="headerTop">

            <ul class="burgar_btn">
                <li><a href="#"><i class="fas fa-bars"></i></a>
                    <div class="navHideBox">
                    <ul>
                        <li>
                        <img src="user.svg" alt="Your account">
                        <a href="working.php">My Account</a></li>

                        <li id="lineUp"><a href="index.php">Home</a></li>
                        <li><a href="working.php">About Us</a></li>
                        <li><a href="collections.php">Collections</a></li>
                        <li><a href="working.php">Contact Us</a></li>
                        <li><a href="working.php">FAQs</a></li>
                    </ul>
                    </div>
                </li>
            </ul>


            <form method="post" action="search.php">
                <button type="submit" class="searchButton">
                <i class="fa fa-search fa-2x" aria-hidden="true" id="searchicon"></i></button>
                <input type="text" class="search" id="search" name="search" aria-label="Search" placeholder="Search">
            </form>

            <h1><a href="index.php"><img src="logo.svg" alt="Sparkle's logo" class="logo"></a></h1>

            <div id="iconRight">
                <a href="like.php"><img src="later.svg" alt="Save for later">
                <span id="likeNum" class="num_items"><?php 
                if($_COOKIE['wishCookie']=== ""){
                    $coundNum = "0";
                    echo $coundNum;
                }else{
                    $wishCookie = $_COOKIE['wishCookie'];
                    $wishCookie = explode(",", $wishCookie);
                    echo count($wishCookie);
                }
                
                ?></span></a>
                <a href="bag.php"><img src="bag.svg" alt="My bag">
                <span class="num_items"><?php echo $num_items_in_bag;?></span></a>
                <a href="working.php" class="userSvg"><img src="user.svg" alt="Your account"></a>
            </div>
        </div>

            
            
            <nav>
                <a href="index.php">Home</a>
                <a href="working.php">About Us</a>
                <a href="collections.php">Collections</a>
                <a href="working.php">Contact Us</a>
                <a href="working.php">FAQs</a>
            </nav>
        </header>
