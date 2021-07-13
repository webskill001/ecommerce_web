<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    $db_name="";
    $db_mob="";
    if(isset($_POST['add_db'])){
        $db_name=$_POST['db_name'];
        $db_mob=$_POST['db_mob'];
         if(strlen($db_mob)==10){
            $checkdb=mysqli_query($conn,"select * from deliveryboy where contact_no='$db_mob'");
            if(mysqli_num_rows($checkdb)>0){
                $_SESSION['db_exists_message']='<div class="text-danger">Mobile no alredy registered</div>';
            }else{
                $set_db="insert into deliveryboy (name,contact_no,status) values ('$db_name','$db_mob','0')";
                $run_db=mysqli_query($conn,$set_db);
                if($run_db){
                    $_SESSION['success_message']='<div class="text-center text-danger">delivery boy has been inserted successfully</div>';
                    echo '<script>window.open("index.php?view_delivery_boy","_self")</script>'; 
                }else{
                    echo "error";
                }
            }
         }else{
             $_SESSION['db_exists_message']='<div class="text-danger">Mobile number is of 10 characters</div>';
         }
    }else if(isset($_GET['edbid']) && $_GET['edbid']>0){
        $edbid=$_GET['edbid'];
        $get_db=mysqli_query($conn,"select * from deliveryboy where id='$edbid'");
        $rowdb=mysqli_fetch_assoc($get_db);
        $db_name=$rowdb['name'];
        $db_mob=$rowdb['contact_no'];

        if(isset($_POST['update_db'])){
            $db_name=$_POST['db_name'];
            $db_mob=$_POST['db_mob'];
            
            $checkdb=mysqli_query($conn,"select * from deliveryboy where contact_no='$db_mob'");
            if(mysqli_num_rows($checkdb)>0){
                $_SESSION['db_exists_message']='<div class="text-danger">Mobile no already exists</div>';
            }else{
                $sqldb="update deliveryboy set name='$db_name',contact_no='$db_mob' where id='$edbid'";
                    $updatedb=mysqli_query($conn,$sqldb);
                    
                    $_SESSION['success_message']='<div class="text-success text-center">Delivery boy has been updated successfully</div>';
                    echo '<script>window.open("index.php?view_delivery_boy","_self")</script>';
            }
        }
    }
    
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / Delivery boy
        </li>
    </ol>
</nav>
<div class="row">
    
    <div class="col-md-8 offset-md-2">
    <div class="card rounded">
        <div class="card-body">
            <h3 class="text-center">Insert Delivery Boy</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="db_name">Delivery boy name</label>
                    <input type="text" name="db_name" value="<?php echo $db_name ?>" class="form-control" id="db_name" required>
                    
                </div>
                <div class="form-group">
                    <label for="db_mob">Contact no.</label>
                    <input type="text" name="db_mob" class="form-control" value="<?php echo $db_mob ?>" id="db_mob" required>
                    <?php if(isset($_SESSION['db_exists_message'])){
                        echo $_SESSION['db_exists_message'];
                        unset($_SESSION['db_exists_message']);
                    } ?>
                </div>
                <?php 
                if(isset($_GET['edbid'])){
                    echo '<button class="btn btn-block btn-primary" name="update_db" type="submit">Update Delivery Boy</button>';
                }else{
                    echo '<button class="btn btn-block btn-primary" name="add_db" type="submit">Add Delivery Boy</button>';
                }
                ?>
            </form>
        </div>
    </div>
    </div>
</div>
<?php } ?>