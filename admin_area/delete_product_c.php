<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    if(isset($_GET['del_p_cat'])){
        $id=$_GET['del_p_cat'];
        $del_pro_cat="delete from product_categories where product_cat_id='$id'";
        $run_pro_cat=mysqli_query($conn,$del_pro_cat);
        $del_pro="delete from products where product_p_cat_id='$id'";
        $run_pro=mysqli_query($conn,$del_pro);
        if($run_pro_cat){
            echo '<script>alert("Product category has been deleted successfully")</script>';
            echo '<script>window.open("index.php?view_p_cat","_self")</script>';
        }
    }
}
?>