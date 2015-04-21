#!/usr/local/bin/php
<html>
  <head>
	
		<link rel="stylesheet" type="text/css" href="style.css" />
 
	  </head>

<body>
 <div id="container">
   <div id="header1">
      <a href="Cinema_Interface.php"><h2 id="h1">HOME</h2></a>
   </div>
   
   <div id="header2">
      <h1 id="h2">SEAT SELECTION</h1>
   </div>

   <div id="header3">
        <a href="Cinema_Information.php"> Cinema Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
<div id="Contents">
 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>



<form id="myform" method="post">
<select name = 'peer-id' style = 'position: relative' onchange="change()">
    <option value="0">Select a Hall</option>
    <option value="1">Hall No.1</option>
    <option value="2">Hall No.2</option>
    <option value="3">Hall No.3</option>
</select>
</form>

<script>
function change(){
    document.getElementById("myform").submit();
}
</script>


<table>

<?php

//echo $_GET["keyword"];


//echo $Hall_ID;
$userid=$_COOKIE["cineId"];
//echo $userid;



$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

$stid1 = oci_parse($conn, 'SELECT TICKET_ID,MOVIE_ID,CINE_ID,HALL_ID,PRICE,DISCOUNT,PERIOD,TDATE,COLUMN_ID,ROW_ID,ISSOLD 
                          FROM TICKET WHERE (CINE_ID = :cid) AND (MOVIE_ID=:mid) AND (HALL_ID=:hid) AND (PERIOD=:pid) AND (TDATE=:tid)
						              order by row_id ASC, column_id ASC');
$stid2 = oci_parse($conn, 'SELECT Hall_ID,COLUMN_NO,ROW_NO 
                          FROM Hall H WHERE (CINE_ID = :cid) AND (Hall_ID=:hid)');
$stid3 = oci_parse($conn, 'SELECT COUNT(*) AS SUM1 FROM TICKET where (CINE_ID = :cid) AND (MOVIE_ID=:mid) AND (HALL_ID=:hid) AND (ISSOLD=1)
                          AND (PERIOD=:pid) AND (TDATE=:tid)');
$stid4 = oci_parse($conn, 'SELECT CINEMA_NAME from CINEMA where (CINE_ID =:cid)');
						 

$cinemaid=$_GET["cinemaid"];
$period=$_GET["period"];
$movieid=$_GET["movieid"];
$tdate=$_GET["tdate"];
$moviename= $_GET["moviename"];
$newprice= $_GET["newprice"];
$hallid= $_POST['peer-id'];




oci_bind_by_name($stid1, ':cid',$cinemaid );
oci_bind_by_name($stid1, ':mid',$movieid );
oci_bind_by_name($stid1, ':hid',$hallid );
oci_bind_by_name($stid1, ':tid',$tdate );
oci_bind_by_name($stid1, ':pid',$period );

oci_bind_by_name($stid2, ':cid',$cinemaid );
oci_bind_by_name($stid2, ':hid',$hallid );


oci_bind_by_name($stid3, ':cid',$cinemaid );
oci_bind_by_name($stid3, ':mid',$movieid );
oci_bind_by_name($stid3, ':hid',$hallid );
oci_bind_by_name($stid3, ':tid',$tdate );
oci_bind_by_name($stid3, ':pid',$period );

oci_bind_by_name($stid4, ':cid',$cinemaid );

oci_define_by_name($stid1, 'PERIOD_ID',$period);
oci_define_by_name($stid1, 'TICKET_ID',$ticketid);
oci_define_by_name($stid1, 'MOVIE_ID',$movid);
oci_define_by_name($stid1, 'CINE_ID',$cineid);
oci_define_by_name($stid1, 'HALL_ID',$hallid);
oci_define_by_name($stid1, 'PRICE',$price);
oci_define_by_name($stid1, 'DISCOUNT',$discount);
oci_define_by_name($stid1, 'TDATE',$date);
oci_define_by_name($stid1, 'COLUMN_ID',$columnid);
oci_define_by_name($stid1, 'ROW_ID',$rowid);
oci_define_by_name($stid1, 'ISSOLD',$ifsold);

oci_define_by_name($stid2, 'COLUMN_NO',$columnno);
oci_define_by_name($stid2, 'ROW_NO',$rowno);

oci_define_by_name($stid3, 'SUM1',$sumsold);

oci_define_by_name($stid4, 'CINEMA_NAME',$cname);

oci_execute($stid1);
oci_execute($stid2);
oci_execute($stid3);
oci_execute($stid4);

$alpharow=array("Null","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA");
  while(oci_fetch($stid3))	
{  
}
  while(oci_fetch($stid2))	
{  
}
  while(oci_fetch($stid4))	
{  
}
$timearrow=array("Null","8:30~11:30","12:30~15:30","16:30~19:30","20:30~23:30");
echo "CINEMA: ";
echo $cname;
echo "<br>";
echo "MOVIE: ";
echo $moviename;
echo "<br>";
echo "DATE: ";
echo $tdate;
echo "<br>";
echo "PERIOD: ";
echo $timearrow[$period];
echo "<br>";
echo "Price: ";
echo $newprice;
echo "<br>";
echo "<br>";

echo "Seat Configuration of Hall No.",$hallid;  
echo "   (",$rowno*$columnno-$sumsold,"/",$rowno*$columnno,")";


/*  echo "<br>";
  echo " COLUMN_NO: $columnno ";
   echo "<br>";
      echo " ROW_NO: $rowno ";
       echo "<br>";*/
	   
	while(oci_fetch($stid1))
		
   {  
/*echo "<br>";
echo "columnid";
echo $columnid;
echo "<br>";
echo "columnno";
echo $columnno;
echo "<br>";
/*   echo "$ticketid ";  
    echo "$ifsold ";
	  echo "$rowid ";  
    echo "$columnid ";        echo " ROW_NO: $rowno "; echo " COLUMN_NO: $columnno ";*/
     if($ifsold==0){      		
    echo "

    <td><form name='sort' action='Cinema_Place_order.php' method='get'> 
        <input type='hidden' name='columnid' value='$columnid' /> 
        <input type='hidden' name='rowid' value='$rowid' /> 
        <input type='hidden' name='cinemaid' value='$cineid' /> 
        <input type='hidden' name='cinemaname' value='$cname' /> 
        <input type='hidden' name='period' value='$period' /> 
        <input type='hidden' name='movieid' value='$movieid' /> 
        <input type='hidden' name='tdate' value='$tdate' /> 
        <input type='hidden' name='moviename' value='$moviename' /> 
        <input type='hidden' name='hallid' value='$hallid' /> 	
        <input type='hidden' name='userid' value='$userid' /> 	
        <input type='hidden' name='newprice' value='$newprice' /> 	
        <input type='hidden' name='ticketid' value='$ticketid' /> 			
        <input type='submit' value=$alpharow[$rowid]$columnid></form></td>
	
     ";     
	 }
	else{
    echo "
    <td><form name='sort' method='get'> 
        <input type='hidden' name='columnid' value='$columnid' /> 
        <input type='hidden' name='rowid' value='$rowid' /> 
        <input type='hidden' name='cinemaid' value='$cineid' /> 
        <input type='hidden' name='cinemaname' value='$cname' /> 
        <input type='hidden' name='period' value='$period' /> 
        <input type='hidden' name='movieid' value='$movieid' /> 
        <input type='hidden' name='tdate' value='$tdate' /> 
        <input type='hidden' name='moviename' value='$moviename' /> 
        <input type='hidden' name='hallid' value='$hallid' /> 	
        <input type='hidden' name='userid' value='$userid' /> 	
        <input type='hidden' name='newprice' value='$newprice' /> 			
        <input type='submit' value=$alpharow[$rowid]$columnid disabled></form></td>	
     ";
		 
	 }
      if($columnid==$columnno) {echo "<tr>  </tr>";}
	}




$selectOption = $_POST['taskOption'];
echo 	$selectOption ;	   
		   


 oci_close($conn);

?>

</table>


</div>

<div id="footer">Copyright Wenchao GROUP22 COP5725 University of Florida</div>
   </div>
</body>

</html>