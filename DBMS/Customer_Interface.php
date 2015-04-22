#!/usr/local/bin/php
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
<div id="container">
   <div id="header1">
       <a href="TupleStatistics.php">TUPLES</a>
   </div>
   
   <div id="header2">
      <h1 id="h2">CUSTOMER INTERFACE</h1>
   </div>

   <div id="header3">
        <a href="User_Information_Page.html"> User Info </a>
        <br />
        <br />
        <a href="Welcome_Page.html"> Sign out</a>
   </div>
   </div>



   <div id="Search">
       
     
       <pre><form name="input" action="Movie_Search.php"              method="get">
                                                          <h4><b>Movie Keyword:</b><input size="35" height="50" type="text" name="keyword" /><b><input type="submit" value="Search" style='background-color: rgb(255,165,0);Font-size: 9pt;'/></b></h4>
          </form>
       
        </pre>
   </div>
   
   
   
   <div id="c1">
      <h2><a href="Movie_Search.php">Movies</a></h2>
      <h2><a href="hotmovie.php">Hot Movies</a></h2>
   </div>
   <div id="c2">
      <h2><a href="Cinema_Search.php">Cinemas</a></h2>
      <h2><a href="hotcinema.php">Hot Cinemas</a></h2>
      
   </div>
   <div id="c3">
      <h2>Want more about you?</h2>
      <h2><a href="cadvanceds.html">Advanced Search</a></h2>
      
   </div>

   <div id="poster1">
       <br><br>
       
 <img id="p"  width='290' height='350'/>
   <script>
       var t = new Array("picture/20000","picture/20001", "picture/20002","picture/20003","picture/20004","picture/20005","/picture/20006","/picture/20007","/picture/20008","/picture/20009","/picture/200010","/picture/200011","/picture/200012");
       var i = 0;
       function changepic() {
           if (i > 12) i = 0;
           var p = document.getElementById("p");
           p.src = t[i];i++;setTimeout(changepic, 2000);
       }
       window.onload = changepic;   
   </script>
            
      
   </div>
   <div id="poster2">
     <br><br>
 
       <img src ='/picture/cinema.png' width='290' height='350'> 
   </div>
   <div id="poster3">
      <br><br>
      <img src ='/picture/ad.png' width='290' height='350'> 
    
   </div>
   


<div id="footer">Copyright GROUP22 COP5725 2015 University of Florida
</div>
</div>
</body>

</html>