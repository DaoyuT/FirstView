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
      <h1 id="h2">ACCOUNT INFORMATION</h1>
   </div>

   <div id="header3">
        <a href="Account_Information.php"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
   
   <pre> 
   <div id="pwdchange">
   <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>
<?php
$temp=$_COOKIE["customername"];
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }
$stid = oci_parse($conn, 'SELECT EMAIL,USERNAME FROM users WHERE USERID = :d');
oci_bind_by_name($stid, ':d',$temp);
oci_define_by_name($stid, 'EMAIL',$email);
oci_define_by_name($stid, 'USERNAME',$username);
oci_execute($stid);
echo "<br>";
  

while(oci_fetch($stid))
{ echo " <li>  Username: $username  </li> ";  
  echo "<br>";
  echo " <li>   Email: $email </li>";
       echo "<br>";
           }
           
$stid1 = oci_parse($conn, 'SELECT PHONE FROM customer_phone JOIN users ON customer_phone.CUST_ID = users.USERID WHERE users.USERID =:d1');
oci_bind_by_name($stid1, ':d1',$temp );
oci_define_by_name($stid1, 'PHONE',$phone);
oci_execute($stid1);

  
while(oci_fetch($stid1)){
 echo " <li>   Phone NO.: $phone </li> <form action='User_Change.php' method='get'> 
 <input type='hidden' name='userid' value='$temp' /> 
 <input class='button' type='submit' value='Edit' /></form> ";
        echo "<br>";
}



 oci_close($conn);

?>
   
   </div>    
   </pre>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
	  </body>
	</html>
