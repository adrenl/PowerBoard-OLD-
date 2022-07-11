<?php
	$title=array(0=>'');
	include 'source/parse_tpl.php';
	defined('IN_PB') or exit('Access Denied');
	$_G=array(
		'config'=>unserialize(file('config.php')[1]),
	);
	define('PB_NAME','PowerBoard');
	define('PB_VERSION','0.1');
	define('PB_PHPEXIT','<?php exit();?>');
	define('PB_TD','Y-m-d H:i:s');
	define('PB_TD_YMD','Y-m-d');
	session_name('PowerBoard_');
	session_start();
	function ERRORDO($errno,$errstr,$errfile,$errline){
		$level=array(2=>'WARNING',8=>'NOTICE',256=>'USER_ERROR',512=>'USER_WARNING',1024=>'USER_NOTICE',4096=>'RECOVERABLE_ERROR',8191=>'ALL');
		$errorcode=file($errfile)[$errline-1];
		echo "
<!DOCTYPE html>
<html>
	<head>
		<title>".PB_NAME."出现错误！</title>
	</head>
	<body style='font-size:12px;'>
		<table border='1'>
			<tr><td colspan='2' style='text-align:center;'>错误详细信息</td></tr>
			<tr><td>级别</td><td>{$errno}=>{$level[$errno]}</td></tr>
			<tr><td>原因</td><td>{$errstr}</td></tr>
			<tr><td>文件</td><td>{$errfile}</td></tr>
			<tr><td>行数</td><td>{$errline}</td></tr>
			<tr><td>代码</td><td>".htmlspecialchars($errorcode)."</td></tr>
		</table>
	</body>
</html>
		";
		file_put_contents('errorlogs/'.date(PB_TD_YMD).'.log',"一个错误发生在".date(PB_TD)."
级别：{$errno}=>{$level[$errno]}
原因：{$errstr}
文件：{$errfile}
行数：{$errline}
代码：{$errorcode}
---------------------分割---------------------
",FILE_APPEND);
		die();
	}
	set_error_handler('ERRORDO');
	function lang($file='common',$langvar=null,$replace=array()){
		global $_G;
		include 'files/lang/lang_'.$file.'.php';
		if(!isset($_G['lang'][$file])){
			$_G['lang'][$file]=$lang;
		}
		if($replace && is_array($replace)){
			foreach($replace as $key=>$value){
				$searchs[]='{'.$key.'}';
				$replaces[]=$value;
			}
			$return=str_replace($searchs,$replaces,$lang);
		}
		return $langvar==null?(isset($return)?$return:$lang):(isset($return)?$return[$langvar]:$lang[$langvar]);
	}
	lang();
	function strfilter($string){
		return trim(htmlspecialchars($string));
	}
	function islogin(){
		if(!isset($_SESSION['user'])){
			return false;
		}else{
			return true;
		}
	}
	function POST($key=-99,$filter=true){
		if($key==-99){
			return $filter?array_map('strfilter',$_POST):$_POST;
		}else{
			if(isset($_POST[$key])){
				return $filter?strfilter($_POST[$key]):$_POST[$key];
			}else{
				return null;
			}
		}
	}
	function GET($key=-99,$filter=true){
		if($key==-99){
			return $filter?array_map('strfilter',$_GET):$_GET;
		}else{
			if(isset($_GET[$key])){
				return $filter?strfilter($_GET[$key]):$_GET[$key];
			}else{
				return null;
			}
		}
	}
	function strlen_($string,$nohtml=false){
		if($nohtml){
			$string=strip_tags($string);
			$string=str_ireplace(' ','',$string);
			$string=str_ireplace('\n','',$string);
			$string=str_ireplace('\r','',$string);
		}
		return function_exists('mb_strlen')?mb_strlen($string):strlen($string);
	}
	function substr_($string,$offset,$length=null){
		return function_exists('mb_substr')?mb_substr($string,$offset,$length):substr($string,$offset,$length);
	}
	function tpl($tplname,$tplid='default'){
		global $_G;
		if(!file_exists('template/'.$tplid.'/')){
			user_error('Template not found:'.$tplname);
		}
		if(!file_exists('template/'.$tplid.'/'.$tplname.'.html')){
			$tplid='default';
		}
		$html='template/'.$tplid.'/'.$tplname.'.html';
		$temp='data/cache/template/'.$tplid.'_'.basename($html,'.html').'.php';
		if(!file_exists($temp) or filemtime($temp)<filemtime($html)){
			parse_tpl($tplname,$tplid);
		}

		$csstemp='data/cache/template/css_'.$tplid.'.css';
		$css='template/'.$tplid.'/common.css';
		if(!file_exists($csstemp) or filemtime($csstemp)<filemtime($css)){
			$csscon=file_get_contents($css);
			$csscon=str_replace('{IMGDIR}',$_G['config']['bburl'].'files/imgs/',$csscon);
			file_put_contents($csstemp,$csscon);
			touch($csstemp,filemtime($css));
		}

		return $temp;
	}
	function msg($message,$url='',$replace=array(),$options=array()){
		global $_G,$title;
		lang('message');
		$title[0]=$_G['lang']['common']['tipsmessage'];
		if(isset($_G['lang']['message'][$message])){
			$message=$_G['lang']['message'][$message];
		}
		if($replace){
			foreach($replace as $key=>$value){
				$message=str_replace('{'.$key.'}',$value,$message);
			}
		}
		if(!$url){
			!isset($options['return'])?$options['return']=true:'';
		}else{
			$message.='<script>setTimeout(\'document.location="'.$url.'"\',4000);</script>';
		}
		!isset($options['return'])?$options['return']=false:'';
		include tpl('message');
		exit;
	}
	function r(){
		return 'r_'.time().rand(0,9999);
	}
?>