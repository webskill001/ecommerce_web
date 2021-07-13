<?php
@session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}else{

    if(isset($_GET['del_c'])){
        $id=$_GET['del_c'];
        $del_slider="delete from carousel where carousel_id='$id'";
        $run_slider=mysqli_query($conn,$del_slider);
        if($run_slider){
            echo '<script>alert("Slider has been deleted successfully")</script>';
            echo '<script>window.open("index.php?view_slider","_self")</script>';
        }
    }
}
?>