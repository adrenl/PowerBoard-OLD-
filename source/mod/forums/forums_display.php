<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	$posts=array();
	$arid=gpcget('arid');
	$fid=gpcget('fid');
	if(!@array_key_exists($arid,$_G['config']['forums']) || !@array_key_exists($fid,$_G['config']['forums'][$arid]['area'])){
		msg('forum_no_exists');
	}
	$dir=POWERBOARD_ROOT."data/forums/{$arid}/{$fid}/";
	if(!file_exists($dir)){
		mkdir($dir,0777,true);
	}
	include libfile('functions/post');
	$navtitle=$_G['config']['forums'][$arid]['name'].' - '.$_G['config']['forums'][$arid]['area'][$fid]['name'];
	//$index=@unserialize(@file($dir.'index.php')[1]);
	$index=@readindex($dir.'index.php');
	for($i=$index['totaltopic'];$i>0;$i--){
		$p=@getpost($arid,$fid,$i,1);
		if($p==false) continue;
		$posts['p'][$i]=$p;
	}
	include template('forums/display');
?>