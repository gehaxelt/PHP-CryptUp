<?php
	/**
		MySQL Database 
	 */
	$DB_HOST="localhost";
	$DB_USER="root";
	$DB_PW="";
	$DB_NAME="CryptUp";
	//Create Database: create database CryptUp;
	//Create Table:  create table CryptUp.Uploads ( id varchar(32), gpg_pass varchar(25), filename varchar(255), go4up varchar(255), multiupload varchar(255), mirrorcreator varchar(255) );
	mysql_connect($DB_HOST,$DB_USER,$DB_PW);
	mysql_select_db($DB_NAME);
	
	/**
	 	GPG-Crypt-Settings
	 */
	$GPG_BIN="/usr/bin/gpg";
	$GPG_PASS_LENGTH=25;
	
	/**
	 	Hash-Settings
	 */
	$SALT_LENGTH=10;
	$PEPPER= "_random_string_here";
	
	/**
	 	PHP-Bin
	 */
	$PHP_BIN="/usr/bin/php";
	
	/**
	 	Upload-Settings
	 */
	$PLOWUP_BIN="/usr/local/bin/plowup";
	$MAX_FILE_SIZE=20; //in MB - also have to be set in the php.in (upload_max_file_size=20M)
	
	/**
	 	Rapidshare login credentials
	 */
	$RS_USER=""; //username
	$RS_PW=""; //password
	
	//Debug? Should be disabled on productiv systems.
	ini_set('display_errors','Off');
?>