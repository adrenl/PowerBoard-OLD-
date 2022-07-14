<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<?php $thisarea=$_G['config']['forums'][$arid] ?>
<?php $thisforum=$thisarea['area'][$fid] ?>
<a href="forums.php?mod=postdo&action=newtopic&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>" class="ui-btn">发表主题</a>
<ul data-role="listview">
	<?php if(!@array_key_exists(1,$posts['p'])){ ?>
		<p class="center">没有数据</p>
	<?php }else{ ?>
		<?php if(is_array($posts['p'])){foreach($posts['p'] as $pid=>$post){ ?>
		<li>
			<a href="forums.php?mod=view&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>&pid=<?php echo $pid;?>"><h2><?php echo $post['title'];?></h2><p><?php echo $post['by'];?>&nbsp;&nbsp;<?=_date(0,$post['sendtime'])?></p></a>
		</li>
		<?php } }?>
	<?php } ?>
</ul>
<a href="forums.php?mod=postdo&action=newtopic&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>" class="ui-btn">发表主题</a>
<?php include template('common/footer','default');?>