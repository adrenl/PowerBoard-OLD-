<?php if(!defined('IN_POWERBOARD')){die();}?><?php include template('common/header','default');?>
<div class="div_father column_r">
	<div class="div_title">设置 - 头像</div>
	<div class="div_content">
		<b>你现在的头像</b><br>
		<?=avatar($_G['user']['uid'])?><br><br>
		<b>设置你的头像</b><br>
		<form action="i.php?mod=settings&do=avatar&submit=yes" method="post" enctype="multipart/form-data">
			选择一个新头像，然后点击“上传”按钮<br>
			<input type="file" name="avatar"><br>
			<input type="submit" class="submitbtn" value="上传">
		</form>
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