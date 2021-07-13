<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    $getUserSetting=getUserSetting();
    $cart_min_price=$getUserSetting['cart_min_price'];
    $cart_min_message=$getUserSetting['cart_min_message'];
    $website_status=$getUserSetting['website_status'];
    $website_close_message=$getUserSetting['website_close_message'];
    $cs=array("Close","Open");
    $update="false";
    if(isset($_POST['setting'])){
        $cart_min_price=$_POST['cart_min_price'];
        $cart_min_message=$_POST['cart_min_message'];
        $website_status=$_POST['website_status'];
        $website_close_message=$_POST['website_close_message'];
        $set_cat="update setting set cart_min_price='$cart_min_price',cart_min_message='$cart_min_message',website_status='$website_status',website_close_message='$website_close_message' where setting_id='1'";
        $run_cat=mysqli_query($conn,$set_cat);
        if($run_cat){
            $update="true";
        }
    }
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Setting
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center">Setting</h3>
            <?php 
            if($update=="true"){
                echo '<div class="text-center text-success mb-5">Your setting has been updated successfully</div>';
                $update="false";
            }else{
                echo '<div class="mb-5"></div>';
            }
            ?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label for="cart_min_price">Cart minimum price</label>
                    <input type="number" name="cart_min_price" class="form-control" value="<?php echo $cart_min_price; ?>" id="cart_min_price" required>
                </div>
                <div class="form-group">
                    <label for="cart_min_message">Cart minimum price message</label>
                    <input type="text" name="cart_min_message" class="form-control" value="<?php echo $cart_min_message; ?>" id="cart_min_message" required>
                </div>
                <div class="form-group">
                    <label for="website_status">Website status</label>
                    <select name="website_status" id="website_status" class="custom-select">
                    <option value="">select status</option>
                    <?php
                    foreach($cs as $key=>$list){
                        $selected="";
                        if($list==$website_status){
                            $selected="selected";
                        }
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $list; ?>"><?php echo $list; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="website_close_message">Website status message</label>
                    <input type="text" name="website_close_message" class="form-control" value="<?php echo $website_close_message; ?>" id="website_close_message">
                </div>
                <button class="btn btn-block btn-primary" name="setting" type="submit">Update Setting</button>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>