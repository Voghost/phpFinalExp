<?php

//echo $_POST['userName']."欢迎您";
/*$hostName = "10.62.98.193";
$userName = "phpTest";
$password = "phpTest";
$database = "information_schema";
$link= mysqli_connect($hostName,$userName,$password,$database);
if(!$link){
    echo "error";
}
*/
if (isset($_GET["out"])) {
    echo $_GET['out'];
    echo "<script>window.location.href = 'loginAndRegister.php</script>";
}

$dir = dirname(__FILE__);
require_once($dir . "/source/DataProcess/StaffProcess.php");

$staffProcess = new StaffProcess();
$userId = $_POST["userId"];
$password = $_POST["password"];

$staff = $staffProcess->searchStaff("StaffId", $userId);

session_start();
$_SESSION["admin"] = false;

if ($staff == null || $userId != $staff[0]->getStaffId()) {
    echo "<script>window.location.href = 'loginAndRegister.php?isLoginSuccess=false'</script>";
    $_SESSION["admin"] = false;
} else {
    $_SESSION["userId"] = $_POST['userId'];
    $_SESSION["admin"] = true;
    $departments = $staffProcess->searchDepartments($userId);
    for ($i = 0; $i < count($departments); $i++) {
        //如果为管理部门
        if ($departments[$i]->getDepartmentId() == "D001") {
            echo "<script>window.location.href = 'admin.php'</script>";
        }
    }
    echo "<script>window.location.href = 'admin-nomal.php'</script>";

}

?>
