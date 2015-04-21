#!/usr/local/bin/php
<?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>
<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }


$stid = oci_parse($conn, 'SELECT USERNAME,USERPASSWORD,USERID FROM USERS');
oci_define_by_name($stid, 'USERNAME', $uname);
oci_define_by_name($stid, 'USERPASSWORD', $up);
oci_define_by_name($stid, 'USERID', $userid);
oci_execute($stid);

   
while (oci_fetch($stid)) {   /*oci_fetch every time get one tuple.*/
 if(strcmp($uname,$_POST["username"])==0 && strcmp($up,$_POST["password"])==0)
 {
 	header("Location: http://www.cise.ufl.edu/~wenchao/Customer_Interface.php");
 	setcookie("customername",$userid , time()+3600);
 	exist;
 }
}

oci_free_statement($stid);
oci_close($conn);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="container">
   <div id="header1">
     
   </div>
   
   <div id="header2">
      <h1 id="h2">CUSTOMER SIGN IN</h1>
   </div>

   <div id="header3">
      
   </div>
   </div>


<h3>There was a problem with your request</h3>
<h3>There was an error with your E-Mail/Password combination. <a href="http://www.cise.ufl.edu/~wenchao/Customer_signin_page.html"> Please try again.</a></h3>

</body>
</html>

