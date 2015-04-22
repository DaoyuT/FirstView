#!/usr/local/bin/php


<html>
<head>
<style type="text/css">
div#container{width:1250px;height:1000px;}
div#table{float:left}
div#tabletab{width:150px;float:left}

div#header2{text-align:center;background-color:#FFFFCC;width:1100px;height:100px;float:left}
div#header3{text-align:right;background-color:#FFFFCC;width:150px;height:100px;float:left}

div#Schedule{background-color:#ffff99;width:1250px;height:800px;float:left}

div#c1{text-align:center;background-color:#FF9933;width:625px;height:70px;float:left}
div#c2{text-align:center;background-color:#CC9999;width:625px;height:70px;float:left}


div#poster1{text-align:center;background-color:#FFFFFF;width:625px;height:100px;float:left}
div#poster2{text-align:center;background-color:#FFFFFF;width:625px;height:100px;float:left}
div#poster3{text-align:center;background-color:#FFFFFF;width:400px;height:100px;float:left}


div#footer{background-color:#99bbbb;clear:both;text-align:center;width:1250px;height:18px;}
h1 {margin-bottom:0%;font-size:30px;}
h2 {margin-bottom:0;font-size:18px;}
ul {margin:0;}
li {list-style:none;}
</style>
</head>

<body>
<?php
$j = 7;
if($_GET["ROWNO"]){
  $j = $_GET["ROWNO"];
}
$today = "21-APR-15";
if($_GET["TICKDAT"]){
  $today = $_GET["TICKDAT"];
}
if($_COOKIE["cineId"] == NULL){
    echo "<script language=javascript>alert('Session expired, please login again.');location.href='Cinema_Sign_in.php'</script>";
}
$cineid = $_COOKIE["cineId"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}
/*test of union
$sql = 'SELECT DISTINCT MOVIE_ID FROM TICKET WHERE PERIOD = 4
        UNION
        SELECT DISTINCT MOVIE_ID FROM TICKET WHERE PERIOD = 5';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'MOVIE_ID', $test);
oci_execute($stid);
while(oci_fetch($stid) ){
  echo $test;
}

oci_free_statement($stid); , COUNT(TDATE) AS MAXD
*/

$sql = 'SELECT COUNT(*) AS MAXD FROM (SELECT TDATE FROM TICKET WHERE CINE_ID = :mycineid GROUP BY TDATE)';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'MAXD', $maxd);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

$sql = 'SELECT DISTINCT TDATE FROM TICKET WHERE CINE_ID = :mycineid ORDER BY TDATE';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TDATE', $tickDat);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
$i = 0;
$arr_tickDat = array();
while($i < $maxd){
  oci_fetch($stid);
  $arr_tickDat[$i] = $tickDat;
  $i++;
}
oci_free_statement($stid);

$sql = 'SELECT COUNT(*) AS MAXM FROM (SELECT PERIOD FROM TICKET WHERE CINE_ID = :mycineid AND TDATE = :mydate GROUP BY HALL_ID, PERIOD)';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'MAXM', $maxm);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_bind_by_name($stid, ':mydate', $today);
oci_execute($stid);
oci_fetch($stid);
oci_free_statement($stid);

if($j > $maxm){
  $j = $maxm;
}

$sql = 'SELECT  TITLE, MOVIE_ID, PRICE, DISCOUNT, PERIOD, HALL_ID, COLUMN_NO*ROW_NO AS SEATS, COUNT(*) AS TNUM FROM (TICKET NATURAL JOIN MOVIE )NATURAL JOIN HALL WHERE CINE_ID = :mycineid AND TDATE = :mydate AND ISSOLD = 0 GROUP BY  TITLE, MOVIE_ID, HALL_ID, PRICE, DISCOUNT, PERIOD,COLUMN_NO, ROW_NO ORDER BY PERIOD, HALL_ID';
$stid = oci_parse($conn, $sql);

oci_define_by_name($stid, 'TITLE', $mname);
oci_define_by_name($stid, 'MOVIE_ID', $mid);
oci_define_by_name($stid, 'PRICE', $price);
oci_define_by_name($stid, 'DISCOUNT', $discount);
oci_define_by_name($stid, 'PERIOD', $period);
oci_define_by_name($stid, 'HALL_ID', $hallno);
oci_define_by_name($stid, 'SEATS', $seats);
oci_define_by_name($stid, 'TNUM', $tnum);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_bind_by_name($stid, ':mydate', $today);
oci_execute($stid);

