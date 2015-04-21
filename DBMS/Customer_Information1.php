#!/usr/local/bin/php
<?php $ui=$_COOKIE["customername"];?>
<html>
<head>


	<link rel="stylesheet" type="text/css" href="style.css" />


</head>


<body>
<?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>

<div id="container">
   <div id="header1">

   </div>
   
   <div id="header2">
      <h1 id="h2">CUSTOMER INFORMATION</h1>
   </div>

<div id="header3">
        
   </div>
   </div>
    <div id="Constrains1">
    <h3>Your information has been updated:</h3>
<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");


if(!$conn)
{
	 echo "connection error!";
 }
 




$stid = oci_parse($conn, 'UPDATE users SET USERPASSWORD= :mydata , EMAIL=:useremail WHERE USERID=:myid ');
oci_bind_by_name($stid, ':myid', $ui);
oci_bind_by_name($stid, ':mydata', $_POST["Password"]);
oci_bind_by_name($stid, ':useremail', $_POST["Email"]);
$a=$_POST["userid"];
oci_execute($stid);
oci_free_statement($stid);

$stid1 = oci_parse($conn, 'UPDATE customer_phone SET PHONE= :myphone WHERE CUST_ID=:myid2 ');
oci_bind_by_name($stid1, ':myid2', $ui);
oci_bind_by_name($stid1, ':myphone', $_POST["Phone"]);
oci_execute($stid1);
oci_free_statement($stid1);

$stid3=oci_parse($conn, 'SELECT USERNAME, EMAIL FROM users WHERE USERID = :myid4 ');

oci_bind_by_name($stid3, ':myid4', $ui);
oci_define_by_name($stid3, 'USERNAME', $uname);
oci_define_by_name($stid3, 'EMAIL', $uemail);
oci_execute($stid3);

oci_fetch($stid3);
echo"<br><br><br>User name: $uname";
echo"<br><br><br>";
echo"Email:$uemail<br><br><br>";
 oci_free_statement($stid3);

$stid2=oci_parse($conn, 'SELECT PHONE FROM customer_phone WHERE CUST_ID = :myid3 ');
oci_bind_by_name($stid2, ':myid3', $ui);
oci_define_by_name($stid2, 'PHONE', $uphone);
oci_execute($stid2);

oci_fetch($stid2);
echo "New Phone: $uphone<br><br><br><br><br><br>";


oci_free_statement($stid2);
oci_close($conn);


?>
<form name="customer information" action="Customer_signin_page.html" method="post"><input type="submit" value="BACK TO SIGN IN PAGE TO LOG IN"> 
        </form> 
</div>

 



<div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>

</body>
</html>