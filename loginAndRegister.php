<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <style>
        html {
            height: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url("./images/bg.jpg");
            background-size: cover;
        }


        .main {
            position: relative;
            width: 50%;
            height: auto;
            margin-top: 100px;
            margin-left: 20%;
            /*background-color: #bfa;*/
        }

        /*自动变大*/
        .main:after, .main:before {
            content: "";
            display: table;
        }

        .main:after {
            clear: both;
        }

        /*侧边选择栏*/
        /*
                .select {
                    position: relative;
                    float: left;
                    width: 30%;
                    height: 600px;
                    background-color: red;
                }
        */

        .label1, .label2 {
            position: absolute;
            width: 30%;
            height: 80px;
            color: black;
            background-color: #fff;
            cursor: pointer; /*光标类型*/
            transition: all 1s;

            line-height: 80px;
            text-align: center;
            font-size: 30px;
        }

        .label1 {
            top: 0;
            left: 0;
        }

        .label2 {
            top: 80px;
            left: 0;
        }

        .content {
            float: right;
            left: 30%;
            width: 70%;
            height: 700px;
            /*background-color: orange;*/
            overflow: hidden;

        }


        .login, .register {
            width: 100%;
            height: 100%;
        }

        .login:after, .login:before, .register:after, .register:before {
            content: "";
            display: table;
        }

        .login {
            position: relative;
            /*background-color: beige;*/
            transition: margin-top 0.5s;
        }

        .register {
            position: relative;
            /*background-color: aqua;*/
            transition: margin-top 0.5s;
        }

        #Input1:checked ~ .content > .login {
            margin-top: 0px;
        }

        #Input2:checked ~ .content > .login {
            margin-top: -700px;
        }

        #Input2:checked ~ .label2 {
            /*background-color: #fff;*/
            background-color: #319102;
            color: black;
        }

        #Input1:checked ~ .label1 {
            /*background-color: #fff;*/
            background-color: #319102;
            color: black;
        }

        td {
            padding: 0 30px;
        }

        .input-box {
            position: relative;
            width: 70%;
            height: auto;
            margin: 20px auto;
            /*background-color: pink;*/
        }

        .input {
            width: 98%;
            font-size: 20px;
            height: 30px;
            margin-top: 30px;
            background-color: #dbdbdb;
            border: 0;
        }

        .input:focus {
        }

        .back {
            position: absolute;
            width: 100%;
            height: auto;
            top: 0px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /*background-color: gray;*/
        }

        .back:after {
            content: "";
            display: table;
            clear: both;
        }

        .submit {
            border: 0;
            width: 100%;
            height: 40px;
            margin-top: 40px;
            margin-bottom: 20px;
            background-color: #319102;
            color: #343434;
            font-size: 23px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
            transition: all 0.3s;
        }

        .submit:focus {
            outline: 0;
        }

        .submit:hover {
            background-color: #267200;
        }

        .submit:active {
            width: 104%;
            height: 44px;
            margin-left: -2%;
            margin-bottom: 16px;
        }
    </style>
    <?php
    if (isset($_GET['isLoginSuccess'])) {
        if ($_GET['isLoginSuccess'] == 'false') {
            echo "<script>alert(\"用户名或密码错误\")</script>";
        }
    }
    if (isset($_GET['registerSuccess']) && isset($_GET["id"])) {
        if ($_GET['registerSuccess'] == 'true') {
            echo "<script>alert(\"注册成功 你的id为{$_GET['id']}请记住\")</script>";
        }
    }

    ?>
</head>
<body>
<h1 align="center" style="margin-top: 100px; font-size: 50px; color: white">欢迎</h1>
<div class="main">
    <!--    <div class="select"></div>-->
    <input type="radio" name="select" value="0" id="Input1" checked hidden>
    <label class="label1" for="Input1">
        <!--        <div style="font-size: 20px; font-weight: bolder; width: 50%;height: 80px; line-height: 80px; margin: 0 auto;">选项一</div>-->
        登录
    </label>
    <input type="radio" name="select" value="1" id="Input2" hidden>
    <label class="label2" for="Input2">
        <!--        <div style="font-size: 20px; width: 50%;height: 80px; line-height: 80px; margin: 0 auto;">选项二</div>-->
        注册
    </label>
    <div class="content">
        <div class="login">
            <div class="back">
                <div align="center" style="font-size: 30px; margin-top: 40px;">登录</div>
                <div class="input-box">
                    <form action="login.php" method="post">
                        <?php
                        if (isset($_GET["id"])) {
                            echo "<input class=\"input\" type=\"text\" placeholder=\"你的用户id\" name=\"userId\" value='{$_GET['id']}' required><br/>";
                        }else{
                            echo "<input class=\"input\" type=\"text\" placeholder=\"你的用户id\" name=\"userId\" required><br/>";
                        }
                        ?>
                        <input class="input" type="password" placeholder="密码" name="password" required>
                        <button class="submit" type="submit">提交</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="register">
            <div class="back">
                <div align="center" style="font-size: 30px; ">注册</div>
                <div class="input-box">
                    <form action="register.php" method="post">
                        <input class="input" type="text" placeholder="用户名" name="userName" required><br/>
                        <input class="input" type="text" placeholder="手机号" name="phoneNum" required><br/>
                        <input class="input" type="password" placeholder="密码" name="password" id="password"
                               required><br/>
                        <input class="input" type="password" placeholder="确认密码" name="checkPassword" id="checkPassword"
                               onkeyup="functionCheckPassword()" required>
                        <span id="check"></span>
                        </input>
                        <button id="submit" class="submit" type="submit" onclick="return clickCheckPassword()">提交
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function functionCheckPassword() {

        let password = document.getElementById("password").value;
        let rePassword = document.getElementById("checkPassword").value;

        if (password == rePassword) {
            document.getElementById("check").innerHTML = "<br><font color='green'>两次密码输入一致</font>";
            document.getElementById("submit").disabled = false;


        } else {
            document.getElementById("check").innerHTML = "<br><font color='red'>两次输入密码不一致!</font>";
            document.getElementById("submit").disabled = true;
        }
    }

    function clickCheckPassword() {
        let password = document.getElementById("password").value;
        let rePassword = document.getElementById("checkPassword").value;

        if (password != rePassword) {
            alert("两次密码不一致");
            return false;
        }
    }
</script>

</body>
</html>