$arr_mname = array();
$arr_mid = array();
$arr_price = array();
$arr_period = array();
$arr_hallno = array();
$arr_seats = array();
$arr_tnum = array();

$i = 0;

while(oci_fetch($stid) && $i < $j){ 
    $arr_mname[$i] = $mname;
    $arr_mid[$i] = $mid;
    $arr_price[$i] = $price*$discount;
    $arr_period[$i] = $period;
    $arr_hallno[$i] = $hallno;
    $arr_seats[$i] = $seats;
    $arr_tnum[$i] = $tnum;
    $i++;
}
oci_free_statement($stid);
oci_close($conn);

?>
<div id="container">
  
   
   <div id="header2">
      <h1><?php echo $_COOKIE["cineName"]; ?></h1>
   </div>

   <div id="header3">
        <br />
        <a href="Cinema_Information.php"> <?php #echo $_COOKIE["cineId"]; ?>Cinema Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> <?php #echo $_COOKIE["cineName"]; ?>Sign Out </a>
   </div>

   
   
   
   <div id="c1">
      <h2><a href="Cinema_Information.php">Edit our</h2>
      <h2><a href="Cinema_Information.php">Information</a></h2>
   </div>
   <div id="c2">
      <h2><a href="Financial_Management.php">Financial</a></h2>
      <h2><a href="Financial_Management.php">Management</a></h2>
      
   </div>




   <div id="Schedule">
        <form action='Cinema_Interface.php' method='get'><pre>   ROWNO</pre><input type='text' name='ROWNO'/><pre>   DATE</pre><?php
        echo" <select name='TICKDAT'>";
              $i = 0;
              while($i < $maxd){
                $temp_tickDat = $arr_tickDat[$i];
                echo "<option value='$temp_tickDat'>$temp_tickDat</option>";
                $i++;
              }
        echo "</select>";
        ?> <input type='submit' value='Submit' /></form>
       <pre> <h2>           Schedule</h2></pre>
       
       <div id="tabletab">
       <h2> </h2>
       </div>
   
   <div id="table">
        
        <pre>
        <table border="1">
        <tr>
          <td> No.    </td>
          <td> Period </td>
          <td> Movie          </td>
          <td> Seats       </td>
          <td> Price   </td>
          <td> Hall     </td>
          <td> Edit </td>
          
          
        </tr>
        <?php
          $i = 0;
          while($i < $j){
            $t_period = $arr_period[$i];
            $t_mid = $arr_mid[$i];
            $t_mname = $arr_mname[$i];
            $t_tnum = $arr_tnum[$i];
            $t_seats = $arr_seats[$i];
            $t_price = $arr_price[$i];
            $t_price = "$" . $t_price;
            $t_hallno = $arr_hallno[$i];
            $i++;
            echo "<tr>
                  <td>  $i</td>
                  <td>  $t_period</td>
                  <td>  <form name='sort1' action='Movie_Page.php' method='get'>  
                                    <input type='hidden' name='movieid' value='$t_mid' /> 
                                    <input type='submit' value='$t_mname' /></form></td>
                  <td>  $t_tnum/$t_seats</td>
                  <td>  $t_price</td>
                  <td>  $t_hallno</td>
                  <td><form action='Cinema_Seat_Selection.php' method='get'>
                  <input type='hidden' name='cinemaid' value='$cineid' />
                  <input type='hidden' name='period' value='$t_period' />
                  <input type='hidden' name='movieid' value='$t_mid' />
                  <input type='hidden' name='tdate' value='$today' />
                  <input type='hidden' name='moviename' value='$t_mname' />
                  <input type='hidden' name='newprice' value='$t_price' />
                  <input type='hidden' name='peer-id' value='$t_hallno' />
                  <input type='submit' value='Edit' /></form></td>
                  </tr>";
          }
        ?>
        </table>
        </pre>
   </div>
      
    
   </div>
   


<div id="footer">Copyright Daoyu GROUP22 COP5725 University of Florida</div>
</div>
</body>

</html>

