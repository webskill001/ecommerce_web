<div id="top">
    <!-- Top Begin -->

    <div class="container">
        <!-- container Begin -->

        <div class="col-md-6 offer">
            <!-- col-md-6 offer Begin -->

            <a href="../index.php" class="btn btn-success btn-sm">Welcome, <?php
            if(isset($_SESSION['username'])){
                echo $_SESSION['username'];
            }else{
                echo "Guest";
            }
            ?></a>
            <a href="../cart.php"><?php itcount(); ?> Items In Your Cart | Cart Total Price: INR <?php ctotal(); ?> </a>

        </div><!-- col-md-6 offer Finish -->

        <div class="col-md-6">
            <!-- col-md-6 Begin -->

            <ul class="menu">
                <!-- cmenu Begin -->

                <li>
                    <a href="../register.php">Register</a>
                </li>
                <li>
                    <a href="myaccount.php">My Account</a>
                </li>
                <li>
                    <a href="../cart.php">Go To Cart</a>
                </li>
                <li>
                <?php
                if(isset($_SESSION['username'])){
                    echo '<a href="../logout.php">Logout</a>';
                }else{
                    echo '<a href="../login.php">Login</a>';
                }
                ?>
                    
                </li>

            </ul><!-- menu Finish -->

        </div><!-- col-md-6 Finish -->

    </div><!-- container Finish -->

</div><!-- Top Finish -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="../index.php"><?php echo WEBSITE_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../shop.php">shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myaccount.php">my account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../cart.php">shopping cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../contact.php">contact us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" required type="search" placeholder="Search" aria-label="Search">
                <button class="btn my-2 my-sm-0 mr-2" style="color:white;" type="submit"><i class="fa fa-search"></i></button>
            </form>
            <a href="../cart.php" class="btn" id="cart-btn" style="color:white;"><i class="fa fa-shopping-cart mr-2"></i>4 items in your cart</a>
        </div>
    </div>
</nav>