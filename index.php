<?php 
// session_start();
// if(!(isset($_SESSION['bag']))){
//     $_SESSION['bag'];
// }
$title="Sparkle | Exquisite accessories - Home";
require('header.php'); 

?>
	    <main>
            <?php
                $query1 = "SELECT * FROM hero WHERE id=1";
                $sql1 = mysqli_query($connection,$query1);
                $row1 = mysqli_fetch_array($sql1);
                $image1 =  "hero/".$row1['filename'];

                $query2 = "SELECT * FROM hero WHERE id=2";
                $sql2 = mysqli_query($connection,$query2);
                $row2 = mysqli_fetch_array($sql2);
                $image2 =  "hero/".$row2['filename'];
            ?>
            <section>
                <img src="<?php echo $image1;?>" alt="<?php echo $row1['description'];?>" class="hero">

                <div class="heroP1">
                <h2 class="sc">Jewelry</h2>
                <h3>Wear a little sparkle, and don't be afraid to shimmer a bit brighter.</h3>
                <a href="collections.php" class="button">SHOP NOW</a>
                </div>
            </section>

            <section>
                <div class="heroP2">
                <h2 class="sc">Spring Sale</h2>
                <h3>Celebrate new arrival! Pick up your exclusive deal.</h3>
                <a href="working.php" class="button">MORE</a>
                </div>

                <img src="<?php echo $image2;?>" alt="<?php echo $row2['description'];?>" class="hero">
            </section>

            <section >
                <div class="made">
                <?php
                $query3 = "SELECT * FROM products WHERE pop=1";
                $sql3 = mysqli_query($connection,$query3);
                

                while($row3=mysqli_fetch_array($sql3)){
                    //print_r($row);
                    //echo "<br>";
                    echo '<div>';
                    $image3 =  "thumbnail/".$row3['thumbnail_name'];
                    echo '<a href="detail.php?id='.$row3['id'].'"><img src="'.$image3.'" alt="'.$row3['product_name'].'" class="imgM"></a>';
                    echo '<h3>'.$row3['product_name'].'</h3>';
                    echo '<p>CA$'.$row3['price'].'</p>';
                    echo '</div>';
                }
                ?>
                </div>
            </section>

            <section>
                <?php
                $query4 = "SELECT * FROM hero WHERE id=3";
                $sql4 = mysqli_query($connection,$query4);
                $row4 = mysqli_fetch_array($sql4);
                $image4 =  "hero/".$row4['filename'];


                ?>
                <div class="herob">
                    <img src="<?php echo $image4;?>" alt="<?php echo $row4['description'];?>">
                </div>
                
                <div class="box">
                    <div class="greenblock">

                        <h2>EVERYDAY ESSENTIALS
                        <br>Elevate Any Look</h2>
                
                    </div>

                    <div class="category">
                    <?php
                    $query5 = "SELECT * FROM products WHERE pop=2";
                    $sql5 = mysqli_query($connection,$query5);
                    
                    while($row5=mysqli_fetch_array($sql5)){
                        //print_r($row);
                        echo "<div class='card'>";
                        $image5 =  "thumbnail/".$row5['thumbnail_name'];
                    
                        echo '<a href="detail.php?id='.$row5['id'].'"><img src="'.$image5.'" alt="'.$row5['product_name'].'"></a>';
                        
                        
                        echo '<h3>'.$row5['category'].'</h3>';
                        

                        echo "</div>";
                    }
                    echo "</div>";
                    ?>
                </div>
            </section>
	    </main>
<?php 
require('footer.php'); 
?>