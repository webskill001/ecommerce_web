<?php
include "includes/header.php";
include "includes/navbar.php";
$id="";
$idarr=array();
if(isset($_GET['p_cat'] ) && $_GET['p_cat']!="") {
     $id=$_GET['p_cat'];
     $idarr=array_filter(explode(':',$id));
     $idarr2=implode(",",$idarr);
}

$cid="";
$cidarr=array();
if(isset($_GET['cat_id'] ) && $_GET['cat_id']!="") {
     $cid=$_GET['cat_id'];
     $cidarr=array_filter(explode(':',$cid));
     $cidarr2=implode(",",$cidarr);
}
?>

<div class="container-fluid">
    <div class="container pt-3">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">shop</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <?php
                include "includes/sidebar.php";
                ?>
            </div>
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <?php
                    $count="";
                    if(isset($_GET['p_cat']) && $_GET['p_cat']!=""){
                        $id=$_GET['p_cat'];
                        $get_p_cat="select * from product_categories where product_cat_id='$idarr[1]'";
                        $res=mysqli_query($conn,$get_p_cat);
                        $count=mysqli_num_rows($res);
                        if($count>0){
                            $row=mysqli_fetch_assoc($res);
                            $p_cat_title=$row['product_cat_name'];
                            $p_cat_desc=$row['product_cat_desc'];
                            echo '<h3>'.ucwords($p_cat_title).'</h3>
                                    <p>'.ucwords($p_cat_desc).'</p>';
                        }
                    }else if(isset($_GET['cat_id'])   && $_GET['cat_id']!=""){
                        $id=$_GET['cat_id'];
                        $get_cat="select * from categories where cat_id='$cidarr[1]'";
                        $res=mysqli_query($conn,$get_cat);
                        $count=mysqli_num_rows($res);
                        if($count>0){
                            $row=mysqli_fetch_assoc($res);
                            $cat_title=$row['cat_name'];
                            $cat_desc=$row['cat_desc'];
                            echo '<h3>'.ucwords($cat_title).'</h3>
                                    <p>'.ucwords($cat_desc).'</p>';
                        }
                    }
                    if($count==0){
                        echo '<h3>Crop</h3>
                                <p>A crop is a plant or plant product that can be grown and harvested for profit or subsistence. By use, crops fall into six categories: food crops, feed crops, fiber crops, oil crops, ornamental crops, and industrial crops.
                                </p>';
                    }
                    ?>

                    </div>
                </div>

                <div class="row">
                    <?php
                    $get_pro="select * from products ";

                    if(isset($_GET['p_cat'])  && $_GET['p_cat']!=""){
                        $p_cat_id=$_GET['p_cat'];
                        $get_pro=$get_pro."where product_p_cat_id in ($idarr2)";
                    }
                    if(isset($_GET['cat_id']) && $_GET['cat_id']!=""){
                        $cat_id=$_GET['cat_id'] ;
                        $get_pro=$get_pro."where product_cat_id in ($cidarr2)";
                    }
                    if(isset($_GET['p_cat'])  && $_GET['p_cat']!="" && isset($_GET['cat_id']) && $_GET['cat_id']!=""){
                       $get_pro="select * from products where product_p_cat_id in ($idarr2) and product_cat_id in ($cidarr2)";
                    }
                        $res=mysqli_query($conn,$get_pro);
                        if(mysqli_num_rows($res)>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $pro_id=$row['product_id'];
                                $pro_name=$row['product_name'];
                                $pro_img=$row['product_img1'];
                                $pro_price=$row['product_price'];
                                $pro_key=$row['product_keyword'];?>
                                <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-img-top">
                                                <a href="details.php?pro_id=<?php  echo $pro_id; ?>"><img src="<?php  echo CUSTOMER_PRODUCT_IMG_PATH.$pro_img; ?>" class="img-thumbnail" alt="" style="width:253px;height:290px;"></a>
                                            </div>
                                            <div class="card-body p-1 py-3 text-center" >
                                                <a href="details.php?pro_id=<?php  echo $pro_id; ?>" class="text-dark">
                                                    <h5><?php  echo substr($pro_name,0,20)."..."; ?></h5>
                                                </a>
                                                <h5 style="text-transform:uppercase;color:blue;" class="text-center"><?php  echo getMinMaxProductPriceById($pro_id); ?></h5>
                                            </div>
                                            <div class="card-action pl-3 pb-2 ml-3">
                                                <a href="details.php?pro_id=<?php  echo $pro_id; ?>" class="btn btn-sm btn-grey <?php if($getUserSetting['website_status']!='Open'){echo "w-75";}?>" style="border:1px solid black">view details</a>
                                                <?php if($getUserSetting['website_status']=="Open"){?>
                                                <a href="" class="btn btn-sm btn-coupon"
                                                    style="background-color:rgb(17, 235, 206);color:white;border:1px solid rgb(14, 207, 182)"><i class="fa fa-shopping-cart mr-2"></i>Add to cart</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                            }
                        }
                        else{
                            echo '<div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            No any products available. 
                                        </div>
                                    </div>                            
                                </div>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>