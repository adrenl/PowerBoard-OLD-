<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<link rel="stylesheet" type="text/css" href="data/cache/template/css_default_misc_mobile.css">
<div>
	<div class="tipsbox center fleft">
		立即使用手机进入论坛，获得快速上网体验<br><br>
		扫描该二维码
		<p>
			<img src="<?php echo $QRfile;?>" alt="<?php echo $_G['config']['bbname'];?>" title="<?php echo $_G['config']['bbname'];?>">
		</p>
		或者输入该网址<br>
		<?php echo $_G['config']['bburl'];?>
	</div>
	<div class="mob_phone fright">
		<iframe src="misc.php?mod=mobile&view=true" id="mob_view">Your browser doesn't support iframe,the preview is not available.</iframe>
	</div>
</div>
<?php include template('common/footer','default');?>