<?php
	require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	include libfile('functions/user');
	$mods=array('register','login','findpassword','exit');
	in_array(gpcget('mod'),$mods)?include 'source/mod/user/user_'.gpcget('mod').'.php':msg('submit_no_validate');
?>