<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	on_loginout();
	msg('loginout_success',$_G['config']['bburl']);
?>