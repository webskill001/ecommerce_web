<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    if(isset($_GET['edit_pro'])){
        $pro_id=$_GET['edit_pro'];
        $get_prod="select * from products where product_id='$pro_id'";
        $run_prod=mysqli_query($conn,$get_prod);
        $row_product=mysqli_fetch_assoc($run_prod);
        $pro_name=$row_product['product_name'];
        $pro_img1=$row_product['product_img1'];
        $pro_img2=$row_product['product_img2'];
        $pro_img3=$row_product['product_img3'];
        $pro_desc=$row_product['product_desc'];
        $pro_keyword=$row_product['product_keyword'];

        $pro_p_cat_id=$row_product['product_p_cat_id'];
        $get_p_cat="select * from product_categories where product_cat_id='$pro_p_cat_id'";
        $run_p_cat=mysqli_query($conn,$get_p_cat);
        $row_p_cat=mysqli_fetch_assoc($run_p_cat);
        $pro_cat_name=$row_p_cat['product_cat_name'];

        $cat_id=$row_product['product_cat_id'];
        $get_cat="select * from categories where cat_id='$cat_id'";
        $run_cat=mysqli_query($conn,$get_cat);
        $row_cat=mysqli_fetch_assoc($run_cat);
        $cat_name=$row_cat['cat_name']; 
        
    }
if(isset($_POST['update']))
{
    
    $prod_title=$_POST['p_name'];
    $prod_p_cat=$_POST['p_p_cat'];
    $prod_cat=$_POST['p_cat'];

    $prod_desc=$_POST['ckeditor'];
    $prod_key=$_POST['p_key'];
    
    if($prod_img1=$_FILES['p_img1']['name']){
        $prod_img1=$_FILES['p_img1']['name'];
        $tmp_dir_img1=$_FILES['p_img1']['tmp_name'];
        move_uploaded_file($tmp_dir_img1,"../customer/customer_p_images/".$prod_img1);
    }

    if($prod_img2=$_FILES['p_img2']['name']){
        $prod_img2=$_FILES['p_img2']['name'];
        $tmp_dir_img2=$_FILES['p_img2']['tmp_name'];
        move_uploaded_file($tmp_dir_img2,"../customer/customer_p_images/".$prod_img2);
    }

    if($prod_img3=$_FILES['p_img3']['name']){
        $prod_img3=$_FILES['p_img3']['name'];
        $tmp_dir_img3=$_FILES['p_img1']['tmp_name'];
        move_uploaded_file($tmp_dir_img3,"../customer/customer_p_images/".$prod_img3);
    }

    $get_pro="update products set product_name='$prod_title', product_p_cat_id='$prod_p_cat' ,product_cat_id='$prod_cat', product_price='0', product_desc='$prod_desc', product_keyword='$prod_key'";
    if($prod_img1!=""){
        $get_pro=$get_pro.", product_img1='$prod_img1'";
    }
    if($prod_img2!=""){
        $get_pro=$get_pro.", product_img2='$prod_img2'";
    }
    if($prod_img3!=""){
        $get_pro=$get_pro.", product_img3='$prod_img3'";
    }
    $get_pro=$get_pro." where product_id='$pro_id'";
    $res=mysqli_query($conn,$get_pro);
    if($res)
    {
        $size_arr=$_POST['size'];
        $color_arr=$_POST['color'];
        $price_arr=$_POST['price'];
        $boxidarr=$_POST['box_id'];
        $product_id=mysqli_insert_id($conn);
        $res=mysqli_query($conn,"select attribute_id from product_attribute where product_id='$pro_id'");
        $get_pro_attr_id=mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach($size_arr as $key=>$value){
            $size=$value;
            $color=$color_arr[$key];
            $price=$price_arr[$key];
            if(isset($boxidarr[$key])){
                $attribute=$get_pro_attr_id[$key];
                $attribute_id=$attribute['attribute_id'];
                $sql="update product_attribute set product_size='$size',product_color='$color',product_price='$price' where attribute_id='$attribute_id'";
                $res_attr=mysqli_query($conn,$sql);
            }else{
                $sql="insert into product_attribute (product_id,product_size,product_color,product_price,added_on) values('$pro_id','$size','$color','$price',current_timestamp())";
                $res_attr=mysqli_query($conn,$sql);
            }
            
        }
        echo '<script>alert("Product updated successfully")</script>';
        echo '<script>window.open("index.php?view_prod","_self")</script>';
    }else{
        echo '<script>alert("error")</script>';
    }
}else if(isset($_GET['attr_id'])){
    $attr_id=$_GET['attr_id'];
    mysqli_query($conn,"delete from product_attribute where attribute_id='$attr_id'");
    echo '<script>window.open("index.php?edit_pro='.$pro_id.'","_self")</script>';
}
?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Update Product
        </li>
    </ol>
