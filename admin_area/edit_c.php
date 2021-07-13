<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_GET['edit_cat'])){
        $edid=$_GET['edit_cat'];
        $get_cat="select * from categories where cat_id='$edid'";
        $run_cat=mysqli_query($conn,$get_cat);
        $row_cat=mysqli_fetch_assoc($run_cat);
        $cat_title=$row_cat['cat_name'];
        $cat_desc=$row_cat['cat_desc'];

        if(isset($_POST['update_cat'])){
            $cat_title=$_POST['cat_title'];
            $cat_desc=$_POST['cat_desc'];
            $set_cat="update categories set cat_name='$cat_title' ,cat_desc='$cat_desc' where cat_id='$edid'";
            $run_cat=mysqli_query($conn,$set_cat);
            if($run_cat){
                echo '<script>alert("Category has been updateed successfully")</script>';
                echo '<script>window.open("index.php?view_cat","_self")</script>'; 
            }
    }
} 
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Edit Category
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center mb-5">Update Category</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="cat_title">Category Title</label>
                    <input type="text" name="cat_title" value="<?php echo $cat_title; ?>" class="form-control" id="cat_title" required>
                </div>
                <div class="form-group">
                    <label for="cat_desc">Category description</label>
                    <textarea name="cat_desc" id="cat_desc" cols="30" rows="4" class="form-control" required>
                        <?php echo $cat_desc; ?>"
                    </textarea>
                </div>
                <button class="btn btn-block btn-primary" name="update_cat" type="submit">Update</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>