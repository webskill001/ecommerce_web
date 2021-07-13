<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_POST['add_cat'])){
        $cat_title=$_POST['cat_title'];
        $cat_desc=$_POST['cat_desc'];
        $set_cat="insert into categories (cat_name,cat_desc) values ('$cat_title' ,'$cat_desc')";
        $run_cat=mysqli_query($conn,$set_cat);
        if($run_cat){
            echo '<script>alert("New category has been inserted successfully")</script>';
            echo '<script>window.open("index.php?view_cat","_self")</script>'; 
        }
    }
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Insert Category
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center mb-5">Insert New Category</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="cat_title">Category Title</label>
                    <input type="text" name="cat_title" class="form-control" id="cat_title" required>
                </div>
                <div class="form-group">
                    <label for="cat_desc">category description</label>
                    <textarea name="cat_desc" id="cat_desc" cols="30" rows="4" class="form-control" required></textarea>
                </div>
                <button class="btn btn-block btn-primary" name="add_cat" type="submit">Add new category</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>