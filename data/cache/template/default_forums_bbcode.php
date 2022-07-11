<?php if(!defined('IN_POWERBOARD')){die();}?><?php 
function tpl_bb_code($code){
	$thisid='code_'.rand(0,255);
	$thisolid='codeol_'.rand(0,255);
 ?>
<?php $return= <<<EOF
<div class="code" id="$thisid"><ol id="$thisolid">$code</ol><a href="javascript:copy_('$thisolid');"> 复制代码 </a></div>
EOF;
?>
<?php 
	return $return;
}

function tpl_bb_quote($quote){
 ?>
<?php $return= <<<EOF
 <div class="quote"><strong>引用</strong><blockquote>$quote</blockquote></div> 
EOF;
?>
<?php 
	return $return;
}

function tpl_bb_aplayer($src){
	$thisid='aplayer_'.rand(0,2990);
 ?>
<?php $return= <<<EOF
<div class="audio"><div id="$thisid"></div><script>init_aplayer($("$thisid"),"$src");</script>
<p class="center"><a href="$src" class="graytext" target="_blank"> 新窗口打开 </a></p></div>
EOF;
?>
<?php 
	return $return;
}
function tpl_bb_dplayer($src,$width=null,$height=null){
	$thisid='dplayer_'.rand(0,2990);
	if($width || $height){
	$width=$width.'px';
	$height=$height.'px';
 ?>
<?php $return= <<<EOF
<div class="video"><div id="$thisid" style="width: $width ;height: $height ;"></div><script>init_dplayer($("$thisid"),"$src");</script>
<p class="center"><a href="$src" class="graytext" target="_blank"> 新窗口打开 </a></p></div>
EOF;
?>
<?php 
	}else{
 ?>
<?php $return= <<<EOF
<div class="video"><div id="$thisid"></div><script>init_dplayer($("$thisid"),"$src");</script>
<p class="center"><a href="$src" class="graytext" target="_blank"> 新窗口打开 </a></p></div>
EOF;
?>
<?php 
	}
	return $return;
}
function tpl_bb_attachment($data){
	$thisid='attachment_'.rand(0,11451);
	$name=$data['name'];
	$size=sizecount($data['size']);
	$isimg=$data['isimg'];
	$aid=$data['aid'];
	$addother=$isimg?'<br><img data-src="forums.php?mod=ajaxupload&action=imgview&aid='.$data['aid'].'" class="lazyload">':'';
 ?>
<?php $return= <<<EOF
<div class="attachment"> 附件: <br><a href="forums.php?mod=ajaxupload&action=download&aid=$aid">$name</a> $size $addother</div> 
EOF;
?>
<?php 
	return $return;
}
 ?>