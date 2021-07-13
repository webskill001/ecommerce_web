<?php
include "includes/header.php";
include "includes/navbar.php";
@include "includes/_constant.php";
    $c_name="";
    $c_email="";
    $c_pass="";
    $c_cpass="";
    $c_username="";
    $c_contact="";
    $c_country="";
    $c_city="";
    $c_address="";
    $c_image="";
    $usernameTaken="false";
    $emailTaken="false";
    $emailsent="false";
    $passwordNotMatch="false";
    if(isset($_POST['register'])){
        $c_name=$_POST['c_name'];
        $c_email=$_POST['c_email'];
        $c_pass=$_POST['c_pass'];
        $c_cpass=$_POST['c_cpass'];
        $c_username=$_POST['c_username'];
        $c_contact=$_POST['c_contact'];
        $c_country=$_POST['c_country'];
        $c_city=$_POST['c_city'];
        $c_address=$_POST['c_address'];
        $c_image=$_FILES['c_image']['name'];
        $c_image_dir=$_FILES['c_image']['tmp_name'];
        $c_ip=getUserIP();
        if($c_pass===$c_cpass){
            $check_cus_username="select * from customers where cus_username='$c_username'";
            $run_cus_username=mysqli_query($conn,$check_cus_username);
            if(mysqli_num_rows($run_cus_username)>0){
                $usernameTaken= "true";
            }else{
                $check_cus_email="select * from customers where cus_email='$c_email'";
                $run_cus_email=mysqli_query($conn,$check_cus_email);
                if(mysqli_num_rows($run_cus_email)>0){
                    $emailTaken= "true";
                }else{
                    $c_pass=password_hash($c_pass,PASSWORD_BCRYPT);
                    move_uploaded_file($c_image_dir,'customer/customer_images/profile/'.$c_image);
                    $cus_reg="INSERT INTO `customers` (`cus_name`, `cus_email`, `cus_password`, `cus_username`, `cus_country`, `cus_city`, `cus_address`, `cus_contact`,`cus_ip`, `cus_image`, `time&date`) VALUES ('$c_name', '$c_email', '$c_pass', '$c_username', '$c_country', '$c_city', '$c_address','$c_contact','$c_ip',  '$c_image', current_timestamp())";
                    $run_cus_reg=mysqli_query($conn,$cus_reg);
                    if($run_cus_reg){
                        $emailsent="true";
                        $cus_id=mysqli_insert_id($conn);
                        $body=WEBSITE_PATH."verify.php?id=".$cus_id;
                        $emailsent="true";
                        smtp_mailer($c_email,"Please verify your email id.",$body);
                        header("Location: register.php");
						die();
                    }
                } 
            }
        }else{
            $passwordNotMatch="true";
        }
        
    }
?>

<div class="container-fluid">
    <div class="container">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">Customer Registration</li>
            </ol>
        </nav>
        <div class="card">
        <div class="bg-light w-100 p-3">
                    <h3 class="text-center">Customer Registration</h3>
                    
                </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="c_name">Customer Name</label>
                        <input type="text" required name="c_name" value="<?php echo $c_name; ?>" class="form-control" id="c_name">
                    </div>
                    <div class="form-group mb-0">
                        <label for="c_email">Customer Email</label>
                        <input type="email" required validate name="c_email" value="<?php echo $c_email; ?>"  class="form-control" id="c_email">
                    </div>
                    <?php
                    if($emailTaken=="true"){
                        echo '<div class="text-danger mb-2"><strong>Failed!</strong> Email id already taken.</div>'; 
                            $emailTaken=="false";  
                    }
                    ?>

                    <div class="form-group mb-0">
                        <label for="c_username">Customer Username</label>
                        <input type="text" name="c_username" value="<?php echo $c_username; ?>"  class="form-control" id="c_username">
                    </div>
                    <?php
                    if($usernameTaken=="true"){
                        echo '<div class="text-danger mb-2"><strong>Failed!</strong>  Username Already Taken Please Try With Different Username.</div>';
                    }
                    ?>
                    <div class="form-group mb-0">
                        <label for="c_pass">Customer Password</label>
                        <input type="password" name="c_pass" value="<?php echo $c_pass; ?>"  class="form-control" id="c_pass">
                    </div>
                    <?php
                    if($passwordNotMatch=="true"){
                        echo '<div class="text-danger mb-2"><strong>Failed!</strong>  Passwords Don Not Match.</div>';   
                    }
                    ?>

                    <div class="form-group">
                        <label for="c_cpass">Confirm Password</label>
                        <input type="password" name="c_cpass" value="<?php echo $c_cpass; ?>"  class="form-control" id="c_cpass">
                    </div>
                    <div class="form-group">
                        <label for="c_contact">Customer Contact</label>
                        <input type="text" name="c_contact" value="<?php echo $c_contact; ?>"  class="form-control" id="c_contact">
                    </div>
                    <div class="form-group">
                        <label for="c_country">Customer Country</label>
                        <input type="text" name="c_country"  value="<?php echo $c_country; ?>" class="form-control" id="c_country">
                    </div>
                    <div class="form-group">
                        <label for="c_city">Customer city</label>
                        <input type="text" name="c_city" value="<?php echo $c_city; ?>"  class="form-control" id="c_city">
                    </div>
                    <div class="form-group">
                        <label for="c_address">Customer address</label>
                        <input type="text" name="c_address" value="<?php echo $c_address; ?>"  class="form-control" id="c_address">
                    </div>
                    <div class="form-group">
                        <label for="c_image">Customer Image</label>
                        <input type="file" name="c_image"  value="<?php echo $c_image; ?>" class="form-control" id="c_image">
                    </div>
                    <div class="text-center w-100 mt-5">
                    <button class="btn btn-coupon" role="submit" name="register"><i class="fa fa-user mr-2"></i> Register</button>
                    </div>
                    
                </form>
                <?php if($emailsent=="true"){
                        echo '<div class="text-danger mb-2">We will sent an confirmation email on <strong>'.$c_email.'</strong></div>';
                    } ?>
            </div>
        </div>
    </div>
</div>
<?php

include "includes/footer.php";
?>