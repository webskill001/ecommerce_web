<?php
@include "includes/db.php";
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Payment
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
            <div class="panel-heading bg-primary py-1 text-center h5 py-2">Payments</div>
        
            <div class="panel-body m-2">
                <table class="table table-hover table-striped m-2 table-bordered">
                    <thead>
                        <tr>
                            <th colspan=1>Payment id</th>
                            <th>Cus username</th>
                            <th>Invoice no.</th>
                            <th>Amount</th>
                            <th colspan=1>Payment mode</th>
                            <th>Reference no.</th>
                            <th>Payment date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $get_orders="select * from payments";
                        $run_orders=mysqli_query($conn,$get_orders);
                        $count_orders=mysqli_num_rows($run_orders);
                        while($get_pro=mysqli_fetch_assoc($run_orders)){
                            $pay_id=$get_pro['payment_id'];
                            $cus_id=$get_pro['customer_id'];
                            $invoice=$get_pro['invoice_no'];
                            $amount=$get_pro['amount'];
                            $pay_mode=$get_pro['payment_mode'];
                            $ref_no=$get_pro['ref_no'];
                            $pay_date=$get_pro['payment_date'];


                            $getuser="select * from customers where cus_id='$cus_id'";
                            $runuser=mysqli_query($conn,$getuser);
                            $row_user=mysqli_fetch_assoc($runuser);
                            $username=$row_user['cus_username'];
            
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$username.'</td>
                                    <td>'.$invoice.'</td>
                                    <td>INR '.$amount.'</td>
                                    <td>'.$pay_mode.'</td>
                                    <td>'.$ref_no.'</td>
                                    <td>'.$pay_date.'</td>
                                </tr>';
                            $i++;
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    <?php } ?>