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
      <h1 id="h2">Select A Payment Method</h1>
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


<table>

<?php


$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

 $stid = oci_parse($conn, 'SELECT CARD_NO,CARD_CATEGORY,NAME_ON_CARD,SECURITY_CODE,EXP_DATE,sysdate FROM PURCHASE_METHODS
                          WHERE (CUST_ID= :d) AND sysdate<EXP_DATE');
					 
$columnid=$_GET["columnid"];
$rowid=$_GET["rowid"];
$cinemaid=$_GET["cinemaid"];
$cinemaname=$_GET["cinemaname"];
$period=$_GET["period"];
$movieid=$_GET["movieid"];
$tdate=$_GET["tdate"];
$moviename= $_GET["moviename"];
$hallid= $_GET["hallid"];
$newprice= $_GET["newprice"];
$temp= $_GET["userid"];

$ticketid= $_GET["ticketid"];

oci_bind_by_name($stid, ':d',$temp );
oci_define_by_name($stid, 'CARD_NO',$CARD_NO);
oci_define_by_name($stid, 'CARD_CATEGORY',$CARD_CATEGORY);
oci_define_by_name($stid, 'NAME_ON_CARD',$NAME_ON_CARD);
oci_define_by_name($stid, 'SECURITY_CODE',$SECURITY_CODE);
oci_define_by_name($stid, 'EXP_DATE',$EXP_DATE);
oci_define_by_name($stid, 'sysdate',$sysdate);
oci_execute($stid);


$alpharow=array("Null","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA");
$timearrow=array("Null","8:30~11:30","12:30~15:30","16:30~19:30","20:30~23:30");
echo "CINEMA: ";
echo $cinemaname;
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
echo "Hall No.: ";
echo $hallid;
echo "<br>";
echo "SEAT: ";
echo $alpharow[$rowid];
echo $columnid;
echo "<br>";
echo "Price: ";
echo "$";
echo $newprice;
echo "<br>";
echo "<br>";
?>
<table border="1">
<tr>
  <td>  Your credit and debit cards  </td>
  <td>  Name on card  </td>
  <td>  Expires on  </td>
  <td>  Proceed  </td>
</tr>

<?php
while(oci_fetch($stid))
{  
$last4 = substr($CARD_NO, -4);

  echo "<tr>
  <td>$CARD_CATEGORY (ending in $last4)</td>
  <td>$NAME_ON_CARD</td>	  
  <td>$EXP_DATE</td>
  <td><form name='sort' action='Purchase_check.php' method='get'> 
        <input type='hidden' name='columnid' value='$columnid' /> 
        <input type='hidden' name='rowid' value='$rowid' /> 
        <input type='hidden' name='cinemaid' value='$cinemaid' /> 
        <input type='hidden' name='cinemaname' value='$cinemaname' /> 
        <input type='hidden' name='period' value='$period' /> 
        <input type='hidden' name='movieid' value='$movieid' /> 
        <input type='hidden' name='tdate' value='$tdate' /> 
        <input type='hidden' name='moviename' value='$moviename' /> 
        <input type='hidden' name='hallid' value='$hallid' /> 	
        <input type='hidden' name='userid' value='$userid' /> 	
        <input type='hidden' name='newprice' value='$newprice' /> 	
        <input type='hidden' name='CARD_NO' value='$CARD_NO' /> 
        <input type='hidden' name='CARD_CATEGORY' value='$CARD_CATEGORY' /> 
        <input type='hidden' name='NAME_ON_CARD' value='$NAME_ON_CARD' /> 
        <input type='hidden' name='EXP_DATE' value='$EXP_DATE' /> 
        <input type='hidden' name='ticketid' value='$ticketid' /> 				
     <input type='submit' value='Continue' /></form></td>
</tr>";
echo "<br>";
echo "<br>";
}

$selectOption = $_POST['taskOption'];
echo 	$selectOption ;	   

 oci_close($conn);

?>
</table>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>

<style> 
#panel, #flip {
    padding: 5px;
    text-align: left;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 5px;
    display: none;
}
</style>
</head>
<body>
 
<div id="flip">Add a card</div>
<div id="panel">
<form name="constrains" action="New_purchase_method.php" method="post">

Card Type:     
<select name = 'ctype' >
  <option value="Visa">Visa</option>
  <option value="Master">Master</option>
  <option value="Amex">Amex</option>
  <option value="Discover">Discover</option>
  <option value="Paypal">Paypal</option>
</select>
<br>
Card No.:<input type="text" name="no" maxlength="12" minlength="12">    
<br>                 
Name on card:  <input type="text" name="name"  size="10"> 
<br>
Security code:<input type="text" name="code" maxlength="4" minlength="3" size="4"> 
<br>
Exp_Date
<input type="date" name="date"  min="2015-04-21"> 
<br> 

	
<input type="submit" value="Confirm" > 
</form> 
  
</div>
<p><mark>NOTE: You NEED to refresh your page to see the new added card.</mark></p>
</div>
<div id="footer">Copyright GROUP22 COP5725 University of Florida</div>
   </div>
</body>

</html>