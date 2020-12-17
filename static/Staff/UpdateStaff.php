<?php


//判断是否要进行表单处理

$dir = dirname(__FILE__);

require_once($dir . "/../../source/DataProcess/StaffProcess.php.php");
require_once($dir . "/../../source/Entity/Staff.php");
$staffProcess = new StaffProcess(); //新员工处理对象

if(isset($_POST["submit"])){
    $staff = new staff(null, null, null);

    $staff->setStaffId($_POST["StaffId"]);
    $staff->setStaffName($_POST['StaffName']);
    $staff->setStaffPhone($_POST["StaffPhone"]);
    $staffProcess->updateFoldertByEntity($staff);

//跳转页面
    echo "<script>window.location.href='StaffManager.php'</script>";
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
    <div class="public-nav">您当前的位置：<a href="">新建员工</a>></div>

    <div class="public-content">
        <div class="public-content-header">
            <h3>新建员工</h3>
        </div>
        <div class="public-content-cont">
            <form action="UpdateStaff.php" method="post">
                <?php
                $staffId =$_POST["StaffId"];
                $staffs = $staffProcess->searchStaff("StaffId",$staffId);
                ?>
                <div class="form-group">
                    <label for="">员工姓名</label>
                    <input class="form-input-txt" type="text" name="StaffName"  value='<?php echo $staffs[0]->getStaffName() ?>'/>
                </div>
                <div class="form-group">
                    <label for="">员工电话</label>
                    <input class="form-input-txt" type="text" name="StaffPhone" value="<?php echo $staffs[0]->getStaffPhone() ?>"/>
                </div>
                <div class="form-group" style="margin-left:150px;">
                    <!--是否要处理php-->
                    <!--                    <input type="hidden" name="isProcess" value="true"/>-->
                    <input type="hidden" name="StaffId" value="<?php echo $staffId?>">
                    <input type="submit" name="submit" class="sub-btn" value="提  交"/>
                    <input type="reset" class="sub-btn" value="重  置"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

