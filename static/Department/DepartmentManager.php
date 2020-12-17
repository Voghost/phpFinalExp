
<?php
//解决引用问题
$dir = dirname(__FILE__);
require_once($dir . "/../../source/DataProcess/DepartmentProcess.php");
require_once($dir . "/../../source/Entity/Department.php");

//判断是否要进行表单处理
$departmentProcess = new DepartmentProcess();
if(isset($_POST["submit"])){
        $departmentId = $_POST['DepartmentId'];
        $departmentProcess->deleteDepartmentById($departmentId);
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
            <h3>管理你的部门</h3>
        </div>

        <!--公共区域内容-->
        <div class="public-content-cont">
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">部门编号</th>
                    <th style="width: 20%">部门名称</th>
                    <th style="width: 20%">部门地址</th>
                    <th style="width: 10%">部门人数</th>
                    <th style="width: 30%;">操作</th>
                </tr>

                <?php

                // select * from department where 1 = 1 即寻找所有值
                $departments = $departmentProcess->searchDepartment(1, 1);
                for ($i = 0; $i < count($departments); $i++) {
                    $num = $i + 1;
                    $staffs = $departmentProcess->searchStaffs($departments[$i]->getDepartmentId());
                    echo "<tr>";
                    echo "<td>{$num}</td>";
                    echo "<td>{$departments[$i]->getDepartmentId()}</td>";
                    echo "<td>{$departments[$i]->getDepartmentName()}</td>";
                    echo "<td>{$departments[$i]->getDepartmentAddress()}</td>";
                    echo "<td>" . count($staffs) . "</td>";
                    echo "
                    <td>
                        <form action=\"ManagerDepartStaff.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='DepartmentId' value='{$departments[$i]->getDepartmentId()}'>
                            <button class=\"sub-btn\" type='submit'>管理员工</button>
                        </form>
                        <form action=\"UpdateDepartment.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='DepartmentId' value='{$departments[$i]->getDepartmentId()}'>
                            <button class=\"sub-btn\" type='submit'>修改部门</button>
                        </form>
                        <form action=\"DepartmentManager.php\" method='post' style=\"display: inline;\">
                            <input type='hidden' name='isProcess' value='true'>
                            <input type='hidden' name='DepartmentId' value='{$departments[$i]->getDepartmentId()}'>
                            <button name=\"submit\" class=\"sub-btn btn-red\" onclick='isDeleteDepartment()'  type='submit'>删除部门</button>
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
    function isDeleteDepartment(){
       alert("是否删除该部门?")
    }
</script>
</html>
