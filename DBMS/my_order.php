#!/usr/local/bin/php

<?php 
$temp=$_COOKIE["customername"];
?>
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
      <h1 id="h2">MY ORDERS</h1>
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
//echo $_GET["keyword"];
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

$stid = oci_parse($conn, 'SELECT CINE_ID,TICKET.MOVIE_ID AS MOVIEID,TITLE,PERIOD,COLUMN_ID,HALL_ID,ROW_ID,PRICE,PURCHASETIME,TICKET.TDATE AS TDATE1 FROM TICKET JOIN MOVIE ON TICKET.MOVIE_ID= MOVIE.MOVIE_ID WHERE TICKET.CUST_ID=:d ORDER BY PURCHASETIME DESC');
oci_bind_by_name($stid, ':d',$temp );
oci_define_by_name($stid, 'TITLE', $TITLE);
oci_define_by_name($stid, 'HALL_ID', $hallid);
oci_define_by_name($stid, 'PERIOD', $period);
oci_define_by_name($stid, 'PRICE', $price);
oci_define_by_name($stid, 'PURCHASETIME', $PURCHASETIME);
oci_define_by_name($stid, 'TDATE1', $TDATE);
oci_define_by_name($stid, 'COLUMN_ID', $COLUMN);
oci_define_by_name($stid, 'ROW_ID', $ROW);
oci_define_by_name($stid, 'MOVIEID', $movieid);
oci_define_by_name($stid, 'CINE_ID', $cinemaid);
oci_execute($stid);


$counter=1;
while(oci_fetch($stid))
{      
echo"<br>";
echo"<b>ORDER NO $counter .</b>";
echo"<br>";
echo"DATE:$TDATE";
echo" <br>";
echo" PERIOD:$period";
echo" <br>";
$stid1 = oci_parse($conn, 'SELECT CINEMA_NAME FROM CINEMA WHERE CINE_ID=:d1' );
oci_bind_by_name($stid1, ':d1',$cinemaid );
oci_define_by_name($stid1, 'CINEMA_NAME', $cinemaname);
oci_execute($stid1);
oci_fetch($stid1);
echo "CINEMA NAME：$cinemaname ";
echo" <form name='constrains' action='Movie_Page.php' method='get'>MOVIE NAME: $TITLE<input type='hidden' name='movieid' value='$movieid'><input type='submit' value='details'></form>"; 
echo" HALL NO.:$hallid";
echo" <br>";
echo" SEAT NO.:$COLUMN";
echo" <br>";
echo" SEAT NO.:$ROW";
echo" <br>";

echo"PURCHASETIME:$PURCHASETIME";
echo" <br> ";

echo"PRICE:$price";
echo" <br>";
echo"<form name='review' action='My_Reviews.php' method='get'>
<input type='hidden' name='movieid' value='$movieid'>
<input type='hidden' name='moviename' value='$TITLE'>
<input type='hidden' name='cinemaid' value='$cinemaid'>
<input type='hidden' name='cinemaname' value='$cinemaname'>
<input type='submit' value='write reviews'></form>";  

$counter=$counter+1;
 //echo"Rating:xxxx";<input type='hidden' name='movieid' value='$MID'> <input type='hidden' name='cinemaid' value='$CID'> 
//echo" <br>"; <form action='My_Reviews.php' method='post'>

//<input type='submit' name='submit' value='Write Review? GO!' style='background-color: rgb(255,165,0);Font-size: 9pt;'></form>
 //echo"My comment:xxxx";
//echo" <br>"; 
//echo"<input type="submit" value="Edit"></form> 
            
//<form name="constrains" action="my_reviews.html" method="get">
//Cinima Name:<a href=Cinema_Page.html>xxxx</a><br />
//Rating:xxxxx<br /> 
//My comment:xxxx<br /> 
//<input type="submit" value="Edit"></form></h4>";   
}


oci_close($conn);
?>


   </div>
   </div>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>

</html>