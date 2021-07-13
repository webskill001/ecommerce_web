<?php
include "includes/header.php";
include "includes/db.php";

$error_message="false";
if(isset($_POST['login'])){
    $username=$_POST['admin_username'];
    $password=$_POST['admin_password'];

    $get_admin="select * from admins where admin_username='$username' and admin_password='$password'";
    $run_admin=mysqli_query($conn,$get_admin);
    $count_admin=mysqli_num_rows($run_admin);
    if($count_admin>0){
        $_SESSION['admin']=$username;
        echo '<script>window.open("index.php?dashboard","_self")</script>';
    }else{
        $error_message="true";
    }
}

?>

<div class="container-fluid w-100 bg-success" style="height:650px;">
    <div class="row h-100">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card mt-5" style="border-radius:20px;">
                <div class="card-body">
                <div class="card-title text-center h3">Login form</div>
                <?php
                if($error_message=="true"){
                    echo '<div class="text-center"><span class=" text-danger" style="font-weight:500"><strong>Failed! </strong>Credendials do not match</span></div>';
                }
                ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="#username">Username</label>
                            <input type="text" name="admin_username" id="username" class="form-control rounded-pill" required>
                        </div>
                        <div class="form-group">
                            <label for="#password">password</label>
                            <input type="password" name="admin_password" id="password" class="form-control rounded-pill" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                        <a href="" class="ml-2"><span class="text-success">Not Already User? SignUP</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php

include "includes/footer.php";
?>