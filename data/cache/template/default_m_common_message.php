<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
		<div class="ui-content ui-popup ui-body-inherit ui-overlay-shadow ui-corner-all" style="text-align:center">
			<h4><?php echo $_G['config']['bbname'];?> 提示信息</h4>
			<?php echo $message;?>
			<br><br>
			<?php if($url){ ?>
				<a href="<?php echo $url;?>"> 点击此处跳转至 <?php echo $url;?> </a> 
			<?php } ?>
			<?php if($options['return']){ ?>
				<a href="javascript:;" onclick="history.go(-1);"> 点击此处回到上一页 </a> 
			<?php } ?>
		</div>
		<br>
<?php include template('common/footer','default');?>