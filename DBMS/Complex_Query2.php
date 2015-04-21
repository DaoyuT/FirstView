#!/usr/local/bin/php

<?php 
$cineid = $_COOKIE["cineId"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}
$sql1 = 'SELECT COUNT(*) AS ASUM FROM TICKET WHERE CINE_ID = :mycineid';
$stid1 = oci_parse($conn, $sql1);
$sql2 = 'SELECT COUNT(*) AS SSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid';
$stid2 = oci_parse($conn, $sql2);

oci_define_by_name($stid1, 'ASUM', $allSum);
oci_define_by_name($stid2, 'SSUM', $soldSum);
oci_bind_by_name($stid1, ':mycineid', $cineid);
oci_bind_by_name($stid2, ':mycineid', $cineid);
oci_execute($stid1);
oci_fetch($stid1);
oci_execute($stid2);
oci_fetch($stid2);
oci_free_statement($stid1);
oci_free_statement($stid2);
$totalSellRate = ($soldSum*1.0)/($allSum*1.0);
$totalSellRate = Round($totalSellRate,5);

echo "Total Sell Rate is $totalSellRate";
echo "%";
echo "<br>";

$sql1 = 'SELECT TITLE, COUNT(*) AS ASUM FROM TICKET NATURAL JOIN MOVIE WHERE CINE_ID = :mycineid GROUP BY MOVIE_ID, TITLE ORDER BY MOVIE_ID';
$stid1 = oci_parse($conn, $sql1);
$sql2 = 'SELECT TITLE, COUNT(*) AS SSUM FROM TICKET NATURAL JOIN MOVIE WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY MOVIE_ID, TITLE ORDER BY MOVIE_ID';
$stid2 = oci_parse($conn, $sql2);

oci_define_by_name($stid1, 'ASUM', $allSum);
oci_define_by_name($stid2, 'SSUM', $soldSum);
oci_define_by_name($stid1, 'TITLE', $title);
oci_bind_by_name($stid1, ':mycineid', $cineid);
oci_bind_by_name($stid2, ':mycineid', $cineid);
oci_execute($stid1);
oci_execute($stid2);

echo "Groupby Movie<br>";
while(oci_fetch($stid1) && oci_fetch($stid2) ){
  $sellRate = ($soldSum*1.0)/($allSum*1.0);
  $sellRate = Round($sellRate,5);
  echo "Title : $title";
  echo "\t";
  echo "Sell Rate : $sellRate";
  echo "%";
  echo "<br>";
  $name1=$name1.$title.'|';
  $data1=$data1.$sellRate.'|';
}

echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
<input type='hidden' name='name' value='$name1' /> 
<input type='hidden' name='data' value='$data1' /> <br>
<input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
</form>";

oci_free_statement($stid1);
oci_free_statement($stid2);

$sql1 = 'SELECT TDATE, COUNT(*) AS ASUM FROM TICKET WHERE CINE_ID = :mycineid GROUP BY TDATE ORDER BY TDATE';
$stid1 = oci_parse($conn, $sql1);
$sql2 = 'SELECT TDATE, COUNT(*) AS SSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY TDATE ORDER BY TDATE';
$stid2 = oci_parse($conn, $sql2);

oci_define_by_name($stid1, 'ASUM', $allSum);
oci_define_by_name($stid2, 'SSUM', $soldSum);
oci_define_by_name($stid1, 'TDATE', $tdate);
oci_bind_by_name($stid1, ':mycineid', $cineid);
oci_bind_by_name($stid2, ':mycineid', $cineid);
oci_execute($stid1);
oci_execute($stid2);

echo "Groupby Date<br>";
while(oci_fetch($stid1) && oci_fetch($stid2) ){
  $sellRate = ($soldSum*1.0)/($allSum*1.0);
  $sellRate = Round($sellRate,5);
  echo "Date : $tdate";
  echo "\t";
  echo "Sell Rate : $sellRate";
  echo "%";
  echo "<br>";
  $name2=$name2.$tdate.'|';
  $data2=$data2.$sellRate.'|';
}
echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
      <input type='hidden' name='name' value='$name2' /> 
      <input type='hidden' name='data' value='$data2' /> <br>
      <input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
      </form>";
