<?php
include "includes/header.php";
include "includes/navbar.php";
// print_r(getMinMaxProductPriceById(10))
?>

<div class="container-fluid" style="background-color:rgba(236, 233, 233, 0.938);">
<?php if($getUserSetting['website_status']=="Close"){?>
    <h5 class="text-center pt-2"><?php echo $getUserSetting['website_close_message'] ?></h5>
    <?php } ?>
    <div class="container pt-2" id="slider">
        <!-- container Begin -->

        <div class="col-md-12">
            <!-- col-md-12 Begin -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <?php
                $get_carousel="select * from carousel limit 0,1";
                $res=mysqli_query($conn,$get_carousel);
                if(mysqli_num_rows($res)>0)
                {
                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>'; 
                
                }
                ?>
                <?php
                $get_carousel="select * from carousel limit 1,4";
                $res=mysqli_query($conn,$get_carousel);
                if(mysqli_num_rows($res)>0)
                {
                    for($i=1;$i<=mysqli_fetch_assoc($res);$i++)
                    {
                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>'; 
                    }
                }
                ?>
                    
                </ol>
                <div class="carousel-inner">
                <?php
                $get_carousel="select * from carousel limit 0,1";
                $res=mysqli_query($conn,$get_carousel);
                if(mysqli_num_rows($res)>0)
                {
                    $row=mysqli_fetch_assoc($res);
                    $car_img=$row['carousel_img'];
                    echo '<div class="carousel-item active">
                            <img src="img/slides_images/'.$car_img.'" height="500" class="d-block w-100" alt="...">
                            </div>';
                }
                ?>
                <?php
                $get_carousel2="select * from carousel limit 1,5";
                $res2=mysqli_query($conn,$get_carousel2);
                while($row2=mysqli_fetch_assoc($res2))
                {
                    
                    $car_img=$row2['carousel_img'];
                    echo '<div class="carousel-item">
                            <img src="img/slides_images/'.$car_img.'" height="500" class="d-block w-100" alt="...">
                            </div>';
                }
                ?>
                    
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div><!-- col-md-12 Finish -->

    </div><!-- container Finish -->

    <!-- advantage field -->
    <div class="advantage mt-3">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="same-ht card">
                        <div class="card-body" style="text-align:center;">
                            <div class="icon">
                            <i class="fa fa-heart"></i>
                            </div>
                            <h3 style="text-transform:uppercase;"><a href="">best prices</a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, perferendis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="same-ht card">
                        <div class="card-body" style="text-align:center;">
                            <div class="icon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <h3 style="text-transform:uppercase;"><a href="">100% satisfaction guranted from us</a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="same-ht card">
                        <div class="card-body" style="text-align:center;">
                            <div class="icon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <h3 style="text-transform:uppercase;"><a href="">we love out customers</a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, perferendis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- lastest week box -->
    <div class="col-md-12 card my-5">
        <div class="card-body w-100 text-center h1 text-primary" style="text-transform:uppercase;font-weight:100;">
            latest this week
        </div>
    </div>


    <!-- products -->
    <div class="container">
        <div class="row">
            <?php
            $getUserSetting=getUserSetting();
            $get_prod="select * from products  order by product_id desc limit 0,4";
            $res=mysqli_query($conn,$get_prod);
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_assoc($res)){
                    $product_id=$row['product_id'];
                    $product_name=$row['product_name'];
                    $product_img=$row['product_img1'];
                    $product_price=$row['product_price'];
                    $product_keyword=$row['product_keyword'];
                ?>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-img-top">
                            <a href="details.php?pro_id=<?php echo $product_id; ?>"><img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$product_img; ?>" alt="" id="main_pro" class="responsive-img img-thumbnail" style="width:253px;height:290px;"></a>
                        </div>
                        <div class="card-body p-1 py-3" style="text-align:center;">
                            <a href="details.php?pro_id=<?php echo $product_id ?>" class="text-dark"><h5><?php echo substr($product_name,0,20)."...";?></h5></a>
                            <h5 style="color:blue;"><?php  echo getMinMaxProductPriceById($product_id); ?></h5>
                        </div>
                        <div class="card-action pl-3 pb-2 ml-3">
                            <a href="details.php?pro_id=<?php echo $product_id;?>" class="btn btn-sm <?php if($getUserSetting['website_status']!='Open'){echo "w-75";} ?>"
                                style="border:1px solid black">view details</a>
                                <?php
                                $getUserSetting=getUserSetting();
                                if($getUserSetting['website_status']=="Open"){?>
                                    <a href="" class="btn btn-sm"
                                    style="background-color:rgb(17, 235, 206);color:white;border:1px solid rgb(14, 207, 182)"><i class="fa fa-shopping-cart mr-2"></i>Add to cart</a>
                                <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                }
            }else{ ?>
        <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body h4 text-center">
                        No any Products In the Database.
                    </div>
                </div>
            </div>
    <?php } ?>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>