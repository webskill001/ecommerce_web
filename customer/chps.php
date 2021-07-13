<?php
@include "includes/db.php";
if(isset($_POST['update'])){
    $opass=$_POST['c_opass'];
    $npass=$_POST['c_npass'];
    $ncpass=$_POST['c_cnpass'];
    $user=$_SESSION['username'];
    $getpass="select * from customers where cus_username='$user' and cus_password='$opass'";
    $runpass=mysqli_query($conn,$getpass);
    if(mysqli_num_rows($runpass)>0){
        if($npass===$ncpass){
            $updatecus="update customers set cus_password='$npass' where cus_username='$user'";
            $runuser=mysqli_query($conn,$updatecus);
            echo '<script>alert("Password changed successfully");</script>';
            echo '<script>window.open("lg.php","_self");</script>';
        }else{
            echo '<script>alert("Your New password and Confirm new password do not match");</script>';
            echo '<script>window.open("myaccount.php?chps","_self");</script>';    
        }
    }else{
        echo '<script>alert("Old password do not match");</script>';
        echo '<script>window.open("myaccount.php?chps","_self");</script>';
    }
}
?>

<h3 class="text-center">Change Your Password</h3>
<form action="chps.php" method="post">
    <div class="form-group">
        <label for="c_opass">Enter Your Current Password</label>
        <input type="password" name="c_opass" class="form-control" id="c_opass">
    </div>
    <div class="form-group">
        <label for="c_npass">Enter Your New Password</label>
        <input type="password" name="c_npass" class="form-control" id="c_npass">
    </div>
    <div class="form-group">
        <label for="c_cnpass">Confirm New Password</label>
        <input type="password" name="c_cnpass" class="form-control" id="c_cnpass">
    </div>
    <div class="text-center w-100 mt-5">
        <button class="btn btn-coupon" name="update" role="submit"><i class="fa fa-user mr-2"></i>
            Update Now</button>
    </div>
</form>