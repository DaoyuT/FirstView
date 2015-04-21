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
      <h1 id="h2">MOVIE SEARCH</h1>
   </div>

   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign Out </a>
   </div>
</div>




   
   
   


   
     <div id="searchresult">
      <h2><b>Search Result</b></h2>
      <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>
     


<?php

$keyword0=$_REQUEST["keyword"];
$keyword=strtoupper($_REQUEST["keyword"]);
if(empty($keyword)){$numkey=0;}
else{$numkey=1;}
//echo "numkey";
//echo $numkey;

$keyword='%'.$keyword.'%';


//echo $keyword; 

$stryear="";
for($i=0;$i<count($_REQUEST["year"]);$i++)  
{  
if(trim($_REQUEST["year"][$i]) != "")  
{  
$stryear=$stryear." OR ".$_REQUEST["year"][$i];
}  
} 
$numyear=$i;
//echo "numyear";
//echo $numyear;

$stryear=substr($stryear,4);


$stronshow="";
for($i=0;$i<count($_REQUEST["ifonshow"]);$i++)  
{  
if(trim($_REQUEST["ifonshow"][$i]) != "")  
{  
$stronshow=$stronshow." OR ".$_REQUEST["ifonshow"][$i];
}  
} 
$numshow=$i;
//echo "numshow";
//echo $numshow;
//echo empty($stronshow);

$stronshow=substr($stronshow,4);

$strcat="";
for($i=0;$i<count($_REQUEST["cat"]);$i++)  
{  
if(trim($_REQUEST["cat"][$i]) != "")  
{  
$strcat=$strcat." OR ".$_REQUEST["cat"][$i];
}  
} 
$numcat=$i;
//echo "numcat";
//echo $numcat;
//echo empty($strcat);

$strcat=substr($strcat,4);



$strrate=$_REQUEST["rou"];


if(empty($strrate))
{
	$strMOVIE_REVIEW1="";
	$strMOVIE_REVIEW2="";
	$strMOVIE_REVIEW3="";
}
else
{
	$strMOVIE_REVIEW1=",MOVIE_REVIEW";
	$strMOVIE_REVIEW2=" AND MOVIE.MOVIE_ID=MOVIE_REVIEW.MOVIE_ID ";
	$strMOVIE_REVIEW3="ROUND(AVG(RATING),2) as R,";
}
if($numcat==0)
{
	$strMOVIE_CATEGORY1="";
	$strMOVIE_CATEGORY2="";
	$strMOVIE_CATEGORY3="";
}
else
{
	$strMOVIE_CATEGORY1=",MOVIE_CATEGORY";
	$strMOVIE_CATEGORY2=" AND MOVIE.MOVIE_ID=MOVIE_CATEGORY.MOVIE_ID ";
	$strMOVIE_CATEGORY3=",CATEGORY";
}

//echo $strrate;
//echo empty($strrate);

$strasds=$_REQUEST["asds"];
//echo $strasds;
//echo empty($strasds);


//echo $stronshow;
/*
    if (isset($_REQUEST["year"]))
    {
        foreach ($_REQUEST["year"] as $selectedyear)
            $selected2[$selectedyear] = "checked";
    }
    if (isset($_REQUEST["ifonshow"]))
    {
        foreach ($_REQUEST["ifonshow"] as $selectedifonshow)
            $selected1[$selectedifonshow] = "checked";
    }
    if (isset($_REQUEST["cat"]))
    {
        foreach ($_REQUEST["cat"] as $selectedcat)
            $selected3[$selectedcat] = "checked";
    }
    if (isset($_REQUEST["rou"]))
    {
        foreach ($_REQUEST["rou"] as $selectedrou)
            $selected4[$selectedrou] = "checked";
    }
    if (isset($_REQUEST["asds"]))
    {
        foreach ($_REQUEST["asds"] as $selectedasds)
            $selected3[$selectedasds] = "checked";
    }
*/	
echo "------------Constraints-----------";
echo "<br>";
$i=0;	
if	($numkey!=0){
	$i=$i+1;
echo "Condition ".$i.": ";
echo "keywords=";
echo $keyword0;
echo "<br>";}
if	($numyear!=0){
	$i=$i+1;
echo "Condition ".$i.": ";	
echo $stryear;
echo "<br>";}
if	($numshow!=0){
	$i=$i+1;
echo "Condition ".$i.": ";
echo $stronshow;
echo "<br>";}
if	($numcat!=0){
	$i=$i+1;
echo "Condition ".$i.": ";
echo $strcat;
echo "<br>";}

