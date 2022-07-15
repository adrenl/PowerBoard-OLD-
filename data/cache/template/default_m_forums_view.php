<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<?php if(is_array($floors['f'])){foreach($floors['f'] as $floor=>$data){ ?>
<div style="padding:4px;background-color:#FFFFFF;">
	<?php if($data['title']){ ?><h3><?php echo $data['title'];?></h3><?php } ?>
	<?=avatar($data['profile']['uid'])?>
	<span class="atpicright smallfont">
		<?php echo $data['by'];?><br>
		<?=_date(0,$data['sendtime'])?>
	</span>
	<span class="fright smallfont">
		<i id="f<?php echo $floor;?>">#<?php echo $floor;?></i>
		<?php if($data['profile']['uid']==$_G['user']['uid']){ ?><br><a href="forums.php?mod=postdo&action=editpost&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>&pid=<?php echo $pid;?>&floor=<?php echo $floor;?>"> 编辑帖子 </a><?php } ?>
	</span>
	<br>
	<?php echo $data['content'];?>
</div>
<br>
<?php } }?>
<a class="ui-btn" href="forums.php?mod=postdo&action=newreply&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>&pid=<?php echo $pid;?>&floor=<?php echo $floor;?>">发表回复</a>
<?php include template('common/footer','default');?>