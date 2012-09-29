<?php
	//Is parameter id set?
	if(!isset($_GET['id'])) {
		echo "<span class='error'>Es ist keine ID angegeben.</span><br>";
		exit;
	}
	
	//Delete links by delete_code
	$qres=mysql_query("delete from Uploads where delete_code ='".mysql_real_escape_string($_GET['id'])."'");
	
	//Deletion succesful ?
	if(!mysql_affected_rows() > 0) {
		echo "Links konnten nicht gel&ouml;scht werden.";
		exit;
	}
?>

<h1>Die Links wurden aus der Datenbank entfernt.</h1>
