<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    if(isset($_GET['del_cat'])){
        $id=$_GET['del_cat'];
        $del_cat="delete from categories where cat_id='$id'";
        $run_cat=mysqli_query($conn,$del_cat);
        $del_pro="delete from products where product_cat_id='$id'";
        $run_pro=mysqli_query($conn,$del_pro);
        if($run_cat){
            echo '<script>alert("Category has been deleted successfully")</script>';
            echo '<script>window.open("index.php?view_cat","_self")</script>';
        }
    }
}
?>