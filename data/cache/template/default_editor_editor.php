<?php if(!defined('IN_POWERBOARD')){die();}?><div id="editor">
	<?php $EDITOR['minlength']=isset($EDITOR['minlength'])?$EDITOR['minlength']:10; ?>
	<?php $EDITOR['maxlength']=isset($EDITOR['maxlength'])?$EDITOR['maxlength']:1000; ?>
	<?php $EDITOR['minimode']=isset($EDITOR['minimode'])?$EDITOR['minimode']:0; ?>
	<?php $EDITOR['useattachment']=isset($EDITOR['useattachment'])?$EDITOR['useattachment']:1; ?>
	<?php $EDITOR['content']=isset($EDITOR['content'])?$EDITOR['content']:''; ?>
	<?php $EDITOR['attachmentlist']=isset($EDITOR['attachmentlist'])?$EDITOR['attachmentlist']:null; ?>
	<script>
		var e_minlength=<?php echo $EDITOR['minlength'];?>;
		var e_maxlength=<?php echo $EDITOR['maxlength'];?>;
		var e_minimode=<?php echo $EDITOR['minimode'];?>;
		var e_useattachment=<?php echo $EDITOR['useattachment'];?>;
		var e_original_attach=<?=$EDITOR['attachmentlist']?"JSON.parse('".$EDITOR['attachmentlist']."')":"null"?>;
	</script>
	<link rel="stylesheet" type="text/css" href="data/cache/template/css_default_editor.css">
	<div id="editor_toolbar">
		<select id="FontSet" onchange="code('font');selectgoto(this,0);"><option value="">字体</option></select>
		<select id="SizeSet" onchange="code('size');selectgoto(this,0);"><option value="">字号</option></select>
		<select id="ColorSet" onchange="code('tc');selectgoto(this,0);"><option value="">文字颜色</option></select>
		<select id="BackColortSet" onchange="code('tbc');selectgoto(this,0);"><option value="">背景颜色</option></select>
		<a href="javascript:;" class="e_btn e_b" title="粗体">b</a>
		<a href="javascript:;" class="e_btn e_i" title="斜体">i</a>
		<a href="javascript:;" class="e_btn e_u" title="下划线">u</a>
		<a href="javascript:;" class="e_btn e_d" title="删除线">d</a>
		<a href="javascript:;" class="e_btn e_alignleft" title="左对齐">al</a>
		<a href="javascript:;" class="e_btn e_aligncenter" title="居于中间")>ac</a>
		<a href="javascript:;" class="e_btn e_alignright" title="右对齐">ar</a>
		<a href="javascript:;" class="e_btn e_floatleft" title="左浮动">fl</a>
		<a href="javascript:;" class="e_btn e_floatright" title="右浮动">fr</a>
		<a href="javascript:;" class="e_btn e_ul" title="无序列表">ul</a>
		<a href="javascript:;" class="e_btn e_ol" title="有序列表">ol</a>
		<a href="javascript:;" class="e_btn e_link" title="超链接">link</a>
		<a href="javascript:;" class="e_btn e_table" title="表格">table</a>
		<a href="javascript:;" class="e_btn e_hr" title="分隔线">hr</a>
		<a href="javascript:;" class="e_btn e_smilies" title="表情">smilies</a>
		<a href="javascript:;" class="e_btn e_img" title="图像">img</a>
		<a href="javascript:;" class="e_btn e_video" title="视频">video</a>
		<a href="javascript:;" class="e_btn e_audio" title="音频">audio</a>
		<?php if($EDITOR['useattachment']){ ?><a href="javascript:;" class="e_btn e_attachment" title=" 附件 ">attachment</a><?php } ?>
		<a href="javascript:;" class="e_btn e_sup" title="上标">sup</a>
		<a href="javascript:;" class="e_btn e_sub" title="下标">sub</a>
		<a href="javascript:;" class="e_btn e_quote" title="?e_qutoe?">quote</a>
		<a href="javascript:;" class="e_btn e_marquee" title="飞行文本">marquee</a>
		<a href="javascript:;" class="e_btn e_code" title="代码">code</a>
		<?php if($EDITOR['minimode']){ ?><span class="fright graytext" onclick="tominimode(false);this.style.display='none';"> 完整模式 </span><?php } ?>
	</div>
	<fieldset id="smilies_fieldset" style="display:none;">
		<legend>表情</legend>
		<span style="float:left;cursor:pointer;" onclick="$('smilies_fieldset').style.display='none'">[X]</span>
	</fieldset>
	<?php if($EDITOR['useattachment']){ ?>
	<fieldset id="attachment_fieldset" style="display:none;">
		<legend>附件</legend>
		<span style="float:left;cursor:pointer;" onclick="$('attachment_fieldset').style.display='none'">[X]</span>
		<!--<div id="attachmentdiv">
			
		</div>-->
		<table border="1" style="width:100%" id="attachmentlist">
			<tr>
				<th style="width:90px;">附件ID(AID)</th>
				<th>文件名</th>
				<th style="width:100px;">操作</th>
			</tr>
			<tr><td colspan="3">选择附件<input type="file" id="newinsert" onchange="attachmentinput()" value=""></td></tr>
		</table>
	</fieldset>
	<?php } ?>
	<textarea id="editor_textarea" name="editor_textarea"><?php echo $EDITOR['content'];?></textarea>
	<textarea id="editor_data" name="editor_content" style="display:none;"></textarea>
	<input type="hidden" name="editor_useattachment" id="editor_useattachment" value="">
	<div id="editor_bottombar">
		<a href="javascript:;" onclick="savedata()">保存内容</a>(<input type="checkbox" id="autosave" onclick="autosavecheck();" checked>自动)
		<a href="javascript:;" onclick="loaddata()">恢复内容</a>
		<span style="float:right;" class="graytext"><span id="counttext"></span> <span id="bottom_msg"></span></span>
	</div>
	<script src="data/cache/smilies_var.js"></script>
	<script src="files/javascript/editor.js"></script>
</div>