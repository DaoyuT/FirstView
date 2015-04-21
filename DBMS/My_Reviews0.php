#!/usr/local/bin/php
<?php 
$temp=$_COOKIE["customername"];
$temp1=$_COOKIE["customername"];
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
      <h1 id="h2">MY REVIEWS</h1>
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

$stid = oci_parse($conn, 'SELECT COMMENTS, RATING, REVIEW_TIMESTAMP, TITLE FROM MOVIE_REVIEW JOIN MOVIE ON MOVIE_REVIEW.MOVIE_ID= MOVIE.MOVIE_ID WHERE CUST_ID=:d');
$stid1 = oci_parse($conn, 'SELECT COMMENTS, RATING, REVIEW_TIMESTAMP, CINEMA_NAME FROM CINEMA_REVIEW JOIN CINEMA ON CINEMA_REVIEW.CINE_ID= CINEMA.CINE_ID WHERE CUST_ID=:f');

oci_bind_by_name($stid, ':d',$temp );
oci_define_by_name($stid, 'TITLE', $TITLE);
oci_define_by_name($stid, 'COMMENTS', $COMMENTS);
oci_define_by_name($stid, 'RATING', $RATING);
oci_define_by_name($stid, 'REVIEW_TIMESTAMP', $REVIEW_TIMESTAMP);

oci_bind_by_name($stid1, ':f',$temp1 );
oci_define_by_name($stid1, 'CINEMA_NAME', $CINEMA_NAME);
oci_define_by_name($stid1, 'COMMENTS', $COMMENTS1);
oci_define_by_name($stid1, 'RATING', $RATING1);
oci_define_by_name($stid1, 'REVIEW_TIMESTAMP', $REVIEW_TIMESTAMP1);
oci_execute($stid);
oci_execute($stid1);

$counter=1;
while(oci_fetch($stid))
{      
echo"<br>";
echo"MOVIE REVIEW NO $counter .";
echo"<br>";
echo"MOVIE NAME:$TITLE";
echo" <br>";
echo"MOVIE COMMENTS:$COMMENTS";
echo" <br>";
if($RATING==5){
echo" MOVIE RATING:&#9733;&#9733;&#9733;&#9733;&#9733;";}
else if($RATING==4){
echo" MOVIE RATING:&#9733;&#9733;&#9733;&#9733;";}
else if($RATING==3){
echo" MOVIE RATING:&#9733;&#9733;&#9733;";}
else if($RATING==2){
echo" MOVIE RATING:&#9733;&#9733;";}
else if($RATING==1){
echo" MOVIE RATING:&#9733;";}
echo" <br>";
echo" REVIEW TIMESTAMP:$REVIEW_TIMESTAMP";
echo" <br>";

$counter=$counter+1;
}
$counter=1;
while(oci_fetch($stid1))
{      
echo"<br>";
echo"CINEMA REVIEW NO $counter .";
echo"<br>";
echo"CINEMA NAME:$CINEMA_NAME";
echo" <br>";
echo"CINEMA COMMENTS:$COMMENTS1";
echo" <br>";
if($RATING1==5){
echo" CINEMA RATING:&#9733;&#9733;&#9733;&#9733;&#9733;";}
else if($RATING1==4){
echo" CINEMA RATING:&#9733;&#9733;&#9733;&#9733;";}
else if($RATING1==3){
echo" CINEMA RATING:&#9733;&#9733;&#9733;";}
else if($RATING1==2){
echo" CINEMA RATING:&#9733;&#9733;";}
else if($RATING1==1){
echo" CINEMA RATING:&#9733;";}
echo" <br>";
echo" REVIEW TIMESTAMP:$REVIEW_TIMESTAMP1";
echo" <br>";

$counter=$counter+1;
}

oci_close($conn);
?>




                      
 


 
   
   </div>
   </div>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>

</html>