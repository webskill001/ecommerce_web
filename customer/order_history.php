<?php

if(isset($_GET['oid']) ){
    $oid=$_GET['oid'];
    $getOrderById=getOrderById($oid);
    $getOrderDetailsById=getOrderDetailsById($oid);
?>
<div class="row border-bottom pt-3">
    <div class="col-md-3">
        <h3>Order Id: <?php echo $oid; ?></h3>
    </div>
    <div class="col-md-5 offset-md-4 pb-4">
        <h5 class="float-left pt-2">Order Status:</h5>
        <h3 class="float-left ml-2">
            <?php echo ucfirst($getOrderById['status']); ?>
        </h3><br><br>
        <h6 class="float-left pt-2">Payment Status:</h6>
        <?php
                    if($getOrderById['payment_status']=="pending"){
                        $color="danger";
                    }else{
                        $color="success";
                    }
                    ?>
        <p class="text-<?php echo $color; ?> p-2 rounded text-center float-left h5">
            <?php echo ucfirst($getOrderById['payment_status']); ?></p>
    </div>
</div>

<div class="row pt-4 pb-5">
    <div class="col-md-3">
        <div class="pt-3">
            <h5>Shop name,</h5>
            <p>Shop address: Lorem, ipsum dolor.</p>
        </div>
    </div>
    <div class="col-md-4 offset-md-5">
        <h5 class="text-right">Invoice to,</h5>
        <div>
            <p class="text-right mb-0"><?php echo $getOrderById['cus_name'] ?>,</p>
            <p class="text-right mb-0"><?php echo $getOrderById['cus_email'] ?>,</p>
            <p class="text-right mb-0"><?php echo $getOrderById['delivery_address'] ?>,</p>
            <p class="text-right mb-0">
                <?php echo $getOrderById['city']."(".ucfirst($getOrderById['cus_country']).")" ?>,</p>
            <p class="text-right mb-0"><?php echo $getOrderById['zipcode'] ?></p>
        </div>
    </div>
</div>

<div class="order_details">
    <p class="text-muted">Order date: <?php echo $getOrderById['order_date']; ?></p>
    <table class="table table-hover">
        <thead class="alert-primary">
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
        <tbody class="border-bottom">
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
    <div class="row border-bottom pb-4 mb-5">
        <div class="col-md-11 h5 text-right">Total: <?php echo $getOrderById['total_amount'] ?> Rs</div>
    </div>
    <a href="download_invoice.php?or_id=<?php echo $getOrderById['order_id']; ?>" class="btn btn-danger float-right"><i
            class="fa fa-cloud-download pr-1"></i>PDF</a>
</div>
<?php } ?>