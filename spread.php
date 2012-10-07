<?php
include "inc/config.php";

//Read filename as cmd-parameter
if(!isset($_SERVER['argv'][1])) {
	echo "Nicht genügend Parameter.";
	exit;
}

$fileId=$_SERVER['argv'][1];

//Validate md5-hash
if(!preg_match("/[A-Za-z0-9]{32}/", $fileId)) {
	echo "Falscher Dateiname";
	exit;
}
//Check file existance
if(!file_exists("./uploads/".$fileId.".gpg")) {
	echo "Die Datei existiert nicht";
	exit;
}

//upload to go4up
$go4upret=shell_exec(escapeshellcmd($PLOWUP_BIN." -q go4up ./uploads/".$fileId.".gpg"));
$go4up_url=explode(" ",$go4upret);

//upload to go4up
$multiupload=shell_exec(escapeshellcmd($PLOWUP_BIN." -q multiupload ./uploads/".$fileId.".gpg"));
$multiupload_url=explode(" ",$multiupload);

//upload to go4up
$rapidshare=shell_exec(escapeshellcmd($PLOWUP_BIN." -q -a ".$RS_USER.":".$RS_PW." rapidshare ./uploads/".$fileId.".gpg"));
$rapidshare_url=explode(" ",$rapidshare);

//update database
mysql_query("update Uploads set go4up = '".mysql_real_escape_string($go4up_url[0])."', multiupload = '".mysql_real_escape_string($multiupload_url[0])."', rapidshare = '".mysql_real_escape_string($rapidshare_url[0])."' where id = '".mysql_real_escape_string($fileId)."'") or die (mysql_error);

//delete crypted file
system(escapeshellcmd("rm -f ./uploads/".$fileId.".gpg"),$ret);


?>