#!/usr/local/bin/php
<html>


<body>
 <div id="container">
  
   
   <div id="header3">
      <h2 id="h3">Review and rating</h2>
   </div>

   </div>
 <?php putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");?>



<?php




$conn= oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
	 echo "connection error!";
 }

 $stid = oci_parse($conn, 'SELECT USERNAME,COMMENTS,RATING,REVIEW_TIMESTAMP FROM MOVIE_REVIEW,USERS  WHERE MOVIE_ID=:d and CUST_ID=USERID order by RATING DESC');
 $stid3 = oci_parse($conn, 'SELECT ROUND(AVG(RATING),2) AS AVERATING,COUNT(RATING) AS RATINGNUM,COUNT(COMMENTS) AS COMMENTSNUM FROM MOVIE_REVIEW WHERE MOVIE_ID= :d');
 
 
$temp=$_GET["movieid"];


oci_bind_by_name($stid, ':d',$temp );
oci_bind_by_name($stid3, ':d',$temp );
oci_define_by_name($stid, 'USERNAME',$USERNAME);
oci_define_by_name($stid, 'COMMENTS',$COMMENTS);
oci_define_by_name($stid, 'RATING',$RATING);
oci_define_by_name($stid, 'REVIEW_TIMESTAMP',$REVIEW_TIMESTAMP);
oci_define_by_name($stid3, 'AVERATING',$AVERATING);
oci_define_by_name($stid3, 'RATINGNUM',$RATINGNUM);
oci_define_by_name($stid3, 'COMMENTSNUM',$COMMENTSNUM);
oci_execute($stid);
oci_execute($stid3);
while(oci_fetch($stid3))
{
if($RATINGNUM==0) 
{echo "There is no rating yet.";
echo "<br>";}
else
{echo "<br>";
echo " Average rating: ($AVERATING";
echo "/5)";
echo "<br>";}


if($COMMENTSNUM==0) 
{echo "There is no comments yet.";
echo "<br>";}
else
{echo "<br>";
echo "Number of ratings: $RATINGNUM";
echo "<br>";}

}
echo "<br>";
while(oci_fetch($stid))
{   
       echo "<br>";
  echo " USER: $USERNAME ";
   echo "<br>";
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
      echo " Comment: $COMMENTS ";
       echo "<br>"; 
		echo "Time: $REVIEW_TIMESTAMP ";
          echo "<br>";

           echo "<br>";
           }
           

 oci_close($conn);


?>

</body>

</html>