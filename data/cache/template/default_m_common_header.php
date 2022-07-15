<?php if(!defined('IN_POWERBOARD')){die();}?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $navtitle;?> - <?php echo $_G['config']['bbname'];?></title>
		<script src="files/javascript/all.js"></script>
		<meta charset="UTF-8">
		<meta name="description" content="<?php echo $_G['config']['seo']['keyword'];?>">
		<meta name="keywords" content="<?php echo $_G['config']['seo']['description'];?>">
		<base href="<?php echo $_G['siteurl'];?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="data/cache/template/css_default_m_common.css">

		<link rel="stylesheet" href="files/javascript/jquery_mobile/jquery.mobile-1.4.5.min.css">
		<script src="files/javascript/jquery_mobile/jquery.min.js"></script>
		<script src="files/javascript/jquery_mobile/jquery.mobile-1.4.5.min.js"></script>
		<link rel="stylesheet" href="files/javascript/jquery_mobile/PowerBoard.min.css"> 
		<link rel="stylesheet" href="files/javascript/jquery_mobile/jquery.mobile.icons.min.css"> 
		<script>
		jQuery.mobile.ajaxEnabled=false;
			jQuery.noConflict(true);
			var IMGDIR="files/imgs/common/";
			var SITEURL="<?php echo $_G['siteurl'];?>";
			var CSSFILE="data/cache/template/css_default_common.css";
			var BBURL="<?php echo $_G['config']['bburl'];?>";
		</script>
	</head>
	<body>
		<div data-role="page">
			<div data-role="header">
				<h1>
					<a href="./"><?php echo $_G['config']['bbname'];?></a><br>
				</h1>
			</div>
			<div data-role="navbar">
				<ul>
					<?php if(!islogin()){ ?>
					<li><a href="user.php?mod=login">登陆</a></li>
					<li><a href="user.php?mod=register">注册</a></li>
					<?php }else{ ?>
					<li><a href="i.php?mod=profile">个人主页</a></li>
					<li><a href="user.php?mod=exit">退出登录</a></li>
					<?php } ?>
				</ul>
			</div>
			<div style="margin:5px;">
			<a  href="./" data-role="none"><img src="<?php echo $_G['config']['bblogo'];?>" title="<?php echo $_G['config']['bbname'];?>" alt="<?php echo $_G['config']['bbname'];?>"></a>
			<span class="atpicright">
			<?php if(!islogin()){ ?> 你好，游客 <?php }else{ ?> 你好， <?php echo $_G['user']['username'];?> <br> 当前位置： <?php echo $navtitle;?><?php } ?>
			</span>
			<br>