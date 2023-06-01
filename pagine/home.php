<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location: ../index.php');
	}
	if($_SESSION["tipologia"]=="compratori"){
		header('location: homeCompratore.php');
	}
	if($_SESSION["tipologia"]=="venditori"){
		header('location: homeVenditore.php');
	}
?>