<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_GET['edit_p_cat'])){
        $edid=$_GET['edit_p_cat'];
        $get_p_cat="select * from product_categories where product_cat_id='$edid'";
        $run_p_cat=mysqli_query($conn,$get_p_cat);
        $row_p_cat=mysqli_fetch_assoc($run_p_cat);
        $p_cat_title=$row_p_cat['product_cat_name'];
        $p_cat_desc=$row_p_cat['product_cat_desc'];

        if(isset($_POST['update_p_cat'])){
            $p_cat_title=$_POST['p_cat_title'];
            $p_cat_desc=$_POST['p_cat_desc'];
            $set_p_cat="update product_categories set product_cat_name='$p_cat_title' ,product_cat_desc='$p_cat_desc' where product_cat_id='$edid'";
            $run_p_cat=mysqli_query($conn,$set_p_cat);
            if($run_p_cat){
                echo '<script>alert("Product category has been updateed successfully")</script>';
                echo '<script>window.open("index.php?view_p_cat","_self")</script>'; 
            }
    }
} 
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Edit Product Category
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center mb-5">Update Product Category</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="p_cat_title">Product Category Title</label>
                    <input type="text" name="p_cat_title" value="<?php echo $p_cat_title; ?>" class="form-control" id="p_cat_title" required>
                </div>
                <div class="form-group">
                    <label for="p_cat_desc">Product category description</label>
                    <textarea name="p_cat_desc" id="p_cat_desc" cols="30" rows="4" class="form-control" required>
                        <?php echo $p_cat_desc; ?>"
                    </textarea>
                </div>
                <button class="btn btn-block btn-primary" name="update_p_cat" type="submit">Update</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>