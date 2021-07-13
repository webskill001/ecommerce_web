<?php
include "includes/header.php";
include "includes/navbar.php";
if(isset($_SESSION['username'])){
?>
<div class="container-fluid">
    <div class="container pb-3">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">My Account</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="profile bg-light card-img-top" style="height:300px;">
                    <?php
                    $user=$_SESSION['username'];
                    $getuser="select * from customers where cus_username='$user'";
                    $runuser=mysqli_query($conn,$getuser);
                    $row=mysqli_fetch_assoc($runuser);
                    $img=$row['cus_image'];
                    $name=$row['cus_name'];
                    ?>
                    <img src="customer_images/profile/<?php echo $img; ?>" class="w-100 h-75 p-3" alt="" class="responsive-img"><br>
                    <p class="text-center h5 p-1" style="text-transform:capitalize"><?php echo ucwords($name); ?></p>
                    </div>
                    <div class="card-body m-0 p-2">
                        <div class="list-group">
                            <a href="myaccount.php?myorder" class="list-group-item hover <?php if(isset($_GET['myorder'])){echo "active"; }?> mb-2" style="text-decoration:none; border:none">My order</a>
                            <a href="myaccount.php?myadd" class="list-group-item hover <?php if(isset($_GET['myadd'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">My Addresses</a>
                            <a href="myaccount.php?pyoff" class="list-group-item hover <?php if(isset($_GET['pyoff'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">Pay Offline</a>
                            <a href="myaccount.php?edac" class="list-group-item hover <?php if(isset($_GET['edac'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">Edit Account</a>
                            <a href="myaccount.php?chps" class="list-group-item hover <?php if(isset($_GET['chps'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">Change Password</a>
                            <a href="myaccount.php?mywh" class="list-group-item hover <?php if(isset($_GET['mywh'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">My Wishlist</a>
                            <a href="myaccount.php?dlac" class="list-group-item hover <?php if(isset($_GET['dlac'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">Delete Account</a>
                            <a href="myaccount.php?lg" class="list-group-item hover <?php if(isset($_GET['lg'])){echo "active"; }?>  mb-2" style="text-decoration:none; border:none">Logout</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if(isset($_GET['myorder'])){
                            include "myorder.php";   
                        }
                        if(isset($_GET['myadd'])){
                            include "myadd.php";   
                        }
                        if(isset($_GET['pyoff'])){
                            include "pyoff.php";   
                        }

                        if(isset($_GET['edac']))
                        {
                            include "edac.php";   
                        }

                        if(isset($_GET['chps']))
                        {
                            include "chps.php";   
                        }

                        if(isset($_GET['mywh']))
                        {
                            include "mywh.php";   
                        }

                        if(isset($_GET['dlac']))
                        {
                            include "dlac.php";   
                        }

                        if(isset($_GET['lg']))
                        {
                            include "lg.php";   
                        }
                        if(isset($_GET['oid']))
                        {
                            include "order_history.php";   
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include "includes/footer.php";
}else{
    header("Location: ../login.php");
}
?>