<?php
@include "includes/db.php";
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
?>
<h2>Dashboard</h2>
<hr>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Dashboard
        </li>
    </ol>
</nav>
<div>
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body bg-primary text-light">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-bar-chart fa-5x"></i>
                        </div>
                        <div class="col-md-6">
                                <p class="h1 text-right"><?php echo $count_product; ?></p>
                                <p class="h6 ml-0">Products</p>
                            </div>
                    </div>
                </div>
                <a href="index.php?view_prod" class="w-100 py-2 px-3 text-primary" style="text-decoration:none">
                        <p class="d-inline">View details</p>
                        <i class="float-right fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body bg-success text-light">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-md-6">
                                <p class="h1 text-right"><?php echo $count_customers; ?></p>
                                <p class="h6 ml-0">Customers</p>
                            </div>
                    </div>
                </div>
                <a href="index.php?view_customer" class="w-100 py-2 px-3 text-success" style="text-decoration:none">
                        <p class="d-inline">View details</p>
                        <i class="float-right fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body bg-info text-light">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-md-6">
                                <p class="h1 text-right"><?php echo $count_product_cat; ?></p>
                                <p class="h6 ml-0">Products categories</p>
                            </div>
                    </div>
                </div>
                <a href="index.php?view_p_cat" class="w-100 py-2 px-3 text-info" style="text-decoration:none">
                        <p class="d-inline">View details</p>
                        <i class="float-right fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body bg-danger text-light">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-pie-chart fa-5x"></i>
                        </div>
                        <div class="col-md-6">
                                <p class="h1 text-right"><?php echo $count_orders; ?></p>
                                <p class="h6 ml-0">Orders</p>
                            </div>
                    </div>
                </div>
                <a href="index.php?view_order" class="w-100 py-2 px-3 text-danger" style="text-decoration:none">
                        <p class="d-inline">View details</p>
                        <i class="float-right fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-8">
    <div class="panel card border border-primary rounded">
            <div class="panel-heading bg-primary py-1 text-center h5">Orders</div>
        
            <div class="panel-body p-2">
            <table class="table table-hover table-striped m-2 table-bordered table-responsive" style="font-size:15px;">
                    <thead>
                        <tr>
                            <th colspan=1>Order id</th>
                            <th>Customer username/email/mobile</th>
                            <th>Customer address/city/country</th>
                            <th>Total Price</th>
                            <th colspan=1>Order Details</th>
                            <th >Order Status</th>
                            <th>Payment Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $get_orders="select orders.*,order_status.status,customers.cus_name,customers.cus_email,customers.cus_username,customers.cus_country from
                        orders,customers,order_status where customers.cus_id=orders.customer_id and order_status.id=orders.order_status";
                        $getAllOrders=mysqli_fetch_all(mysqli_query($conn,$get_orders),MYSQLI_ASSOC);
                        foreach($getAllOrders as $list){?>
                            <tr>
                                <td><a href="?oid=<?php echo $list['order_id'];?>" class="text-light" style="text-decoration:none;"><div class="bg-secondary text-center"><?php echo $list['order_id'];?></div></a></td>
                                <td><?php echo $list['cus_username'];?><br><?php echo $list['cus_email'];?><br><?php echo $list['mobile_no'];?></td>
                                <td><?php echo $list['delivery_address'];?>,<?php echo $list['city'];?><br><?php echo $list['cus_country'];?></td>
                                <td><?php echo $list['total_amount'];?> Rs</td>
                                <td>
                                    <table class="table" style="font-size:14px;">
                                        <thead>
                                            <tr>
                                                <th>Product name</th>
                                                <th>product Qty</th>
                                                <th>Product Attribute</th>
                                                <th>Product Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $getOrderDetailsById=getOrderDetailsById($list['order_id']);
                                        foreach($getOrderDetailsById as $val){?>
                                            <tr >
                                                <td style="font-weight: 400;"><?php echo $val['product_name'] ?></td>
                                                <td  style="font-weight: 400;"><?php echo $val['qty'] ?></td>
                                                <td  style="font-weight: 400;"><?php echo $val['product_size'].'/'.$val['product_color']; ?></td>
                                                <td  style="font-weight: 400;"><?php echo $val['product_price']*$val['qty']; ?> Rs</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>   
                                <td class="align-middle"><?php echo ucfirst($list['status']); ?></td>
                                <td class="align-middle"><?php 
                                            if($list['payment_status']=="pending"){
                                                $color="danger";
                                            }else{
                                                $color="success";
                                            }
                                        ?>
                                    <div class="bg-<?php echo $color; ?> p-2 rounded text-center text-light"><?php echo $list['payment_status']; ?></div>
                                </td>
                                <td class="align-middle"><?php echo $list['order_date']; ?></td>   
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        
                    </tbody>
                </table>
                <div class="card-footer py-0">
                    <a href="index.php?view_order" class="float-right py-0 my-0 m-2 p-2">View all orders <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-img-top">
                <img src="images/card-1.jpg" alt="" class="img-thumbnail">
            </div>
            <div class="card-body">
            <?php
                $admin=$_SESSION['admin'];
                $get_admin="select * from admins where admin_username='$admin'";
                $run_admin=mysqli_query($conn,$get_admin);
                $row_admin=mysqli_fetch_assoc($run_admin);
            ?>
                <span class="d-block"><b>Name: </b><?php echo $row_admin['admin_name']; ?> (<?php echo $row_admin['admin_username']; ?>)</span>
                <span class="d-block"><b>Email: </b><?php echo $row_admin['admin_email']; ?></span>
                <span class="d-block"><b>Country: </b> <?php echo ucwords($row_admin['admin_country']); ?></span>
            </div>
        </div>
    </div>
</div>
                    <?php } ?>