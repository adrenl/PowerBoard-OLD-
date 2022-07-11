<?php
	/**
		File name:forums_ajaxupload.php
		Last upload date:2022/7/9
		By:NewAdryKB
		Powered by PowerBoard
	**/
	include libfile('functions/upload');
	$action=gpcget('action');
	$aid=gpcget('aid');
	if($action=='delete' && $aid){
		delete_attachment($aid);
		return;
	}elseif($action=='imgview' && $aid){
		$data=info_attachment($aid);
		if(stripos($data['type'],'image')!==false){
			header('Content-type: '.$data['type']);
			readfile($data['file']);
			return;
		}
	}elseif($action=='download' && $aid){
		$data=info_attachment($aid);
		header('content-type: application/octet-stream');  
		header('content-disposition: attachment; filename='.$data['name']);  
		header('content-length: '.$data['size']);  
		readfile($data['file']);
	}
	if(($_FILES)!==array() || !empty($_FILES)){
		echo start_upload();
	}else{
		echo "Error";
	}
	//start_upload();
?>