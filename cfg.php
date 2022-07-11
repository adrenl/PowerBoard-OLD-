<?php
		require 'source/functions/functions_application.php';
	$powerboard=new application;
	$powerboard->init();
	echo serialize(array('by'=>'NewAdrKB','title'=>'第一','content'=>'嘿，第一个帖子！！！','sendtime'=>time()));
  ?>