if(!empty($strrate)){
	$i=$i+1;
echo "Condition ".$i.": ";
echo "Rating: ";
echo substr($strrate, -6);
echo "<br>";}
if(!empty($strasds)){
	$i=$i+1;
echo "Condition ".$i.": ";
echo strtoupper($strasds);
echo "<br>";}
echo "----------------------------------";	
echo "<br>";
	
$sum=$numkey+$numyear+$numshow+$numcat;
$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");

$stryear="(".$stryear.")";
$stronshow="(".$stronshow.")";
$strcat="(".$strcat.")";
/*echo "[key]";
echo "<br>";
echo $numkey;
echo "<br>";
echo "<br>";
echo $numyear;
echo "<br>";
echo "<br>";
echo $numshow;
echo "<br>";
echo "<br>";
echo $numcat;
echo "<br>";
echo "<br>";
echo $strrate;
echo "<br>";
echo "<br>";
echo $strasds;
echo "<br>";
echo "<br>";*/



if(!$conn)
{
	 echo "connection error!";
 }	
if ($sum==0) {$query=" ";}	
else{$query = "SELECT DISTINCT MOVIE.MOVIE_ID,".$strMOVIE_REVIEW3."TITLE,YEAR FROM MOVIE".$strMOVIE_CATEGORY1.$strMOVIE_REVIEW1." WHERE ";
     if($numkey!=0){$query = $query."UPPER(TITLE) LIKE :d ";}
	 if($numkey!=0 and ($sum-$numkey)!=0){$query = $query."AND ";}
     if($numyear!=0){$query = $query.$stryear." ";}
	 if($numyear!=0 and ($sum-$numkey-$numyear)!=0){$query = $query."AND ";}	 
     if($numshow!=0){$query = $query.$stronshow." ";}
	 if($numshow!=0 and ($sum-$numkey-$numyear-$numshow)!=0){$query = $query."AND ";}	 
     if($numcat!=0){$query = $query.$strcat." ";}
	 $query = $query." ".$strMOVIE_CATEGORY2." ".$strMOVIE_REVIEW2." GROUP BY (MOVIE.MOVIE_ID,YEAR,TITLE".$strMOVIE_CATEGORY3.") "
	 .$strrate." ".$strasds;
    }
	echo "<br>";

$stid=oci_parse($conn, $query);	
oci_bind_by_name($stid, ':d',$keyword );	
oci_define_by_name($stid, 'TITLE', $title);
oci_define_by_name($stid, 'R', $R);
oci_define_by_name($stid, 'MOVIE_ID', $id);	
oci_define_by_name($stid, 'YEAR', $year);
oci_define_by_name($stid, 'CATEGORY', $category);	
oci_execute($stid);	
while(oci_fetch($stid))
{
     	 echo" <form name='sort' action='Movie_Page.php' method='REQUEST'> 
     Title:  $title ($year) ";
	 
	 if(!empty($strrate)){echo "Rating: ".$R; }
	 echo"
     <input type='hidden' name='title' value='$title' /> 
     <input type='hidden' name='movieid' value='$id' /> 
<input type='submit' value='Details' /></form>";
}
oci_free_statement($conn);
oci_close($conn);

?>

 



</div>
<br>
<form action="Movie_Search.php" method="POST">
  
 <div id="Constrains">
      <h2>     

        Constrains</h2>

<b>If onshow</b>
<br>

<input type="checkbox" name="ifonshow[]" <?php echo $selected1['ISONSHOW=1'] ?> value="ISONSHOW=1">Onshow Movies<br>
<input type="checkbox" name="ifonshow[]" <?php echo $selected1['ISONSHOW=0'] ?> value="ISONSHOW=0">Offshow Movies<br>

<br>
		<details>

  <summary><b>Years</b></summary>
