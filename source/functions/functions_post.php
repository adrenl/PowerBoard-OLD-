<?php
	/**
		File name:functions_post.php
		Last upload date:2022/7/9
		By:NewAdryKB
		Powered by PowerBoard
	**/
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	include libfile('functions/bbcode');
	function checkpost($title,$content,$type){
		global $_G;
		if($type==1 || $type=='newtopic'){
			if(_strlen($title)<$_G['config']['post']['len']['title_min'] || _strlen($title)>$_G['config']['post']['len']['title_max']){
				msg('post_title_len_too',null,array('MINLEN'=>$_G['config']['post']['len']['title_min'],'MAXLEN'=>$_G['config']['post']['len']['title_max']));
			}
		}
		if(_strlen($content)<$_G['config']['post']['len']['content_min'] || _strlen($content)>$_G['config']['post']['len']['content_max']){
			msg('post_content_len_too',null,array('MINLEN'=>$_G['config']['post']['len']['content_min'],'MAXLEN'=>$_G['config']['post']['len']['content_max']));
		}
		return true;
	}
	function newpost($arid,$fid,$title,$content,$by,$type="newtopic",$pid=null,$floor=null,$readlevel=0,$disable_bbcode=0,$disable_smilies=0){
		checkpost($title,$content,$type);
		if(getuserexists($by)==false){
			msg('user_login_isntexists',null,array('USERNAME'=>$by));
		}
		$dir=POWERBOARD_ROOT."data/forums/{$arid}/{$fid}/";
		$index=readindex($dir.'index.php',array('totaltopic'=>0,'totalpost'=>0,'today'=>0,'lastpid'=>0));
		if($type=='newtopic'){
			$readlevel=$readlevel<0?0:$readlevel;
			$newpid=&$index['lastpid'];
			$newpid++;
			$index['totaltopic']++;
			$index['totalpost']++;
			$newdir=$dir."{$newpid}/";
			mkdir($newdir,0777,true);
			writeindex($newdir.'1.php',array('by'=>$by,'title'=>$title,'content'=>$content,'sendtime'=>TIMESTAMP,'readlevel'=>$readlevel,'disable_bbcode'=>$disable_bbcode,'disable_smilies'=>$disable_smilies)); //topic
			writeindex($newdir.'index.php',array('totalfloor'=>1,'lastfloor'=>1)); //topicindex
			writeindex($dir.'index.php',$index); //forumindex
			msg('post_topic_new_success',"forums.php?mod=view&arid={$arid}&fid={$fid}&pid={$newpid}");
		}else{ //newreply
			$newdir=$dir."{$pid}/";
			$readlevel=0;
			$index2=@unserialize(file($newdir.'index.php')[1]); //Topic index
			$index['totalpost']++;
			$index2['totalfloor']++;
			$index2['lastfloor']++;
			writeindex($newdir.$index2['lastfloor'].'.php',array('by'=>$by,'title'=>$title,'content'=>$content,'sendtime'=>TIMESTAMP,'readlevel'=>$readlevel,'disable_bbcode'=>$disable_bbcode,'disable_smilies'=>$disable_smilies)); //Reply
			writeindex($newdir.'index.php',$index2); //Topic index
			writeindex($dir.'index.php',$index); //Forum index
			msg('post_reply_new_success',"forums.php?mod=view&arid={$arid}&fid={$fid}&pid={$pid}#f".$index2['lastfloor']);
		}
	}
	function editpost($arid,$fid,$title,$content,$by,$pid,$floor=1,$readlevel=0,$disable_bbcode=0,$disable_smilies=0,$delete_post=0){  //$floor==1 topic ; $floor>1 reply
		$file=POWERBOARD_ROOT."data/forums/{$arid}/{$fid}/{$pid}/{$floor}.php";
		if(!file_exists($file)) msg('post_no_exists');
		if($delete_post==1){
			delete_post($arid,$fid,$pid,$floor);
			return;
		}
		$post=getpost($arid,$fid,$pid,$floor);
		checkpost($title,$content,$floor);
		if($floor==1){
			writeindex($file,array('by'=>$post['by'],'title'=>$title,'content'=>$content,'sendtime'=>$post['sendtime'],'readlevel'=>$readlevel,'disable_bbcode'=>$disable_bbcode,'disable_smilies'=>$disable_smilies));
		}else{
			writeindex($file,array('by'=>$post['by'],'title'=>$title,'content'=>$content,'sendtime'=>$post['sendtime'],'disable_bbcode'=>$disable_bbcode,'disable_smilies'=>$disable_smilies));
		}
		msg('post_post_edit_success',"forums.php?mod=view&arid={$arid}&fid={$fid}&pid={$pid}");
	}
	function getpost($arid,$fid,$pid,$floor=1,$bbcode2html=true){
		$file="data/forums/{$arid}/{$fid}/{$pid}/{$floor}.php";
		if(!file_exists($file)) return false;
		$post=@unserialize(preg_replace('/'.preg_quote(PHP_DIE,'/').'[\n\r\t]*/',"",@file_get_contents($file),1));
		if($post==null || $post==false){
			return false;
		}
		if($bbcode2html){
			$post['content']=bbcode2html($post['content'],$post['disable_bbcode'],$post['disable_bbcode'],$post['disable_smilies']);
		}
		$post['profile']=getuserprofile($post['by']);
		return $post;
	}
	function delete_post($arid,$fid,$pid,$floor=1){
		$dir=POWERBOARD_ROOT."data/forums/{$arid}/{$fid}/";
		$index=readindex($dir.'index');
		$index['totalpost']--;
		if($floor==1){
			$index['totaltopic']--;
			_rmdir($dir.$pid);
		}else{
			$index2=readindex($dir.$pid.'/index.php'); //Topic index
			$index['totalfloor']--;
			unlink($dir.$pid.'/'.$floor.'.php');
			writeindex($dir.$pid.'/index.php',$index2); //Topic index
		}
		writeindex($dir.'index.php',$index); //Forum index
		msg('post_delete_success',"forums.php?mod=display&arid={$arid}&fid={$fid}");
	}
	//include libfile('functions/upload');
	//function ckeckUploadAttachment(){
	//	if(($_FILES)!==array() || !empty($_FILES)){
	//		start_upload();
	//	}
	//}
?>