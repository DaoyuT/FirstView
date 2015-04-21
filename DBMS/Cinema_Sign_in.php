#!/usr/local/bin/php


<html>
<head lang="en">
    <style type="text/css">
        div#container{width:1000px}
        div#header {background-color:#99bbbb;}
        div#menu {background-color:#ffff99;height:200px;width:300px;float:left;}
        div#content {background-color:#EEEEEE;height:200px;width:700px;float:left;}
        div#footer {background-color:#99bbbb;clear:both;text-align:center;}


        h1 {margin-bottom:0;}
        h2 {margin-bottom:0;font-size:18px;}
        h3 {
            margin-top: 2%;
            margin-right: 2%;
            margin-left: 2%;
            margin-bottom: 2%;
        }
        ul {margin:0;}
        li {list-style:none;}
    </style>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>

<div id="container">

    <div id="header">
        <h1>Cinema Sign in Page</h1>
    </div>

    <div id="menu">
        <br />
        <h2>Welcome!</h2>
        <ul>
        <a href="Welcome_Page.html"><h2>Home</h2></a>
        </ul>
    </div>

    <div id="content">
        <form name="login" action="Signin_Verify.php" method="post">
            <br />
            <br />
            &nbsp;
            <a1>Username：</a1>
            &nbsp;
            <input type="text" name="user">
            <br />
            <br />
            &nbsp;
            <a1>Password：  </a1>
            &nbsp;
            <input type="password" name="password">
            <br />
            <br />&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Login">
        </form> 
        <form name="register" action="Cinema_Register.php" method="post">
            &nbsp;&nbsp;&nbsp;<input type="submit" value="Register">
        </form>


    </div>

    <div id="footer">Copyright FirstView</div>

</div>

</body>
</html>
