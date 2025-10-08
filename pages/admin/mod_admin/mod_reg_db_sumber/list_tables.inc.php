<?php
$ListMode="";$i=1;
	$Func->ambilData("select id_dbname, dbname, hostname, username, `password` from reg_db_sumber where dbname='{$dbname}'");
	$con00 = mysqli_connect($hostname, $username, $password, $dbname);
	$Qry = mysqli_query($con00,"SHOW TABLE STATUS FROM `{$dbname}`;");
	 while($Isi=mysqli_fetch_array($Qry,MYSQLI_ASSOC)){
		$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
		$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
		$Comment=!empty($Isi['Comment'])?$Isi['Comment']:"Tables";
		$ListMode.="
			<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
				<td align=center>$i</td>
				<td>{$Isi['Name']}</td>
				<td>{$Isi['Engine']}</td>	
				<td>{$Isi['Rows']}</td>	
				<td>{$Isi['Create_time']}</td>	
				<td>{$Isi['Update_time']}</td>	
				<td>{$Comment}</td>	
			</tr>
		";$i++;
	}

	$IsiList="
		<p align=right>
		<input type='button' align=right value='Query Console' class='button' onclick=\"javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=console_query&dbname=$dbname')\"/>

		<input type='button' align=right value='Tambah Query' class='button' onclick=\"javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_cquery&dbnameid=$dbname')\"/>
		</p>

			
		<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
		<thead>
		<tr>
			<th width=10>".$Func->SortHeader("No.")."</th>
			<th>".$Func->SortHeader("Nama Tabel")."</th>
			<th>".$Func->SortHeader("Mesin")."</th>
			<th>".$Func->SortHeader("Jumlah Baris")."</th>
			<th>".$Func->SortHeader("Tgl. Pembuatan")."</th>
			<th>".$Func->SortHeader("Tgl. Update")."</th>
			<th>".$Func->SortHeader("Jenis Tabel")."</th>
		</tr>
			<tbody>$ListMode</tbody>
		</table>

	";
?>