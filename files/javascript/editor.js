/**
	File name:editor.js
	Last upload date:2022/7/9
	By:NewAdryKB
	Powered by PowerBoard
**/
var editort=$("editor_textarea");
var toolbar=$("editor_toolbar");
var editordiv=$("editor");
var Fonts=new Array("宋体","新宋体","黑体","仿宋","楷体","微软雅黑","Arial","Comic Sans MS","Courier New","Tahoma","Times New Roman","Verdana");
var smload=false;
var timer=0;
var Colors=new Array('#000000','#800000','#008000','#000080','#800080','#008080','#808080','#C0C0C0','#FF0000','#00FF00','#FFFF00','#0000FF','#FF00FF','#00FFFF','#FFC0CB','#D9D919','#4F4F2F','#856363','#215E21','#FF6EC7','#CC3299','#A67D3D','#CD7F32','#32CD99','#FF7F00','#38B0DE','#EBC79E','#FFFFFF');
var useattachment=Array();

window.onload=function(){
	var FontE=$('FontSet');
	for(var i=0;i<Fonts.length;i++){
		FontE.innerHTML+='<option style="font-family:\''+Fonts[i]+'\'" value="'+Fonts[i]+'">'+Fonts[i]+'</option>';
	}
	var ColorSetE=$('ColorSet');
	var BackColorSetE=$('BackColortSet');
	for(var i=0;i<Colors.length;i++){
		ColorSetE.innerHTML+='<option style="color:'+Colors[i]+'" value="'+Colors[i]+'">'+Colors[i]+'</option>';
		BackColorSetE.innerHTML+='<option style="background-color:'+Colors[i]+'" value="'+Colors[i]+'">'+Colors[i]+'</option>';
	} 
	var SizeE=$('SizeSet');
	for(var i=0;i<=30;i++){
		SizeE.innerHTML+='<option style="font-size:'+i+'px" value="'+i+'px">'+i+'px</option>';
	}
	var eles=document.getElementsByClassName('e_btn');
	for(var i=0;i<eles.length;i++){
		eles[i].onclick=function(){
			code(this.innerHTML);
		}
	}
	tominimode(e_minimode);
	autosavecheck();
}
editort.onkeyup=function(){
	$('counttext').innerHTML="[字数："+editort.value.length+" 字|系统限制："+e_minlength+"~"+e_maxlength+" 字]"
}
function insert(insert){
	editort.value+=insert;
	editort.focus();
	editort.onkeyup();
}
function code(type,arg){
	if(type=='b'){
		dialog('<input type="text" id="v1">','confirm','输入设置成粗体的文本',function(){insert('[b]'+$('v1').value+'[/b]');});
	}else if(type=='i'){
		dialog('<input type="text" id="v1">','confirm','输入设置成斜体的文本',function(){insert('[i]'+$('v1').value+'[/i]');});
	}else if(type=='u'){
		dialog('<input type="text" id="v1">','confirm','输入添加下划线的文本',function(){insert('[u]'+$('v1').value+'[/u]');});
	}else if(type=='d'){
		dialog('<input type="text" id="v1">','confirm','输入添加删除线的文本',function(){insert('[d]'+$('v1').value+'[/d]');});
	}else if(type=='tc'){
		clr=$('ColorSet').value;
		if(clr=='') return;
		dialog('<input type="text" id="v1">','confirm','输入设置成<span style="color:'+clr+';">'+clr+'</span>颜色的文本',function(){insert('[color='+clr+']'+$('v1').value+'[/color]');});
	}else if(type=='tbc'){
		clr=$('BackColortSet').value;
		if(clr=='') return;
		dialog('<input type="text" id="v1">','confirm','输入设置成<span style="background-color:'+clr+';">'+clr+'</span>背景色的文本',function(){insert('[bgcolor='+clr+']'+$('v1').value+'[/bgcolor]');});
	}else if(type=='font'){
		ft=$('FontSet').value;
		if(ft=='') return;
		dialog('<input type="text" id="v1">','confirm','输入设置成<span style="font-family:\''+ft+'\';">'+ft+'</span>字体的文本',function(){insert('[font='+ft+']'+$('v1').value+'[/font]');});
	}else if(type=='size'){
		s=$('SizeSet').value;
		if(s=='') return;
		dialog('<input type="text" id="v1">','confirm','输入设置成'+s+'字号的文本',function(){insert('[size='+s+']'+$('v1').value+'[/size]');});
	}else if(type=='al'){
		dialog('<input type="text" id="v1">','confirm','输入左对齐的文本',function(){insert('[align=left]'+$('v1').value+'[/align]');});
	}else if(type=='ac'){
		dialog('<input type="text" id="v1">','confirm','输入居于中间的文本',function(){insert('[align=center]'+$('v1').value+'[/align]');});
	}else if(type=='ar'){
		dialog('<input type="text" id="v1">','confirm','输入右对齐的文本',function(){insert('[align=right]'+$('v1').value+'[/align]');});
	}else if(type=='fl'){
		insert("[float=left][/float]");
	}else if(type=='fr'){
		insert("[float=right][/float]");
	}else if(type=='ol' || type=='ul'){
		dialog('点击“添加”来添加一个项目,没有内容的项目不会被添加<div id="insertzone"><input type="text" name="dialoginput"></div><input type="button" value="添加" onclick="var newii=document.createElement(\'input\');newii.type=\'text\';newii.name=\'dialoginput\';$(\'insertzone\').appendChild(newii);">','confirm','插入一个'+(type=='ol'?'有序':'无序')+'列表',function(){
			var toinsert="";
			var insertss=document.getElementsByName('dialoginput');
			for(var i=0;i<insertss.length;i++){
				if(insertss[i].value==''){
					continue;
				}
				toinsert+='[li]'+insertss[i].value+'[/li]\n';
			}
			insert('['+type+']\n'+toinsert+'[/'+type+']\n');
		});
	}else if(type=='link'){
		dialog('超链接指向的地址(邮箱在前面加入“mailto:”)<br><input type="text" id="v1"><br>超链接显示的文本(可空)<br><input type="text" id="v2">','confirm','插入超链接',function(){
			if($('v2').value==''){
				insert('[url]'+$('v1').value+'[/url]');
			}else{
				insert('[url='+$('v1').value+']'+$('v2').value+'[/url]');
			}
		});
	}else if(type=='table'){
		dialog('行数<br><input type="number" id="v1"><br>列数<br><input type="number" id="v2"><br>表格宽度<br><input type="text" id="v3">','confirm','插入表格',function(){
			var col=$('v1').value;
			var row=$('v2').value;
			var width=$('v3').value?$('v3').value:"100%";
			if(isNaN(col)==true || isNaN(row)==true){
				return;
			}
			insertt="[table="+width+"]\n";
			for(var i=0;i<col;i++){ 
				insertt+="[tr]\n";
				for(var j=0;j<row;j++){
					insertt+="[td][/td]\n";
				}
				insertt+="[/tr]\n";
			}
			insertt+="[/table]\n";
			insert(insertt);
		});
	}else if(type=='hr'){
		insert('[hr/]');
	}else if(type=='img'){
		dialog('图片地址<br><input type="text" id="v1"><br>图片标题(可空)<br><input type="text" id="v2">','confirm','插入图片',function(){
			if($('v2').value==''){
				insert('[img]'+$('v1').value+'[/img]');
			}else{
				insert('[img='+$('v1').value+']'+$('v2').value+'[/img]');
			}
		});
	}else if(type=='video'){
		dialog('视频地址<br><input type="text" id="v1"><br>宽<input type="number" id="v2" value="320" class="wnunberi"><br>高<input type="number" value="240" id="v3" class="wnunberi">','confirm','插入视频',function(){insert('[video='+$('v2').value+','+$('v3').value+']'+$('v1').value+'[/video]')});
	}else if(type=='audio'){
		dialog('音频地址<br><input type="text" id="v1">','confirm','插入音频',function(){insert('[audio]'+$('v1').value+'[/audio]')});
	}else if(type=='smilies'){
		if(typeof smilies_file!="object" && smilies_key!="object") return;
		var sf=$("smilies_fieldset");
		if(smload==false){
			for(var k=0;k<smilies_file.length;k++){
				var newimg=document.createElement("img");
				newimg.src=BBURL+"/files/imgs/smilies/"+smilies_file[k];
				newimg.title=newimg.alt=smilies_key[k];
				newimg.classList.add("e_f_smilies");
				newimg.onclick=function(){
					insert(this.alt);
				}
				sf.appendChild(newimg);
			}
			smload=true;
		}
		switchdisplay("smilies_fieldset");
	}else if(type=='attachment'){
		if(e_useattachment==0) return;
		switchdisplay("attachment_fieldset");
	}else if(type=='sup'){
		dialog('<input type="text" id="v1">','confirm','输入上标文本',function(){insert('[sup]'+$('v1').value+'[/sup]');});
	}else if(type=='sub'){
		dialog('<input type="text" id="v1">','confirm','输入下标文本',function(){insert('[sub]'+$('v1').value+'[/sub]');});
	}else if(type=='marquee'){
		dialog('<input type="text" id="v1">','confirm','输入飞行文本',function(){insert('[marquee]'+$('v1').value+'[/marquee]');});
	}else if(type=='code'){
		insert("[code]\n<?php\necho \"Hello world!\";\n?>\n在此输入代码[/code]");
	}else if(type=='quote'){
		insert("[quote]在此输入引用[/quote]");
	}
}
function savedata(){
	if(typeof(Storage)!=="undefined"){
		localStorage.setItem("Editor_SaveData",editort.value);
		$('bottom_msg').innerHTML="内容已于"+new Date().format('hh:mm:ss')+"保存";
	}
}
function loaddata(){
	if(typeof(Storage)!=="undefined"){
		data=localStorage.getItem('Editor_SaveData');
		if(data==null){
			dialog('无内容可恢复！');
			return;
		}
		dialog('“恢复内容”会覆盖你当前的内容，继续吗？','confirm',null,function(){editort.value=data;$('bottom_msg').innerHTML="内容已恢复";});
	}
}
function autosavecheck(){
	if($('autosave').checked==true){
		timer=setInterval("savedata()",25000);
	}else{
		clearInterval(timer);
	}
}
function tominimode(mode){
	if(mode==true){
		_("e_alignleft")[0].style.display="none";
		_("e_aligncenter")[0].style.display="none";
		_("e_alignright")[0].style.display="none";
		_("e_floatleft")[0].style.display="none";
		_("e_floatright")[0].style.display="none";
		_("e_ul")[0].style.display="none";
		_("e_ol")[0].style.display="none";
		_("e_table")[0].style.display="none";
		_("e_hr")[0].style.display="none";
		_("e_audio")[0].style.display="none";
		_("e_video")[0].style.display="none";
		e_useattachment==1?_("e_attachment")[0].style.display="none":'';
		_("e_sup")[0].style.display="none";
		_("e_sub")[0].style.display="none";
		_("e_quote")[0].style.display="none";
		_("e_marquee")[0].style.display="none";
		_("e_code")[0].style.display="none";
		$("FontSet").style.display="none";
		$("SizeSet").style.display="none";
		$("BackColortSet").style.display="none";
	}else{
		_("e_alignleft")[0].style.display="inline-block";
		_("e_aligncenter")[0].style.display="inline-block";
		_("e_alignright")[0].style.display="inline-block";
		_("e_floatleft")[0].style.display="inline-block";
		_("e_floatright")[0].style.display="inline-block";
		_("e_ul")[0].style.display="inline-block";
		_("e_ol")[0].style.display="inline-block";
		_("e_table")[0].style.display="inline-block";
		_("e_hr")[0].style.display="inline-block";
		_("e_audio")[0].style.display="inline-block";
		_("e_video")[0].style.display="inline-block";
		e_useattachment==1?_("e_attachment")[0].style.display="inline-block":'';
		_("e_sup")[0].style.display="inline-block";
		_("e_sub")[0].style.display="inline-block";
		_("e_quote")[0].style.display="inline-block";
		_("e_marquee")[0].style.display="inline-block";
		_("e_code")[0].style.display="inline-block";
		$("FontSet").style.display="inline-block";
		$("SizeSet").style.display="inline-block";
		$("BackColortSet").style.display="inline-block";
	}
}
function attachmentinput(){
	if(e_useattachment==0) return;
	var willupload=$('newinsert');
	var newcell1id='ATTACHMENT1_'+Math.random();
	var newcell2id='ATTACHMENT1_'+Math.random();
	var newcell3id='ATTACHMENT1_'+Math.random();
	var newid='ATTACHMENT_TIPS_'+Math.random();
	var af=$("attachment_fieldset");
	var at=$("attachmentlist");
	var newrow=at.insertRow();
	var newcell1=newrow.insertCell();
	var newcell2=newrow.insertCell();
	var newcell3=newrow.insertCell();
	newcell1.id=newcell1id;
	newcell2.id=newcell2id;
	newcell3.id=newcell3id;
	newcell2.innerHTML=getFileName(willupload.value)
	newcell3.innerHTML="即将上传";
	var uploadajax=newXmlHttp();
	uploadajax.onreadystatechange=function(){
		if(uploadajax.status==200 && uploadajax.readyState==4){
			var aid=uploadajax.responseText;
			$(newcell1id).innerHTML=aid;
			$(newcell3id).innerHTML = " <input type='button' value='插入' onclick='insert(\"[attach]"+aid+"[/attach]\")'><input type='button' value='删除' onclick='deleteattachment("+aid+");this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);'>";
			useattachment.push(aid);
		}
    }
	uploadajax.upload.onprogress=function(up){
        $(newcell3id).innerHTML=Math.floor((up.loaded / up.total) * 100) + "%";
	}
	var uploadform=new FormData();
	uploadform.append('attachment[]',willupload.files[0]);
	uploadajax.open("post", "forums.php?mod=ajaxupload");
	uploadajax.send(uploadform);
	willupload.outerHTML=willupload.outerHTML;
}
function deleteattachment(aid){
	quicklyajax("forums.php?mod=ajaxupload&action=delete&aid="+aid,"get","",true,function(){
		dialog("删除成功");
	});
	useattachment.remove(aid);
}
function oneditorsubmit(){
	var smtc=editort.value;
	if(smtc.length<e_minlength || smtc.length>e_maxlength){
		return false;
	}
	$('editor_data').value=smtc;
	return true;
}