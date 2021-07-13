<?php
include "functions/function.php";

echo orderemail("sumit","7878","1");die();
$getOrderDetailsById=getOrderDetailsById(1);
print_r($getOrderDetailsById);die();
if(!isset($_SESSION['username'])){
    echo '<script>window.open("login.php","_self");</script>';
}
if(isset($_POST['make_payment'])){
    print_r($_POST);
}

?>