<?php
 	include 'dbjson.php';
 	$login = new Letslogin();
	$login->login($_POST['username'],$_POST['password']);
 ?> 
