<?php  
include "includes/db.php";

function getOrderDetails($cid){
    global $conn;
    $get_orders="select * from orders where customer_id='$cid'";
    $run_orders=mysqli_query($conn,$get_orders);
    $data=array();
    while($row_order=mysqli_fetch_assoc($run_orders)){
        $data[]=$row_order;
    }
    return $data;
    
}

//
function getProDetailsById($pid){
    global $conn;
    $getprod="select products.product_name,product_categories.product_cat_name,categories.cat_name ,products.product_img1,products.product_keyword,products.product_desc from products,product_categories,categories where product_categories.product_cat_id=products.product_p_cat_id and categories.cat_id=products.product_cat_id";
    $runprod=mysqli_query($conn,$getprod);
    $rowprod=mysqli_fetch_assoc($runprod);
    return $rowprod;
}

function getCusDetailsById($id){
    global $conn;
    $getuser="select cus_name,cus_email,cus_username,cus_country,cus_city,cus_address,cus_contact from customers where cus_id='$id'";
    $runuser=mysqli_query($conn,$getuser);
    $row_user=mysqli_fetch_assoc($runuser);
    return $row_user;
}

function getProductAttrById($aid){
    global $conn;
    $getattr="select product_size,product_color,product_price from product_attribute where attribute_id='$aid'";
    $runattr=mysqli_query($conn,$getattr);
    $row_attr=mysqli_fetch_assoc($runattr);
    return $row_attr;
}

function getUserSetting(){
    global $conn;
    $get_setting=mysqli_fetch_assoc(mysqli_query($conn,"select * from setting where setting_id='1'"));
    return $get_setting;
}

function getOrderById($oid){
    global $conn;
    $get_orders="select orders.*,order_status.status,deliveryboy.name,deliveryboy.contact_no,customers.cus_name,customers.cus_email,customers.cus_username,customers.cus_country from
    orders,customers ,order_status,deliveryboy where customers.cus_id=orders.customer_id and order_status.id=orders.order_status and orders.order_id='$oid'";
    return $row_order=mysqli_fetch_assoc(mysqli_query($conn,$get_orders));
}

function getDeliveryBoyById($oid){
    global $conn;
    $get_orders="select deliveryboy.name,deliveryboy.contact_no from
    orders,deliveryboy where deliveryboy.id=orders.deliveryboy_id and orders.order_id='$oid'";
    return $row_order=mysqli_fetch_assoc(mysqli_query($conn,$get_orders));
}

function getOrderStatus(){
    global $conn;
    return mysqli_fetch_all(mysqli_query($conn,"select * from order_status"),MYSQLI_ASSOC);
}

function getOrderDetailsById($oid){
    global $conn;
    $get_order_attr="select products.product_name,products.product_img1,product_attribute.product_size,product_attribute.product_color,product_attribute.product_price,order_details.qty from products,product_attribute,order_details where products.product_id=order_details.product_id and product_attribute.attribute_id=order_details.attribute_id and order_details.order_id='$oid'";
    $attr=array();
    $attr=mysqli_fetch_all(mysqli_query($conn,$get_order_attr),MYSQLI_ASSOC);
    return $attr;
}

?>