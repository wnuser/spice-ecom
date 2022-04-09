<?php
    session_start();
    include("includes/config.php");
	$_SESSION["username"] = "";
	session_destroy();
	echo "<script>window.location.href='index.php';</script>";
?>