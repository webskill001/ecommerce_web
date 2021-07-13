<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Customers
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
    <div class="panel-heading bg-primary text-center py-1 h5">View Customers</div>
    <div class="panel-body p-2">
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th colspan=1>Cus id</th>
                    <th>Cus name</th>
                    <th colspan=1>Cus email</th>
                    <th>Cus username</th>
                    <th>Cus country</th>
                    <th>Cus city</th>
                    <th>Cus address</th>
                    <th>Cus contact</th>
                    <th>Cus Image</th>
                    <th>Reg date</th>
                    <th>Delete Cus</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            while($get_cus=mysqli_fetch_assoc($run_customers)){
                $cus_id=$get_cus['cus_id'];
                $cus_name=$get_cus['cus_name'];
                $cus_email=$get_cus['cus_email'];
                $cus_username=$get_cus['cus_username'];
                $cus_country=$get_cus['cus_country'];
                $cus_city=$get_cus['cus_city'];
                $cus_address=$get_cus['cus_address'];
                $cus_contact=$get_cus['cus_contact'];
                $cus_img=$get_cus['cus_image'];
                $cus_date=$get_cus['time&date'];
            ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td><?php echo $cus_name; ?></td>
                    <td><?php echo $cus_email; ?></td>
                    <td><?php echo $cus_username; ?></td>
                    <td><?php echo ucwords($cus_country); ?></td>
                    <td><?php echo ucwords($cus_city); ?></td>
                    <td><?php echo ucwords($cus_address); ?></td>
                    <td><?php echo $cus_contact; ?></td>
                    <td><img src="../customer/customer_images/profile/<?php echo $cus_img; ?>" height="65" width="60" alt=""></td>
                    <td><?php echo $cus_date; ?></td>
                    <td><a class="text-danger" href="index.php?del_cus=<?php echo $cus_id; ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
                </tr>
            <?php $i++;} ?>
            </tbody>
        </table>
    </div>
</div>

            <?php } ?>