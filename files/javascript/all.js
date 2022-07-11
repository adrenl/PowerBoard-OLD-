/**
	File name:all.js
	Last upload date:2022/7/9
	By:NewAdryKB
	Powered by PowerBoard
**/
function $(id){
	return document.getElementById(id);
}
function _(classname){
	return document.getElementsByClassName(classname);
}
window.onerror=function(message,url,line,column,error){
	alert("PowerBoard JavaScript Error\n错误信息："+message+"\n错误文件："+url+"\n出错行数："+line+"\n出错时间："+Date()+"\n对于出错而影响到你的使用我们感到十分抱歉");
}
function newXmlHttp(){
	var xmlHttp=null;
	try{
		xmlHttp=new XMLHttpRequest();
	}catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
function quicklyajax(url,method,data,async,okfunc,errfunc){
	method=in_array(method,['GET','POST','HEAD'])?method:'GET';
	data=data?data:"";
	async=async?async:true;
	xmlHttp=newXmlHttp();
	if(async==true){
		xmlHttp.onreadystatechange=function(){
			if(xmlHttp.readyState==4 && xmlHttp.status==200){
				if(typeof okfunc=="function"){
					okfunc()
				}else{
					eval(okfunc);
				}
			}else if(xmlHttp.readyState==4 && xmlHttp.status!=200){
				if(typeof errfunc=="function"){
					errfunc()
				}else{
					eval(errfunc);
				}
			}
		}
	}
	xmlHttp.open(method,url,async);
	if(method=='POST') xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send(data);
}
function getStyle(obj,name){
	return window.getComputedStyle?getComputedStyle(obj,null)[name]:obj.currentStyle[name];
}
function show2hide(id,modes){
	var a=$(id);
	if(mode==true){
		a.style.display=="block";
	}else{
		a.style.display=="none";
	}
}
function picerr(ele){
	ele.src=IMGDIR+"picture_error.png";
	ele.onerror=null;
}
function in_array(search,array){
    for(var i in array){
        if(array[i]==search){
            return true;
        }
    }
    return false;
}
function copy_(id){
	that=$(id);
	var inp =document.createElement('input');
	document.body.appendChild(inp);
	inp.value =that.textContent 
	inp.select();
	document.execCommand('copy',false);
	inp.remove();
	dialog("复制成功");
}
function getOffsetByBody(el) {
    var offsetTop=0;
    while(el && el.tagName!=='body'){
        offsetTop+=el.offsetTop;
		el=el.offsetParent;
    }
    return offsetTop;
}
function lazyload() {
    var img=document.getElementsByClassName('lazyload');
    var availHeight=window.screen.availHeight;
    var scrollTop=document.body.scrollTop || document.documentElement.scrollTop;
    for (var j=0;j<img.length;j++) {
		var offsetTop_=getOffsetByBody(img[j])
        if (offsetTop_-scrollTop<availHeight){
			var src=img[j].dataset.src;
			if(src){
				img[j].src=src;
				img[j].onload=function(){
					this.classList.remove("lazyload");
				}
				img[j].removeAttribute('data-src');
			}
		}
	}
}
function dialog(msg,type,title,confirmfunc,cancalfunc,confirmtext,cancaltext){
	if($("dialogbg")) $("dialogbg").parentNode.removeChild($("dialogbg"));
	type=in_array(type,['confirm','message'])?type:'message';
	confirmtext=confirmtext?confirmtext:"确定";
	cancaltext=cancaltext?cancaltext:"取消";
	title=title?title:"提示";
	var ndialog=document.createElement("div");
	ndialog.innerHTML=title+'<span class="fright" id="dialog_cancal_XX">[X]</span><hr>'+msg+'<hr>'+(type=="message"?'<input type="button" id="dialog_confirm" value="'+confirmtext+'" class="submitbtn">':'<input type="button" id="dialog_confirm" value="'+confirmtext+'" class="submitbtn">&nbsp;<input type="button" id="dialog_cancal" value="'+cancaltext+'">');
	ndialog.classList.add("dialog");
	ndialog.style.width="200px";
	ndialog.style.left=(document.documentElement.clientWidth-ndialog.style.width.replace("px",""))/2+'px';
	var nbg=document.createElement('div');
	nbg.id="dialogbg";
	nbg.classList.add("blbg");
	nbg.appendChild(ndialog);
	document.getElementsByTagName("body")[0].appendChild(nbg);
	if($('dialog_cancal')) $('dialog_cancal').onclick=function(){
		if(typeof cancalfunc=="function"){
			cancalfunc()
		}else{
			eval(cancalfunc);
		}
		this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
	}
	if($('dialog_cancal_XX')) $('dialog_cancal_XX').onclick=function(){this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);}
	if($('dialog_confirm')) $('dialog_confirm').onclick=function(){
		if(typeof confirmfunc=="function"){
			confirmfunc()
		}else{
			eval(confirmfunc);
		}
		this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
	}
}
function allChoose(v1,v2){
	var a=document.getElementsByName("check[]");
	for(var i=0;i<a.length;i++){
		if(a[i].checked==false){
			a[i].checked=v1;
		}else{
			a[i].checked=v2;
		}
	}
}
function getFileName(path){
    var pos1=path.lastIndexOf('/');
    var pos2=path.lastIndexOf('\\');
    var pos=Math.max(pos1, pos2);
    if(pos<0){
        return path;
    }else{
        return path.substring(pos+1);
	}
}
function addfavourite(url,title) {
    try{
		window.external.addFavorite(url,title);
	}catch(e){
		try{
			window.sidebar.addPanel(title,url,"");
		}catch(e){
			dialog("请点击Ctrl+D收藏","message");
		}
    }
}
function switchdisplay(id){
	var a=$(id);
	if(a.style.display=="none"){
		a.style.display="block";
	}else{
		a.style.display="none";
	}
}
function selectgoto(e,index){
	e.options[index].selected=true;
}
Date.prototype.format=function(fmt){
	var o={
		"M+":this.getMonth()+1,                 //月份
		"d+":this.getDate(),                    //日
		"h+":this.getHours(),                   //小时
		"m+":this.getMinutes(),                 //分
		"s+":this.getSeconds(),                 //秒
		"q+":Math.floor((this.getMonth()+3)/3), //季度
		"S":this.getMilliseconds()             //毫秒
	};
	if(/(y+)/.test(fmt)){
		fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
	}
        
	for(var k in o){
		if(new RegExp("("+ k +")").test(fmt)){
		fmt = fmt.replace(
			RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));  
		}       
	}
	return fmt;
}
Array.prototype.remove=function(val){ 
    var index=this.indexOf(val);
    if(index>-1){
        this.splice(index, 1);
    }
}
function replaceAll_(v1,v2,v3){
	var regexp=new RegExp(v1,"g");
	return v3.replace(regexp,v2);
}
var classcodes =[];
window.Import={
    LoadFileList:function(_files,succes){
        var FileArray=[];
        if(typeof _files==="object"){
            FileArray=_files;
        }else{
            if(typeof _files==="string"){
                FileArray=_files.split(",");
            }
        }
        if(FileArray!=null && FileArray.length>0){
            var LoadedCount=0;
            for(var i=0;i< FileArray.length;i++){
                loadFile(FileArray[i],function(){
                    LoadedCount++;
                    if(LoadedCount==FileArray.length){
                        succes();
                    }
                })
            }
        }
        function loadFile(url, success) {
            if (!FileIsExt(classcodes,url)) {
                var ThisType=GetFileType(url);
                var fileObj=null;
                if(ThisType==".js"){
                    fileObj=document.createElement('script');
                    fileObj.src = url;
                }else if(ThisType==".css"){
                    fileObj=document.createElement('link');
                    fileObj.href = url;
                    fileObj.type = "text/css";
                    fileObj.rel="stylesheet";
                }
                success = success || function(){};
                fileObj.onload = fileObj.onreadystatechange = function() {
                    if (!this.readyState || 'loaded' === this.readyState || 'complete' === this.readyState) {
                        success();
                        classcodes.push(url)
                    }
                }
                document.getElementsByTagName('head')[0].appendChild(fileObj);
            }else{
                success();
            }
        }
        function GetFileType(url){
            if(url!=null && url.length>0){
                return url.substr(url.lastIndexOf(".")).toLowerCase();
            }
            return "";
        }
        function FileIsExt(FileArray,_url){
            if(FileArray!=null && FileArray.length>0){
                var len =FileArray.length;
                for (var i = 0; i < len; i++){
                    if (FileArray[i] ==_url){
                       return true;
                    }
                }
            }
            return false;
        }
    }
}
function init_aplayer(obj,url){ //aplayer
	Import.LoadFileList(["files/javascript/APlayer/APlayer.min.js","files/javascript/APlayer/APlayer.min.css"],function(){
		const ap=new APlayer({
			container: obj,
			theme: "#d2eeff",
			preload: "metadata",
			loop: "all",
			mutex: true,
			audio:[{
				name: getFileName(url),
				url: url,
				artist: ' ',
			}]
		});
	});
}
function init_dplayer(obj,url){ //dplayer
	Import.LoadFileList(["files/javascript/DPlayer/DPlayer.min.js","files/javascript/DPlayer/DPlayer.min.css"],function(){
		const dp = new DPlayer({
			container: obj,
			theme: '#d2eeff',
			screenshot: true,
			preload: 'metadata',
			mutex: true,
			video: {
				url: url,
				type: 'auto',
			},
		});
	});
}