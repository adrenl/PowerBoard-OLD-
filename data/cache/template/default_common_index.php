<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<?php if(is_array($out)){foreach($out as $arid=>$area){ ?>
	<div class="div_father">
		<div class="div_title">版区 - <?php echo $area['name'];?></div>
	<?php if(is_array($area['area'])){foreach($area['area'] as $fid=>$forums){ ?>
		<div class="div_content div_with_color_list"><a href="forums.php?mod=display&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>"><?php echo $forums['name'];?></a></div>
	<?php } }?>
	</div>
	<br>
<?php } }?>
	<hr>
<div class="div_father">
	<div class="div_title">Misc</div>
	<div class="div_content">Misc Content</div>
</div>
<?php include template('common/footer','default');?>