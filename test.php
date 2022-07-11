<?php
	require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	include template('test');
?>