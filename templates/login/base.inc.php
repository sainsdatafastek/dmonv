<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>ETL DWH V.3.0 .: Cipta Karya</title>
<link rel="icon" type="image/png" href="<!--desaintema-->/images/favicon.png">
<style>
	body,td,table,tr,input,textarea,select
	{
		font-family:tahoma;font-size:10pt;scrollbar-face-color: #DEE3E7;
		scrollbar-highlight-color: #FFFFFF;scrollbar-shadow-color: #DEE3E7;
		scrollbar-3dlight-color: #D1D7DC;scrollbar-arrow-color:  #006699;
		scrollbar-track-color: white;scrollbar-darkshadow-color: #98AAB1;
	}
	.txt
	{
		BACKGROUND-COLOR: #F4F4F4;BORDER-BOTTOM: #CCCCCC 1px solid; 
		BORDER-LEFT: #CCCCCC 1px solid;BORDER-RIGHT: #CCCCCC 1px solid; 
		BORDER-TOP: #CCCCCC 1px solid;COLOR: #0076AE; FONT-SIZE: 11px; 
		PADDING-BOTTOM: 0px;PADDING-LEFT: 2px;PADDING-RIGHT: 0px; 
		PADDING-TOP: 7px;TEXT-DECORATION: none;HEIGHT: 30px;WIDTH: 250px;font-size: 15pt;
	}

	.tooltip{
		position:absolute;width:300px;background-image:url('<!--desaintema-->/images/tip-bg.png');
		background-position:left center;color:#FFF;padding:5px 5px 5px 18px;font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
	}

</style>
<script type='text/javascript' src='js/jquery.js'></script>
<script>
$(document).ready(function(){

$('[rel=tooltip]').bind('mouseover', function(){
		
 if ($(this).hasClass('ajax')) {
	var ajax = $(this).attr('ajax');	
			
  $.get(ajax,
  function(theMessage){
$('<div class=tooltip>'  + theMessage + '</div>').appendTo('body').fadeIn('fast');});

 
 }else{
			
	    var theMessage = $(this).attr('content');
	    $('<div class=tooltip>' + theMessage + '</div>').appendTo('body').fadeIn('fast');
		}
		
		$(this).bind('mousemove', function(e){
			$('div.tooltip').css({
				'top': e.pageY - ($('div.tooltip').height() / 2) - 5,
				'left': e.pageX + 15
			});
		});
	}).bind('mouseout', function(){
		$('div.tooltip').fadeOut('fast', function(){
			$(this).remove();
		});
	});
						   });

</script>
</head>
<script type='text/javascript' src='<!--desaintema-->/js/jquery.js'></script>
<script>
$(document).ready(function(){

$('[rel=tooltip]').bind('mouseover', function(){
		
 if ($(this).hasClass('ajax')) {
	var ajax = $(this).attr('ajax');	
			
  $.get(ajax,
  function(theMessage){
$('<div class=tooltip>'  + theMessage + '</div>').appendTo('body').fadeIn('fast');});

 
 }else{
			
	    var theMessage = $(this).attr('content');
	    $('<div class=tooltip>' + theMessage + '</div>').appendTo('body').fadeIn('fast');
		}
		
		$(this).bind('mousemove', function(e){
			$('div.tooltip').css({
				'top': e.pageY - ($('div.tooltip').height() / 2) - 5,
				'left': e.pageX + 15
			});
		});
	}).bind('mouseout', function(){
		$('div.tooltip').fadeOut('fast', function(){
			$(this).remove();
		});
	});
});

