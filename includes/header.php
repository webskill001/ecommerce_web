
<?php
include "functions/function.php";
$currStr=$_SERVER['REQUEST_URI'];
$currArr=explode('/',$currStr);
$curr_path=$currArr[count($currArr)-1];
$arr = explode('?',$curr_path);
$curr_path = $arr[0];
$title="";
if($curr_path=="index.php"){
    $title="Welcome";
}else if($curr_path=="shop.php"){
    $title="Shop Page";
}else if($curr_path=="details.php"){
    $title="Details Page";
}else if($curr_path=="cart.php"){
    $title="Cart Page";
}else if($curr_path=="payment.php"){
    $title="Payment Page";
}else if($curr_path=="checkout.php"){
    $title="Checkout Page";
}else if($curr_path=="login.php"){
    $title="Login Page";
}else if($curr_path=="order.php"){
    $title="Order Page";
}else if($curr_path=="register.php"){
    $title="Register Page";
}else if($curr_path=="myaccount.php"){
    $title="Myaccount Page";
}
$cartTotalItem=itcount();
$getCartTotalPrice=getCartTotalPrice();
$getUserSetting=getUserSetting();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title."-".WEBSITE_NAME; ?></title>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>