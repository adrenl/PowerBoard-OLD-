<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	$navtitle=lang('common','login');
	if(gpcget('submit')=='yes'){
		on_login();
	}else{
		include template('user/login');
	}
?>