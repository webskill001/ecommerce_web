<?php @include "_constant.php";
$totalprice=0;
$ip_add=getUserIP();
 $prodpre="select * from addcart where ip_address='$ip_add'";
 $res1=mysqli_query($conn,$prodpre);
 $count=mysqli_num_rows($res1);
 while($row=mysqli_fetch_assoc($res1)){
     $getProductAttrById=getProductAttrById($row['attribute_id']);
    $totalprice = $totalprice + ($getProductAttrById['product_price']*$row['qty']);
 }
 ?>
<div id="top">
    <!-- Top Begin -->

    <div class="container">
        <!-- container Begin -->

        <div class="col-md-6 offer d-inline">
            <!-- col-md-6 offer Begin -->

            <a href="#" class="btn btn-success btn-sm">Welcome, <?php
            if(isset($_SESSION['username'])){
                echo $_SESSION['username'];
            }else{
                echo "Guest";
            }
            ?></a>
            <a href="cart.php"><span id="totalitem"><?php echo $cartTotalItem; ?></span> Items In Your Cart | Cart Total Price: Rs <span id="totalprice"><?php echo $getCartTotalPrice; ?></span> </a>

        </div><!-- col-md-6 offer Finish -->

        <div class="col-md-6 float-right">
            <form class="form-inline my-lg-0 p-1">
                <input class="form-control mr-sm-2" style="width:400px;" required type="search"
                    placeholder="Search for products..." aria-label="Search">
                <button class="btn my-2 my-sm-0 mr-2 btn-success" style="color:white;" type="submit"><i
                        class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="col-md-6">
            <!-- col-md-6 Begin -->

            <ul class="menu">
                <!-- cmenu Begin -->

                <li>
                    <a href="register.php">Register</a>
                </li>
                <li>
                    <a href="customer/myaccount.php">My Account</a>
                </li>
                <li>
                    <a href="cart.php">Go To Cart</a>
                </li>
                <li>
                    <?php
                   if(isset($_SESSION['username'])){
                    echo '<a href="logout.php">Logout</a>';
                }else{
                    echo '<a href="login.php">Login</a>';
                }
                   ?>
                </li>

            </ul><!-- menu Finish -->

        </div><!-- col-md-6 Finish -->

    </div><!-- container Finish -->

</div><!-- Top Finish -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php"><?php echo WEBSITE_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer/myaccount.php">my account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">shopping cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">contact us</a>
                </li>
            </ul>
            <div class="btn-group dropleft">
                <a class="pr-5 dropdown-toggle text-light"  id="navbar_shopping_cart" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" style="text-decoration:none;cursor:pointer;" ><img src="img/web/shopping_bag1.png" alt="">
                        <span class="badge badge-danger rounded-circle align-top" style="margin-left:-22px;margin-top:-5px;" id="totalitem1"><?php echo $cartTotalItem; ?></span>
                        <?php
                        if($totalprice!=0){
                        ?>
                            <p class="text-dark d-inline align-bottom" style="margin-left:-7px;" id="totalprice1"><?php echo $getCartTotalPrice; ?> Rs </p>
                        <?php } ?>
                </a>
                <?php if($totalprice!=0){ ?>
                <div class="dropdown-menu p-3" id="dropdown" style="min-width: 23rem;margin-top:45px;margin-right:-50px;">
                    <!-- Dropdown menu links -->

                    <table class="table table-hover table-borderless">
                        <tbody  id="addrow">
                        <?php
                        $ip=getUserIP();
                        $getcart=mysqli_query($conn,"select * from addcart where ip_address='$ip'");
                        while($rowcart=mysqli_fetch_assoc($getcart)){
                            $pro_id=$rowcart['product_id'];
                            $attr_id=$rowcart['attribute_id'];
                            $getpro=mysqli_query($conn,"select * from products where product_id='$pro_id'");
                            $rowpro=mysqli_fetch_assoc($getpro);
                            $getattr=mysqli_query($conn,"select * from product_attribute where attribute_id='$attr_id'");
                            $rowattr=mysqli_fetch_assoc($getattr);
                        ?>
                            <tr>
                                <td colspan="3"><img src="<?php echo WEBSITE_PATH."customer/customer_p_images/".$rowpro['product_img1'] ?>" height="100px" width="100px"class="responsive-img" alt=""></td>
                                <td>
                                    <p class="py-0 my-0"><h5><a href="details.php?pro_id=<?php echo $rowcart['product_id']; ?>"><?php echo $rowpro['product_name']; ?></a></h5></p>
                                    <p class="my-0">Qty: <?php echo $rowcart['qty']; ?></p>
                                    <p><?php echo $rowattr['product_price']; ?> Rs</p>
                                </td>
                                <td><a href=""><i class="fa fa-times text-danger my-4"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <b>Total</b>
                        </div>
                        <div class="col-md-4 text-right text-danger" id="totalprice2"><?php echo $getCartTotalPrice; ?> Rs</div>
                    </div>
                    <a href="cart.php" class="btn btn-block btn-outline-dark">VIEW CART</a>
                    <?php if($getUserSetting['website_status']=="Open"){?>
                        <a href="checkout.php" class="btn btn-block btn-outline-dark">CHECKOUT</a>
                    <?php } ?>
                </div>
                        <?php } ?>
            </div>
        </div>
    </div>
</nav>
