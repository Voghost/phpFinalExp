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
    <div class="public-nav">您当前的位置：<a href="">新建员工</a>></div>

    <div class="public-content">
        <div class="public-content-header">
            <h3>新建员工</h3>
        </div>
        <div class="public-content-cont">
            <form action="NewStaff.php" method="post">
                <div class="form-group">
                    <label for="">员工姓名</label>
                    <input class="form-input-txt" type="text" name="StaffName" value=""/>
                </div>
                <div class="form-group">
                    <label for="">员工电话</label>
                    <input class="form-input-txt" type="text" name="StaffPhone" value=""/>
                </div>
                <div class="form-group" style="margin-left:150px;">
                    <!--是否要处理php-->
                    <input type="hidden" name="isProcess" value="true"/>
                    <input type="submit" class="sub-btn" value="提  交"/>
                    <input type="reset" class="sub-btn" value="重  置"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
//判断是否要进行表单处理
if (!isset($_POST['isProcess'])) {
    die();
}

$dir = dirname(__FILE__);

require_once($dir."/../../source/DataProcess/StaffProcess.php");
require_once($dir."/../../source/Entity/Staff.php");
$staffProcess = new StaffProcess(); //新部门处理对象
$staff = new Staff(null,null,null);

$staff->setStaffName($_POST['StaffName']);
$staff->setStaffPhone($_POST["StaffPhone"]);
$staffProcess->insertStaff($staff);

//跳转页面
echo "<script>window.location.href='StaffManager.php'</script>";
?>