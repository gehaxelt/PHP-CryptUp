<?php
include "inc/config.php";
?>
<html>
	<head>
		<title>CryptUp</title>
	</head>
	<body>
		<h1>Willkommen bei CryptUp</h1><br />
		<h2>Hier kannst du Dateien hochladen, welche GPG-verschl&uuml;sselt auf File-Hoster hochgeladen werden.</h2>
		<h3>Maximal 20MB gro&szlig;e Dateien.</h3><br />
		<br />
		<form action="index.php?action=upload" method="post" enctype="multipart/form-data">
			<!-- <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />-->
				Datei ausw&auml;hlen: <input name="file" type="file" /><br />
			<input type="submit" value="CryptUp!" />
		</form>
		<?php
			if(isset($_GET['action'])) {

				switch($_GET['action']) {
					case "upload":
							include "upload.php";
						break;
						
					case "file":
							include "file.php";
						break;
						
					case "delete":
							include "delete.php";
						break;
				}
			}
		?>
	</body>
</html>
