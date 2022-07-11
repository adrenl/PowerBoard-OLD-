<?php
	if(!defined('IN_POWERBOARD')) {
		exit('Access Denied');
	}
	$arid=gpcget('arid');
	$fid=gpcget('fid');
	$rss="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<rss version=\"2.0\">
 <channel>
  <title><![CDATA[".$_G['config']['forums'][$arid]['name']." - ".$_G['config']['forums'][$arid]['area'][$fid]['name']." - ".$_G['config']['bbname']."]]></title>
  <link><![CDATA[".$_G['config']['bburl']."forums.php?mod=display&arid={$arid}&fid={$fid}]]></link>
  <description><![CDATA[".$_G['config']['forums'][$arid]['area'][$fid]['description']."]]></description>
  <generator>Powered By PowerBoard</generator>
 </channel>";
	$dir=POWERBOARD_ROOT."data/forums/{$arid}/{$fid}/";
	$index=@unserialize(file($dir.'index.php')[1]);
	include libfile('functions/post');
	if($index['totaltopic']<=$_G['rss']['msg_count']){
		$icount=$index['totaltopic'];
	}else{
		$icount=$index['totaltopic']-$_G['rss']['msg_count'];
	}
	for($i=$index['totaltopic'];$i>=($icount-1);--$i){
		$p=getpost($arid,$fid,$i,1,false);
		$rss.="
   <item>
    <title><![CDATA[".$p['title']."]]></title>
	<link><![CDATA[".$_G['config']['bburl']."forums.php?mod=view&arid={$arid}&fid={$fid}&pid={$i}]]></link>
	<description><![CDATA["._substr(preg_replace('/\[(.*?)\]/is','',$p['content']),0,$_G['config']['rss']['substr'])."]]></description> 
	<author><![CDATA[".$p['by']."]]></author>
	<pubDate><![CDATA["._date(0,$p['sendtime'])."]]></pubDate>
   </item>";
	}
	header("Content-type: text/xml");
	echo $rss."
</rss>";
?>