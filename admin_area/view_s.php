<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Slider
        </li>
    </ol>
</nav>
<div class="card rounded border ">
    <div class="card-header h3 py-2 border border-light">
       <i class="fa fa-money"></i> Title
    </div>
    <div class="card-body">
        <div class="row">
        <?php
        $get_slider="select * from carousel";
        $run_slider=mysqli_query($conn,$get_slider);
        $count_slider=mysqli_num_rows($run_slider);
        if($count_slider>0)
        {
            while($row_slider=mysqli_fetch_assoc($run_slider)){
                $slider_id=$row_slider['carousel_id'];
                $slider_title=$row_slider['carousel_title'];
                $slider_img=$row_slider['carousel_img'];
        ?>
            <div class="col-md-3">
                <div class="card rounded border border-primary">
                    <div class="card-header bg-primary py-1 text-center text-light" style="font-size:20px;"><?php echo $slider_title; ?></div>
                    <div class="card-img-top p-3"><img src="../img/slides_images/<?php echo $slider_img; ?>"
                            class="reponsive-img w-100" height="150" alt=""></div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6"><a href="index.php?del_c=<?php echo $slider_id; ?>" class="text-danger"><i class="fa fa-trash-o"></i> Delete</a></div>
                            <div class="col-md-6"><a href="index.php?edit_c=<?php echo $slider_id;?>" class="float-right"><i class="fa fa-pencil"></i> Edit</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
               }
            }
            ?>
        </div>
    </div>
</div>
<?php } ?>