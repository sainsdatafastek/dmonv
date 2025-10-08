<?php
	$response = new stdClass();
	if ($_GET){foreach($_GET as $key => $value){$$key = $value;}}
	if ($_POST){foreach($_POST as $key => $value){$$key = $value;}}
	/// SETTING 
	include ("config.inc.php");
	
	$Form="";
	$id_maping=!empty($id_maping)?$id_maping:"";
	//////////// TABLE LIST
		/// DATABASES
	$ListMode="";$i=1;	
	$TextTemp="tmp";
	///// PARAMETER AND QUERY GRID
	$Qry="select a.id_maping, b.dbname as dbsumber, e.query_name as query_sumber , c.dbname as dbdwh, f.table_name as table_dwh from reg_maping_dwh_to_mart as a inner join reg_db_sumber as b on a.id_dbname_sumber=b.id_dbname inner join reg_db_mart as c on a.id_dbname_dwh =c.id_dbname inner join reg_db_sumber_query as e on a.id_query =e.id_query inner join reg_db_mart_table as f on a.id_table  = f.id_table inner join reg_maping_dwh_to_mart_field as g on g.id_maping=a.id_maping group by a.id_maping";
	$Qry=_mysql_query($Qry);

	///// LIST GRID
	$Script="";
	$jml=_mysql_num_rows($Qry);
	$hidden="
	document.getElementById('proses_loading').style.visibility='hidden';	
	document.getElementById('ambilDataAjax').style.visibility='visible';
	";

	
	while($Isi=_mysql_fetch_array($Qry)){
		$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
		$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
		
		$txthidden=$jml==$i?$hidden:"";
		$Script.="
			$.ajax({
				type: 'POST', url: 'etlmart.inc.php?id_maping={$Isi['id_maping']}', dataType:'json',
				success:function(data){
					var status=data.status;
                    if(status == '1'){
						AddItems(data.result,'','1');						
						AddItems('Proses Insert Status Pengiriman...!','','0');						
						AddItems('UNTUK SELANJUTNYA SILAHKAN ANDA MELAKUKAN CEK DATA SEBELUM MELAKUKAN PENGIRIMAN...!','','0');
						AddItems('===================================================================================','','0');
						
					}else{
						AddItems(data.result,'','1');						
						AddItems('Tidak Bisa Melanjutkan Proses...!','','0');
						AddItems('===================================================================================','','0');
					}
					{$txthidden}
				}
			}); 
		";
		$ListMode.="
			<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
				<td align=center>$i</td>
				<td onclick=\"Fm.id_maping.value='{$Isi['id_maping']}';Fm.Action.value='BknSimpan';Fm.submit();\">{$Isi['dbsumber']}</td>				
				<td>{$Isi['query_sumber']}</td>					
				<td>{$Isi['dbdwh']}</td>
				<td>{$Isi['table_dwh']}</td>
			</tr>
		";$i++;
	}
	
	$List="
		<script>
		   $(document).ready(function() {  
			   document.getElementById('proses_loading').style.visibility='hidden';
				
					document.getElementById('isidata').innerHTML = '';
					document.getElementById('ambilDataAjax').style.visibility='hidden';
					document.getElementById('proses_loading').style.visibility='visible';
					{$Script}
					
				     
			});
		</script>

		".$Func->tabSplit("Maping Database")."
		<p align=right>
		<input type='button' align=right value='Run Jobs' class='button' id='ambilDataAjax'/>

		</p>
		<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
		<thead>
		<tr>
			<th width=10 rowspan=2>".$Func->SortHeader("No.")."</th>
			<th colspan=2>".$Func->SortHeader("Data DWH")."</th>
			<th colspan=2>".$Func->SortHeader("Tujuan Data Mart")."</th>
		
		</tr>
		<tr>
			<th>".$Func->SortHeader("Database")."</th>
			<th>".$Func->SortHeader("Query")."</th>
			<th>".$Func->SortHeader("Database")."</th>
			<th>".$Func->SortHeader("Table")."</th>
		</tr>
			<tbody>$ListMode</tbody>
		</table>
	
	";
	
	
	$Info="
		".$Func->tabSplit("Informasi Proses ETL")."
		  <select name='isidata' id='isidata' multiple='multiple' style='width:100%;height:350px;background:#000000;border:0pxz-index:98;' disabled='true'>
		</select>
		 <div style='width:50px;height:50px;position:absolute;right:25%;top:300px;z-index:99;' id='proses_loading'>
			<img src='{$Dir->Images}/loading3.gif' style='width:80px;height:80px' border='0' alt='0'>
		 </div>
	";
	$Main->Isi="
	<script>
	  var plappend = true;
    var plappend_head = false;
    var plappend_det = false; 
    var plappend_rin = false;
    var rec=0;
    var satuan=0;
    var posisi=0;
    var sukses=0;
    var gagal=0;
    var ujung=true;
    var current=0;
    var aa=0;
    var lcpesan='';
	function AddItems(isi,pesan,tambah)
		{

			//progress bar
			//if (tambah=='1'){
			//	posisi=posisi+satuan;
			//	$('.progress-bar').attr({'aria-valuetransitiongoal': posisi});
			//	$('.progress-bar').progressbar({display_text: 'fill'});
			//	$('.h-default-themed .progress-bar').progressbar();
			//}

			
			//=============================================================
			var mySel = document.getElementById('isidata'); 
            var myOption; 

            myOption = document.createElement('Option'); 
            myOption.text = isi; 
            myOption.value = isi; 
			if(pesan!=''){
				if (tambah=='1'){
					gagal=gagal+1;
		        }
				myOption.style = 'color:red;font-family:courier new;'; 
			}else{
				if (tambah=='1'){
					sukses=sukses+1;
				}
	            myOption.style = 'color:white;font-family:courier new;'; 			
	            //myOption.style = 'color:green;font-family:courier new;'; 			
			}
			mySel.add(myOption);			
			bawah();

			if(current>=rec){
				
			    //setTimeout(function(){
				//	$('.progress-bar').attr({'aria-valuetransitiongoal': 0});
				//	$('.progress-bar').progressbar({display_text: 'fill'});
				//	$('.h-default-themed .progress-bar').progressbar();
			    //},2000);
			}
		}
		function bawah() {
			var objDiv = document.getElementById('isidata');
			objDiv.scrollTop = objDiv.scrollHeight;
			return false;
		}

		
	</script>
	<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr#transaksi' enctype='multipart/form-data'>
	
	<table width='100%'>
	<tr>
		<td width='50%' valign=top>{$List}</td>
		<td width='50%' valign=top>{$Info}</td>
	</tr>
	</table>
	".$Func->txtField('id_maping',$id_maping,'','','hidden')."
	".$Func->txtField('Action',$Action,'','','hidden')."
	</form>
	
	";
	echo "
			<script src='./templates/baru/scripts/jquery-1.3.2.min.js' type='text/javascript'></script>
			<link rel='stylesheet' type='text/css' href='{$Dir->Css}/default.css'>
			<link rel='stylesheet' type='text/css' href='{$Dir->Css}/pageNavi.css'>
			<script>function next(ID){if (event.keyCode == 13)document.getElementById(ID).focus();}</script>
			<!-- Imat-Jquery -->
			
			<script src='{$Dir->Library}/imat-jquery/grid.js' type='text/javascript'></script>
			<script language='javascript' src='{$Dir->Library}/imat-jquery/basescript.js'></Script>

			
			<script src='{$Dir->Library}/imat-jquery/jquery/jquery.tablesorter.min.js' type='text/javascript'></script>
			<script src='{$Dir->Library}/imat-jquery/jquery/jquery.datepick.js' type='text/javascript'></script>
			<script src='{$Dir->Library}/imat-jquery/jquery/jquery.datepick-id.js' type='text/javascript'></script>
			<script src='{$Dir->Library}/imat-jquery/jquery/jquery.elastic.js' type='text/javascript'></script>
			<script src='{$Dir->Library}/imat-jquery/jquery/fcbkcomplete.min.js' type='text/javascript'></script>

			<script type='text/javascript' src='{$Dir->Library}/imat-jquery/jquery/upload/swfobject.js'></script>
			<script type='text/javascript' src='{$Dir->Library}/imat-jquery/jquery/upload/jquery.uploadify.v2.1.0.min.js'></script>
			<script type='text/javascript' src='{$Dir->Library}/imat-jquery/jquery.form.js'></script>
			<script src='{$Dir->Library}/imat-jquery/imatjquery.js' type='text/javascript'></script>

			<link rel='stylesheet' type='text/css' href='{$Dir->Library}/imat-jquery/jquery/stylefcbk.css'>
			<link rel='stylesheet' type='text/css' href='{$Dir->Library}/imat-jquery/jquery/jquery.datepick.css'>
			
			<link rel='stylesheet' type='text/css' href='{$Dir->Library}/imat-jquery/jquery/themes/blue/style.css'>				
			<script src='{$Dir->Library}/uang.js' type='text/javascript'></script>
	";
	echo $Main->Isi;
?>

