<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{ 
if(isset($_POST['add_user']))
{
    
    $adname=$_POST['a_name'];
    $ademail=$_POST['a_email'];
    $adusername=$_POST['a_username'];
    $adpass=$_POST['a_pass'];
    $adcpass=$_POST['a_cpass'];
    $adjob=$_POST['a_job'];
    $adabout=$_POST['a_about'];
    $adcountry=$_POST['a_country'];
    $adcity=$_POST['a_city'];
    $adcontact=$_POST['a_contact'];

    $adimg=$_FILES['a_img']['name'];
    $tmp_dir_img=$_FILES['a_img']['tmp_name'];

    if($adpass===$adcpass){
        move_uploaded_file($tmp_dir_img,"images/profile/".$adimg);
        $get_pro="INSERT INTO admins (admin_name,admin_email,admin_username,admin_password,admin_job,admin_about,admin_country,admin_city,admin_contact,admin_image) values('$adname','$ademail','$adusername','$adpass','$adjob','$adabout','$adcountry','$adcity','$adcontact','$adimg')";
        $res=mysqli_query($conn,$get_pro);
        if($res)
        {
            echo '<script>alert("User account has been created successfully")</script>';
            echo '<script>window.open("index.php?view_user","_self")</script>';
        }
    }else{
        echo '<script>alert("Passwords do not match.")</script>';
        echo '<script>window.open("index.php?insert_user")</script>';
    }
}
?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Add New User
        </li>
    </ol>
</nav>
<div class="card">
    <div class="bg-light w-100 p-3">
        <h3 class="text-center">Add New User</h3>
    </div>
    <div class="card-body">
        <form id="forminsertuser" method="post">
            <div class="form-group">
                <label for="a_name">User name</label>
                <input type="text" name="a_name" class="form-control" id="a_name">
            </div>

            <div class="form-group">
                <label for="a_email">User email</label>
                <input type="email" validate name="a_email" class="form-control" id="a_email">
            </div>

            <div class="form-group">
                <label for="a_pass">User password</label>
                <input type="password" validate name="a_pass" class="form-control" id="a_pass">
                <div id="error_password" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="a_cpass">User confirm password</label>
                <input type="password" validate name="a_cpass" class="form-control" id="a_cpass">
            </div>

            <div class="form-group">
                <label for="a_username">User username</label>
                <input type="text" name="a_username" class="form-control" id="a_username">
                <div id="error_username" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="a_job">User Job</label>
                <input type="text" name="a_job" class="form-control" id="a_job">
            </div>

            <div class="form-group">
                <label for="a_about">User about</label>
                <textarea name="a_about" id="a_about" cols="30" rows="4" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="a_country">User country</label>
                <input type="text" name="a_country" class="form-control" id="a_country">
            </div>

            <div class="form-group">
                <label for="a_city">User city</label>
                <input type="text" name="a_city" class="form-control" id="a_city">
            </div>

            <div class="form-group">
                <label for="a_contact">User contact</label>
                <input type="text" name="a_contact" class="form-control" id="a_contact">
            </div>

            <div class="form-group">
                <label for="a_img">User Image</label>
                <input type="file" name="a_img" class="form-control" id="a_img">
            </div>

            <div class="text-center w-100 mt-5">
                <button class="btn btn-outline-secondary" type="submit" name="add_user"><i
                        class="fa fa-user mr-2"></i> Insert New User</button>
            </div>
        </form>
    </div>
</div>
<?php }  ?>