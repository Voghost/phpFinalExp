<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/public.css">
</head>
<body>

<!--头部横条内容-->
<div class="public-header-warrp">
    <div class="public-header">
        <div class="content">
            <!--内容log显示区-->
            <div class="public-header-logo">
                <a href="">
                    <i>LOGO</i>
                    <h3>ＸＸ</h3>
                </a>
            </div>

            <!--管理人员操作-->
            <div class="public-header-admin fr">
                <p class="admin-name">****管理员 您好！</p>
                <div class="public-header-fun fr">
                    <a href="" class="public-header-man">管理</a>
                    <a href="" class="public-header-loginout">安全退出</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--clearfix-->
<div class="clearfix"></div>


<!--内容展示-->
<div class="public-ifame mt20">
    <div class="content">

        <!-- 内容模块头 -->
        <div class="public-ifame-header">
            <ul>
                <li class="ifame-item logo">
                    <div class="item-warrp">
                        <a href="#"><i>LOGO</i>
                            <!--标题-->
                            <h3 class="logo-title">Edgar</h3>
                            <!--创建时间-->
                            <p class="logo-des"></p>
                        </a>
                    </div>
                </li>

                <!--注册时间-->
                <li class="ifame-item">
                    <!--
                    <div class="item-warrp">
                        <span>
                            注册时间：2015/11/21 21:14:01<br>VIP有效期：
                        </span>
                    </div>
                    -->
                </li>

                <!--//网站访问量-->
                <li class="ifame-item">
                    <div class="item-warrp" style="border:none" align="right"><span>网站浏览量：15451</span></div>
                </li>
                <div class="clearfix"></div>
            </ul>
        </div>

        <!-- clearfix-->
        <div class="clearfix"></div>

        <!-- 左侧导航栏 -->
        <div class="public-ifame-leftnav">
            <div class="public-title-warrp">
                <div class="public-ifame-title ">
                    <a href="">首页</a>
                </div>
            </div>
            <ul class="left-nav-list">
                <li class="public-ifame-item">
                    <a href="javascript:;">部门管理</a>
                    <div class="ifame-item-sub">
                        <ul>
                            <li class="active"><a href="static/Department/DepartmentManager.php" target="content">管理部门</a></li>
                            <li><a href="static/Department/NewDepartment.php" target="content">新建部门</a></li>
                        </ul>
                    </div>
                </li>
                <li class="public-ifame-item">
                    <a href="javascript:;">项目管理</a>
                    <div class="ifame-item-sub">
                        <ul>
                            <li class="active"><a href="static/Project/ProjectManager.php" target="content">管理项目</a></li>
                            <li><a href="static/Project/NewProject.php" target="content">新建项目</a></li>
                        </ul>
                    </div>
                </li>
                <li class="public-ifame-item">
                    <a href="javascript:;">任务管理</a>
                    <div class="ifame-item-sub">
                        <ul>
                            <li class="active"><a href="static/Task/TaskManager.php" target="content">管理任务</a></li>
                            <li><a href="static/Task/NewTask.php" target="content">新建任务</a></li>
                        </ul>
                    </div>
                </li>
                <li class="public-ifame-item">
                    <a href="javascript:;">员工管理</a>
                    <div class="ifame-item-sub">
                        <ul>
                            <li class="active"><a href="static/Staff/StaffManager.php" target="content">管理员工</a></li>
                            <li><a href="static/Staff/NewStaff.php" target="content">新建员工</a></li>
                        </ul>
                    </div>
                </li>
                <li class="public-ifame-item">
                    <a href="javascript:;">文件管理</a>
                    <div class="ifame-item-sub">
                        <ul>
                            <li class="active"><a href="static/Folder/FolderManager.php" target="content">管理文件夹</a></li>
                            <li><a href="static/Folder/NewFolder.php" target="content">新建文件夹</a></li>
                        </ul>
                    </div>
                </li>
                <li class="public-ifame-item">
                    <a href="javascript:;">查看信息</a>
                    <div class="ifame-item-sub">
                        <ul>
                            <li><a href="static/Department/SearchDepartments.php" target="content">你的部门</a></li>
                            <li><a href="static/Task/SearchTask.php" target="content">你的任务</a></li>
                            <li><a href="static/Folder/SearchFolder.php" target="content">你的文件</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <!-- 右侧内容展示部分 -->
        <div class="public-ifame-content">
            <iframe name="content" src="static/main.php" frameborder="0" id="mainframe" scrolling="yes" marginheight="0" marginwidth="0" width="100%" style="height: 700px;"></iframe>
        </div>

    </div>

</div>


<!--clearfix-->
<div class="clearfix"></div>


<script src="js/jquery.min.js"></script>
<script>
    $().ready(function () {
        var item = $(".public-ifame-item");

        for (var i = 0; i < item.length; i++) {
            $(item[i]).on('click', function () {
                $(".ifame-item-sub").hide();
                if ($(this.lastElementChild).css('display') == 'block') {
                    $(this.lastElementChild).hide()
                    $(".ifame-item-sub li").removeClass("active");
                } else {
                    $(this.lastElementChild).show();
                    $(".ifame-item-sub li").on('click', function () {
                        $(".ifame-item-sub li").removeClass("active");
                        $(this).addClass("active");
                    });
                }
            });
        }
    });
</script>
</body>
</html>

<?php
