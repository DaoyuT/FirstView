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
      <h1 id="h2">AMMOUNT ON EACH CATEGORY </h1>
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
 
$stid = oci_parse($conn, 'SELECT CATEGORY, COUNT(MOVIE_ID) AS SUM
FROM TICKET NATURAL JOIN MOVIE_CATEGORY
WHERE ISSOLD=1 AND CUST_ID=:d
GROUP BY CATEGORY
ORDER BY SUM DESC');

$stid1 = oci_parse($conn,'SELECT CATEGORY
FROM(
SELECT CATEGORY, COUNT(MOVIE_ID) AS SUM
FROM TICKET NATURAL JOIN MOVIE_CATEGORY
WHERE ISSOLD=1 AND CUST_ID=:d
GROUP BY CATEGORY
ORDER BY SUM DESC)
WHERE ROWNUM=1');


$temp=$_COOKIE["customername"];
oci_bind_by_name($stid, ':d',$temp );
oci_define_by_name($stid, 'CATEGORY', $CATEGORY);
oci_define_by_name($stid, 'SUM', $SUM);
oci_define_by_name($stid1, 'CATEGORY', $CATEGORY1);
oci_execute($stid);
oci_execute($stid1);
$count=1;
echo "<br>";
echo"ACCORDING TO YOUR TICKETS, WE HAVE CALCULATED MOVIES YOU WATCHED ON DIFFERENT MOVIE CATEGORY.";
echo "<br>";echo "<br>";
oci_fetch($stid1);
echo"YOU LIKE $CATEGORY1 MOST! <a href='recomendation.php'>WE RECOMENDATION SOME OTHER EXCELLENT MOVIES ON SAME CATEGORY FOR YOU!</a>";
echo "<br><img class='r' src='t7.gif' width='20%'/>";
while(oci_fetch($stid))
{   
    
  echo "<br>";
  echo "<br>";
echo "<br>";

  echo" <img src='love.jpeg' width='2%'/>CATEGORY TOP NO $count.<br> <br>MOVIE CATEGORY: $CATEGORY <br> AMMOUNT:$SUM";
  $name=$name.$CATEGORY.'|';
  $data=$data.$SUM.'|';

     $count=$count+1;

}

echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
<input type='hidden' name='name' value='$name' /> 
<input type='hidden' name='data' value='$data' /> <br>
<input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
</form>";

echo "<form action='http://www.wenchaozhang.com/php/sta2.php' method='get'>     
<input type='hidden' name='name' value='$name' /> 
<input type='hidden' name='data' value='$data' /> <br>
<input type='submit' value='CLICK HERE TO SEE YOUR another GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
</form>";
oci_close($conn);
 
 
?>
      </div>
       
    
 
 
 <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>
 
</html>