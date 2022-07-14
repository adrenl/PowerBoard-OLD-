<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<form method="post" action="user.php?mod=login&submit=yes" data-ajax="false">
	<div>
		<select name="howlogin" data-mini="true"><option value="false">用户名</option><option value="true">UID</option></select><input type="text" name="username" id="username"  required><br>
		<label for="password">密码</label><input type="password" name="password" id="password" required><br>
		<label for="cookietime">Cookie有效期</label>
		<select name="cookietime" id="cookietime">
			<option  value="3153600000">永久</option>
			<option  value="2592000">一个月</option>
			<option  value="86400">一天</option>
			<option  value="3600">一小时</option>
			<option  value="0">即时</option>
		</select>
		<label for="secode">验证码</label> 
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
	</div>
</form>
<?php include template('common/footer','default');?>