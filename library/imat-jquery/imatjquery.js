$(document).ready(function() { 		
		$('#photoimg').live('change', function()			{ 
				   $("#preview").html('');
			$("#preview").html('<img src="./images/loader.gif" alt="Uploading...."/>');
		$("#imageform").ajaxForm({
					target: '#preview'
	}).submit();
	
		});
	}); 
$(document).ready(function() {
 
	$().ajaxStart(function() {
		
	}).ajaxStop(function() {

		$('#loading').hide();
		$('#loading2').hide();
		$('#result').fadeIn('slow');
		if(document.getElementById('BtnUpload'))
		{
			new AjaxUpload('#BtnUpload', {
				action: $("#UploadURL").val(),
				name: 'img',
				data: {
					example_key1 : 'example_value',
					example_key2 : 'example_value2'
				},
				autoSubmit: true,
				onChange: function(file, extension){},
				onSubmit: function(file, extension) {
					bt = $('#BtnUpload').text();
					$('#BtnUpload').text("Uploading..");
				},
				onComplete: function(file, response) {
					$('#BtnUpload').text(bt);
					$('#TmpUpload').html(response);
				}
			});
		}
	}); 
});
function hideKonfirmasi(){
	$('#confirmasi').fadeOut('medium');
}
function showKonfirmasi(){
	$('#confirmasi').fadeIn('slow');
}

function submitForm(formId, Pesan, URL){
	$('#loading').show();
	$('#loading2').show();
	$('#result').hide();
	URL = URL.replace(' ', '+');
	$.ajax({
		type: 'POST',
		url: URL,
		data: $(formId).serialize(),
		success: function(data) {
			$(Pesan).html(data);
		}
	})
	return false;	
}

function submitForm2(formId, Pesan, URL){
	URL = URL.replace(' ', '+');
	$.ajax({
		type: 'POST',
		url: URL,
		data: $(formId).serialize(),
		success: function(data) {
			$(Pesan).html(data);
		}
	})
	return false;	
}
function ambilData(Konten, URL)
{
	$('#loading').show();
	$('#loading2').show();
	$('#result').hide();
	Kata = /\s/g
	URL = URL.replace(Kata, '+');
	$(Konten).load(URL);
}

function ambilData2(Konten, URL)
{
	Kata = /\s/g
	URL = URL.replace(Kata, '+');
	$(Konten).load(URL);
}
function loadData(Konten, URL)
{
	Kata = /\s/g
	URL = URL.replace(Kata, '+');
	$(Konten).load(URL);
}
function getPemberitahuan(Konten, URL)
{
	Kata = /\s/g
	$(Konten).html("<center><table><TR><TD><img src='./images/wait.gif' height='25'><TD><TD> Memuat...</TD></TR></TABLE></center>");
	URL = URL.replace(Kata, '+');
	$(Konten).load(URL);
}
function getData(URL)
{
	Kata = /\s/g
	URL = URL.replace(Kata, '+');
	$.get(URL, function(data){
	  return data;
	});
}
function ambilURL(Konten, URL)
{
	$.get(URL, function(data){
	  alert("Response: " + data);
	});
}
function loadBerita(Konten, URL)
{
	$(Konten).html("Memuat Berita dari JabarMedianet.com..<BR><BR>");
	Kata = /\s/g
	URL = URL.replace(Kata, '+');
	$(Konten).load(URL);
}
function replaceWith(a, b)
{
	$(a).replaceWith(b);
}
function showPopUp(width, height)
{
	$('#faceboxisi').html('');
	$('#faceboxisi').css('width', width+'px');
	$('#popup').fadeIn('medium');
}

function SubshowPopUp(width, height)
{
	$('#faceboxisi02').html('');
	$('#faceboxisi02').css('width', width+'px');
	$('#popup02').fadeIn('medium');
}
function subhidePopUp()
{
	$('#popup02').fadeOut('medium');
}


function hidePopUp()
{
	$('#popup').fadeOut('medium');
}

