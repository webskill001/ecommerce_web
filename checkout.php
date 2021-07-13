<?php
include "includes/header.php";
include "includes/navbar.php";
if(!isset($_SESSION['username'])){
    echo '<script>window.open("login.php","_self");</script>';
}else{
    $customer_id=$_SESSION['cid'];
    $getCusDetailsById=getCusDetailsById($customer_id);
    if($cartTotalItem > 0){   
        if(isset($_POST['make_payment'])){
            $mobile_no=$_POST['mobile_no'];
            $zipcode=$_POST['zipcode'];
            $delivery_address=$_POST['delivery_address'];
            $city=$_POST['city'];
            $payment_mode=$_POST['payment_mode'];
            $total_amount=$getCartTotalPrice;
            $invoice_no=rand(1111111111,9999999999);
            $get_order=mysqli_query($conn,"insert into orders (order_id,delivery_address,city,mobile_no,zipcode,customer_id,invoice_no,total_amount,payment_mode,payment_id) values(NULL,'$delivery_address','$city','$mobile_no','$zipcode','$customer_id','$invoice_no','$total_amount','$payment_mode','')");
            echo $oid=mysqli_insert_id($conn);
            $getUserFullCartByIp=getUserFullCartByIp(getUserIP());
            foreach($getUserFullCartByIp as $list){
                $product_id=$list['product_id'];
                $attribute_id=$list['attribute_id'];
                $qty=$list['qty'];
                $get_order_details=mysqli_query($conn,"insert into order_details (order_id,product_id,attribute_id,qty) values('$oid','$product_id','$attribute_id','$qty')");
            }
            getCartEmpty();
            $cus_email=getcusdata('cus_email');
            $getOrderById=getOrderById($oid);
            if($payment_mode=="cod"){
                $orderemail=orderemail($getOrderById['cus_name'],$getCartTotalPrice,$oid);
                smtp_mailer($getOrderById['cus_email'],"Order Placed Successfully",$orderemail);
                echo '<script>window.open("thankyou.php?oid='.$oid.'","_self");</script>';
            }
            if($payment_mode=="paytm"){
                $html='<form method="post" action="pgRedirect.php" name="form_Paytm" style="display:none">
                            <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="'.$oid.'">
                            <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="'.$getOrderById['customer_id'].'">
                            <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
                            <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                            <input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="'.$getOrderById['total_amount'].'">
                            <input value="CheckOut" type="submit">
                        </form>
                        <script type="text/javascript">
                            document.form_Paytm.submit();
                        </script>';
                echo $html;
            }
        }
    }else{
        echo '<script>window.open("shop.php","_self");</script>';
    }
?>

<div class="container-fluid">
    <div class="container pb-3">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3>Checkout Page</h3>
                        <p class="text-muted">Your payment is secured with end to end encryption</p>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Name</label>
                                        <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $getCusDetailsById['cus_name']; ?>" required readonly>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"  value="<?php echo $getCusDetailsById['cus_email']; ?>"required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile</label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipcode">Zipcode</label>
                                        <input type="text" name="zipcode" id="zipcode" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="delivery_address">Delivery Address</label>
                                        <textarea name="delivery_address" id="delivery_address" cols="30" rows="2" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" id="city" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apply_coupon">Coupon Code</label><br>
                                        <input type="text" style="width:200px;" name="coupon_code" id="apply_coupon"
                                            class="d-inline form-control">
                                        <button type="button" name="coupon_code_button" onclick="apply_coupon_code()"
                                            class="btn btn-coupon d-inline float-right">Apply Coupon Code</button>
                                        <div id="coupon_code_error_message" class="text-danger"></div>
                                        <div id="coupon_code_success_message" class="text-success"></div>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-12">
                                    <label for="">Payment Method </label>
                                    <div class="form-check ml-3 mb-0">
                                        <input type="radio" class="form-check-input" name="payment_mode" id="cod" value="cod">
                                        <label for="cod">Cash On Delivery</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input type="radio"  class="form-check-input" name="payment_mode" id="payment" value="paytm" checked>
                                        <label for="payment">Pay Using Paytm</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <a href="shop.php" class="btn btn-grey"><i class="fa fa-chevron-left mr-2"></i>
                                        Continue Shopping</a>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <button type="submit" name="make_payment" class="btn btn-coupon float-right">Make Payment <i
                                            class="fa fa-chevron-right ml-2"></i></button>

                                </div>
                                <div class="text-center text-danger w-100 text-right">
                                    <?php if(isset($_SESSION['cart_min_message'])){echo $_SESSION['cart_min_message'];unset($_SESSION['cart_min_message']);} ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-md-3 pl-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>Order Summary</h3>
                            <p class="text-muted">
                                culpa quidem at labore dignissimos rerum ipsa corporis quam molestiae laboriosam, alias
                                fuga.
                            </p>
                        </div>
                        <form action="" method="post">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan=5>Order Subtotal:</td>
                                        <td colspan=5> INR <?php echo $getCartTotalPrice; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan=5>Cart Total Weight:</td>
                                        <td colspan=5>3Kg</td>
                                    </tr>
                                    <tr>
                                        <td colspan=5><i class="fa fa-truck ml-2"></i> Shipping:</td>
                                        <td colspan=7>INR 0</td>
                                    </tr>
                                    <tr class="w-100">
                                        <td colspan=12>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut,
                                            numquam.</td>
                                    </tr>
                                    <tr>
                                        <td colspan=5>Tax:</td>
                                        <td colspan=6>INR 0</td>
                                    </tr>
                                    <tr>
                                        <td colspan=5>Total:</td>
                                        <td colspan=6>INR <?php echo $getCartTotalPrice;; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
}
?>