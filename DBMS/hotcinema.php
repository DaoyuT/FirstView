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
      <h1 id="h2">HOT CINEMA</h1>
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
 

$stid = oci_parse($conn, 'SELECT CINE_ID, CINEMA_NAME FROM (SELECT CINEMA.CINE_ID, CINEMA.CINEMA_NAME FROM TICKET,CINEMA WHERE CINEMA.CINE_ID=TICKET.CINE_ID AND ISSOLD=1
GROUP BY CINEMA.CINE_ID, CINEMA.CINEMA_NAME ORDER BY COUNT(TICKET_ID) DESC) WHERE ROWNUM<11');



oci_define_by_name($stid, 'CINEMA_NAME', $CINEMA_NAME);
oci_define_by_name($stid, 'CINE_ID', $CINE_ID);
oci_execute($stid);
 echo "<h2><b>Your search result:</b></h2>";
$count=1;
echo "<br><img class='r' src='t6.gif' width='20%'/>";
while(oci_fetch($stid))
{   
    

  echo "<br>";

  echo" <form action='Cinema_Page.php' method='get'><img src='cinemahot.jpeg' width='2%'/>HOT CINEMA TOP NO$count. <br> <br>CINEMA NAME:$CINEMA_NAME <input type='submit' value='Details' />
     <input type='hidden' name='cinemaid' value='$CINE_ID' /> </form>";
  echo "<br>";
     $count=$count+1;
}
 
oci_close($conn);
 
 
?>
      </div>
       
    
 
 
 <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>
 
</html>