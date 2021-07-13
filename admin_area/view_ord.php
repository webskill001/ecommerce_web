<?php
@include "includes/db.php";
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    // $getOrderById=getOrderById(1);
    // print_r($getOrderById);die();
   // $getOrderDetailsByUserId=getOrderDetailsByUserId();
?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Orders
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
            <div class="panel-heading bg-primary py-1 text-center h5 py-2">Orders</div>
        
            <div class="panel-body m-2">
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
            </div>
        </div>
    </div>

                    <?php } ?>