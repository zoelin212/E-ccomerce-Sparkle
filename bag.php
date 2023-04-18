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

    $title="Sparkle | Exquisite accessories - Bag";
    require('header.php'); 
?>

<main>

    <h2 id="bh2">- Order Summary -</h2>

    <div id="bagBox">
    <section id="bleft">
    <?php
        $subTotal = 0;
        if(isset($_SESSION['bag'])){

            $array = $_SESSION['bag'];
            $key = array_keys($array);
            $qty = array_values($array);

            $allpID = implode(',', $key);
            // print_r ($allpID);


            foreach($_SESSION['bag'] as $key => $qty){
                $query = "SELECT * FROM products WHERE id=$key ";
                $sql = mysqli_query($connection, $query);
            
                $row = mysqli_fetch_array($sql);
            
                    $total = $qty * $row['price'];
                    $subTotal += $total;
                    $image =  "thumbnail/" . $row['thumbnail_name'];

                    echo '<div class="itemBox">';

                    echo '<div class="pleft">';
                        echo '<a href="detail.php?id=' . $row['id'] . '"><img src="' . $image . '" alt="' . $row['product_name'] . '"></a>';

                        echo '<div class="ptitle">';
                            echo '<h3>' . $row['product_name'] . '</h3>';
                            echo '<p>CA$' . $row['price'] . '</p>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="pmid">';
                    echo '<a href="working.php"><i class="fa fa-heart" aria-hidden="true"></i> Save For Later</a>';
                        echo '<div class="pnum">';
                        echo '<p><sup>Qty</sup>'.$qty.'</p>';
                        echo '<p><sup>Total</sup>CA$' .$total. '</p>';
                        echo '</div>';
                    echo '</div>';

                    echo'<a href="?remove='.$key.'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    echo '</div>';
            }
        }else {
            print'<h2>Your cart is empty.</h2>';
        }
        if (isset($_SESSION['bag']) && $subTotal == 0) {
            print'<h2>Your cart is empty.</h2>';
        }
    ?>
    </section>

    <section>

        <form method="post" action="confirm.php" id="bform">

            <label for="code" id="label">Enter Promo Code</label>
            <div class="code">
            <input type="text" id="code" name="code" placeholder="Promo Code">
            <input type="button" id="apply" value="APPLY">
            </div>

        <h3>Customer Info</h3>
            <input type="text" id="cfname" name="cfname" aria-label="First Name" placeholder="First Name" required>
            <input type="text" id="clname" name="clname" aria-label="Last Name" placeholder="Last Name" required>
            <input type="email" id="email" name="email" aria-label="Email" placeholder="Email" required>

        <h3>Shipping Address</h3>
            <input type="text" id="sfname" name="sfname" aria-label="First Name" placeholder="First Name" required>
            <input type="text" id="slname" name="slname" aria-label="Last Name" placeholder="Last Name" required>

            <input type="text" id="address" name="address" aria-label="Address" placeholder="Address" required>
            <input type="text" id="city" name="city" aria-label="City" placeholder="City" required>

            <select name="province" id="province" aria-label="Province" >
                <option value="">Province</option>
                <option value="AB">Alberta</option>
                <option value="BC">British Columbia</option>
                <option value="MB">Manitoba</option>
                <option value="NB">New Brunswick</option>
                <option value="NL">Newfoundland and Labrador</option>
                <option value="NT">Northwest Territories</option>
                <option value="NS">Nova Scotia</option>
                <option value="NU">Nunavut</option>
                <option value="ON">Ontario</option>
                <option value="PE">Prince Edward Island</option>
                <option value="QC">Quebec</option>
                <option value="SK">Saskatchewan</option>
                <option value="YT">Yukon</option>
            </select>

            <input type="text" id="postal" name="postal" aria-label="Postal Code" placeholder="Postal Code " required>
            <input type="tel" id="phone" name="phone" placeholder="1234567890" aria-label="Phone Number">

            <input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal;?>">
            <input type="hidden" id="allpID" name="allpID" value="<?php echo $allpID;?>">
            

            <p class="tbd">Subtotal <span>CA$<?php echo $subTotal;?></span></p>
            <p class="tbd">Discount <span>TBD</span></p>
            <p class="tbd">Sales Tax <span>TBD</span></p>
            <p class="tbd">Total <span>TBD</span></p>

            <input type="submit" value="Continue" id="bsubmit">

        </form>

    </section>
    </div>

</main>

<?php 
    $script = '<script>
    apply.addEventListener("click",function (){
        window.location.href = "working.php";
        })
    </script>';
    require('footer.php'); 
?>