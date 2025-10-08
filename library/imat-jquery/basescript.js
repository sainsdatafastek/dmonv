var sTimeOut = 2000;
var g_Select;
var sTimeOutId = false;
var sLocation = 1;

function MySelect(){
	g_Select = this;
}
MySelect.prototype.show = function(e, target, div){
	if(!document.getElementById) {
		alert("This browser is not suppored for a calendar popup.");
		return;
	}
	
	if (!document.getElementById(target)) {
		alert("Error: input field \"" + target + "\" does not exist.");
		return;
	}
	this.conLayer = document.getElementById(div);
	if(this.conLayer) {
		this.conLayer.onmouseout=selectTimeout;
		this.conLayer.onmouseover=selectClearTimeout;
		//document.body.insertBefore(this.conLayer,document.body.childNodes[0]);
	}
	if (this.isVisible()) {
		this.hide();
		return;
	}
	e.cancelBubble = true;
	if (e.stopPropagation){
		e.stopPropagation();
	}
	selectClearTimeout();
	this.conLayer.style.visibility='visible';
}
MySelect.prototype.hide = function(){
	calendarClearTimeout();
	this.conLayer.style.visibility='hidden';
};
MySelect.prototype.isVisible = function() {
	if (this.conLayer)
	{
		return this.conLayer.style.visibility=='visible' ? true : false;
	}
	else
	{
		return false;
	}
};

MySelect.prototype.isHidden = function() {
	return this.conLayer.style.visibility=='hidden' ? true : false;
};
function selectTimeout() {
	if(sTimeOut) {
		sTimeOutId = setTimeout('g_Select.hide();',sTimeOut);
	}
}

function selectClearTimeout() {
	if (sTimeOutId) {
		clearTimeout(sTimeOutId);
	}
}

function cp_handleDocumentClick(e){
	if (g_Select.isVisible())
	{
		g_Select.hide();
	}
}
new MySelect();
window.document.onclick=cp_handleDocumentClick;

function CekField(Field)
	{
		return true;
	}


function popUp(URL) 
	{
		Ran = parseInt(Math.random()*1000);
		URL = URL+"&Ran="+Ran;
		MyObjek = new Object();
		window.showModalDialog(URL, MyObjek , "dialogWidth:100;dialogHeight:100;resizeable:no;status:no;scrollbars:yes;dialogTop:1;dialogLeft:1;help:no;title:Print;print:yes;toolbar:yes");
		if (MyObjek.jadi=='1')
		{
			popUp(MyObjek.url)
		}
	}
function popUp2(page,panjang,lebar,sh)
{
	if (sh=='')
	{
		sh = 'no'
	}
	sWidth = screen.width;
	sHeight = screen.height;
	stop = (sHeight-lebar)/2;
	sleft = (sWidth-panjang)/2;
	window.open(page,'','width='+panjang+',height='+lebar+',top='+stop+',left='+sleft+',scrollbars='+sh+',resizable=no');
}
function preloadImages()
{
	if(document.images)
	{
		if(!document.imageArray) document.imageArray = new Array();
		var i,j = document.imageArray.length, args = preloadImages.arguments;

		for(i=0; i<args.length; i++)
		{
			if (args[i].indexOf('#')!=0)
			{
				document.imageArray[j] = new Image;
				document.imageArray[j++].src = args[i];
			}
		}
	}
}
function popUpEvaluasi(page)
{
	sWidth = screen.width;
	sHeight = screen.height;
	window.open(page,'','width='+sWidth+',height='+sHeight+',top=0,left=0,scrollbars=1,resizable=0,titlebar=0,fullscreen=1');
}