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

$sql = 'SELECT TITLE, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET NATURAL JOIN MOVIE WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY MOVIE_ID, TITLE ORDER BY PSUM DESC';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
echo "Groupby Movie<br>";

$i = 0;
$titleGM = array();
$boxGM = array();
while(oci_fetch($stid) ){
  echo "Title : $title";
  echo "\t";
  echo "B.O. :    $".$boxOffice;
  echo "<br>";
  $titleGM[$i] = $title;
  $boxGM[$i] = $boxOffice;
  $i++;
  $name1=$name1.$title.'|';
  $data1=$data1.$boxOffice.'|';
}


echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
<input type='hidden' name='name' value='$name1' /> 
<input type='hidden' name='data' value='$data1' /> <br>
<input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
</form>";

oci_free_statement($stid);

$sql = 'SELECT TDATE, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY TDATE ORDER BY TDATE';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TDATE', $tdate);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
echo "Groupby Date<br>";

$i = 0;
$dateGD = array();
$boxGD = array();
while(oci_fetch($stid) ){
  echo "Date :  $tdate";
  echo "\t";
  echo "B.O. :    $".$boxOffice;
  echo "<br>";  
  $dateGD[$i] = $tdate;
  $boxGD[$i] = $boxOffice;
  $i++;
  $name2=$name2.$tdate.'|';
  $data2=$data2.$boxOffice.'|';
}
echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
      <input type='hidden' name='name' value='$name2' /> 
      <input type='hidden' name='data' value='$data2' /> <br>
      <input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
      </form>";
oci_free_statement($stid);

$sql = "SELECT EXTRACT(month FROM TDATE) AS MONTH, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid AND TDATE > '21/APR/2014' GROUP BY EXTRACT(month FROM TDATE) ORDER BY PSUM DESC";
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'MONTH', $month);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
echo "Groupby Month<br>";

$i = 0;
$monthGD = array();
$boxGD = array();
while(oci_fetch($stid) ){
  echo "Month :  $month";
  echo "\t";
  echo "B.O. :    $".$boxOffice;
  echo "<br>";
  $monthGD[$i] = $month;
  $boxGD[$i] = $boxOffice;
  $i++;
  $name3=$name3.$month.'|';
  $data3=$data3.$boxOffice.'|';
}
echo "<form action='http://www.wenchaozhang.com/php/sta2.php' method='get'>     
      <input type='hidden' name='name' value='$name3' /> 
      <input type='hidden' name='data' value='$data3' /> <br>
      <input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
      </form>";
oci_free_statement($stid);

$sql = "SELECT PERIOD, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY PERIOD ORDER BY PSUM DESC";
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'PERIOD', $period);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
echo "Groupby Period<br>";

$i = 0;
$periodGD = array();
$boxGD = array();

$timearrow=array("Null","8:30~11:30","12:30~15:30","16:30~19:30","20:30~23:30");
while(oci_fetch($stid) ){
  $timeperiod = $timearrow[$period];
  echo "Period :  $timeperiod";
  echo "\t";
  echo "B.O. :    $".$boxOffice;
  echo "<br>";
  $periodGD[$i] = $period;
  $boxGD[$i] = $boxOffice;
  $i++;
  $name4=$name4.$timeperiod.'|';
  $data4=$data4.$boxOffice.'|';
}
echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
      <input type='hidden' name='name' value='$name4' /> 
      <input type='hidden' name='data' value='$data4' /> <br>
      <input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
      </form>";
oci_free_statement($stid);
/*
$sql = 'SELECT TITLE, TDATE, SUM(PRICE*DISCOUNT) AS PSUM FROM TICKET NATURAL JOIN MOVIE WHERE ISSOLD = 1 AND CINE_ID = :mycineid GROUP BY TITLE, MOVIE_ID, TDATE ORDER BY TDATE';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'TDATE', $tdate);
oci_define_by_name($stid, 'PSUM', $boxOffice);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
echo "Groupby Date & Movie<br>";

$i = 0;
$titleGDM = array();
$dateGDM = array();
$boxGDM = array();
while(oci_fetch($stid) ){
  echo "Title : $title";
  echo "<br>";
  echo "Date :  $tdate";
  echo "<br>";
  echo "BO :    $boxOffice";
  echo "$";
  echo "<br>";
  $titleGDM[$i] = $title;
  $dateGDM[$i] = $tdate;
  $boxGDM[$i] = $boxOffice;
  $i++;
}

oci_free_statement($stid);
*/

oci_close($conn);

/*
$dataString1 = serialize($titleGM);
$dataString2 = serialize($boxGM);
$dataString3 = serialize($dateGD);
$dataString4 = serialize($boxGD);

echo("<form action='http://wenchaozhang.com/php/Image.php' method='get'>
      <input name='a' type='hidden' value='Hello'>
      <input name='data1' type='hidden' value='$dataString1'>
      <input name='data2' type='hidden' value=$dataString2>
      <input name='data3' type='hidden' value=$dataString3>
      <input name='data4' type='hidden' value=$dataString4>
      <input type='submit' value='Image' /></form>");
*/



?>

