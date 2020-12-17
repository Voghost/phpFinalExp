
<?php
//解决引用问题
$dir = dirname(__FILE__);
require_once($dir . "/../../source/DataProcess/DepartmentProcess.php");
require_once($dir . "/../../source/DataProcess/FolderProcess.php");
require_once($dir . "/../../source/DataProcess/TaskProcess.php");
require_once($dir . "/../../source/DataProcess/StaffProcess.php");
require_once($dir . "/../../source/Entity/Department.php");
require_once($dir . "/../../source/Entity/Folder.php");
require_once($dir . "/../../source/Entity/Task.php");
require_once($dir . "/../../source/Entity/Staff.php");

//判断是否要进行表单处理
$staffProcess = new StaffProcess();
if(isset($_POST["submit"])){
    $staffId = $_POST['StaffId'];
    $staffProcess->deleteStaffById($staffId);
    //    echo "<script>window.location.href='DepartmentManager.php'</script>";
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin</title>
    <link rel="stylesheet" href="../../css/reset.css"/>
    <link rel="stylesheet" href="../../css/content.css"/>
</head>
<body marginwidth="0" marginheight="0">
<?php


?>

<!--内容区-->
<div class="container">
    <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">员工管理</a></div>

    <div class="public-content">
        <!--公共区域标题-->
        <div class="public-content-header">
            <h3>管理你的员工</h3>
        </div>

        <!--公共区域内容-->
        <div class="public-content-cont">
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">员工编号</th>
                    <th style="width: 20%">员工姓名</th>
                    <th style="width: 20%">员工电话</th>
                    <th style="width: 10%">员工文件ID</th>
                    <th style="width: 30%;">操作</th>
                </tr>

                <?php

                // select * from department where 1 = 1 即寻找所有值
                $staffs = $staffProcess->searchStaff(1, 1);
                for ($i = 0; $i < count($staffs); $i++) {
                    $num = $i + 1;
                    echo "<tr>";
                    echo "<td>{$num}</td>";
                    echo "<td>{$staffs[$i]->getStaffId()}</td>";
                    echo "<td>{$staffs[$i]->getStaffName()}</td>";
                    echo "<td>{$staffs[$i]->getStaffPhone()}</td>";
                    echo "<td>{$staffs[$i]->getStaffFileId()}</td>";
                    echo "
                    <td>
                        <form action=\"UpdateStaff.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='DepartmentId' value='{$staffs[$i]->getStaffId()}'>
                            <button class=\"sub-btn\" type='submit'>修改员工</button>
                        </form>
                        <form action=\"StaffManager.php\" method='post' style=\"display: inline;\">
                            <input type='hidden' name='isProcess' value='true'>
                            <input type='hidden' name='DepartmentId' value='{$staffs[$i]->getStaffId()}'>
                            <button name=\"submit\" class=\"sub-btn btn-red\" onclick='isDeleteStaff()'  type='submit'>删除员工</button>
                        </form>
                    </td>
                    ";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
<script>
    function isDeleteStaff(){
        alert("是否删除该员工?")
    }
</script>
</html>
