<?php
@include "includes/db.php";
if(isset($_POST['pos'])){
    $user=$_SESSION['username'];
    $getuser="delete from customers where cus_username='$user'";
    $runuser=mysqli_query($conn,$getuser);
    unset($_SESSION['username']);
    echo '<script>alert("Your account has been deleted successfully");</script>'
    .'<script>window.open("../index.php","_self");</script>'; 
}
if(isset($_POST['neg'])){
    echo '<script>window.open("myaccount.php?myorder","_self")</script>';
}
?>

<h5 class="text-center">Do You Really Want To Delete Your Account</h5>
<div class="text-center">
<form action="dlac.php" method="post">
<button class="btn btn-danger" type="submit" name="pos">Yes, I Want To Delete</button>
<button class="btn btn-success" type="submit" name="neg">No, I Don't Want</button>
</form>
</div>