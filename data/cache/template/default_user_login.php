<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<div class="div_father">
	<div class="div_title">登陆</div>
	<div class="div_content">
		<div class="formcenter">	
			<form method="post" action="user.php?mod=login&submit=yes">
				<select name="howlogin"><option value="false">用户名</option><option value="true">UID</option></select>:<input type="text" name="username" required>
				<hr class="xx">
				密码:<input type="password" name="password" required>
				<hr class="xx">
				Cookie有效期:<input type="radio" name="cookietime" value="315360000" checked>永久 <input type="radio" name="cookietime" value="2592000">一个月 <input type="radio" name="cookietime" value="86400">一天 <input type="radio" name="cookietime" value="3600">一小时 <input type="radio"name="cookietime" value="0">即时
				<hr class="xx">
				验证码: <?=showsecode()?>
				<hr class="xx">
				<input type="submit" class="submitbtn" value="登陆">&nbsp;<input type="reset" value="重置">
			</form>
		</div>
	</div>
</div>
<?php include template('common/footer','default');?>