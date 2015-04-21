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
      <h1 id="h2">COST ON LATEST 12 MONTHES</h1>
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

//$temp=$_COOKIE["customername"];
 
$sql5="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/MAY/2014' And TDATE<'30/MAY/2014' AND CUST_ID=:d5)";
$stid5 = oci_parse($conn,$sql5 );

oci_bind_by_name($stid5, ':d5', $_COOKIE["customername"]);
oci_define_by_name($stid5, 'SUM(PRICE)', $sum5);
oci_execute($stid5);
echo "<h5>YOUR COST IN LASTEST 12 MONTHES IS SHOWN AS FOLLOWS:</h5>";
echo "<br><img class='r' src='t8.gif' width='20%'/>";
while(oci_fetch($stid5))
{     echo"May:$";

     $name=$name.'May'.'|';
     if($sum5=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum5.'|';    
     }
    
     echo "$sum5";
     echo "<br>";echo "<br>";
}


$sql6="SELECT SUM(PRICE*DISCOUNT) FROM TICKET WHERE (TDATE>'01/JUN/2014' And TDATE<'30/JUN/2014' AND CUST_ID=:d6)";
$stid6 = oci_parse($conn,$sql6 );

oci_bind_by_name($stid6, ':d6',$_COOKIE["customername"]);
oci_define_by_name($stid6, 'SUM(PRICE)', $sum6);
oci_execute($stid6);
while(oci_fetch($stid6))
{    echo "June:$";
     $name=$name.'June'.'|';
     if($sum6=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum6.'|';    
     }
     
     echo "$sum6";
     echo "<br>";echo "<br>";
}

$sql7="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/JULY/2014' And TDATE<'31/JULY/2014' AND CUST_ID=:d7)";
$stid7 = oci_parse($conn,$sql7 );

oci_bind_by_name($stid7, ':d7',$_COOKIE["customername"]);
oci_define_by_name($stid7, 'SUM(PRICE)', $sum7);
oci_execute($stid7);
while(oci_fetch($stid7))
{    echo "July:$";
      $name=$name.'July'.'|';
     if($sum7=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum7.'|';    
     }
    
     echo "$sum7";
     echo "<br>";echo "<br>";
}

$sql8="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/AUG/2014' And TDATE<'31/AUG/2014' AND CUST_ID=:d8)";
$stid8 = oci_parse($conn,$sql8 );

oci_bind_by_name($stid8, ':d8',$_COOKIE["customername"]);
oci_define_by_name($stid8, 'SUM(PRICE)', $sum8);
oci_execute($stid8);
while(oci_fetch($stid8))
{    echo "August:$";
      $name=$name.'August'.'|';
     if($sum8=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum8.'|';    
     }
     
     echo "$sum8";
     echo "<br>";echo "<br>";
}

$sql9="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/SEP/2014' And TDATE<'30/SEP/2014' AND CUST_ID=:d9)";
$stid9 = oci_parse($conn,$sql9 );

oci_bind_by_name($stid9, ':d9',$_COOKIE["customername"]);
oci_define_by_name($stid9, 'SUM(PRICE)', $sum9);
oci_execute($stid9);
while(oci_fetch($stid9))
{   
 echo "September:$";
     $name=$name.'September'.'|';
     if($sum9=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum9.'|';    
     }


    
   
    
     
     echo "<br>";echo "<br>";
}

$sql10="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/OCT/2014' And TDATE<'31/OCT/2014' AND CUST_ID=:d10)";
$stid10 = oci_parse($conn,$sql10 );

oci_bind_by_name($stid10, ':d10',$_COOKIE["customername"]);
oci_define_by_name($stid10, 'SUM(PRICE)', $sum10);
oci_execute($stid10);
while(oci_fetch($stid10))
{    echo "October:$";
      $name=$name.'October'.'|';
     if($sum10=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum10.'|';    
     }
     
     echo "$sum10";
     echo "<br>";echo "<br>";
}

$sql11="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/NOV/2014' And TDATE<'30/NOV/2014' AND CUST_ID=:d11)";
$stid11 = oci_parse($conn,$sql11 );