oci_free_statement($stid1);
oci_free_statement($stid2);


#SELECT EXTRACT(month FROM TDATE) AS MONTH,
#  COUNT(order_date) "No. of Orders"
#  FROM TICKET
#  GROUP BY EXTRACT(month FROM TICKET)
#  ORDER BY "No. of Orders" DESC;

#SELECT last_name, employee_id, hire_date
#   FROM employees
#   WHERE EXTRACT(YEAR FROM
#   TO_DATE(hire_date, 'DD-MON-RR')) > 1998  AND TDATE > '21/APR/2014'  AND TDATE > '21-APR-14'
#   ORDER BY hire_date;
$yearago = "21-APR-14";
$sql1 = " SELECT EXTRACT(month FROM TDATE) AS MONTH, COUNT(*) AS ANUM
          FROM TICKET
          WHERE CINE_ID = :mycineid AND TDATE > '21/APR/2014'
          GROUP BY EXTRACT(month FROM TDATE)
          ORDER BY ANUM DESC";
$stid1 = oci_parse($conn, $sql1);
$sql2 = " SELECT EXTRACT(month FROM TDATE) AS MONTH, COUNT(*) AS SNUM
          FROM TICKET
          WHERE CINE_ID = :mycineid  AND ISSOLD = 1 AND TDATE > '21/APR/2014'
          GROUP BY EXTRACT(month FROM TDATE)
          ORDER BY SNUM DESC";
$stid2 = oci_parse($conn, $sql2);

oci_define_by_name($stid1, 'ASUM', $allSum);
oci_define_by_name($stid2, 'SSUM', $soldSum);
oci_define_by_name($stid1, 'MONTH', $month);
oci_bind_by_name($stid1, ':mycineid', $cineid);
oci_bind_by_name($stid2, ':mycineid', $cineid);
oci_execute($stid1);
oci_execute($stid2);

echo "Groupby Month<br>";
while(oci_fetch($stid1) && oci_fetch($stid2) ){
  $sellRate = ($soldSum*1.0)/($allSum*1.0);
  $sellRate = Round($sellRate,5);
  echo "Month : $month";
  echo "\t";
  echo "Sell Rate : $sellRate";
  echo "%";
  echo "<br>";
  $name3=$name3.$month.'|';
  $data3=$data3.$sellRate.'|';
}
echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
      <input type='hidden' name='name' value='$name3' /> 
      <input type='hidden' name='data' value='$data3' /> <br>
      <input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
      </form>";
oci_free_statement($stid1);
oci_free_statement($stid2);
/*
$sql1 = 'SELECT TITLE, TDATE, COUNT(*) AS ASUM FROM TICKET NATURAL JOIN MOVIE WHERE CINE_ID = :mycineid GROUP BY TITLE, MOVIE_ID, TDATE ORDER BY TDATE';
$stid1 = oci_parse($conn, $sql1);
$sql2 = 'SELECT TITLE, TDATE, COUNT(*) AS SSUM FROM TICKET NATURAL JOIN MOVIE WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY TITLE, MOVIE_ID, TDATE ORDER BY TDATE';
$stid2 = oci_parse($conn, $sql2);

oci_define_by_name($stid1, 'ASUM', $allSum);
oci_define_by_name($stid2, 'SSUM', $soldSum);
oci_define_by_name($stid1, 'TDATE', $tdate);
oci_define_by_name($stid1, 'TITLE', $title);
oci_bind_by_name($stid1, ':mycineid', $cineid);
oci_bind_by_name($stid2, ':mycineid', $cineid);
oci_execute($stid1);
oci_execute($stid2);

echo "Groupby Date & Movie<br>";
while(oci_fetch($stid1) && oci_fetch($stid2) ){
  $sellRate = ($soldSum*1.0)/($allSum*1.0);
  echo "Date : $tdate";
  echo "<br>";
  echo "Title : $title";
  echo "<br>";  
  echo "Sell Rate : $sellRate";
  echo "%";
  echo "<br>";
}

oci_free_statement($stid1);
oci_free_statement($stid2);
*/
oci_close($conn);


?>

