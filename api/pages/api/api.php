<?php


class apiObj  extends DaftarObj2{
	var $Prefix = 'api';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'api'; //bonus
	var $TblName_Hapus = 'api';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id_modul');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);
	var $checkbox_rowspan = 1;
	var $PageTitle = 'REFERENSI MODUL';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='api.xls';
	var $namaModulCetak='REFERENSI MODUL';
	var $Cetak_Judul = 'REFERENSI MODUL';
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'apiForm';
	var $noModul=14;
	var $TampilFilterColapse = 0; //0





	function set_selector_other($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;

	  switch($tipe){




		case 'pushNotif':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			}
			$target = 'https://fcm.googleapis.com/fcm/send';
			$headers = array (
			'Authorization: key = AIzaSyBVJKrKRLW5m63RloYnFNu4fQDF9hbSdJQ',
			'Content-Type: application/json'
			);
			$getTokenTarget = mysql_fetch_array(mysql_query("select * from member where email ='$email'"));
			$token = $getTokenTarget['firebase_id'];
			$arrayPush = json_encode(array('title'=> $title, 'body'=>$body, 'event'=> $event));

			if($event == "suspend"){
				mysql_query("update member set status = 'suspend' where email = '$email'");
			}elseif($event == "penukaran") {
					//$explodingJSON = json_decode($body);
					// $idPenukaran = $explodingJSON['id'];
					// mysql_query("update penukaran set status = 'DONE', tanggal_aksi = '".date('d-m-Y')."' where id = '$idPenukaran'");
			}

			$fields = array('to'=>$token, 'data'=> array("itemPush" => $arrayPush));
				$payload = json_encode($fields);
				$curl_session = curl_init();
			       	 curl_setopt($curl_session, CURLOPT_URL, $target);
			       	 curl_setopt($curl_session, CURLOPT_POST, true);
			         curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
			         curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
			         curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
			         curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			         curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
			$result = curl_exec($curl_session);
			$content = $result;
		break;
		}

