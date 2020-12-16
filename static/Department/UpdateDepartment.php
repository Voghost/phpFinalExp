<?php
//判断是否要进行表单处理
$isProcess = $_POST["isProcess"];
$dir = dirname(__FILE__);

require_once($dir . "/../../source/DataProcess/DepartmentProcess.php");
require_once($dir . "/../../source/Entity/Department.php");
$departmentProcess = new DepartmentProcess(); //新部门处理对象

if ($isProcess == "true") {
    $department = new Department(null, null, null);

    $department->setDepartmentId($_POST["DepartmentId"]);
    $department->setDepartmentName($_POST['DepartmentName']);
    $department->setDepartmentAddress($_POST["DepartmentAddress"]);
    $departmentProcess->updateDepartmentByEntity($department);

//跳转页面
    echo "<script>window.location.href='DepartmentManager.php'</script>";

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
    <div class="public-nav">您当前的位置：<a href="">新建部门</a>></div>

    <div class="public-content">
        <div class="public-content-header">
            <h3>新建部门</h3>
        </div>
        <div class="public-content-cont">
            <form action="UpdateDepartment.php" method="post">
                <?php
                $departmentId =$_POST["DepartmentId"];
                $departments = $departmentProcess->searchDepartment("DepartmentId",$departmentId);
                ?>
                <div class="form-group">
                    <label for="">部门名称</label>
                    <input class="form-input-txt" type="text" name="DepartmentName"  value='<?php echo $departments[0]->getDepartmentName() ?>'/>
                </div>
                <div class="form-group">
                    <label for="">部门地址</label>
                    <input class="form-input-txt" type="text" name="DepartmentAddress" value="<?php echo $departments[0]->getDepartmentAddress() ?>"/>
                </div>
                <div class="form-group" style="margin-left:150px;">
                    <!--是否要处理php-->
                    <input type="hidden" name="isProcess" value="true"/>
                    <input type="hidden" name="DepartmentId" value="<?php echo $departmentId?>">
                    <input type="submit" class="sub-btn" value="提  交"/>
                    <input type="reset" class="sub-btn" value="重  置"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

