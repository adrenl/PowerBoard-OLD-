<?php
	if(!defined('IN_POWERBOARD')) {
		exit('Access Denied');
	}
	function menuitem($cplangvar,$mod,$toid){
		global $cplang;
		return "<a style=\"display:block;margin:3px 0px;\" href=\"admin.php?mod={$mod}#{$toid}\">".($cplang[$cplangvar]?$cplang[$cplangvar]:$cplangvar)."</a>";
	}
	function showinput($type='text',$name='',$id='',$value=''){
		global $cplang;
		if($cplang[$value] && ($value!='text' || $value!='password' || $value!='mail' || $value!='number' || $value!='date' || $value!='search')){
			$value=$cplang[$value];
		}
		return "<input type=\"{$type}\" name=\"{$name}\" id=\"{$id}\" value=\"{$value}\">";
	}
	function showradio($name='',$whichchecked='',$title=array('true','false'),$value=array()){
		global $cplang;
		if(gettype($whichchecked)=='boolean'){$whichchecked=booleantostr($whichchecked);}
		$return="";
		foreach($title as $k=>$v){
			$return.="<input type=\"radio\" name=\"{$name}\" value=\"".($value?$value[$k]:$v)."\"".($whichchecked==$v?' checked':'').">".($cplang[$v]?$cplang[$v]:$v).'&nbsp;';
		}
		return $return;
	}
	function showcheckbox($name='',$whichchecked='',$title=array(),$value=array()){
		global $cplang;
		if(gettype($whichchecked)=='boolean'){$whichchecked=booleantostr($whichchecked);}
		$return="";
		foreach($title as $v){
			$return="<input type=\"checkbox\" name=\"{$name}\"".($whichchecked==$v?' checked':'').">".($cplang[$v]?$cplang[$v]:$v).'&nbsp;';
		}
		return $return;
	}
	function showselect(){
	}
	function showtextarea($name='',$id='',$value=''){
		return "<textarea name=\"{$name}\">{$value}</textarea>";
	}
	function amsg($message,$url='',$replace=array(),$options=array()){
		global $cplang;
		$lang=lang('admin_msg');
		if(isset($lang[$message])){
			$message=$lang[$message];
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
		echo '
<div class="div_father">
	<div class="div_title">'.$cplang['tipsmessage'].'</div>
	<div class="div_content">
		'.$message.'<br><br>
		'.($url?'<a href="'.$url.'">'.$url.'</a>':'').'
		'.($options['return']?'<a href="javascript:;" onclick="history.go(-1);">'.$cplang['back'].'</a>':'').'
	</div>
</div>
		';
		exit;
	}
	function alogin(){
	}
	function aexit(){
	}
?>