#!/usr/local/bin/php

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
 
</head>

<body>
<div id="container">
   <div id="header1">
      <a href="Customer_Interface.php"><h2 id="h1">HOME</h2></a>
      <a href="Movie_Search.php"><h2 id="h1">Another</h2></a>
   </div>
   
   <div id="header2">
      <h1 id="h2">MOVIE SEARCH</h1>
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
       
          <form name="input" action="Movie_Search.php"              method="get">
                                                             <h4>Movie Keyword:<input type="text" name="keyword" /><input type="submit" value="Search" style="background-color: rgb(255,165,0);Font-size: 9pt;"/></h4>
         
          </form>
       
        </pre>
   </div>
   
   
   
   


   
   <div id="searchresult">
      <h2><b>Search Result</b></h2>
      <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>



<?php
//echo $_GET["keyword"];
//echo $_GET["onshow"];
$onshow=$_GET["onshow"];
$year1139=$_GET["year"];
$keyword854=$_GET["keyword"];
$category125=$_GET["category"];

if($keyword854)
{
echo "You have chosen:   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'>keyword:$keyword854</button> ";
}
/*if($keyword854)
{
echo " <form name='sort1' action='Movie_Search.php' method='get'> 
     <input type='hidden' name='onshow' value='$onshow' /> 
     <input type='hidden' name='year' value='$year1139' /> 
     <input type='hidden' name='category' value='$category125' /> 
     <input type='hidden' name='keyword' value='' /> 
     <input type='submit' value=' Keyword:$keyword854' style='background-color: rgb(255,165,0);Font-size: 9pt/></form>";
}*/
if($onshow == "1")
{
	echo "   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'>Onshow</button>";

}
if($_GET["year"] && $_GET["year"]!="9999" )
{
   echo "   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'>year:$year1139</button>";
	
}
if($_GET["category"] && $_GET["category"]!="-1"&&$_GET["category"]!="0")
{
    echo "   <button type='button' style='background-color: rgb(255,165,0);Font-size: 9pt;'>Category:$category125</button>";
    
}
/*
if($keyword854)
{
echo " <form name='sort1' action='Movie_Search.php' method='get'> 
     <input type='hidden' name='onshow' value='$onshow' /> 
     <input type='hidden' name='year' value='$year1139' /> 
     <input type='hidden' name='category' value='$category125' /> 
     <input type='hidden' name='keyword' value='' /> 
     <input type='submit' value=' Keyword:$keyword854' style='background-color: rgb(255,165,0);Font-size: 9pt/></form>";
}*/
/*if($onshow == "1")
{
	echo " <form name='sort2' action='Movie_Search.php' method='get'> 
     <input type='hidden' name='keyword' value='$keyword854' /> 
     <input type='hidden' name='year' value='$year1139' /> 
     <input type='hidden' name='category' value='$category125' /> 
     <input type='hidden' name='onshow' value='' /> 
     <input type='submit' value='Onshow' style='background-color: rgb(255,165,0);Font-size: 9pt/></form>";

}
if($_GET["year"] && $_GET["year"]!="9999" )
{
 echo " <form name='sort3' action='Movie_Search.php' method='get'> 
     <input type='hidden' name='keyword' value='$keyword854' /> 
     <input type='hidden' name='onshow' value='$onshow' /> 
     <input type='hidden' name='category' value='$category125' /> 
     <input type='hidden' name='year' value='9999' /> 
     <input type='submit' value='$year1139' style='background-color: rgb(255,165,0);Font-size: 9pt/></form>";
	
}
if($_GET["category"] && $_GET["category"]!="-1"&&$_GET["category"]!="0")
{
  echo " <form name='sort4' action='Movie_Search.php' method='get'> 
     <input type='hidden' name='keyword' value='$keyword854' /> 
     <input type='hidden' name='onshow' value='$onshow' /> 
     <input type='hidden' name='year' value='$year1139' /> 
     <input type='hidden' name='category' value='-1' />
     <input type='submit' value=' $category125' style='background-color: rgb(255,165,0);Font-size: 9pt/></form>";
    
}*/


