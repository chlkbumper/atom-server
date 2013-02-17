<?php

	$textFile = $_GET['id'] . ".txt";
	$flacFile = $_GET['id'] . ".flac";

	echo $textFile;
	echo "<br />";
	echo $flacFile;
	
	unlink($textFile);
	unlink($flacFile);

?>