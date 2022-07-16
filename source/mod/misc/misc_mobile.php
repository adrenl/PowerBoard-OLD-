<?php
	if(!defined('IN_POWERBOARD')) {
		exit('Access Denied');
	}
	if(defined('IN_MOBILE') && IN_MOBILE==true){
		header('Location: '.$_G['config']['bburl']);
	}
	if(gpcget('view')=='true'){
		define('IN_VIEW',true);
		ob_start();

		$navtitle=lang('common','index');
		foreach($_G['config']['forums'] as $aid=>$area){
			$out[$aid]=$area;
		}
		include template('common/index');
		$content=ob_get_contents();
		ob_end_clean();
		$content=preg_replace_callback('/<a .*?href="(.*?)".*?>/is',function($m){
			return str_replace($m[1],"javascript:;",$m[0]);
		},$content);
		echo $content;
		exit;
	}else{
		$navtitle=lang('common','mobile_view');
		include libfile('functions/QRcode');
		$QRfile='data/cache/mobile_QRcode.png';
		if(!file_exists($QRfile)){
			QRcode::png($_G['config']['bburl'],$QRfile,QR_ECLEVEL_Q,6);
		}
		include template('misc/mobile');
	}
?>