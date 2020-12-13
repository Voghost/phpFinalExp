<?php
require_once ("./source/DatabaseProcess.php");
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

$a = new DatabaseProcess();
$b = $a->getLink();

?>
