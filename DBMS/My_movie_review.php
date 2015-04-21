#!/usr/local/bin/php
<html>


<body>
 <div id="container">
  
   
   <div id="header3">
      <h2 id="h3">My review and rating</h2>
   </div>

   </div>
 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>



<?php




$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

 $stid = oci_parse($conn, 'SELECT COMMENTS,RATING,REVIEW_TIMESTAMP FROM MOVIE_REVIEW  WHERE MOVIE_ID=:d and CUST_ID=:f ');
 $stid3 = oci_parse($conn, 'SELECT COUNT(RATING) AS RATINGNUM,COUNT(COMMENTS) AS COMMENTSNUM FROM MOVIE_REVIEW WHERE MOVIE_ID= :d and CUST_ID=:f ');
 
 
$temp=$_GET["movieid"];
$temp2=$_COOKIE["customername"];


oci_bind_by_name($stid, ':d',$temp );
oci_bind_by_name($stid, ':f',$temp2 );
oci_bind_by_name($stid3, ':d',$temp );
oci_bind_by_name($stid3, ':f',$temp2 );
oci_define_by_name($stid, 'USERNAME',$USERNAME);
oci_define_by_name($stid, 'COMMENTS',$COMMENTS);
oci_define_by_name($stid, 'RATING',$RATING);
oci_define_by_name($stid, 'REVIEW_TIMESTAMP',$REVIEW_TIMESTAMP);

oci_define_by_name($stid3, 'RATINGNUM',$RATINGNUM);
oci_define_by_name($stid3, 'COMMENTSNUM',$COMMENTSNUM);

oci_execute($stid);
oci_execute($stid3);
while(oci_fetch($stid))
{ }
while(oci_fetch($stid3))
{ 
	if($RATINGNUM==0) 
		{echo "You have not rated this movie.";
		 echo "<br>";}
	else{echo "Your rate for this movie:  ";
	switch ($RATING) {
    case 1:
        echo "&#9733&#9734&#9734&#9734&#9734";
        break;
    case 2:
        echo "&#9733&#9733&#9734&#9734&#9734";
        break;
    case 3:
        echo "&#9733&#9733&#9733&#9734&#9734";
        break;
    case 4:
        echo "&#9733&#9733&#9733&#9733&#9734";
        break;
    case 5:
        echo "&#9733&#9733&#9733&#9733&#9733";
        break;
		}
		echo "<br>";
		}


	if($COMMENTSNUM==0) 
	{echo "You have not commented on the movie.";
	 echo "<br>";}
	 else{ echo "Your comment on this movie:  ";
	 echo "<br>";
	 echo $COMMENTS;
	 echo "<br>";
	 echo "<br>";	 
	 }
	if($COMMENTSNUM!=0 or $RATINGNUM!=0){ 
		echo "Time: $REVIEW_TIMESTAMP ";
	echo "<br>";
	 echo "<br>";}
	  
	 
}

 oci_close($conn);

?>

<div id="Contents1">
<form id="review" action="My_movie_review_submit.php" method="get">
<ul>
<h5>

<li>Movie Name:<?php echo"$moviename";?></li><br/>

Rating:<br/>
&#9733; &#9733; &#9733; &#9733; &#9733; <input type="radio" name="r2" value="5" checked="checked" /><br/>
&#9733; &#9733; &#9733; &#9733; &#9734;<input type="radio" name="r2" value="4" checked="checked"/><br/>
&#9733; &#9733; &#9733; &#9734; &#9734;<input type="radio" name="r2" value="3" checked="checked"/><br/>
&#9733; &#9733; &#9734; &#9734; &#9734;<input type="radio" name="r2" value="2 " checked="checked"/><br/>
&#9733; &#9734; &#9734; &#9734; &#9734;<input type="radio" name="r2" value="1 " checked="checked" />

<br />

<br/>
My comments:<br/>
<textarea name="comment1" rows="5" cols="30"></textarea>
<input type="submit" name="submit" value="Submit"style='background-color: rgb(255,165,0);Font-size: 9pt;'>
                       
</ul>  
<?php



echo" <input type='hidden' name='movieid' value='$temp'/>";

?>
</body>

</html>