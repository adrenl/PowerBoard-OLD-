<?php
	/**
		File name:functions_upload.php
		Last upload date:2022/7/9
		By:NewAdryKB
		Powered by PowerBoard
	**/
	$todir='data/attachment/';
	$files=array();
	$config=$_G['config']['file']['attachment'];
	function start_upload($isupdata=false,$aid=0){
		global $config;
		global $files;
		global $todir;
		global $_G;
		$return=array();
		if(!file_exists($todir)){
			@mkdir($todir,0777,true);
		}
		$index=readindex($todir.'index.php',array('lastaid'=>0));
		$keys=array_keys($_FILES['attachment']['name']);
		foreach($keys as $k){
			if(!$_FILES['attachment']['name'][$k]){
				continue;
			}
			$files[$k]=array(  //给数组变异，更好操作
				'name'=>$_FILES['attachment']['name'][$k],
				'tmp_name'=>$_FILES['attachment']['tmp_name'][$k],
				'error'=>$_FILES['attachment']['error'][$k],
				'size'=>$_FILES['attachment']['size'][$k],
				'type'=>$_FILES['attachment']['type'][$k]
			);
			$name=$files[$k]['name'];
			$extension=pathinfo($name,PATHINFO_EXTENSION);
			if($files[$k]['error']==0){
				if(is_uploaded_file($files[$k]['tmp_name'])){
					if($files[$k]['size']<$config['max_size']){
						if(in_array(strtolower($extension),$config['file_type'])){
							unlink($index[$aid]['file']);
							$newname=$todir.md5($name.time().rand(0,255)).'.'.$extension;
							move_uploaded_file($files[$k]['tmp_name'],$newname);
							if($isupdata && $aid){
								$aid=intval($aid);
								$index[$aid]=array(
									'aid'=>$aid,
									'name'=>$name,
									'file'=>$newname,
									'size'=>$files[$k]['size'],
									'type'=>$files[$k]['type'],
									'isimg'=>false,
									'time'=>time(),
									'by'=>$_G['user']['username']
								);
								$return[]=$aid;
							}else{
								$index['lastaid']++;
								$index[$index['lastaid']]=array(
									'aid'=>$index['lastaid'],
									'name'=>$name,
									'file'=>$newname,
									'size'=>$files[$k]['size'],
									'type'=>$files[$k]['type'],
									'isimg'=>false,
									'time'=>time(),
									'by'=>$_G['user']['username']
								);
								$return[]=$index['lastaid'];
							}
							
							if(stripos($files[$k]['type'],'image')!==false){
								!$isupdata?$index[$index['lastaid']]['isimg']=true:$index[$aid]['isimg']=true;
								watermark($newname,$config['image_watermark_status']);
							}
						}
					}
				}
			}else{
				errordo_upload($files,$files['error']);
			}
		}
		writeindex($todir.'index.php',$index);
		if(count($return)==1){ //RETURN AID
			return $return[0];
		}else{
			return $return;
		}
	}
	function watermark($imagef,$watermarkstatus=9){
		if(false==($image=imagecreatefromunknow($imagef)) || isanimatedgif($imagef)){
			return false;
		}
		$iinfo=getimagesize($imagef);
		$watermark=imagecreatefrompng('files/imgs/watermark.png');
		$water_w=imagesx($watermark);
		$water_h=imagesy($watermark);
		$img_w=imagesx($image);
		$img_h=imagesy($image);
		$wmwidth=$img_w-$water_w;
		$wmheight=$img_h-$water_h;
		/////
		if($watermark && $wmwidth>10 && $wmheight>10){
			switch($watermarkstatus){
					case 1:
						$x=+5;
						$y=+5;
						break;
					case 2:
						$x=($water_w+$img_w)/2;
						$y=+5;
						break;
					case 3:
						$x=$img_w-$water_w-5;
						$y=+5;
						break;
					case 4:
						$x=+5;
						$y=($water_h+$img_h)/2;
						break;
					case 5:
						$x=($water_w+$img_w)/2;
						$y=($water_h+$img_h)/2;
						break;
					case 6:
						$x=$img_w-$water_w;
						$y=($water_h+$img_h)/2;
						break;
					case 7:
						$x=+5;
						$y=$img_h-$water_h-5;
						break;
					case 8:
						$x=($water_w+$img_w)/2;
						$y=$img_h-$water_h;
						break;
					case 9:
						$x=$img_w-$water_w-5;
						$y=$img_h-$water_h-5;
						break;
			}
			if($iinfo['mime']!='image/png') {
				$colorimg=imagecreatetruecolor($iinfo[0],$iinfo[1]);
			}
			if($iinfo['mime']!='image/png') {
				imagecopy($colorimg,$image,0,0,0,0,$iinfo[0],$iinfo[1]);
				$image=$colorimg;
			}
			imagealphablending($watermark,false);
			imagesavealpha($watermark,true);
			imagesavealpha($image,true);
			imagecopy($image,$watermark,$x,$y,0,0,$water_w,$water_h);
		}
		/////
		$type=getimagesize($imagef);
		switch($type[2]){
			case 1:
				imagegif($image,$imagef);
				break;
		    case 2:
				imagejpeg($image,$imagef,100);
				break;
			case 3:
				imagepng($image,$imagef);
				break;
			case 6:
				imagebmp($image,$imagef);
				break;
			case 15:
				imagewebp($image,$imagef);
				break;
		}
		imagedestroy($image);
		imagedestroy($watermark);
	}
	function isanimatedgif($filename){
		$fp=fopen($filename,'rb');
		$filecontent=fread($fp,filesize($filename));
		fclose($fp);
		return strpos($filecontent,chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0')===false?false:true;
	}
	function errordo_upload($files,$code){
		switch($code){
			case 1:
				break;
			case 2:
				break;
			default:
		}
	}
	function delete_attachment($aid){
		global $todir;
		global $_G;
		$aid=intval($aid);
		$index=readindex($todir.'index.php');
		if($aid){
			unlink($index[$aid]['file']);
			unset($index[$aid]);
			writeindex($todir.'index.php',$index);
			return true;
		}else{
			return false;
		}
	}
?>