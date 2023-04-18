<?php 
session_start();
if(!(isset($_SESSION['bag']))){
    $_SESSION['bag'];
}




$title="Sparkle | Exquisite accessories - Wishlist";
require('header.php'); 
?>

<main>
<h2 id="likeh2">- My Wishlist -</h2>
<?php
if(!isset($_COOKIE['wishCookie']) || $_COOKIE['wishCookie']=="") {
    echo'<h3 id="emptyh2">It is empty here.</h3>';

  } else {
    //print_r($_COOKIE['wishCookie']);
    $wishCookie = $_COOKIE['wishCookie'];
    $wishCookie = explode(",", $wishCookie);
    echo'<div class="likeBox">';
    foreach ($wishCookie as $value) {
        $query = "SELECT * FROM products WHERE id= $value ";
                $sql = mysqli_query($connection, $query);
            
                $row = mysqli_fetch_array($sql);
            
                    $image =  "thumbnail/" . $row['thumbnail_name'];

                    echo '<div class="likeItem">';

                    echo '<div class="pleft">';
                        echo '<a href="detail.php?id=' . $row['id'] . '"><img src="' . $image . '" alt="' . $row['product_name'] . '"></a>';

                        echo '<div class="ptitle">';
                            echo '<h3>' . $row['product_name'] . '</h3>';
                            echo '<p>CA$' . $row['price'] . '</p>';
                        echo '</div>';
                    echo '</div>';

                    

                    echo'<button class="unlikeBtn" data-product-id="' . $row['id'] . '"><i class="fa fa-times" aria-hidden="true"></i></button>';
                    echo '</div>';
                    echo'<br>';
    }
    echo'</div>';
  }


?>


</main>

<?php 
echo '<script src="like.js"></script>';
require('footer.php'); 
?>