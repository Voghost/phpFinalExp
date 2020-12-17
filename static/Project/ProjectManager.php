
<?php
//解决引用问题
$dir = dirname(__FILE__);
require_once($dir . "/../../source/DataProcess/ProjectProcess.php");
require_once($dir . "/../../source/Entity/Project.php");

//判断是否要进行表单处理
$projectProcess = new ProjectProcess();
if(isset($_POST["submit"])){
    $projectId = $_POST['ProjectId'];
    $projectProcess->deleteProjectById($projectId);
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
            <h3>管理你的项目</h3>
        </div>

        <!--公共区域内容-->
        <div class="public-content-cont">
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">项目编号</th>
                    <th style="width: 10%">项目名称</th>
                    <th style="width: 10%">项目路径</th>
                    <th style="width: 20%">项目描述</th>
                    <th style="width: 10%">项目人数</th>
                    <th style="width: 30%;">操作</th>
                </tr>

                <?php

                // select * from department where 1 = 1 即寻找所有值
                $projects = $projectProcess->searchProject(1, 1);
                for ($i = 0; $i < count($projects); $i++) {
                    $num = $i + 1;
                    $staffs = $projectProcess->searchStaffs($projects[$i]->getProjectId());
                    echo "<tr>";
                    echo "<td>{$num}</td>";
                    echo "<td>{$projects[$i]->getProjectId()}</td>";
                    echo "<td>{$projects[$i]->getProjectName()}</td>";
                    echo "<td>{$projects[$i]->getProjectPathId()}</td>";
                    echo "<td>{$projects[$i]->getProjectRemark()}</td>";
                    echo "<td>" . count($staffs) . "</td>";
                    echo "
                    <td>
                        <form action=\"ManagerProjStaff.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='ProjectId' value='{$projects[$i]->getProjectId()}'>
                            <button class=\"sub-btn\" type='submit'>管理项目</button>
                        </form>
                        <form action=\"UpdateProject.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='ProjectId' value='{$projects[$i]->getProjectId()}'>
                            <button class=\"sub-btn\" type='submit'>修改项目</button>
                        </form>
                        <form action=\"ProjectManager.php\" method='post' style=\"display: inline;\">
                            <input type='hidden' name='isProcess' value='true'>
                            <input type='hidden' name='ProjectId' value='{$projects[$i]->getProjectId()}'>
                            <button name=\"submit\" class=\"sub-btn btn-red\" onclick='isDeleteProject()'  type='submit'>删除项目</button>
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
    function isDeleteProject(){
        alert("是否删除该项目?")
    }
</script>
</html>
