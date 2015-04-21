#!/usr/local/bin/php
<?php 

?>



<html>
<head>
<style type="text/css">
div#container{width:1250px;height:1200px;}

div#header1{text-align:center;background-color:#FFFFCC;width:415px;height:57px;float:left}
div#header2{text-align:center;background-color:#FFFFCC;width:420px;height:57px;float:left}
div#header3{text-align:right;background-color:#FFFFCC;width:415px;height:57px;float:left}


div#info{text-align:left;background-color:#FFCC66;width:1250px;height:1000px;float:left}

</style>
</head>

<body>
<div id="container">
  <div id="header1">
    <a href="Cinema_Interface.php"><h1>Home</h1></a>
  </div>
   
  <div id="header2">
    <h1>Financial Management</h1>
  </div>

  <div id="header3">
    <a href="Cinema_Information_Page.php"> Cinema Info </a>
    <br />
    <br />
    <a href="Welcome_Page.html"> Sign Out </a>
  </div>
  <div id="info">
      <pre>
      Box Office  <form action="Query_Im.php" method="get">   <input type="submit" value="Q1" /></form>
      Sell Rate<form action="Complex_Query2.php" method="get">   <input type="submit" value="Q2" /></form>
      Category<form action="Complex_Query3.php" method="get">   <input type="submit" value="Q3" /></form>
      </pre>
   </div> 
</div>
   
   

  
</body>

</html>



