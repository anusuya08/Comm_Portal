<?php
spl_autoload_register(function ($class_name) {
    //include 'c:/wamp64/www/'.$class_name . '.php';
	include $_SERVER['DOCUMENT_ROOT'] . "/www/" .$class_name . '.php';
});
?>