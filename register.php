<?php
$dir = dirname(__FILE__);
require_once($dir . "/source/DataProcess/StaffProcess.php");

$userName = $_POST['userName'];
$userPhone = $_POST['phoneNum'];
$userPassword = $_POST['password'];

$staffProcess = new StaffProcess();
$staff = new Staff(null, $userName, $userPhone, null, $userPassword);
$staffProcess->insertStaff($staff);

$staffId = $staffProcess->getMaxId();

echo "<script>window.location.href= 'loginAndRegister.php?registerSuccess=true&id={$staffId}'</script>";

