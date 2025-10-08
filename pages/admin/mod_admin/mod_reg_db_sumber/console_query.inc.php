<?php
	$Show = $Func->gFile("{$Main->Tema}/kosong.html");	
	$dbname=!empty($dbname)?$dbname:"";

	$query_script=!empty($query_script)?$query_script:"";
	$ListMode="";
	$List="";

	
	$Func->ambilData("select id_dbname, dbname, hostname, username, `password` from reg_db_sumber where dbname='{$dbname}'");
	
	$con00 = mysqli_connect($hostname, $username, $password, $dbname);
	
	if($Aksi=="goQuery"){
		
		$Qry = mysqli_query($con00,"$query_script limit 10");
		if(mysqli_num_rows($Qry)>0){
			$ListMode="";$th="";$td="";$i=1;			
			/// IDENTIFIKASI FIELDS
			while ($Field=mysqli_fetch_field($Qry)){
				$th.="<th>".$Func->SortHeader($Field->name)."</th>";
				$td.="<td>{[|]Isi['".$Field->name."']}</td>";
			}
			$td=str_replace("[|]","$",$td);
			 
			/// LIST DATA
			 while($Isi=mysqli_fetch_array($Qry,MYSQLI_ASSOC)){
				$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
				$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
				eval("\$tdData = \"$td\";");
				$ListMode.="
					<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
						<td align=center>$i</td>
						{$tdData}	
					</tr>
				";$i++;
			 }

			$List="
				".$Func->tabSplit("List Data Filter Limit 10 Record")."
				<div style='max-height:450px;width:650px;overflow-y:auto;overflow-x:visible' align=center> 
				<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
				<thead>
				<tr>
					<th>".$Func->SortHeader("No")."</th>
					$th
				</tr>
					<tbody>$ListMode</tbody>
				</table>
				</div>
			";
		}
	}
	if(!empty($id)){
		$Func->ambildata("select query_script from reg_db_sumber_query where id_query='$id'");
	}
	$Main->Isi="
		<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr' enctype='multipart/form-data'>
			<table border=0>
			<tr>
				<td>Script Query</td>
			</tr>
			<tr>
				
				<td> <textarea name='query_script' rows='query_script' style='width:665px;height:100px;font-family:consolas;font-size:10pt;'>$query_script</textarea>
			</tr>
			<tr>
			
				<td style='border:0px' align=right>
					<input type='button' class='button' value='Go' onclick=\"Fm2.Aksi.value='goQuery';submitForm('#Fm2', '#faceboxisi', Fm2.action);\">
				</td>
			</tr>
			</table>
			$List
			".$Func->txtField('dbname',$dbname,'','','hidden')."
			".$Func->txtField('Mode',$Mode,'','','hidden')."
			".$Func->txtField('Aksi',$Aksi,'','','hidden')."
			".$Func->txtField('id',$id,'','','hidden')."
			".$Func->txtField('Pg',$Pg,'','','hidden')."
			".$Func->txtField('Pr',$Pr,'','','hidden')."
			".$Func->txtField('Sb',$Sb,'','','hidden')."
		</form>
	";

	$Main->Isi = $Func->Kotak($Main->MenuHeader." [Console Query]",$Main->Isi,'100%');
?>