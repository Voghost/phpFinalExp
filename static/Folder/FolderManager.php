
<?php
//解决引用问题
$dir = dirname(__FILE__);
require_once($dir . "/../../source/DataProcess/FolderProcess.php");
require_once($dir . "/../../source/Entity/Folder.php");

//判断是否要进行表单处理
$folderProcess = new FolderProcess();
if(isset($_POST["submit"])){
    $folderId = $_POST['FolderId'];
    $folderProcess->deleteFolderById($folderId);
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
            <h3>管理你的文件</h3>
        </div>

        <!--公共区域内容-->
        <div class="public-content-cont">
            <table class="public-cont-table">
                <tr>
                    <th style="width: 10%">序号</th>
                    <th style="width: 10%">文件编号</th>
                    <th style="width: 20%">文件路径</th>
                    <th style="width: 20%">文件描述</th>
                    <th style="width: 10%">文件数量</th>
                </tr>

                <?php

                // select * from department where 1 = 1 即寻找所有值
                $folders = $folderProcess->searchFolder(1, 1);
                for ($i = 0; $i < count($folders); $i++) {
                    $num = $i + 1;
                    $staffs = $folderProcess->searchStaffs($folders[$i]->getFolderId());
                    echo "<tr>";
                    echo "<td>{$num}</td>";
                    echo "<td>{$folders[$i]->getFolderId()}</td>";
                    echo "<td>{$folders[$i]->getFolderPath()}</td>";
                    echo "<td>{$folders[$i]->getFolderRemark()}</td>";
                    echo "<td>" . count($folders) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
