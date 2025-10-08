<?php
	$response = new stdClass();
	if ($_GET){foreach($_GET as $key => $value){$$key = $value;}}
	if ($_POST){foreach($_POST as $key => $value){$$key = $value;}}
	/// SETTING 
	$Master_Host="localhost";
	$Master_User="root";
	$Master_Pwd="";
	$Master_DB="dbmonitoring";
	
	$id_maping=$id_maping;
	/// MASTER
	$con00 = mysqli_connect($Master_Host, $Master_User, $Master_Pwd, $Master_DB);
	
	$TmpQry="select b.dbname as dbdwh, c.dbname as dbsumber, c.hostname as hsumber, c.username as usumber, c.`password` as psumber, d.query_script, d.query_name ,e.table_name from reg_maping_sumber_to_dwh as a inner join reg_db_dwh as b on a.id_dbname_dwh=b.id_dbname inner join reg_db_sumber as c on a.id_dbname_sumber=c.id_dbname inner join reg_db_sumber_query as d on a.id_query=d.id_query inner join reg_db_dwh_table as e on a.id_table=e.id_table WHERE a.id_maping='{$id_maping}'";
	$Qry = mysqli_query($con00,$TmpQry);
	$MIsi=mysqli_fetch_array($Qry,MYSQLI_ASSOC);
	
	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////// KONEKSI DATABASE
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// DATA DWH
	$con02 = mysqli_connect($Master_Host, $Master_User, $Master_Pwd, $MIsi['dbdwh']);
	
	/// DATA SUMBER
	$con01 = mysqli_connect($MIsi['hsumber'], $MIsi['usumber'], $MIsi['psumber'], $MIsi['dbsumber']);
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$query_script=$MIsi['query_script'];
	$table_name=$MIsi['table_name'];
	

	////// FIELD PARAMETER
	$QUpdate="";
	$QInsert="";
	$QInsertValue="";
	$QParam="";
	$Qry02 = mysqli_query($con00,"select field_sumber, field_dwh, param from reg_maping_sumber_to_dwh_field where id_maping='{$id_maping}'");
	if(mysqli_num_rows($Qry02)>0){
		 while($Isi=mysqli_fetch_array($Qry02,MYSQLI_ASSOC)){
			$QUpdate.=" `{$Isi['field_dwh']}`='{[|]Isi['{$Isi['field_sumber']}']}',";
			$QInsert.="`{$Isi['field_dwh']}`,";
			$QInsertValue.="'{[|]Isi['{$Isi['field_sumber']}']}',";
			if($Isi['param']=='Y'){
				$QParam.=" `{$Isi['field_dwh']}`='{[|]Isi['{$Isi['field_sumber']}']}' and ";
			}
		 }
		$QParam=str_replace('[|]','$',substr($QParam,0,-5));	
		$QUpdate=str_replace('[|]','$',substr($QUpdate,0,-1));	
		$QInsert=substr($QInsert,0,-1);
		$QInsertValue=str_replace('[|]','$',substr($QInsertValue,0,-1));
		$QParam=!empty($QParam)?" where ".$QParam:"";
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////// ACTION INSERT UPDATE 
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
		 $result = mysqli_query($con01,$query_script); $i=1;
		 while($Isi=mysqli_fetch_array($result,MYSQLI_ASSOC)){					 
			eval("\$QryParam = \"$QParam\";");

			$QCek=mysqli_query($con02,"select * from `{$table_name}` {$QryParam}");
			if(mysqli_num_rows($QCek)>0){
				$sql02="UPDATE `{$table_name}` set {$QUpdate} {$QryParam}";
			}else{
				$sql02="INSERT INTO `{$table_name}` ({$QInsert}) VALUES ({$QInsertValue});";
			}
			eval("\$Qsimpan = \"$sql02\";");
			mysqli_query($con02,$Qsimpan);
			$i++;
		 };
		 $response->result = "Berhasil, ".$MIsi['dbsumber'].".".$MIsi['query_name']." Ke DWH ".$MIsi['dbdwh'].".".$MIsi['table_name']." Record[".($i-1)."]";
		 $response->status="1";
	}else{
		$response->status="2";
		$response->result = "Gagal, ".$MIsi['dbsumber'].".".$MIsi['query_name']." Ke DWH ".$MIsi['dbdwh'].".".$MIsi['table_name'];
	}
	/*
    mysqli_close($con00);
	mysqli_close($con01); 
	mysqli_close($con02);
*/

	
	
	
	
	header("Content-type : application/json");
	echo json_encode($response, JSON_NUMERIC_CHECK);
?>

