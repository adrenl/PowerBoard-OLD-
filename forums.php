<?php
	/**
		File name:forums.php
		Last upload date:2022/7/10
		By:NewAdryKB
		Powered by PowerBoard
	**/
	require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	$mods=array('display','view','postdo','ajaxupload');
	in_array(gpcget('mod'),$mods)?include 'source/mod/forums/forums_'.gpcget('mod').'.php':msg('submit_no_validate');
?>