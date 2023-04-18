<?php 
session_start();
if(!(isset($_SESSION['bag']))){
    $_SESSION['bag'];
}

    $title="Sparkle | Exquisite accessories";
    require('header.php'); 
?>

<main class="wmain">

    <h2 id="wh2">- We are currently working on it. -</h2>

</main>
<?php 
    require('footer.php'); 
?>