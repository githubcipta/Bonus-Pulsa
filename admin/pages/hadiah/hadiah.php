<?php

class hadiahObj  extends DaftarObj2{
	var $Prefix = 'hadiah';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'member'; //bonus
	var $TblName_Hapus = 'member';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('email');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);
	var $checkbox_rowspan = 2;
	var $PageTitle = 'DATA hadiah';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='hadiah.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'hadiah';
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'hadiahForm';
	var $noModul=9;
	var $TampilFilterColapse = 0; //0
	var $username = "";

	function setTitle(){
		return 'DATA HADIAH';
	}

	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) {
			  $$key = $value;
			}

			return

				"<td>".genPanelIcon("javascript:".$this->Prefix.".reward()","delete_f2.png","Kirim Hadiah", 'Kirim Hadiah')."</td>";

	}

	function setMenuView(){
		return "";

	}

	function genRowSum($ColStyle, $Mode, $Total){
		foreach ($_REQUEST as $key => $value) {
		  	$$key = $value;
		 }


		$ContentTotalHal=''; $ContentTotal='';
			$TotalColSpan1 = $this->FieldSum_Cp1[$Mode-1];//$Mode ==1 ? 5 : 4;
			$TotalColSpan2 = $this->FieldSum_Cp2[$Mode-1];//$Mode ==1 ? 5 : 4;

				$ContentTotal =
				"<tr>
					<td class='$ColStyle' colspan='5' align='center'><b>Total</td>
					<td class='GarisDaftar' align='right'><b>".number_format($this->totalSaldo,0,',','.')." </div></td>
				</tr>" ;




			if($Mode == 2){
				$ContentTotal = '';
			}else if($Mode == 3){
				$ContentTotalHal='';
			}

		return $ContentTotalHal.$ContentTotal;
}


	function simpanEdit(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];

	$dk= $_REQUEST['k'];
	$dl= $_REQUEST['l'];
	$dm= $_REQUEST['m'];
	$dn= $_REQUEST['n'];
	$do= $_REQUEST['o'];
	$nama= $_REQUEST['nm_hadiah'];


	//$ke = substr($ke,1,1);


	if($err==''){

	$aqry = "UPDATE hadiah set k='$dk',l='$dl',m='$dm',n='$dn',o='$do',nm_hadiah='$nama' where concat (k,' ',l,' ',m,' ',n,' ',o)='".$idplh."'";$cek .= $aqry;
						$qry = mysql_query($aqry);
				}

			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
    }



	function simpan(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
    	foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
		if(empty($email))$err = "Isi Email";
		if(empty($password))$err = "Isi password";
		if(empty($nama_lengkap))$err = "Isi Nama Lengkap";
		if(empty($no_telepon))$err = "Isi Nomor Telepon";
		if(empty($verifikasi))$err = "Pilih Status Verifikasi";


		if($fmST == 0){
				if(mysql_num_rows(mysql_query("select * from hadiah where email = '$email'")) != 0){
					$err = "Email telah terdaftar";
				}
				if($err == ''){

					$data = array(
								  'email' => $email,
								  'password' => $password,
								  'nama_lengkap' => $nama_lengkap,
								  'no_telepon' => $no_telepon,
								  'saldo' => $saldo,
								  'status' => 'registered',
								  'verifikasi' => $verifikasi,
								  'firebase_id' => '',
								);
					mysql_query(VulnWalkerInsert('hadiah',$data));
					$cek = VulnWalkerInsert('hadiah',$data);
				}
			}else{
				$tanggal_update = explode('-',$tanggal_update);
				$data = array(
								'email' => $email,
								'password' => $password,
								'nama_lengkap' => $nama_lengkap,
								'no_telepon' => $no_telepon,
								'saldo' => $saldo,
								'verifikasi' => $verifikasi,
							);
				mysql_query(VulnWalkerUpdate('hadiah',$data,"email='$hubla'"));

			}

			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
    }

	function set_selector_other2($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;

	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}

	function set_selector_other($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;

	  switch($tipe){

		case 'getdata':{
				$Id = $_REQUEST['id'];
				$k = substr($Id, 0,1);
				$l = substr($Id, 2,1);
				$m = substr($Id, 4,1);
				$n = substr($Id, 6,2);
				$o = substr($Id, 9,2);
				$get = mysql_fetch_array( mysql_query("select *, concat(k,'.',l,'.',m,'.',n,'.',o) as kodehadiah  from hadiah where k='$k' AND l='$l' AND m='$m' AND n='$n' AND o='$o'"));


				$content = array('kode_hadiah' => $get['kodehadiah'], 'nm_hadiah' => $get['nm_hadiah']);


		break;
	    }

		case 'modul':{
				foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
				mysql_query("delete from temp_rincian_aplikasi_pemda where username = '$this->username'");
				$idPenggunaAplikasi = $hadiah_cb[0];
				$getIdAplikasi = mysql_fetch_array(mysql_query("select * from $this->TblName where id = '$idPenggunaAplikasi'"));
				$idAplikasi = $getIdAplikasi['id_aplikasi'];
				$grabingAllSubModul = mysql_query("select * from ref_aplikasi where kode_aplikasi = '$idAplikasi' and kode_modul != '0' and kode_sub_modul !='0'");
			  while($rows = mysql_fetch_array($grabingAllSubModul)){
				  	foreach ($rows as $key => $value) {
				 	 	$$key = $value;
					}

					if(mysql_num_rows(mysql_query("select * from rincian_aplikasi_pemda where id_aplikasi_pemda= '$idPenggunaAplikasi' and id_pemda = '".$getIdAplikasi['id_pemda']."' and id_aplikasi = '$kode_aplikasi' and id_modul = '$kode_modul' and id_sub_modul = '$kode_sub_modul'")) != 0){
						$status = "checked";
					}else{
						$status = "";
					}
				    $data = array(
									'id_aplikasi_pemda' => $idPenggunaAplikasi,
									'id_pemda' => $getIdAplikasi['id_pemda'],
									'id_aplikasi' => $kode_aplikasi,
									'id_modul' => $kode_modul,
									'id_sub_modul' => $kode_sub_modul,
									'status' => $status,
									'username' => $this->username,
									);
					mysql_query(VulnWalkerInsert("temp_rincian_aplikasi_pemda",$data));
					$cek ="select * from rincian_aplikasi_pemda where id_aplikasi_pemda= '$idPenggunaAplikasi' and id_pemda = '".$getIdAplikasi['id_pemda']."' and id_aplikasi = '$kode_aplikasi' and id_modul = '$kode_modul' and id_sub_modul = '$kode_sub_modul'";
			  }

				$content = array('idAplikasi'=>$idAplikasi);
		break;
	    }



		case 'simpanPemda':{
				foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
				if(mysql_num_rows(mysql_query("select * from ref_pemda where nama_pemda = '$namaPemda'")) > 0){
					$err = "Pemda Sudah Ada";
				}else{
					$data = array('nama_pemda' => $namaPemda);
					mysql_query(VulnWalkerInsert('ref_pemda',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_pemda where nama_pemda = '$namaPemda'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_pemda from ref_pemda",'style="width:500;"','-- Pilih Pemda --') );
				}
		break;
		}


		case 'sendReward':{
				foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
				if(empty($jumlahHadiah)){
					$err = "Isi hadiah";
				}else{
						$event = "hadiah";
						$title = "Selamat anda dapat bonus";
						$body = '{"saldo":"'.$jumlahHadiah.'"}';

						$target = 'https://fcm.googleapis.com/fcm/send';
						$headers = array (
						'Authorization: key = AIzaSyBVJKrKRLW5m63RloYnFNu4fQDF9hbSdJQ',
						'Content-Type: application/json'
						);

						$arrayEmail = json_decode($listEmail);
						for ($i=0; $i < sizeof($arrayEmail) ; $i++) {
						$email = $arrayEmail[$i];

						$getTokenTarget = mysql_fetch_array(mysql_query("select * from member where email ='$email'"));
						$token = $getTokenTarget['firebase_id'];
						$arrayPush = json_encode(array('title'=> $title, 'body'=>$body, 'event'=> $event));
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
						mysql_query("update member set saldo = saldo + $jumlahHadiah where email = '$email'");
						$content.=$result." | ";
					}
				}


		break;
		}

		case 'simpanAplikasi':{
				foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
				if(mysql_num_rows(mysql_query("select * from ref_aplikasi where nama_pemda = '$namaAplikasi'")) > 0){
					$err = "Aplikasi Sudah Ada";
				}else{
					$data = array('nama_aplikasi' => $namaAplikasi);
					mysql_query(VulnWalkerInsert('ref_aplikasi',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_aplikasi where nama_aplikasi = '$namaAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_aplikasi from ref_aplikasi",'style="width:500;"','-- Pilih Aplikasi --') );
				}
		break;
		}

		case 'editPemda':{
				foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
				$data = array('nama_pemda' => $namaPemda);
				mysql_query(VulnWalkerUpdate("ref_pemda",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_pemda where nama_pemda = '$namaPemda'"));
				$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_pemda from ref_pemda",'style="width:500;"','-- Pilih Pemda --') );
		break;
		}
		case 'editAplikasi':{
				foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
				$data = array('nama_aplikasi' => $namaAplikasi);
				mysql_query(VulnWalkerUpdate("ref_aplikasi",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_aplikasi where nama_aplikasi = '$namaAplikasi'"));
				$content = array('replacer' => cmbQuery('cmbAplikasi',$idnya['id'],"select id,nama_aplikasi from ref_aplikasi",'style="width:500;"','-- Pilih Aplikasi --') );
		break;
		}




		case 'formBaru':{
			$fm = $this->setFormBaru();
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];
		break;
		}



		case 'formBaruPemda':{
				$idPemda = $_REQUEST['idPemda'];
				$fm = $this->setFormBaruPemda($idPemda);
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];
			break;
		}
		case 'formBaruAplikasi':{
				$idAplikasi = $_REQUEST['idAplikasi'];
				$fm = $this->setFormBaruAplikasi($idAplikasi);
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];
			break;
		}


		case 'formEdit':{
			$fm = $this->setFormEdit();
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];
		break;
		}
		case 'formReward':{
			foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}
			$email = $hadiah_cb;
			$fm = $this->reward($email);
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];
		break;
		}


		case 'simpan':{
			$get= $this->simpan();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }



		case 'simpanEdit':{
			$get= $this->simpanEdit();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
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

	 }//end switch

		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
   }




	 function setFormBaruPemda($idPemda){

		$this->form_fmST = 0;

		$fm = $this->BaruPemda($idPemda);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}

	 function setFormBaruAplikasi($idAplikasi){

		$this->form_fmST = 0;

		$fm = $this->BaruAplikasi($idAplikasi);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}




	function BaruPemda($dt){
	 global $SensusTmp, $Main;

	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_formKB';
	 $this->form_width = 500;
	 $this->form_height = 80;

	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Pemda';
		$kemana = "EditPemda($dt)";
		$namaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$dt'"));
		$namaPemda = $namaPemda['nama_pemda'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Pemda';
		$nip	 = '';
		$KA1 = $_REQUEST ['fmKA'];

		$kemana = 'SimpanPemda()';

	  }
	 }

	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);


	 //items ----------------------
	  $this->form_fields = array(

			'Kelompok' => array(
						'label'=>'Nama Pemda',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaPemda' id='namaPemda' value='$namaPemda' style='width:255px;' >

						</div>",
						 ),


			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".$kemana' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";

		$form = $this->genFormKB();
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}

	function BaruAplikasi($dt){
	 global $SensusTmp, $Main;

	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_formKB';
	 $this->form_width = 500;
	 $this->form_height = 80;

	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Aplikasi';
		$kemana = "EditAplikasi($dt)";
		$namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id='$dt'"));
		$namaAplikasi = $namaAplikasi['nama_aplikasi'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Aplikasi';
		$nip	 = '';


		$kemana = 'SimpanAplikasi()';

	  }
	 }

	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);


	 //items ----------------------
	  $this->form_fields = array(

			'Kelompok' => array(
						'label'=>'Nama Aplikasi',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaAplikasi' id='namaAplikasi' value='$namaAplikasi' style='width:255px;' >

						</div>",
						 ),


			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".$kemana' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";

		$form = $this->genFormKB();
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}

	function genFormKB($withForm=TRUE, $params=NULL, $center=TRUE){
		$form_name = $this->Prefix.'_KBform';

		if($withForm){
			$form= "<form name='$form_name' id='$form_name' method='post' action=''>".
				createDialog(
					$form_name.'_div',
					$this->setForm_content(),
					$this->form_width,
					$this->form_height,
					$this->form_caption,
					'',
					$this->form_menubawah.
					"<input type='hidden' id='".$this->Prefix."_idplh' name='".$this->Prefix."_idplh' value='$this->form_idplh' >
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params).
				"</form>";

		}else{
			$form=
				createDialog(
					$form_name.'_div',
					$this->setForm_content(),
					$this->form_width,
					$this->form_height,
					$this->form_caption,
					'',
					$this->form_menubawah.
					"<input type='hidden' id='".$this->Prefix."_idplh' name='".$this->Prefix."_idplh' value='$this->form_idplh' >
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params
				);
		}

		if($center){
			$form = centerPage( $form );
		}
		return $form;
	}


	function setPage_OtherScript(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) {
			  $$key = $value;
			}
		if($level != '1'){

			$scriptload =
					"<script>
						alert('Akses Ditolak');
						history.go(-1);
					</script>";

		}else{
			$scriptload =
					"<script>
						$(document).ready(function(){
							".$this->Prefix.".loading();
						});
					</script>";
		}
		return
			 "<script src='js/skpd.js' type='text/javascript'></script>
			 <script type='text/javascript' src='js/hadiah/hadiah.js' language='JavaScript' ></script>
			 <script type='text/javascript' src='js/ref_aplikasi_pemda/popupOption.js' language='JavaScript' ></script>

			 ".'<link rel="stylesheet" href="datepicker/jquery-ui.css">
			  <script src="datepicker/jquery-1.12.4.js"></script>
			  <script src="datepicker/jquery-ui.js"></script>'.

			$scriptload;
	}

	//form ==================================
	/*function setFormBaru(){
		$dt=array();
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		$dt['tgl'] = date("Y-m-d"); //set waktu sekarang
		$fm = $this->setForm($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}*/

	function setFormBaru(){
		//$cbid = $_REQUEST[$this->Prefix.'_cb'];
		//$c = $_REQUEST[$this->Prefix.'SkpdfmSKPD'];
		//$d = $_REQUEST[$this->Prefix.'SkpdfmUNIT'];
		//$e = $_REQUEST[$this->Prefix.'SkpdSUBUNIT'];
		$cek =$cbid[0];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 0;
		$dt['readonly']='';
		$fmBIDANG = $_REQUEST['fmBIDANG'];
		$fmKELOMPOK = $_REQUEST['fmKELOMPOK'];
		$fmSUBKELOMPOK = $_REQUEST['fmSUBKELOMPOK'];
		$fmSUBSUBKELOMPOK = $_REQUEST['fmSUBSUBKELOMPOK'];
		if(!empty($fmBIDANG) && empty($fmKELOMPOK) && empty($fmSUBKELOMPOK) && empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.';
		}
		elseif(!empty($fmBIDANG) && !empty($fmKELOMPOK) && empty($fmSUBKELOMPOK) && empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.'.$fmKELOMPOK.'.';
		}
		elseif(!empty($fmBIDANG) && !empty($fmKELOMPOK) && !empty($fmSUBKELOMPOK) && empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.'.$fmKELOMPOK.'.'.$fmSUBKELOMPOK.'.';
		}
		elseif(!empty($fmBIDANG) && !empty($fmKELOMPOK) && !empty($fmSUBKELOMPOK) && !empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.'.$fmKELOMPOK.'.'.$fmSUBKELOMPOK.'.'.$fmSUBSUBKELOMPOK.'.';
		}
		$fm = $this->setForm($dt);
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}

  	function setFormEdit(){
		$cek ='';

		foreach ($_REQUEST as $key => $value) {
			  $$key = $value;
			}
		$this->form_fmST = 1;

		$fm = $this->setForm($hadiah_cb[0]);

		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}

	function setFormEditdata($dt){
	 global $SensusTmp ,$Main;

	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';
	 $this->form_width = 490;
	 $this->form_height = 150;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'FORM EDIT KODE hadiah';
	  }

		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;
		$k=$kode[0];
		$l=$kode[1];
		$m=$kode[2];
		$n=$kode[3];
		$o=$kode[4];



		$queryKAedit=mysql_fetch_array(mysql_query("SELECT k, nm_hadiah FROM hadiah WHERE k='$k' and l = '0' and m='0' and n='00' and o='00'")) ;
		$cek.=$queryKAedit;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT l, nm_hadiah FROM hadiah WHERE k='$k' and l='$l' and m= '0' and n='00' and o='00'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT m, nm_hadiah FROM hadiah WHERE k='$k' and l='$l' and m='$m' and n='00' and o='00'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT n, nm_hadiah FROM hadiah WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='00'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT o, nm_hadiah FROM hadiah WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='$o'")) ;
	//	$cek.="SELECT ke, nm_account FROM ref_jurnal WHERE ka='$data_ka' and kb='$data_kb' and kc='$data_kc' and kd='$data_kd' and ke='$data_ke' and kf='0'";


		$datka=$queryKAedit['k'].".  ".$queryKAedit['nm_hadiah'];
		$datkb=$queryKBedit['l'].". ".$queryKBedit['nm_hadiah'];
		$datkc=$queryKCedit['m']." .  ".$queryKCedit['nm_hadiah'];
		$datkd=$queryKDedit['n'].". ".$queryKDedit['nm_hadiah'];
		$datke=$queryKEedit['o'];
	//	$datke=sprintf("%02s",$queryKEedit['ke'])." .  ".$queryKEedit['nm_account'];

       //items ----------------------
		  $this->form_fields = array(

		  'kode_Akun' => array(
						'label'=>'kode hadiah',
						'labelWidth'=>120,
						'value'=>"<div style='float:left;'>
						<input type='text' name='ek' id='ek' value='".$datka."' style='width:270px;' readonly>
						<input type ='hidden' name='k' id='k' value='".$queryKAedit['k']."'>
						</div>",
						 ),
			'kode_kelompok' => array(
						'label'=>'Kode Kelompok',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$datkb."' style='width:270px;' readonly>
						<input type ='hidden' name='l' id='l' value='".$queryKBedit['l']."'>
						</div>",
						 ),
			'kode_Jenis' => array(
						'label'=>'kode Jenis',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$datkc."' style='width:270px;' readonly>
						<input type ='hidden' name='m' id='m' value='".$queryKCedit['m']."'>
						</div>",
						 ),
			'kode_Objek' => array(
						'label'=>'kode Objek',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='en' id='en' value='".$datkd."' style='width:270px;' readonly>
						<input type ='hidden' name='n' id='n' value='".$queryKDedit['n']."'>
						</div>",
						 ),
			'Kode_Rincian_Objek' => array(
						'label'=>'Kode Rincian Objek',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='eo' id='eo' value='".$datke."' style='width:20px;' readonly>
						<input type ='hidden' name='o' id='o' value='".$queryKEedit['o']."'>
						<input type='text' name='nm_hadiah' id='nm_hadiah' value='".$dt['nm_hadiah']."' size='36px'>
						</div>",
						 ),



			/*'Nama' => array(
						'label'=>'Nama',
						//'id'=>'cont_object',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'><input type='text' name='nm_account' id='nm_account' value='".$dt['nm_account']."' size='40px'>
						</div>",
						 ),		*/
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
			"<input type='hidden' name='ka' id='ka' value='".$dt['ka']."'>".
			"<input type='hidden' name='kb' id='kb' value='".$dt['kb']."'>".
			"<input type='hidden' name='kc' id='kc' value='".$dt['kc']."'>".
			"<input type='hidden' name='kd' id='kd' value='".$dt['kd']."'>".
			"<input type='hidden' name='ke' id='ke' value='".$dt['ke']."'>".

		$form = $this->genForm();
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}

	function setForm($dt){
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';
	 $arrayStatus = array(
					 array('registered' , 'REGISTERED'),
					 array('suspend' , 'SUSPEND'),

				 );
				 $arrayVerif = array(
								 array('ok' , 'OK'),
								 array('belum' , 'BELUM'),

							 );
	$this->form_width = 400;
	 $this->form_height = 200;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';


	//	$nip	 = '';
	  }else{
		$this->form_caption = 'Edit';
		$readonly='readonly';
		$get = mysql_fetch_array(mysql_query("select * from hadiah where email ='$dt'"));
		foreach ($get as $key => $value) {
			  $$key = $value;
			}

	  }


		$cmbStatus = cmbArray('status',$status,$arrayStatus,'-- STATUS --','style="width:150;"');
		$cmbVerifikasi = cmbArray('verifikasi',$verifikasi,$arrayVerif,'-- VERIFIKASI --','style="width:150;"');
	 //items ----------------------
	  $this->form_fields = array(


			'email' => array(
						'label'=>'EMAIL',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='email' id='email' value='".$email."' placeholder='Email' style='width:250px;'>
						</div>",
						 ),
			'password' => array(
						 			'label'=>'PASSWORD',
						 			'labelWidth'=>100,
						 			'value'=>"<div style='float:left;'>
						 			<input type='text' name='password' id='password' value='".$password."' placeholder='password' style='width:250px;'>
						 			</div>",
						 			 ),
			'nama' => array(
						'label'=>'NAMA',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama_lengkap' id='nama_lengkap' value='".$nama_lengkap."' placeholder='NAMA' style='width:250px;'>
						</div>",
						 ),
			'no_telepon' => array(
						'label'=>'NOMOR TELEPON',
						'labelWidth'=>100,
						'value'=>"<div style='float:left;'>
						<input type='text' name='no_telepon' id='no_telepon' value='".$no_telepon."' placeholder='NOMOR TELEPON' style='width:250px;'>
						</div>",
						 ),
			 'saldo' => array(
				 					'label'=>'SALDO',
				 					'labelWidth'=>100,
				 					'value'=>"<div style='float:left;'>
				 					<input type='text' name='saldo' id='saldo' value='".$saldo."' placeholder='SALDO' style='width:250px;'>
				 					</div>",
				),
				// 'status' => array(
 			// 	 					'label'=>'STATUS',
 			// 	 					'labelWidth'=>100,
 			// 	 					'value'=>"<div style='float:left;'>
 			// 	 						$cmbStatus
 			// 	 					</div>",
 			// 	),
				'verifikasi' => array(
 				 					'label'=>'VERIFIKASI',
 				 					'labelWidth'=>100,
 				 					'value'=>"<div style='float:left;'>
 				 						$cmbVerifikasi
 				 					</div>",
 				),



			);
		//tombol
		$this->form_menubawah =

			"<input type='button' value='Simpan' onclick =".$this->Prefix.".Simpan('$dt') title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";

		$form = $this->genForm();
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}


	function reward($dt){
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';
	 $arrayStatus = array(
					 array('registered' , 'REGISTERED'),
					 array('suspend' , 'SUSPEND'),

				 );

	$this->form_width = 400;
	 $this->form_height = 100;

		$this->form_caption = 'Reward';
		$readonly='readonly';



		$cmbStatus = cmbArray('status',$status,$arrayStatus,'-- STATUS --','style="width:150;"');
		$cmbVerifikasi = cmbArray('verifikasi',$verifikasi,$arrayVerif,'-- VERIFIKASI --','style="width:150;"');
	 //items ----------------------
	  $this->form_fields = array(



				'jumlah hadiah' => array(
							'label'=>'REASON',
							'labelWidth'=>100,
							'value'=>"<div style='float:left;'>
							<input type='text' name='jumlahHadiah' id='jumlahHadiah'  placeholder='Reward' style='width:250px;'>
							<input type='hidden' name='listEmail' id='listEmail' readonly value='".json_encode($dt)."' placeholder='Email' style='width:250px;'>
							</div>",
							 ),




			);
		//tombol
		$this->form_menubawah =

			"<input type='button' value='Simpan' onclick =".$this->Prefix.".sendReward() title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";

		$form = $this->genForm();
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}

	/*function setPage_HeaderOther(){
	return
			"<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='margin:0 0 0 0'>
	<tr><td class=\"menudottedline\" width=\"40%\" height=\"20\" style='text-align:right'><B>
	<A href=\"pages.php?Pg=ref_skpd\" title='Skpd'  >Skpd</a> |
	<A href=\"pages.php?Pg=hadiah\" title='hadiah' style='color:blue'  >hadiah</a> |
	<A href=\"pages.php?Pg=ref_satuan\" title='Satuan'  >Satuan</a> |
	<A href=\"pages.php?Pg=ref_kepala_skpd\" title='Kepala Skpd'  >Kepala Skpd</a> |
	<A href=\"pages.php?Pg=ref_pengesahan\" title='Pengesahan'   >Pengesahan</a> |
	<A href=\"pages.php?Pg=ref_tapd\" title='Tapd'   >Tapd</a> |
	<A href=\"pages.php?Pg=ref_program\" title='Program & Kegiatan'   >Program & Kegiatan</a> |
	<A href=\"pages.php?Pg=ref_sumber_dana\" title='Sumber Dana'   >Sumber Dana</a> |

	</td></tr></table>";
	"<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='margin:0 0 0 0'>";

	}*/

	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
		$NomorColSpan = $Mode==1? 2: 1;
		$headerTable =
			"<thead>
				<tr>

				<th class='th01' width='40'>No.</th>
				$Checkbox
				<th class='th01' width=200>EMAIL</th>
				<th class='th01' >NAMA LENGKAP</th>
				<th class='th01' >NO TELEPON </th>
				<th class='th01' >SALDO </th>

				</tr>

			</thead>";
		return $headerTable;
	}

	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Ref;
		$Koloms = array();
		$Koloms[] = array('align=right', $no.'.' );
		if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
		$Koloms[] = array('', $isi['email']);
		$Koloms[] = array('', $isi['nama_lengkap']);
		$Koloms[] = array('', $isi['no_telepon']);
		$Koloms[] = array('align = "right"', number_format($isi['saldo'],0,',','.'));
		$this->totalSaldo += $isi['saldo'];


		return $Koloms;
	}

	function genDaftarOpsi(){
	 global $Ref, $Main;
	 foreach ($_REQUEST as $key => $value) {
				  $$key = $value;
				}




	$fmPILCARI = $_REQUEST['fmPILCARI'];
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
	//tgl bulan dan tahun
	$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];
	$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
	$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
	$fmORDER1 = cekPOST('fmORDER1');
	$fmDESC1 = cekPOST('fmDESC1');
	 $arrOrder = array(
							 array('orderEmail','Email'),
							array('orderNama','Nama Lengkap'),
							array('orderSaldo','Saldo'),
					);
	$arr = array(
			//array('selectAll','Semua'),
			array('findEmail','Email'),
			array('findNama','Nama Lengkap'),
			array('findNoTelepon','Nomor Telepon'),
			);
			if(empty($limitData))$limitData = "25";
	$TampilOpt =

			$vOrder=
			genFilterBar(
				array(
					cmbArray('fmPILCARI',$fmPILCARI,$arr,'-- Cari Data --',''). //generate checkbox
					"&nbsp&nbsp<input type='text' value='".$fmPILCARIvalue."' name='fmPILCARIvalue' id='fmPILCARIvalue'>&nbsp&nbsp"
					//<input type='button' id='btTampil' value='Cari' onclick='".$this->Prefix.".refreshList(true)'>"

					.cmbArray('fmORDER1',$fmORDER1,$arrOrder,'--Urutkan--','').
					"<input $fmDESC1 type='checkbox' id='fmDESC1' name='fmDESC1' value='checked'>&nbspmenurun.&nbsp Limit <input type='text' style='width:40;' name='limitData' id ='limitData' value = '$limitData'>"
					),
				$this->Prefix.".refreshList(true)");
			 " nbsp <input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>";

		return array('TampilOpt'=>$TampilOpt);
		return array('TampilOpt'=>$TampilOpt);
	}

	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID'];
		//kondisi -----------------------------------
		$arrKondisi = array();
		$fmPILCARI = $_REQUEST['fmPILCARI'];
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];

		/*$ref_skpdSkpdfmSEKSI = $_REQUEST['ref_skpdSkpdfmSEKSI'];//ref_skpdSkpdfmSKPD
		$ref_skpdSkpdfmSKPD = $_REQUEST['ref_skpdSkpdfmSKPD'];
		$ref_skpdSkpdfmUNIT = $_REQUEST['ref_skpdSkpdfmUNIT'];
		$ref_skpdSkpdfmSUBUNIT = $_REQUEST['ref_skpdSkpdfmSUBUNIT'];*/
		//Cari
		$isivalue=explode('.',$fmPILCARIvalue);
		switch($fmPILCARI){
			//case 'selectKode': $arrKondisi[] = " c='".$isivalue[0]."' and d='".$isivalue[1]."' and e='".$isivalue[2]."' and e1='".$isivalue[3]."'"; break;
			case 'findEmail': $arrKondisi[] = " email like '%$fmPILCARIvalue%'"; break;
			case 'findNama': $arrKondisi[] = " nama_lengkap like '%$fmPILCARIvalue%'"; break;
			case 'findNoTelepon': $arrKondisi[] = " no_telepon like '%$fmPILCARIvalue%'"; break;

		}

		$Kondisi= join(' and ',$arrKondisi);
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;

		//Order -------------------------------------
		$fmORDER1 =$_REQUEST['fmORDER1'];
		$fmDESC1 = cekPOST('fmDESC1');
		$Asc1 = $fmDESC1 ==''? '': 'desc';
		$arrOrders = array();
		// switch($fmORDER1){
		// 	case 'orderEmail': $arrOrders[] = " email $Asc1 " ;break;
		// 	case 'orderNama	': $arrOrders[] = " nama_lengkap $Asc1 " ;break;
		// 	case 'orderSaldo	': $arrOrders[] = " saldo $Asc1 " ;break;
		//
		// }
		if(!empty($fmORDER1)){
			if($fmORDER1 == "orderEmail"){
					$arrOrders[] = " email $Asc1 ";
			}elseif($fmORDER1 == "orderNama"){
					$arrOrders[] = " nama_lengkap $Asc1 ";
			}elseif($fmORDER1 == "orderSaldo"){
					$arrOrders[] = " saldo $Asc1 ";
			}

		}

		$Order= join(',',$arrOrders);
		$OrderDefault = '';// Order By no_terima desc ';
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		//$Order ="";
		//limit --------------------------------------
		/**$HalDefault=cekPOST($this->Prefix.'_hal',1);	//Cat:Settingan Lama
		$Limit = " limit ".(($HalDefault	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $Main->PagePerHal * (($HalDefault*1) - 1);
		$NoAwal = $Mode == 3 ? 0: $NoAwal;
		**/
		if(!empty($_REQUEST['limitData'])){
				$this->pagePerHal = $_REQUEST['limitData'];
		}
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal;
		$HalDefault=cekPOST($this->Prefix.'_hal',1);
		//$Limit = " limit ".(($HalDefault	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal; //$LimitHal = '';
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);
		$NoAwal = $Mode == 3 ? 0: $NoAwal;

		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);

	}
}
$hadiah = new hadiahObj();
$hadiah->username = $_COOKIE['coID'];
?>
