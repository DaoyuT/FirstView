#!/usr/local/bin/php



<html>
<body>
<?php
$cineid = $_COOKIE["cineId"];
$deleteid = $_GET["deleteid"];
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
     echo "connection error!";
}

$sql = 'DELETE FROM HALL WHERE CINE_ID = :mycineid AND HALL_ID = :myhallid';
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_bind_by_name($stid, ':myhallid', $deleteid);
oci_execute($stid);
oci_fetch($stid);

oci_free_statement($stid);

oci_close($conn);

header("Location: Hall_Information.php");
?>
</body>

</html>