$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");

if(!$conn)
{
	 echo "connection error!";
 }
if($_GET["keyword"]||(!$_GET["keyword"]&&$_GET["year"]))
{  if($_GET["year"] && $_GET["year"]!=9999)
	{ if($_GET["year"]>=2010 && $_GET["year"]<=2015)
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR=:year1');
	  oci_bind_by_name($stid, ':year1',$year1139 );
     }
     if($_GET["year"]== "2000s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=2000 AND YEAR<=2009');

     }
     if($_GET["year"]== "1990s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=1990 AND YEAR<=1999');

     }
     if($_GET["year"]== "1980s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=1980 AND YEAR<=1989');

     }
     if($_GET["year"]== "1970s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=1970 AND YEAR<=1979');

     }
     if($_GET["year"]== "1960s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=1960 AND YEAR<=1969');

     }
     if($_GET["year"]== "1950s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=1950 AND YEAR<=1959');

     }
     if($_GET["year"]== "1940s")
	  { $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR>=1940 AND YEAR<=1949');

     }
     
     if($_GET["year"]== "before40s")
     {
        $stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d AND YEAR<=1939');
     }
     
	}
	else if ($_GET["year"]==9999||$_GET["keyword"])
	{
		$stid = oci_parse($conn, 'SELECT MOVIE_ID,TITLE,DIRECTOR,YEAR,ISONSHOW FROM Movie WHERE upper(TITLE) LIKE :d ');
	}
	else
	{
	   $stid=oci_parse($conn, 'SELECT FROM Movie');
	}
}
else
{
	if($_GET["onshow"]||$_GET["keyword"]||$_GET["category"])
	{$stid=oci_parse($conn, 'SELECT * FROM Movie');
   }
   else
   {
     $stid=oci_parse($conn, 'SELECT FROM Movie');
   }
}

$temp0=strtoupper($_GET["keyword"]);
$temp='%'.$temp0.'%';

oci_bind_by_name($stid, ':d',$temp );
oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'MOVIE_ID', $id);
oci_define_by_name($stid, 'DIRECTOR', $director);
oci_define_by_name($stid, 'YEAR', $year);
oci_define_by_name($stid, 'ISONSHOW', $isonshow);

oci_execute($stid);
echo "<br>";
$count=1;
while(oci_fetch($stid) && $count<=50)
{   
      
 
    if($isonshow >= $onshow )
    {
    	
     $stid3 = oci_parse($conn, 'SELECT CATEGORY  FROM MOVIE_CATEGORY WHERE MOVIE_ID= :mid ');
     oci_bind_by_name($stid3, ':mid',$id );
     oci_define_by_name($stid3, 'CATEGORY', $category);
     oci_execute($stid3);
     oci_fetch($stid3);
     if(!$category125 || $category125 == "0" || $category125=="-1")
     {
     echo" <form name='sort8' action='Movie_Page.php' method='get'> 
     Movie Name:  $title  Year:($year)   Director:$director  Category:$category
     <input type='hidden' name='title' value='$title' /> 
     <input type='hidden' name='movieid' value='$id' /> 
     <input type='submit' value='Details' /></form>";
     $count=$count+1;
     }
     else if($category==$category125)
     {
     	 echo" <form name='sort6' action='Movie_Page.php' method='get'> 
     Movie Name:  $title  Year:$year   Director:$director  Category:$category
     <input type='hidden' name='title' value='$title' /> 
     <input type='hidden' name='movieid' value='$id' /> 
     <input type='submit' value='Details' /></form>";
     $count=$count+1;
       
     }
    }
}

oci_close($conn);


?>
      </div>
      
      
 <div id="Constrains">
   
   
      <h2>     
<br>
<br>        Constrains</h2><br> <br> <br> 
Onshow:
<form id="onshowconstrains" method="get">
<select name = 'onshow' style = 'position: relative' onchange="change()">
    <option value="-1">Select</option>
    <option value="0">All</option>
    <option value="1">Onshow</option>
