<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    $coupon_name="";
    $coupon_type="";
    $coupon_value="";
    $coupon_ex_on="";
    $required="";
    $cart_min_price="";
    $coupon_arr=array("percentage","fixed");
    if(isset($_POST['add_coupon'])){
        $required="required";
        $coupon_name=$_POST['coupon_title'];
        $coupon_type=$_POST['coupon_type'];
        $coupon_value=$_POST['coupon_value'];
        $coupon_ex_on=$_POST['coupon_ex_on'];
        $cart_min_price=$_POST['cart_min_price'];
        $checkcoupon=mysqli_query($conn,"select * from coupon_code where coupon_title='$coupon_name'");
        if(mysqli_num_rows($checkcoupon)>0){
            $_SESSION['coupon_exists_message']='<div class="text-danger">Coupon code already exists</div>';
        }else{
            $set_coupon="insert into coupon_code (coupon_title,coupon_type,coupon_value,coupon_expire,status,cart_min_value) values ('$coupon_name' ,'$coupon_type','$coupon_value','$coupon_ex_on','0','$cart_min_price')";
            $run_coupon=mysqli_query($conn,$set_coupon);
            if($run_coupon){
                $_SESSION['success_message']='Coupon code has been inserted successfully';
                echo '<script>window.open("index.php?view_coupon","_self")</script>'; 
            }
        }
    }else if(isset($_GET['eid']) && $_GET['eid']>0){
        $eid=$_GET['eid'];
        $get_coupon=mysqli_query($conn,"select * from coupon_code where coupon_id='$eid'");
        $rowcoupon=mysqli_fetch_assoc($get_coupon);
        $coupon_name=$rowcoupon['coupon_title'];
        $coupon_type=$rowcoupon['coupon_type'];
        $coupon_value=$rowcoupon['coupon_value'];
        $coupon_ex_on=$rowcoupon['coupon_expire'];
        $cart_min_price=$rowcoupon['cart_min_value'];

        if(isset($_POST['update_coupon'])){
            $coupon_name=$_POST['coupon_title'];
            $coupon_type=$_POST['coupon_type'];
            $coupon_value=$_POST['coupon_value'];
            $cart_min_price=$_POST['cart_min_price'];
            if($coupon_ex_on!=""){$coupon_ex_on=$_POST['coupon_ex_on'];}
            
            $checkcoupon=mysqli_query($conn,"select * from coupon_code where coupon_title='$coupon_name'");
            if(mysqli_num_rows($checkcoupon)>0){
                $_SESSION['coupon_exists_message']='<div class="text-danger">Coupon code already exists</div>';
            }else{
                $sqlcoupon="update coupon_code set coupon_title='$coupon_name',coupon_type='$coupon_type',coupon_value='$coupon_value',cart_min_value='$cart_min_price'";
                if($coupon_ex_on!=""){
                    $sqlcoupon=$sqlcoupon.",coupon_expire='$coupon_ex_on'";
                }
                $sqlcoupon=$sqlcoupon." where coupon_id='$eid'";
                    $updatecoupon=mysqli_query($conn,$sqlcoupon);
                    
                    $_SESSION['success_message']='<div class="text-success text-center">Coupon code has been updated successfully</div>';
                    echo '<script>window.open("index.php?view_coupon","_self")</script>';
            }
        }
    }
    
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Coupon code
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center">Insert coupon code</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="coupon_title">Coupon Title</label>
                    <input type="text" name="coupon_title" value="<?php echo $coupon_name ?>" class="form-control" id="coupon_title" required>
                    <?php if(isset($_SESSION['coupon_exists_message'])){
                        echo $_SESSION['coupon_exists_message'];
                        unset($_SESSION['coupon_exists_message']);
                    } ?>
                </div>
                <div class="form-group">
                    <label for="coupon_type">Coupon Type</label>
                    <select name="coupon_type" id="coupon_type" class="custom-select" required>
                        <option value="">select coupon type</option>
                        <?php  foreach($coupon_arr as $key=>$val){
                                $selected="";
                                if($coupon_type==$val){
                                    $selected="selected";
                                } 
                                echo '<option '.$selected.' value="'.$val.'">'.$val.'</option>';    
                            }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="coupon_value">Coupon Value</label>
                    <input type="text" name="coupon_value" class="form-control" value="<?php echo $coupon_value ?>" id="coupon_value" required>
                </div>
                <div class="form-group">
                    <label for="cart_min_price">Cart minimum price</label>
                    <input type="text" name="cart_min_price" class="form-control" value="<?php echo $cart_min_price ?>" id="cart_min_price" required>
                </div>
                <div class="form-group">
                    <label for="coupon_ex_on">Expired On</label>
                    <input type="datetime-local" name="coupon_ex_on" class="form-control" value="<?php echo $coupon_ex_on ?>" id="coupon_ex_on" <?php echo $required; ?>>
                </div>
                <?php 
                if(isset($_GET['eid'])){
                    echo '<button class="btn btn-block btn-primary" name="update_coupon" type="submit">Update Coupon</button>';
                }else{
                    echo '<button class="btn btn-block btn-primary" name="add_coupon" type="submit">Add Coupon</button>';
                }
                ?>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>