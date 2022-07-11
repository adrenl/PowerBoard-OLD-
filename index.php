<?php
	require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	$navtitle=lang('common','index');
	foreach($_G['config']['forums'] as $aid=>$area){
		$out[$aid]=$area;
	}
	include template('common/index');
?>