</select>
<?php
    $tempkeyword1=$_GET["keyword"];
    $tempyear1=$_GET["year"];
    $tempcategory1=$_GET["category"];
    echo"
   <input type='hidden' name='keyword' value='$tempkeyword1' />
   <input type='hidden' name='year' value='$tempyear1' />
   <input type='hidden' name='category' value='$tempcategory1' />";
  
?>
</form>

<script>
function change(){
    document.getElementById("onshowconstrains").submit();
}
</script><br> 
Year:
<form id="yearconstrains" method="get">
<select name = 'year' style = 'position: relative' onchange="change1()">
    <option value="">Select</option>
    <option value="9999">All</option>
    <option value="2015">2015</option>
    <option value="2014">2014</option>
    <option value="2013">2013</option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2000s">2000s</option>
    <option value="1990s">90s</option>
    <option value="1980s">80s</option>
    <option value="1970s">70s</option>
    <option value="1960s">60s</option>
    <option value="1950s">50s</option>
    <option value="1940s">40s</option>
    <option value="before40s">before40s</option>
</select>
<?php
    $tempkeyword2=$_GET["keyword"];
    $temponshow2=$_GET["onshow"];
    $tempcategory2=$_GET["category"];
    echo"
   <input type='hidden' name='keyword' value='$tempkeyword2' />
   <input type='hidden' name='onshow' value='$temponshow2' />
   <input type='hidden' name='category' value='$tempcategory2' />";
 
?>
</form>

<script>
function change1(){
    document.getElementById("yearconstrains").submit();
}
</script>
<br>
<form id="Category" method="get">

Category:
<br>
<select name = 'category' style = 'position: relative' onchange="change2()">
    <option value="-1">Select</option>
    <option value="0">All</option>
    <option value="Action">Action</option> 
    <option value="Adventure">Adventure</option> 
    <option value="Animation">Animation</option> 
    <option value="Anti-Drama">Anti-Drama</option> 
    <option value="Artvideo">Artvideo</option> 
    <option value="Avga">Avga</option> 
    <option value="Biography">Biography</option>
    <option value="Biographical">Biographical</option>
    <option value="Carton">Carton</option>
    <option value="Cnr">Cnr</option>
    <option value="Comedy">Comedy</option>
    <option value="Crime">Crime</option>
    <option value="Disaster">Disaster</option>
    <option value="Dist">Dist</option>
    <option value="Documentary">Documentary</option>
    <option value="Drama">Drama</option>
    <option value="Drama.Action">Drama.Action</option>
    <option value="Dramadocumentary">Dramadocumentary</option>
    <option value="Epic">Epic</option>
    <option value="Family">Family</option>
    <option value="Fantasy">Fantasy</option>
    <option value="Historical">Historical</option>
    <option value="Horror">Horror</option>
    <option value="Music">Music</option>
    <option value="Mystery">Mystery</option>
    <option value="Noir">Noir</option>
    <option value="Porn">Porn</option>
    <option value="Religious">Religious</option>
    <option value="Romance">Romance</option>
    <option value="Sci-Fi">Sci-Fi</option>
    <option value="Surreal">Surreal</option>
    <option value="Suspicion">Suspicion</option>
    <option value="Thriller">Thriller</option>
    <option value="Tv">Tv</option>
    <option value="War">War</option>
    <option value="Weird">Weird</option>
    <option value="West">West</option>

</select>
<?php
    $tempkeyword3=$_GET["keyword"];
    $tempyear3=$_GET["year"];
    $temponshow3=$_GET["onshow"];
    echo"
   <input type='hidden' name='keyword' value='$tempkeyword3' />
   <input type='hidden' name='year' value='$tempyear3' />
   <input type='hidden' name='onshow' value='$temponshow3' />";
  
?>
</form>
<script>
function change2(){
    document.getElementById("Category").submit();
}
</script>
<br>
<br>
<br>
<br>
   </div>
      
   


 <div id="footer">Copyright GROUP22 COP5725 2015 University of Florida</div>
   </div>
</body>

</html>
