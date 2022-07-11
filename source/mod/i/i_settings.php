<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	include libfile('functions/user');
	$do=gpcget('do');
	if($do=='basic'){
		if(gpcget('submit')=='yes'){
			updata_profile();
		}else{
			include template('i/settings_basic');
		}
	}elseif($do=='avatar'){
		if(gpcget('submit')=='yes'){
			upload_avatar();
		}else{
			include template('i/settings_avatar');
		}
	}
?>