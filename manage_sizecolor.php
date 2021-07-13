<?php
include "includes/db.php";
if($_POST['type']=="size"){
    $pro_size=$_POST['pro_size'];
    $pro_id=$_POST['pro_id'];
    $arr=array();
    $arr1=array();
    //echo "select * from product_attribute where product_id='$pro_id' and product_size='$pro_size'";
    $get_color=mysqli_query($conn,"select * from product_attribute where product_id='$pro_id' and product_size='$pro_size'");
    if(mysqli_num_rows($get_color)>0){
        foreach($get_attr=mysqli_fetch_all($get_color,MYSQLI_ASSOC) as $key=>$list){
            $arr[]=$list['product_color'];
        }
    }
    $arr1=array("array"=>$arr,"count"=>count($arr));
    echo json_encode($arr1);
}
if($_POST['type']=="color"){
    $pro_size=$_POST['pro_size'];
    $pro_id=$_POST['pro_id'];
    $pro_color=$_POST['pro_color'];
    $get_price=mysqli_query($conn,"select product_price from product_attribute where product_id='$pro_id' and product_size='$pro_size' and product_color='$pro_color'");
    if(mysqli_num_rows($get_price)>0){
        $row_price=mysqli_fetch_assoc($get_price);
        echo $pro_price=$row_price['product_price'];
    }else{
        echo "NA";
    }
}

?>