<?php
	class application{
		public function init(){
			session_name("SID");
			session_start();
			$this->init_vars();
			$this->init_user();
			set_error_handler(array($this,'init_error'));
		}
		public function init_vars(){
			global $_G;
			define('IN_POWERBOARD',true);
			define('PHP_DIE','<?php die();?>');
			define('POWERBOARD_ROOT',substr(dirname(__FILE__),0,-16));
			require POWERBOARD_ROOT.'source/functions/functions_base.php';
			require POWERBOARD_ROOT.'config.php';
			define('IN_MOBILE',is_mobile());
			define('TIMESTAMP',time());
			define('MB_ENABLE',function_exists('mb_convert_encoding'));
			define('GZIP_ENABLE',function_exists('ob_gzhandler'));
			$_G=array(
				'PHP_SELF'=>htmlspecialchars($this->_get_script_url()),
				'siteurl'=>'',
				'siteroot'=>'',
				'siteport'=>'',
				'config'=>$config,
				'user'=>array(),
				'lang'=>array()
			);
			unset($config);
			$_G['isHTTPS']=$this->_is_https();
			$_G['scheme']='http'.($_G['isHTTPS']?'s':'');
			$sitepath=substr($_G['PHP_SELF'],0,strrpos($_G['PHP_SELF'],'/'));
			$_G['siteurl']=htmlspecialchars($_G['scheme'].'://'.$_SERVER['HTTP_HOST'].$sitepath.'/');
			$url=parse_url($_G['siteurl']);
			$_G['siteroot']=isset($url['path'])?$url['path'] : '';
			$_G['siteport']=empty($_SERVER['SERVER_PORT']) || $_SERVER['SERVER_PORT']=='80' || $_SERVER['SERVER_PORT']=='443'?'': ':'.$_SERVER['SERVER_PORT'];
			
		}
		public function init_user(){
			global $_G;
			if(isset($_SESSION['password']) && isset($_SESSION['uid'])){
				$profile=getuserprofile($_SESSION['uid'],true);
				if($profile['password']==$_SESSION['password']){
					$_G['user']=$profile;
				}
			}
		}
		public function init_error($errno,$errstr,$errfile,$errline){
			if($errno==8) return;
			$level=array(2=>'WARNING',8=>'NOTICE',256=>'USER_ERROR',512=>'USER_WARNING',1024=>'USER_NOTICE',4096=>'RECOVERABLE_ERROR',8191=>'ALL');
			$errcode=htmlspecialchars(file($errfile)[$errline-1]);
			$echo= <<<EOF
<!DOCTYPE html>
<html>
	<head>
		<title>PowerBoard System Error</title>
	</head>
	<body style="background-color:#0000FF;color:#FFFFFF;font-family:System;">
		<ul>
			<li>Error Level:$errno=>$level[$errno]</li>
			<li>Message:$errstr</li>
			<li>File:$errfile</li>
			<li>Line:$errline</li>
			<li>Code:$errcode</li>
	</body>
</html>
EOF;
			echo $echo;
			die();
		}
		private function _get_script_url(){
			if(!isset($this->var['PHP_SELF'])){
				$scriptName = basename($_SERVER['SCRIPT_FILENAME']);
				if(basename($_SERVER['SCRIPT_NAME'])===$scriptName){
					$this->var['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];
				} else if(basename($_SERVER['PHP_SELF'])===$scriptName){
					$this->var['PHP_SELF'] = $_SERVER['PHP_SELF'];
				} else if(isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $scriptName){
					$this->var['PHP_SELF'] = $_SERVER['ORIG_SCRIPT_NAME'];
				} else if(($pos = strpos($_SERVER['PHP_SELF'],'/'.$scriptName)) !== false) {
					$this->var['PHP_SELF'] = substr($_SERVER['SCRIPT_NAME'],0,$pos).'/'.$scriptName;
				} else if(isset($_SERVER['DOCUMENT_ROOT']) && strpos($_SERVER['SCRIPT_FILENAME'],$_SERVER['DOCUMENT_ROOT']) === 0){
					$this->var['PHP_SELF'] = str_replace('\\','/',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
					$this->var['PHP_SELF'][0] != '/' && $this->var['PHP_SELF'] = '/'.$this->var['PHP_SELF'];
				} else {
					system_error('request_tainting');
				}
			}
			return $this->var['PHP_SELF'];
		}
		private function _is_https(){
			if(isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])!='off'){
				return true;
			}
			if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO'])=='https'){
				return true;
			}
			if(isset($_SERVER['HTTP_X_CLIENT_SCHEME']) && strtolower($_SERVER['HTTP_X_CLIENT_SCHEME'])=='https'){
				return true;
			}
			if(isset($_SERVER['HTTP_FROM_HTTPS']) && strtolower($_SERVER['HTTP_FROM_HTTPS'])!='off'){
				return true;
			}
			if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']==443){
				return true;
			}
			return false;
		}
	}
?>