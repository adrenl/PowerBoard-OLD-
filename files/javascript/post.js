function postcheck(title,content,tmaxlen,tminlen,cmaxlen,cminlen){
	if(action=='newtopic' || floor==1){
		if(title.length<tminlen || title.length>tmaxlen){
			dialog("标题字数小于 "+tminlen+" 字或大于 "+tmaxlen+" 字，请返回修改");
			return false;
		}
	}
	if(content.length<cminlen || content.length>cmaxlen){
		dialog("内容字数小于 "+cminlen+" 字或大于 "+cmaxlen+" 字，请返回修改");
		return false;
	}
	try{return oneditorsubmit();}catch(e){}
	return true;
}