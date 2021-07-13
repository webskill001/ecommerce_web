<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_GET['edit_c'])){
        $edid=$_GET['edit_c'];
        $get_slider="select * from carousel where carousel_id='$edid'";
        $run_slider=mysqli_query($conn,$get_slider);
        $row_slider=mysqli_fetch_assoc($run_slider);
        $slider_name=$row_slider['carousel_title'];
        $slider_img=$row_slider['carousel_img'];

        if(isset($_POST['update_slider'])){
            $slider_name=$_POST['slider_name'];
            $slider_img=$_FILES['slider_image']['name'];
            $slider_dir=$_FILES['slider_image']['tmp_name'];

            move_uploaded_file($slider_dir,"../img/slides_images/".$slider_img);
            $set_slider="update carousel set carousel_title='$slider_name' ,carousel_img='$slider_img' where carousel_id='$edid'";
            $run_slider=mysqli_query($conn,$set_slider);
            if($run_slider){
                echo '<script>alert("Slider has been updateed successfully")</script>';
                echo '<script>window.open("index.php?view_slider","_self")</script>'; 
            }
    }
} 
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Edit Slider
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center mb-5">Edit Slider</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="slider_name">Slider name</label>
                    <input type="text" name="slider_name" value="<?php echo $slider_name; ?>" class="form-control" id="slider_name" required>
                </div>
                <div class="form-group">
                    <label for="slider_image">Slider image</label>
                    <input type="file" class="form-control" value="<?php echo $slider_img; ?>" name="slider_image" id="slider_image" required>
                    <img src="../img/slides_images/<?php echo $slider_img; ?>"class="responsive-img border border-secondary mt-2"  width="70" height="70" alt="">
                </div>
                <button class="btn btn-block btn-primary" name="update_slider" type="submit">Add New Slider</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>