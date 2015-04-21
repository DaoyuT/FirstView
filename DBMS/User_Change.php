#!/usr/local/bin/php

<html>
<head>


	<link rel="stylesheet" type="text/css" href="style.css" />


</head>

<body>
<div id="container">
   <div id="header1">
    
   </div>
   
   <div id="header2">
      <h1 id="h2">INFORMATION CHANGE</h1>
   </div>

<div id="header3">
        
   </div>
   </div>
   
   

 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>
<p></p>
   
 
   
   <div id="Constrains1">
  <pre> 
 
<h3>Please fill in the blanks:</h3>      
<?php
$a=$_GET["userid"];

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }
$stid1 = oci_parse($conn, ' SELECT USERNAME,EMAIL,PHONE,USERPASSWORD FROM USERS,CUSTOMER_PHONE 
WHERE USERID=CUST_ID AND USERID=:d');
 oci_bind_by_name($stid1, ':d',$a );
oci_define_by_name($stid1, 'USERNAME',$USERNAME);
oci_define_by_name($stid1, 'USERPASSWORD',$USERPASSWORD);
oci_define_by_name($stid1, 'EMAIL',$EMAIL);
oci_define_by_name($stid1, 'PHONE',$PHONE); 
oci_execute($stid1); 
while(oci_fetch($stid1))
{
}

		
?>


<form name='constrains' action='Customer_Information1.php' method='post'>

<input type='hidden' name="userid" value=<?=$a?> size='20'> 
                    New Password: <input type="password" name="Password" id="Password" value='<?=$USERPASSWORD?>' size='20' required/>                     
Enter again:  <input type="password" name="Enter" id="Enter" value='<?=$USERPASSWORD?>' size='20' oninput='check(this)'required/> 
Email:        <input type='email' name="Email"  value='<?=$EMAIL?>' size='20'> 
 Phone:        <input type='tel' name="Phone"  value='<?=$PHONE?>'  size='20'>  
<script language='javascript' type='text/javascript'>
function check(input) {
if (input.value != document.getElementById('Password').value) {
input.setCustomValidity('Password Must be Matching.');
} else {
// input is valid -- reset the error message
input.setCustomValidity('');
}
}
</script>
<br /><br />

<input type='submit' value='Change'> 
</form> 



  </pre> 
   </div>
   </div>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>

</html>