		case 'auth':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			}
			$emil = mysql_real_escape_string($email);
			$password = mysql_real_escape_string($password);
			$grab = mysql_fetch_array(mysql_query("select * from member where email = '$email' and password = '$password'"));
			foreach ($grab as $key => $value) {
				  $$key = $value;
			}
			if(mysql_num_rows(mysql_query("select * from member where email = '$email' and password = '$password'")) == 0){
				$err = "Login gagal";
			}elseif($status == "suspend"){
				$err = "Akun anda telah di suspend";
			}elseif($verifikasi != "ok"){
				$err = "Akun anda belum terverifikasi";
			}else{
				$target = 'https://fcm.googleapis.com/fcm/send';
				$headers = array (
				'Authorization: key = AIzaSyBVJKrKRLW5m63RloYnFNu4fQDF9hbSdJQ',
				'Content-Type: application/json'
				);
				$getTokenTarget = mysql_fetch_array(mysql_query("select * from member where email ='$email'"));
				$tokenLast = $getTokenTarget['firebase_id'];
				if($tokenLast == $token){

				}else{
					$arrayPush = json_encode(array('title'=> "Akun Login Diperangkat Lain", 'body'=>'{"alasan":"Tindakan Curang"}', 'event'=> "double"));
					$fields = array('to'=>$tokenLast, 'data'=> array("itemPush" => $arrayPush));
					$payload = json_encode($fields);
					$curl_session = curl_init();
								       	 curl_setopt($curl_session, CURLOPT_URL, $target);
								       	 curl_setopt($curl_session, CURLOPT_POST, true);
								         curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
								         curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
								         curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
								         curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
								         curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
					 						 	 curl_exec($curl_session);
				}

				$content = array(
												"namaLengkap" => $nama_lengkap,
												"nomorTelepon" => $no_telepon,
												"email" => $email,
												"saldo" => $saldo,

												);
				$data = array(
												"firebase_id" => $token,
											);
				mysql_query(VulnWalkerUpdate("member",$data,"email = '$email'"));

			}
		break;
		}

		case 'setToken':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			}

				$data = array(
												"firebase_id" => $token."update",
											);
				mysql_query(VulnWalkerUpdate("member",$data,"email = '$email'"));


		break;
		}

		case 'getSaldo':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			}

			$getData = mysql_fetch_array(mysql_query("select * from member where email ='$email'"));
			$content = array("saldo" => $getData['saldo']);
		break;
		}


		case 'addSaldo':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			}
			$data = array("saldo" => $saldo);
			mysql_query(VulnWalkerUpdate("member",$data,"email = '$email'"));

			$dataIklan = array(
								"email" => $email,
								"tanggal" => date("d-m-Y"),
								"jam" => date("H:i"),
								"jenis_iklan" => $jenis_iklan,
								"saldo_dapat" => $saldo_dapat
								);
			mysql_query(VulnWalkerInsert("histori_iklan",$dataIklan));
		break;
		}


		case 'adsRequest':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			}

			$dataIklan = array(
								"email" => $email,
								"tanggal" => date("d-m-Y"),
								"jam" => date("H:i"),
								"jenis_iklan" => $jenis_iklan,
								);
			mysql_query(VulnWalkerInsert("histori_request",$dataIklan));
		break;
		}




	   case 'register':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
			 }

			 // mail('fuxape@duck2.club', 'the subject', 'the message', null,'fuxape@duck2.club');
				if(empty($nama)){
					$err = "Isi Nama Lengkap";
				}elseif(empty($email)){
					$err = "Isi Email";
				}elseif(empty($password)){
					$err = "Isi Password";
				}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
					$err = "Email Tidak Valid";
				}elseif(empty($no_telepon)){
					$err = "Isi Nomor Telepon";
				}elseif(mysql_num_rows(mysql_query("select * from member where email = '$email'")) != 0){
					$err = "Email sudah terdaftar";
				}else{

					$data = array(
												"email" => $email,
												"nama_lengkap" => $nama,
												"password" => $password,
												"no_telepon" => $no_telepon,
												"saldo" => "0",
												"verifikasi" => "ok",
												"status" => "registered"
											 );
					 $execute =	mysql_query(VulnWalkerInsert("member",$data));
					 if($execute){
						 //$cek = "Register Berhasil Silahkan Cek Email Anda";
						 $cek = "Register Berhasil";
					 }else{
						 $cek = "Register Gagal Mungkin Email Telah Terdaftar";
					 }
				}
		break;
	    }

			case 'getListTukar':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$arrayList = array();
				$get = mysql_query("select * from tukar_point");
				while ($rows = mysql_fetch_array($get)) {
					foreach ($rows as $key => $value) {
						  $$key = $value;
					}
					$arrayList[] = array("id" => $id, "nama_tukar" => $nama_tukar, "jumlah_point" => $jumlah_point , "jumlah_dapat" => $jumlah_dapat);
				}
				$content = json_encode($arrayList);


			break;
			}

			case 'getDetailListTukar':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$arrayList = array();
				$get = mysql_query("select * from tukar_point where id = '$id_tukar'");
				while ($rows = mysql_fetch_array($get)) {
					foreach ($rows as $key => $value) {
						  $$key = $value;
					}
					$arrayList[] = array("id" => $id, "nama_tukar" => $nama_tukar, "jumlah_point" => $jumlah_point , "jumlah_dapat" => $jumlah_dapat);
				}
				$content = json_encode($arrayList);


			break;
			}

			case 'getHistoriPenukaran':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$arrayList = array();
				$get = mysql_query("select * from penukaran where email = '$email'");
				while ($rows = mysql_fetch_array($get)) {
					foreach ($rows as $key => $value) {
						  $$key = $value;
					}
					$namaTukar = mysql_fetch_array(mysql_query("select * from tukar_point where id = '$id_tukar_point'"));
					$arrayList[] = array("id" => $id, "nama_tukar" => $namaTukar['nama_tukar'], "tanggal" => $tanggal , "status" => $status);
				}
				$content = json_encode($arrayList);


			break;
			}

			case 'requestTukar':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$grabingAccount = mysql_fetch_array(mysql_query("select * from member where email = '$email'"));
				$myBalance = $grabingAccount['saldo'];
				$grabingTukar = mysql_fetch_array(mysql_query("select * from tukar_point where id = '$id'"));
				$balanceForWidraw = $grabingTukar['jumlah_point'];
				$namaPerunakaran = $grabingTukar['nama_tukar'];
				if($myBalance < $balanceForWidraw){
					$err = "Saldo anda tidak cukup, minimal saldo Rp. $balanceForWidraw untuk menukar dengan $namaPerunakaran !";
				}else{
					$cek = "Selamat, anda telah menukar saldo Rp. $balanceForWidraw untuk $namaPerunakaran, permintaan anda sedang di proses";
					$dataPenukaran = array(
										  	"email" => $email,
											"id_tukar_point" => $id,
											"tanggal" => date("d-m-Y"),
											"status" => "PROCESSING",
											'tanggal_aksi' => ''
										  );
					mysql_query(VulnWalkerInsert("penukaran",$dataPenukaran));
					$getIdHistori = mysql_fetch_array(mysql_query("select max(id) from penukaran where email = '$email'"));
					$getDataHistori = mysql_fetch_array(mysql_query("select * from penukaran where id = '".$getIdHistori['max(id)']."'"));
					mysql_query("update member set saldo = saldo - $balanceForWidraw where email = '$email'");
					$getSaldoSekarang = mysql_fetch_array(mysql_query("select * from member where email = '$email'"));
					$content =  array("saldo" => $getSaldoSekarang['saldo'],
														"id_histori" => $getIdHistori['max(id)'],
														"nama_tukar" => $namaPerunakaran,
														"tanggal" => $getDataHistori['tanggal'],
														"status" => $getDataHistori['status'],
														"tanggal_aksi" => $getDataHistori['tanggal_aksi'],
													 );

				}

