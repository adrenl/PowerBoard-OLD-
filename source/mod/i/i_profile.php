<?php
	$navtitle=lang('common','myself_profile');
	$user=gpcget('user');
	if(!$user){
		$user=$_G['user']['uid'];
	}
	if(!$profile=@getuserprofile($user)){
		if(!$profile=@getuserprofile($user,true)){
			msg('user_login_isntexists',null,array('USERNAME'=>$username));
		}
	}
	$profile['regtime']=_date(0,$profile['regtime']);
	$profile['lastlogintime']=_date(0,$profile['lastlogintime']);
	include template('i/profile');
?>