<?php
include "includes/header.php";
include "functions/function.php";
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
$get_product="select * from products";
$run_product=mysqli_query($conn,$get_product);
$count_product=mysqli_num_rows($run_product);

$get_product_cat="select * from product_categories";
$run_product_cat=mysqli_query($conn,$get_product_cat);
$count_product_cat=mysqli_num_rows($run_product_cat);

$get_cat="select * from categories";
$run_cat=mysqli_query($conn,$get_cat);
$count_cat=mysqli_num_rows($run_cat);

$get_orders="select * from orders";
$run_orders=mysqli_query($conn,$get_orders);
$count_orders=mysqli_num_rows($run_orders);

$get_customers="select * from customers";
$run_customers=mysqli_query($conn,$get_customers);
$count_customers=mysqli_num_rows($run_customers);
?>

<div class="container-fluid w-100 m-0 p-0">
    <nav class="navbar d-flex navbar-expand-lg navbar-dark bg-dark py-1">
        <a href="?dashboard" class="navbar-brand mr-auto">Admin Panel</a>
        <div class="d-flex">
            <div class="dropdown mr-1 dropleft">
                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" id="dropdownMenuOffset"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                    <?php
       echo "Welcome, ". $_SESSION['admin'];
      ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="index.php?view_prod">Products <span
                            class="badge badge-secondary"><?php echo $count_product; ?></span></a>
                    <a class="dropdown-item" href="index.php?view_p_cat">Product Categories <span
                            class="badge badge-secondary"><?php echo $count_product_cat; ?></span></a>
                    <a class="dropdown-item" href="index.php?view_cat">Categories <span
                            class="badge badge-secondary"><?php echo $count_cat; ?></span></a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>
        </dov>
    </nav>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-2">
            <div class="container-fluid p-0">
                <?php
        include "includes/sidebar.php";
    ?>
            </div>
        </div>
        <div class="col-lg-9 main overflow-auto">
            <?php
        if(isset($_GET['insert_pro'])){
            include "add_pro.php";
        }else if(isset($_GET['del_pro'])){
            include "del_pro.php";
        }else if(isset($_GET['edit_pro'])){
            include "edit_product.php";
        }else if(isset($_GET['view_prod'])){
            include "view_product.php";
        }else if(isset($_GET['insert_p_cat'])){
            include "insert_product_c.php";
        }else if(isset($_GET['view_p_cat'])){
            include "view_product_c.php";
        }else if(isset($_GET['del_p_cat'])){
            include "delete_product_c.php";
        }else if(isset($_GET['edit_p_cat'])){
            include "edit_product_c.php";
        }else if(isset($_GET['insert_cat'])){
            include "insert_c.php";
        }else if(isset($_GET['view_cat'])){
            include "view_c.php";
        }else if(isset($_GET['del_cat'])){
            include "delete_c.php";
        }else if(isset($_GET['edit_cat'])){
            include "edit_c.php";
        }else if(isset($_GET['insert_slider'])){
            include "insert_s.php";
        }else if(isset($_GET['view_slider'])){
            include "view_s.php";
        }else if(isset($_GET['del_c'])){
            include "delete_slider.php";
        }else if(isset($_GET['edit_c'])){
            include "edit_slider.php";
        }else if(isset($_GET['view_customer'])){
            include "view_cus.php";
        }else if(isset($_GET['del_cus'])){
            include "delete_cus.php";
        }else if(isset($_GET['view_order'])){
            include "view_ord.php";
        }else if(isset($_GET['view_pay'])){
            include "view_payment.php";
        }else if(isset($_GET['insert_user'])){
            include "insert_u.php";
        }else if(isset($_GET['view_user'])){
            include "view_u.php";
        }else if(isset($_GET['edit_user'])){
            include "edit_u.php";
        }else if(isset($_GET['del_user'])){
            include "del_u.php";
        }else if(isset($_GET['insert_coupon'])){
            include "insert_coup.php";
        }else if(isset($_GET['view_coupon'])){
            include "view_coup.php";
        }else if(isset($_GET['insert_delivery_boy'])){
            include "insert_db.php";
        }else if(isset($_GET['view_delivery_boy'])){
            include "view_db.php";
        }else if(isset($_GET['view_setting'])){
            include "setting.php";
        }else if(isset($_GET['oid'])){
            include "view_order_history.php";
        }else{
            include "dashboard.php";
        }
        ?>
        </div>
    </div>
</div>

<?php
}
include "includes/footer.php";
?>