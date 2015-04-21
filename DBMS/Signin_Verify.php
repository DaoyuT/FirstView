#!/usr/local/bin/php

<?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>





<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
}
echo "connected"; 

$stid = oci_parse($conn, 'SELECT USERID,USERNAME,USERPASSWORD FROM USERS');
oci_define_by_name($stid, 'USERID', $uid);
oci_define_by_name($stid, 'USERNAME', $uname);
oci_define_by_name($stid, 'USERPASSWORD', $up);
oci_execute($stid);

while (oci_fetch($stid)) {   /*oci_fetch every time get one tuple.*/
 if(strcmp($uname,$_POST["user"])==0 && strcmp($up,$_POST["password"])==0 && $uid < 80000)
 {
 	setcookie("cineId", "$uid", time()+3600);
 	$stid2 = oci_parse($conn, 'SELECT CINEMA_NAME FROM CINEMA WHERE CINE_ID = :mycineid');
 	oci_define_by_name($stid2, 'CINEMA_NAME', $cinename);
 	oci_bind_by_name($stid2, ':mycineid', $uid);
 	oci_execute($stid2);
 	oci_fetch($stid2);
 	setcookie("cineName", $cinename, time()+3600);
 	header("Location: Cinema_Interface.php");
 	exit;
 }
}

oci_free_statement($stid);
oci_close($conn);
header("Location: Cinema_Sign_in.php");
?>

<html>
<body>

<?php echo $_POST["user"]; ?>
<?php echo $_POST["password"]; ?>

</body>
</html>

