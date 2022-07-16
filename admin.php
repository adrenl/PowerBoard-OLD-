<?php
	require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	$cplang=lang('admin');
	include libfile('functions/admin');
	$mod=gpcget('mod');
	if(!$_SESSION['in_cp']){
		$mod='login';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="admin/admin.css">
	</head>
	<body>
		<div class="column_l"><?php include 'admin/admin_left_menu.php';?></div>
		<div class="column_r"><?php include 'admin/admin_'.$mod.'.php';?></div>
	</body>
</html>