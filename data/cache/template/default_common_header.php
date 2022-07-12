<?php if(!defined('IN_POWERBOARD')){die();}?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $navtitle;?> - <?php echo $_G['config']['bbname'];?></title>
		<link rel="stylesheet" type="text/css" href="data/cache/template/css_default_common.css">
		<script src="files/javascript/all.js"></script>
		<meta charset="UTF-8">
		<meta name="description" content="<?php echo $_G['config']['seo']['keyword'];?>">
		<meta name="keywords" content="<?php echo $_G['config']['seo']['description'];?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
		<base href="<?php echo $_G['siteurl'];?>">
		<script>
			var IMGDIR="files/imgs/common/";
			var SITEURL="<?php echo $_G['siteurl'];?>";
			var CSSFILE="data/cache/template/css_default_common.css";
			var BBURL="<?php echo $_G['config']['bburl'];?>";
		</script>
	</head>
	<body>
		<div id="headnav"><?php if(islogin()==false){ ?> 你好，游客<i class="h"></i><a href="user.php?mod=register">注册</a><i class="h"></i><a href="user.php?mod=login">登陆 </a><?php }else{ ?> 你好， <?php echo $_G['user']['username'];?><i class="h"></i><a href="i.php?mod=profile">个人主页</a><i class="h"></i><a href="user.php?mod=exit">退出登录</a> <?php } ?><a style="float:right;" href="javascript:;" onclick="addfavourite('<?php echo $_G['config']['bburl'];?>','<?php echo $_G['config']['bbname'];?>');">加入收藏</a></div>
		<div id="header">
		<a href="./"><img src="<?php echo $_G['config']['bblogo'];?>" title="<?php echo $_G['config']['bbname'];?>" alt="<?php echo $_G['config']['bbname'];?>"></a><br>
		当前位置： <?php echo $navtitle;?>
		</div>