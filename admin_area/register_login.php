<?php
include "includes/db.php";
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

// $adimg=$_FILES['a_img']['name'];
// $tmp_dir_img=$_FILES['a_img']['tmp_name'];
$checkuser=mysqli_num_rows(mysqli_query($conn,"select * from admins where admin_username='$adusername'"));
if($checkuser>0){
    $arr=array('status'=>'error','message'=>'username already exists','field'=>'error_username');
    echo json_encode($arr);
}else{
    if($adpass===$adcpass){
        $arr1="passwords do not match";
        echo arr1;
    }
}

?>