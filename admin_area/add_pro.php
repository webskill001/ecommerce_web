<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    $prod_img2="";
    $prod_img3="";
    $keyExists="false";
if(isset($_POST['add_prod']))
{
    $prod_title=$_POST['p_name'];
    $prod_p_cat=$_POST['p_p_cat'];
    $prod_cat=$_POST['p_cat'];

    $prod_img1=$_FILES['p_img1']['name'];
    $tmp_dir_img1=$_FILES['p_img1']['tmp_name'];
    
    $prod_desc=$_POST['pro_desc'];
    $prod_key=$_POST['p_key'];

    $size_arr=$_POST['size'];
    $color_arr=$_POST['color'];
    $price_arr=$_POST['price'];
    $check_key=mysqli_query($conn,"select * from products where product_keyword='$prod_key'");
    if(mysqli_num_rows($check_key)==0){
        move_uploaded_file($tmp_dir_img1,CUSTOMER_PRODUCT_IMG_PATH.$prod_img1);
        if($_FILES['p_img2']['name']!=""){
            $prod_img2=$_FILES['p_img2']['name'];
            $tmp_dir_img2=$_FILES['p_img2']['tmp_name'];
            move_uploaded_file($tmp_dir_img2,CUSTOMER_PRODUCT_IMG_PATH.$prod_img2);
        }
        if($_FILES['p_img3']['name']!=""){
            $prod_img3=$_FILES['p_img3']['name'];
            $tmp_dir_img3=$_FILES['p_img3']['tmp_name'];
            move_uploaded_file($tmp_dir_img3,CUSTOMER_PRODUCT_IMG_PATH.$prod_img3);
        }
    
        $get_pro="INSERT INTO `products` (`product_name`, `product_p_cat_id`, `product_cat_id`, `product_crea_time`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `product_keyword`) VALUES ('$prod_title', '$prod_p_cat', '$prod_cat', current_timestamp(), '$prod_img1', '$prod_img2', '$prod_img3', '0', '$prod_desc', '$prod_key')";
        $res=mysqli_query($conn,$get_pro);
        if($res)
        {  
            $product_id=mysqli_insert_id($conn);
            foreach($size_arr as $key=>$value){
                $size=$value;
                $color=$color_arr[$key];
                $price=$price_arr[$key];
                $sql="insert into product_attribute (product_id,product_size,product_color,product_price,added_on) values('$product_id','$size','$color','$price',current_timestamp())";
                $res_attr=mysqli_query($conn,$sql);
            }
            echo '<script>window.open("index.php?view_prod","_self")</script>';
        }
    }else{
        $keyExists="true";
    }

    
}
?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Add New Product
        </li>
    </ol>
</nav>
<div class="card">
    <div class="bg-light w-100 p-3">
        <h3 class="text-center">Add New Product</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="p_name">Product Title</label>
                <input type="text" name="p_name" class="form-control" id="p_name" required>
            </div>

            <div class="product-categories form-group">
                <label for="p_p_cat">Product Categories</label>
                <select name="p_p_cat" id="" class="custom-select" required>
                    <option selected class="text-muted">choose product category</option>
                    <?php
                            $get_p_cat="select * from product_categories";
                            $res=mysqli_query($conn,$get_p_cat);
                            if(mysqli_num_rows($res))
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $p_cat_id=$row['product_cat_id'];
                                    $p_cat_name=$row['product_cat_name'];
                                    echo '<option value="'.$p_cat_id.'">'.ucwords($p_cat_name).'</option>';
                                }
                            }
                        ?>

                </select>
            </div>

            <div class="categories form-group">
                <label for="p_cat">Categories</label>
                <select name="p_cat" id="" class="custom-select" required>
                    <option selected class="text-muted">Choose Category</option>
                    <?php
                            $get_cat="select * from categories";
                            $res=mysqli_query($conn,$get_cat);
                            if(mysqli_num_rows($res))
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $cat_id=$row['cat_id'];
                                    $cat_name=$row['cat_name'];
                                    echo '<option value="'.$cat_id.'">'.ucwords($cat_name).'</option>';
                                }
                            }
                        ?>

                </select>
            </div>

            <div class="form-group">
                <label for="p_img1">Product Image 1</label>
                <input type="file" name="p_img1" class="form-control" id="p_img1" required>
            </div>

            <div class="form-group">
                <label for="p_img2">Product Image 2</label>
                <input type="file" name="p_img2" class="form-control" id="p_img2">
            </div>

            <div class="form-group">
                <label for="p_img3">Product Image 3</label>
                <input type="file" name="p_img3" class="form-control" id="p_img3">
            </div>

            <label for="">Product Atrributes</label>
            <div class="form-group" id="attribox1">
                <div class="row mb-2" id="box1">
                    <div class="col-md-3">
                        <input type="text" name="size[]" id="size" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="color[]" id="color" class="form-control"
                            required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="price[]" id="price" class="form-control"
                            required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="pro_desc">Product Description</label>
                <textarea name="pro_desc" id="pro_desc" class="form-control" cols="30" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="p_key">Product Keyword</label>
                <input type="text" name="p_key" class="form-control" id="p_key" required>
                <?php
                if($keyExists=="true"){
                ?>
                    <div class="text-danger">Keyword already exists. Please try with different keyword.</div>
                <?php } ?>
            </div>
            <div class="w-100 mt-5">
                <button class="btn btn-outline-secondary" role="submit" name="add_prod" role="button"><i
                        class="fa fa-user mr-2"></i> Add New Product</button>
                <button class="btn btn-success" type="button" onclick="add_attribute()"><i class="fa fa-plus"></i> Add
                    Attribute</button>
            </div>
        </form>
    </div>
</div>
<input type="hidden" name="attr" id="box_remove_id" value="1" />
<script>
function remove_box(id) {
    var box_remove = id;
    jQuery(id).remove();
}

function add_attribute() {
    var box_remove_id = jQuery('#box_remove_id').val();
    box_remove_id++;
    jQuery('#box_remove_id').val(box_remove_id);
    var html = '<div class="row mb-2" id="box' + box_remove_id +
        '"><div class="col-md-3"><input type="text" name="size[]" id="size" class="form-control" required></div><div class="col-md-3"><input type="text" name="color[]" id="color" class="form-control" required></div><div class="col-md-3"><input type="text" name="price[]" id="price" class="form-control" required></div><div class="col-md-3"><button class="btn btn-danger" onclick="remove_box(box' +
        box_remove_id + ')" type="button"><i class="fa fa-trash"></i> Remove</button></div></div>';
    jQuery('#attribox1').append(html);
}
</script>
<?php } ?>