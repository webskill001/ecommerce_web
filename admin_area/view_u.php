<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{
    ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <i class="fa fa-dashboard align-middle p-1"></i> Home / View Users
        </li>
    </ol>
</nav>
<div class="panel">
    <div class="panel-heading text-dark py-1 h5"><i class="fa fa-money"></i> View Users</div>
    <div class="panel-body p-2">
        <table class="table table-hover table-responsive ml-3">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>User name</th>
                    <th>User email</th>
                    <th>User Image</th>
                    <th>User country</th>
                    <th>User job</th>
                    <th>Delete user</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            $get_admin="select * from admins";
            $run_admin=mysqli_query($conn,$get_admin);
            $count_admin=mysqli_num_rows($run_admin);
            while($get_admin=mysqli_fetch_assoc($run_admin)){
                $admin_id=$get_admin['admin_id'];
                $admin_name=$get_admin['admin_name'];
                $my_username=$_SESSION['admin'];
                $admin_username=$get_admin['admin_username'];
                $admin_image=$get_admin['admin_image'];
                $admin_email=$get_admin['admin_email'];
                $admin_country=$get_admin['admin_country'];
                $admin_job=$get_admin['admin_job'];
                if($admin_username===$my_username){
                ?>

                <tr class="alert-primary">
                    <td>#<?php echo $i; ?><br><span class="text-light bg-primary shadow-sm px-2 rounded">You</span></td>
                    <td><?php echo $admin_name; ?></td>
                    <td><?php echo $admin_email; ?></td>
                    <td><img src="images/profile/<?php echo $admin_image; ?>" width="45" height="50" alt=""></td>
                    <td><?php echo ucwords($admin_country); ?></td>
                    <td><?php echo ucwords($admin_job); ?></td>
                    <td><a class="text-danger" href="index.php?del_user=<?php echo $admin_id; ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
                </tr>
                <?php    
                }else{
                ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td><?php echo $admin_name; ?></td>
                    <td><?php echo $admin_email; ?></td>
                    <td><img src="images/profile/<?php echo $admin_image; ?>" width="45" height="50" alt=""></td>
                    <td><?php echo ucwords($admin_country); ?></td>
                    <td><?php echo ucwords($admin_job); ?></td>
                    <td><a class="text-danger" href="index.php?del_user=<?php echo $admin_id; ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
                </tr>
                <?php }$i++;} ?>
            </tbody>
        </table>
    </div>
</div>

            <?php } ?>