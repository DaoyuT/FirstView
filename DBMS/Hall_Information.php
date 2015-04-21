#!/usr/local/bin/php



<html>
<head>
<style type="text/css">
div#container{width:1250px;}

div#header1{text-align:center;background-color:#FFFFCC;width:415px;height:57px;float:left}
div#header2{text-align:center;background-color:#FFFFCC;width:420px;height:57px;float:left}
div#header3{text-align:right;background-color:#FFFFCC;width:415px;height:57px;float:left}


div#info{text-align:left;background-color:#FFCC66;width:1250px;float:left}

</style>
</head>

<body>
<?php
$cineid = $_COOKIE["cineId"];
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
     echo "connection error!";
}

$sql = 'SELECT COUNT(*) AS HNUM FROM HALL WHERE CINE_ID = :mycineid GROUP BY CINE_ID';
$stid = oci_parse($conn, $sql);
oci_define_by_name($stid, 'HNUM', $hnum);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
oci_fetch($stid);

oci_free_statement($stid);

$sql = 'SELECT HALL_ID, COLUMN_NO, ROW_NO FROM HALL WHERE CINE_ID = :mycineid ORDER BY CINE_ID DESC';
$stid = oci_parse($conn, $sql);
oci_define_by_name($stid, 'HALL_ID', $hid);
oci_define_by_name($stid, 'COLUMN_NO', $cno);
oci_define_by_name($stid, 'ROW_NO', $rno);
oci_bind_by_name($stid, ':mycineid', $cineid);
oci_execute($stid);
$arr_hid = array();
$arr_cno = array();
$arr_rno = array();
$i = 0;
while(oci_fetch($stid) && $i < $hnum){

    $arr_hid[$i] = $hid;
    $arr_cno[$i] = $cno;
    $arr_rno[$i] = $rno;
    $i++;
}

oci_free_statement($stid);
oci_close($conn);

?>

<div id="container">
   <div id="header1">
      <a href="Cinema_Interface.php"><h1>Home</h1></a>
   </div>
   
   <div id="header2">
      <h1>Hall Information</h1>
   </div>

   <div id="header3">
        <a href="Cinema_Information.php"> Cinema Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   
   
   <pre> 
   <div id="info">
    <?php
    $i = 0; 
    while($i < $hnum){
        $temp_hid = $arr_hid[$i];
        $temp_cno = $arr_cno[$i];
        $temp_rno = $arr_rno[$i];
        echo "  <form action='Hall_Delete.php' method='get'><li>   Hall No.:     $temp_hid    <input type='hidden' name='deleteid' value='$temp_hid' /><input type='submit' value='Delete' />  </li><li>   Column No.:   $temp_cno     </li><li>   Row No.:      $temp_rno    </li></form>";
        $i++;
    }
    
    ?>
    <form name="hallInit" action="Hall_Information_Add.php" method="post">
        <input type="submit" value="Add Hall">
    </form>
   </div>    
                  



   </pre>
   
   </div>
   
   

  
</body>

</html>


