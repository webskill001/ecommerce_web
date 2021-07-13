<?php
include "includes/db.php";
include "includes/_constant.php";

function getUserIP(){
    switch(true){
        case (!empty($_SERVER['HTTP_X_REAL_IP'])): return $_SERVER['HTTP_X_REAL_IP'];

        case (!empty($_SERVER['HTTP_CLIENT_IP'])): return $_SERVER['HTTP_CLIENT_IP'];

        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])): return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default : return $_SERVER['REMOTE_ADDR'];
    }
}


function getUserSetting(){
    global $conn;
    $get_setting=mysqli_fetch_assoc(mysqli_query($conn,"select * from setting where setting_id='1'"));
    return $get_setting;
}


function addcart(){
    global $conn;
    if(isset($_POST['add_cart'])){
        $pro_id=$_GET['addcart'];
        $ip_add=getUserIP();
        $p_qty=$_POST['product_quantity'];
        $p_size=$_POST['product_size'];
        $prodpre="select * from addcart where product_id='$pro_id' and ip_address='$ip_add'";
        $res=mysqli_query($conn,$prodpre);
        if(mysqli_num_rows($res)>0){
            echo '<script>swal("Error message!", "This is item already in your cart", "error")</script>';
        }else{
            if(isset($_SESSION['size']) && isset($_SESSION['color'])){
                $color=$_SESSION['color'];
                $size=$_SESSION['size'];
                unset($_SESSION['size']);
                unset($_SESSION['color']);
            }
            $resattr=mysqli_query($conn,"select attribute_id from product_attribute where product_id='$pro_id' and product_color='$color' and product_size='$size'");
            $rowattr=mysqli_fetch_assoc($resattr);
            $attr_id=$rowattr['attribute_id'];
            $getprodcart="insert into addcart (product_id,ip_address,qty,size,attribute_id) values('$pro_id','$ip_add','$p_qty','$p_size','$attr_id')";
            $res=mysqli_query($conn,$getprodcart);
            echo '<script>swal("Success message!", "New item has been added to your cart", "success")</script>';
        }
        echo "<script>window.open('details.php?pro_id=$pro_id','_self')</script>";  
    }
}



function itcount(){
    global $conn;
    $ip=getUserIP();
    $getitem="select * from addcart where ip_address='$ip'";
    $res=mysqli_query($conn,$getitem);
    $count=mysqli_num_rows($res);
    return $count;
}

function getprod($endpoint){
    global $conn;
    $getUserSetting=getUserSetting();
    $get_prod="select * from products rand order by product_id limit 0,$endpoint";
    $res=mysqli_query($conn,$get_prod);
    if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
            $product_id=$row['product_id'];
            $product_name=$row['product_name'];
            $product_img=$row['product_img1'];
            $product_price=$row['product_price'];
            $product_keyword=$row['product_keyword'];
            ?>
            <div class="col col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-img-top text-center">
                            <a href="details.php?pro_id=<?php echo $product_id; ?>"><img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$product_img; ?>" alt="" style="width:253px;height:290px;" class="responsive-img img-thumbnail"></a>
                        </div>
                        <div class="card-body p-1 py-3" style="text-align:center;">
                            <a href="details.php?pro_id=<?php echo $product_id ?>" class="text-dark"><h5><?php echo substr($product_name,0,20)."...";?></h5></a>
                            <h5 style="color:blue;"><?php  echo getMinMaxProductPriceById($product_id); ?></h5>
                        </div>
                        <div class="card-action pl-3 pb-2 ml-3">
                            <a href="details.php?pro_id=<?php echo $product_id;?>" class="btn btn-sm <?php if($getUserSetting['website_status']!='Open'){echo "w-75";} ?>"
                                style="border:1px solid black">view details</a>
                                <?php
                                $getUserSetting=getUserSetting();
                                if($getUserSetting['website_status']=="Open"){?>
                                    <a href="" class="btn btn-sm"
                                    style="background-color:rgb(17, 235, 206);color:white;border:1px solid rgb(14, 207, 182)"><i class="fa fa-shopping-cart mr-2"></i>Add to cart</a>
                                <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
        }
    }else{
        echo '<div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body h4 text-center">
                        No any Products In the Database.Add New One by <a href="customer/add_pro.php">Clicking Here</a>
                    </div>
                </div>
            </div>';
    }
            
}

