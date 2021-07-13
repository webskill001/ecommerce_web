<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_GET['did'])){
        $did=$_GET['did'];
        $delcoupon=mysqli_query($conn,"delete from coupon_code where coupon_id='$did'");
        $_SESSION['delcoupon']='<div class="text-center text-danger">Coupon code has been delete successfully</div>';
    }
    if(isset($_GET['aid']) && $_GET['aid']>0){
        $aid=$_GET['aid'];
        $getcoupsta=mysqli_query($conn,"update coupon_code set status='0' where coupon_id='$aid'");
    }
    if(isset($_GET['deid']) && $_GET['deid']>0){
        $deid=$_GET['deid'];
        $getcoupsta=mysqli_query($conn,"update coupon_code set status='1' where coupon_id='$deid'");
    }
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Coupon Code
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
    <div class="panel-heading bg-primary text-center py-1 h5">View Coupon Code</div>
    <?php
    if(isset($_SESSION['success_message'])){
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    }
    ?>
    <div class="panel-body p-2">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Coupon id</th>
                    <th>Coupon name</th>
                    <th>Coupon type</th>
                    <th>Coupon value</th>
                    <th>Cart Min Price</th>
                    <th>Expired on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            $get_coupon_code=mysqli_query($conn,"select * from coupon_code");
            while($row_coupon_code=mysqli_fetch_assoc($get_coupon_code)){ ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td><?php echo $row_coupon_code['coupon_title']; ?></td>
                    <td><?php echo $row_coupon_code['coupon_type']; ?></td>
                    <td><?php echo $row_coupon_code['coupon_value']; ?> Rs</td>
                    <td><?php echo $row_coupon_code['cart_min_value']; ?> Rs</td>
                    <td><?php echo $row_coupon_code['coupon_expire']; ?></td>
                    
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                                <a href="?view_coupon&did=<?php echo $row_coupon_code['coupon_id']; ?>" class="btn btn-danger text-light" name="delete"  type="submit"><i class="fa fa-trash-o"></i></a>
                            <?php if($row_coupon_code['status']==0){ ?>
                                        <a  href="?view_coupon&deid=<?php echo $row_coupon_code['coupon_id']; ?>" class="btn btn-secondary text-light" name="active" type="submit">Active</a>
                                    <?php }else{ ?>
                                        <a  href="?view_coupon&aid=<?php echo $row_coupon_code['coupon_id']; ?>" class="btn btn-info  text-light" name="deactive" type="submit">Deactive</a>
                                    <?php } ?>
                            <a  href="?insert_coupon&eid=<?php echo $row_coupon_code['coupon_id']; ?>" class="btn btn-success text-light" name="edit" type="submit"><i class="fa fa-pencil"></i></a>
                        </div>
                    </td>
                </tr>
            <?php $i++;} ?>
            </tbody>
        </table>
    </div>
</div>

            <?php } ?>