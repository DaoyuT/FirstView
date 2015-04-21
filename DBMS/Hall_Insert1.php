#!/usr/local/bin/php

<html>
<body>
<?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>

<?php echo $_POST["hallId"]; ?>
<?php echo $_POST["columnNo"]; ?>
<?php echo $_POST["rowNo"]; ?>

<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
}
echo "connected"; 

#insert into table 'hall'
$sql = 'INSERT INTO HALL (CINE_ID, HALL_ID, COLUMN_NO, ROW_NO) VALUES(:myid, :myhall, :mycno, :myrno)';
$stid = oci_parse($conn, $sql);

$cineid = $_COOKIE["cineId"];
$hall = $_POST["hallId"];
$cno = $_POST["columnNo"];
$rno = $_POST["rowNo"];

echo $cineid;

oci_bind_by_name($stid, ':myid', $cineid);
oci_bind_by_name($stid, ':myhall', $hall);
oci_bind_by_name($stid, ':mycno', $cno);
oci_bind_by_name($stid, ':myrno', $rno);
oci_execute($stid);
oci_free_statement($stid);

echo "good";

oci_close($conn);
header("Location: Hall_Information_Add.php");
?>
</body>
</html>

