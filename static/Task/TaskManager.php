
<?php
//解决引用问题
$dir = dirname(__FILE__);
require_once($dir . "/../../source/DataProcess/TaskProcess.php");
require_once($dir . "/../../source/Entity/Task.php");

//判断是否要进行表单处理
$taskProcess = new TaskProcess();
if(isset($_POST["submit"])){
    $taskId = $_POST['TaskId'];
    $taskProcess->deleteTaskById($taskId);
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
    <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">任务管理</a></div>

    <div class="public-content">
        <!--公共区域标题-->
        <div class="public-content-header">
            <h3>管理你的任务</h3>
        </div>

        <!--公共区域内容-->
        <div class="public-content-cont">
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">任务编号</th>
                    <th style="width: 10%">任务名字</th>
                    <th style="width: 10%">任务描述</th>
                    <th style="width: 10%">任务开始时间</th>
                    <th style="width: 10%">任务结束时间</th>
                    <th style="width: 10%">任务人数</th>
                    <th style="width: 30%;">操作</th>
                </tr>

                <?php

                // select * from department where 1 = 1 即寻找所有值
                $tasks = $taskProcess->searchTask(1, 1);
                for ($i = 0; $i < count($tasks); $i++) {
                    $num = $i + 1;
                    $staffs = $taskProcess->searchStaffs($tasks[$i]->getTaskId());
                    echo "<tr>";
                    echo "<td>{$num}</td>";
                    echo "<td>{$tasks[$i]->getTaskId()}</td>";
                    echo "<td>{$tasks[$i]->getTaskName()}</td>";
                    echo "<td>{$tasks[$i]->getTaskRemark()}</td>";
                    echo "<td>{$tasks[$i]->getTaskStartDate()}</td>";
                    echo "<td>{$tasks[$i]->getTaskEndDate()}</td>";
                    echo "<td>" . count($staffs) . "</td>";
                    echo "
                    <td>
                        <form action=\"ManagerTaskStaff.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='TaskId' value='{$tasks[$i]->getTaskId()}'>
                            <button class=\"sub-btn\" type='submit'>管理员工</button>
                        </form>
                        <form action=\"UpdateTask.php\" method='post' style=\"display: inline; margin-right: 5px\">
                            <input type='hidden' name='TaskId' value='{$tasks[$i]->getTaskId()}'>
                            <button class=\"sub-btn\" type='submit'>修改部门</button>
                        </form>
                        <form action=\"TaskManager.php\" method='post' style=\"display: inline;\">
                            <input type='hidden' name='isProcess' value='true'>
                            <input type='hidden' name='TaskId' value='{$tasks[$i]->getTaskId()}'>
                            <button name=\"submit\" class=\"sub-btn btn-red\" onclick='isDeleteTask()'  type='submit'>删除任务</button>
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
    function isDeleteTask(){
        alert("是否删除该任务?")
    }
</script>
</html>
