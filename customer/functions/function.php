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
            echo '<script>alert("This item alredy present in your cart");</script>';
        }else{
            $getprodcart="insert into addcart (product_id,ip_address,qty,size) values('$pro_id','$ip_add','$p_qty','$p_size')";
            $res=mysqli_query($conn,$getprodcart);
            echo '<script>alert("Item successfully added to your cart");</script>';
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
    echo $count;
}

function ctotal(){
    global $conn;
    $ip=getUserIP();
    $total=0;
    $gettotal="select * from addcart where ip_address='$ip'";
    $res=mysqli_query($conn,$gettotal);
    if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res))
        {
            $pro_id=$row['product_id'];
            $pro_qty=$row['qty'];
            $getprice="select * from products where product_id='$pro_id'";
            $res1=mysqli_query($conn,$getprice);
            $row1=mysqli_fetch_assoc($res1);
            $pro_price=$row1['product_price'];
            $total+=($pro_price * $pro_qty);
        }
    }
    echo $total;
}

function getprod($endpoint)
{
    global $conn;
    $get_prod="select * from products rand order by product_id limit 0,$endpoint";
    $res=mysqli_query($conn,$get_prod);
    if(mysqli_num_rows($res)>0)
    {
        while($row=mysqli_fetch_assoc($res))
        {
            $product_id=$row['product_id'];
            $product_name=$row['product_name'];
            $product_img=$row['product_img1'];
            $product_price=$row['product_price'];
            $product_keyword=$row['product_keyword'];
            echo '<div class="col col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-img-top" style="height:220px;">
                            <a href="details.php?pro_id='.$product_id.'"><img src="img/product_images/'.$product_img.'" alt="" class="responsive-img w-100 h-100"></a>
                        </div>
                        <div class="card-body" style="text-align:center;">
                            <a href="details.php?pro_id='.$product_id.'" class="text-dark"><h5>'.ucwords($product_name).'('.ucwords($product_keyword).')</h5></a>
                            <h5 style="color:blue;">INR '.$product_price.'</h5>
                        </div>
                        <div class="card-action pl-3 pb-2 ml-3">
                            <a href="details.php?pro_id='.$product_id.'" class="btn btn-sm"
                                style="border:1px solid black">view details</a>
                            <a href="" class="btn btn-sm"
                                style="background-color:rgb(17, 235, 206);color:white;border:1px solid rgb(14, 207, 182)"><i class="fa fa-shopping-cart mr-2"></i>Add to cart</a>
                        </div>
                    </div>
                </div>';
        }

    }
    else
    {
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
// Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
function smtp_mailer($receiver,$subject, $body){
    // Load Composer's autoloader
    require 'smtp/vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'example@gmail.com';                     // SMTP username
    $mail->Password   = 'example';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('example@gmail.com', 'Mailer');
    $mail->addAddress($receiver, 'John');     // Add a recipient
    $mail->addReplyTo($receiver, 'Information');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
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

function getcusorder($or_attr){
    global $conn;
    $user=$_SESSION['username'];
    $id=getcusdata('cus_id');
    $get_order=mysqli_query($conn,"select * from orders where customer_id='$id'");
    $row_order=mysqli_fetch_assoc($get_order);
    return $row_order[$or_attr];
}

function orderemail(){
    $name=getcusdata('cus_name');
    $due_amount=getcusorder('due_amount');
    $order_id=getcusorder('order_id');
    $html='<!doctype html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
        <title>Hello, world!</title>
      </head>
      <body><nav class="navbar navbar-expand-lg bg-light navbar-light" style="height:50px;"><div class="w-100 text-center"><h2><a href="'.WEBSITE_PATH.'" class="text-dark" style="text-decoration: none;">'.WEBSITE_NAME.'</a></h2></div></nav>
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6 card rounded-0 border-0">
                <div class="card-body">
                    <h5>Hi ,'.$name.'</h5>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti, non!</p>
                    <div class="card border-0">
                        <div class="card-body p-3" style="background-color:rgba(241, 57, 202, 0.1);">
                            <p class="py-0 my-0"><b style="font-weight:500;">Amount due: </b>'.$due_amount.' Rs</p>
                            <p class="py-0 my-0"><b style="font-weight:500;">order id: </b>'.$order_id.'</p>
                        </div>
                    </div>
                    <table class="table table-borderless table-hover" >
                       <thead class="border-bottom">
                           <tr>
                               <th>title</th>
                               <th>title</th>
                               <th>title</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>data1</td>
                               <td>data1</td>
                               <td>data1</td>
                           </tr>
                           <tr>
                            <td>data1</td>
                            <td>data1</td>
                            <td>data1</td>
                        </tr>
                        <tr>
                            <td>data1</td>
                            <td>data1</td>
                            <td>data1</td>
                        </tr>
                        <tr>
                            <td>data1</td>
                            <td>data1</td>
                            <td>data1</td>
                        </tr>
                       </tbody>
                    </table><hr>
                    <div class="row mb-1">
                        <div class="col-md-8 text-right"><b>Total</b></div>
                        <div class="col-md-4"><b>'.$due_amount.'</b></div>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, <a href="">support team</a> corporis!</p>
                    <p class="mb-0">Cheers,</p>
                    <p><a href="" class="text-dark">'.WEBSITE_NAME.'</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>';
    return $html;
}

function getOrderById($oid){
    global $conn;
    $get_orders="select orders.*,order_status.status,deliveryboy.name,deliveryboy.contact_no,customers.cus_name,customers.cus_email,customers.cus_username,customers.cus_country from
    orders,customers ,order_status,deliveryboy where customers.cus_id=orders.customer_id and order_status.id=orders.order_status and orders.order_id='$oid'";
    return $row_order=mysqli_fetch_assoc(mysqli_query($conn,$get_orders));
}

function getOrderDetailsById($oid){
    global $conn;
    $get_order_attr="select products.product_name,products.product_img1,product_attribute.product_size,product_attribute.product_color,product_attribute.product_price,order_details.qty from products,product_attribute,order_details where products.product_id=order_details.product_id and product_attribute.attribute_id=order_details.attribute_id and order_details.order_id='$oid'";
    $attr=array();
    $attr=mysqli_fetch_all(mysqli_query($conn,$get_order_attr),MYSQLI_ASSOC);
    return $attr;
}
?>