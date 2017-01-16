<?php
	session_start();
	if ($_GET['$set']==1){
		$_SESSION['username']=htmlspecialchars($_POST['Givename']);
	header('Location: /');
	}
	else{
		session_unset();
		header('Location: /');
	}
?>