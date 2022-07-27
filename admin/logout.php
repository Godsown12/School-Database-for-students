<?php
	include 'include/header.php';
	unset($_SESSION['login']);
	header("Location: login.php");
?>