<input type="checkbox" name="year[]" <?php echo $selected2['YEAR>=2010 AND YEAR<=2020'] ?>  value="(YEAR>=2010 AND YEAR<=2019)">2010s<br>
<input type="checkbox" name="year[]" <?php echo $selected2['YEAR>=2000 AND YEAR<=2009'] ?>  value="(YEAR>=2000 AND YEAR<=2009)">2000s<br>
<input type="checkbox" name="year[]" <?php echo $selected2['YEAR>=1990 AND YEAR<=1999'] ?>  value="(YEAR>=1990 AND YEAR<=1999)">1990s<br>
<input type="checkbox" name="year[]" <?php echo $selected2['YEAR>=1980 AND YEAR<=1989'] ?>  value="(YEAR>=1980 AND YEAR<=1989)">1980s<br>
<input type="checkbox" name="year[]" <?php echo $selected2['YEAR>=1970 AND YEAR<=1979'] ?>  value="(YEAR>=1970 AND YEAR<=1979)">1970s<br>
<input type="checkbox" name="year[]" <?php echo $selected2['YEAR<1970'] ?>  value="YEAR<1970">Earlier 1970s<br>
</details>
<br>
		<details>

  <summary><b>Category</b></summary>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Action'"] ?>  value="(CATEGORY='Action')">Action<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Adventure"] ?>  value="(CATEGORY='Adventure')">Adventure<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Animation"] ?>  value="(CATEGORY='Animation')">Animation<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Biography'"] ?>  value="(CATEGORY='Biography')">Biography<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Cartoon'"] ?>  value="(CATEGORY='Cartoon')">Cartoon<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Comedy'"] ?>  value="(CATEGORY='Comedy')">Comedy<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Crime'"] ?>  value="(CATEGORY='Crime')">Crime<br>
<details>
  <summary>Show the rest</summary>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Disaster'"] ?>  value="(CATEGORY='Disaster')">Disaster<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Documentary'"] ?>  value="(CATEGORY='Documentary')">Documentary<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Drama'"] ?>  value="(CATEGORY='Drama')">Drama<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Family'"] ?>  value="(CATEGORY='Family')">Family<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Fantasy'"] ?>  value="(CATEGORY='Fantasy')">Fantasy<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Historical'"] ?>  value="(CATEGORY='Historical')">Historical<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Horror'"] ?>  value="(CATEGORY='Horror')">Horror<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Music'"] ?>  value="(CATEGORY='Music')">Music<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Mystery'"] ?>  value="(CATEGORY='Mystery')">Mystery<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Romance'"] ?>  value="(CATEGORY='Romance')">Romance<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='Sci-Fi'"] ?>  value="(CATEGORY='Sci-Fi')">Sci-Fi<br>
<input type="checkbox" name="cat[]" <?php echo $selected3["CATEGORY='West'"] ?>  value="(CATEGORY='West')">West<br>
</details>
</details>
<br>
<b>Rating</b>
<br>
<input type="radio" name="rou" <?php echo $selected4["Having round(avg(RATING),2)>=4.5"] ?>  value="Having round(avg(RATING),2)>=4.5 ">Over 4.5 Stars<br>
<input type="radio" name="rou" <?php echo $selected4["Having round(avg(RATING),2)>=4"] ?>  value="Having round(avg(RATING),2)>=4   ">Over 4 Stars<br>
<input type="radio" name="rou" <?php echo $selected4["Having round(avg(RATING),2)>=3"] ?>  value="Having round(avg(RATING),2)>=3   ">Over 3 Stars<br>
<input type="radio" name="rou" <?php echo $selected4["Having round(avg(RATING),2)>=2"] ?>  value="Having round(avg(RATING),2)>=2   ">Over 2 Stars<br>
<input type="radio" name="rou" <?php echo $selected4["Having round(avg(RATING),2)>=1"] ?>  value="Having round(avg(RATING),2)>=1   ">Over 1 Stars<br>
<br>

<b> Sort by order</b>
<br>
<input type="radio" name="asds" <?php echo $selected5["order by YEAR desc"] ?>  value="order by YEAR asc">Order by year ascending<br>
<input type="radio" name="asds" <?php echo $selected5["order by YEAR asc"] ?>  value="order by YEAR desc">Order by year descending<br>
<input type="radio" name="asds" <?php echo $selected5["order by R asc"] ?>  value="order by R asc">Order by rating ascending<br>
<input type="radio" name="asds" <?php echo $selected5["order by R desc"] ?>  value="order by R desc">Order by rating descending<br>

<br>
   </div>
 <div id="Search">
       
    
       <pre>
       
<h4>Movie Keyword:<input type="text" name="keyword" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>" /><input type="submit" value="Search" style="background-color: rgb(255,165,0);Font-size: 9pt;"/>
			</h4>
       
        </pre>
   </div>


</form>


 


</body>

 <div id="footer">

 <button onclick="myFunction()">See Query</button>

<script type="text/javascript">
    var javaScriptVar =  "<?php echo strtoupper($query); ?>";
    

function myFunction() {
    alert(javaScriptVar);
}
</script>
   </div>
   
 
</html>
