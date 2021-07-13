
<?php
@session_start();
$conn=mysqli_connect("localhost" ,"root","","ecommerce_web") or die('failed');
    $user=$_SESSION['username'];
    $checkuser="select * from customers where cus_username='$user'";
    $runuser=mysqli_query($conn,$checkuser);
    $row=mysqli_fetch_assoc($runuser);
    $cus_name=$row['cus_name'];
    $cus_email=$row['cus_email'];
    $cus_username=$row['cus_username'];
    $cus_country=$row['cus_country'];
    $cus_city=$row['cus_city'];
    $cus_address=$row['cus_address'];
    $cus_contact=$row['cus_contact'];
    $cus_image=$row['cus_image'];

if(isset($_POST['update'])){
    $c_name=$_POST['c_name'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_address=$_POST['c_address'];
    $c_contact=$_POST['c_contact'];
    if($_FILES['c_img']['name']!=""){
        $c_image=$_FILES['c_img']['name'];
        $image_dir=$_FILES['c_img']['tmp_name'];
        move_uploaded_file($image_dir,"customer_images/profile/".$c_image);
    }
    $updatecus="update customers set cus_name='$c_name',cus_country='$c_country',cus_city='$c_city',cus_address='$c_address',cus_contact='$c_contact' ";
    if($_FILES['c_img']['name']!=""){
        $updatecus.=",cus_image='$c_image'";
    }else{
        $updatecus="update customers set cus_name='$c_name',cus_country='$c_country',cus_city='$c_city',cus_address='$c_address',cus_contact='$c_contact' where cus_username='$user'";
    }
    $updatecus=" where cus_username='$user'";
    $runcus=mysqli_query($conn,$updatecus);
    echo "<script>alert('profile updated successfully');</script>";
    echo '<script>window.open("../logout.php","_self");</script>';

}
?>


                    <h3 class="text-center">Edit Your Profile</h3>
                    <form action="edac.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="c_name">Customer Name</label>
                            <input type="text" required name="c_name" value="<?php echo $cus_name; ?>" class="form-control" id="c_name">
                        </div>
                        <div class="form-group">
                            <label for="c_email">Customer Email</label>
                            <input type="email" required validate name="c_email" value="<?php echo $cus_email; ?>" class="form-control" id="c_email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="c_username">Customer Username</label>
                            <input type="text" required name="c_username" value="<?php echo $cus_username; ?>" class="form-control" id="c_username" readonly>
                        </div>
                        <div class="form-group">
                            <label for="c_country">Customer country</label>
                            <input type="text" required name="c_country" value="<?php echo $cus_country; ?>" class="form-control" id="c_country">
                        </div>
                        <div class="form-group">
                            <label for="c_city">Customer city</label>
                            <input type="text" required name="c_city" value="<?php echo $cus_city; ?>" class="form-control" id="c_city">
                        </div>
                        <div class="form-group">
                            <label for="c_address">Customer address</label>
                            <input type="text" required name="c_address" value="<?php echo $cus_address; ?>" class="form-control" id="c_address">
                        </div>
                        <div class="form-group">
                            <label for="c_contact">Customer Contact</label>
                            <input type="text" required name="c_contact" value="<?php echo $cus_contact; ?>" class="form-control" id="c_contact">
                        </div>
                        <div class="form-group">
                            <label for="c_image">Customer Image</label>
                            <input type="file" name="c_img" value="<?php echo $c_image; ?>" class="form-control" id="c_image">
                            <div class="text-danger ml-3">It is optional field.</div>
                        </div>
                        <img src="customer_images/profile/<?php echo $cus_image; ?>" class="responsive-img" alt="" style="height:70px;width:70px;">
                        <div class="text-center w-100 mt-5">
                            <button class="btn btn-coupon" name="update" role="submit"><i class="fa fa-user mr-2"></i>
                                Update Now</button>
                        </div>
                    </form>