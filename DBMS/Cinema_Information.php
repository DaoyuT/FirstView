#!/usr/local/bin/php

<?php 
$cineid = $_COOKIE["cineId"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}
$sql = 'SELECT  CINEMA_NAME, STATE, CITY, STREET, ZIP_CODE, DESCRIPTION FROM CINEMA WHERE CINE_ID = :mycineid';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'CINEMA_NAME', $cname);
oci_define_by_name($stid, 'STATE', $state);
oci_define_by_name($stid, 'CITY', $city);
oci_define_by_name($stid, 'STREET', $street);
oci_define_by_name($stid, 'ZIP_CODE', $zipcode);
oci_define_by_name($stid, 'DESCRIPTION', $dscrpt);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

$sql = 'SELECT  USERNAME, EMAIL FROM USERS WHERE UsERID = :mycineid';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'USERNAME', $uname);
oci_define_by_name($stid, 'EMAIL', $email);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

$sql = 'SELECT CONTACTS FROM CINEMA_CONTACT WHERE CINE_ID = :mycineid';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'CONTACTS', $contact);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

$sql = 'SELECT TRANSPORT FROM CINEMA_TRANS WHERE CINE_ID = :mycineid';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TRANSPORT', $trans);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

oci_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
div#container{width:1250px;height:1200px;}

div#header1{text-align:center;background-color:#FFFFCC;width:415px;height:57px;float:left}
div#header2{text-align:center;background-color:#FFFFCC;width:420px;height:57px;float:left}
div#header3{text-align:right;background-color:#FFFFCC;width:415px;height:57px;float:left}


div#info{text-align:left;background-color:#FFCC66;width:1250px;height:900px;float:left}

</style>
</head>

<body>
<div id="container">
   <div id="header1">
      <a href="Cinema_Interface.php"><h1>Home</h1></a>
   </div>
   
   <div id="header2">
      <h1>Cinema Information</h1>
   </div>

   <div id="header3">
        <a href="Cinema_Information.php"> Cinema Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   
   
   <pre> 
   <div id="info">
    

<li>   Cinema Name:    <?php echo $cname; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="cname"> <input type="hidden" name="tag" value="1"/> <input type="submit" value="Edit" /></form></li>
<li>   Username:       <?php echo $uname; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="uname"> <input type="hidden" name="tag" value="2"/> <input type="submit" value="Edit" /></form></li>
<li>   Email:          <?php echo $email; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="email"> <input type="hidden" name="tag" value="3"/> <input type="submit" value="Edit" /></form></li>
<li>   State:          <?php echo $state; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="state"> <input type="hidden" name="tag" value="4"/> <input type="submit" value="Edit" /></form></li>
<li>   City:           <?php echo $city; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="city"> <input type="hidden" name="tag" value="5"/> <input type="submit" value="Edit" /></form></li>
<li>   Street:         <?php echo $street; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="street"> <input type="hidden" name="tag" value="6"/> <input type="submit" value="Edit" /></form></li>
<li>   Zip Code:       <?php echo $zipcode; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="zipcode"> <input type="hidden" name="tag" value="7"/> <input type="submit" value="Edit" /></form></li>
<li>   Phone NO.:      <?php echo $contact; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="contact"> <input type="hidden" name="tag" value="8"/> <input type="submit" value="Edit" /></form></li>
<li>   Transprotations:      <?php echo $trans; ?> <form action="Cinema_Information_Change.php" method="post"> <input type="text" name="trans"> <input type="hidden" name="tag" value="9"/> <input type="submit" value="Edit" /></form></li>
<li>   Description:          <?php echo $dscrpt; ?><form action="Cinema_Information_Change.php" method="post"> <input type="text" name="dscrpt"> <input type="hidden" name="tag" value="10"/> <input type="submit" value="Edit" /></form></li>
 
 <form action="Hall_Information.php" method="get">
                          <input type="submit" value="Hall Information" />             
 </form>
<form action="Change_Password_Cinema.php" method="get">
                          <input type="submit" value="Change Password" />             
 </form>
   </div>    
                  



   </pre>
   
   </div>
   
   

  
</body>

</html>


