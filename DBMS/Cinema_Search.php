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
      <h1 id="h2">CINEMA SEARCH</h1>
   </div>

   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
   </div>
   
    <div id="Search">
       
      
       <pre>
                                              
      
          <form name="input" action="Cinema_Search.php"              method="get">
                                                             <b>Cinema Keyword:</b><input size="35" height="50" type="text" name="keyword" /><input type="submit" value="Search" />
         
          </form>
       
        </pre>
   </div>
 
   

   
  
   
   
   <div id="searchresult">
      <h2>Cinema Search Result</h2>
      
       <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>



<?php
//echo $_GET["keyword"];

$keyword1124=$_GET["keyword"];
$state1125=$_GET["state"];
$city1151=$_GET["city"];
echo "You have chosen:   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'> Cinema keyword:$keyword1124</button> ";

if($_GET["state"] && $_GET["state"]!="9999" )
{
   echo "   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'>State:$state1125</button>";
	
}
if($_GET["city"] && $_GET["city"]!="9999" )
{
   echo "   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'>City:$city1151</button>";
	
}


$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }
if($_GET["keyword"])
{
$stid = oci_parse($conn, 'SELECT STATE,CITY,CINE_ID,CINEMA_NAME FROM CINEMA WHERE (upper(CINEMA_NAME) LIKE :d) ');
}
else
{
	$stid = oci_parse($conn,'SELECT FROM CINEMA');
}
$temp0=strtoupper($_GET["keyword"]);
$temp='%'.$temp0.'%';

oci_bind_by_name($stid, ':d',$temp );

oci_define_by_name($stid, 'CINEMA_NAME', $title);
oci_define_by_name($stid, 'CINE_ID', $id);
oci_define_by_name($stid, 'STATE', $state);
oci_define_by_name($stid, 'CITY', $city);
oci_execute($stid);

$count=1;
while(oci_fetch($stid))
{   
    
     if(!$_GET["state"] || $_GET["state"]=="9999")
     {
     echo" <form name='sort' action='Cinema_Page.php' method='get'> 
     $count CINEMA_NAME:$title CITY: $city State:$state
     <input type='hidden' name='cinemaname' value='$title' /> 
     <input type='hidden' name='cinemaid' value='$id' /> 
     <input type='submit' value='Details' /></form>";
     $count=$count+1;
     }
     else if($state==$_GET["state"])
     {
     	if(!$_GET["city"] || $_GET["city"]=="9999")
     {echo" <form name='sort' action='Cinema_Page.php' method='get'> 
     $count CINEMA_NAME:$title CITY: $city State:$state
     <input type='hidden' name='cinemaname' value='$title' /> 
     <input type='hidden' name='cinemaid' value='$id' /> 
     <input type='submit' value='Details' /></form>";
     $count=$count+1;
     }
      else if($city==$_GET["city"])
      {
       echo" <form name='sort' action='Cinema_Page.php' method='get'> 
     $count CINEMA_NAME:$title CITY: $city State:$state
     <input type='hidden' name='cinemaname' value='$title' /> 
     <input type='hidden' name='cinemaid' value='$id' /> 
     <input type='submit' value='Details' /></form>";
     $count=$count+1;
      }
      
     }
  
}

oci_close($conn);


?>
      </div>

<div id="Constrains">
   

 <h2> Constrains</h2>
 State:
<form id="state1" method="get">
<select name = 'state' style = 'position: relative' onchange="change()">
    <option value="">Select</option>
    <option value="9999">All</option>
    <option value="AL">AL</option>
    <option value="AZ">AZ</option>
    <option value="CA">CA</option>
    <option value="DC">DC</option>
    <option value="FL">FL</option>
    <option value="GA">GA</option>
    <option value="ID">ID</option>
    <option value="IL">IL</option>
    <option value="KY">KY</option>
    <option value="MD">MD</option>
    <option value="MO">MO</option>
    <option value="NV">NV</option>
    <option value="NY">NY</option>
    <option value="OH">OH</option>
    <option value="OR">OR</option>
    <option value="PA">PA</option>
    <option value="TX">TX</option>
    <option value="UT">UT</option>
    <option value="WA">WA</option>
    
</select>
<?php
    $tempkeyword=$_GET["keyword"];
 
    echo"
   <input type='hidden' name='keyword' value='$tempkeyword' />";
 
 
?>
</form>
<script>
function change(){
    document.getElementById("state1").submit();
}
</script>

<?php 

