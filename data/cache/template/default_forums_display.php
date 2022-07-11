<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<?php $thisarea=$_G['config']['forums'][$arid] ?>
<?php $thisforum=$thisarea['area'][$fid] ?>
<div class="div_father">
	<div class="div_title"><?php echo $thisarea['name'];?> - <?php echo $thisforum['name'];?></div>
	<div class="div_content">
		板块描述: <?php echo $thisforum['description'];?><hr>
		[<a href="forums.php?mod=postdo&action=newtopic&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>">发表主题</a>]<a href="<?php echo $_G['config']['bburl'];?>misc.php?mod=rss&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>" class="fright" style="margin-bottom:2px;"><img src="files/imgs/common/rss.gif"></a>
		<table style="width:100%;" border="1">
			<tr>
				<th style="width:70%">标题</th>
				<th style="width:15%">发布者</th>
				<th style="width:15%">发布时间</th>
			</tr>
			<?php if(!@array_key_exists(1,$posts['p'])){ ?>
				<tr><td colspan="3" class="center">没有数据</td></tr>
			<?php }else{ ?>
				<?php if(is_array($posts['p'])){foreach($posts['p'] as $pid=>$post){ ?>
					<tr>
						<td><a href="forums.php?mod=view&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>&pid=<?php echo $pid;?>"><?php echo $post['title'];?></a></td>
						<td><?php echo $post['by'];?></td>
						<td><?=_date(0,$post['sendtime'])?></td>
					</tr>
				<?php } }?>
			<?php } ?>
		</table>
		[<a href="forums.php?mod=postdo&action=newtopic&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>">发表主题</a>]
	</div>
</div>
<?php include template('common/footer','default');?>