</script>
<BODY bgcolor='#A5B5BD'><br><br>
	<center><IMG SRC='<!--desaintema-->/images/ck.png' height='120'></center>
	<br>
	<TABLE cellspacing=0 cellpadding=0 width='400' height='*' align=center>
	<TR>
		<TD height='53'>
			<TABLE cellspacing=0 cellpadding=0 width='100%' height='100%' align=center>
			<TR>
				<TD WIDTH='8' HEIGHT='53'><IMG SRC='<!--desaintema-->/images/atas_1.jpg'></TD>
				<TD WIDTH='*' HEIGHT='53' background='<!--desaintema-->/images/atas_2_bg.jpg'>&nbsp;</TD>
				<TD WIDTH='173' HEIGHT='53'><IMG SRC='<!--desaintema-->/images/atas_3.jpg'></TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD height='44'>
			<TABLE cellspacing=0 cellpadding=0 width='100%' height='100%' align=center>
			<TR>
				<TD background='<!--desaintema-->/images/1atas_1_bg.jpg' WIDTH='*' HEIGHT='44' align=center>
					<marquee scrolldelay=1 scrollamount=1 style='color:red;'>
					SELAMAT DATANG DI SISTEM INFORMASI ETL DATABASE, SILAHKAN LOGIN UNTUK 
					MASUK KE KE DALAM FASILITAS SELANJUTNYA.
					</marquee>
				</TD>
				<TD WIDTH='13' HEIGHT='44'><IMG SRC='<!--desaintema-->/images/1atas_2.jpg'></TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD height='200'>

			<TABLE cellspacing=0 cellpadding=0 width='100%' height='100%' align=center>
			<TR>
 				<TD BACKGROUND='<!--desaintema-->/images/2atas_1.jpg' WIDTH='9' HEIGHT='*' BORDER=0 ALT=''></TD>
				<TD WIDTH='*' BACKGROUND='<!--desaintema-->/images/2atas_2.jpg' WIDTH='486' HEIGHT='13' BORDER=0 ALT='' valign=top align=center>
						
					<table width='100%' >
					<tr>
						<td>
							<FORM METHOD=POST ACTION='index.php'>
							<TABLE cellspacing=0 cellpadding=3 width='100%' align=center>
							<TR>
								<TD>Username:</TD>
							</TR>
							<TR>
								<TD><INPUT TYPE='text' NAME='uLogin' class=txt  id='username' rel='tooltip' content='Silahkan masukan Username member Anda. <br>untuk masuk ke halaman user' STYLE='width:100%;'></TD>
							</TR>
							<TR>
								<TD>Password:</TD>
							</TR>
							<TR>
								<TD><INPUT TYPE='password' NAME='pLogin'  class=txt  id='username' rel='tooltip' content='Silahkan masukan Password member Anda. <br>untuk masuk ke halaman user' STYLE='width:100%;'></TD>
							</TR>
							<TR>
								<TD><INPUT type='submit'  value='Login' name='Login' style='border:1px solid #AAAAAA;background: #405688;color:white;font-size:12pt;font-weight:bold;height:40px;width:100%;cursor:hand;'>
								<input type="hidden" name="Pg" value='Login' >
								</TD>
							</TR>
							</TABLE>
							</FORM>
						</td>
					</tr>
					</table>
					<br>
					<TABLE>
					<TR>
						<TD COLSPAN=2 class=font align=center>

								<i>ETL adalah kumpulan proses menyiapkan data dari operational source untuk data-data. Proses ini terdiri dari extracting, transforming, dan loading. </i><br>		
						</TD>
					</TR>
					</TABLE>
				</TD>
				<TD BACKGROUND='<!--desaintema-->/images/2atas_3.jpg' WIDTH='13' HEIGHT='*' BORDER=0 ALT=''></TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD height='19'>
			<TABLE cellspacing=0 cellpadding=0 width='100%' height='100%' align=center>
			<TR>
				<TD WIDTH='9' HEIGHT='19'><IMG SRC='<!--desaintema-->/images/3atas_1.jpg' BORDER=0 ALT=''></TD>
				<TD background='<!--desaintema-->/images/3atas_2_bg.jpg' WIDTH='*' HEIGHT='19' BORDER=0 ALT=''>&nbsp;</TD>
				<TD WIDTH='13' HEIGHT='19'><IMG SRC='<!--desaintema-->/images/3atas_3.jpg' BORDER=0 ALT=''></TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	</TABLE>
	
</BODY>
</HTML>