<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    if(isset($_GET['del_cus'])){
        $id=$_GET['del_cus'];
        $del_cus="delete from customers where cus_id='$id'";
        $run_cus=mysqli_query($conn,$del_cus);
        $del_order="delete from orders where customer_id='$id'";
        $run_order=mysqli_query($conn,$del_order);
        if($run_cus){
            echo '<script>alert("Category has been deleted successfully")</script>';
            echo '<script>window.open("index.php?view_customer","_self")</script>';
        }
    }
}
?>