<?php 
session_start();
if(!(isset($_SESSION['bag']))){
    $_SESSION['bag'];
}

if(isset($_GET['action']) == 'add'){
    $qty = $_POST['qty'];
    $id = $_GET['id'];

    if(isset($_SESSION['bag'][$id])){
        // $old = $_SESSION['bag'][$id]['qty'];
        // $_SESSION['bag'][$id] = array('id'=> $id,'qty'=> $old + $qty);
        $_SESSION['bag'][$id] += $qty;

    }else { 
        // $_SESSION['bag'][$id] = array('id'=> $id,'qty'=> $qty);
        $_SESSION['bag'][$id] = $qty;
    }
    
}
// echo"<pre>";
// print_r($_SESSION['bag']);
// echo"</pre>";

$title="Sparkle | Exquisite accessories - Collections";
require('header.php'); 
?>
<main id="dmain">


    <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM products WHERE id=$id";
        $sql = mysqli_query($connection,$query);
        $row = mysqli_fetch_array($sql);

        $image =  "fullsize/".$row['fullsize_name'];
    ?>

    <img src="<?php echo $image;?>" class="dimg" alt="<?php echo $row['product_name'];?>">

    <div class="dright">
        <h2 class="dh2"><?php echo $row['product_name'];?></h2>
        <h3 class="dh3">CA$<?php echo $row['price'];?></h3>
        
        <form method="post" id="form" action="detail.php?action=add&id=<?php echo $row['id'];?>">
            <input type="hidden" id="pId" name="pId" value="<?php echo $row['id'];?>">
            <input type="number" id="qty" name="qty" min="1" step="1" required value="1" aria-label="Qty">
            <input type="submit" id="add" value="ADD TO BAG">
            <!-- <input type="button" id="buy" value="BUY IT NOW"> -->
        </form>
    <hr id="deHr">
        <div class="info">
            <p class="bold"><i class="fa fa-truck fa-2x" aria-hidden="true"></i>Delivery</p>
            <ul>
                <li>Standard Shipping: CA$6.99</li>
                <li>FREE on orders CA$99.00+</li>
            </ul>
            <p class="bold">Description & Details: </p>
            <?php echo $row['product_description'];?>
            <p class="bold">Materials: 
            <?php echo $row['materials'];?></p>
            <p><a href="working.php">-See Return Policy-</a></p>
        </div>
    </div>

</main>


<?php 
$script ='<script>
buy.addEventListener("click",function (){
    window.location.href = "working.php";
    })
</script>';
require('footer.php'); 
?>