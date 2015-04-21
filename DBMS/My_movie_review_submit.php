#!/usr/local/bin/php

<?php

$movieid=$_GET["movieid"];

?>

<html>


<body>
 

   
   <div id="Contents">
 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>
<?php
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

$temp1=$_COOKIE["customername"];

$stid5 = oci_parse($conn, 'SELECT COUNT(*) as CT FROM MOVIE_REVIEW WHERE MOVIE_ID=:cc AND CUST_ID=:c1');
oci_bind_by_name($stid5, ':cc',$movieid );
oci_bind_by_name($stid5, ':c1',$temp1 );
oci_define_by_name($stid5,'CT',$flag1);

oci_execute($stid5);
oci_fetch($stid5);

if(!$flag1)
{
$stid1 = oci_parse($conn, 'INSERT INTO MOVIE_REVIEW(MOVIE_ID,CUST_ID,RATING,COMMENTS,REVIEW_TIMESTAMP) VALUES (:f,:g,:i,:j,CURRENT_TIMESTAMP)');

oci_bind_by_name($stid1, ':f',$movieid );
oci_bind_by_name($stid1, ':g',$temp1 );
oci_bind_by_name($stid1, ':i',$_GET["r2"] );
oci_bind_by_name($stid1, ':j',$_GET["comment1"]);



oci_execute($stid1);


echo"<h2>You have successfully reviewed the movie!</h2><br>";

}
else
{
 echo "<h4>Sorry, we cannot insert your review since you have already reviewed this movie. </h4>";
}

echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
oci_close($conn);
?>

</body>

</html>
