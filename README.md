CryptUp - A small backup service
===========================

1. Features
2. Requirements
3. Installation

***Please note:*** This is just a quick-and-dirty project. You may need to edit the source code.***

##1. Features##
CryptUp is a small backup service for uploading gpg encrypted file to different file hosters.

It is based on a mysql-database, gpg and [plowshare](http://code.google.com/p/plowshare/wiki/Readme)

Features:
- Uploads files in the background
- Generates random download-link
- Generates random delete-link
- It uploads to go4up, multiupload and rapidshare (if login credentials are given)

##2. Requirements##

This software requires the following programs to be installed on the host system.

###2.1Plowshare###

First you have to install [plowshare](http://code.google.com/p/plowshare/wiki/Readme):

	git clone https://code.google.com/p/plowshare/ && cd plowshare && sudo ./setup.sh install

This should install the plowshare shell scripts into the following directory:

	/usr/local/bin/


###2.2GPG###

Normally gpg should be installed on the host system. If not, install it with the following command:

	sudo apt-get install gnupg

##3. Installation##

###3.1.Clone this repository###

	git clone https://github.com/gehaxelt/PHP-CryptUp.git

###3.2.Configure it###
	
Rename config.example.php to config.php and edit the mysql access.

	cd PHP-CryptUp
	mv config.example.php config.php
	nano config.php

Optionally you have to correct the pathes to the binaries.
Feel free to edit the SALT-/GPG-password length.

Create a new database for CryptUp and also the table. 

	mysql -u [USER] -p 
	mysql> Create Database CryptUp;
	mysql> Create Table CryptUp.Uploads ( id varchar(32), gpg_pass varchar(25), filename varchar(255), go4up varchar(255), multiupload varchar(255), rapidshare varchar(255) );
	mysql> exit;

If you chose other database or table names, then you have to edit the config.php file again.

Edit your php.ini to increase the upload_max_file_size-limit:

	sudo nano /etc/php5/cgi/php.ini

Search for "upload_max_file_size" and set it to 20M.

At least you have to adjust chmod for the uploads-directory:

	chmod 755 uploads

Now everything should be configured and it should work fine.

