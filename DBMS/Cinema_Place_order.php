#!/usr/local/bin/php
<html>
  <head>
	
		<link rel="stylesheet" type="text/css" href="style.css" />
 
	  </head>

<body>
 <div id="container">
   <div id="header1">
      <a href="Cinema_Interface.php"><h2 id="h1">HOME</h2></a>
   </div>
   <div id="header3">
        <a href="Cinema_Information.php"> Cinema Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>  
   <div id="header2">
      <h1 id="h2">Confirmed.</h1>
   </div>


   </div>
 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>


<table>

<?php



//$userid=$_COOKIE["customername"];						 
$columnid=$_GET["columnid"];
$rowid=$_GET["rowid"];
$cinemaid=$_GET["cinemaid"];
$cinemaname=$_GET["cinemaname"];
$period=$_GET["period"];
$movieid=$_GET["movieid"];
$tdate=$_GET["tdate"];
$moviename= $_GET["movname"];
$hallid= $_GET["hallid"];
$newprice= $_GET["newprice"];

//$CARD_NO= $_GET["CARD_NO"];
//$NAME_ON_CARD= $_GET["NAME_ON_CARD"];

$ticketid= $_GET["ticketid"];
$cust_id=$_COOKIE["cineId"];	


$alpharow=array("Null","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA");
$timearrow=array("Null","8:30~11:30","12:30~15:30","16:30~19:30","20:30~23:30");
echo "TICKET INFORMATION: ";
echo "<br>";
echo "Customer Name: ";
echo $cinemaname;
echo "<br>";
echo "CINEMA: ";
echo $cinemaname;
echo "<br>";
echo "MOVIE: ";
echo $moviename;
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
echo $newprice;
echo "<br>";

$selectOption = $_POST['taskOption'];
echo 	$selectOption ;	   


$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");


if(!$conn)
{
	 echo "connection error!";
 }


/*
echo "<br>"; 
echo $ticketid;
echo "<br>";

echo $cust_id;
echo "<br>";
echo $CARD_NO;
*/
//, purchasetime=sysdate, cust_id=:d1,cardno=:d2
$stid = oci_parse($conn, 'UPDATE TICKET SET ISSOLD=1,CUST_ID=:d1,PURCHASETIME=sysdate WHERE TICKET_ID=:ticketid');

oci_bind_by_name($stid, ':ticketid',$ticketid);
oci_bind_by_name($stid, ':d1', $cust_id);

oci_execute($stid);


oci_free_statement($stid);
oci_close($conn);





?>



<br>
<img src="http://www.codeupc.net/barcode.jpg" style="width:200px;height:100px">
<br>


<body>

<br>
<br>
<button onclick="myFunction()">Print Ticket</button>

<script>
function myFunction() {
    window.print();
}
</script>

</body>
<br>
<br>
<div id="footer">Copyright Wenchao GROUP22 COP5725 University of Florida</div>
   </div>
</body>

</html>