<?php
include "includes/header.php";
// session_start();
if(!isset($_SESSION['username'])){
    echo '<script>window.open("login.php","_self");</script>';
}
if(isset($_SESSION['thanks'])){
    unset($_SESSION['thanks']);
    echo '<script>window.open("shop.php","_self");</script>';
}
if(isset($_GET['oid']) && $_GET['oid']>0 && isset($_SESSION['username']) ){
    $oid=$_GET['oid'];
    $_SESSION['thanks'] = "thanks";


?>
<div class="container-fluid m-0 p-0" style="height:663px;">
    <div class="h-25 bg-info  text-center">
        <a href="<?php echo WEBSITE_PATH; ?>" class="text-danger" style="font-size:80px;font-weight:500px;text-decoration:none;"><?php echo WEBSITE_NAME; ?></a>
    </div>
    <div class="h-50">
        <div class="container">
            <h1>Thank you,</h1><br>
            <h2 class="pl-5">Order has been failed. Please try after sometime.</h2>
            <h2 class="pl-5">Order id=<?php echo $oid ?></h2>
        </div>
    </div>
    <div class="h-25 bg-info"></div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="https://use.fontawesome.com/37bfff5a04.js"></script>
</body>
</html>
<?php 

} ?>