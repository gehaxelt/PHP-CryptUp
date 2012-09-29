<?php
	include "inc/passwordgenerator.class.php";
	
	//Was a file uploaded?
	if(!isset($_FILES["file"])) {
		echo "<span class='error'>Es wurde keine Datei hochgeladen</span><br>";
		exit;
	}
	
	//Upload error
	if($_FILES["file"]["error"]!=0) {
		echo "<span class='error'>Es ist ein Fehler beim Upload aufgetreten.</span><br>";
		exit;
	}
	
	//Bigger than x MB?
	if(($_FILES["file"]["size"]/(1024*1024))>$MAX_FILE_SIZE){
		echo "<span class='error'>Die Datei ist zu gro&szlig;</span><br>";
		exit;
	}
	
	$passGen = new PasswordGenerator();
	
	$passGen->generatePassword($SALT_LENGTH,true,true,false,true);
	
	//random hashed filename
	$cryptedFileName=md5(time().$passGen->getPassword().$PEPPER.$_FILES["file"]["name"]);
	
	//move temporary file into the uploads-directory
	if(!move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/".$cryptedFileName)) {
		echo "<span class='error'>Datei konnte nicht verschoben werden.</span><br>";	
	}

	//generate GPG-Encryption password
	$passGen->generatePassword($GPG_PASS_LENGTH,true,true,false,true);
	$gpg_password=$passGen->getPassword();	

	//encrypt file & delete original file
	system('echo '.escapeshellarg($gpg_password).' | '.escapeshellcmd($GPG_BIN).' --passphrase-fd 0 --batch --no-tty -c ./uploads/'.escapeshellcmd($cryptedFileName).'; rm ./uploads/'.escapeshellcmd($cryptedFileName).'',$ret);
	
	//generate random delete token
	$delete_token=md5($passGen->generatePassword($GPG_PASS_LENGTH,true,true,true,true).$PEPPER.time());
	
	//update database with filename & gpg-password
	mysql_query("Insert Into Uploads (id, gpg_pass, filename, delete_code) VALUES ('".mysql_real_escape_string($cryptedFileName)."','".mysql_real_escape_string($gpg_password)."', '".mysql_real_escape_string($_FILES["file"]["name"])."', '".mysql_real_escape_string($delete_token)."')");
	
	//start spread.php in the background
	exec('php spread.php '.escapeshellcmd($cryptedFileName).' > /dev/null 2>&1 & echo $!');
	
	
	echo "<h1>Upload & Verschl&uuml;sselung erfolgreich. Verteilung gestartet.</h1><br >";
	
	echo "<span class='success'>Die Links, sowie das Passwort findest du hier:</span><a href='index.php?action=file&id=".htmlentities($cryptedFileName)."'>".htmlentities($cryptedFileName)."</a><br>";
	echo "<span class='success'>Der L&ouml;schlink:<a href='index.php?action=delete&id=".htmlentities($delete_token)."'>".htmlentities($delete_token)."</a>";
?>
