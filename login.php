<?php
include "includes/header.php";
include "includes/navbar.php";
$c_username="";
$c_pass="";
$emailnotverify="false";
$accountdeactivate="false";
if(!isset($_SESSION['username']))
{

    $loginfailed="false";
    if(isset($_POST['login'])){
        $c_username=$_POST['c_username'];
        $c_pass=$_POST['c_pass'];
        $check_cus_username="select * from customers where cus_username='$c_username'";
        $run_cus_username=mysqli_query($conn,$check_cus_username);

        if(mysqli_num_rows($run_cus_username)>0){
            $row=mysqli_fetch_assoc($run_cus_username);
            if(password_verify($c_pass,$row['cus_password'])){
                $checkaccount="select * from customers where cus_username='$c_username' and status='1'";
                $resaccount=mysqli_query($conn,$checkaccount);
                if(mysqli_num_rows($resaccount)){
                    $checkemail="select * from customers where cus_username='$c_username' and email_status='1'";
                    $resemail=mysqli_query($conn,$checkemail);
                    $rowcus=mysqli_fetch_assoc($resemail);
                    if(mysqli_num_rows($resemail)){
                        $_SESSION['username']=$c_username;
                        $_SESSION['cid']=$rowcus['cus_id'];
                        echo '<script>window.open("checkout.php","_self");</script>';
                    }else{
                        $emailnotverify="true";
                    }
            }else{
                $accountdeactivate="true";
            }
                
                
            }else{
                $loginfailed="true";
            }
            
        }else{
            $loginfailed="true";
        }
    }
?>

<div class="container-fluid">
    <div class="container">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">Customer Login</li>
            </ol>
        </nav>
        <div class="card">
        <div class="bg-light w-100 p-3">
                    <h3 class="text-center">Customer Login</h3>
                    <?php
                    if($loginfailed=="true")
                    {
                        echo '<div class="text-danger text-center">
                        <strong>Failed!</strong> Credendials Do Not Match.</div>';
                            $loginfailed=="false";
                    }
                    if($emailnotverify=="true")
                    {
                        echo '<div class="text-danger text-center">
                        <strong>Failed!</strong> email id not verified.</div>';
                            $emailnotverify=="false";
                    }
                    if($accountdeactivate=="true")
                    {
                        echo '<div class="text-danger text-center">
                        <strong>Failed!</strong> Your account has been deactivated.</div>';
                            $emailnotverify=="false";
                    }
                    ?>
                </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="c_username">Customer Username</label>
                        <input type="text" name="c_username" value="<?php echo $c_username; ?>" class="form-control" id="c_username">
                    </div>
                    <div class="form-group">
                        <label for="c_pass">Customer Password</label>
                        <input type="password" name="c_pass"  value="<?php echo $c_pass; ?>" class="form-control" id="c_pass">
                    </div>
                    <div class="text-center w-100 mt-5">
                    <button class="btn btn-coupon" role="submit" name="login"><i class="fa fa-sign-in mr-2"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

include "includes/footer.php";
}else{
    echo '<script>window.open("index.php","_self");</script>';
}
?>