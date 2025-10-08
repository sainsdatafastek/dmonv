<?php
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');
	
	$dbname=!empty($dbname)?$dbname:"";
	$table_name=!empty($table_name)?$table_name:"";

	if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');

	/** Include PHPExcel */
	require_once './library/Classes/PHPExcel.php';
	$ListMode="";
	$Main->Isi="";
	$KatHide=!empty($KatHide)?$KatHide:"";
	$JBerhasil=!empty($JBerhasil)?$JBerhasil:0;
	$JGagal=!empty($JGagal)?$JGagal:0;
	$sheetname="ORDER";
	$Ektensi=$Func->getExtension(@stripslashes(@$_FILES['FILE']['name']));
	$Aksi=!empty($Aksi)?$Aksi:"";
	
	IF($Aksi=="Simpan"){
		switch($Ektensi)
		{
			case "xls":$inputFileType='Excel5';break;
			case "xlsx":$inputFileType='Excel2007';break;
			case "xml":$inputFileType='Excel2003XML';break;
			case "ods":$inputFileType='OOCalc';break;
			case "gnumeric":$inputFileType='Gnumeric'; break;
			case "":default:
				$inputFileType="";
				$Pesan=$Func->ViewPesan("Maaf, file ektensi anda tidak terdefinisi silahkan cek kembali");
			break;
		}
	}
	IF($Aksi=="Simpan" && !empty($inputFileType))
	{
		$Qry=_mysql_query("select `field` as 'name' from reg_db_dwh_field where dbname='{$dbname}' and table_name='{$table_name}'  order by `primary` desc, urutan asc");
		
		$JField=1;
		$QInsert="";$QInsertData="";$QUpdate="";
		$th="";$td="";
		while ($Field=_mysql_fetch_array($Qry)){
		
			$QInsert.=$Field['name'].",";
			$QInsertData.= "'{[|]sheetData[[|]i+1][[|]Ref->Abjad[".($JField-1)."]]}',";
			$QUpdate.=$Field['name']."='{[|]sheetData[[|]i+1][[|]Ref->Abjad[".($JField-1)."]]}',";

			$th.="<th>".$Func->SortHeader($Field['name'])."</th>";
			$td.="<td>{[|]sheetData[[|]i+1][[|]Ref->Abjad[".($JField-1)."]]}</td>";
			$JField++;
		}

		$Qry=_mysql_query("select `field` from reg_db_dwh_field where dbname='{$dbname}' and table_name='{$table_name}' and `primary`='1' order by `primary` desc, urutan asc");
		$SetParam="";$JField=1;
		if(_mysql_num_rows($Qry)>0){
			while($Isi=_mysql_fetch_array($Qry)){
				$SetParam.="`{$Isi['field']}`='{[|]sheetData[[|]i+1][[|]Ref->Abjad[".($JField-1)."]]}' and ";
				$JField++;
			}
			$SetParam="where ".$SetParam;
		}else{
			$SetParam="";
		}


		$QInsert=substr($QInsert, 0, -1);	
		$QInsertData=substr($QInsertData, 0, -1);
		$QUpdate=substr($QUpdate, 0, -1);
		$SetParam=substr($SetParam, 0, -5);
		
		$QInsertData=str_replace("[|]","$",$QInsertData);
		$QUpdate=str_replace("[|]","$",$QUpdate);
		$td=str_replace("[|]","$",$td);
		$SetParam=str_replace("[|]","$",$SetParam);



		

		
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objReader->setLoadAllSheets();
		$inputFileName = $_FILES['FILE']['tmp_name'];
		$objPHPExcel = $objReader->load($inputFileName);	
		$loadedSheetNames = $objPHPExcel->getSheetNames();
		foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
			//////////////// NAME SHEAT
			$sheetname = $loadedSheetName;

			$objReader->setLoadSheetsOnly($sheetname);
			$objPHPExcel = $objReader->load($inputFileName);		
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);	
			$i=1;
			while(count($sheetData)>$i)
			{					
				eval("\$vQInsertData = \"$QInsertData\";");
				eval("\$vQUpdate = \"$QUpdate\";");
				eval("\$vtd = \"$td\";");
				eval("\$vSetParam = \"$SetParam\";");

				if(!empty($sheetData[$i+1]['A']))
				{
					
					$Qry=_mysql_query("select * from ".$dbname.".".$table_name." ".$vSetParam);						
					if(_mysql_num_rows($Qry)>0)
					{
						$QSimpan="UPDATE ".$dbname.".".$table_name." SET ".$vQUpdate." ".$vSetParam." limit 1;";		
					}else{
						$QSimpan="INSERT INTO ".$dbname.".".$table_name."(".$QInsert.") VALUES (".$vQInsertData.");";
					}
					//echo $QSimpan."<br>";
					$Simpan = _mysql_query($QSimpan) or  $Func->ViewPesan("Gagal di simpan, ".mysql_error(),0);
					
					$Pesan = $Simpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan, ".mysql_error(),0);	

					if($Simpan)
					{$JBerhasil++;}
					else
					{
						$ListMode.="
						<tr style='background-color:#ff9900;'>
							".$vtd."
						</tr>";$JGagal++;
					}
				}$i++;
			}						
		}
			
	}	
	if(!empty($JBerhasil) || !empty($JGagal))
	{
		$Pesan = $Func->ViewPesan("Data Yang berhasil tersimpan : <span style='color:green;'>$JBerhasil Record</span> dan Jumlah data yang Gagal : <span style='color:red;'>$JGagal Record</span>");
	}
	$IsiContent=!empty($IsiContent)?$IsiContent:"";

		
	
	if($JGagal>0)
	{
		$IsiContent.="
				<b>Data Sheet : ".trim($sheetname)."</b>

				<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center  class='noprint'>
				<thead>
				<tr class='noprint'>
					".$th."
				</tr>			
				</thead>
					<tbody>".$ListMode."</tbody>
				</table>
			";
		$IsiContent="
		<span style='color:green;font-weight:bold;'>:: List Data Import Error</span>
		<DIV id=smile style='width:800px;height:300;overflow:auto;margin-top:3px;margin-left:3px;margin-right:3px;margin-bottom:3px' >
		$IsiContent
		</div>";
	}else{$IsiContent="";}

	
	$FILE=!empty($FILE)?$FILE:"";
	$DownloadFile="";
	if(!empty($table_name)){
		$DownloadFile="[<a href='download_excel.inc.php?dbname=$dbname&table_name=$table_name' target=_blank> Download Format</a>]";
	}

	$Main->Isi="		
		<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr#transaksi' enctype='multipart/form-data'>

			$Pesan
			<table>
			<tr>
				<td>Database</td>
				<td>".$Func->cmbQuery("dbname",$dbname,"select dbname, dbname from reg_db_dwh","onchange=\"Fm2.Aksi.value='BknSimpan';Fm2.submit();\"")."</td>
			</tr>
			<tr>
				<td>Table</td>
				<td>".$Func->cmbQuery("table_name",$table_name,"select table_name, table_name from reg_db_dwh_table where dbname='{$dbname}'","onchange=\"Fm2.Aksi.value='BknSimpan';Fm2.submit();\"")."</td>
			</tr>
			<tr>
				<td>Upload File</td>
				<td>".$Func->txtField('FILE',@$FILE,'100','50','file')."</td>
			</tr>
			</table>
			<input type='button' value='Simpan' class='button' 
			onclick=\"Fm2.Aksi.value='Simpan';Fm2.submit();\"/>	
			$DownloadFile
			</p>
			</div>
			$IsiContent
		
		".$Func->txtField('Mode',$Mode,'','','hidden')."
		".$Func->txtField('Aksi',$Aksi,'','','hidden')."
		".$Func->txtField('Pr',$Pr,'','','hidden')."
		".$Func->txtField('Sb',$Sb,'','','hidden')."
		</form>
	";	
	

	
?>