<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	include libfile('functions/post');
	$arid=gpcget('arid');
	$fid=gpcget('fid');
	$pid=gpcget('pid');
	$dir=POWERBOARD_ROOT."data/forums/{$arid}/{$fid}/{$pid}/";
	if(!file_exists($dir)){
		msg('post_no_exists');
	}
	$floors=array();
	$index=@unserialize(file($dir.'index.php')[1]);
	for($i=1;$i<=$index['lastfloor'];$i++){
		$p=getpost($arid,$fid,$pid,$i);
		if(!$p) continue;
		$floors['f'][$i]=$p;
	}
	$navtitle=lang('common','topic').' - '.$floors['f'][1]['title'];
	include template('forums/view');
?>