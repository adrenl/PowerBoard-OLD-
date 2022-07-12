<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<div class="div_father">
	<div class="div_title">登陆</div>
	<div class="div_content">
		<div class="formcenter">	
			<form method="post" action="user.php?mod=register&submit=yes">
				<i class="rq"></i>用户名:<input type="text" name="username" required> 长度： <?php echo $_G['config']['user']['len']['name_min'];?>~<?php echo $_G['config']['user']['len']['name_max'];?>
				<hr class="xx">
				<i class="rq"></i>密码:<input type="password" name="password" required> 长度： <?php echo $_G['config']['user']['len']['password_min'];?>~<?php echo $_G['config']['user']['len']['password_max'];?>
				<hr class="xx">
				<i class="rq"></i>邮箱:<input type="email" name="email" required>
				<hr class="xx">
				<i class="rq"></i>验证码: <?=showsecode()?>
				<hr class="xx">
				<input type="submit" class="submitbtn" value="登陆">&nbsp;<input type="reset" value="重置">
			</form>
		</div>
	</div>
</div>
<?php include template('common/footer','default');?>