<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<form method="post" action="forums.php?mod=postdo&action=<?php echo $action;?>&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>&pid=<?php echo $pid;?>&floor=<?php echo $floor;?>&submit=yes" onsubmit="return postcheck($('title').value,$('editor_textarea').value,<?php echo $_G['config']['post']['len']['title_max'];?>,<?php echo $_G['config']['post']['len']['title_min'];?>,<?php echo $_G['config']['post']['len']['content_max'];?>,<?php echo $_G['config']['post']['len']['content_min'];?>);" enctype="multipart/form-data">
	<script src="files/javascript/post.js"></script>
	<script>var action='<?php echo $action;?>';var floor='<?php echo $floor;?>';</script>
	<span <?php echo $action=='newreply' || $floor>1  ?"style='display:none'":''?>> 标题:<input type="text" name="title" class="w95" id="title" value="<?php echo $post['title'];?>"></span>
	<?php $EDITOR['minlength']=$_G['config']['post']['len']['content_min']; ?>
	<?php $EDITOR['maxlength']=$_G['config']['post']['len']['content_max']; ?>
	<?php $EDITOR['content']=$post['content']; ?>
	<?php $EDITOR['attachmentlist']=$attachmentlist; ?>
	<?php include template('editor/editor','default');?>
	<input type="checkbox" name="disable_bbcode" value="1" <?php if($post['disable_bbcode']==1){ ?>checked<?php } ?>>禁用BBCode
	<input type="checkbox" name="disable_smilies" value="1" <?php if($post['disable_smilies']==1){ ?>checked<?php } ?>>禁用表情
	<?php if($action!='newreply'){ ?>&nbsp;阅读级别 <input type="number" name="readlevel" min="0" class="wnunberi" value="<?php echo $post['readlevel'];?>"><?php } ?>
	<?php if($action=='editpost'){ ?><br><input type="checkbox" name="delete_post" value="1">删除帖子 (勾选后并提交，你的帖子将会被删除) <?php } ?>
	<?php if($action=='newtopic' || $action=='newreply'){ ?>
		<br>验证码: 
<!--sub:common/seccheck-->
<?php $tpl_sec_url=$_G['config']['bburl'].'misc.php?mod=secode'; ?>
<?php $tpl_sec_id='secode_'.rand(0,3276); ?>
<?php if($_G['config']['secode']['type']==0 || $_G['config']['secode']['type']==2){ ?>
	<input type="text" name="secode" id="secode" required>&nbsp;<img src="<?php echo $tpl_sec_url;?>" id="<?php echo $tpl_sec_id;?>">&nbsp;<a href="javascript:;" onclick="$('<?php echo $tpl_sec_id;?>').src='<?php echo $tpl_sec_url;?>&'+Math.random()">刷新验证码</a>

<?php }else{ ?>
	<input type="text" name="secode" id="secode" required>&nbsp;<audio type="audio/mpeg" src="<?php echo $tpl_sec_url;?>" id="<?php echo $tpl_sec_id;?>"></audio><a href="javascript:;" onclick="$('<?php echo $tpl_sec_id;?>').src='<?php echo $tpl_sec_url;?>&'+Math.random()">刷新验证码</a> <a href="javascript:;" onclick="$('<?php echo $tpl_sec_id;?>').play();">播放</a>
<?php } ?>
<!--endsub:common/seccheck-->
<br>
	<?php } ?>
	<p class="center"><input type="submit" class="submitbtn" value="提交"></p>
</form>
<?php include template('common/footer','default');?>