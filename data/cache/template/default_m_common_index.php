<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<?php if(is_array($out)){foreach($out as $arid=>$area){ ?>
	<div data-role="collapsible">
		<h1>版区 - <?php echo $area['name'];?></h1>
	<?php if(is_array($area['area'])){foreach($area['area'] as $fid=>$forums){ ?>
		<p><a href="forums.php?mod=display&arid=<?php echo $arid;?>&fid=<?php echo $fid;?>"><?php echo $forums['name'];?></a></p>
	<?php } }?>
	</div>
<?php } }?>
<?php include template('common/footer','default');?>