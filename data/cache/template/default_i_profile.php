<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<div class="div_father column_r">
	<div class="div_title">个人主页</div>
	<div class="div_content">
		<div class="fleft"><?=avatar($profile['uid'])?></div>
		<div>
			<b><?php echo $profile['username'];?></b> ?guanli?
			<br>
			UID: <?php echo $profile['uid'];?> <span class="graytext">(<?php echo $_G['config']['bburl'];?>i.php?mod=profile&user=<?php echo $user;?>)</span>
			<hr class="xx">
		</div>
		<br>
		<ul class="ulnostyle">
			<li>邮箱: <?php echo $profile['email'];?></li>
			<li>最后登录时间: <?php echo $profile['lastlogintime'];?></li>
			<li>注册时间: <?php echo $profile['regtime'];?></li>
		</ul>
	</div>
</div>

<!--sub:i/menu-->
<div class="div_father column_l">
	<div class="div_title">菜单</div>
	<div class="div_content">
		<ul class="ulnostyle">
			<li><a href="i.php?mod=profile"<?php if(gpcget('mod')=='profile'){ ?> class="mark"<?php } ?>>个人主页</a></li>
			<li>设置
				<ul class="ulnostyle subui">
					<li>-<a href="i.php?mod=settings&do=basic"<?php if(gpcget('do')=='basic'){ ?> class="mark"<?php } ?>>基本的</a></li>
					<li>-<a href="i.php?mod=settings&do=avatar"<?php if(gpcget('do')=='avatar'){ ?> class="mark"<?php } ?>>头像</a></li>
				</ul>
			</li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
<!--endsub:i/menu-->

<?php include template('common/footer','default');?>