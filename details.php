<?php
include "includes/header.php";
include "includes/navbar.php";
$color="";
$size="";
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

<?php //addcart(); ?>
<div class="container-fluid">
    <div class="container pt-3">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <?php
                if(isset($_GET['pro_id']))
                {
                    $pro_id=$_GET['pro_id'];
                    $getpro="select * from products where product_id='$pro_id'";
                    $res=mysqli_query($conn,$getpro);
                    $count=mysqli_num_rows($res);
                    $row=mysqli_fetch_assoc($res);
                    $pro_c_id=$row['product_p_cat_id'];
                    $pro_name=$row['product_name'];
                    $pro_desc=$row['product_desc'];
                    $pro_price=$row['product_price'];
                    $pro_img1=$row['product_img1'];
                    $pro_img2=$row['product_img2'];
                    $pro_img3=$row['product_img3'];
                    $pro_key=$row['product_keyword'];
                    $getpcat="select * from product_categories where product_cat_id='$pro_c_id'";
                    $res1=mysqli_query($conn,$getpcat);
                    $row1=mysqli_fetch_assoc($res1);
                    $p_cat_name=$row1['product_cat_name'];
                
                ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">details</li>
                <li class="breadcrumb-item active" area-current="page"><a href="shop.php?p_cat=<?php echo $pro_c_id; ?>"><?php echo ucwords($p_cat_name); ?></a></li>
                <li class="breadcrumb-item active" area-current="page"><?php echo ucwords($pro_name); ?> (<?php echo ucwords($pro_key); ?>)</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                        <div class="carousel slide" data-ride="carousel" id="product_details_carousel">
                            <ol class="carousel-indicators">
                                <li data-slide-to="0" data-target="#product_details_carousel" class="active"></li>
                                <?php
                                if($pro_img2!=""){
                                    echo '<li data-slide-to="1" data-target="#product_details_carousel"></li>';
                                }
                                if($pro_img3!=""){
                                    echo '<li data-slide-to="2" data-target="#product_details_carousel"></li>';
                                }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active" style="height:550px;" >
                                    <img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$pro_img1; ?>"alt=""
                                        class="w-100  h-100 d-block responsive-img">
                                </div>
                                <?php
                                if($pro_img2!=""){
                                    echo '<div class="carousel-item" style="height:550px;" >
                                            <img src="'.CUSTOMER_PRODUCT_IMG_PATH.$pro_img2.'" alt=""
                                            class="w-100 h-100 d-block responsive-img">
                                        </div>';
                                }
                                if($pro_img3!=""){
                                    echo '<div class="carousel-item" style="height:550px;" >
                                            <img src="'.CUSTOMER_PRODUCT_IMG_PATH.$pro_img3.'" alt=""
                                            class="w-100 h-100 d-block responsive-img">
                                        </div>';
                                }
                                ?>
                            </div>
                            <?php
                            if($pro_img2!="" or $pro_img3!=""){
                                echo '<a href="#product_details_carousel" class="carousel-control-prev" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a href="#product_details_carousel" class="carousel-control-next" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 border-0">
                        <form id="formcart" >
                            <div class="card">
                                <div class="card-body text-center">
                                    <h3><?php echo $pro_name; ?></h3>

                                   
                                    <div class="product_size mt-3">
                                        <div class="row">
                                            <div class="col-md-5 p-0">
                                                <label for="#product_size" style="text-transform:capitalize;">product
                                                    size</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select name="product_size" id="product_size" onchange="pro_size()"
                                                    class="custom-select d-inline" required>
                                                    <option value="" selected>Select size</option>
                                                    <?php  
                                                    $sql="select product_size from product_attribute where product_id='$pro_id'";
                                                    $res=mysqli_query($conn,$sql);
                                                    $arr=array();
                                                    foreach($row_size=mysqli_fetch_all($res,MYSQLI_ASSOC) as $list){
                                                        $arr[]=$list['product_size'];
                                                    }
                                                    $row_size=array_unique($arr);
                                                    foreach($row_size as $key=>$value){
                                                        $selected="";
                                                    ?>
                                                    
                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" id="type" value="size">
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="product_color mt-3">
                                        <div class="row">
                                            <div class="col-md-5 p-0">
                                                <label for="#product_color" style="text-transform:capitalize;">product
                                                    color</label>
                                            </div>
                                            <div class="col-md-7">
                                            <select name="product_color" id="product_color" onchange="pro_color()"
                                                    class="custom-select d-inline" required>
                                                    <option value="" selected>Select color</option>
                                                    
                                                </select>
                                                <input type="hidden" id="type1" value="color">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product_quantity">
                                        <div class="row pt-2">
                                            <div class="col-md-5 p-0">
                                                <label for="#product_quantity"
                                                    style="text-transform:capitalize;">Product
                                                    quantity</label>
                                            </div>
                                            
                                            <div class="col-md-7">
                                            <div class="btn-group btn-group-sm float-left mt-2" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-light border-dark" onclick="removeitem(<?php echo $pro_id; ?>)" id="subtract"><i class="fa fa-minus"></i></button>
                                                <input type="text" name="product_quantity" id="show_<?php echo $pro_id; ?>" readonly value="0" style="min-width:20px;max-width:50px;" class="text-center"  required>
                                                <button type="button" class="btn btn-light border-dark" onclick="additem(<?php echo $pro_id; ?>)"><i class="fa fa-plus"></i></button>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_price">
                                        <div class="row pt-2">
                                            <div class="col-md-5 p-0">
                                                <label for="#product_price"
                                                    style="text-transform:capitalize;">Product
                                                    price</label>
                                            </div>
                                            <div class="col-md-7 h4 text-left" id="product_price" ><?php echo getMinMaxProductPriceById($pro_id); ?></div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                if($getUserSetting['website_status']=="Open"){
                                    ?>
                                    <div class="card-action mb-5 text-center"> 
                                        <button class="btn text-light" role="button" name="add_cart" type="submit" id="add_cart"
                                        style="background-color:"><i class="fa fa-shopping-cart mr-2"></i>add to
                                        cart</button><div class="text-danger" id="message_added_cart_<?php echo $pro_id; ?>"></div>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="card-action mb-5 text-center">
                                        <h5><?php echo $getUserSetting['website_close_message']; ?></h5>
                                    </div>
                                    <?php 
                                }
                                ?>
                            </div>
                            
                            <input type="hidden" name="type" value="addToCart" id="addToCart">
                        </form>
                        <div class="row mt-3 ml-1 mb-2 my-5">
                            <div class="col-md-4" style="box-size:border-box;">
                                <div class="card">
                                    <div class="card-img-top">
                                        <a href="">
                                            <img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$pro_img1; ?>" alt="" style="height:90px;width:100px;" class=" w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php if($pro_img2!=""){ ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-img-top">
                                        <a href="">
                                            <img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$pro_img2; ?>" alt="" style="height:90px;width:100px;" class=" w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php }if($pro_img3!=""){ ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-img-top">
                                        <a href="">
                                            <img src="<?php echo CUSTOMER_PRODUCT_IMG_PATH.$pro_img3; ?>" alt="" style="height:90px;width:100px;" class="w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="row my-3">
                    <div class="col-md-12" >
                        <div class="card">
                            <div class="card-body text-muted">
                                <span class="card-title h4 " style="text-transform:capitalize;">product details</span>
                                <div style="max-height:300px;overflow-y:auto;">
                                <p class="mt-2"><pre style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;"><?php echo $pro_desc; ?></pre></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        
                <?php } ?>

        <div class="row pb-3">
            <div class="col-md-3">
                <div class="card text-center">
                    <h4 style="text-transform:capitalize;" class="pt-4">you also like this products.</h4>
                    <div style="min-height:200px"></div>
                </div>
            </div>
            <?php getprod(3) ?>
        </div>
    </div>
</div>
</div>
<input type="hidden" name="pro_id" value="<?php echo $_GET['pro_id']; ?>" id="proid">
<script>
var WEBSITE_PATH="<?php echo WEBSITE_PATH; ?>";


function userFullCart(){
    var size=jQuery('#product_size').val();
    var color=jQuery('$product_color').val();
    alert(size+" "+color);
}
</script>
<?php
include "includes/footer.php";
?>