function getaddpro()
{
    global $conn;
    if(isset($_POST['add_prod']))
    {
        
        $prod_title=$_POST['p_name'];
        $prod_p_cat=$_POST['p_p_cat'];
        $prod_cat=$_POST['p_cat'];

        $prod_img1=$_FILES['p_img1']['name'];
        $tmp_dir_img1=$_FILES['p_img1']['tmp_name'];

        $prod_img2=$_FILES['p_img2']['name'];
        $tmp_dir_img2=$_FILES['p_img2']['tmp_name'];

        $prod_img3=$_FILES['p_img3']['name'];
        $tmp_dir_img3=$_FILES['p_img3']['tmp_name'];

        $prod_price=$_POST['p_price'];
        $prod_desc=$_POST['ckeditor'];
        $prod_key=$_POST['p_key'];

        move_uploaded_file($tmp_dir_img1,"../img/product_images/".$prod_img1);
        move_uploaded_file($tmp_dir_img2,"../img/product_images/".$prod_img2);
        move_uploaded_file($tmp_dir_img3,"../img/product_images/".$prod_img3);

        $get_pro="INSERT INTO `products` (`product_name`, `product_p_cat_id`, `product_cat_id`, `product_crea_time`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `product_keyword`) VALUES ('$prod_title', '$prod_p_cat', '$prod_cat', current_timestamp(), '$prod_img1', '$prod_img2', '$prod_img3', '$prod_price', '$prod_desc', '$prod_key');";
        $res=mysqli_query($conn,$get_pro);
        if($res)
        {
            $_SESSION['prodSMes']='<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> Product has been added succesfully.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                   </div>';
            header("Location: ../index.php");
        }
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
function smtp_mailer($receiver,$subject, $body){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('', 'Mailer');
    $mail->addAddress($receiver);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->send();
}

function getcusdata($attr){ 
    global $conn;
    $user=$_SESSION['username'];
    $get_cus=mysqli_query($conn,"select * from customers where cus_username='$user'");
    $row_cus=mysqli_fetch_assoc($get_cus);
    return $row_cus[$attr];
}

function getOrderById($oid){
    global $conn;
    $get_orders="select orders.*,order_status.status,deliveryboy.name,deliveryboy.contact_no,customers.cus_name,customers.cus_email,customers.cus_username,customers.cus_country from
    orders,customers ,order_status,deliveryboy where customers.cus_id=orders.customer_id and order_status.id=orders.order_status and orders.order_id='$oid'";
    return $row_order=mysqli_fetch_assoc(mysqli_query($conn,$get_orders));
}

function getcusorder($or_attr){
    global $conn;
    $user=$_SESSION['username'];
    $id=getcusdata('cus_id');
    $get_order=mysqli_query($conn,"select * from orders where customer_id='$id'");
    $row_order=mysqli_fetch_assoc($get_order);
    return $row_order[$or_attr];
}

function orderemail($cname,$total_amount,$oid){
    $html='<!doctype html>
    <html lang="en">
    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <title>Hello, world!</title>
        <style>
            body{
                margin:0px; 
                padding:0px;
                font-size:16px;
            }
            nav.nav{
                margin:0px;
                padding:0px;
                width:100%;
                text-align:center;
                background-color:rgb(108, 99, 235);
                margin-bottom:0px;
                box-shadow: 1px 3px 5px grey;
            }
            #web_header{
                margin: 0px;
                padding: 10px;
                font-size: 50px;
            }
            #web_header .web-title{
                text-decoration: none;
                color: gainsboro;
                text-shadow: 2px 2px 10px blue;
            }
            .container{
                width:100%;
            }
            .container #text-wrapper{
                box-sizing: border-box;
                background-color: aliceblue;
                width: fit-content;
                margin-right: auto;
                margin-left: auto;
                padding: 28px;
            }
            .container #text-wrapper h1{
                margin: 0px;
            }
            .container #text-wrapper p{
                font-size: 17px;
                margin-top: 9px;
            }
            .container #text-wrapper .amount-order{
                background-color: rgba(30, 143, 255, 0.233);
                padding: 8px 28px 1px;
                box-sizing: border-box;
                border-radius: 9px;
            }
            .container #text-wrapper .amount{
                margin-bottom: initial;
            }
            .container #text-wrapper .amount
            ,.container #text-wrapper .order-id{
                font-size: larger;
            }
            .container #text-wrapper table{
                margin: 30px auto 17px auto;
                font-size: 16px;
            }
            .container #text-wrapper table td,
            .container #text-wrapper table th{
                padding:5px 15px 5px 5px;
                text-align: center;
                
            }
            #total-price{
                text-align: center;
                font-size: large;
                float:right;
            }
            #below-total{
                padding: 13px 0px 0px 0px;
                margin-bottom: 0px;
            }
            #support{
                text-decoration: none;
            }
            #above-web{
                margin-bottom: -6px;
            }
            #title a{
                text-decoration: none;
            }
            footer{
                background-color: grey;
            }
            footer p{
                margin-top: 0px;
                text-align: center;
                padding: 5px;
                margin-bottom: 0px;
            }
        </style>
    </head>
    
    <body>
        <nav class="nav">
            <div>
                <h2 id="web_header"><a href="'.WEBSITE_PATH.'" class="web-title">'.WEBSITE_NAME.'</a></h2>
            </div>
        </nav>
        <div class="container">
            <div>
                <div>
                    <div id="text-wrapper">
                        <h1>Hi ,'.$cname.'</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti, non!</p>
                        <div class="amount-order">
                            <div>
                                <p class="amount"><b>Amount due: </b>'.$total_amount.' Rs</p>
                                <p class="order-id"><b>order id: </b>'.$oid.'</p>
                            </div>
                        </div>
                        <table>
                            <thead  id="table-heading">
                                <tr>
                                    <th>Sr no.</th>
                                    <th>Product name</th>
                                    <th>Attribute1</th>
                                    <th>Attribute2</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $getOrderDetailsById=getOrderDetailsById($oid);
                            $i=1;
                            foreach($getOrderDetailsById as $list){
                               $html.= '<tr class="border-bottom">
                                   <td>#'.$i.'</td>
                                   <td>'.$list['product_name'].'</td>
                                   <td>'.$list['product_size'].'</td>
                                   <td>'.$list['product_color'].'</td>
                                   <td>'.$list['qty'].'</td>
                                   <td>'.$list['product_price']*$list['qty'].' Rs</td>
                               </tr>';
                            $i++;
                            }
                                
                            $html.='</tbody>
                        </table>
                        <div id="total-price">
                            <b>Total:</b><b>'.$total_amount.' Rs</b>
                        </div><br>
                        <p id="below-total">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, <a href="" id="support">support team</a>
                            corporis!</p>
                        <p id="above-web">Cheers,</p>
                        <p id="title"><a href="">'.WEBSITE_NAME.'</a></p>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div>
                <p>All rights reserved</p>
            </div>
        </footer>
    </body>
    
    </html>';
    return $html;
}

