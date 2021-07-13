<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_POST['add_p_cat'])){
        $p_cat_title=$_POST['p_cat_title'];
        $p_cat_desc=$_POST['p_cat_desc'];
        $set_p_cat="insert into product_categories (product_cat_name,product_cat_desc) values ('$p_cat_title' ,'$p_cat_desc')";
        $run_p_cat=mysqli_query($conn,$set_p_cat);
        if($run_p_cat){
            echo '<script>alert("New product category has been inserted successfully")</script>';
            echo '<script>window.open("index.php?view_p_cat","_self")</script>'; 
        }
    }
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Insert Product Category
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center mb-5">Insert New Product Category</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="p_cat_title">Product Category Title</label>
                    <input type="text" name="p_cat_title" class="form-control" id="p_cat_title" required>
                </div>
                <div class="form-group">
                    <label for="p_cat_desc">Product category description</label>
                    <textarea name="p_cat_desc" id="p_cat_desc" cols="30" rows="4" class="form-control" required></textarea>
                </div>
                <button class="btn btn-block btn-primary" name="add_p_cat" type="submit">Add new category</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>