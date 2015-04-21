#!/usr/local/bin/php
<?php
?>

<html>
<head>
<style type="text/css">
div#container{width:1250px;height:800px;}

div#header1{text-align:center;background-color:#FFFFCC;width:415px;height:57px;float:left}
div#header2{text-align:center;background-color:#FFFFCC;width:420px;height:57px;float:left}
div#header3{text-align:right;background-color:#FFFFCC;width:415px;height:57px;float:left}


div#info{text-align:left;background-color:#FFCC66;width:1250px;height:600px;float:left}

</style>
</head>

<body>
<div id="container">
   <div id="header1">
      <a href="Cinema_Interface.php"><h1>Home</h1></a>
   </div>
   
   <div id="header2">
      <h1>Password Change</h1>
   </div>

 <div id="header3">
        <a href="Cinema_Information_Page.php"> Cinema Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   
   
   <pre> 
   <div id="info">
    <form action="Verify_Change_Password_Cinema.php" method="post"> 
<li>Old password:             <input type="password" name="oldpsw" /></li>
<li>New password:             <input type="password" name="newpsw" /></li>
<li>Enter new password again: <input type="password" name="repsw" /></li>


                                           <input type="submit" value="Save" />             
 </form>
   </div>    
                  



   </pre>
   
   </div>
   
   

  
</body>

</html>


