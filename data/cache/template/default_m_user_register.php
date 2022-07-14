<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<div class="div_father">
	<div class="div_title">登陆</div>
	<div class="div_content">
		<div class="formcenter">	
			<form method="post" action="user.php?mod=register&submit=yes">
				<label for="username"><i class="rq"></i>用户名</label><input type="text" name="username" id="username" placeholder="长度： <?php echo $_G['config']['user']['len']['name_min'];?>~<?php echo $_G['config']['user']['len']['name_max'];?>" required>
				<label for="password"><i class="rq"></i>密码</label><input type="password" name="password" id="password" placeholder="长度： <?php echo $_G['config']['user']['len']['password_min'];?>~<?php echo $_G['config']['user']['len']['password_max'];?>" required>
				<label for="email"><i class="rq"></i>邮箱</label><input type="email" name="email" id="email" required>
				<label for="secode"><i class="rq"></i>验证码</label> 
<!--sub:common/seccheck-->
<?php $tpl_sec_url=$_G['config']['bburl'].'misc.php?mod=secode'; ?>
<?php $tpl_sec_id='secode_'.rand(0,3276); ?>
<?php if($_G['config']['secode']['type']==0 || $_G['config']['secode']['type']==2){ ?>
	<input type="text" name="secode" id="secode" required>&nbsp;<img src="<?php echo $tpl_sec_url;?>" id="<?php echo $tpl_sec_id;?>">&nbsp;<a href="javascript:;" onclick="$('<?php echo $tpl_sec_id;?>').src='<?php echo $tpl_sec_url;?>&'+Math.random()">刷新验证码</a>

<?php }else{ ?>
	<input type="text" name="secode" id="secode" required>&nbsp;<audio type="audio/mpeg" src="<?php echo $tpl_sec_url;?>" id="<?php echo $tpl_sec_id;?>"></audio><a href="javascript:;" onclick="$('<?php echo $tpl_sec_id;?>').src='<?php echo $tpl_sec_url;?>&'+Math.random()">刷新验证码</a> <a href="javascript:;" onclick="$('<?php echo $tpl_sec_id;?>').play();">播放</a>
<?php } ?>
<!--endsub:common/seccheck-->

				<input type="submit" class="submitbtn" value="登陆">
				<input type="reset" value="重置">
			</form>
		</div>
	</div>
</div>
<?php include template('common/footer','default');?>