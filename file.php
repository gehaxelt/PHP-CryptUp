<?php
	//Is parameter id set?
	if(!isset($_GET['id'])) {
		echo "<span class='error'>Es ist keine ID angegeben.</span><br>";
		exit;
	}
	
	//Query database for filename, gpg-password, filehoster-urls
	$qres=mysql_query("select * from Uploads where id ='".mysql_real_escape_string($_GET['id'])."'");
	
	
	$res=mysql_fetch_object($qres);
	
	//Result empty?
	if(!$res) {
		echo "Kein Ergebnis vorhanden.";
		exit;
	}
?>
<p>Es kann einige Minuten dauern bis die Links zur Verf&uuml;gung stehen.</p>
<style>
<!--
table {
	width:100%;
}
table tr {
	margin: 0 50% 0 50%;
}
table tr td {
	width:50%;
}
-->
</style>
	<table>
		<tr>
			<th>Eigenschaft</th>
			<th>Wert</th>
		</tr>
		<tr>
			<td>Dateiname</td>
			<td><?php echo htmlentities($res->filename); ?></td>
		</tr>
		<tr>
			<td>GPG-Passwort</td>
			<td><?php echo htmlentities($res->gpg_pass); ?></td>
		</tr>
		<tr>
			<td>Go4Up</td>
			<td><a href='<?php echo htmlentities($res->go4up); ?>' ><?php echo htmlentities($res->go4up); ?></a></td>
		</tr>
		<tr>
			<td>Multiupload</td>
			<td><a href='<?php echo htmlentities($res->multiupload); ?>'><?php echo htmlentities($res->multiupload); ?></a></td>
		</tr>
		<tr>
			<td>Rapidshare</td>
			<td><a href='<?php echo htmlentities($res->rapidshare); ?>'><?php echo htmlentities($res->rapidshare); ?></a></td>
		</tr>
	</table>