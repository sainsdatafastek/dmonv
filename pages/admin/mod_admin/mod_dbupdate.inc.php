<?php
	$Qry=_mysql_query("select TABLE_SCHEMA, jmltable, update_data, update_table from database_update");
	$wr="";$i=1;
	if(_mysql_num_rows($Qry)>0)
	{		
		while($Isi=_mysql_fetch_array($Qry))
		{			
			
			$ListMode.="
				<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'')\" >
					<td align=center>$i</td>
					<td>{$Isi['TABLE_SCHEMA']}</td>				
					<td align=center>{$Isi['jmltable']}</td>
					<td align=center>{$Isi['update_data']}</td>
					<td align=center>{$Isi['update_table']}</td>
				</tr>
			";$i++;
			
		}
		$nohal=$i-1;
	}//<th>".$Func->SortHeader("Kredit")."</th>

	
	$Main->Isi .="
	
	<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
	<thead>
		<tr>
			<th width=10>".$Func->SortHeader("No.")."</th>
			<th>".$Func->SortHeader("Nama Database")."</th>
			<th>".$Func->SortHeader("Jumlah Tabel")."</th>
			<th>".$Func->SortHeader("Update Data")."</th>
			<th>".$Func->SortHeader("Update Table")."</th>
		</tr>
		</thead>
		<tbody>$ListMode</tbody>
	</table>	
		".$Func->txtField('id',$id,'','','hidden')."
	</FORM>
	$link
	";
?>