/*				$content = array(
									"my_balance" => $myBalance,
									"min_point" => $balanceForWidraw,
								);*/




			break;
			}


			case 'absen':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$tanggal = date("d-m-Y");
				if(mysql_num_rows(mysql_query("select * from absen where email = '$email' and tanggal = '$tanggal'")) !=0 ){
					$err = "Anda telah melakukan absen hari ini";
				}else{
					$data = array(
												'email' => $email,
												'tanggal' => $tanggal
					);
					mysql_query(VulnWalkerInsert("absen",$data));
				}


			break;
			}

			case 'sync':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}


				$arrayPenukaran = array();
				$getHistoriPenukaran = mysql_query("select * from penukaran where email = '$email' order by id");
				while($rows = mysql_fetch_array($getHistoriPenukaran)){
						$idPenukaran = $rows['id'];
						$getNamaTukar = mysql_fetch_array(mysql_query("select * from tukar_point where id = '".$rows['id_tukar_point']."'"));
						$namaTukar = $getNamaTukar['nama_tukar'];
						$tanggal = $rows['tanggal'];
						$status = $rows['status'];
						$tanggalAksi = $rows['tanggal_aksi'];
						$arrayPenukaran[] = array("id" => $idPenukaran, "nama_tukar" => $namaTukar, "tanggal" => $tanggal, "status" => $status, "tanggal_aksi" => $tanggalAksi);
				}

				$arrayAccount = array();
				$getAccount = mysql_query("select * from member where email = '$email'");
				while($rows = mysql_fetch_array($getAccount)){
						foreach ($rows as $key => $value) {
								$$key = $value;
						}
						$arrayAccount[] = array("email" => $email, "nama_lengkap" => $nama_lengkap, "no_telepon" => $no_telepon, "saldo" => $saldo);
				}


				$content = array("penukaran" => json_encode($arrayPenukaran), "akun" => json_encode($arrayAccount) );




			break;
			}

			case 'absen':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$tanggal = date("d-m-Y");
				if(mysql_num_rows(mysql_query("select * from absen where email = '$email' and tanggal = '$tanggal'")) !=0 ){
					$err = "Anda telah melakukan absen hari ini";
				}else{
					$data = array(
												'email' => $email,
												'tanggal' => $tanggal
					);
					mysql_query(VulnWalkerInsert("absen",$data));
				}


			break;
			}


			case 'cek_iklan':{
				foreach ($_REQUEST as $key => $value) {
					  $$key = $value;
				}
				$tanggal = date("d-m-Y");
				$getLastOpenedAds = mysql_fetch_array(mysql_query("select max(id) from histori_request where email = '$email' and tanggal = '$tanggal' and jenis_iklan = '$jenis_iklan' "));
				$idMax = $getLastOpenedAds['max(id)'];
				$getDataMax = mysql_fetch_array(mysql_query("select * from histori_request where id = '$idMax'"));
				$lastJam = $getDataMax['jam'];
				$explodingJam = explode(':',$lastJam);
				$mixTime = ($explodingJam[0] * 60 ) + $explodingJam[1];
				$explodingTimeNow = explode(':',date("H:i"));
				$mixTimeNow = ($explodingTimeNow[0] * 60) + $explodingTimeNow[1];

				$delay = $mixTimeNow - $mixTime;

				if($delay < 5 && $jenis_iklan == "TONTON VIDEO"){
					$err = "Iklan hanya dapat tampil setelah 5 menit dari pemutaran sebelumnya";
				}

				if($delay < 3 && $jenis_iklan == "KLIK IKLAN"){
						$err = "Iklan hanya dapat tampil setelah 3 menit dari pemutaran sebelumnya";
				}

				if($jenis_iklan == "TONTON VIDEO" && mysql_num_rows(mysql_query("select * from histori_request where tanggal = '$tanggal' and email = '$email' and jenis_iklan = 'TONTON VIDEO'"))  > 50){
					$err = "Iklan sudah melebihi limit pemutaran / hari";
				}
				if($jenis_iklan == "KLIK IKLAN" && mysql_num_rows(mysql_query("select * from histori_request where tanggal = '$tanggal' and email = '$email' and jenis_iklan = 'KLIK IKLAN'"))  > 70){
					$err = "Iklan sudah melebihi limit pemutaran / hari";
				}



			break;
			}




		 default:{
				$other = $this->set_selector_other2($tipe);
				$cek = $other['cek'];
				$err = $other['err'];
				$content=$other['content'];
				$json=$other['json'];
		 break;
		 }

	 }

		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
   }


   function setPage_OtherScript(){
		$scriptload =
					"<script>
						$(document).ready(function(){
							".$this->Prefix.".loading();
						});
					</script>";
		return
			"<script type='text/javascript' src='js/master/api/".$this->Prefix.".js' language='JavaScript' ></script>".
			$scriptload;
	}


}
$api = new apiObj();
?>
