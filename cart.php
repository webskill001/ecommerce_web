<?php
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container-fluid">
    <div class="container pb-3">
        <div class="row">
            <div class="col-md-12">
                <form action="cart.php" method="post">
                    <div class="card">
                        <div class="card-body">
                            <h3>Shopping cart</h3>
                            <p class="text-muted">you currently have <?php itcount(); ?> item (s) in your cart</p>

                            <?php if(itcount()!=0){
                                ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Size/Color</th>
                                        <th>Unit Price</th>
                                        <th>Delete</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $getUserFullCartByIp=getUserFullCartByIp();
                                    foreach($getUserFullCartByIp as $list){
                                      
                                        $getProductAttrById=getProductAttrById($list['attribute_id']);
                                        $getProDetailsById=getProDetailsById($list['product_id']);
                                        ?>
                                    <tr>
                                        <td><img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$getProDetailsById['product_img1']; ?>"
                                                alt=""></td>
                                        <td><a href="details.php?pro_id=<?php echo $list['product_id']; ?>"
                                                class="text-dark">
                                                <h5><?php echo ucwords($getProDetailsById['product_name']); ?></h5>
                                            </a></td>
                                        <td>
                                            <div class="btn-group btn-group-sm float-left mt-2" role="group"
                                                aria-label="Basic example">
                                                <button type="button" class="btn btn-light border-dark"
                                                    onclick="removeitem(<?php echo $list['product_id'] ?>)"><i
                                                        class="fa fa-minus"></i></button>
                                                <input type="text" name="product_quantity"
                                                    id="show_<?php echo $list['product_id']; ?>" readonly
                                                    value="<?php echo $list['qty']; ?>"
                                                    style="min-width:20px;max-width:50px;" class="text-center" required>
                                                <button type="button" class="btn btn-light border-dark"
                                                    onclick="additem(<?php echo $list['product_id'] ?>)"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                            <div class="message text-danger"></div>
                                        </td>
                                        <td><?php echo $getProductAttrById['product_size']."/".$getProductAttrById['product_color']; ?>
                                        </td>
                                        <td>Rs <?php echo $getProductAttrById['product_price']; ?></td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" name="remove[]"
                                                    value="<?php echo $list['product_id']; ?>" class="form-check-input">
                                            </div>
                                        </td>
                                        <td>Rs <?php echo $getProductAttrById['product_price']*$list['qty']; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan=5></td>
                                        <td colspan=6>Total: <b>Rs <?php echo $getCartTotalPrice; ?></b></td>
                                    </tr>
                                </tbody>

                            </table>
                            <?php
                            }else{
                                echo '<span class="h5 ml-4">Cart is empty. Click <a href="shop.php" class="text-dark">here to buy</a>.</span>';
                            } ?>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <a href="shop.php" class="btn btn-grey"><i class="fa fa-chevron-left mr-2"></i>
                                        Continue Shopping</a>
                                </div>
                                <?php  if(itcount()!=0){?>
                                    <div class="col-md-6">
                                    <a href="checkout.php" class="btn btn-coupon float-right mx-2">Procced To Checkout
                                        <i class="fa fa-chevron-right ml-2"></i></a>
                                    <button class="btn btn-grey float-right" type="submit" name="update_cart"><i
                                            class="fa fa-refresh mr-2"></i> Update Cart</button>
                                    </div>
                                <?php } ?>
                                
                                <div class="text-center text-danger w-100 text-right pt-2">
                                    <?php if(isset($_SESSION['cart_min_message'])){echo $_SESSION['cart_min_message'];unset($_SESSION['cart_min_message']);} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            function update_cart(){
                global $conn;
                if(isset($_POST['update_cart'])){
                    $del=$_POST['remove'];
                    foreach($del as $del_item)
                    {
                        $delcart="delete from addcart where product_id='$del_item'";
                        $res=mysqli_query($conn,$delcart);
                        if($res){
                            echo "<script>window.open('cart.php','_self');</script>";
                        }
                    }
                }   
            }
            echo update_cart();
            ?>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>