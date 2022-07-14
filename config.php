<?php
	$config=array (
	  'startyear' => 2021,
	  'msg_wait_time' => 5000,
	  'bbname' => 'PowerBoard',
	  'bburl' => 'http://localhost/PowerBoard/',
	  'bblogo' => 'http://localhost/PowerBoard/files/imgs/common/logo.svg',
	  'gzip' => false,
	  'max_online_time' => 3600,
	  'admin' => 'adrenl',
	  'moderator' => 'adrenl',
	  'admin_email' => 'adrenl1234@163.com',
	  'seo' => 
	  array (
		'keyword' => 'PHP,PowerBoard,文本论坛,论坛',
		'description' => 'PowerBoard是一个论坛程序，采用PHP语言编写',
	  ),
	  'rss'=>array(
	  'support'=>true,
		'msg_count'=>15,
		'substr'=>500,
	  ),
	  'user' => 
	  array (
		'len' => 
		array (
		  'name_max' => 10,
		  'name_min' => 3,
		  'password_max' => 18,
		  'password_min' => 6,
		),
		'sign' => 
		array (
		  'maxl' => 100,
		  'use_basic_bbcode' => true,
		  'use_img_bbcode' => true,
		),
		'dont_use_name' => 
		array (
		  0 => 'admin',
		  1 => 'adrenl',
		),
		'canregister' => true,
	  ),
	  'mail' => 
	  array (
		'smtp_username' => 'adrenl1234@163.com',
		'smtp_password' => 'adrenl0000',
		'smtp_host' => 'smtp.163.com',
		'smtp_port' => '465',
		'smtp_secure' => 'ssl',
		'frommail' => 'adrenl1234@163.com',
		'fromname' => 'adrenl',
	  ),
	  'u2u' => 
	  array (
	  'len'=>array(
		'content_max' => 350,
		'content_min' => 1,
		'title_max' => 15,
		'title_min' => 1,
		),
		'max_save' => 10,
	  ),
	  'post' => 
	  array (
	  'len'=>array(
		'content_max' => 20000,
		'content_min' => 5,
		'title_max' => 100,
		'title_min' => 4,
		),
	  ),
	  'secode' => 
	  array (
		'type' => 0,
		'width' => 100,
		'height' => 60,
		'usepicbg' => true,
	  ),
	  'news' => 
	  array (
		0 => '你好，欢迎来到DreamBoard！',
		1 => '请向我们提供您宝贵的意见',
		2 => '我们会不断改进DreamBoard',
		3 => '我相信我们会做得更好',
		4 => '感谢您的支持！',
		5 => '该论坛还在不断完善...',
	  ),
	  'file' => 
	  array (
		'avatar' => 
		array (
		  'max_size' => 102400000,
		  'file_type' => 
		  array (
			0 => 'gif',
			1 => 'png',
			2 => 'jpg',
			3 => 'bmp',
			4=>'jpeg',
		  ),
		),
		'attachment' => 
		array (
		  'max_size' =>999999999,
		  'file_type' => 
		  array (
			0 => 'txt',
			1 => 'png',
			2 => 'gif',
			3 => 'bmp',
			4 => 'zip',
			5 => 'rar',
			6 => 'doc',
			7 => 'docx',
			8 => 'mp3',
			9 => 'ogg',
			10 => 'ico',
			11 => 'jpg',
			12 => 'jpeg',
			13=>'exe',
			14=>'xls',
			15=>'xlsx',
			16=>'ppt',
			17=>'pptx',
		  ),
		  'image_watermark_status' => 9,
		//  'image_view'=>false,
		 // 'image_watermark_trans'=>50,
		),
	  ),
	  'extcredits' => 
	  array (
		1 => 
		array (
		  'enable' => true,
		  'name' => '金币',
		  'starthave' => 0,
		  'unit' => '枚',
		),
		2 => 
		array (
		  'enable' => true,
		  'name' => '贡献',
		  'starthave' => 0,
		  'unit' => '点',
		),
		3 => 
		array (
		  'enable' => false,
		  'name' => '',
		  'starthave' => 0,
		  'unit' => '',
		),
		4 => 
		array (
		  'enable' => false,
		  'name' => '',
		  'starthave' => 0,
		  'unit' => '',
		),
		5 => 
		array (
		  'enable' => false,
		  'name' => '',
		  'starthave' => 0,
		  'unit' => '',
		),
		6 => 
		array (
		  'enable' => false,
		  'name' => '',
		  'starthave' => 0,
		  'unit' => '',
		),
		'totalintegralsum' => '',
	  ),
	  'forums' => 
	  array (
		1 => 
		array (
		  'name' => '版区1',
		  'area' => 
		  array (
			1 => 
			array (
			  'name' => '板块1',
			  'description' => '板块1描述',
			  'moderator' => 
			  array (
				0 => 'admin',
			  ),
			  'condition' => '',
			),
			2 => 
			array (
			  'name' => '板块2',
			  'description' => '啦啦啦',
			  'moderator' => 
			  array (
			  ),
			  'condition' => '',
			),
		  ),
		),
		2 => 
		array (
		  'name' => '版区test',
		  'area' => 
		  array (
			1 => 
			array (
			  'name' => '板块test',
			  'description' => '板块test描述',
			  'moderator' => 
			  array (
			  ),
			  'condition' => '',
			),
		  ),
		),
		3 => 
		array (
		  'name' => '内部讨论',
		  'area' => 
		  array (
			1 => 
			array (
			  'name' => '违规用户',
			  'description' => '讨论处理违规用户',
			  'moderator' => 
			  array (
				0 => 'adrenl',
			  ),
			  'condition' => '',
			),
			2 => 
			array (
			  'name' => '帖子管理',
			  'description' => '讨论帖子相关的处理方法',
			  'moderator' => 
			  array (
			  ),
			  'condition' => '',
			),
		  ),
		),
	  ),
	  'ugroup' => 
	  array (
		'tourist' => 
		array (
		  'type' => 0,
		  'name' => '游客',
		  'cangoingbbs' => 1,
		  'candown' => 0,
		  'canvisituserpage' => 0,
		  'readlevel' => 10,
		),
		'level1' => 
		array (
		  'type' => 1,
		  'name' => '等级--1',
		  'cangoingbbs' => 1,
		  'candown' => 1,
		  'canvisituserpage' => 1,
		  'lintegral' => 
		  array (
			'min' => 0,
			'max' => 100,
		  ),
		  'readlevel' => 30,
		),
		'level2' => 
		array (
		  'type' => 1,
		  'name' => '等级--2',
		  'cangoingbbs' => 1,
		  'candown' => 1,
		  'canvisituserpage' => 1,
		  'lintegral' => 
		  array (
			'min' => 101,
			'max' => 200,
		  ),
		  'readlevel' => 60,
		),
		'level3' => 
		array (
		  'type' => 1,
		  'name' => '等级--3',
		  'cangoingbbs' => 1,
		  'candown' => 1,
		  'canvisituserpage' => 1,
		  'lintegral' => 
		  array (
			'min' => 201,
			'max' => 300,
		  ),
		  'readlevel' => 100,
		),
	  ),
	  'smilies' => 
	  array (
		'{0}' => '0.gif',
		'{1}' => '1.gif',
		'{2}' => '2.gif',
		'{3}' => '3.gif',
		'{4}' => '4.gif',
		'{5}' => '5.gif',
		'{6}' => '6.gif',
		'{7}' => '7.gif',
		'{8}' => '8.gif',
		'{9}' => '9.gif',
		'{10}' => '10.gif',
		'{11}' => '11.gif',
		'{12}' => '12.gif',
		'{13}' => '13.gif',
		'{14}' => '14.gif',
		'{15}' => '15.gif',
		'{16}' => '16.gif',
		'{17}' => '17.gif',
		'{18}' => '18.gif',
		'{19}' => '19.gif',
		'{20}' => '20.gif',
		'{21}' => '21.gif',
		'{22}' => '22.gif',
	  ),
	  'datetime' => 
	  array (
		'format' => 
		array (
		  'full' => 'Y-m-d H:i:s',
		  'only_date' => 'Y-m-d',
		  'only_time' => 'H:i:s',
		),
	  ),
	  'authkey' => 'firstauthkey',
	  'cookieprefix' => 'first_',
	)
?>