<div class="text-center">
    <h3>My Order</h3>
    <p>If you have any question, please feel free to <a href="../contact.php">contact us</a> , our customer service center is working for you 24/7 . </p>
    <form action="confirm.php" method="post">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th colspan=1>Sr No.</th>
                    <th colspan=1>Address/City/Country</th>
                    <th colspan=1>Invoice Number</th>
                    <th colspan=1>Order date</th>
                    <th>Payment status</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $i=1;
                $ip=getUserIP();
                $get_customer="select cus_id from customers where cus_ip='$ip'";
                $row_cus=mysqli_fetch_assoc(mysqli_query($conn,$get_customer));
                $cus_id=$row_cus['cus_id'];
                $get_order_id=mysqli_fetch_all(mysqli_query($conn,"select order_id from orders where customer_id='$cus_id'"),MYSQLI_ASSOC);
                foreach($get_order_id as $val){
                    $getOrderById=getOrderById($val['order_id']);
                ?>
                <tr>
                    <td><a href="?oid=<?php echo $getOrderById['order_id'];?>" class="text-light" style="text-decoration:none;"><div class="bg-primary text-center rounded"><?php echo "#".$i ?></div></a> </td>
                    <td><?php echo $getOrderById['delivery_address'].','.$getOrderById['city'].'<br>'.$getOrderById['cus_country']; ?></td>
                    <td><?php echo $getOrderById['invoice_no']; ?></td>
                    <td><?php echo $getOrderById['order_date']; ?></td>
                    <td><?php
                    if($getOrderById['payment_status']=="pending"){
                        $color="danger";
                    }else{
                        $color="success";
                    }
                    ?>
                    <div class="bg-<?php echo $color; ?> p-2 rounded text-center text-light"><?php echo $getOrderById['payment_status']; ?></div>
                </tr>
                <?php $i++;} ?>
            </tbody>
        </table>
    </form>
</div>