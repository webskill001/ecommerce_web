<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Product
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
    <div class="panel-heading bg-primary text-center py-1 h5">View Product</div>
    <div class="panel-body p-2">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Product Keyword</th>
                    <th>Delete Product</th>
                    <th>Edit Product</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            while($get_pro=mysqli_fetch_assoc($run_product)){
                $pro_id=$get_pro['product_id'];
                $pro_name=$get_pro['product_name'];
                $pro_price=$get_pro['product_price'];
                $pro_img1=$get_pro['product_img1'];
                $pro_desc=$get_pro['product_desc'];
                $pro_keyword=$get_pro['product_keyword'];
            ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td><?php echo $pro_name; ?></td>
                    <td><img src="../customer/customer_p_images/<?php echo $pro_img1; ?>" width="60" height="50" alt=""></td>
                    <td><?php echo $pro_price; ?></td>
                    <td><?php echo $pro_desc; ?></td>
                    <td><?php echo $pro_keyword; ?></td>
                    <td><a class="text-danger" href="index.php?del_pro=<?php echo $pro_id; ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
                    <td><a href="index.php?edit_pro=<?php echo $pro_id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                </tr>
            <?php $i++;} ?>
            </tbody>
        </table>
    </div>
</div>

            <?php } ?>