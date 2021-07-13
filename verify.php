<?php
include "includes/header.php";

if(isset($_GET['id'])){
    $id= $_GET['id'];exit();
    $res=mysqli_query($conn,"update customers set email_status='1' where cus_id='$id'");
}
?>
<div class="" id="main" style="background-color:rgb(145, 243, 189);height:663px;">
    <div class="text-center pt-4" style="background-color:rgba(49, 252, 49, 0.5);height:20%;margin:0px;padding:0px;">
        <p class="text-dark display-4 h1">Your email id has been verified.</p>
    </div>
    <div class="alert-primary w-100" style="height:8%;">
       <div class="container w-100 text-center">
       <ul style="list-style:none;margin-left:200px;" >
            <li><a href="" class="float-left mx-5 my-2 text-danger h5">About us</a></li>
            <li><a href="" class="float-left mx-5 my-2 text-danger h5">Services</a></li>
            <li><a href="" class="float-left mx-5 my-2 text-danger h5">Contact us</a></li>
        </ul>
       </div>
    </div>
    <div class="container align-self-center h-50 bg-light mt-3"></div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="https://use.fontawesome.com/37bfff5a04.js"></script>


</body>

</html>