<?php
/*
$arr=array(
    0=>array('title' => '新闻1', 'viewnum' => 123, 'content' => 'ZAQXSWedcrfv'),
    1=>array('title' => '新闻2', 'viewnum' => 99, 'content' => 'QWERTYUIOPZXCVBNM')
);
echo '不统计多维数组：'.count($arr,0);//count($arr,COUNT_NORMAL)
echo "<br/>";
echo '统计多维数组：'.count($arr,1);//count($arr,COUNT_RECURSIVE)
*/

require_once("./source/DatabaseProcess.php");
require_once("./source/Entity/Staff.php");


$staff = new Staff("S12229", "测试", null, null, "test");
//$a = $staff->getArray();
$a =$staff->getArray();
$databaseProcess = new DatabaseProcess();
$isTrue = $databaseProcess->insertValues("staff",$a);

//测试查找
$result = $databaseProcess->searchByField("staff", "StaffName", "测试");
echo count($result,0)."<br/>";
echo $result[0]["StaffName"];


//测试获取行数
$num = $databaseProcess->numOfRows("staff");
echo "<br/>" . $num . "<br/>";

//测试更新数据
//$result01 = $databaseProcess->updateByField("staff", "StaffName", "用户1", "StaffId", "S11112");
$staff1 = new Staff("S11229","更改","1234",null,"test");
$databaseProcess->updateByArray("staff",$staff1->getArray());


//测试删除数据
//$result = $databaseProcess->deleteByField("staff","StaffId","S11113");



echo $a;