oci_bind_by_name($stid11, ':d11',$_COOKIE["customername"]);
oci_define_by_name($stid11, 'SUM(PRICE)', $sum11);
oci_execute($stid11);
while(oci_fetch($stid11))
{    echo "November:$";
      $name=$name.'November'.'|';
     if($sum11=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum11.'|';    
     }
     
     echo "$sum11";
     echo "<br>";echo "<br>";
}

$sql12="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/DEC/2014' And TDATE<'31/DEC/2014' AND CUST_ID=:d12)";
$stid12 = oci_parse($conn,$sql12 );

oci_bind_by_name($stid12, ':d12',$_COOKIE["customername"]);
oci_define_by_name($stid12, 'SUM(PRICE)', $sum12);
oci_execute($stid12);
while(oci_fetch($stid12))
{    echo "December:$";
      $name=$name.'December'.'|';
     if($sum12=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum12.'|';    
     }

     
     echo "$sum12";
     echo "<br>";echo "<br>";
}

$sql1="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/JAN/2015' And TDATE<'31/JAN/2015' AND CUST_ID=:d1)";
$stid1 = oci_parse($conn,$sql1 );

oci_bind_by_name($stid1, ':d1',$_COOKIE["customername"]);
oci_define_by_name($stid1, 'SUM(PRICE)', $sum1);
oci_execute($stid1);
while(oci_fetch($stid1))
{     echo "JAN:$";
      $name=$name.'Jan'.'|';
     if($sum1=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum1.'|';    
     }
    
     echo "$sum1";
     echo "<br>";echo "<br>";
}

$sql2="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/FEB/2015' And TDATE<'28/FEB/2015' AND CUST_ID=:d2)";
$stid2 = oci_parse($conn,$sql2 );

oci_bind_by_name($stid2, ':d2',$_COOKIE["customername"]);
oci_define_by_name($stid2, 'SUM(PRICE)', $sum2);
oci_execute($stid2);
while(oci_fetch($stid2))
{    echo "FEB:$";
    $name=$name.'Feb'.'|';
     if($sum2=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum2.'|';    
     }
     
     echo "$sum2";
     echo "<br>";echo "<br>";
}

$sql3="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/MARCH/2015' And TDATE<'31/MARCH/2015' AND CUST_ID=:d3)";
$stid3 = oci_parse($conn,$sql3 );

oci_bind_by_name($stid3, ':d3',$_COOKIE["customername"]);
oci_define_by_name($stid3, 'SUM(PRICE)', $sum3);
oci_execute($stid3);
while(oci_fetch($stid3))
{    echo "March:$";
      $name=$name.'March'.'|';
     if($sum3=="")
      {
        $data=$data.'0'.'|';echo"0";
      }
     else
     {
         $data=$data.$sum3.'|';    
     }
     
     echo "$sum3";
     echo "<br>";echo "<br>";
}

$sql4="SELECT SUM(PRICE) FROM TICKET WHERE (TDATE>'01/APR/2015' And TDATE<'30/APR/2015' AND CUST_ID=:d4)";
$stid4 = oci_parse($conn,$sql4 );

oci_bind_by_name($stid4, ':d4',$_COOKIE["customername"]);
oci_define_by_name($stid4, 'SUM(PRICE)', $sum4);
oci_execute($stid4);
while(oci_fetch($stid4))
{   echo "APR:$";
    $name=$name.'April';
     if($sum4=="")
      {
        $data=$data.'0';
echo"0";
      }
     else
     {
         $data=$data.$sum4;    
     } 
     echo "$sum4";
     echo "<br>";
echo "<br>";
}




//echo $name;
echo "<br>";
//echo $data;

echo "<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>     
<input type='hidden' name='name' value='$name' /> 
<input type='hidden' name='data' value='$data' /> <br>
<input type='submit' value='CLICK HERE TO SEE YOUR GRAPH' style='background-color: rgb(255,165,0);Font-size: 9pt;'/>
</form>";

oci_close($conn);
?>

    <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
   </body>

</html>
