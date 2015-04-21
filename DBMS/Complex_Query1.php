#!/usr/local/bin/php

<?php 
$cineid = $_COOKIE["cineId"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}
$sql = 'SELECT SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'PSUM', $totalBoxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

echo "Total Box Office is $totalBoxOffice";
echo "$";
echo "<br>";

$sql = 'SELECT TITLE, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET NATURAL JOIN MOVIE WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY MOVIE_ID, TITLE';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
echo "Groupby Movie<br>";
while(oci_fetch($stid) ){
  echo "Title : $title";
  echo "<br>";
  echo "BO :    $boxOffice";
  echo "$";
  echo "<br>";
}

oci_free_statement($stid);

$sql = 'SELECT TDATE, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY TDATE ';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TDATE', $tdate);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);

echo "Groupby Date<br>";
while(oci_fetch($stid) ){
  echo "Date :  $tdate";
  echo "<br>";
  echo "BO :    $boxOffice";
  echo "$";
  echo "<br>";
}

oci_free_statement($stid);

$sql = 'SELECT TITLE, TDATE, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET NATURAL JOIN MOVIE WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY TITLE, MOVIE_ID, TDATE ORDER BY TDATE';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'TDATE', $tdate);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);

echo "Groupby Date & Movie<br>";
while(oci_fetch($stid) ){
  echo "Title : $title";
  echo "<br>";
  echo "Date :  $tdate";
  echo "<br>";
  echo "BO :    $boxOffice";
  echo "$";
  echo "<br>";
}

oci_free_statement($stid);

oci_close($conn);
?>

