#!/usr/local/bin/php

<?php
putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
if(strcmp($_POST["password"],$_POST["reenter_psw"]) == 0){
	$conn = oci_connect("wenchao", "COP5725G22", "oracle.cise.ufl.edu:1521/orcl");
	if(!$conn)
	{
		echo "connection error!";
	}
	echo "connected";

	#fetch the biggest id now into $cilne_id and ++
	$sql = 'SELECT CINE_ID FROM CINEMA ORDER BY CINE_ID DESC';
	$stid = oci_parse($conn, $sql);

	oci_define_by_name($stid, 'CINE_ID', $cineid);

	oci_execute($stid);
	if(oci_fetch($stid)){
		$cineid += 1;
		setcookie("cineId", "$cineid", time()+3600);
		echo "Found!<br>\n";
		echo $cineid;
	}else{
		echo "Oh, shit!";
	}

	oci_free_statement($stid);

	#insert into table 'users'
	$sql = 'INSERT INTO USERS (USERID, USERNAME, USERPASSWORD, EMAIL) VALUES(:myid, :myname, :mypsw, :myemail)';
	$stid = oci_parse($conn, $sql);
	$name = $_POST["user"];
	$psw = $_POST["password"];
	$email = $_POST["email_addr"];

	oci_bind_by_name($stid, ':myid', $cineid);
	oci_bind_by_name($stid, ':myname', $name);
	oci_bind_by_name($stid, ':mypsw', $psw);
	oci_bind_by_name($stid, ':myemail', $email);

	oci_execute($stid);
	oci_free_statement($stid);

	#insert into table 'cinema'
	$sql = 'INSERT INTO CINEMA (CINE_ID, CINEMA_NAME, STATE, CITY, STREET, ZIP_CODE, DESCRIPTION) VALUES(:myid, :myname, :mystate, :mycity, :mystreet, :myzip_code, :mydescription)';
	$stid = oci_parse($conn, $sql);

	$name = $_POST["cinema_name"];
	$state = $_POST["states"];
	$city = $_POST["city"];
	$street = $_POST["street"];
	$zip = $_POST["zip_code"];
	$descpt = $_POST["description"];

	oci_bind_by_name($stid, ':myid', $cineid);
	oci_bind_by_name($stid, ':myname', $name);
	oci_bind_by_name($stid, ':mystate', $state);
	oci_bind_by_name($stid, ':mycity', $city);
	oci_bind_by_name($stid, ':mystreet', $street);
	oci_bind_by_name($stid, ':myzip_code', $zip);
	oci_bind_by_name($stid, ':mydescription', $descpt);

	oci_execute($stid);
	oci_free_statement($stid);

	#insert into table 'cinema_contact'
	$sql = 'INSERT INTO CINEMA_CONTACT (CINE_ID, CONTACTS) VALUES(:myid, :mycontact)';
	$stid = oci_parse($conn, $sql);

	$contact = $_POST["contact1"];

	oci_bind_by_name($stid, ':myid', $cineid);
	oci_bind_by_name($stid, ':mycontact', $contact);

	oci_execute($stid);
	oci_free_statement($stid);

	#insert into table 'cinema_trans'
	$sql = 'INSERT INTO CINEMA_TRANS (CINE_ID, TRANSPORT) VALUES(:myid, :mytrans)';
	$stid = oci_parse($conn, $sql);

	$trans = $_POST["transports"];

	oci_bind_by_name($stid, ':myid', $cineid);
	oci_bind_by_name($stid, ':mytrans', $trans);

	oci_execute($stid);
	oci_free_statement($stid);


	oci_close($conn);
}else{
	echo "Error: password doesn't match";
	#sleep(3);
	header("Location: Cinema_Register.php"); 
}

?>

<html>
<body>

<?php echo $_POST["user"]; ?>
<?php echo $_POST["password"]; ?>
<?php echo $_POST["email_addr"]; ?>

<!--junmp to next page after inserting data-->
<meta http-equiv="refresh" content="10; url=Hall_Information_Init.php" />
</body>

</html>
