<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    if(isset($_GET['del_user'])){
        $id=$_GET['del_user'];
        $del_admin="delete from admins where admin_id='$id'";
        $run_admin=mysqli_query($conn,$del_admin);
        if($run_admin){
            echo '<script>alert("One User account has been deleted successfully")</script>';
            echo '<script>window.open("logout.php","_self")</script>';
        }
    }
}
?>