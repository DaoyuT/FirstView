#!/usr/local/bin/php
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
    <h3>Your information has been created:</h3>
Username: <?php echo $_POST["username"]; ?><br>
Email:<?php echo $_POST["Email"]; ?><br>
Phone:<?php echo $_POST["Phone"]; ?><br><br>
<form name="customer information" action="Customer_signin_page.html" method="post"><input type="submit" value="BACK TO SIGN IN PAGE TO LOG IN"> 
        </form> 
</div>


<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");


if(!$conn)
{
	 echo "connection error!";
 }
 
$stid0 = oci_parse($conn, 'SELECT MAX(USERID) FROM USERS');
oci_define_by_name($stid0, 'MAX(USERID)', $max);
oci_execute($stid0);

oci_fetch($stid0);

 $max=$max+1;

$stid = oci_parse($conn, 'INSERT INTO users(userid,username,userpassword,email) VALUES(:myid,:myusername,:mydata,:useremail)');

oci_bind_by_name($stid, ':myusername', $_POST["username"]);
oci_bind_by_name($stid, ':myid', $max);
oci_bind_by_name($stid, ':mydata', $_POST["Password"]);
oci_bind_by_name($stid, ':useremail', $_POST["Email"]);
oci_execute($stid);

$stid1 = oci_parse($conn, 'INSERT INTO customer(CUST_ID) VALUES(:myid1)');
$max1=$max;
oci_bind_by_name($stid1, ':myid1', $max1);
oci_execute($stid1);

$stid2 = oci_parse($conn, 'INSERT INTO customer_phone(CUST_ID,phone) VALUES(:myid2,:phone)');
$max2=$max1;
oci_bind_by_name($stid2, ':myid2', $max2);
oci_bind_by_name($stid2, ':phone', $_POST["Phone"]);
oci_execute($stid2);





oci_free_statement($stid);
oci_close($conn);


?>


<div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>

</body>
</html>