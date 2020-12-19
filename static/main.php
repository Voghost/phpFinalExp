<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>main</title>
    <link rel="stylesheet" href="../css/content.css">
    <link rel="stylesheet" href="../css/reset.css">
</head>
<body>
<div class="container">
    <div class="public-nav">您当前的位置：<a href="">管理首页</a>></div>
    <div class="public-content">
        <div class="public-content-header">
            <h3>网站后台</h3>
        </div>
        <div class="public-content-cont">
            <p style="width: 100%;text-align: center; padding: 50px 0; font-size: 16px; color: #FF0000;">
                <?php
                session_start();
                if (isset($_SESSION["userId"])) {
                    $userId = $_SESSION["userId"];

                    $dir = dirname(__FILE__);
                    require_once($dir . "/../source/DataProcess/StaffProcess.php");
                    $staffProcess = new StaffProcess();
                    $staffs = $staffProcess->searchStaff("StaffId", $userId);
                    echo $staffs[0]->getStaffName() . " &nbsp;你好！ 欢迎登陆网站后台！";
                    $projects = $staffProcess->searchProjects($userId);  //项目
                    $tasks = $staffProcess->searchTasks($userId);        //任务
                    $departments = $staffProcess->searchDepartments($userId); //部门


                    echo "<h3>你的部门</h3>";
                    echo "<table class=\"public-cont-table\">
                            <tr>
                                <th style=\"width: 10%\">序号</th>
                                <th style=\"width: 10%\">部门编号</th>
                                <th style=\"width: 20%\">部门名称</th>
                                <th style=\"width: 20%\">部门地址</th>
                                <th style=\"width: 10%\">部门人数</th>
                            </tr>";


                    // select * from department where 1 = 1 即寻找所有值
                    for ($i = 0; $i < count($departments); $i++) {
                        $num = $i + 1;
                        echo "<tr>";
                        echo "<td>{$num}</td>";
                        echo "<td>{$departments[$i]->getDepartmentId()}</td>";
                        echo "<td>{$departments[$i]->getDepartmentName()}</td>";
                        echo "<td>{$departments[$i]->getDepartmentAddress()}</td>";
                        echo "<td>" . count($staffs) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table><div style='margin-top: 40px'></div>";

                    echo "<h3>你的任务</h3>";
                    echo "<table class=\"public-cont-table\">
                            <tr>
                                <th style=\"width: 10%\">序号</th>
                                <th style=\"width: 10%\">任务编号</thI>
                                <th style=\"width: 10%\">任务名称</th>
                                <th style=\"width: 10%\">任务描述</th>
                                <th style=\"width: 10%\">任务开始时间</th>
                                <th style=\"width: 10%\">任务结束时间</th>
                            </tr>";


                    // select * from department where 1 = 1 即寻找所有值
                    for ($i = 0; $i < count($tasks); $i++) {
                        $num = $i + 1;
                        echo "<tr>";
                        echo "<td>{$num}</td>";
                        echo "<td>{$tasks[$i]->getTaskId()}</td>";
                        echo "<td>{$tasks[$i]->getTaskName()}</td>";
                        echo "<td>{$tasks[$i]->getTaskRemark()}</td>";
                        echo "<td>{$tasks[$i]->getTaskStartDate()}</td>";
                        echo "<td>{$tasks[$i]->getTaskEndDate()}</td>";
                        echo "</tr>";
                    }
                    echo "</table><div style='margin-top: 40px'></div>";

                    echo "<h3>你的项目</h3>";
                    echo "
                    <table class=\"public-cont-table\">
                        <tr>
                            <th style=\"width: 10%\">序号</th>
                            <th style=\"width: 10%\">项目编号</th>
                            <th style=\"width: 10%\">项目名称</th>
                            <th style=\"width: 20%\">项目描述</th>
                        </tr>
                    ";
                    for ($i = 0; $i < count($projects); $i++) {
                        $num = $i + 1;
                        echo "<tr>";
                        echo "<td>{$num}</td>";
                        echo "<td>{$projects[$i]->getProjectId()}</td>";
                        echo "<td>{$projects[$i]->getProjectName()}</td>";
                        echo "<td>{$projects[$i]->getProjectRemark()}</td>";
                        echo "</tr>";
                    }
                    echo "</table><div style='margin-top: 40px'></div>";
                }
                ?>
            </p>
        </div>
    </div>
</div>

</body>
</html>
<?php
