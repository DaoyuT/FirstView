#!/usr/local/bin/php
 
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
      <h1 id="h2">HOT MOVIE</h1>
   </div>
 
   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
 
  <div id="Contents">
 


      <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>

<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
     echo "connection error!";
 }
 
$stid = oci_parse($conn, 'SELECT TITLE, MOVIE_ID FROM MOVIE WHERE ISONSHOW=1 AND MOVIE_ID IN
(SELECT MOVIE_ID FROM (SELECT MOVIE_ID, COUNT(TICKET_ID) FROM TICKET WHERE ISSOLD=1 GROUP BY MOVIE_ID ORDER BY COUNT(TICKET_ID) DESC) WHERE ROWNUM<11)');



oci_define_by_name($stid, 'TITLE', $TITLE);
oci_define_by_name($stid, 'MOVIE_ID', $MOVIE_ID);
oci_execute($stid);

$count=1;
echo "<br><img class='r' src='t4.gif' width='20%'/>";
while(oci_fetch($stid))
{   
    
 
  echo "<br>";

  echo" <form action='Movie_Page.php' method='get'><img src='hot.jpeg' width='2%'/>HOT MOVIE TOP NO$count.<br> <br>MOVIE NAME: $TITLE <input type='submit' value='Details' />
     <input type='hidden' name='movieid' value='$MOVIE_ID' /> </form>";

     $count=$count+1;
}
 
oci_close($conn);
 
 
?>
      </div>
       
    
 
 
 <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>
 
</html>