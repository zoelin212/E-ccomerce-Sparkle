<?php 
session_start();
if(!(isset($_SESSION['bag']))){
    $_SESSION['bag'];
}

if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['bag'][$id]);
    header('location:bag.php');
}

$title="Sparkle | Exquisite accessories - Search";
require('header.php'); 
?>

<main>
    <?php
    $search = strip_tags($_POST['search']);
    // echo $search;
    
    $query = "SELECT * FROM products WHERE product_name like '%$search%' || color = '%$search%' ";

    $sql = mysqli_query($connection, $query);
            
           
    // mysqli_num_rows($sql) = how many rows in search result
            if(mysqli_num_rows($sql) > 0){
                echo '<div class="container">';
                while ($row = mysqli_fetch_array($sql)) {

                    if(mysqli_num_rows($sql) == 1){
                        echo '<div class="box1">';
                    }else if(mysqli_num_rows($sql) == 2){
                        echo '<div class="box2">';
                    }else if(mysqli_num_rows($sql) == 3){
                        echo '<div class="box3">';
                    }else if(mysqli_num_rows($sql) == 4){
                        echo '<div class="box4">';
                    }else if(mysqli_num_rows($sql) > 4 ){
                        echo '<div class="boxAll">';
                    }
                    
                    
                    $image =  "thumbnail/" . $row['thumbnail_name'];
                    $data = getimagesize("$image");
                    $width = $data[0];
                    $height = $data[1];
                    echo '<a href="detail.php?id=' . $row['id'] . '"><img src="' . $image . '" alt="'.$row['product_name'].'" class="imgL" width="'.$width.'" height="'.$height.'"></a>';

                    echo '<div class="boxBottom">';
                    echo '<h3>' . $row['product_name'] . '</h3>';
                    echo '<i class="fa fa-heart" aria-hidden="true"></i>';
                    echo '</div>';

                    echo '<p>CA$' . $row['price'] . '</p>';


                    echo '</div>';

                }
                echo '</div>';
            }
            else if(mysqli_num_rows($sql) == 0){
                    echo '<p class="no">No Result</p>';
            }

                
    
            
    
    
    ?>
</main>


<?php 
require('footer.php'); 
?>