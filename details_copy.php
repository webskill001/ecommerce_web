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
            <div class="col-md-3">
                <?php
                include "includes/sidebar.php";
                ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="carousel slide" data-ride="carousel" id="product_details_carousel">
                            <ol class="carousel-indicators">
                                <li data-slide-to="0" data-target="#product_details_carousel" class="active"></li>
                                <li data-slide-to="1" data-target="#product_details_carousel"></li>
                                <li data-slide-to="2" data-target="#product_details_carousel"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active" style="height:480px;" >
                                    <img src="img/product_images/<?php echo $pro_img1; ?>"alt=""
                                        class="w-100  h-100 d-block responsive-img">
                                </div>
                                <div class="carousel-item" style="height:480px;" >
                                    <img src="img/product_images/<?php echo $pro_img2; ?>" alt=""
                                        class="w-100 h-100 d-block responsive-img">
                                </div>
                                <div class="carousel-item" style="height:480px;" >
                                    <img src="img/product_images/<?php echo $pro_img3; ?>" alt=""
                                        class="w-100 h-100 d-block responsive-img">
                                </div>
                            </div>
                            <a href="#product_details_carousel" class="carousel-control-prev" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a href="#product_details_carousel" class="carousel-control-next" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 border-0">
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
                                                    $sql="select * from product_attribute where product_id='$pro_id'";
                                                    $res=mysqli_query($conn,$sql);
                                                    while($row_size=mysqli_fetch_assoc($res)){
                                                        $selected="";
                                                        if(isset($_GET['psize']) && $_GET['psize']!=""){
                                                            if($_GET['psize']==$row_size['product_size']){
                                                                $selected="selected";
                                                            }
                                                        }
                                                    ?>
                                                    
                                                    <option <?php echo $selected; ?> value="<?php echo $row_size['product_size']; ?>"><?php echo $row_size['product_size']; ?></option>
                                                    <?php } ?>
                                                </select>
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
                                            <select name="product_color" id="product_color" onchange="pro_size()"
                                                    class="custom-select d-inline" required>
                                                    <option value="" selected>Select color</option>
                                                    <?php  
                                                    $size=$_GET['psize'];
                                                    $sql="select * from product_attribute where product_id='$pro_id' and product_size='$size' ";
                                                    $res=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($res)){
                                                        while($row_color=mysqli_fetch_assoc($res)){
                                                            $color=$row_color['product_color'];
                                                            $colorselected="";
                                                            if(isset($_GET['color']) && $_GET['color']!=""){
                                                                if($_GET['color']==$color){
                                                                    $colorselected="selected";
                                                                }
                                                            }
                                                        ?>
                                                        <option <?php echo $colorselected; ?> style="color:<?php echo ucwords($color); ?>;" value="<?php echo $row_color['product_color']; ?>"><?php echo ucwords($color); ?></option>
                                                        <?php } 
                                                    } ?>
                                                </select>
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
                                                <button type="button" class="btn btn-light border-dark" onclick="removeitem()" id="subtract"><i class="fa fa-minus"></i></button>
                                                <input type="text" name="product_quantity" id="show" readonly value="0" style="min-width:20px;max-width:50px;" class="text-center"  required>
                                                <button type="button" class="btn btn-light border-dark" onclick="additem()"><i class="fa fa-plus"></i></button>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-dark float-left h4">INR <?php 
                                        if(isset($_GET['psize']) && isset($_GET['color']) && $_GET['color']!="" && $_GET['psize']!=""){
                                            $productsize=$_GET['psize'];
                                            $productcolor=$_GET['color'];
                                            $getattr="select * from product_attribute where product_id='$pro_id' and product_size='$productsize' and product_color='$productcolor'";
                                            $resattr=mysqli_query($conn,$getattr);
                                            if(mysqli_num_rows($resattr)>0){
                                                $rowprice=mysqli_fetch_assoc($resattr);
                                                echo $price=$rowprice['product_price'];
                                                $_SESSION['size']=$_GET['psize'];
                                                $_SESSION['color']=$_GET['color'];
                                            }else{
                                                echo "NA";
                                            }
                                        }else{
                                            echo "NA";
                                        }
                                    ?></div>


                                </div>
                                <div class="card-action mb-5 text-center">
                                    <?php
                                    $disabled="";
                                     if(!isset($_GET['psize']) or !isset($_GET['color']) or $_GET['color']=="" or $_GET['psize']==""){
                                        $disabled="disabled"; 
                                     }?>
                                        <button <?php echo $disabled; ?> class="btn text-light" role="button" name="add_cart" type="submit"
                                        style="background-color:"><i class="fa fa-shopping-cart mr-2"></i>add to
                                        cart</button><div class="text-danger" id="message_added_cart_<?php echo $pro_id; ?>"></div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="type" value="addToCart" id="addToCart">
                        </form>
                        <div class="row mt-3 ml-1 mb-2">
                            <div class="col-md-3" style="box-size:border-box;">
                                <div class="card">
                                    <div class="card-img-top">
                                        <a href="">
                                            <img src="img/product_images/<?php echo $pro_img1; ?>" alt="" height="60px" class=" w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img-top">
                                        <a href="">
                                            <img src="img/product_images/<?php echo $pro_img2; ?>" alt="" height="60px" class=" w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img-top">
                                        <a href="">
                                            <img src="img/product_images/<?php echo $pro_img3; ?>" alt="" height="60px" class="w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-muted">
                                <span class="card-title h4 " style="text-transform:capitalize;">product details</span>
                                <p class="mt-2"><?php echo $pro_desc; ?></p>
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
<form id="formSize" method="get">
    <input type="hidden" name="pro_id" value="<?php echo $_GET['pro_id']; ?>" id="proid">
    <input type="hidden" name="psize" id="psize">
    <input type="hidden" id="color" name="color">
</form>

<script>
var WEBSITE_PATH="<?php echo WEBSITE_PATH; ?>";
function additem(){
     var add=jQuery('#show').val();
     add++;
     if(add>=100){
         add=100;
         var html="You cannot buy more than 100 items."
         jQuery('#message').html(html);
     }
     jQuery('#show').val(add);
}

function removeitem(){
    var subtract=jQuery('#show').val();
     subtract--;
     if(subtract<=0){
         subtract=0;
     }
     jQuery('#show').val(subtract);
}

function get_color(){
    var pro_color=jQuery('#product_color').val();
    jQuery('#color').val(pro_color);
}

function pro_size(){
    var pro_size=jQuery('#product_size').val();
    jQuery('#psize').val(pro_size);
    var pro_color=jQuery('#product_color').val();
    jQuery('#color').val(pro_color);
    jQuery('#formSize')[0].submit();
}

function userFullCart(){
    var size=jQuery('#product_size').val();
    var color=jQuery('$product_color').val();
    alert(size+" "+color);
}
</script>
<?php
include "includes/footer.php";
?>

