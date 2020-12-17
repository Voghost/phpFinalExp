<?php


//判断是否要进行表单处理

$dir = dirname(__FILE__);

require_once($dir . "/../../source/DataProcess/TaskProcess.php");
require_once($dir . "/../../source/Entity/Task.php");
$taskProcess = new TaskProcess(); //新任务处理对象

if(isset($_POST["submit"])){
    $task = new Task(null, null, null,null,null);

    $task->setTaskId($_POST["TaskId"]);
    $task->setTaskName($_POST['TaskName']);
    $task->setTaskRemark($_POST["TaskRemark"]);
    $task->setTaskStartDate($_POST["TaskStartDate"]);
    $task->setTaskEndDate($_POST["TaskEndDate"]);
    $taskProcess->updateTaskByEntity($task);

//跳转页面
    echo "<script>window.location.href='TaskManager.php'</script>";
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/content.css">
    <link rel="stylesheet" href="../../css/reset.css">

</head>
<body marginwidth="0" marginheight="0">
<!--内容区-->
<div class="container">
    <div class="public-nav">您当前的位置：<a href="">新建任务</a>></div>

    <div class="public-content">
        <div class="public-content-header">
            <h3>新建任务</h3>
        </div>
        <div class="public-content-cont">
            <form action="UpdateTask.php" method="post">
                <?php
                $taskId =$_POST["TaskId"];
                $tasks = $taskProcess->searchTask("TaskId",$taskId);
                ?>
                <div class="form-group">
                    <label for="">任务名称</label>
                    <input class="form-input-txt" type="text" name="TaskName"  value='<?php echo $tasks[0]->getTaskName() ?>'/>
                </div>
                <div class="form-group">
                    <label for="">任务描述</label>
                    <input class="form-input-txt" type="text" name="TaskRemark" value="<?php echo $tasks[0]->getTaskRemark() ?>"/>
                </div>
                <div class="form-group">
                    <label for="">开始时间</label>
                    <input class="form-input-txt" type="text" name="TaskStartDate" value="<?php echo $tasks[0]->getTaskStartDate() ?>"/>
                </div>
                <div class="form-group">
                    <label for="">结束时间</label>
                    <input class="form-input-txt" type="text" name="TaskEndDate" value="<?php echo $tasks[0]->getTaskEndDate() ?>"/>
                </div>
                <div class="form-group" style="margin-left:150px;">
                    <!--是否要处理php-->
                    <!--                    <input type="hidden" name="isProcess" value="true"/>-->
                    <input type="hidden" name="TaskId" value="<?php echo $taskId?>">
                    <input type="submit" name="submit" class="sub-btn" value="提  交"/>
                    <input type="reset" class="sub-btn" value="重  置"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

