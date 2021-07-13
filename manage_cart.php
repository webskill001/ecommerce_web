<?php  
include "functions/function.php";
if($_POST['type']=="addToCart"){
    $size=$_POST['size'];
    $color=$_POST['color'];
    $qty=$_POST['qty'];
    $pro_id=$_POST['pid'];
    $ip_add=getUserIP();
    $prodpre="select * from addcart where product_id='$pro_id' and ip_address='$ip_add'";
    $res=mysqli_query($conn,$prodpre);
    if(mysqli_num_rows($res)>0){
        $arr=array("error"=>"itemAlreadyPresent");
        echo json_encode($arr);
    }else{
        if(isset($_SESSION['size']) && isset($_SESSION['color'])){
            $color=$_SESSION['color'];
            $size=$_SESSION['size'];
            unset($_SESSION['size']);
            unset($_SESSION['color']);
        }
        $totalprice=0;
        $resattr=mysqli_query($conn,"select attribute_id from product_attribute where product_id='$pro_id' and product_color='$color' and product_size='$size'");
        $rowattr=mysqli_fetch_assoc($resattr);
        
        $attr_id=$rowattr['attribute_id'];
        $getprodcart="insert into addcart (product_id,ip_address,qty,attribute_id) values('$pro_id','$ip_add','$qty','$attr_id')";
        $res=mysqli_query($conn,$getprodcart);
        $prodpre="select * from addcart where ip_address='$ip_add' order by 1 desc";
        $res1=mysqli_query($conn,$prodpre);
        $count=mysqli_num_rows($res1);
        $rowcart=mysqli_fetch_assoc($res1);
            $pro_id=$rowcart['product_id'];
            $attr_id=$rowcart['attribute_id'];
            $qty=$rowcart['qty'];
            $getpro=mysqli_query($conn,"select * from products where product_id='$pro_id'");
            $rowpro=mysqli_fetch_assoc($getpro);
            $img1=$rowpro['product_img1'];
            $pname=$rowpro['product_name'];
            $getattr=mysqli_query($conn,"select * from product_attribute where attribute_id='$attr_id'");
            $rowattr=mysqli_fetch_assoc($getattr);
            $pprice=$rowattr['product_price'];
            $getCartTotalPrice=getCartTotalPrice();
            $arr=array("totalitem"=>$count, "totalprice"=>$getCartTotalPrice,"success"=>"itemadded","product_img"=>$img1,"product_name"=>$pname,"product_qty"=>$qty,"product_price"=>$pprice);
            echo json_encode($arr);
    }
    
}

?>