#!/usr/local/bin/php

<?php
$movieid=$_GET["movieid"];
$moviename=$_GET["moviename"];
$cinemaid=$_GET["cinemaid"];
$cinemaname=$_GET["cinemaname"];


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
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }
$temp=$_COOKIE["customername"];

$stid0 = oci_parse($conn, 'SELECT COUNT(*) FROM MOVIE_REVIEW WHERE MOVIE_ID=:m AND CUST_ID=:c0');
oci_bind_by_name($stid0, ':m',$movieid );
oci_bind_by_name($stid0, ':c0',$temp );
oci_define_by_name($stid0,'COUNT(*)',$flag);
oci_execute($stid0);
oci_fetch($stid0);

if(!$flag)
{
$stid = oci_parse($conn, 'INSERT INTO MOVIE_REVIEW(CUST_ID, MOVIE_ID, REVIEW_TIMESTAMP, RATING,COMMENTS) VALUES (:a,:b,CURRENT_TIMESTAMP,:d,:e)');

oci_bind_by_name($stid, ':a',$temp );
oci_bind_by_name($stid, ':b',$movieid );
//oci_bind_by_name($stid, ':c',$REVIEW_TIMESTAMP );
oci_bind_by_name($stid, ':d',$_GET["r1"] );
oci_bind_by_name($stid, ':e',$_GET["comment0"]);




oci_execute($stid);



echo"<h2>You have successfully reviewed the movie!</h2><br>";


}
else
{
 echo "<h4>Sorry, we cannot insert your review for you have reviewed this movie before. </h4>";
}





$temp1=$_COOKIE["customername"];

$stid5 = oci_parse($conn, 'SELECT COUNT(*) FROM CINEMA_REVIEW WHERE CINEMA_ID=:cc AND CUST_ID=:c1');
oci_bind_by_name($stid5, ':cc',$cinemaid );
oci_bind_by_name($stid5, ':c1',$temp1 );
oci_define_by_name($stid5,'COUNT(*)',$flag1);

oci_execute($stid5);
oci_fetch($stid5);


if(!$flag)
{
$stid1 = oci_parse($conn, 'INSERT INTO CINEMA_REVIEW(CINE_ID,CUST_ID,REVIEW_TIMESTAMP,RATING,COMMENTS) VALUES (:f,:g,CURRENT_TIMESTAMP,:i,:j)');

oci_bind_by_name($stid1, ':f',$cinemaid );
oci_bind_by_name($stid1, ':g',$temp1 );
oci_bind_by_name($stid1, ':i',$_GET["r2"] );
oci_bind_by_name($stid1, ':j',$_GET["comment1"]);



oci_execute($stid1);


echo"<h2>You have successfully reviewed the cinema!</h2><br>";
echo"<a href='My_Reviews0.php'><h3>See my reviews</h3></a>";

}
else
{
 echo "<h4>Sorry, we cannot insert your review for you have reviewed this cinema before. </h4>";
}




oci_close($conn);
?>


   </div>
   </div>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>

</html>