</nav>
<div class="card">
    <div class="bg-light w-100 p-3">
        <h3 class="text-center">Update Product</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="p_name">Product Title</label>
                <input type="text" name="p_name" value="<?php echo $pro_name; ?>" class="form-control" id="p_name"
                    required>
            </div>

            <div class="product-categories form-group">
                <label for="p_p_cat">Product Categories</label>
                <select name="p_p_cat" id="" class="custom-select" required>
                    <option selected class="text-muted" value="<?php echo $pro_p_cat_id; ?>" selected>
                        <?php echo $pro_cat_name; ?></option>
                    <option class="text-muted">choose product category</option>
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
                <select name="p_cat" id="p_cat" class="custom-select" required>
                    <option selected class="text-muted" value="<?php echo $cat_id; ?>" selected><?php echo $cat_name; ?>
                    </option>
                    <option class="text-muted">Choose Category</option>
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
                <input type="file" name="p_img1" class="form-control" id="p_img1"
                    value="<?php echo $pro_img1; ?>">
            </div>

            <div class="form-group">
                <label for="p_img2">Product Image 2</label>
                <input type="file" name="p_img2" class="form-control" id="p_img2"
                    value="<?php echo $pro_img2; ?>">
            </div>

            <div class="form-group">
                <label for="p_img3">Product Image 3</label>
                <input type="file" name="p_img3" class="form-control" id="p_img3"
                    value="<?php echo $pro_img3; ?>">
            </div>

            <label for="">Product Atrributes</label>
            <div class="form-group" id="attribox1">
                <?php
            $i=1;
            $get_attri="select * from product_attribute where product_id='$pro_id'";
            $res_attri=mysqli_query($conn,$get_attri);
            while($row_attri=mysqli_fetch_assoc($res_attri)){
                if($i==1){
            ?>
                <div class="row mb-2" id="box1">
                    <div class="col-md-3">
                        <input type="hidden" name="box_id[]" id="box_id" value="<?php echo $row_attri['attribute_id']; ?>" />
                        <input type="text" name="size[]" id="size" class="form-control"
                            value="<?php echo $row_attri['product_size']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="color[]" id="color" class="form-control"
                            value="<?php echo $row_attri['product_color']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="price[]" id="price" class="form-control"
                            value="<?php echo $row_attri['product_price']; ?>" required>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="row mb-2" id="box1">
                    <div class="col-md-3">
                        <input type="hidden" name="box_id[]" id="box_id" value="<?php echo $row_attri['attribute_id']; ?>" />
                        <input type="text" name="size[]" id="size" class="form-control"
                            value="<?php echo $row_attri['product_size']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="color[]" id="color" class="form-control"
                            value="<?php echo $row_attri['product_color']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="price[]" id="price" class="form-control"
                            value="<?php echo $row_attri['product_price']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-danger" onclick="remove_box_edit(<?php echo $row_attri['attribute_id']; ?>)" type="button"><i
                                class="fa fa-trash"></i> Remove</button>
                    </div>
                </div>
                <?php }$i++; } ?>
            </div>

            <div class="form-group">
                <label for="ckeditor">Product Description</label>
                <textarea name="ckeditor" id="ckeditor" class="form-control"
                    required><?php echo $pro_desc; ?></textarea>
            </div>

            <div class="form-group">
                <label for="p_key">Product Keyword</label>
                <input type="text" name="p_key" class="form-control" id="p_key" required
                    value="<?php echo $pro_keyword; ?>">
            </div>
            <div class="w-100 mt-5">
                <button class="btn btn-outline-secondary" role="submit" name="update" role="button"><i
                        class="fa fa-user mr-2"></i> Update Product</button>
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
        '"><div class="col-md-3"><input type="text" name="size[]" id="size" class="form-control" placeholder="Size..." required></div><div class="col-md-3"><input type="text" name="color[]" id="color" class="form-control" placeholder="Color..." required></div><div class="col-md-3"><input type="text" name="price[]" id="price" class="form-control" placeholder="Price..." required></div><div class="col-md-3"><button class="btn btn-danger" onclick="remove_box(box' +
        box_remove_id + ')" type="button"><i class="fa fa-trash"></i> Remove</button></div></div>';
    jQuery('#attribox1').append(html);
}

function remove_box_edit(id){
    if(confirm("Are you Sure?")){
       var curr_path=window.location.href;
       window.location.href=curr_path+"&attr_id="+id;
    }
}

</script>

<?php } ?>