#!/usr/local/bin/php

<?php 
$cineid = $_COOKIE["cineId"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}

$sql1 = ' SELECT CATEGORY, SUM(PRICE*DISCOUNT) AS PSUM
          FROM TICKET NATURAL JOIN MOVIE_CATEGORY
          WHERE ISSOLD=1 AND CINE_ID=:mycineid
          GROUP BY CATEGORY
          ORDER BY PSUM DESC';
$stid1 = oci_parse($conn, $sql1);


oci_define_by_name($stid1, 'CATEGORY', $category);
oci_define_by_name($stid1, 'PSUM', $boxOffice);
oci_bind_by_name($stid1, ':mycineid', $cineid);
oci_execute($stid1);

echo "Groupby CATEGORY<br>";
while(oci_fetch($stid1)  ){
  echo "GATEGORY : $category";
  echo "<br>";
  echo "Box Office : $".$boxOffice;
  echo "<br>";
  $name1=$name1.$category.'|';
  $data1=$data1.$boxOffice.'|';
}

echo "<form action='http://www.wenchaozhang.com/php/sta2.php' method='get'>     
<input type='hidden' name='name' value='$name1' /> 
<input type='hidden' name='data' value='$data1' /> <br>
<input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
</form>";

oci_free_statement($stid1);
oci_free_statement($stid2);


oci_close($conn);


?>

