<?php
/**
 * Exclude of the exception classes for PasswordGenerator-class
 * @author gehaxelt
 */
if(!class_exists("NotAnIntegerExeception")) {
	class NotAnIntegerExeception extends Exception { }
}
if(!class_exists("NotABooleanExeception")) {
	class NotABooleanExeception extends Exception { }
}
if(!class_exists("PasswordTooShortExeception")) {
	class PasswordTooShortExeception extends Exception { }
}
if(!class_exists("NoCharactersetDefined")) {
	class NoCharactersetDefined extends Exception { }
}

?>