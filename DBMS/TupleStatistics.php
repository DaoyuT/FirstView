#!/usr/local/bin/php
<html>
	  <head>
	
		<link rel="stylesheet" type="text/css" href="style.css" />
 
	  </head>
	  <body>
	
    
    
   
 
   <pre> 
   <div id="pwdchange">
   <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>
<?php

$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
	 echo "<br>";
 }

$stid1 = oci_parse($conn, 'SELECT COUNT(*)  FROM movie');
oci_define_by_name($stid1, 'COUNT(*)',$numberofmovies);
oci_execute($stid1);
while(oci_fetch($stid1))
{ echo "  The number of movies is: $numberofmovies   ";  

       echo "<br>";
           }
           
$stid = oci_parse($conn, 'SELECT COUNT(*)  FROM users');
oci_define_by_name($stid, 'COUNT(*)',$numberofusers);
oci_execute($stid);
while(oci_fetch($stid))
{ echo "  The number of users is: $numberofusers   ";  

       echo "<br>";
           }
           

$stid2 = oci_parse($conn, 'SELECT COUNT(*)  FROM cinema');
oci_define_by_name($stid2, 'COUNT(*)',$numberofcinema);
oci_execute($stid2);
while(oci_fetch($stid2))
{ echo "  The number of cinemas is: $numberofcinema   ";  

       echo "<br>";
           }        
           
$stid3 = oci_parse($conn, 'SELECT COUNT(*)  FROM ticket');
oci_define_by_name($stid3, 'COUNT(*)',$numberoftickets);
oci_execute($stid3);
while(oci_fetch($stid3))
{ echo "  The number of tickets is: $numberoftickets   ";  

       echo "<br>";
           }
           
$stid4 = oci_parse($conn, 'SELECT COUNT(*)  FROM movie_cast');
oci_define_by_name($stid4, 'COUNT(*)',$numberofcasts);
oci_execute($stid4);
while(oci_fetch($stid4))
{ echo "  The number of actors is: $numberofcasts   ";  

       echo "<br>";
           }         
   
$stid5 = oci_parse($conn, 'SELECT COUNT(*)  FROM HALL');
oci_define_by_name($stid5, 'COUNT(*)',$HALL);
oci_execute($stid5);
while(oci_fetch($stid5)){}
$stid6 = oci_parse($conn, 'SELECT COUNT(*)  FROM CINEMA_REVIEW');
oci_define_by_name($stid6, 'COUNT(*)',$CINEMA_REVIEW);
oci_execute($stid6);
while(oci_fetch($stid6)){}
$stid7 = oci_parse($conn, 'SELECT COUNT(*)  FROM CUSTOMER_PHONE');
oci_define_by_name($stid7, 'COUNT(*)',$CUSTOMER_PHONE);
oci_execute($stid7);
while(oci_fetch($stid7)){}
$stid8 = oci_parse($conn, 'SELECT COUNT(*)  FROM movie_category');
oci_define_by_name($stid8, 'COUNT(*)',$movie_category);
oci_execute($stid8);
while(oci_fetch($stid8)){}
$stid9 = oci_parse($conn, 'SELECT COUNT(*)  FROM movie_review');
oci_define_by_name($stid9, 'COUNT(*)',$movie_review);
oci_execute($stid9);
while(oci_fetch($stid9)){}
$stid10 = oci_parse($conn, 'SELECT COUNT(*)  FROM purchase_methods');
oci_define_by_name($stid10, 'COUNT(*)',$purchase_methods);
oci_execute($stid10);
while(oci_fetch($stid10)){
	}
$sum=$numberofmovies+$numberofusers+$numberofcinema+$numberoftickets+$numberofcasts
+$HALL	+$CINEMA_REVIEW	+$CUSTOMER_PHONE	+$movie_category	+$movie_review	+$purchase_methods;
echo "  The number of all tuples is: $sum	";  

       echo "<br>";  

 oci_close($conn);

?>
   
   </div>    
   </pre>
   <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
	  </body>
	</html>
