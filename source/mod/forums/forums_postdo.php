<?php
	/**
		File name:forums_postdo.php
		Last upload date:2022/7/9
		By:NewAdryKB
		Powered by PowerBoard
	**/
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	include libfile('functions/post');
	$action=gpcget('action');
	$arid=gpcget('arid');
	$fid=gpcget('fid');
	$pid=gpcget('pid');
	$floor=gpcget('floor');
	if(!in_array($action,array('newtopic','newreply','editpost','deletepost','preview'))){
		header('location: '.$_G['siteurl']);
	}
	if(gpcget('submit')=='yes'){
		$content=gpcget('editor_content');
		$title=gpcget('title');
		$by=$_G['user']['username'];
		$floor=gpcget('floor');
		$readlevel=gpcget('readlevel');
		$disable_bbcode=gpcget('disable_bbcode');
		$disable_smilies=gpcget('disable_smilies');
		$delete_post=gpcget('delete_post');
		if($action=='newtopic'){
			//submitcheck(gpcget('secode'));
			newpost($arid,$fid,$title,$content,$by,$action,null,null,$readlevel,$disable_bbcode,$disable_smilies);
		}elseif($action=='newreply'){
			submitcheck(gpcget('secode'));
			newpost($arid,$fid,$title,$content,$by,$action,$pid,$floor,0,$disable_bbcode,$disable_smilies);
		}elseif($action=='editpost'){
			editpost($arid,$fid,$title,$content,$by,$pid,$floor,$readlevel,$disable_bbcode,$disable_smilies,$delete_post);
		}
	}else{
		$navtitle=lang('common','newtopic');
		if($action=='editpost'){
			$navtitle=lang('common','post_edit');
			$post=getpost($arid,$fid,$pid,$floor,false);
			$post['content']=htmlspecialchars_decode($post['content']);
		}elseif($action=='newreply'){
			$navtitle=lang('common','newreply');
		}
		include template('forums/postdo');
	}
?>