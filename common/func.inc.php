<?php
	class jabarsoft{
		function __construct(){}
		function ConvertVar($Content){
			$Content=str_replace("{St}","$",$Content);
			$Content=str_replace("{|+}",'".',$Content);
			$Content=str_replace("{+|}",'."',$Content);
			return $Content;
		}

		function Jurnal2wh($kd="", $fSbb="",$fnobukti="",$tgltrn="",$fNominal="",$fKet="",$fField="",$fValue="",$f2Field="",$f2Value=""){
			global $sUserId,$TANGGAL_AKSES; 
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh="";
			$wh.=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";
			$f2Field=trim($f2Field);$f2Value=trim($f2Value);
			$wh.=!empty($f2Field)?"and a.".trim($f2Field)." ='".$f2Value."'":"";
			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			
			$nosbb=$Isi['nosbb'];

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValue2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			$f2Value2=!empty($f2Value)?$f2Value:"";
			$f2Value=!empty($f2Value)?"-".$f2Value:"";
			
			if(!empty($fnobukti)&&!empty($nosbb)){
			$Qry=_mysql_query("select * from `keu_toftrnc` where `nobukti`='{$fnobukti}'");
				if(_mysql_num_rows($Qry)>0){
					_mysql_query("UPDATE `keu_toftrnc` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `nobukti`='{$fnobukti}';");
					_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$f2Value}{$fKet}', '{$fValue2}{$f2Value2}');");					
				}else{
					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fnobukti}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_toftrnc` (`nobukti`, `tgltrn`, `inpuser`, `inptgl`) VALUES ('{$fnobukti}', '{$tgltrn}', '{$sUserId}', '{$TANGGAL_AKSES}');");	

						_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$f2Value}{$fKet}', '{$fValue2}{$f2Value2}');");

					}
				}

				$CodeLB=3900000000;
				if ($nosbb != $CodeLB){
					$cjml=_mysql_num_rows(_mysql_query("select * from keu_tblgl as a where a.nosbb ='$nosbb' and a.acctype in ('5','4');"));
					if ($cjml > 0){
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}' , '{$CodeLB}', '{$fNominal}', 'LABA RUGI', '".strtoupper($kd)."  {$nosbb}  LABA RUGI AUTO');");			
					}
				}
			}
		}
		
		function Jurnal3wh($kd="", $fSbb="",$fnobukti="",$tgltrn="",$fNominal="",$fKet="",$fField="",$fValue="",$fField2="",$fValue2="",$fField3="",$fValue3=""){
			global $sUserId,$TANGGAL_AKSES; 
			$wh="";
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh.=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";

			$fField2=trim($fField2);$fValue2=trim($fValue2);
			$wh.=!empty($fField2)?"and a.".trim($fField2)." ='".$fValue2."'":"";
	
			$fField3=trim($fField3);$fValue3=trim($fValue3);
			$wh.=!empty($fField3)?"and a.".trim($fField3)." ='".$fValue3."'":"";

			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			
			$nosbb=$Isi['nosbb'];

//			echo "select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh";

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValueF2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			$fValue2F2=!empty($fValue2)?$fValue2:"";
			$fValue2=!empty($fValue2)?"-".$fValue2:"";

			$fValue3F2=!empty($fValue3)?$fValue3:"";
			$fValue3=!empty($fValue3)?"-".$fValue3:"";
			
			if(!empty($fnobukti)&&!empty($nosbb)){

			$Qry=_mysql_query("select * from `keu_toftrnc` where `nobukti`='{$fnobukti}'");			
				if(_mysql_num_rows($Qry)>0){						
					_mysql_query("UPDATE `keu_toftrnc` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `nobukti`='{$fnobukti}';");
					_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue2F2}{$fValue3F2}');");	

				//	ECHO "KAHIJI - INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue2F2}{$fValue3F2}');<HR>";
				}else{

					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fnobukti}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_toftrnc` (`nobukti`, `tgltrn`, `inpuser`, `inptgl`) VALUES ('{$fnobukti}', '{$tgltrn}', '{$sUserId}', '{$TANGGAL_AKSES}');");	
						_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue3F2}{$fValue3F2}');");

//						ECHO "KADUA - INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue3F2}{$fValue3F2}');<HR>";

					}
				}

				$CodeLB=3900000000;
				if ($nosbb != $CodeLB){
					$cjml=_mysql_num_rows(_mysql_query("select * from keu_tblgl as a where a.nosbb ='$nosbb' and a.acctype in ('5','4');"));
					if ($cjml > 0){
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}' , '{$CodeLB}', '{$fNominal}', 'LABA RUGI', '".strtoupper($kd)."  {$nosbb}  LABA RUGI AUTO');");			
					}
				}
			}
		}
		
		function Jurnal3whPersen($kd="", $fSbb="",$fnobukti="",$tgltrn="",$fNominal="",$fKet="",$fField="",$fValue="",$fField2="",$fValue2="",$fField3="",$fValue3=""){
			global $sUserId,$TANGGAL_AKSES; 
			$wh="";
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh.=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";

			$fField2=trim($fField2);$fValue2=trim($fValue2);
			$wh.=!empty($fField2)?"and a.".trim($fField2)." ='".$fValue2."'":"";
	
			$fField3=trim($fField3);$fValue3=trim($fValue3);
			$wh.=!empty($fField3)?"and a.".trim($fField3)." ='".$fValue3."'":"";

			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb, a.persen from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			


//			echo "select a.nosbb, a.persen from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh";

			$nosbb=$Isi['nosbb'];
			$persen=$Isi['persen'];
			
			$fNominal=round(($fNominal*$persen)/100,2);

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValueF2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			$fValue2F2=!empty($fValue2)?$fValue2:"";
			$fValue2=!empty($fValue2)?"-".$fValue2:"";

			$fValue3F2=!empty($fValue3)?$fValue3:"";
			$fValue3=!empty($fValue3)?"-".$fValue3:"";
			
			if(!empty($fnobukti)&&!empty($nosbb)){
			$Qry=_mysql_query("select * from `keu_toftrnc` where `nobukti`='{$fnobukti}'");			
				if(_mysql_num_rows($Qry)>0){						
					_mysql_query("UPDATE `keu_toftrnc` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `nobukti`='{$fnobukti}';");
					_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue2F2}{$fValue3F2}');");
				}else{
					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fnobukti}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_toftrnc` (`nobukti`, `tgltrn`, `inpuser`, `inptgl`) VALUES ('{$fnobukti}', '{$tgltrn}', '{$sUserId}', '{$TANGGAL_AKSES}');");	
						_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue3F2}{$fValue3F2}');");

					}
				}

				$CodeLB=3900000000;
				if ($nosbb != $CodeLB){
					$cjml=_mysql_num_rows(_mysql_query("select * from keu_tblgl as a where a.nosbb ='$nosbb' and a.acctype in ('5','4');"));
					if ($cjml > 0){
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}' , '{$CodeLB}', '{$fNominal}', 'LABA RUGI', '".strtoupper($kd)."  {$nosbb}  LABA RUGI AUTO');");			
					}
				}
			}
		}


		function Jurnal($kd="", $fSbb="",$fnobukti="",$tgltrn="",$fNominal="",$fKet="",$fField="",$fValue=""){
			global $sUserId,$TANGGAL_AKSES; 
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";
			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			

			
			$nosbb=$Isi['nosbb'];

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValue2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";
			
			if(!empty($fnobukti)&&!empty($nosbb)){
			$Qry=_mysql_query("select * from `keu_toftrnc` where `nobukti`='{$fnobukti}'");			
				if(_mysql_num_rows($Qry)>0){						
					_mysql_query("UPDATE `keu_toftrnc` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `nobukti`='{$fnobukti}';");
					_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fKet}', '{$fValue2}');");					
				}else{
					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fnobukti}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_toftrnc` (`nobukti`, `tgltrn`, `inpuser`, `inptgl`) VALUES ('{$fnobukti}', '{$tgltrn}', '{$sUserId}', '{$TANGGAL_AKSES}');");	
						_mysql_query("DELETE FROM `keu_toftrnc_detail` WHERE  `nobukti`='{$fnobukti}' AND `noperk`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}', '{$nosbb}', '{$fNominal}', '{$fnobukti}{$fValue}{$fKet}', '{$fValue2}');");

					}
				}

				$CodeLB=3900000000;
				if ($nosbb != $CodeLB){
					$cjml=_mysql_num_rows(_mysql_query("select * from keu_tblgl as a where a.nosbb ='$nosbb' and a.acctype in ('5','4');"));
					if ($cjml > 0){
						_mysql_query("INSERT INTO `keu_toftrnc_detail` (`nobukti`, `noperk`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fnobukti}' , '{$CodeLB}', '{$fNominal}', 'LABA RUGI', '".strtoupper($kd)." {$nosbb} LABA RUGI AUTO');");			
					}
				}
			}
		}
		##################  BUKU KAS
		function BukuKas($mSbb="",$kd="", $fSbb="",$fno_transaksi="",$tgl_transaksi="",$fNominal="",$fKet="",$fField="",$fValue=""){
			global $sUserId,$TANGGAL_AKSES; 
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";
			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));	

			$nosbb=$Isi['nosbb'];
			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValue2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			if(!empty($fno_transaksi)&&!empty($nosbb)){
			$Qry=_mysql_query("select * from `keu_bukukas` where `no_transaksi`='{$fno_transaksi}'");			
				if(_mysql_num_rows($Qry)>0){						

					_mysql_query("UPDATE `keu_bukukas` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `no_transaksi`='{$fno_transaksi}';");
					_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$fKet}', '{$fValue2}');");					
				}else{
					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fno_transaksi}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_bukukas` (`no_transaksi`, `tgl_transaksi`, `inpuser`, `inptgl`,`nosbb_k`) VALUES ('{$fno_transaksi}', '{$tgl_transaksi}', '{$sUserId}', '{$TANGGAL_AKSES}', '$mSbb');");	
						_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$fKet}', '{$fValue2}');");
					}
				}

			}
		}

function BukuKas2wh($mSbb="",$kd="", $fSbb="",$fno_transaksi="",$tgl_transaksi="",$fNominal="",$fKet="",$fField="",$fValue="",$f2Field="",$f2Value=""){
			global $sUserId,$TANGGAL_AKSES; 
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh="";
			$wh.=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";
			$f2Field=trim($f2Field);$f2Value=trim($f2Value);
			$wh.=!empty($f2Field)?"and a.".trim($f2Field)." ='".$f2Value."'":"";
			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			
			$nosbb=$Isi['nosbb'];

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValue2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			$f2Value2=!empty($f2Value)?$f2Value:"";
			$f2Value=!empty($f2Value)?"-".$f2Value:"";
			
			if(!empty($fno_transaksi)&&!empty($nosbb)){
			$Qry=_mysql_query("select * from `keu_bukukas` where `no_transaksi`='{$fno_transaksi}'");
				if(_mysql_num_rows($Qry)>0){
					_mysql_query("UPDATE `keu_bukukas` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `no_transaksi`='{$fno_transaksi}';");
					_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$f2Value}{$fKet}', '{$fValue2}{$f2Value2}');");					
				}else{
					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fno_transaksi}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_bukukas` (`no_transaksi`, `tgl_transaksi`, `inpuser`, `inptgl`, `nosbb_k`) VALUES ('{$fno_transaksi}', '{$tgl_transaksi}', '{$sUserId}', '{$TANGGAL_AKSES}', '$mSbb');");	

						_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$f2Value}{$fKet}', '{$fValue2}{$f2Value2}');");

					}
				}
			}

		}
		
		function BukuKas3wh($mSbb="",$kd="", $fSbb="",$fno_transaksi="",$tgl_transaksi="",$fNominal="",$fKet="",$fField="",$fValue="",$fField2="",$fValue2="",$fField3="",$fValue3=""){
			global $sUserId,$TANGGAL_AKSES; 
			$wh="";
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh.=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";

			$fField2=trim($fField2);$fValue2=trim($fValue2);
			$wh.=!empty($fField2)?"and a.".trim($fField2)." ='".$fValue2."'":"";
	
			$fField3=trim($fField3);$fValue3=trim($fValue3);
			$wh.=!empty($fField3)?"and a.".trim($fField3)." ='".$fValue3."'":"";

			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			
			$nosbb=$Isi['nosbb'];

			

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValueF2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			$fValue2F2=!empty($fValue2)?$fValue2:"";
			$fValue2=!empty($fValue2)?"-".$fValue2:"";

			$fValue3F2=!empty($fValue3)?$fValue3:"";
			$fValue3=!empty($fValue3)?"-".$fValue3:"";
			
			if(!empty($fno_transaksi)&&!empty($nosbb)){

			$Qry=_mysql_query("select * from `keu_bukukas` where `no_transaksi`='{$fno_transaksi}'");			
				if(_mysql_num_rows($Qry)>0){						
					_mysql_query("UPDATE `keu_bukukas` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `no_transaksi`='{$fno_transaksi}';");
					_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue2F2}{$fValue3F2}');");	
				}else{

					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fno_transaksi}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_bukukas` (`no_transaksi`, `tgl_transaksi`, `inpuser`, `inptgl`,`nosbb_k`) VALUES ('{$fno_transaksi}', '{$tgl_transaksi}', '{$sUserId}', '{$TANGGAL_AKSES}', '$mSbb');");	
						_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue3F2}{$fValue3F2}');");

					}
				}
			}
		}
		
		function BukuKas3whPersen($mSbb="",$kd="", $fSbb="",$fno_transaksi="",$tgl_transaksi="",$fNominal="",$fKet="",$fField="",$fValue="",$fField2="",$fValue2="",$fField3="",$fValue3=""){
			global $sUserId,$TANGGAL_AKSES; 
			$wh="";
			// ambil SBB
			$fField=trim($fField);$fValue=trim($fValue);
			$wh.=!empty($fField)?"and a.".trim($fField)." ='".$fValue."'":"";

			$fField2=trim($fField2);$fValue2=trim($fValue2);
			$wh.=!empty($fField2)?"and a.".trim($fField2)." ='".$fValue2."'":"";
	
			$fField3=trim($fField3);$fValue3=trim($fValue3);
			$wh.=!empty($fField3)?"and a.".trim($fField3)." ='".$fValue3."'":"";

			$Isi=_mysql_fetch_array(_mysql_query("select a.nosbb, a.persen from keu_tblgl as a where left(a.nosbb,".strlen(trim($fSbb)).") ='".trim($fSbb)."' $wh"));			
			$nosbb=$Isi['nosbb'];
			$persen=$Isi['persen'];
			
			$fNominal=round(($fNominal*$persen)/100,2);

			$fKet=!empty($fKet)?"-".$fKet:"";
			$fValueF2=!empty($fValue)?$fValue:"";
			$fValue=!empty($fValue)?"-".$fValue:"";

			$fValue2F2=!empty($fValue2)?$fValue2:"";
			$fValue2=!empty($fValue2)?"-".$fValue2:"";

			$fValue3F2=!empty($fValue3)?$fValue3:"";
			$fValue3=!empty($fValue3)?"-".$fValue3:"";
			
			if(!empty($fno_transaksi)&&!empty($nosbb)){
			$Qry=_mysql_query("select * from `keu_bukukas` where `no_transaksi`='{$fno_transaksi}'");			
				if(_mysql_num_rows($Qry)>0){						
					_mysql_query("UPDATE `keu_bukukas` SET `chguser`='$sUserId', `chgtgl`='$TANGGAL_AKSES' WHERE  `no_transaksi`='{$fno_transaksi}';");
					_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
					_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue2F2}{$fValue3F2}');");
				}else{
					$Qry2=_mysql_query("select * from `keu_toftrnh` where `nobukti`='{$fno_transaksi}'");
					if(!_mysql_num_rows($Qry2)){
						_mysql_query("INSERT INTO `keu_bukukas` (`no_transaksi`, `tgl_transaksi`, `inpuser`, `inptgl`, `nosbb_k`) VALUES ('{$fno_transaksi}', '{$tgl_transaksi}', '{$sUserId}', '{$TANGGAL_AKSES}','$mSbb');");	
						_mysql_query("DELETE FROM `keu_bukukas_detail` WHERE  `no_transaksi`='{$fno_transaksi}' AND `nosbb`='{$nosbb}';");
						_mysql_query("INSERT INTO `keu_bukukas_detail` (`no_transaksi`, `nosbb`, `".$kd."`, `keterangan`, `nama`) VALUES ('{$fno_transaksi}', '{$nosbb}', '{$fNominal}', '{$fno_transaksi}{$fValue}{$fValue2}{$fValue3}{$fKet}', '{$fValueF2}{$fValue3F2}{$fValue3F2}');");

					}
				}
			}
		}
#c###########################################################################################################################################
		function ambildigit($nol="",$digit="")
		{
			$number=substr($nol,0,"-".strlen(trim($digit))).$digit;
			return $number;
		}
		function TglBlnthn($tgl = "")
		{
			global $Ref;
			if(!empty($tgl) and substr($tgl,0,4)!="0000")
			{
				$cHr = $Ref->NamaHari[date("w",mktime(0,0,0,substr($tgl,5,2),substr($tgl,8,2),substr($tgl,0,4)))];
				if($cHr == "Minggu"){$cHr = "<font color=red>$cHr</font>, ";}
				elseif($cHr == "Jum'at"){$cHr = "<font color=green>$cHr</font>, ";}
				else{$cHr = "$cHr, ";}
				return substr($tgl,8,2)." ".$Ref->NamaBulan[(substr($tgl,5,2)*1)-1]." ".substr($tgl,0,4);
			}
			else
			{	return " ";}
		}
		function addtext($text="",$add="")
		{
			$x=1;$rtext="";
//			strlen($text)
			while(7>=$x)
			{
				$rtext.=@$text[$x-1].$add;               
				$x++;
			}
			return $rtext;
		}
		function cetakuang($n) {
		return @number_format($n,0,',','.');}
		
		function cetakDesimal($n) {
		return @number_format($n,1,',','.');}


		function Import($JKolom="",$SKolom="",$SQry="",$NMTable="",$QInsert="",$FInsert="",$QUpdate="")
		{
			global $lap;
			$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
			$baris = $data->rowcount($sheet_index=0);
			$sukses = 0;
			$gagal = 0;
			$B=1;
			for ($i=2; $i<=$baris; $i++)
			{
				/////////// Membuat  Qry Insert 
				$Kolom=1;
				$VALUES="";
				$TD="";
				while($JKolom>=$Kolom)
				{
					if($SKolom[$Kolom-1]==$Kolom)
					{	
						$VALUES.="'".trim($data->val($i, $Kolom))."', ";
						$TD.="<TD class=csgrid align=center>".$data->val($i, $Kolom)."</TD>";
					}
					$Kolom++;
				}	

				$FIndex=1;
				if($FInsert!="")
				{
					while(count($FInsert)>=$FIndex)
					{
						$VALUES.="'".$FInsert[$FIndex-1]."', ";
						$TD.="<TD class=csgrid align=center>".$FInsert[$FIndex-1]."</TD>";
						$FIndex++;
					}
				}
				/////////// Membuat Qry Update
				$QIndex=1;
				$Set="";
				while(count($QUpdate)>=$QIndex)
				{
					if(substr($QUpdate[$QIndex-1][1],0,3)=="xxx")
					{
						
						$KRTR=SUBSTR($QUpdate[$QIndex-1][1],-2,2);				
						IF(SUBSTR($KRTR,-2,1)=="x")
						{$Set.=$QUpdate[$QIndex-1][0]."='".trim($data->val($i, SUBSTR($QUpdate[$QIndex-1][1],-1,1)))."', ";}
						else
						{$Set.=$QUpdate[$QIndex-1][0]."='".$data->val($i, SUBSTR($QUpdate[$QIndex-1][1],-2,2))."', ";}
					}
					else
					{$Set.=$QUpdate[$QIndex-1][0]."='".$QUpdate[$QIndex-1][1]."', ";}
					$QIndex++;
				}
				$Set=SUBSTR($Set,0,-2);

				/////////// Membuat seleksi Qry Seleksi
				$index=1;
				$Wh="";
				while(count($SQry)>=$index)
				{	
					if(substr($SQry[$index-1][1],0,3)=="xxx")
					{$Wh.=$SQry[$index-1][0]."='".$data->val($i, SUBSTR($SQry[$index-1][1],-1,1))."' and ";}
					else
					{$Wh.=$SQry[$index-1][0]."='".$SQry[$index-1][1]."' and ";}
					$index++;
				}
				$Wh=SUBSTR($Wh,0,-4);
			
				$Qry="select * from	$NMTable where $Wh limit 1;";
				
				
				if(_mysql_num_rows(_mysql_query($Qry))>0)
				{			
					$UPDATE="UPDATE $NMTable SET $Set WHERE $Wh LIMIT 1;";
					$Hsl1=_mysql_query($UPDATE);
					if($Hsl1)
					{$sukses1++;$Warna="#CCFFFF";}				
					else
					{$gagal++;$Warna="#FFCC00";}
					$TR.="<TR BGCOLOR='$Warna'>$TD</TR>";
					$Warna="";
				}
				else
				{			
					$INSERT="INSERT INTO $NMTable $QInsert (".SUBSTR($VALUES,0,-2).");";		
					$Hsl2=_mysql_query($INSERT);
					if($Hsl2)
					{$sukses2++;$Warna="#66FF33";}
					else 
					{$gagal++;$Warna="#FFCC00";}
					$TR.="<TR BGCOLOR='$Warna'>$TD</TR>";
					$Warna="";
				}

			}
			//echo $UPDATE."<br>"; 
			//echo $INSERT."<br>"; 
			//echo $Qry."<br>"; 
				
			$sukses1=!empty($sukses1)?$sukses1:0;
			$sukses2=!empty($sukses2)?$sukses2:0;
			$gagal=!empty($gagal)?$gagal:0;
			$lap="<h3>Proses import data selesai.</h3>";
			$lap.="<p>Jumlah data yang sukses diimport : ".$sukses2."<br>";
			$lap.="<p>Jumlah data yang sukses diupdate : ".$sukses1."<br>";
			$lap.="Jumlah data yang gagal diimport : ".$gagal."</p>";
			$lap.="<TABLE WIDTH='98%' HEIGHT='*' CELLSPACING=0 CELLPADDING=3 style='border-collapse:collapse'>$TR</TABLE>";
			return ($lap);
		}

		function antiinjection($data){
			// Jika $data null atau tidak ada, gunakan string kosong ('') sebagai gantinya.
			$data = $data ?? ''; 
			$filter_sql = _mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars(trim($data),ENT_QUOTES))));
			return $filter_sql;
		}
		
		function autolink ($str){
		  $str = str_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http
		  $str = str_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www.
		  $str = str_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a href=\"mailto:\\2\">\\2</a>", $str); // mail
		  $str = str_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http
		  $str = str_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www.
		  $str = str_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a href=\"mailto:\\1\">\\1</a>", $str); // mail
		  return $str;
		}

		function sensor($teks){
			$w = _mysql_query("SELECT * FROM t_katajelek");
			while ($r = _mysql_fetch_array($w)){
				$teks = str_replace($r['kata'], $r['ganti'], $teks);       
			}
			return $teks;
		}  

		function splittext($isi_komentar="")
		{
			$v_text="";
			$split_text = explode(" ",$isi_komentar);
			$split_count = count($split_text);
			$max = 57;

			for($i = 0; $i <= $split_count; $i++){
			if(@strlen($split_text[$i]) >= $max){
			for($j = 0; $j <= strlen($split_text[$i]); $j++){
			$char[$j] = substr($split_text[$i],$j,1);
			if(($j % $max == 0) && ($j != 0)){
			  $v_text .= $char[$j] . ' ';
			}else{
			  $v_text .= $char[$j];
			}
			}
			}else{
			  $v_text .= " " . @$split_text[$i] . " ";
			}
			}
			return $v_text;
		}
		function validasi($str, $tipe){
			switch($tipe){
				default:
				case'sql':
					$str = stripcslashes($str);	
					$str = htmlspecialchars($str);				
					$str = preg_replace('/[^A-Za-z0-9]/','',$str);				
					return intval($str);
				break;
				case'xss':
					$str = stripcslashes($str);	
					$str = htmlspecialchars($str);
					$str = preg_replace('/[\W]/','', $str);
					return $str;
				break;
			}
		}
		
		function extension($path) {
			$file = pathinfo($path);
			if(file_exists($file['dirname'].'/'.$file['basename'])){
				return $file['basename'];
			}
		}
		
		function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;}

		function uploadfile_all($FILE_NM="",$FILE_TMP="",$DIREKTORI="",$NMFILE="")
		{
			global $Ket,$NFILE;
			define ("MAX_SIZE","100"); 
			
			$errors=0;	
			if ($FILE_NM) 
			{
				$filename = stripslashes($FILE_NM);
				$extension = $this->getExtension($filename);
				$extension = strtolower($extension);			
					$size=filesize($FILE_TMP);
					//if ($size > MAX_SIZE*2024){$Ket='Maaf, Anda telah melebihi batas ukuran 2 Mb';$errors=1;}
					$image_name=$NMFILE.'.'.$extension;
					$newname=$DIREKTORI.$image_name;
					$copied = @copy($FILE_TMP, $newname);
					if (!$copied) 
					{$Ket='Data gagal di salin!';$errors=1;}				
			}	
			if(!$errors){$Ket="File berhasil di unggah!";$NFILE=$image_name;}
			return $Ket;
			return $NFILE;
		}
		function setSession($name="", $value=""){
			global $_SESSION, $HTTP_SESSION_VARS;
			$_SESSION['sUserId']=$UserID;
		}
		
		function kosongkanData($tabel)
		{
			$Query = _mysql_query("desc $tabel");
			while ($Hasil=_mysql_fetch_row($Query))
			{
				$Field = $Hasil[0];
				global $$Field;
				$$Field = "";
			}
		}

		function ambilData($query)
		{
			$Query = _mysql_query($query);
			$Hasil=_mysql_fetch_array($Query);
			$Query1 = _mysql_query($query);
			while ($Field=_mysql_fetch_field($Query1))
			{
				$NmField = $Field->name;
				global $$NmField;
				$$NmField = $Hasil[$NmField]!='0'?$Hasil[$NmField]:"";
			}
		}

		function timer(){
			$time=1000;
			@session_start();
			$_SESSION['timeout']=time()+$time;
		}
		function hex($str='',$code='') {
		$t=!empty($t)?$t:"";
		  if(($code>=0)and($code<100)) {
			$t .=dechex(strlen($str)+$code)."g";
			$str=strrev($str);
			for($i=0;$i<=strlen($str)-1;$i++) {
			  $t .=dechex(ord(substr($str,$i,1))+$code);
			}
		  }
		  return $t;
		}
		function Login()
		{
			global $Pg,$uLogin,$pLogin,$UserHak,$sUserID,$sUserNm,$sUserHak;
			$xuLogin= trim($this->antiinjection(@$_POST['uLogin']));
			$xpLogin= trim($this->antiinjection(@$_POST['pLogin']));
			
			$scrt="*&^~53r37";
			$uLogin= $this->antiinjection(@$_POST['uLogin']);
			$pLogin= $this->antiinjection(sha1($scrt.@$_POST['pLogin'].$scrt));
			$pLogin=substr($this->hex(addslashes($pLogin),82), 0, 31);			
			//echo $pLogin;
			//$Pg=$this->antiinjection(@$_POST['Pg']);
			if (!empty($uLogin)&&!empty($pLogin))
			{				
				$Qry = _mysql_query("SELECT * FROM __t_users WHERE username='$uLogin' AND `password`='$pLogin' AND blokir='N'");
				if(!_mysql_num_rows($Qry))
				{
					$UserID="";$UserNm="";
				}
				else
				{						
					$r=_mysql_fetch_array($Qry);$UserID=$r['username'];
					$UserNm=$r['nama_lengkap'];$UserHak =$r['level'];							
				}			
				
				if (!empty($UserID) && !empty($UserNm))
				{	
					
					$_SESSION['KCFINDER']=array();
					$_SESSION['KCFINDER']['disabled'] = false;
					$_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";
					$_SESSION['KCFINDER']['uploadDir'] = "";
					
					$this->timer();
					// session timeout
					$_SESSION['login']=1;
					$sid_lama = session_id();
					$sid_baru = session_id();

					_mysql_query("UPDATE __t_users SET id_session='$sid_baru' WHERE username='$UserID'");			

					$_SESSION['sUserId']=$UserID;
					$_SESSION['sUserNm']=$UserNm;
					$_SESSION['sUserHak']=$UserHak;					
				//	if (empty($_SESSION['sUserId'])){header("Location:index.php");}
				}
				else{

					echo "<script>alert('Maaf, UserID atau Password Masih Salah, Silakan Ulangi Lagi !');parent.location='index.php';</script>";
				}
			}
		}

		function CekLogin()
		{
			global $sUserId,$sUserNm;
			if (isset($sUserId) && isset($sUserNm))
			{
				
				if (!empty($sUserId) && !empty($sUserNm))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		function gFile($file)
		{	
			$fd = fopen ($file, "r");
			$cIsi = fread ($fd, filesize ($file));
			fclose ($fd);
			return $cIsi;
		}
		function TahunAjaran()
		{	$i=1;
			$DBulan=date("m");
			$DTahun=date("Y");	
			$ABlnRange=array("07","08","09","10","11","12","01","02","03","04","05","06");
			$i=1;
			while(count($ABlnRange)>=$i)
			{
				IF(($ABlnRange[0]<=$DBulan)&&($ABlnRange[5]>=$DBulan)){$TahunAjaran=$DTahun;}ELSE{$TahunAjaran=$DTahun-1;}
				$i++;
			}
			return $TahunAjaran;
		}

		function TglAll($tgl = "")
		{
			global $Ref;
			if(!empty($tgl) and substr($tgl,0,4)!="0000")
			{
				$cHr = $Ref->NamaHari[date("w",mktime(0,0,0,substr($tgl,5,2),substr($tgl,8,2),substr($tgl,0,4)))];
				if($cHr == "Minggu"){$cHr = "<font color=red>$cHr</font>, ";}
				elseif($cHr == "Jum'at"){$cHr = "<font color=green>$cHr</font>, ";}
				else{$cHr = "$cHr, ";}
				return $cHr.substr($tgl,8,2)." ".$Ref->NamaBulan[(substr($tgl,5,2)*1)-1]." ".substr($tgl,0,4);
			}
			else
			{	return " ";}
		}

		function Tgl($tgl="")
		{
			global $Ref;
			if(!empty($tgl) and substr($tgl,0,4)!="0000")
			{
				return substr($tgl,8,2)." ".$Ref->NamaBulan[(substr($tgl,5,2)*1)-1]." ".substr($tgl,0,4);
			}
			else
			{return " ";}
		}

		function TglInd($Tgl="")
		{
			$Tanggal = !empty($Tgl)?substr($Tgl,8,2)."-".substr($Tgl,5,2)."-".substr($Tgl,0,4):"";
			return $Tanggal;
		}

		function TglSQL($Tgl="")
		{
			$Tanggal = !empty($Tgl)?substr($Tgl,6,4)."-".substr($Tgl,3,2)."-".substr($Tgl,0,2):"";
			return $Tanggal;
		}

		function JConn()
		{	global $SQL;
			$SQL->Konek = @mysql_connect($SQL->Host,$SQL->User,$SQL->Pwd) or $this->GoError(MySql_Error());
			if ($SQL->Konek)
			{	$SelectDB = @mysql_select_db($SQL->Dbs) or GoError(MySql_Error());
				return true;
			}
			else
			{return false;}
		}

		function GoError($Test)
		{
			global $Error;
			$Text = $Test;
			$Test = true;
			echo "<center>$Test";
			exit;
			return true;
		}

		function FError($Test,$href='javascript:history.back(-1)')
		{
			if (!empty($href))
			{$MyHref="Klik <a href=\"$href\">Back</a> untuk kembali.......";}
			else
			{$MyHref="";}

			$Has = "
				<br><br><br>
				<table border=1 bgcolor=ffaaaa cellpadding=4 cellspacing=0 width=90% align=center>
				<tr>
				<td style='color:ffffff' align=center>
				<b>$Test<br>
				$MyHref
				</td>
				</tr>
				</table>
			";
			return $Has;
		}

		function Grafik($isi=array(),$leg=array(),$wr="")
		{   global $Dir;
			$z=0;
			$max=0;
				foreach($isi as $v)
					{	
						if($v > $z){$max = $v;}
						$z = $max;
					}
					if($max < 80){$tg = 2;}
					if($max < 70){$tg = 3;}
					if($max < 60){$tg = 3;}
					if($max < 50){$tg = 5;}
					if($max < 40){$tg = 5;}
					if($max < 30){$tg = 5;}
					if($max < 20){$tg = 10;}
					if($max < 10){$tg = 20;}
					if($max < 5){$tg = 30;}
					if($max > 79){$tg = 1;}
					if($max > 200){$tg = 1;}
					if($max > 300){$tg = 0.5;}
					if($max > 500){$tg = 0.2;}
					if($max > 1000){$tg = 0.18;}
					if($max > 2000){$tg = 0.17;}

					if(count($isi) < 10){$wd = 30;}else{$wd=10;}

					$Hasil = "<table cellpadding=4 cellspacing=2 bgcolor=aaaaaa align=center><tr><td rowspan=2 bgcolor=000000 >&nbsp</td></tr><tr valign=bottom align=center>";
					$y = 0;
					for($x=0;$x<count($isi);$x++)
						{	$y++;
							if($isi[$x] > 0)
								{$tinggi = $isi[$x]*$tg;}
							else
								{$tinggi=1;}
							$Hasil .= "<td>&nbsp$isi[$x]<br>&nbsp
					<img src='$Dir->Images/graph/$y.jpg' width=$wd height=$tinggi noborder>&nbsp</td>";
						}
					$Hasil .= "<td>&nbsp</td><td align=left>";
					$y=0;
					for($x=0;$x<count($isi);$x++)
						{	$y++;
							if($isi[$x] > 0)
								{$tinggi = $isi[$x]*$tg;}
							else
								{$tinggi=1;}
							$Hasil .= "
					<img src='images/graph/$y.jpg' width=15 height=8 noborder>
					 $leg[$x]<br>";
						}
					$Kol = count($isi)+3;
					$Hasil .=  "</td></tr><tr><td style='height:4' bgcolor=000000 colspan=$Kol></td></tr></table>";
					return $Hasil;
		}

		function txtField($name='txtField',$value='',$maxlength='',$size='20',$type='text',$param='')
		{
			$class="";
			if ($type=="text" || $type=="password" || $type=="file"){$class="class='txt'";}elseif($type=="button" || $type=="submit"){$class="class='btn'";}
			@$Input = "<input $class type=\"$type\" name=\"$name\" id=\"@$name\" value=\"$value\" size=\"$size\" maxlength=\"$maxlength\" $param>";
			return $Input;
		}
		function txtArea($name='txtField',$value='',$cols='50',$rows='3',$param='')
		{
			$Input = "<textarea class='txtarea' rows=\"$rows\" cols=\"$cols\" name=\"$name\" id=\"$name\" $param>$value</textarea>";
			return $Input;
		}
		
		function rdJenKel($name='txtField',$value='',$param='')
		{
			$JK = strtoupper($value);
			$SelP = $JK=='P'?" checked ":"";
			$SelL = $JK=='L'?" checked ":"";
			$Input  = "<input type=\"radio\" name=\"$name\" value=\"L\" $SelL $param>Laki-Laki";
			$Input .= "<input type=\"radio\" name=\"$name\" value=\"P\" $SelP $param>Perempuan";
			return $Input;
		}

		function rdAktif($name='txtField',$value='',$param='')
		{
			$AK = strtoupper($value);
			$SelY = $AK=='Y'?" checked ":"";
			$SelN = $AK=='N'?" checked ":"";

			$Input  = "
			<table>
			<tr>
				<td style='border:0px;'><input type=\"radio\" name=\"$name\" value='Y' $SelY $param></td>
				<td style='border:0px;'>Y</td>
				<td style='border:0px;'><input type=\"radio\" name=\"$name\" value='N' $SelN $param></td>
				<td style='border:0px;'>N</td>
			</tr>
			</table>";
			return $Input;
		}

		function radioArray($name='txtField',$value='',$arrList = '',$param='')
		{
			$i=1;$Input="";
			while($i<=count($arrList))
			{	
				$Sel="";
				$check = strtoupper($value);				
				$Sel = $arrList[$i-1][0]==$check?" checked ":"";
				$Input.= "<input type=\"radio\" name=\"$name\" value=\"{$arrList[$i-1][0]}\" $Sel $param> {$arrList[$i-1][1]}&nbsp;";
				$i++;
			}
			return $Input;
		}

		function radioQuery($name='txtField',$value='',$query='',$param='')
		{
			global $Ref;
			$Input = "";
			$Query = _mysql_query($query);
			while ($Hasil=_mysql_fetch_row($Query))
			{
				$Sel="";
				$Sel = $Hasil[0]==$value?" checked ":"";
				$Input.= "<input type=\"radio\" name=\"$name\" value=\"{$Hasil[0]}\" $Sel $param> {$Hasil[1]}&nbsp;";
			}
			return $Input;
		}

		function cmbUmum($name='txtField',$value='',$arrList = '',$param='')
		{
			global $Ref;
			$isi = $value;
			$Input = "<option value=\"\">Pilih</option>";
			for($i=0;$i<count($arrList);$i++)
			{
				$Sel = $isi==$arrList[$i]?" selected ":"no";
				$Input .= "<option $Sel value=\"{$arrList[$i]}\">{$arrList[$i]}</option>";
			}
			$Input  = "<select $param name=\"$name\"  id=\"$name\">$Input</select>";
			return $Input;
		}

		function cmbIndex($name='txtField',$value='',$arrList = '',$param='')
		{
			global $Ref;
			$isi = $value;
			$Input = "<option value=\"\">Pilih</option>";
			for($i=1;$i<=count($arrList);$i++)
			{
				$Sel = $isi==$i?" selected ":"no";
				$Input .= "<option $Sel value=\"$i\">{$arrList[$i-1]}</option>";
			}
			$Input  = "<select $param name=\"$name\"  id=\"$name\">$Input</select>";
			return $Input;
		}

		function cmbIndexKode12($name='txtField',$value='',$arrList = '',$param='')
		{
			global $Ref;
			$isi = $value;
			$Input = "<option value=\"\">Pilih</option>";
			for($i=1;$i<=count($arrList);$i++)
			{
				$Sel = $isi==$i?" selected ":"no";
				$Input .= "<option $Sel value=\"$i\">{$arrList[$i-1]}</option>";
			}
			$Input  = "<select $param name=\"$name\"  id=\"$name\">$Input</select>";
			return $Input;
		}

		function cmbQuery($name='txtField',$value='',$query='',$param='',$Atas='Pilih',$vAtas='')
		{
			global $Ref;
			$Input = "<option value='$vAtas'>$Atas</option>";
			$Query = _mysql_query($query);
			while ($Hasil=_mysql_fetch_row($Query))
			{
				$Sel = $Hasil[0]==trim($value)?"selected":"";
				$Input .= "<option $Sel value=\"{$Hasil[0]}\">{$Hasil[1]}";
			}
			$Input  = "<select $param name=\"$name\" id=\"$name\">$Input</select>";
			return $Input;
		}

		function cmb2D($name='txtField',$value='',$arrList = '',$param='')
		{
			global $Ref;
			$isi = $value;
			$Input = "<option value=\"\">Pilih</option>";
			for($i=0;$i<count($arrList);$i++)
			{
				$Sel = $isi==$arrList[$i][0]?" selected ":"";
				$Input .= "<option $Sel value=\"{$arrList[$i][0]}\">{$arrList[$i][1]}</option>\n";
			}
			$Input  = "<select $param name=\"$name\"  id=\"$name\">$Input</select>";
			return $Input;
		}

		function cmb2DNew($name='txtField',$value='',$arrList = '',$param='')
		{
			global $Ref;
			$isi = $value;
			$Input = "<option value=\"\">Pilih</option>";
			for($i=0;$i<count($arrList);$i++)
			{
				$Sel = $isi==$arrList[$i][0]?" selected ":"";
				$Input .= "<option $Sel value=\"{$arrList[$i][0]}\">{$arrList[$i][1]}</option>\n";
			}
			$Input  = "<select $param name=\"$name\">$Input</select>";
			return $Input;
		}

		function txtGrid($name='txtField',$value='',$maxlength='',$size='20',$id='txtField',$no='',$param='')
		{
			$nmid=$id.$no;			
			$awal=$no-1;
			$akhir=$no+1;
			$Input = "<input type=\"text\" name=\"$name\" id=\"$nmid\" value=\"$value\" size=\"$size\" maxlength=\"$maxlength\" $param class='tGrid' onkeydown=\"javascript:KeyFocus(event,'$id{$awal}','$id{$akhir}')\" onkeyup=\"if(!isNaN(this.value)){ return true; } else{ alert('Maaf, Kolom Harus Diisi Dengan Angka....!'); if(parseFloat(this.value)>0){this.value=parseFloat(this.value);}else{this.value='';}}\">";
			return $Input;

		}
		function tabOff($Teks,$Link)
		{
			global $Dir, $Main;
			$Tab = "
				<TABLE cellpadding=0 border=0 cellspacing=0 width='100%'>
				<TR onclick=\"$Link\" style='cursor:hand'>
					<TD><IMG SRC='{$Dir->Images}/tabs/tabsekoff1.gif'></TD>
					<TD align=center width='99%' background='{$Dir->Images}/tabs/tabsekoff2.gif'>$Teks</TD>
					<TD><IMG SRC='{$Dir->Images}/tabs/tabsekoff3.gif'></TD>
				</TR>
				</TABLE>
			";
			return $Tab;
		}
		function tabOn($Link)
		{
			global $Dir, $Main;
			$Tab = "
				<TABLE cellpadding=0 border=0 cellspacing=0 width='100%'>
				<TR>
					<TD><IMG SRC='{$Dir->Images}/tabs/tabsekon1.gif'></TD>
					<TD align=center width='99%' background='{$Dir->Images}/tabs/tabsekon2.gif'>$Link</TD>
					<TD><IMG SRC='{$Dir->Images}/tabs/tabsekon3.gif'></TD>
				</TR>
				</TABLE>
			";
			return $Tab;
		}

		function tabSplit($text){
			$Tab="
				<hr>	
				<TABLE cellpadding='0' cellspacing='0'  width='100%'>
				<TR>
					<TD>".$this->tabOn("<b>".strtoupper($text)."</b>")."</TD>			
				</TR>
				</TABLE>
				<P>
			";
			return $Tab;
		}
		function txtCalendar2($name='txtField',$tname="",$value='',$format='dd/mm/yyyy', $param='')
		{
			global $Dir;
			$txt = "
				<script>$(function() { $('#$name').datepick(); });</script>
				<TABLE cellpadding='0' cellspacing='0'>
				<TR>
					<TD style='border:0px;padding:0px;'>
						<input type=\"text\" name=\"$tname\" id=\"$name\" value=\"$value\" size='11' class='txt' style='width:80;border:0px;background:white;text-align:center'> 
					</TD>
					<TD style='border:0px;padding:0px;' width='10'>
						<a href=\"#\" onclick=\"$('#$name').datepick('show');\" title=\"Show popup calendar\"><img src=\"{$Dir->Images}/calendar.gif\" border=\"0\" align='left'></a> $param
					</TD>
				</TR>
				</TABLE>
			";
			return $txt;
		}
		function txtCalendar($name='txtField',$value='',$format='dd/mm/yyyy', $param='')
		{
			global $Dir;
			$txt = "
				<script>$(function() { $('#$name').datepick(); });</script>
				<TABLE cellpadding='0' cellspacing='0'>
				<TR>
					<TD>
						<input type=\"text\" name=\"$name\" id=\"$name\" value=\"$value\" size='11' class='txt'> 
					</TD>
					<TD>
						<a href=\"#\" onclick=\"$('#$name').datepick('show');\" title=\"Show popup calendar\"><img src=\"{$Dir->Images}/calendar.gif\" border=\"0\" align='left'></a> $param
					</TD>
				</TR>
				</TABLE>
			";
			return $txt;
		}
		function txtUpload($name = "", $Folder = "./files"){
			global $Dir;
			$txtUpload = "
				<script type='text/javascript'>
				$(function() { 
					$('#uploadify').uploadify({
						'uploader'       : '{$Dir->Js}/jquery/upload/uploadify.swf',
						'script'         : '{$Dir->Js}/jquery/upload/uploadify.php',
						'cancelImg'      : '{$Dir->Js}/jquery/upload/cancel.png',
						'folder'         : '{$Folder}',
						'queueID'        : 'fileQueue',
						'auto'           : false,
						'multi'          : true
					});
				});
				</script>
				<div id='fileQueue'></div>
				<input type='file' name='$name' id='uploadify' />
			";

			return $txtUpload;
		}

		function txtTanggal($name='txtField',$value='', $param='')
		{
			$nTgl = substr($value,8,2);
			$nBln = substr($value,5,2);
			$nThn = substr($value,0,4);
			$txtField = "
				".txtField('tgl$name',$nTgl,'2','2','text')." -
				".txtField('bln$name',$nBln,'2','2','text')." -
				".txtField('thn$name',$nThn,'4','4','text')." Format : DD-MM-YYYY
			";

			return $txtField;
		}
		function txtTanggalSQL($name="txtField")
		{
			$tgl = "tgl$name";
			$bln = "tgl$name";
			$thn = "tgl$name";
			global $$tgl, $$bln, $$thn;
			echo $$tgl;
			$tgl = $$tgl;
			$bln = $$bln;
			$thn = $$thn;

			return $thn."-".$bln."-".$tgl;
		}

		function txtTanggalInd($name="txtField")
		{
			$tgl = "tgl$name";
			$bln = "tgl$name";
			$thn = "tgl$name";
			global $$tgl, $$bln, $$thn;
			$tgl = $$tgl;
			$bln = $$bln;
			$thn = $$thn;
			return $tgl."-".$bln."-".$thn;
		}

		function ViewPesan($Pesan = "", $Benar = 1)
		{
			
			if ($Benar == 1)
			{
				$Pesan = $Pesan;
			}
			else
			{
				$Pesan = "<span style='color:red'>$Pesan</span>";
			}
			$Pesan = "<script>$('#messagebox').html(\"$Pesan\");showKonfirmasi();</script>";
			//echo "<script>alert('Maaf, form yang bertanda merah harus di isi lengkap...!!!')</script>";
			return $Pesan;
		}
		function Alert($pesan=""){
			echo "<script>alert('$pesan');</script>";
		}
		function mytrim($text="", $trim=" "){
			$awal = substr($text,0,1);
			$akhir = substr($text,strlen($text)-1,strlen($text));
			if ($awal=="�"){
				$text = substr($text, 1, strlen($text));
			}
			if ($akhir=="�"){
				$text = substr($text, 0, strlen($text)-1);
			}
			return trim($text);
		}

		function IsiSingkat($isi="", $Panjang = 500){
			$isisingkat = "";
			$isi1 = substr($isi,0,$Panjang);
			$isi2 = explode(" ", substr($isi,$Panjang,100));
			$isi = $isi1.$isi2[0]."...";
			$isisingkat = $isi;
			return $isisingkat;	
		}

		function SortHeader($text = ""){
			return "<A HREF='#' onclick=\"SortTabel('#tablesorter')\"><B>$text</B></A>";
		}
		function BelumAdaData($IsiKet="")
		{
			global $Dir;
			return "
				<TABLE cellpadding='0' cellspacing='0' width='100%' align='center'>
				<TR>
					<TD width='15'><img src='{$Dir->Images}/info/info21.gif'></TD>
					<TD style='color:#16418A' background='{$Dir->Images}/info/info22.gif'>
					<CENTER>
						<TABLE>
						<TR>
							<TD><img src='{$Dir->Images}/info/icon_info.gif'></TD>
							<TD><B>&nbsp;&nbsp;$IsiKet</B></TD>
						</TR>
						</TABLE>
					</CENTER>
					</TD>
					<TD width='15'><img src='{$Dir->Images}/info/info23.gif'></TD>
				</TR>
				</TABLE>";
		}

		function getSatuData($Qry = "")
		{
			$Qry = _mysql_query($Qry);
			$data = _mysql_fetch_array($Qry);
			return $data[0];
		}

		function buatPieChart($arData = array(), $arKet = array(), $Judul = "", $Width = 420, $Height = 250, $MapID = 0)
		{
			global $Dir;
			include("{$Dir->Common}/pchart/pChart/pData.class");
			include("{$Dir->Common}/pchart/pChart/pChart.class");

			$DataSet = new pData;
			$DataSet->AddPoint($arData,"Serie1");
			$DataSet->AddPoint($arKet,"Serie2");
			$DataSet->AddAllSeries();
			$DataSet->SetAbsciseLabelSerie("Serie2");

			// Initialise the graph
			$wFR = $Width - 5;
			$hFR = $Height - 5;
			$wRR = $Width - 2;
			$hRR = $Height - 2;
			$wChart = floor((30/100) * $Width);
			$xPos = ($wChart * 2) - 20;
			$yPos = 130;
			$Test = new pChart($Width,$Height);
			$Test->setImageMap(TRUE,$MapID);
			//$Test->drawFilledRoundedRectangle(5,5,$wFR,$hFR,5,240,240,240);
			$Test->drawRoundedRectangle(0,0,$wRR,$hRR,5,50,50,50);
			//$Test->createColorGradientPalette(195,204,56,223,110,41,5);

			// Draw the pie chart
			$Test->setFontProperties("{$Dir->Common}/pchart/Fonts/tahoma.ttf",8);
			$Test->AntialiasQuality = 0;
			$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),$xPos,$yPos,$wChart,PIE_PERCENTAGE_LABEL,FALSE,50,20,5);
			$Test->drawPieLegend(10,30,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);	

			// Write the title
			$Test->setFontProperties("{$Dir->Common}/pchart/Fonts/MankSans.ttf",10);
			$Test->drawTitle(10,20,$Judul,0,0,0);
			return $Test->Stroke();
		}
		function buatLineChart($arData = array(), $arKet = array(), $Judul = "", $Width = 420, $Height = 250, $MapID = 0)
		{
			global $Dir;
			$DataSet = new pData;
			for ($i = 0;$i < sizeof($arData);$i++)
			{
				$Ke = $i + 1;
				$DataSet->AddPoint($arData[$i],"Serie$Ke");
				$DataSet->SetSerieName($arKet[$i],"Serie$Ke");
			}
			$DataSet->AddAllSeries();
			$Width = 550;
			$Height = 200;
			$wGA = $Width - 20;
			$hGA = $Height - 30;
			$Test = new pChart($Width,$Height);
			$Test->setImageMap(TRUE,$MapID);
			$Test->setFontProperties("{$Dir->Common}/pchart/Fonts/tahoma.ttf",10);
			$Test->setGraphArea(30,10,$wGA,$hGA);
			$Test->drawGraphArea(252,252,252,TRUE);
			$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
			$Test->drawGrid(4,TRUE,230,230,230,70);

			// Draw the line graph
			$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
			$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);


			// Write the title
			//$Test->setFontProperties("{$Dir->Common}/pchart/Fonts/tahoma.ttf",8);
			//$Test->drawLegend(45,35,$DataSet->GetDataDescription(),255,255,255);
			//$Test->setFontProperties("{$Dir->Common}/pchart/Fonts/tahoma.ttf",10);
			//$Test->drawTitle(60,22,$Judul,50,50,50,585);
			//$Test->Render("{$Dir->Images}/chart/chartline$Ke.jpg");
			return $Test->Stroke();
		}
		function buatBarChart($arData = array(), $arKet = array(), $arNilai = array(), $Judul = "", $Width = 420, $Height = 250, $MapID = 0)
		{
			global $Dir;
			 /* pChart library inclusions */ 
			 include("{$Dir->Common}/pchart/class/pData.class.php"); 
			 include("{$Dir->Common}/pchart/class/pDraw.class.php"); 
			 include("{$Dir->Common}/pchart/class/pImage.class.php"); 

			 /* Create and populate the pData object */ 
			 $MyData = new pData();

			
			 for ($i = 0;$i < count($arData);$i++)
			 {$MyData->addPoints($arNilai[$i],$arData[$i]);}
			
			 $MyData->setAxisName(0,"Jumlah"); 
			 $MyData->addPoints($arKet,"Months"); 
			 $MyData->setSerieDescription("Months","Month"); 
			 $MyData->setAbscissa("Months"); 

			 /* Create the pChart object */ 
			 $myPicture = new pImage(700,230,$MyData); 

			 /* Turn of Antialiasing */ 
			 $myPicture->Antialias = FALSE; 

			 /* Add a border to the picture */ 
			 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0)); 

			 /* Set the default font */ 
			 $myPicture->setFontProperties(array("FontName"=>"{$Dir->Common}/pchart/fonts/pf_arma_five.ttf","FontSize"=>6)); 
			 
			 /* Define the chart area */ 
			 $myPicture->setGraphArea(60,40,650,200); 

			 /* Draw the scale */ 
			 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE); 
			 $myPicture->drawScale($scaleSettings); 
				
			 /* Write the chart legend */ 
			 $myPicture->drawLegend(10,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL)); 

			 /* Turn on shadow computing */  
			 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 

			 /* Draw the chart */ 
			 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
			 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10); 
			 $myPicture->drawBarChart(); 

			 /* Render the picture (choose the best way) */ 
			// $myPicture->autoOutput("pictures/example.drawBarChart.simple.png"); 
			 return $myPicture->stroke();
		}
		function ambilGambar($filename = "")
		{
			$fr = fread(fopen($filename,'r'),filesize($filename));
			$fr = addslashes($fr);
			return $fr;
			fclose();
		}
		function ambilFoto($tabel = "", $fid = "", $id = "", $width = 100, $height = 100, $fphoto = "photo")
		{
			global $Dir;
			$ph = _mysql_fetch_array(_mysql_query("select $fphoto from $tabel where $fid='$id'"));
			if (!empty($id) && !empty($ph[$fphoto]))
			{
				$width = $width > $height ? $height : $width;
				return "<img src='getimages.php?tabel=$tabel&fid=$fid&id=$id&width=$width&height=$height&fphoto=$fphoto'>";
			}
			else
			{
				return "<img src='{$Dir->Images}/no_photo.jpg' width='$width' $param>";
			}
		}
		function addSlash($text = "")
		{
			$text = addslashes($text);
			return $text;
		}

		function cmbKompetensi($name='txtField',$value='',$query = '',$form='', $param=''){
			global $Dir, $Func;
			$ListKompetensi = "";
			$Q = _mysql_query($query);
			$V = "";
			$nn = 0;
			while ($H = _mysql_fetch_array($Q))
			{
				$V = $value == $H[0] ? $H[1] : $V;
				$bg = $nn % 2 == 0 ? "#FFFFD5" : "";
				$ListKompetensi .= "<A id='a{$name}' HREF='#' onclick=\"{$form}.{$name}.value='{$H[0]}';{$form}.p{$name}.value='{$H[1]}';showHideObjek('#l{$name}');$param\" class='listkom'>{$H[1]}</A><hr size='1' color='#D8D8D8'>";
				$nn++;
			}
			$Input = "
				<div onblur=\"document.getElementById('l{$name}').style.visibility='hidden'\" id='d{$name}'>
					<TABLE cellpadding='0' cellspacing='0'>
					<TR>
						<TD>			
							<input type='hidden' name='$name' value='$value'>
							<input type='text' name='p{$name}' value='$V' id='p{$name}' size='50' class='txt'>&nbsp;&nbsp;
						</TD>
						<TD>
						<!--<img src='{$Dir->Images}/btn_pilih.gif' onclick=\"g_Select.show(event, 'p{$name}', 'l{$name}');\" id='i{$name}'>-->
						<img src='{$Dir->Images}/btn_pilih.gif' onclick=\"showHideObjek('#l{$name}');\" id='i{$name}'>
						*
						</TD>
					</TR>
					</TABLE>
					<div style='position:absolute;width:400px;max-height:200px;background:white;border:1px solid gray;padding:2px;overflow-y:auto;z-index:2;display:none' id='l{$name}'>
						$ListKompetensi
					</div>
				</div>
			";	
			return $Input;
		}

		function txtTglPicker($name='',$value='',$Objek='')
			{		Global $Ref,$Dir;

					if(substr($value,2,1)!='-' || substr($value,2,1)!='/')
						{
							$value = !empty($value)?substr($value,8,2)."/".substr($value,5,2)."/".substr($value,0,4):"";
						}
					$Input = "
					<input readonly type=\"text\" name=\"$name\" value=\"$value\" size=10 maxlength=10>
					<img src='$Dir->Images/calendar.gif' onclick=\"show_calendar('{$Objek}')\"  align=\"absmiddle\" style=\"cursor:hand\">&nbsp";
					return $Input;
			}
		function chkAkhir($name='txtField',$value='',$param='')
			{
				global $Ref;
				$Sel = $value=='1'?" checked ":"";
				$Input  = "<input name=\"$name\" id=\"$name\" value=\"1\" type=\"checkbox\" $Sel $param>";
				return $Input;
			}
		function chkArray($name='txtField',$value='',$Isi='',$param='')
		{
			global $Ref;
			$Sel = $value==$Isi?" checked ":"";
			$Input  = "<input name=\"$name\" id=\"$name\" value='$Isi' type=\"checkbox\" $Sel $param>";
			return $Input;
		}
		function Kotak($Judul="",$Isi="",$Width="",$Height="",$JW="84")
		{
			global $Main,$Dir;

			include "{$Main->Tema}/kotak.inc.php";
			$Kotak = str_replace("<!--Width-->","$Width",$Kotak);
			$Kotak = str_replace("<!--WidthJudul-->","$JW",$Kotak);
			$Kotak = str_replace("<!--IsiKotak-->","$Isi",$Kotak);
			$Kotak = str_replace("<!--JudulKotak-->",strtoupper("$Judul"),$Kotak);
			$Kotak = str_replace("<!--Height-->","$Height",$Kotak);
			return $Kotak;
		}
		function KotakMenu($Judul="",$Isi="",$Width="",$Height="",$JW="84")
		{
			global $Main,$Dir;
			include "{$Main->Tema}/kotakmenu.inc.php";
			$KotakMenu = str_replace("<!--Width-->","$Width",$KotakMenu);
			$KotakMenu = str_replace("<!--WidthJudul-->","$JW",$KotakMenu);
			$KotakMenu = str_replace("<!--IsiKotak-->","$Isi",$KotakMenu);
			$KotakMenu = str_replace("<!--JudulKotak-->","$Judul",$KotakMenu);
			$KotakMenu = str_replace("<!--Height-->","$Height",$KotakMenu);
			return $KotakMenu;
		}

		function KotakHeader($Judul="",$Isi="",$Width="",$Height="",$JW="84")
		{
			global $Main,$Dir;
			include "{$Main->Tema}/kotakheader.inc.php";
			$KotakHeader = str_replace("<!--Width-->","$Width",$KotakHeader);
			$KotakHeader = str_replace("<!--IsiKotak-->","$Isi",$KotakHeader);
			$KotakHeader = str_replace("<!--JudulKotak-->","$Judul",$KotakHeader);
			$KotakHeader = str_replace("<!--Height-->","$Height",$KotakHeader);
			return $KotakHeader;
		}

		
		function downloat($direktori="",$filename="")
		{
			if(file_exists($direktori.$filename)){
				$file_extension = strtolower(substr(strrchr($filename,"."),1));

				switch($file_extension){
				  case "pdf": $ctype="application/pdf"; break;
				  case "exe": $ctype="application/octet-stream"; break;
				  case "zip": $ctype="application/zip"; break;
				  case "rar": $ctype="application/rar"; break;
				  case "doc": $ctype="application/msword"; break;
				  case "xls": $ctype="application/vnd.ms-excel"; break;
				  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
				  case "gif": $ctype="image/gif"; break;
				  case "png": $ctype="image/png"; break;
				  case "jpeg":
				  case "jpg": $ctype="image/jpg"; break;
				  default: $ctype="application/proses";
				}

				if ($file_extension=='php'){
				  $return="<h1>Access forbidden!</h1>
						<p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi</p>";
				  exit;
				}
				else{
				 
				  header("Content-Type: octet/stream");
				  header("Pragma: private"); 
				  header("Expires: 0");
				  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				  header("Cache-Control: private",false); 
				  header("Content-Type: $ctype");
				  header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
				  header("Content-Transfer-Encoding: binary");
				  header("Content-Length: ".filesize($direktori.$filename));
				  readfile("$direktori$filename");
				  exit();   
				}
			}else{
				  $return="<h1>Access forbidden!</h1>
						<p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi.</p>";
				  exit;
			}
			return $return;
		}
		function KopSurat($KDTAHUNAJARAN="",$Judul="")
		{
			include "./common/connpas.php";
			$HKop1=_mysql_fetch_array(_mysql_query("select * from r_header"));
			$HKop2=_mysql_fetch_array(_mysql_query("select NM_SEKOLAH, JALAN, KD_POS, KD_AREA, NO_TELP, NO_FAX, EMAIL, WEBSITE  from t_sekolah_identitas where KD_TAHUN_AJARAN='$KDTAHUNAJARAN' limit 1"));
			
			if(!empty($HKop2['NO_TELP']))
			{$NO_TELP="Telp. ({$HKop2['KD_AREA']}){$HKop2['NO_TELP']}";}else{$NO_TELP="";}
			if(!empty($HKop2['NO_FAX'])){$NO_FAX="Fax. ({$HKop2['KD_AREA']}){$HKop2['NO_FAX']}";}else{$NO_FAX="";}
			if(!empty($HKop2['EMAIL'])){$EMAIL="Email: {$HKop2['EMAIL']}";}else{$EMAIL="";}
			if(!empty($HKop2['WEBSITE'])){$WEBSITE="Website: {$HKop2['WEBSITE']}";}else{$WEBSITE="";}
			$Kop="				
				<div class='printhidden'>
					<table width='100%' style='border-bottom:2px solid black;' align=center>
					<tr>
						<td align=center><img src='images/pemda.gif' height='80'></td>
						<td align=center width='100%'>
							<span style='font-size:13pt;'>{$HKop1['HEADER_1']}<br>
							{$HKop1['HEADER_2']}<br></span>
							<span style='font-size:15pt;font-weight:bold;'>{$HKop2['NM_SEKOLAH']}<br></span>
							Alamat : {$HKop2['JALAN']}<br>
							  $NO_TELP $NO_FAX $EMAIL $WEBSITE
						</td>
						<td align=center><img src='images/sma.gif' height='80'></td>
					</tr>
					</table>
				<br><b><center>$Judul</center></b></div>
			";
			return $Kop;
		}
		function slideheader()
		{	$IsiSliderHeader="";
			$QHeader=_mysql_query("select * from t_header where aktif='Y' order by id_header  desc");
			while($IsiHeader=_mysql_fetch_array($QHeader))
			{
				$IsiSliderHeader.="
					<li>
						<img src='images/img_header/{$IsiHeader['gbr_header']}' class='random' width='1024' height='300'/>
						<div class='label_text'>
							 <h5>{$IsiHeader['jdl_header']}</h5><p>{$IsiHeader['keterangan']}</p>
						</div>
					</li>
				";
			}
			$slide="			
				<div class='border_box' align=center>
				<div class='box_skitter box_skitter_large34' >
					<ul>$IsiSliderHeader</ul>
				</div>
				</div>
			";
			return $slide; 
		}

	/////////////////////////////////////////////////// fungsi thumb /////////////////////////////////////////
			// Upload gambar untuk berita
			function UploadImage($fupload_name,$lokasi){
			  //direktori gambar
			  $vdir_upload = $lokasi;
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan gambar dalam ukuran sebenarnya
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

			  //identitas file asli
			  $im_src = imagecreatefromjpeg($vfile_upload);
			  $src_width = imageSX($im_src);
			  $src_height = imageSY($im_src);

			  //Simpan dalam versi small 110 pixel
			  //Set ukuran gambar hasil perubahan
			  $dst_width = 110;
			  $dst_height = ($dst_width/$src_width)*$src_height;

			  //proses perubahan ukuran
			  $im = imagecreatetruecolor($dst_width,$dst_height);
			  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

			  //Simpan gambar
			  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
			  

			  //Simpan dalam versi medium 360 pixel
			  //Set ukuran gambar hasil perubahan
			  $dst_width2 = 390;
			  $dst_height2 = ($dst_width2/$src_width)*$src_height;

			  //proses perubahan ukuran
			  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
			  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

			  //Simpan gambar
			  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);
			  
			  //Hapus gambar di memori komputer
			  imagedestroy($im_src);
			  imagedestroy($im);
			  imagedestroy($im2);
			}
			
			// Upload file untuk download file
			function UploadFile($fupload_name,$lokasi){
			  //direktori file
			  $vdir_upload = $lokasi;
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan file
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
			}

			function CreateTable($namatable="",$Query=""){
				$Qry=_mysql_query("SHOW CREATE TABLE $namatable;");
				if(@!_mysql_num_rows($Qry)>0)
				{_mysql_query($Query);}
			}

			function MakeDir($DirName="")
			{
				if (!file_exists($DirName)){mkdir($DirName, 0777, true);} 
			}
			/*function UploadBanner($fupload_name){
			  //direktori banner
			  $vdir_upload = "../../../foto_banner/";
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan gambar dalam ukuran sebenarnya
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
			}


			


			// Upload gambar untuk album galeri foto
			function UploadAlbum($fupload_name){
			  //direktori gambar
			  $vdir_upload = "../../../img_album/";
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan gambar dalam ukuran sebenarnya
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

			  //identitas file asli
			  $im_src = imagecreatefromjpeg($vfile_upload);
			  $src_width = imageSX($im_src);
			  $src_height = imageSY($im_src);

			  //Simpan dalam versi small 120 pixel
			  //Set ukuran gambar hasil perubahan
			  $dst_width = 120;
			  $dst_height = ($dst_width/$src_width)*$src_height;

			  //proses perubahan ukuran
			  $im = imagecreatetruecolor($dst_width,$dst_height);
			  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

			  //Simpan gambar
			  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
			  
			  //Hapus gambar di memori komputer
			  imagedestroy($im_src);
			  imagedestroy($im);
			}


			// Upload gambar untuk galeri foto
			function UploadGallery($fupload_name){
			  //direktori gambar
			  $vdir_upload = "../../../img_galeri/";
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan gambar dalam ukuran sebenarnya
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

			  //identitas file asli
			  $im_src = imagecreatefromjpeg($vfile_upload);
			  $src_width = imageSX($im_src);
			  $src_height = imageSY($im_src);

			  //Simpan dalam versi small 100 pixel
			  //Set ukuran gambar hasil perubahan
			  $dst_width = 100;
			  $dst_height = ($dst_width/$src_width)*$src_height;

			  //proses perubahan ukuran
			  $im = imagecreatetruecolor($dst_width,$dst_height);
			  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

			  //Simpan gambar
			  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
			  
			  //Hapus gambar di memori komputer
			  imagedestroy($im_src);
			  imagedestroy($im);
			}


			// Upload gambar untuk sekilas info
			function UploadInfo($fupload_name){
			  //direktori gambar
			  $vdir_upload = "../../../foto_info/";
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan gambar dalam ukuran sebenarnya
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

			  //identitas file asli
			  $im_src = imagecreatefromjpeg($vfile_upload);
			  $src_width = imageSX($im_src);
			  $src_height = imageSY($im_src);

			  //Simpan dalam versi small 54 pixel
			  //Set ukuran gambar hasil perubahan
			  $dst_width = 54;
			  $dst_height = ($dst_width/$src_width)*$src_height;

			  //proses perubahan ukuran
			  $im = imagecreatetruecolor($dst_width,$dst_height);
			  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

			  //Simpan gambar
			  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
			  
			  //Hapus gambar di memori komputer
			  imagedestroy($im_src);
			  imagedestroy($im);
			}

			// Upload gambar untuk favicon
			function UploadFavicon($fupload_name){
			  //direktori favicon di root
			  $vdir_upload = "../../../";
			  $vfile_upload = $vdir_upload . $fupload_name;

			  //Simpan gambar dalam ukuran sebenarnya
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
			}*/

	}

	class pageNavi{
			// Fungsi untuk mencek halaman dan posisi data
			function cariPosisi($batas) {
				if(empty($_GET['pagehal'])) {
					$posisi = 0;
					$_GET['pagehal'] = 1;
				} else {
					$posisi = ($_GET['pagehal'] - 1) * $batas;
				}
				return $posisi;
			}
			
			// Fungsi untuk menghitung total halaman
			function jumlahHalaman($jmldata, $batas) {
				$jmlhalaman = ceil($jmldata/$batas);
				return $jmlhalaman;
			}
			
			// Fungsi untuk link halaman 1,2,3 
			function navHalaman($halaman_aktif, $jmlhalaman, $linkhal) {
				global $link;
				
				$link_halaman = "";
			
				// Link ke halaman pertama (first) dan sebelumnya (prev)
				if($halaman_aktif > 1) {
					$prev = $halaman_aktif - 1;
		
					if($prev > 1) { 
						$link_halaman .= "<a class=\"first\" href=\"{$linkhal}&pagehal=1\"></a>";
					}			
					$link_halaman .= "<a class=\"previouspostslink\" href=\"{$linkhal}&pagehal=".$prev."\"></a>";
				}
			
				// Link halaman 1,2,3, ...
				$angka = ($halaman_aktif > 3 ? "<span>...</span>" : " "); 
				for($i = $halaman_aktif-2;$i < $halaman_aktif;$i++) {
					if ($i < 1) continue;
					$angka .= "<a href=\"{$linkhal}&pagehal=".$i."\">".$i."</a>";
				}
				$angka .= "<span class=\"current\">".$halaman_aktif."</span>";
				  
				for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++) {
					if($i > $jmlhalaman) break;
					$angka .= "<a href=\"{$linkhal}&pagehal=".$i."\">".$i."</a>";
				}
				$angka .= ($halaman_aktif+2 < $jmlhalaman ? "<span>...</span><a href=\"{$linkhal}&pagehal=".$jmlhalaman."\">".$jmlhalaman."</a>" : " ");
			
				$link_halaman .= $angka;
				
				// Link ke halaman berikutnya (Next) dan terakhir (Last) 
				if($halaman_aktif < $jmlhalaman) {
					$next = $halaman_aktif + 1;
					$link_halaman .= "<a class=\"nextpostslink\" href=\"{$linkhal}&pagehal=".$next."\"></a>";
					
					if($halaman_aktif != $jmlhalaman - 1) {
						$link_halaman .= "<a class=\"last\" href=\"{$linkhal}&pagehal=".$jmlhalaman."\"></a>";
					}
				}
				
				return $link_halaman;
			}
		}

		class Halaman{
		var $Banyak = 10;
		var $Hal = 1;
		var $Link = "index.php";
		var $Tampil = "#isi";
		var $Query = "";
		var $Qry = "";
		var $Jumlah = 0;
		var $No = 0;
		function buatHalaman(){
			$Mulai = ($this->Hal * $this->Banyak)-$this->Banyak;
			$this->Qry = _mysql_query($this->Query." limit $Mulai,{$this->Banyak}");
			$this->Jumlah = _mysql_num_rows(_mysql_query($this->Query));
			$JmlPage = ceil($this->Jumlah/$this->Banyak);
			$ListPage="";
			for ($i=1;$i<=$JmlPage;$i++)
			{	
				$Sel = $this->Hal == $i ? "selected" : "";
				$ListPage.="<option value='$i' $Sel>$i";
			}
			
			if (!empty($ListPage))
			{
				$ListPage = "
				<TABLE cellpadding='0' cellspacing='0' width='100%'>
				<TR>
					<TD>Jumlah Data : $this->Jumlah</TD>
					<TD align='right'>Halaman <select onchange=\"ambilData('{$this->Tampil}', '{$this->Link}&Hal='+this.options[this.selectedIndex].value);ambilData('{$this->Tampil2}', '{$this->Link}&Hal='+this.options[this.selectedIndex].value)\">$ListPage</select> dari {$JmlPage}</TD>
				</TR>
				</TABLE>";
			}
			$this->No = (($this->Hal-1)*$this->Banyak);

			return $ListPage;
		}
	}
	?>