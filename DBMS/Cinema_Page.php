#!/usr/local/bin/php
<html>
  <head>
	
		<link rel="stylesheet" type="text/css" href="style.css" />
 
	  </head>

<body>
 <div id="container">
   <div id="header1">
      <a href="Customer_Interface.php"><h2 id="h1">HOME</h2></a>
   </div>
   
   <div id="header2">
      <h1 id="h2">CINEMA INFORMATION</h1>
   </div>

   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>

  <div id="Contents">

<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

 $stid = oci_parse($conn, 'SELECT CINE_ID,CINEMA_NAME, STATE, CITY, STREET, ZIP_CODE, DESCRIPTION FROM CINEMA WHERE CINE_ID = :d');
 $stid1 = oci_parse($conn, 'SELECT CONTACTS FROM CINEMA_CONTACT WHERE CINE_ID = :d');
 $stid2 = oci_parse($conn, 'SELECT TRANSPORT FROM CINEMA_TRANS WHERE CINE_ID = :d');


 
 
$temp=$_GET["cinemaid"];


$cinema_name=$cinemaname;
$pic=$temp.'.png';

echo "<img class='r' src ='/picture/$pic' width='450' height='400'> ";


oci_bind_by_name($stid, ':d',$temp );
oci_bind_by_name($stid1, ':d',$temp );
oci_bind_by_name($stid2, ':d',$temp );
oci_bind_by_name($stid3, ':d',$temp );
oci_define_by_name($stid, 'CINEMA_NAME',$cinemaname);
oci_define_by_name($stid, 'CINE_ID',$id);
oci_define_by_name($stid, 'STATE',$STATE);
oci_define_by_name($stid, 'CITY',$CITY);
oci_define_by_name($stid, 'STREET',$STREET);
oci_define_by_name($stid, 'ZIP_CODE',$ZIP);
oci_define_by_name($stid, 'DESCRIPTION',$DESCRIPTION);
oci_define_by_name($stid1, 'CONTACTS',$CONTACTS);
oci_define_by_name($stid2, 'TRANSPORT',$TRANSPORT);

oci_execute($stid);
oci_execute($stid1);
oci_execute($stid2);

while(oci_fetch($stid))
{   
       echo "<br>";
  echo " CINEMA NAME: $cinemaname ";
   echo "<br>";
      echo " STREET: $STREET ";
       echo "<br>"; 
		echo " CITY: $CITY ";
        echo "<br>";
		echo " STATE: $STATE ";
          echo "<br>";


         echo " ZIPCODE: $ZIP";
          echo "<br>";
           
           
           echo "<a href='$DESCRIPTION' target='_blank'>Map</a>";
           echo "<br>";
           }
           
while(oci_fetch($stid1)){
echo " CONTACTS: $CONTACTS ";
 echo "<br>";
}

while(oci_fetch($stid2)){
echo " TRANSPORT: $TRANSPORT ";
 echo "<br>";
}




 oci_close($conn);


?>

<br>

<iframe id="myIframe" width="50%" height="300px" src="Cinema_Review.php" name="iframe_a">    </iframe>


<script>
var currentSrc = document.getElementById('myIframe').src;
document.getElementById('myIframe').src = currentSrc + "?cinemaid=<?php echo $temp; ?>";
</script>



<iframe id="myrate_cinema" width="50%" height="300px" src="My_cinema_review.php" name="iframe_a">    </iframe>


<script>
var currentSrc = document.getElementById('myrate_cinema').src;
document.getElementById('myrate_cinema').src = currentSrc + "?cinemaid=<?php echo $temp; ?>";
</script>


 
      <h2 id="h2">CINEMA SCHEDULE</h2>
 

<form id="mydate" method="post">
<select name = 'peer-id' style = 'position: relative' onchange="change()">
    <option value="21-APR-15">Select a Date</option>
    <option value="21-APR-15">Apr. 21st</option>
    <option value="22-APR-15">Apr. 22nd</option>
    <option value="23-APR-15">Apr. 23nd</option>
</select>
</form>

<script>
function change(){
    document.getElementById("mydate").submit();
}
</script>



<table border="1">
<tr>
  <td>  Time Period  </td>
  <td>  Movie  </td>
  <td>  Year  </td>
  <td>  Price  </td>
  <td>  Discount  </td>
  <td>  Buy  </td>
</tr>


<?php

echo "<br>";

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

 $stid4 = oci_parse($conn, 'SELECT UNIQUE DISCOUNT,PERIOD,M.title as TIT,T.movie_id as MID,M.year as MY,price
							FROM ticket T,movie M
                            WHERE cine_id =:a AND tdate= :dateid AND T.movie_id=M.movie_id ORDER BY period ASC');

$date_id= $_POST['peer-id'];

							
oci_bind_by_name($stid4, ':a',$_GET["cinemaid"]);
oci_bind_by_name($stid4, ':dateid',$date_id);

oci_define_by_name($stid4, 'PERIOD',$period);
oci_define_by_name($stid4, 'TIT',$title);
oci_define_by_name($stid4, 'MY',$year);
oci_define_by_name($stid4, 'PRICE',$price);
oci_define_by_name($stid4, 'DISCOUNT',$dis);
oci_define_by_name($stid4, 'MID',$movie_id);


oci_execute($stid4);
$timearrow=array("Null","8:30~11:30","12:30~15:30","16:30~19:30","20:30~23:30");
echo $date_id;

echo " is chosen.";
echo "<br>";
echo "<br>";

$cineid=$_GET["cinemaid"];
while(oci_fetch($stid4))
{   

$newprice=$price*$dis;
$dis=$dis*100;

  
  echo "<tr>
  <td>$timearrow[$period]</td>
  <td><form name='sort1' action='Movie_Page.php' method='get'>  
     <input type='hidden' name='movieid' value='$movie_id' /> 
     <input type='submit' value='$title'></form></td>
  <td>$year </td>
  <td>$$price </td>
  <td>$dis% </td>
  <td><form name='sort' action='Seat_Selection.php' method='get'> 
     <input type='hidden' name='cinemaid' value='$cineid' /> 
     <input type='hidden' name='period' value='$period' /> 
     <input type='hidden' name='movieid' value='$movie_id' /> 
     <input type='hidden' name='tdate' value='$date_id' /> 
     <input type='hidden' name='moviename' value='$title' /> 
     <input type='hidden' name='newprice' value='$newprice' /> 
     <input type='submit' value='Seat' /></form></td>
</tr>";
           }

 oci_close($conn);

?>

</table>

</div>


<div id="footer">Copyright GROUP22 COP5725 University of Florida</div>
   </div>
</body>

</html>