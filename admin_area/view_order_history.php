<?php

if(isset($_GET['oid']) && isset($_SESSION['admin'])){
    $getOrderById=getOrderById($_GET['oid']);
    $getDeliveryBoyById=getDeliveryBoyById($_GET['oid']);
    //print_r($getDeliveryBoyById);die();
    $getOrderDetailsById=getOrderDetailsById($_GET['oid']);
    if(isset($_GET['order_status']) && $_GET['order_status']!=""){
        $oid=$_GET['oid'];
        $order_status=$_GET['order_status'];
        $update_order_status=mysqli_query($conn,"update orders set order_status='$order_status' where order_id='$oid'");
        $loc=WEBSITE_PATH.'admin_area/index.php?oid='.$oid;
        echo '<script>window.open("'.$loc.'", "_self")</script>';
    }
    if(isset($_GET['deliveryboy']) && $_GET['deliveryboy']!="" && $_GET['deliveryboy']>0){
        $deliveryboy=$_GET['deliveryboy'];
        $oid=$_GET['oid'];
        $update_order_status=mysqli_query($conn,"update orders set deliveryboy_id='$deliveryboy' where order_id='$oid'");
        $loc=WEBSITE_PATH.'admin_area/index.php?oid='.$oid;
        echo '<script>window.open("'.$loc.'", "_self")</script>';
    }
?>
<div class="container-fluid">
    <h1 class="mb-3">Invoice</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row border-bottom">
                <div class="col-md-3">
                    <h2>Order Id: <?php echo $_GET['oid']; ?></h2>
                </div>
                <div class="col-md-5 offset-md-4 pb-4">
                    <h4 class="float-left pt-2">Payment Status:</h4>
                    <h2 class="float-left ml-2 text-<?php
                        if($getOrderById['payment_status']=="pending"){
                            echo "danger";
                        }else{
                            echo "success";
                        }
                    ?>">
                    <?php echo ucfirst($getOrderById['payment_status']); ?>
                    </h2>
                </div>
            </div>

            <div class="row pt-4 pb-5">
                <div class="col-md-3">
                    <div class="pt-3">
                        <h5>Shop name,</h5>
                        <p>Shop address: Lorem, ipsum dolor.</p>
                    </div>
                </div>
                <div class="col-md-3 offset-md-6">
                    <h5 class="text-right">Invoice to,</h5>
                    <div>
                        <p class="text-right mb-0"><?php echo $getOrderById['cus_name'] ?>,</p>
                        <p class="text-right mb-0"><?php echo $getOrderById['cus_email'] ?>,</p>
                        <p class="text-right mb-0"><?php echo $getOrderById['delivery_address'] ?>,</p>
                        <p class="text-right mb-0"><?php echo $getOrderById['city']."(".ucfirst($getOrderById['cus_country']).")" ?>,</p>
                        <p class="text-right mb-0"><?php echo $getOrderById['zipcode'] ?></p>
                    </div>
                </div>
            </div>

            <div class="order_details">
                <p class="text-muted">Order date: <?php echo $getOrderById['order_date']; ?></p>
                <table class="table table-hover">
                    <thead class="alert-danger">
                        <tr>
                            <th>Sr no.</th>
                            <th>Product name</th>
                            <th>Attribute 1</th>
                            <th>Attribute 2</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;
                    foreach($getOrderDetailsById as $list){ ?>
                        <tr>
                            <td>#<?php echo $i; ?></td>
                            <td><?php echo $list['product_name'] ?></td>
                            <td><?php echo $list['product_size'] ?></td>
                            <td><?php echo $list['product_color'] ?></td>
                            <td><?php echo $list['qty'] ?></td>
                            <td><?php echo $list['product_price'] ?> Rs</td>
                            <td><?php echo $list['product_price']*$list['qty'] ?> Rs</td>
                        </tr>
                    <?php $i++;} ?>
                    </tbody>
                </table>
                <div class="row border-bottom pb-4"><div class="col-md-11 h5 text-right">Total:  <?php echo $getOrderById['total_amount'] ?> Rs</div></div>
                <div class="d-inline float-left pt-3">
                        <p class="h4">Order Status: <?php echo $getOrderById['status'] ?></p>
                        <select name="order_status" id="order_status" onchange="orderStatus(<?php echo $_GET['oid']; ?>)" class="custom-select mb-3">
                            <option value="">Select order status</option>
                            <?php
                            $getOrderStatus=getOrderStatus();
                            foreach($getOrderStatus as $list){
                                ?>
                                    <option value="<?php echo $list['id']; ?>"><?php echo ucfirst($list['status']); ?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <p class="h4">Delivery Boy Assign: <?php if($getOrderById['deliveryboy_id']>0){echo ucfirst($getDeliveryBoyById['name'])."(".$getDeliveryBoyById['contact_no'].")"; }else{echo "Not asign"; } ?></p>
                        <select name="deliveryboy" id="deliveryboy" class="custom-select" onchange="deliveryboy(<?php echo $_GET['oid'] ?>)">
                            <option value="">Select order status</option>
                            <?php
                            $getDeliveryBoy=mysqli_fetch_all(mysqli_query($conn,"select * from deliveryboy"),MYSQLI_ASSOC);
                            foreach($getDeliveryBoy as $list){
                                ?>
                                    <option value="<?php echo $list['id']; ?>"><?php echo ucfirst($list['name']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                </div>
                <a href="" class="btn btn-primary rounded-0 mt-5 float-right"><i class="fa fa-cloud-download"></i> PDF</a>
            </div>
        </div>
    </div>
    <p class="pl-3 mt-2 mb-4">All rights reserved, website name</p>
</div>
<script>
    var WEBSITE_PATH="<?php echo WEBSITE_PATH; ?>";
</script>
<?php } ?>