function SortTabel(NamaTabel)
{
	//alert('a');
	$(NamaTabel).tablesorter();
}
function klikSubMenu(SubMenu)
{
	if ($(SubMenu + ":first").is(":hidden")) {
		$(SubMenu).slideDown("medium");
		setCookie('menubuka',SubMenu,365);
	} else {
		$(SubMenu).slideUp("medium");
	}
}
function hideSubMenu(SubMenu, Jumlah){
	for (i = 0; i < Jumlah; i++)
	{
		$(SubMenu + i).slideUp("fast");
	}
}
function setCookie(c_name,value,expiredays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}
function getCookie(c_name)
{
	if (document.cookie.length>0)
	{
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1)
		{
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	else
	{
		return "";
	}
}
function showHideObjek(o){
	if ($(o + ":first").is(":hidden")) {
		showObjek(o);
		setTimeout(function(){ $(o).fadeOut("fast") }, 20000);
	} else {
		hideObjek(o);
	}
}
function showObjek(o)
{
	$(o).fadeIn("fast");
}
function hideObjek(o)
{
	$(o).fadeOut('fast');
}

function nextfield(ID)
{
	if (event.keyCode == 13)
	document.getElementById(ID).focus();
}
function TG(a, changeTo) { a.style.backgroundColor = changeTo; }


 ///////////////////////////// SET FOCUS
 function KeyFocus(evt,prev,next,left,right)
 {
	var textBox1 = getObject(prev);
	var textBox2 = getObject(next);
	var textBox3 = getObject(left);
	var textBox4 = getObject(right);
	var charCode = (evt.which) ? evt.which : event.keyCode
	
	if (charCode == 37) textBox3.focus(); // left arrow
	if (charCode == 39) textBox4.focus(); // right arrow

	if (charCode == 38) textBox1.focus(); // up arrow
	if (charCode == 40) textBox2.focus(); // down arrow 
	if (charCode == 13) textBox2.focus(); //  enter
	return false;

 }
////////////////////////////// PENGURUTAN	
function SetUlang(txtBox)
{
 var textBox = getObject1(txtBox);
 textBox.value=0;
}
function UrutKlik(evt,txtBox,Mak)
{
var i;
var textBox = getObject1('NoUrut');
var textBox2 = getObject1(txtBox);
var charCode = (evt.which) ? evt.which : event.keyCode	 		 
if (textBox.value=='')
{textBox.value=0;}
if(Mak!=parseInt(textBox.value))
{
 i= parseInt(textBox.value)+1;
 textBox.value = i; // left arrow	 
 textBox2.value = textBox.value; // left arrow	 
}	 
return false;
}

function UrutAn(evt,txtBox,Mak,txtBox3)
{
var i;
var textBox = getObject1('NoUrut');
var textBox2 = getObject1(txtBox);
var textBox3 = getObject1(txtBox3);
var charCode = (evt.which) ? evt.which : event.keyCode	 		 
if (charCode == 48 || charCode == 49 || charCode == 50 || charCode == 51 || charCode == 52 || charCode == 53 || charCode == 54 || charCode == 55 || charCode == 56 || charCode == 57 || charCode == 96 || charCode == 97 || charCode == 98 || charCode == 99 || charCode == 100 || charCode == 101 || charCode == 102 || charCode == 103 || charCode == 104 || charCode == 105)
{
	if (textBox.value==''){textBox.value=0;}
	if(Mak!=parseInt(textBox.value))
	{
		 if(parseInt(textBox3.value.length)<1)
		 { i= parseInt(textBox.value)+1;textBox.value = i;textBox2.value = textBox.value;}			 
	}
}	 
return false;
}
///////////////////// GET OBJECT
function getObject1(obj)
{	
  var theObj;
  if (document.getElementById) {
	  if (typeof obj=='string') {return document.getElementById(obj);} 
	  else {return obj.style;}
  }	 
}

function getObject(obj)
{
  var theObj;
  if (document.getElementById) {
	  if (typeof obj=='string') {return document.getElementById(obj);}else{return false;}
  }
  return null;
}