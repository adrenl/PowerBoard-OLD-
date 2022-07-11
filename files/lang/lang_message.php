<?php
	if(!defined('IN_POWERBOARD')){
		exit('Access Denied');
	}
	$lang=array(
		'user_nologin'=>'您尚未登陆，请先登陆。',
		'user_reg_isexists'=>'用户 {USERNAME} 已存在。',
		'user_login_isntexists'=>'用户 {USERNAME} 不存在。',
		'user_namelen_invalid'=>'用户名长度不在指定范围内。',
		'user_passwordlen_invalid'=>'密码长度不在指定范围内。',
		'user_password_error'=>'密码不正确',
		'user_email_invalid'=>'邮箱不正确。',
		'register_success'=>'注册成功，现在将转入登陆页面。',
		'login_success'=>'登陆成功。欢迎你，{USERNAME}。',
		'loginout_success'=>'退出登录成功，现在将转入主页。',

		'secode_error'=>'验证码不正确。',
		'no_all_fill'=>'一个或多个必填项未填写。',
		'submit_no_validate'=>'指定的功能模块不存在。',

		'var_error'=>'参数错误。',

		'post_no_exists'=>'帖子不存在。',
		'forum_no_exists'=>'版区或板块不存在。',
		'post_title_len_too'=>'标题字数小于 {MINLEN} 字或大于 {MAXLEN} 字，请返回修改。',
		'post_content_len_too'=>'内容字数小于 {MINLEN} 字或大于 {MAXLEN} 字，请返回修改。',
		'post_topic_new_success'=>'发布帖子成功。',
		'post_post_edit_success'=>'编辑帖子成功。',
		'post_reply_new_success'=>'发表回复成功。',
		'post_delete_success'=>'删除帖子成功。',

		'file_no_upload'=>'没有文件被上传。',
		'file_upload_error'=>'一个或多个文件在上传时出现错误，错误代码为：{ERRCODE}',
		'attachment_too_big'=>'一个或多个附件太大，最大为{MAXSIZE}。',
		'attachment_today_toomuch'=>'你今天上传的附件太多了，请明天再试。',
		'attachment_file_invaild'=>'附件文件类型不正确，可以使用的格式有{FILETYPE}。',
		'attachment_noexists'=>'附件不存在',

		'avatar_too_big'=>'头像大小太大，最大为{MAXSIZE}，而头像的大小为{AVATARSIZE}',
		'avatar_file_invaild'=>'头像文件类型不正确，可以使用的格式有{FILETYPE}。',
		'avatar_success'=>'头像上传成功。这是你的新头像：<br>{NEWAVATAR}',
	);
?>