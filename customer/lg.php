<?php
@session_start();
if(isset($_SESSION['username'])){
    unset( $_SESSION['username']); 
}
echo '<script>window.open("../index.php","_self");</script>';

?>