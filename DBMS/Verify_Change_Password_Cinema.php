#!/usr/local/bin/php

<?php 
$oldpsw = $_POST["oldpsw"];
$newpsw = $_POST["newpsw"];
$repsw = $_POST["repsw"];
$cineid = $_COOKIE["cineId"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}
$sql = 'SELECT  USERPASSWORD FROM USERS WHERE USERID = :mycineid';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'USERPASSWORD', $psw);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

if(strcmp($newpsw, $repsw) == 0 && strcmp($psw, $oldpsw) == 0){
  $sql = 'UPDATE USERS SET USERPASSWORD = :newpsw WHERE USERID = :mycineid';
  $stid = oci_parse($conn, $sql);
  
  oci_bind_by_name($stid, ':newpsw', $newpsw);
  oci_bind_by_name($stid, ':mycineid', $cineid);
  oci_execute($stid);
  oci_free_statement($stid);
  oci_close($conn);
  echo "<script language=javascript>alert('Password changed.');location.href='Cinema_Sign_in.php'</script>";
}else{
  oci_close($conn);
  
  echo "<script language=javascript>alert('Wrong password, please try again.');location.href='Change_Password_Cinema.php'</script>";
}

?>
