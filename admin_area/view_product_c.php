<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Product Categories
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
    <div class="panel-heading bg-primary text-center py-1 h5">View Product Categories</div>
    <div class="panel-body p-2">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Category description</th>
                    <th>Delete Category</th>
                    <th>Edit Category</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            while($get_pro_cat=mysqli_fetch_assoc($run_product_cat)){
                $pro_cat_id=$get_pro_cat['product_cat_id'];
                $pro_cat_name=$get_pro_cat['product_cat_name'];
                $pro_cat_desc=$get_pro_cat['product_cat_desc'];
            ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td><?php echo ucwords($pro_cat_name); ?></td>
                    <td><?php echo ucwords($pro_cat_desc); ?></td>
                    <td><a class="text-danger" href="index.php?del_p_cat=<?php echo $pro_cat_id; ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
                    <td><a href="index.php?edit_p_cat=<?php echo $pro_cat_id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                </tr>
            <?php $i++;} ?>
            </tbody>
        </table>
    </div>
</div>

            <?php } ?>