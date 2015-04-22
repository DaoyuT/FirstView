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
      <h1 id="h2">Movie Information</h1>
   </div>

   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
   
   <div id="Contents">
   
   <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>

<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

$stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,YEAR,RATED,LENGTH,ISONSHOW,DIRECTOR,WRITER,PRODCORP, INTRO FROM Movie WHERE MOVIE_ID = :d ');
$stid1 = oci_parse($conn, 'SELECT CATEGORY FROM MOVIE_CATEGORY WHERE MOVIE_ID = :d ');
$stid2 = oci_parse($conn, 'SELECT CASTNAME FROM MOVIE_CAST WHERE MOVIE_ID = :d ');


$temp=$_GET["movieid"];
oci_bind_by_name($stid, ':d', $temp);
oci_bind_by_name($stid1, ':d', $temp);
oci_bind_by_name($stid2, ':d', $temp);
oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'MOVIE_ID', $id);
oci_define_by_name($stid, 'YEAR',$year);
oci_define_by_name($stid, 'RATED',$rated);
oci_define_by_name($stid, 'LENGTH',$length);
oci_define_by_name($stid, 'ISONSHOW',$onshow);
oci_define_by_name($stid, 'DIRECTOR',$director);
oci_define_by_name($stid, 'WRITER',$writer);
oci_define_by_name($stid, 'PRODCORP',$prodcorp);
oci_define_by_name($stid1, 'CATEGORY',$CATEGORY);
oci_define_by_name($stid2, 'CASTNAME',$CASTNAME);
oci_define_by_name($stid, 'INTRO',$INTRO);
oci_execute($stid);
oci_execute($stid1);
oci_execute($stid2);
function search_string($str){
    $resstr = str_replace(" ", "+", $str);
    $resstr = $resstr . "+trailer";
    return $resstr;
}
while(oci_fetch($stid))
{   
       echo "<br>";
     $pic=$temp.'.jpg';
	$title1=search_string($title);
     echo "<a href='https://www.youtube.com/results?search_query=$title1'><img class='r' src ='/picture/$pic' width='300' height='450'></a> ";
     echo"<br>";
     echo"<br>";
     echo"Title:   $title" ;
     echo"<br>";
     echo"<br>";
     echo"Year:   $year" ;
     echo"<br>";
     echo"<br>";
    while(oci_fetch($stid1)){};
    echo"Category:   $CATEGORY" ;
     echo"<br>";
     echo"<br>";
     echo"Director:   $director" ;
     echo"<br>";
     echo"<br>";
    echo "Stars:";
    while(oci_fetch($stid2))
    {
    echo"  $CASTNAME  ," ;
    }
     echo"<br>";
     echo"<br>";
     echo"MPAA:   $rated" ;
     echo"<br>";
     echo"<br>";
      echo"Writer:   $writer" ;
     echo"<br>";
     echo"<br>";
      echo"Length:   $length min" ;
     echo"<br>";
     echo"<br>";
     if($onshow < "1")
       {
      echo"Current available in Cinema: No" ;
       }
     else
     {
     	 echo"Current available in Cinema: : Yes" ;
      }
     echo"<br>";
     echo"<br>";
      echo"Production Corp.:   $prodcorp" ;
     echo"<br>";
     echo"<br>";  
     echo"Introduction: $INTRO";
     echo"<br>";
     echo"<br>";
}
oci_close($conn);
?>
<br>

<iframe id="myIframe" width="50%" height="300px" src="Movie_Review.php" name="iframe_a">    </iframe>


<script>
var currentSrc = document.getElementById('myIframe').src;
document.getElementById('myIframe').src = currentSrc + "?movieid=<?php echo $temp; ?>";
</script>

<iframe id="myrate_cinema" width="50%" height="300px" src="My_movie_review.php" name="iframe_a">    </iframe>


<script>
var currentSrc = document.getElementById('myrate_cinema').src;
document.getElementById('myrate_cinema').src = currentSrc + "?movieid=<?php echo $temp; ?>";
</script>
<br>
<br>
<br>
<details>
  <summary>
<h3>Check the cinema offering this movie in the next three days:</h3>
</summary>
<?php

if($onshow!=1) {
	echo "(Sorry. This movie is offline)";
	echo "<br>";
	}
?>
<br>
Select a state:
<form id="state" method="post">
<select name = 'peer-id' style = 'position: relative' onchange="change()">
<option value="">
<option value="AL">AL</option>
<option value="CA">CA</option>
<option value="DC">DC</option><option value="FL">FL</option>
<option value="GA">GA</option><option value="KY">KY</option>
<option value="IL">IL</option><option value="ID">ID</option>
<option value="OH">OH</option><option value="OR">OR</option>
<option value="PA">PA</option><option value="MA">MA</option>
<option value="MD">MD</option><option value="MO">MO</option>
<option value="NY">NY</option><option value="NV">NV</option>
<option value="TX">TX</option><option value="UT">UT</option>
<option value="WA">WA</option>	
</select>
<br>
   

</form><script>
function change(){
    document.getElementById("state").submit();
}
</script>

<table border="1">
<tr>
  <td>  Cinema  </td>
  <td>  City  </td>
  <td>  Zip code  </td>
  <td>  Details  </td>
</tr>  


<?php 
$state= $_POST['peer-id'];

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }
$stid5 = oci_parse($conn, 'SELECT UNIQUE CINEMA_NAME,T.CINE_ID as CINEMAID,CITY,ZIP_CODE 
                     from ticket T,cinema C 
where  T.movie_id=:m and T.CINE_ID=C.CINE_ID and STATE=:s order by CITY');

oci_bind_by_name($stid5, ':s',$state );
oci_bind_by_name($stid5, ':m',$temp );
oci_define_by_name($stid5, 'CINEMA_NAME', $CINEMA_NAME);
oci_define_by_name($stid5, 'CINEMAID', $CINEMAID);

oci_define_by_name($stid5, 'CITY', $CITY);
oci_define_by_name($stid5, 'ZIP_CODE', $ZIP_CODE);
 
oci_execute($stid5);
while(oci_fetch($stid5))
{  
  echo "<tr>
  <td>$CINEMA_NAME</td>
  <td>$CITY </td>
  <td>$ZIP_CODE </td>
  <td><form name='sort' action='Cinema_Page.php' method='get'> 
     <input type='hidden' name='cinemaid' value='$CINEMAID' /> 
     <input type='submit' value='Proceed' /></form></td>
</tr>";
}
oci_close($conn);
?>
   
</table>
</details>
<br>

    <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
   </body>

</html>
