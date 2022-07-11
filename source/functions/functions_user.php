<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	function on_register(){
		global $_G;
		$username=removepath(gpcget('username'));
		$password=gpcget('password');
		$email=gpcget('email');
		$secode=gpcget('secode');
		$dir=POWERBOARD_ROOT.'data/user/';
		$index=readindex($dir.'index.php',array('total'=>0,'lastuid'=>0,'lastnew'=>''));
		$newuid=&$index['lastuid'];
		if(!$username or !$password or !$email or !$secode){
			msg('no_all_fill');
		}
		submitcheck($secode);
		if(getuserexists($username)){
			msg('user_reg_isexists',null,array('USERNAME'=>$username));
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			msg('user_email_invalid');
		}
		if(_strlen($username)<$_G['config']['user']['len']['name_min'] || _strlen($username)>$_G['config']['user']['len']['name_max']){
			msg('user_namelen_invalid');
		}
		if(_strlen($password)<$_G['config']['user']['len']['password_min'] || _strlen($password)>$_G['config']['user']['len']['password_max']){
			msg('uaer_passwordlen_invalid');
		}
		$newuid++;
		$index['total']++;
		$profile=array('uid'=>$newuid,'username'=>$username,'password'=>authcode($password,'ENCODE'),'email'=>$email,'regtime'=>TIMESTAMP,'lastlogintime'=>TIMESTAMP);
		mkdir($dir.$newuid.';;'.$username);
		writeindex($dir.$newuid.';;'.$username.'/profile.php',$profile);
		$index['lastnew']=$username;
		writeindex($dir.'index.php',$index);
		msg('register_success','user.php?mod=login');
	}
	function on_login(){
		global $_G;
		$username=removepath(gpcget('username'));
		$password=gpcget('password');
		$secode=gpcget('secode');
		$cookietime=gpcget('cookietime');
		$howlogin=strtoboolean(gpcget('howlogin'));
		if(!$username or !$password or !$secode){
			msg('no_all_fill');
		}
		submitcheck($secode);
		if(!getuserexists($username,$howlogin)){
			msg('user_login_isntexists',null,array('USERNAME'=>$username));
		}
		$profile=getuserprofile($username,$howlogin);
		if(authcode($profile['password'])!=$password){
			msg('user_password_error');
		}
		$profile['lastlogintime']=TIMESTAMP;
		writeuserprofile($username,$profile,$howlogin);
		_setcookie(session_name(),session_id(),$cookietime);
		$_SESSION['password']=$profile['password'];
		$_SESSION['uid']=$profile['uid'];
		$_G['user']=$profile;
		msg('login_success',$_G['siteurl'],array('USERNAME'=>$_G['user']['username']));
	}
	function on_loginout(){
		$_SESSION=array();
		_setcookie(session_name(),"",-1);
		session_destroy();
	}

	function upload_avatar(){
		global $_G;
		$config=$_G['config']['file']['avatar'];
		if($_FILES['avatar']['error']==4){
			msg('file_no_upload');
		}
		if($_FILES['avatar']['error']>0){
			msg('file_upload_error',null,array('ERRCODE'=>$_FILES['avatar']['error']));
		}
		if($_FILES['avatar']['size']>$config['max_size']){
			msg('avatar_too_big',null,array('MAXSIZE'=>sizecount($config['max_size']),'AVATARSIZE'=>sizecount($_FILES['avatar']['size'])));
		}
		if(!in_array(strtolower(pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION)),$config['file_type'])){
			msg('avatar_file_invaild',null,array('FILETYPE'=>implode(',',$config['file_type'])));
		}
		$newavatar=POWERBOARD_ROOT.'data/avatar/'.$_G['user']['uid'].'.jpg';
		move_uploaded_file($_FILES['avatar']['tmp_name'],$newavatar);
		$image=imagecreatefromunknow($newavatar);
		$imageto=imagecreatetruecolor(48,48);
		imagefill($imageto,0,0,imagecolorallocate($imageto,255,255,255));
		imagecopyresampled($imageto,$image,0,0,0,0,48,48,imagesx($image),imagesy($image));
		imagejpeg($imageto,$newavatar,100);
		imagedestroy($imageto);
		imagedestroy($image);
		msg('avatar_success','i.php?mod=settings&do=avatar',array('NEWAVATAR'=>avatar($_G['user']['uid'])));
	}
	function update_profile(){
	}
?>