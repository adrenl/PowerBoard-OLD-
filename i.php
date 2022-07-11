<?php
	require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	$mods=array('profile','settings');
	in_array(gpcget('mod'),$mods)?include 'source/mod/i/i_'.gpcget('mod').'.php':msg('submit_no_validate');
?>