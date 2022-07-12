<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<form method="post" action="user.php?mod=login&submit=yes" data-ajax="false">
	<div class="ui-field-contain">
		<select name="howlogin" data-role="none"><option value="false">用户名</option><option value="true">UID</option></select>:<input type="text" name="username" id="username"  data-role="none" required><br>
		<label for="password">密码:</label><input type="password" name="password" id="password" required><br>
		<label for="cookietime">Cookie有效期:</label><select name="cookietime" id="cookietime">
			<option  value="3153600000">永久</option>
			<option  value="2592000">一个月</option>
			<option  value="86400">一天</option>
			<option  value="3600">一小时</option>
			<option  value="0">即时</option>
		</select>
		验证码: <?=showsecode()?>
		<input type="submit" class="submitbtn" value="登陆">&nbsp;<input type="reset" value="重置">
	</div>
</form>
<?php include template('common/footer','default');?>