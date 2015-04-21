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
      <h1 id="h2">SAVE MONEY!</h1>
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
 
$stid = oci_parse($conn, 'SELECT MOVIE_ID, TITLE, SUM(SAVE) AS SAVE
FROM(SELECT MOVIE_ID, TITLE, ((1-DISCOUNT)*PRICE) AS SAVE
FROM TICKET NATURAL JOIN MOVIE
WHERE CUST_ID=:d)
GROUP BY MOVIE_ID, TITLE');

$stid1 = oci_parse($conn, 'SELECT SUM(SAVE) AS SAVETOTLE
FROM
(SELECT MOVIE_ID, TITLE, SUM(SAVE) AS SAVE
FROM(SELECT MOVIE_ID, TITLE, ((1-DISCOUNT)*PRICE) AS SAVE
FROM TICKET NATURAL JOIN MOVIE
WHERE CUST_ID=:c)
GROUP BY MOVIE_ID, TITLE)');

$temp=$_COOKIE["customername"];
$temp1=$_COOKIE["customername"];
oci_bind_by_name($stid, ':d',$temp );
oci_bind_by_name($stid1, ':c',$temp1 );
oci_define_by_name($stid, 'TITLE', $TITLE);
oci_define_by_name($stid, 'MOVIE_ID', $MOVIE_ID);
oci_define_by_name($stid, 'SAVE', $SAVE);
oci_define_by_name($stid1, 'SAVETOTLE', $SAVETOTLE);
oci_execute($stid);
oci_execute($stid1);

$count=1;
oci_fetch($stid1);
 echo "<br>";
 echo "YOU HAVE TOTALLY SAVED $$SAVETOTLE!";
 echo "<br><img class='r' src='t1.gif' width='20%'/>";
while(oci_fetch($stid))
{   
    
 
  echo "<br>";

  echo" <form action='Movie_Page.php' method='get'><img src='save.jpeg' width='2%'/>HOT MOVIE<img src='save.jpeg' width='2%'/> NO$count.<br> <br>MOVIE NAME: $TITLE <input type='submit' value='Details' /><br>
YOU HAVE SAVED $$SAVE OF THIS MOVIE!
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