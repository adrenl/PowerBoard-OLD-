<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	$navtitle=lang('common','register');
	if(gpcget('submit')=='yes'){
		on_register();
	}else{
		include template('user/register');
	}
?>