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
 
echo $_POST["ctype"];
echo $_POST["no"];
echo $_POST["name"];
echo $_POST["code"];
echo $_POST["date"];
echo $_COOKIE["customername"];
$dat=$_POST["date"];

echo $dat;


$stid = oci_parse($conn, "INSERT INTO PURCHASE_METHODS(CARD_CATEGORY,CARD_NO,NAME_ON_CARD,SECURITY_CODE,EXP_DATE,CUST_ID) 
VALUES(:vctype,:vno,:vname,:vcode,to_date(:vdate, 'yyyy-mm-dd'),:vuserid)");

oci_bind_by_name($stid, ':vctype', $_POST["ctype"]);
oci_bind_by_name($stid, ':vno', $_POST["no"]);
oci_bind_by_name($stid, ':vname', $_POST["name"]);
oci_bind_by_name($stid, ':vcode', $_POST["code"]);
oci_bind_by_name($stid, ':vdate', $dat);
oci_bind_by_name($stid, ':vuserid', $_COOKIE["customername"]);
oci_execute($stid);
while(oci_fetch($stid))
{}

oci_free_statement($stid);
oci_close($conn);





?>
<body onload="history.go(-1);">

<div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>

</body>
</html>