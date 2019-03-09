<?php
ini_set('include_path', 'D:\web\ritsdev\library');
require_once 'RajaBillerModel.php';

//$url = 'https://202.43.173.234/transaksi/index.php';
$url = 'https://103.247.103.70:6789';
$uid = 'SP41981';
$pin = '687870';
$rajabiller = new RajaBillerModel($url);
//$rajabiller->setUid($uid);
//$rajabiller->setPin($pin);
$rajabiller->getDeposit();
echo "running";exit();

