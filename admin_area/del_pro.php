<?php

if(isset($_GET['del_pro'])){
    $id=$_GET['del_pro'];
    $del_pro="delete from products where product_id='$id'";
    $run_pro=mysqli_query($conn,$del_pro);
    $del_attr=mysqli_query($conn,"delete from product_attribute where product_id='$id'");
    if($run_pro){
        echo '<script>alert("product has been deleted successfully");</script>';
        echo '<script>window.open("index.php?view_prod","_self");</script>';
    }
}
?>