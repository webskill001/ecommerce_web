<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    $aduser=$_SESSION['admin'];
    $getadmin="select * from admins where admin_username='$aduser'";
    $runadmin=mysqli_query($conn,$getadmin);
    $rowadmin=mysqli_fetch_assoc($runadmin);
    $ad_id=$rowadmin['admin_id'];
    $ad_name=$rowadmin['admin_name'];
    $ad_email=$rowadmin['admin_email'];
    $ad_username=$rowadmin['admin_username'];
    $ad_password=$rowadmin['admin_password'];
    $ad_job=$rowadmin['admin_job'];
    $ad_about=$rowadmin['admin_about'];
    $ad_country=$rowadmin['admin_country'];
    $ad_city=$rowadmin['admin_city'];
    $ad_contact=$rowadmin['admin_contact'];
    $ad_image=$rowadmin['admin_image'];

if(isset($_POST['update_user']))
{
    
    $adname=$_POST['a_name'];
    $ademail=$_POST['a_email'];
    $adusername=$_POST['a_username'];
    $adpass=$_POST['a_pass'];
    $adjob=$_POST['a_job'];
    $adabout=$_POST['a_about'];
    $adcountry=$_POST['a_country'];
    $adcity=$_POST['a_city'];
    $adcontact=$_POST['a_contact'];

    $adimg=$_FILES['a_img']['name'];
    $tmp_dir_img=$_FILES['a_img']['tmp_name'];

    move_uploaded_file($tmp_dir_img,"images/profile/".$adimg);
    $get_pro="update admins set admin_name='$adname',admin_email='$ademail',admin_username='$adusername',admin_password='$adpass',admin_job='$adjob',admin_about='$adabout',admin_country='$adcountry',admin_city='$adcity',admin_contact='$adcontact',admin_image='$adimg' where admin_id='$ad_id'";
    $res=mysqli_query($conn,$get_pro);
    if($res)
    {
        echo '<script>alert("Your profile has been updated successfully")</script>';
        echo '<script>window.open("logout.php","_self")</script>';
    }
}
?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Edit User Profile
        </li>
    </ol>
</nav>
<div class="card">
    <div class="bg-light w-100 p-3">
        <h3 class="text-center">Edit User Profile</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="a_name">User name</label>
                <input type="text" name="a_name" value="<?php echo $ad_name; ?>" class="form-control" id="a_name" required>
            </div>

            <div class="form-group">
                <label for="a_email">User email</label>
                <input type="email" validate name="a_email" value="<?php echo $ad_email; ?>"  class="form-control" id="a_email" required>
            </div>

            <div class="form-group">
                <label for="a_pass">User password</label>
                <input type="password" validate name="a_pass"  value="<?php echo $ad_password; ?>" class="form-control" id="a_pass" required>
            </div>

            <div class="form-group">
                <label for="a_username">User username</label>
                <input type="text" name="a_username"  value="<?php echo $ad_username; ?>" class="form-control" id="a_username" required>
            </div>

            <div class="form-group">
                <label for="a_job">User Job</label>
                <input type="text" name="a_job" value="<?php echo $ad_job; ?>"  class="form-control" id="a_job" required>
            </div>

            <div class="form-group">
                <label for="a_about">User about</label>
                <textarea name="a_about" id="a_about" cols="30" rows="4" class="form-control" required><?php echo $ad_about; ?> </textarea>
            </div>

            <div class="form-group">
                <label for="a_country">User country</label>
                <input type="text" name="a_country"  value="<?php echo $ad_country; ?>" class="form-control" id="a_country" required>
            </div>

            <div class="form-group">
                <label for="a_city">User city</label>
                <input type="text" name="a_city"  value="<?php echo $ad_city; ?>" class="form-control" id="a_city" required>
            </div>

            <div class="form-group">
                <label for="a_contact">User contact</label>
                <input type="text" name="a_contact"  value="<?php echo $ad_contact; ?>" class="form-control" id="a_contact" required>
            </div>

            <div class="form-group">
                <label for="a_img">User Image</label>
                <input type="file" name="a_img"  value="<?php echo $ad_image; ?>" class="form-control" id="a_img" required>
                <div><img src="images/profile/<?php echo $ad_image; ?>" class="reponsive-img p-2" width="60" height="70" alt=""></div>
            </div>

            <div class="text-center w-100 mt-5">
                <button class="btn btn-outline-secondary" role="submit" name="update_user" role="button"><i
                        class="fa fa-user mr-2"></i> Update User</button>
            </div>
        </form>
    </div>
</div>
                        <?php } ?>