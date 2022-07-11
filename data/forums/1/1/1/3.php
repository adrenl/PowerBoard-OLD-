<?php die();?>
a:8:{s:2:"by";s:9:"NewAdryKB";s:5:"title";s:0:"";s:7:"content";s:13222:"[code]
&lt;?php
	/**
		File name:functions_base.php
		Last upload date:2022/7/9
		By:NewAdryKB
		Powered by PowerBoard
	**/
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	include_once libfile('version');
	function _strpos($haystack,$needle,$howreturn=false){
		if(empty($haystack)) return false;
		foreach((array)$needle as $v){
			if(strpos($haystack,$v)!==false){
				$return=$howreturn?$v:true;
				return $return;
			}
		}
		return false;
	}
	function strfilter($string){
		return trim(htmlspecialchars($string));
	}
	function removepath($string){
		return str_replace(array('..','/','\\'),&quot;&quot;,$string);
	}
	function gpcget($k,$type='GP',$filter=true){
		$type=strtoupper($type);
		switch($type){
			case 'G':$var=&amp;$_GET;break;
			case 'P':$var=&amp;$_POST;break;
			case 'C':$var=&amp;$_COOKIE;break;
			default:
				if(isset($_GET[$k])){
					$var=&amp;$_GET;
				}else{
					$var=&amp;$_POST;
				}
				break;
			}
		return isset($var[$k])?($filter?strfilter($var[$k]):$var[$k]):NULL;
	}
	function libfile($libname,$folder=''){
		$libpath='source'.$folder;
		if(strstr($libname,'/')){
			list($pre,$name)=explode('/',$libname);
			$path=POWERBOARD_ROOT.&quot;{$libpath}/{$pre}/{$pre}_{$name}&quot;;
		}else{
			$path=POWERBOARD_ROOT.&quot;{$libpath}/{$libname}&quot;;
		}
		return $path.'.php';
	}
	function is_mobile(){
		$list=array('iphone','android','phone','mobile','wap','netfront','java','opera mobi','opera mini','ucweb','windows ce','symbian','series','webos','sony','blackberry','dopod','nokia','samsung','palmsource','xda','pieplus','meizu','midp','cldc','motorola','foma','docomo','up.browser','up.link','blazer','helio','hosin','huawei','novarra','coolpad','webos','techfaith','palmsource','alcatel','amoi','ktouch','nexian','ericsson','philips','sagem','wellcom','bunjalloo','maui','smartphone','iemobile','spice','bird','zte-','longcos','pantech','gionee','portalmmm','jig browser','hiptop','benq','haier','^lct','320x320','240x320','176x220','windows phone');
		$ua=strtolower($_SERVER['HTTP_USER_AGENT']);
		if(_strpos($ua,$list)){
			return true;
		}else{
			return false;
		}
	}
	function lang($file,$langvar=null,$vars=null,$default=null){
		global $_G;
		list($path,$file)=explode('/',$file);
		if(!$file){
			$file=$path;
			$path='';
		}
		$key=$path==''?$file:$path.'_'.$file;
		if(!isset($_G['lang'][$key])){
			include POWERBOARD_ROOT.'files/lang/'.($path==''?'':$path.'/').'lang_'.$file.'.php';
			$_G['lang'][$key]=$lang;
		}
		$returnvalue=&amp;$_G['lang'];
		$return=$langvar!==null?(isset($returnvalue[$key][$langvar])?$returnvalue[$key][$langvar]:null):$returnvalue[$key];
		$return=$return === null?($default!==null?$default:$langvar):$return;
		$searchs=$replaces=array();
		if($vars &amp;&amp; is_array($vars)){
			foreach($vars as $k =&gt; $v){
				$searchs[]='{'.$k.'}';
				$replaces[]=$v;
			}
		}
		if(is_string($return) &amp;&amp; strpos($return,'{_G/')!==false){
			preg_match_all('/\{_G\/(.+?)\}/',$return,$gvar);
			foreach($gvar[0] as $k =&gt; $v){
				$searchs[]=$v;
				$replaces[]=getglobal($gvar[1][$k]);
			}
		}
		$return=str_replace($searchs,$replaces,$return);
		return $return;
	}
	require libfile('functions/template');
	function template($file,$tplid='default'){
		return template_html_parse($file,$tplid);
	}
	function arraytable($array){ //没什么用，仅仅用来DeBug
		$return='&lt;table border=&quot;1&quot; style=&quot;border-collapse:collapse;&quot;&gt;&lt;tr&gt;&lt;th colspan=&quot;2&quot;&gt;Array&lt;/th&gt;&lt;/tr&gt;&lt;tr&gt;&lt;th&gt;Key&lt;/th&gt;&lt;th&gt;Value&lt;/th&gt;&lt;/tr&gt;';
		foreach($array as $key=&gt;$value){
			$return.='&lt;tr&gt;&lt;td&gt;'.print_r($key,true).'&lt;/td&gt;&lt;td&gt;'.(is_array($value)?arraytable($value):print_r($value,true)).'&lt;/td&gt;&lt;/tr&gt;';
		}
		return $return.'&lt;/table&gt;';
	}
	function sr(){	
		return 'r_'.time().rand(0,666).rand(0,123)*5;
	}
	function islogin(){
		return isset($_SESSION['uid'])?true:false;
	}
	function showsecode(){
		global $_G;
		$id=sr();
		$url=$_G['config']['bburl'].'misc.php?mod=secode';
		if($_G['config']['secode']['type']==0 || $_G['config']['secode']['type']==2){
			$return='&lt;input type=&quot;text&quot; name=&quot;secode&quot; required&gt;&amp;nbsp;&lt;img src=&quot;'.$url.'&quot; id=&quot;'.$id.'&quot;&gt;&amp;nbsp;&lt;a href=&quot;javascript:void(0);&quot; onclick=&quot;$(\''.$id.'\').src=\''.$url.'&amp;r=\'+Math.random()&quot;&gt;'.lang('common','refresh_secode').'&lt;/a&gt;';
		}elseif($_G['config']['secode']['type']==1){
			$return='&lt;input type=&quot;text&quot; name=&quot;secode&quot; required&gt;&amp;nbsp;&lt;audio type=&quot;audio/mpeg&quot; src=&quot;'.$url.'&quot; id=&quot;'.$id.'&quot;&gt;&lt;/audio&gt;&amp;nbsp;&lt;a href=&quot;javascript:void(0);&quot; onclick=&quot;$(\''.$id.'\').src=\''.$url.'&amp;r=\'+Math.random()&quot;&gt;'.lang('common','refresh_secode').'&lt;/a&gt; &lt;a href=&quot;javascript:void(0);&quot; onclick=&quot;$(\''.$id.'\').play();&quot;&gt;'.lang('common','play').'&lt;/a&gt;';
		}
		return $return;
	}
	function msg($message,$url='',$replace=array(),$options=array()){
		global $_G,$navtitle;
		lang('message');
		$navtitle=lang('common','tipsmessage');
		if(isset($_G['lang']['message'][$message])){
			$message=$_G['lang']['message'][$message];
		}
		if($replace){
			foreach($replace as $key=&gt;$value){
				$message=str_replace('{'.$key.'}',$value,$message);
			}
		}
		if(!$url){
			!isset($options['return'])?$options['return']=true:'';
		}else{
			$message.='&lt;script&gt;setTimeout(\'document.location=&quot;'.$url.'&quot;\',4000);&lt;/script&gt;';
		}
		!isset($options['return'])?$options['return']=false:'';
		include template('common/message');
		exit;
	}
	function convertip($ip){
		$ipdatafile=POWERBOARD_ROOT.'files/ipdata/tinyipdata.dat';
		static $fp=NULL,$offset=array(),$index=NULL;
		$ipdot=explode('.',$ip);
		$ip=pack('N',ip2long($ip));
		$ipdot[0]=(int)$ipdot[0];
		$ipdot[1]=(int)$ipdot[1];
		if($fp===NULL&amp;&amp;$fp=@fopen($ipdatafile,'rb')){
			$offset=@unpack('Nlen',@fread($fp,4));
			$index=@fread($fp,$offset['len']-4);
		}elseif($fp==FALSE){
			return  '-Invalid IP data file';
		}
		$length=$offset['len']-1028;
		$start=@unpack('Vlen',$index[$ipdot[0]*4].$index[$ipdot[0]*4+1].$index[$ipdot[0]*4+2].$index[$ipdot[0]*4+3]);
		for ($start=$start['len']*8+1024;$start&lt;$length;$start+=8){
			if ($index[$start].$index[$start+1].$index[$start+2].$index[$start+3]&gt;=$ip){
				$index_offset=@unpack('Vlen',$index[$start+4].$index[$start+5].$index[$start+6].&quot;\x0&quot;);
				$index_length=@unpack('Clen',$index[$start+7]);
				break;
			}
		}
		@fseek($fp,$offset['len']+$index_offset['len']-1024);
		if($index_length['len']){
			return '-'.@fread($fp,$index_length['len']);
		}else{
			return '-Unknown';
		}
	}
	function _strlen($string){
		return MB_ENABLE?mb_strlen($string):strlen($string);
	}
	function _substr($string,$offset,$length=null,$dot=&quot;...&quot;){
		return MB_ENABLE?mb_substr($string,$offset,$length).$dot:strlen($string,$offset,$length).$dot;
	}
	function getuserpath($username,$isuid=false){
		$dir=POWERBOARD_ROOT.'data/user/';
		if($isuid){
			return glob($dir.$username.';;*')[0];
		}else{
			return glob($dir.'*;;'.$username)[0];
		}
	}
	function getuserprofile($username,$isuid=false){
		$profile=file(getuserpath($username,$isuid).'/profile.php')[1];
		return $profile?@unserialize($profile):false;
	}
	function getuserexists($username,$isuid=false){
		return getuserpath($username,$isuid)?true:false;
	}
	function writeuserprofile($username,$array,$isuid=false){
		$path=getuserpath($username,$isuid).'/profile.php';
		$profile=file($path)[1];
		$profile=array_replace(@unserialize($profile),$array);
		return file_put_contents($path,PHP_DIE.&quot;\n&quot;.@serialize($profile));
	}
	function avatar($uid,$returnsrc=false){
		$return='data/avatar/'.$uid.'.jpg';
		if(!file_exists($return)){
			$return='files/imgs/default_avatar.jpg';
		}
		return $returnsrc?$return:'&lt;img class=&quot;avatar&quot; src=&quot;'.$return.'&quot; onerror=&quot;this.src=\'files/imgs/default_avatar.jpg\'&quot;&gt;';
	}
	function strtoboolean($string){
		if($string=='true'){
			return true;
		}else{
			return false;
		}
	}
	function submitcheck($secode){
		global $_G;
		if(strtolower($secode)!=$_SESSION['secode']){
			msg('secode_error');
		}
		return true;
	}
	function updatesession(){

	}
	function _setcookie($name,$value=&quot;&quot;,$expires=0,$prefix=true){
		global $_G;
		$expires=$expires&gt;0?TIMESTAMP+$expires:($expires&lt;0?TIMESTAMP-3156300:0);
		if($prefix){
			$name=$_G['config']['cookieprefix'].$name;
		}
		@setcookie($name,$value,$expires);
	}
	function authcode($string,$operation='DECODE',$key='',$expiry=0){
		global $_G;
		$ckey_length = 4;
		$key = md5($key != '' ? $key : $_G['config']['authkey']);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
		$result = '';
		$box = range(0, 255);
		$rndkey = array();
		for($i = 0; $i &lt;= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
		for($j = $i = 0; $i &lt; 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
		for($a = $j = $i = 0; $i &lt; $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() &gt; 0) &amp;&amp; substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	}
	function _date($format=0,$timestamp=null){
		global $_G;
		$timestamp=$timestamp?$timestamp:time();
		switch($format){
			case 0:
				return date($_G['config']['datetime']['format']['full'],$timestamp);
				break;
			case 1:
				return date($_G['config']['datetime']['format']['only_date'],$timestamp);
				break;
			case 2:
				return date($_G['config']['datetime']['format']['only_time'],$timestamp);
				break;
			default:
				return date($format,$timestamp);
		}
	}
	function sizecount($filesize){
		if($filesize&gt;=1073741824){
			$filesize=round($filesize/1073741824*100)/100 .' GB';
		}elseif($filesize&gt;=1048576){
			$filesize=round($filesize/1048576*100)/100 .' MB';
		}elseif($filesize&gt;=1024){
			$filesize=round($filesize/1024*100)/100 .' KB';
		}else{
			$filesize=$filesize.' Bytes';
		}
		return $filesize;
	}
	function imagecreatefromunknow($filename){
		$type=getimagesize($filename);
		switch($type[2]){
			case 1:
				return imagecreatefromgif($filename);
				break;
		    case 2:
				return imagecreatefromjpeg($filename);
				break;
			case 3:
				return imagecreatefrompng($filename);
				break;
			case 6:
				return imagecreatefrombmp($filename);
				break;
			case 15:
				return imagecreatefromwebp($filename);
				break;
		    default:
				return false;
		}
	}
	function checkstring($string,$type=0){
	}
	function makesmiliesjs(){
		global $_G;
		$data=&quot;var smilies_file=new Array();var smilies_key=new Array();&quot;;
		$ss=$_G['config']['smilies'];
		$i=0;
		foreach($ss as $key=&gt;$value){
			$data.=&quot;smilies_file[{$i}]=\&quot;{$value}\&quot;;smilies_key[{$i}]=\&quot;{$key}\&quot;;&quot;;
			$i++;
		}
		file_put_contents(POWERBOARD_ROOT.'data/cache/smilies_var.js',$data);
	}
	function _rmdir($dir){
		$dh=opendir($dir);
		while($file=readdir($dh)){
			if($file!=&quot;.&quot; &amp;&amp; $file!=&quot;..&quot;){
				$fullpath=$dir.&quot;/&quot;.$file;
				if(!is_dir($fullpath)){
					unlink($fullpath);
				}else{
					_rmdir($fullpath);
				}
			}
		}
		closedir($dh);
		if(rmdir($dir)){
			return true;
		}else{
			return false;
		}
	}
	function readindex($file,$default=array()){
		$return=@unserialize(file($file)[1]);
		return $return?$return:$default;
	}
	function writeindex($file,$data=array()){
		return @file_put_contents($file,PHP_DIE.&quot;\n&quot;.@serialize($data));
	}
	function info_attachment($aid){ //array|int $aid
		$index=readindex('data/attachment/index.php');
		if(is_array($aid)){
			foreach($aid as $v){
				$v=intval($v);
				$return[$v]=$index[$v];
			}
			return $return;
		}else{
			$aid=intval($aid);
			return $index[$aid];
		}
	}
?&gt;[/code]";s:8:"sendtime";i:1657527003;s:9:"readlevel";i:0;s:14:"disable_bbcode";N;s:15:"disable_smilies";N;s:13:"useattachment";N;}