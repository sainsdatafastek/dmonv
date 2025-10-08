<?php
	$dbname=!empty($dbname)?$dbname:"";
	//////////// TABLE LIST
		/// DATABASES
	$ListMode="";$i=1;	
	$TextTemp="tmp";
	///// PARAMETER AND QUERY GRID
	$Qry="select id_dbname, dbname, hostname, username, `password` from reg_db_sumber order by  hostname";
	$Qry=_mysql_query($Qry);

	///// LIST GRID
	while($Isi=_mysql_fetch_array($Qry)){
		$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
		$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
		
		$ListMode.="
			<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
				<td align=center>$i</td>
				<td onclick=\"Fm.dbname.value='{$Isi['dbname']}';Fm.submit();\">{$Isi['dbname']}</td>
				<!-- <td onclick=\"Fm.dbname.value='{$Isi['dbname']}';Fm.submit();\">".trim($TextTemp).$Isi['dbname']."</td> -->
				<td>{$Isi['hostname']}</td>					
				<td>{$Isi['username']}</td>
				<td>{$Isi['password']}</td>

				<td width=10 onclick=\"javascript:showPopUp('400','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail&Aksi=Lihat&id={$Isi['id_dbname']}')\">
					<img src='{$Dir->Images}/icon/edit.gif'>
				</td>
				<td width=10 onclick=\"Cek=confirm('Yakin {$Isi['dbname']} akan dihapus?');if(!Cek){return false;}else{javascript:showPopUp('400','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail&Aksi=Hapus&id={$Isi['id_dbname']}')}\">

					<img src='{$Dir->Images}/icon/hapus.gif'>
				</td>
			</tr>
		";$i++;
	}
	
	$List="
		".$Func->tabSplit("List Databases Sumber")."
		<p align=right>
		<input type='button' align=right value='Tambah' class='button' onclick=\"javascript:showPopUp('400','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail')\"/>
		</p>
		<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
		<thead>
		<tr>
			<th width=10>".$Func->SortHeader("No.")."</th>
			<th>".$Func->SortHeader("Nama Database Sumber")."</th>
			<!-- <th>".$Func->SortHeader("Nama Database Temporary")."</th> -->
			<th>".$Func->SortHeader("Hostname ")."</th>
			<th>".$Func->SortHeader("Username")."</th>
			<th>".$Func->SortHeader("Password")."</th>
			<th colspan=2>&nbsp;</th>	
		</tr>
			<tbody>$ListMode</tbody>
		</table>
		$link
	";
	if(!empty($dbname)){
		
		
		$Tab[0] = $Func->tabOff("List Query Database : ".strtoupper($dbname),"parent.location='index.php?Pg=$Pg&Pr=$Pr&dbname=$dbname'");
		$Tab[1] = $Func->tabOff("List Tables Database : ".strtoupper($dbname),"parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=list_tables&dbname=$dbname'");

		$Sb = isset($Sb)?$Sb:"";
		switch($Sb)
		{
			case "list_tables":
				$Tab[1] = $Func->tabOn("<b>List Tables Database : ".strtoupper($dbname)."</b>");
				include "{$Dir->ModAdmin}reg_db_sumber/list_tables.inc.php";
			break;
			default:
				$Tab[0] = $Func->tabOn("<b>List Query Database : ".strtoupper($dbname)."</b>");
				include "{$Dir->ModAdmin}reg_db_sumber/list_query.inc.php";				
		}	

		$List.="
			<hr>
			".$Func->tabSplit("Register. Query")."
			<TABLE cellpadding='0' cellspacing='0' background='{$Dir->Images}/tabbottom.gif' width='100%'>
			<TR>
				<TD>$Tab[0]</TD>
				<TD>$Tab[1]</TD>
				<TD> </TD>
			</TR>
			</TABLE>
			<P>
			$IsiList
		";
		
	}
		/// LIST TABLES

	/////////// FORM
	$Form="";

	$Main->Isi="
	<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr#transaksi' enctype='multipart/form-data'>
	{$Form}{$List}
	".$Func->txtField('dbname',$dbname,'','','hidden')."
	</form>
	
	";
	
?>