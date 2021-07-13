<?php
include "includes/header.php";
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
if($getUserSetting['website_status']=="Close"){
    header("Location: shop.php");
}
include "includes/navbar.php";

$getCartTotalPrice=getCartTotalPrice();
if($getCartTotalPrice <= $getUserSetting['cart_min_price']){
    $_SESSION['cart_min_message']=$getUserSetting['cart_min_message'];
    header("Location: cart.php");
}
?>


<div class="container-fluid">
    <div class="container pt-3">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">shop</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <?php
                include "includes/sidebar.php";
                ?>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-5">Payment Options</h3>
                        <?php
                        $user=$_SESSION['username'];
                        $get_user="select * from customers where cus_username='$user'";
                        $run_user=mysqli_query($conn,$get_user);
                        $row=mysqli_fetch_assoc($run_user);
                        $cus_id=$row['cus_id'];
                        $cus_email=$row['cus_email'];
                        echo '<h5 class="text-center"><a href="order.php?c_id='.$cus_id.'">Pay Offline</a></h5>';
                        ?>
                        
                        <h5 class="text-center mt-4"><a href="">Pay Using Paypal
                            <div class="card-img-bottom float-center w-100 px-5" style="height:200px;width:300px;"><img src="img/product_images/paypal.jpg"  class="w-100 h-100 responsive-img" alt=""></div>
                        </a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>