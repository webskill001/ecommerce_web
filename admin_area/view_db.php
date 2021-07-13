<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    if(isset($_GET['ddbid'])){
        $ddbid=$_GET['ddbid'];
        $deldb=mysqli_query($conn,"delete from deliveryboy where id='$ddbid'");
        $_SESSION['deldb']='<div class="text-center text-danger">Delivery boy has been delete successfully</div>';
    }
    if(isset($_GET['adbid']) && $_GET['adbid']>0){
        $adbid=$_GET['adbid'];
        $getcoupsta=mysqli_query($conn,"update deliveryboy set status='0' where id='$adbid'");
    }
    if(isset($_GET['dedbid']) && $_GET['dedbid']>0){
        $dedbid=$_GET['dedbid'];
        $getcoupsta=mysqli_query($conn,"update deliveryboy set status='1' where id='$dedbid'");
    }
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Delivery boy
        </li>
    </ol>
</nav>
<div class="panel border border-primary rounded">
    <div class="panel-heading bg-primary text-center py-1 h5">View Delivery Boy</div>
    <?php
    if(isset($_SESSION['success_message'])){
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    }
    ?>
    <div class="panel-body p-2">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Delivery boy id</th>
                    <th>Delivery boy name</th>
                    <th>Delivery boy mob</th>
                    <th>Added on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            $get_db=mysqli_query($conn,"select * from deliveryboy");
            while($row_db=mysqli_fetch_assoc($get_db)){ ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td><?php echo $row_db['name']; ?></td>
                    <td><?php echo $row_db['contact_no']; ?></td>
                    <td><?php echo $row_db['added_on']; ?></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                                <a href="?view_delivery_boy&ddbid=<?php echo $row_db['id']; ?>" class="btn btn-danger text-light" name="delete"  type="submit"><i class="fa fa-trash-o"></i></a>
                            <?php if($row_db['status']==1){ ?>
                                        <a  href="?view_delivery_boy&adbid=<?php echo $row_db['id']; ?>" class="btn btn-secondary text-light" name="active" type="submit">Active</a>
                                    <?php }else{ ?>
                                        <a  href="?view_delivery_boy&dedbid=<?php echo $row_db['id']; ?>" class="btn btn-info  text-light" name="deactive" type="submit">Deactive</a>
                                    <?php } ?>
                            <a  href="?insert_delivery_boy&edbid=<?php echo $row_db['id']; ?>" class="btn btn-success text-light" name="edit" type="submit"><i class="fa fa-pencil"></i></a>
                        </div>
                    </td>
                </tr>
            <?php $i++;} ?>
            </tbody>
        </table>
    </div>
</div>

            <?php } ?>