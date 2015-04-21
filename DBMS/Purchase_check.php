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
      <h1 id="h2">Reviewing Your Order</h1>
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

  

//$userid=$_COOKIE["customername"];						 
$columnid=$_GET["columnid"];
$rowid=$_GET["rowid"];
$cinemaid=$_GET["cinemaid"];
$cinemaname=$_GET["cinemaname"];
$period=$_GET["period"];
$movieid=$_GET["movieid"];
$tdate=$_GET["tdate"];
$movname= $_GET["moviename"];
$hallid= $_GET["hallid"];
$newprice= $_GET["newprice"];
$userid= $_GET["userid"];
$CARD_CATEGORY= $_GET["CARD_CATEGORY"];
$NAME_ON_CARD= $_GET["NAME_ON_CARD"];
$EXP_DATE= $_GET["EXP_DATE"];
$CARD_NO= $_GET["CARD_NO"];

$ticketid= $_GET["ticketid"];


$alpharow=array("Null","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA");
$timearrow=array("Null","8:30~11:30","12:30~15:30","16:30~19:30","20:30~23:30");
echo "TICKET INFORMATION: ";
echo "<br>";
echo "CINEMA: ";
echo $cinemaname;
echo "<br>";
echo "MOVIE: ";
echo $movname;
echo "<br>";
echo "DATE: ";
echo $tdate;
echo "<br>";
echo "PERIOD: ";
echo $timearrow[$period];
echo "<br>";
echo "Hall No.: ";
echo $hallid;
echo "<br>";
echo "SEAT: ";
echo $alpharow[$rowid];
echo $columnid;
echo "<br>";
echo "Price: ";
echo "$";
echo $newprice;
echo "<br>";
echo "<br>";
echo "PURCHASE INFORMATION: ";
echo "<br>";

$last4 = substr($CARD_NO, -4);
echo "Card Category: ";
echo $CARD_CATEGORY; 
echo "(ending in  ";
echo $last4;
echo ")";
echo "<br>";
echo "Name On Card: ";
echo $NAME_ON_CARD; 
echo "<br>";
echo "Date of Expiration: ";
echo $EXP_DATE;
echo "<br>";
echo "<br>";






$selectOption = $_POST['taskOption'];
echo 	$selectOption ;	   
  echo "
  <table>
  <tr>
    <td>
<form name='sort' action='Place_order.php' method='get'> 
        <input type='hidden' name='columnid' value='$columnid' /> 
        <input type='hidden' name='rowid' value='$rowid' /> 
        <input type='hidden' name='cinemaid' value='$cinemaid' /> 
        <input type='hidden' name='cinemaname' value='$cinemaname' /> 
        <input type='hidden' name='period' value='$period' /> 
        <input type='hidden' name='movieid' value='$movieid' /> 
        <input type='hidden' name='tdate' value='$tdate' /> 
        <input type='hidden' name='movname' value='$movname' /> 
        <input type='hidden' name='hallid' value='$hallid' /> 	
        <input type='hidden' name='userid' value='$userid' /> 	
        <input type='hidden' name='newprice' value='$newprice' /> 	
        <input type='hidden' name='ticketid' value='$ticketid' /> 		
        <input type='hidden' name='NAME_ON_CARD' value='$NAME_ON_CARD' /> 	
        <input type='hidden' name='CARD_NO' value='$CARD_NO' /> 		
     <input type='submit' value='Place Order' /></form>
	 </td>
</tr>
</table>";
?>

</div>

<div id="footer">Copyright Wenchao GROUP22 COP5725 University of Florida</div>
   </div>
</body>

</html>