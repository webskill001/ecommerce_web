<?php
include "includes/header.php";
include "includes/navbar.php";
include "../vendor/autoload.php";
if(isset($_SESSION['username'])){
    if(isset($_GET['or_id'])){
        $mpdf = new \Mpdf\Mpdf();
        $orderemail=orderemail();
        $mpdf->WriteHTML($orderemail);
        $file=time().'.pdf';
        $mpdf->Output($file,'D');
        echo '<script>window.open("myaccount.php?myorder","_self");</script>';
    }
}else{
    echo '<script>window.open("../shop.php","_self");</script>';
}
?>