#!/usr/local/bin/php

<?php 
$cineid = $_COOKIE["cineId"];
$i = $_POST["tag"];
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
if(!$conn)
{
    echo "connection error!";
}
switch ($i) {
    case 1:
        $cname = $_POST["cname"];
        $sql = 'UPDATE CINEMA SET CINEMA_NAME = :cname WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':cname', $cname);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 2:
        $uname = $_POST["uname"];
        $sql = 'UPDATE USERS SET USERNAME = :uname WHERE USERID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':uname', $uname);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 3:
        $email = $_POST["email"];
        $sql = 'UPDATE USERS SET EMAIL = :email WHERE USERID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 4:
        $state = $_POST["state"];
        $sql = 'UPDATE CINEMA SET STATE = :state WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':state', $state);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 5:
        $city = $_POST["city"];
        $sql = 'UPDATE CINEMA SET CITY = :city WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':city', $city);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 6:
        $street = $_POST["street"];
        $sql = 'UPDATE CINEMA SET STREET = :street WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':street', $street);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 7:
        $zipcode = $_POST["zipcode"];
        $sql = 'UPDATE CINEMA SET ZIP_CODE = :zipcode WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':zipcode', $zipcode);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 8:
        $contact = $_POST["contact"];
        $sql = 'UPDATE CINEMA_CONTACT SET CONTACTS = :contact WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':contact', $contact);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 9:
        $trans = $_POST["trans"];
        $sql = 'UPDATE CINEMA_TRANS SET TRANSPORT = :trans WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':trans', $trans);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
    case 10:
        $dscrpt = $_POST["dscrpt"];
        $sql = 'UPDATE CINEMA SET DESCRIPTION = :dscrpt WHERE CINE_ID = :mycineid';
        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':dscrpt', $dscrpt);
        oci_bind_by_name($stid, ':mycineid', $cineid);
        oci_execute($stid);
        oci_free_statement($stid);
        break;
}
   


header("Location: Cinema_Information.php"); 

echo "<script language=javascript>alert('Data updated: '$cname'');location.href='Cinema_Information.php'</script>";

/*
<li>   Cinema Name:    <?php echo $cname; ?> <input type="submit" value="Edit" />   </li>
<li>   Username:       <?php echo $uname; ?> <input type="submit" value="Edit" />  </li>
<li>   Email:          <?php echo $email; ?> <input type="submit" value="Edit" />   </li>
<li>   State:          <?php echo $state; ?> <input type="submit" value="Edit" />   </li>
<li>   City:           <?php echo $city; ?> <input type="submit" value="Edit" />   </li>
<li>   Street:         <?php echo $street; ?> <input type="submit" value="Edit" />   </li>
<li>   Zip Code:       <?php echo $zipcode; ?> <input type="submit" value="Edit" />   </li>
<li>   Phone NO.:      <?php echo $contact; ?> <input type="submit" value="Edit" />   </li>
<li>   Transprotations:      <?php echo $trans; ?> <input type="submit" value="Edit" />   </li>
<li>   Description:          <?php echo $dscrpt; ?><input type="submit" value="Edit" />   </li>
*/
?>


