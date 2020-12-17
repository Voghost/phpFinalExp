<?php
$dir = dirname(__FILE__);
require_once($dir . "/../../source/DataProcess/ProjectProcess.php");
require_once($dir . "/../../source/DataProcess/StaffProcess.php");
require_once($dir . "/../../source/Entity/Project.php");
$projectProcess = new ProjectProcess();





//如果存在
if(isset($_POST["submit"])){
    $deleteOrInsert = $_POST['deleteOrInsert'];
    $requestStaffId = $_POST["StaffId"];  //要处理的员工id
    $requestProjectId = $_POST["ProjectId"]; //要处理的部门id
    if ($deleteOrInsert != null) {
        if ($deleteOrInsert == "insert") {
            $projectProcess->connectToStaff($requestProjectId, $requestStaffId);
        } elseif ($deleteOrInsert == "delete") {
            $projectProcess->disconnectToStaff($requestProjectId, $requestStaffId);
        }
        echo "
        <script>window.location.href = 'ManagerProjStaff.php?ProjectId={$requestProjectId}';</script>";
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ManagerDepartStaff</title>
    <link rel="stylesheet" href="../../css/content.css">
    <link rel="stylesheet" href="../../css/reset.css">
</head>
<body marginwidth="0" marginheight="0">
<div class="container">

    <div class="public-nav">您当前的位置：<a href="../../admin.php">管理首页</a>><a href="ProjectManger.php">项目管理</a>><a href="">员工管理</a></div>

    <div class="public-content">
        <!--公共区域标题-->
        <div class="public-content-header">
            <h3>管理员工的项目</h3>
        </div>

        <!--公共区域内容-->
        <div class="public-content-cont">
            <h2 style="font-size: 24px">在当前项目的员工</h2>
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">员工编号</th>
                    <th style="width: 20%">员工名称</th>
                    <th style="width: 20%">员工电话</th>
                    <th style="width: 30%;">操作</th>
                </tr>

                <?php
                if(isset($_POST["ProjectId"])){
                    $projectId = $_POST["ProjectId"];
                }else{
                    $projectId = $_GET["ProjectId"];
                }

                $staffs = $projectProcess->searchStaffs($projectId);
                for ($i = 0; $i < count($staffs); $i++) {
                    $num = $i + 1;
                    echo "<tr>";
                    echo "<td>" . $num . "</td>";
                    echo "<td>" . $staffs[$i]->getStaffId() . "</td>";
                    echo "<td>" . $staffs[$i]->getStaffName() . "</td>";
                    echo "<td>" . $staffs[$i]->getStaffPhone() . "</td>";

                    echo "
                        <td>
                        <form action=\"MangerProjStaff.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='deleteOrInsert' value='delete'>
                            <input type='hidden' name='StaffId' value='{$staffs[$i]->getStaffId()}'>
                            <input type='hidden' name='ProjectId' value='{$projectId}'>
                            <button class=\"sub-btn btn-red\" name='submit' type='submit'>删除员工</button>
                        </form>
                        </td>
                    ";
                    echo "</tr>";
                }
                ?>
            </table>

            <!--            空闲空间-->
            <div style="width: auto; height: 40px"></div>
            <h2 style="font-size: 24px">不在当前项目的员工</h2>
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">员工编号</th>
                    <th style="width: 20%">员工名称</th>
                    <th style="width: 20%">员工电话</th>
                    <th style="width: 30%;">操作</th>
                </tr>

                <?php


                $staffProcess = new StaffProcess();
                $allStaffs = $staffProcess->searchStaff("1", "1");

                for ($i = 0; $i < count($allStaffs); $i++) {
                    $num = 1;

                    //过滤掉存在部门的成员
                    $flag = true;
                    for ($j = 0; $j < count($staffs); $j++) {
                        if ($allStaffs[$i] == $staffs[$j]) {
                            $flag = false;
                            break;
                        }
                    }
                    if ($flag == false) {
                        //如果部门有这个用户不显示
                        continue;
                    }


                    echo "<tr>";
                    echo "<td>" . $num . "</td>";
                    echo "<td>" . $allStaffs[$i]->getStaffId() . "</td>";
                    echo "<td>" . $allStaffs[$i]->getStaffName() . "</td>";
                    echo "<td>" . $allStaffs[$i]->getStaffPhone() . "</td>";

                    echo "
                        <td>
                        <form action=\"MangerProjStaff.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='deleteOrInsert' value='insert'>
                            <input type='hidden' name='StaffId' value='{$allStaffs[$i]->getStaffId()}'>
                            <input type='hidden' name='ProjectId' value='$projectId'>
                            <button class=\"sub-btn\" name='submit' type='submit'>新增员工</button>
                        </form>
                        </td>
                    ";
                    echo "</tr>";
                    $num++;
                }
                ?>

            </table>
        </div>
    </div>
</div>
</body>
</html>
