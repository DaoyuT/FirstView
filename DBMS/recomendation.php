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
      <h1 id="h2">GUESS YOU LIKE</h1>
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
 
$stid = oci_parse($conn, 'SELECT MOVIE_ID, TITLE FROM MOVIE
WHERE MOVIE_ID IN
(SELECT MOVIE_ID FROM MOVIE_CATEGORY WHERE CATEGORY =
(SELECT CATEGORY FROM
(SELECT CATEGORY, COUNT(*)AS NUM FROM (SELECT CATEGORY
FROM TICKET, MOVIE_CATEGORY
WHERE MOVIE_CATEGORY.MOVIE_ID=TICKET.MOVIE_ID AND CUST_ID=:d)
GROUP BY CATEGORY ORDER BY NUM DESC) WHERE ROWNUM=1)) AND ISONSHOW=1 AND ROWNUM<11');

$temp=$_COOKIE["customername"];
oci_bind_by_name($stid, ':d',$temp );

oci_define_by_name($stid, 'TITLE', $TITLE);
oci_define_by_name($stid, 'MOVIE_ID', $MOVIE_ID);
oci_execute($stid);

$count=1;
echo "<br><img class='r' src='t2.gif' width='20%'/>";
while(oci_fetch($stid))
{   
    
  echo "<br>";

  echo" <form action='Movie_Page.php' method='get'>RECOMENDATION TOP NO$count.<img src='flower.jpeg' width='2%'/><br> <br>MOVIE NAME: $TITLE <input type='submit' value='Details' />
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
