<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
include "functions/function.php";
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
// session_start();
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

if($isValidChecksum == "TRUE") {
	// print_r($_POST);die();
	if($_POST["STATUS"] == "TXN_SUCCESS") {
		// print_r($_POST);die();
		$oid=$_POST['ORDERID'];
		$txnid=$_POST['TXNID'];
		$getOrderById=getOrderById($oid);
		$orderemail=orderemail($getOrderById['cus_name'],$getOrderById['total_amount'],$oid);
		$get_txn=mysqli_query($conn,"update orders set payment_id='$txnid' , payment_status='success' where order_id='$oid'");
		// smtp_mailer($getOrderById['cus_email'],"Order Placed Successfully",$orderemail);
		echo '<script>window.open("thankyou.php?oid='.$oid.'","_self");</script>';
	}
	else {
		$oid=$_POST['ORDERID'];
		$txnid=989898989;
		$getOrderById=getOrderById($oid);
		$orderemail=orderemail($getOrderById['cus_name'],$getOrderById['total_amount'],$oid);
		// echo "update orders set payment_id='$txnid' and payment_status='failed' where order_id='$oid'";die();
		$get_txn=mysqli_query($conn,"update orders set payment_id='$txnid' and payment_status='failed' where order_id='$oid'");
		echo '<script>window.open("error.php?oid='.$oid.'","_self");</script>';
	}
}
else {
	$oid=$_POST['ORDERID'];
	$txnid=$_POST['TXNID'];
	$getOrderById=getOrderById($oid);
	$orderemail=orderemail($getOrderById['cus_name'],$total_amount,$oid);
	$get_txn=mysqli_query($conn,"update orders set payment_id='$txnid' and payment_status='failed' where order_id='$oid'");die();
	echo '<script>window.open("error.php?oid='.$oid.'","_self");</script>';
}

?>