if($_GET["state"] &&  $_GET["state"] !="9999")
{
	
	echo"
 City:
<form id='city1' method='get'>
<select name = 'city' style = 'position: relative' onchange='change2()'>
     <option value=''>Select</option>    
    <option value='9999'>All</option>
   ";
   switch ($_GET["state"]) {
    case "AL":
     echo "<option value='Huntsville'>Huntsville</option>
    ";
        break;
    case "AZ":
        echo "<option value='Chandler'>Chandler</option>
    <option value='Tucson'>Tucson</option>
    <option value='Phoenix'>Phoenix</option>
    <option value='Mesa'>Mesa</option>
    <option value='Tempe'>Tempe</option>
    ";
        break;  
    case "CA":
        echo "<option value='Brentwood'>Brentwood</option>
    <option value='Monterey Park'>Monterey Park</option>
    <option value='Los Angeles'>Los Angeles</option>
    <option value='Bishop'>Bishop</option>
    <option value='Sherman Oaks'>Sherman Oaks</option>
    <option value='Citrus Heights'>Citrus Heights</option>
    <option value='Sacramento'>Sacramento</option>
    <option value='Davis'>Davis</option>
    <option value='Elk Grove'>Elk Grove</option>
    <option value='Bakersfield'>Bakersfield</option>
    <option value='Fontana'>Fontana</option>
    <option value='Temecula'>Temecula</option>
    <option value='San Francisco'>San Francisco</option>
    <option value='Santa Rosa'>Santa Rosa</option>
    <option value='Burbank'>Burbank</option>
    <option value='Orange'>Orange</option>
    <option value='Emeryville'>Emeryville</option>
    ";
        break; 
    case "DC":
        echo "<option value='Washington'>Washington</option>
    ";
        break;    
      
    case "FL":
        echo "<option value='Orlando'>Orlando</option>
    <option value='Miami'>Miami</option>
    <option value='Gainesville'>Gainesville</option>";
        break;
       
    case "GA":
        echo "<option value='Atlanta'>Atlanta</option>
    ";
        break; 
    
     case "ID":
        echo "<option value='Boise'>Boise</option>
        <option value='Coeur d'Alene'>Coeur d'Alene</option>
        <option value='Ammon'>Ammon</option>
        <option value='Nampa'>Nampa</option>
        <option value='Meridian'>Meridian</option>
    ";
        break;   
        
     case "IL":
        echo "<option value='Chicago'>Chicago</option>
    ";
        break; 
       case "KY":
        echo "<option value='Louisville'>Louisville</option>
              <option value='Bowling Green'>Bowling Green</option>
    ";
    break;
    case "MA":
        echo "<option value='Somerville'>Somerville</option>
              <option value='Brookline'>Brookline</option>
              <option value='Boston'>Boston</option>
              <option value='Cambridge'>Cambridge</option>
              <option value='Arlington'>Arlington</option>
    "; 
        break;   
     case "MD":
        echo "<option value='Bethesda'>Bethesda</option>
              
    "; 
        break;    
     case "MO":
        echo "<option value='St. Louis'>St. Louis</option>
           
    "; 
        break;    
     case "NV":
        echo "<option value='Las Vegas'>Las Vegas</option>
              <option value='Reno'>Reno</option>"; 
        break;    
     case "NY":
        echo "<option value='New York'>New York</option>
             <option value='Brooklyn'>Brooklyn</option>
              <option value='Kew Garden'>Kew Garden</option>"; 
        break;  
     case "OH":
        echo "<option value='Cleveland Heights'>Cleveland Heights</option>
           
    "; break;
    case "OR":
        echo "<option value='Porland'>Porland</option>
             <option value='Eugene'>Eugene</option>
              <option value='Newberg'>Newberg</option>
              <option value='Beaverton'>Beaverton</option>
             <option value='Bend'>Bend</option>
              <option value='Hillsboro'>Hillsboro</option>
                <option value='Tigard'>Tigard</option>
              <option value='Springfield'>Springfield</option>
              "; 
        break; 
    
    case "PA":
        echo "<option value='Philadelphia'>Philadelphia</option>
             <option value='Pittsburgh'>Pittsburgh</option>
             "; 
        break; 
     case "TX":
        echo "<option value='Dallas'>Dallas</option>
             <option value='Houston'>Houston</option>
             "; 
        break;  
         
     case "UT":
        echo "<option value='Provo'>Provo</option>
             <option value='Salt Lake City'>Salt Lake City</option>
              <option value='Sandy'>Sandy</option>
              <option value='South Jordan'>South Jordan</option>
             <option value='North Jordan'>North Jordan</option>
              <option value='Orem'>Orem</option>
              "; 
        break; 
     case "WA":
        echo "<option value='Vancouver'>Vancouver</option>
             <option value='Spokane'>Spokane</option>
              <option value='Auburn'>Auburn</option>
              <option value='Everett'>Everett</option>
             <option value='Bellevue'>Bellevue</option>
              <option value='Bellingham'>Bellingham</option>
              <option value='Federal Way'>Federal Way</option>
              <option value='Lacey'>Lacey</option>
              "; 
        break; 
     
    }
   
   echo"</select>";
}

  $tempkeyword2=$_GET["keyword"];
  $tempstate2=$_GET["state"];
    echo"
   <input type='hidden' name='keyword' value='$tempkeyword2' />
   <input type='hidden' name='state' value='$tempstate2' />";
     
 echo"</form>";


?>

<script>
function change2(){
    document.getElementById("city1").submit();
}
</script>


   </div> 
   
   
   <div id="footer">Copyright Wenchao GROUP22 COP5725 University of Florida</div>
   </div>
</body>

</html>
