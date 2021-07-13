<?php
include "functions/function.php";

$coupon=$_POST['coupon'];
$check_coupon=mysqli_query($conn,"select * from coupon_code where coupon_title='$coupon' and status='1'");
// $rowcoupon=mysqli_fetch_assoc($check_coupon);
if(mysqli_num_rows($check_coupon)>0){
    $rowcoupon=mysqli_fetch_assoc($check_coupon);
    $getCouponDetailsById=getCouponDetailsById($rowcoupon['coupon_id']);
    $coupon_type=$getCouponDetailsById['coupon_type'];
    $coupon_value=$getCouponDetailsById['coupon_value'];
    $coupon_expire=$getCouponDetailsById['coupon_expire'];
    $cart_min_price=$getCouponDetailsById['cart_min_value'];
    date_default_timezone_set("Asia/Calcutta");
    $date=date('Y-m-d h:i:sa');
    if($date>$coupon_expire){
        $arr=array("status"=>"couponExpired","msg"=>"coupon code expired");
        echo json_encode($arr);        
    }else{
        $getCartTotalPrice=getCartTotalPrice();
        if($getCartTotalPrice>$cart_min_price){
            $coupon_code_apply=0;
            if($coupon_type=="percentage"){
                $coupon_code_apply=$getCartTotalPrice- ($coupon_value/100) * $getCartTotalPrice;
            }else{
                $coupon_code_apply=$getCartTotalPrice-$cart_min_price;
            }
            $arr=array("status"=>"success","msg"=>"coupon code applied successfully","coupon_code_apply"=>$coupon_code_apply,"totalprice"=>$getCartTotalPrice,"coupon_name"=>$coupon);
            echo json_encode($arr);
        }else{
            $arr=array("error"=>"couponValueLess","msg"=>"Cart minimum price should be ".$cart_min_price." Rs");
            echo json_encode($arr);        
        }
        
    }
}else{
    $arr=array("error"=>"couponNotExists","msg"=>$coupon." coupon code does not exists");
    echo json_encode($arr);
}
?>