<?php
	$Show = $Func->gFile("{$Main->Tema}/kosong.html");
			
			$ListMode="";$i=1;$Pesan="";
			$Aksi=!empty($Aksi)?$Aksi:"";
			$username=!empty($username)?$username:$id;
			$kd_hak_akses=!empty($kd_hak_akses)?$kd_hak_akses:"";

			switch($Aksi)
			{
				case "Simpan";
					foreach ($id_sub as $k=>$v) {						
						
						
						if($aktif[$k]=="Y")
						{
							$Qry=_mysql_query("select * from `__t_hak_akses` where username='$id' and id_sub='$id_sub[$k]'");
							if(!_mysql_num_rows($Qry))
							{
								$QSimpan="INSERT INTO `__t_hak_akses` (`username`, `id_sub`) VALUES ('$id', '$id_sub[$k]');";
								$Simpan = _mysql_query($QSimpan) or  $Func->ViewPesan("Gagal di simpan, ".mysql_error(),0);
								$Pesan = $Simpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan, ".mysql_error(),0);	
							}
						}						
						else
						{
							_mysql_query("DELETE FROM `__t_hak_akses` WHERE  `username`='$id' AND `id_sub`='$id_sub[$k]' LIMIT 1;");	
						}
					}				
					
					
				break;
			}

			$ListMode="";$i=1;
			$Qry=_mysql_query("select id_sub, nama_menu, nama_sub from __v_menu_aktif order by id_main, id_sub");
			while($Isi=_mysql_fetch_array($Qry))
			{
				if(_mysql_num_rows(_mysql_query("select * from __v_menu where username='$id' and id_sub='{$Isi['id_sub']}'"))>0){$aktif="Y";}else{$aktif="N";}

				$ListMode.="
					<tr onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
						<td align=center>$i</td>
						<td>{$Isi['nama_menu']}</td>
						<td>{$Isi['nama_sub']}</td>
						<td align=center>".$Func->rdAktif("aktif[$i-1]",$aktif)."</td>
						".$Func->txtField("id_sub[$i-1]",$Isi['id_sub'],'','','hidden')."
					</tr>
				";$i++;
			}
			$Main->Isi="
				$Pesan
				<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr' enctype='multipart/form-data'>	
					<table class='tablesorter2' align=right>
					<tr>
						<td></td>
						<td align=right><input type='button' class='button' value='Simpan' onclick=\"Fm2.Aksi.value='Simpan';submitForm('#Fm2', '#faceboxisi', Fm2.action);\"></td>
					</tr>
					</table>
					<br><br>
					".$Func->txtField('id',$id,'','','hidden')."
					".$Func->txtField('Pr',$Pr,'','','hidden')."
					".$Func->txtField('Mode',$Mode,'','','hidden')."
					".$Func->txtField('Aksi',$Aksi,'','','hidden')."
					<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
					<thead>
						<tr>
							<th width=10>".$Func->SortHeader("No.")."</th>
							<th>".$Func->SortHeader("Main Menu")."</th>
							<th>".$Func->SortHeader("Sub Menu")."</th>
							<th></th>									
						</tr>
						</thead>
						<tbody>$ListMode</tbody>
					</table>
				</form>

			";
			$Main->Isi = $Func->Kotak("Hak Akses Member",$Main->Isi,'100%');
?>