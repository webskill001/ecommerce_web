<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_POST['add_slider'])){
        $slider_name=$_POST['slider_name'];

        $slider_image=$_FILES['slider_image']['name'];
        $dir_slider=$_FILES['slider_image']['tmp_name'];

        $check_slider="select * from carousel";
        $run_slider=mysqli_query($conn,$check_slider);
        $count=mysqli_num_rows($run_slider);
        if($count < 4)
        {
            move_uploaded_file($dir_slider,"../img/slides_images/".$slider_image);
            $set_slider="insert into carousel (carousel_img,carousel_title) values ('$slider_image','$slider_name')";
            $run_slider=mysqli_query($conn,$set_slider);
            if($run_slider){
                echo '<script>alert("New slider has been inserted successfully")</script>';
                echo '<script>window.open("index.php?view_slider","_self")</script>'; 
            }
        }else{
            echo '<script>alert("Slider already full ,Slider capacity is 4")</script>';
            echo '<script>window.open("index.php?view_slider","_self")</script>';
        }
        
    }
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Add New Slider
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center mb-5">Insert Slider</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="slider_name">Slider name</label>
                    <input type="text" name="slider_name" class="form-control" id="slider_name" required>
                </div>
                <div class="form-group">
                    <label for="slider_image">Slider image</label>
                    <input type="file" class="form-control" name="slider_image" id="slider_image" required>
                </div>
                <button class="btn btn-block btn-primary" name="add_slider" type="submit">Add New Slider</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>