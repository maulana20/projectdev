<?php
ini_set('include_path', 'D:\web\ZendFramework-1.11.11\library');
require_once 'VendorSOAPModel.php';

$url = 'http://domainwsdl:8777/';
$username = 'user';
$password = 'pass';

$vendor = new VendorSOAPModel($url, $username, $password);
$vendor->login();
$vendor->getAvailability();

echo "running";
exit();

