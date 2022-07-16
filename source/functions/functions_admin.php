<?php
	if(!defined('IN_POWERBOARD')) {
		exit('Access Denied');
	}
	function menuitem($cplangvar,$mod,$toid){
		global $cplang;
		return "<a style=\"display:block;margin:3px 0px;\" href=\"admin.php?mod={$mod}#{$toid}\">".($cplang[$cplangvar]?$cplang[$cplangvar]:$cplangvar)."</a>";
	}
	function amsg(){
	}
	function alogin(){
	}
	function aexit(){
	}
?>