function getProductAttrById($aid){
    global $conn;
    $getprod="select * from product_attribute where attribute_id='$aid'";
    $runprod=mysqli_query($conn,$getprod);
    $rowprod=mysqli_fetch_assoc($runprod);
    return $rowprod;
}

function getUserFullCartByIp(){
    global $conn;
    $ip=getUserIP();
    $getprod="select * from addcart where ip_address='$ip'";
    $runprod=mysqli_query($conn,$getprod);
    $rowprod=mysqli_fetch_all($runprod,MYSQLI_ASSOC);
    return $rowprod;
}

function getProDetailsById($pid){
    global $conn;
    $getprod="select products.product_name,product_categories.product_cat_name,categories.cat_name ,products.product_img1,products.product_keyword,products.product_desc from products,product_categories,categories where product_categories.product_cat_id=products.product_p_cat_id and categories.cat_id=products.product_cat_id and products.product_id='$pid'";
    $runprod=mysqli_query($conn,$getprod);
    $rowprod=mysqli_fetch_assoc($runprod);
    return $rowprod;
}

function getCusDetailsById($uid){
    global $conn;
    $getuser="select cus_name,cus_email,cus_username,cus_country,cus_city,cus_address from customers where cus_id='$uid'";
    $runuser=mysqli_query($conn,$getuser);
    $row_user=mysqli_fetch_assoc($runuser);
    return $row_user;
}

function getCouponDetailsById($id){
    global $conn;
    return $row_coupon=mysqli_fetch_assoc(mysqli_query($conn,"select * from coupon_code where coupon_id='$id' and status='1'"));
}

function getOrderDetailsById($oid){
    global $conn;
    $get_order_attr="select products.product_name,products.product_img1,product_attribute.product_size,product_attribute.product_color,product_attribute.product_price,order_details.qty from products,product_attribute,order_details where products.product_id=order_details.product_id and product_attribute.attribute_id=order_details.attribute_id and order_details.order_id='$oid'";
    $attr=array();
    $attr=mysqli_fetch_all(mysqli_query($conn,$get_order_attr),MYSQLI_ASSOC);
    return $attr;
}

function getCartTotalPrice(){
    global $conn;
    $ip=getUserIP();
    $total=0;
    $gettotal="select * from addcart where ip_address='$ip'";
    $res=mysqli_query($conn,$gettotal);
    $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
    if(mysqli_num_rows($res)>0){
        foreach($row as $list){
            $getProductAttrById=getProductAttrById($list['attribute_id']);
            $total=$total+($getProductAttrById['product_price']*$list['qty']);
        }
    }
    return $total;
}


function getCartEmpty(){
    global $conn;
    $ip=getUserIP();
    $get_cart=mysqli_query($conn,"delete from addcart where ip_address='$ip'");
}

function getMinMaxProductPriceById($pid){
    global $conn;
    $get_price = mysqli_fetch_assoc(mysqli_query($conn,"select max(product_price) as max_price , min(product_price) as min_price from product_attribute where product_id = '$pid'"));
    if($get_price['min_price'] == $get_price['max_price']){
        return $get_price['max_price']."Rs";
    }else{
        return $get_price['min_price']."Rs - ".$get_price['max_price']."Rs";

    }
}
?>