#!/usr/local/bin/php


<html>
<head lang="en">
    <style type="text/css">
        div#container{width:1000px}
        div#header {background-color:#99bbbb;}
        div#menu {background-color:#ffff99;height:269px;width:300px;float:left;}
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
        <h1>Hall Information</h1>
    </div>

    <div id="menu">
        <br />
        <h2>Welcome!</h2>
        <a href="Cinema_Interface.php"><h2>Home</h2></a>
        <ul>

        </ul>
    </div>

    <div id="content">
        <form name="insert" action="Hall_Insert.php" method="post">
            <br />
            &nbsp;
            <a1>Hall Infromation</a1>
            <br />
            <span   STYLE="font-size: 11pt">
            <pre>        <a1>Hall ID：</a1><input type="text" name="hallId"></pre>
            <pre>     <a1>Column No.：</a1><input type="text" name="columnNo"></pre>
            <pre>        <a1>Row No.：</a1><input type="text" name="rowNo"></pre>
            </span>
            <p><span   STYLE="font-size: 11pt">            </span>
              
              &nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              
              <input type="submit" action value="Insert">
            </p>
        </form>
            <form name="Complete" action="Cinema_Interface.php" method="get">
            &nbsp;&nbsp;  &nbsp;   &nbsp;    &nbsp;           &nbsp;
            <input type="submit" value="Complete" />
        </form>
        <br />
            
        


  </div>

    <div id="footer">Copyright FirstView</div>

</div>

</body>
</html>