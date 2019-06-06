<?php
require_once("API/qqConnectAPI.php");
$code = $_GET['code']??'';
$code = $_GET['code']??'';

$qc = new QC();
$qc->qq_login();
?>
