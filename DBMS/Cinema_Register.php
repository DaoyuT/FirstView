#!/usr/local/bin/php

<html>
<head lang="en">
    <style type="text/css">
        div#container{width:1000px}
        div#header {background-color:#99bbbb;}
        div#menu {background-color:#ffff99;height:653px;width:300px;float:left;}
        div#content {background-color:#EEEEEE;width:700px;float:left;}
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
        <h1>Cinema Register Page</h1>
    </div>

    <div id="menu">
        <br />
        <h2>Welcome!</h2>
        <a href="Welcome_Page.html"><h2>Home</h2></a>
        <ul>

        </ul>
    </div>

    <div id="content">
        <form name="registerinfo" action="Register_Insert.php" method="post">
            <br />
            &nbsp;
            <a1>Register</a1>
            <br />
            <span   STYLE="font-size: 11pt">
            <pre>     <a1>Username：</a1><input type="text" name="user"></pre>
            <pre>     <a1>Password：</a1><input type="password" name="password"></pre>
            <pre>  <a1>Reenter psw：</a1><input type="password" name="reenter_psw"></pre>
            <pre>  <a1>E-mail addr：</a1><input type="text" name="email_addr"></pre>
            <pre>  <a1>Cinema name：</a1><input type="text" name="cinema_name"></pre>

            <pre>        <a1>State：</a1><select name="states">
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="CA">California</option>
                <option value="NY">New York</option>
            </select></pre>
            <pre>         <a1>City：</a1><input type="text" name="city"></pre>
            <pre>       <a1>Street：</a1><input type="text" name="street"></pre>
            <pre>     <a1>Zip code：</a1><input type="text" name="zip_code"></pre>
            <pre>     <a1>Contact1：</a1><input type="text" name="contact1"></pre>
            <pre>     <a1>Contact2：</a1><input type="text" name="contact2"></pre>
            <pre>     <a1>Contact3：</a1><input type="text" name="contact3"></pre>
            <pre>   <a1>Transports：</a1><input type="text" name="transports"></pre>
            <pre>  <a1>Description：</a1><input size="40" height="60" type="text" name="description"></pre>
            </span>

            &nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Proceed">
        </form>


    </div>

    <div id="footer">Copyright FirstView</div>

</div>

</body>
</html>




