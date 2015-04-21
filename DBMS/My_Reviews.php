#!/usr/local/bin/php
<?php
$movieid=$_GET["movieid"];
$moviename=$_GET["moviename"];
$cinemaid=$_GET["cinemaid"];
$cinemaname=$_GET["cinemaname"];?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
 
  <div id="container">
   <div id="header1">
      <a href="Customer_Interface.php"><h2 id="h1">HOME</h2></a>
   </div>
   
   <div id="header2">
      <h1 id="h2">MY REVIEWS</h1>
   </div>

   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
<div id="Contents1">
<form id="review" action="ReviewOK.php" method="get">
   <ul>
<h5>
<li>Movie Name: <?php echo"$moviename";?></li><br/>
Rating:<br/>
&#9733; &#9733; &#9733; &#9733; &#9733; <input type="radio" name="r1" value="5" checked="checked" /><br/>
&#9733; &#9733; &#9733; &#9733;<input type="radio" name="r1" value="4" checked="checked"/><br/>
&#9733; &#9733; &#9733;<input type="radio" name="r1" value="3" checked="checked"/><br/>
&#9733; &#9733;<input type="radio" name="r1" value="2 " checked="checked"/><br/>
&#9733;<input type="radio" name="r1" value="1 " checked="checked" /><br/>
<br/>
My comments:<br/>
<textarea name="comment0" rows="5" cols="30"></textarea>
        
   <br />                

<li>Cinema Name:<?php echo"$cinemaname";?></li><br/>

Rating:<br/>
&#9733; &#9733; &#9733; &#9733; &#9733; <input type="radio" name="r2" value="5" checked="checked" /><br/>
&#9733; &#9733; &#9733; &#9733;<input type="radio" name="r2" value="4" checked="checked"/><br/>
&#9733; &#9733; &#9733;<input type="radio" name="r2" value="3" checked="checked"/><br/>
&#9733; &#9733;<input type="radio" name="r2" value="2 " checked="checked"/><br/>
&#9733;<input type="radio" name="r2" value="1 " checked="checked" />

<br />

<br/>
My comments:<br/>
<textarea name="comment1" rows="5" cols="30"></textarea>
                     <input type="submit" name="submit" value="Submit"style='background-color: rgb(255,165,0);Font-size: 9pt;'>
                       
</ul>
<?php



echo" <input type='hidden' name='movieid' value='$movieid'/>";

echo" <input type='hidden' name='moviename' value='$moviename'/>";
echo" <input type='hidden' name='cinemaid' value='$cinemaid'/>";
echo" <input type='hidden' name='cinemaname' value='$cinemaname'/>";
?>

</form> 
 </h5>
 </div>
   </div>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>

</html>