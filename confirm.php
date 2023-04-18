<?php 
session_start();
if(!(isset($_SESSION['bag']))){
    $_SESSION['bag'];
}

    $title="Sparkle | Exquisite accessories - Bag";
    require('header.php'); 
?>

<main id="confirmMain">

    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){       
        // sent to database

            if(!isset($_POST['place'])){
            //confirm

            $cfullName = strip_tags($_POST['cfname'].' '.$_POST['clname']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            $sfullName = strip_tags($_POST['sfname'].' '.$_POST['slname']);
            $fullAddress =  strip_tags($_POST['address'].' '.$_POST['city'].' '.$_POST['province'].' '.$_POST['postal']);
            $phone = strip_tags($_POST['phone']);
            $allpID = $_POST['allpID'];

            //count price
            $province = $_POST['province'];
            $subTotal = $_POST['subTotal'];

            switch($province){
                case "AB":
                case "NT":
                case "NU":
                case "YT":
                    $tax = 0.05 + 1;
                    
                    break;
                case "BC":
                case "MB":
                    $tax = 0.12 + 1;
                    
                    break;
                case "NB":
                case "NL":
                case "Ns":
                case "PE":
                    $tax = 0.15 + 1;
                    
                    break;
                case "ON":
                    $tax = 0.13 + 1;
                    
                    break;
                case "QC":
                    $tax = 0.14975 + 1;
                    
                    break;
                case "SK":
                    $tax = 0.11 + 1;
                    
                    break;
            }

            if($subTotal< 99){
                $total = 6.99 + ($subTotal * $tax);
                $total = number_format($total,2);
            } else {
                $total = $subTotal * $tax;
                $total = number_format($total,2);
            }

            if (isset($_POST['place'])){
                echo '<div id="hidden">';
            }else {
                echo '<div id="show">'; 
            }

            echo '<h2 id="confirmH2">- Here is your order information -</h2>';

            echo '<h3>Customer Info</h3>';
            echo '<h4>Name: '.$cfullName.'</h4>';
            echo '<h4>Email: '.$email.'</h4>';


            echo '<h3>Shipping</h3>';
            echo '<h4>Name: '.$sfullName.'</h4>';
            echo '<h4>Address: '.$fullAddress.'</h4>';
            echo '<h4>Phone Number: '.$phone.'</h4>';

            echo'<h3>Total Price: '.$total.'</h3>';

            echo'<h4><a href="bag.php" id="back">Go Back</a></h4>';

            echo'<form method="post" action="">

            <input type="hidden" id="cfname" name="cfname" value="'.$_POST["cfname"].'">
            <input type="hidden" id="clname" name="clname" value="'.$_POST["clname"].'">
            <input type="hidden" id="email" name="email" value="'.$_POST["email"].'">

            <input type="hidden" id="sfname" name="sfname" value="'.$_POST["sfname"].'">
            <input type="hidden" id="slname" name="slname" value="'.$_POST["slname"].'">

            <input type="hidden" id="address" name="address" value="'.$_POST["address"].'">
            <input type="hidden" id="city" name="city" value="'.$_POST["city"].'">

            <input type="hidden" name="province" id="province" value="'.$_POST["province"].'">

            <input type="hidden" id="postal" name="postal" value="'.$_POST["postal"].'">
            <input type="hidden" id="phone" name="phone" value="'.$_POST["phone"].'">

            <input type="hidden" id="total" name="total" value="'.$total.'">

            <input type="hidden" id="$allpID" name="allpID" value="'.$_POST["allpID"].'">

            <input type="hidden" id="place" name="place" value="true">
            <input type="submit" value="Place Order">

            </form>';
        
            echo '</div>';
        // print_r($_SESSION['bag']);
        }else{
                // echo '<p>Thank you! Your order is confirmed.</p>';
                $cfname = mysqli_real_escape_string($connection,$_POST['cfname']);
                $clname = mysqli_real_escape_string($connection,$_POST['clname']);
                $email = mysqli_real_escape_string($connection,$_POST['email']);
        
                $sfname = mysqli_real_escape_string($connection,$_POST['sfname']);
                $slname = mysqli_real_escape_string($connection,$_POST['slname']);
        
                $address = mysqli_real_escape_string($connection,$_POST['address']);
                $city = mysqli_real_escape_string($connection,$_POST['city']);
                $province = mysqli_real_escape_string($connection,$_POST['province']);
                $postal = mysqli_real_escape_string($connection,$_POST['postal']);
        
                $phone = mysqli_real_escape_string($connection,$_POST['phone']);
                $total = mysqli_real_escape_string($connection,$_POST['total']);
                $allpID = mysqli_real_escape_string($connection,$_POST['allpID']);
        
                $cname = $cfname.' '.$clname;
                $sname = $sfname.' '.$slname;
                $fullAddress = $address.' '.$city.' '.$province.' '.$postal;
                
                
        
                $query = "INSERT INTO orders (customer_name,email,shipping_name,address,phone,purchased_items,total) VALUES ('$cname','$email','$sname','$fullAddress','$phone','$allpID','$total')";
        
                // print $query;
        
                if(mysqli_query($connection,$query)){
                    echo '<p class="thank">Thank you! Your order is confirmed.</p>';
                    $_SESSION['bag'] = array();
                }else{
                    echo '<p class="thank">Sorry! We were unable to process your order, please contact us, thank you.</p>';
                    // echo mysqli_error($connection);
                }
            
            } 
        }else{
                echo '<p class="thank">Invalid path!</p>';
            }
    ?>
</main>

<?php 
    // $script = '<script>
    // document.getElementById("place").addEventListener("click",function(){
    //     document.getElementById("hidden").style.display="none";
    // });
    // </script>';
    require('footer.php'); 
?>