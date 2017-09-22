<?php

class hak_aksesObj  extends DaftarObj2{	
	var $Prefix = 'hak_akses';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'admin'; //bonus
	var $TblName_Hapus = 'admin';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //behak_aksesasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('uid');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//behak_aksesasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'HAK AKSES';
	var $PageIcon = 'images/masterdata_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='hak_akses.xls';
	var $namaModulCetak='PURCHASING Ohak_aksesER hak_akses';
	var $Cetak_Judul = 'DAFTAR hak_akses';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'hak_aksesForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'HAK AKSES';
	}
	
	function setMenuEdit(){
		return
		"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","new_f2.png","Baru",'Baru')."</td>".
		"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
		"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus').
		"</td>";
	}
	function setMenuView(){
		return "";
			
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

	 $nama_pimpinan_2 =  $_POST['nama_pimpinan'];
	 if( $err=='' && $namahak_akses =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_hak_akses (c1,c,d,nama_hak_akses,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namahak_akses','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_hak_akses (c1,c,d,nama_hak_akses,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namahak_akses','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_hak_akses set  nama_hak_akses ='$namahak_akses', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
						$qry = mysql_query($aqry) or die(mysql_error());		
					}
			} //end else
					
			return	array ('cek'=>$aqry, 'err'=>$err, 'content'=>$content);	
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
			
		case 'formBaru':{				
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formEdit':{	
			$dt = $_REQUEST['hak_akses_cb'];			
			$fm = $this->setFormEdit($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'checkhak_akses':{	
					
			$dt = $_REQUEST['hak_akses_cb'];	
			$fm = $this->checkhak_akses($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['hak_akses_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showKoreksihak_akses':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->showKoreksihak_akses($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showKoreksiPemda':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->showKoreksiPemda($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'saveCheck':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($tanggal_cek)){
				$err = "Isi Tanggal Check";
			}elseif(empty($url_install)){
				$err = "Isi URL Install";
			}elseif(empty($uraian_cek)){
				$err = "Isi Uraian Check";
			}elseif(empty($cmbCheck)){
				$err = "Pilih Status Check";
			}else{
				 $tanggal_cek = explode('-',$tanggal_cek);
				 $tanggal_cek = $tanggal_cek[2]."-".$tanggal_cek[1]."-".$tanggal_cek[0];
				$grabSpekData = mysql_fetch_array(mysql_query("select * from rincian_pekerjaan where id = '$idSpek'"));
				
				$data = array(	'tanggal_cek' => $tanggal_cek,
								'id_po' => $grabSpekData['id_parent'],
								'id_rincian_pekerjaan' => $idSpek,
								'url_install' => $url_install,
								'uraian_cek' => $uraian_cek,
								'status_cek' => $cmbCheck,
								'hasil_koreksi' => $hasil_koreksi,
								'keterangan' => $keterangan,
				);
				
				if(mysql_num_rows(mysql_query("select * from cek_hak_akses where id_rincian_pekerjaan = '$idSpek'")) == 0){
					mysql_query(VulnWalkerInsert('cek_hak_akses',$data));
				}else{
					mysql_query(VulnWalkerUpdate('cek_hak_akses',$data,"id_rincian_pekerjaan = '$idSpek'"));
				}
				
				
			}
		break;
	    }
		
		case 'saveUser':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($uid)){
				$err = "Isi Username";
			}elseif(empty($password)){
				$err = "Isi Password";
			}elseif(empty($nama)){
				$err = "Isi Nama";
			}else{
				$data = array(
								'uid' => $uid,
								'nama' => $nama,
								'password' => md5($password),
								'level' => $level,
								'produksi' => $produksi,
								'po' => $po,
								'administrasi' => $administrasi,
								'rd' => $rd,
								'mt' => $mt,
								'pemda' => $pemda,
								'status' => $status
							);
				$query = mysql_query(VulnWalkerInsert("admin",$data));
				if(!$query){
					$err = "Gagal Simpan";
				}
				
			}
		break;
	    }
		
		
		case 'editUser':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($password)){
				$err = "Isi Password";
			}elseif(empty($nama)){
				$err = "Isi Nama";
			}else{	
				//$getPass = mysql_fetch_array(mysql_query("select * from admin where uid = '$this->username'"));
				if(strlen($password) == 32){
					$data = array(
								'nama' => $nama,
								'password' => $password,
								'level' => $level,
								'produksi' => $produksi,
								'po' => $po,
								'administrasi' => $administrasi,
								'rd' => $rd,
								'mt' => $mt,
								'pemda' => $pemda,
								'status' => $status
							);
					$st = "1";
				}else{
					$data = array(
								'nama' => $nama,
								'password' => md5($password),
								'level' => $level,
								'produksi' => $produksi,
								'po' => $po,
								'administrasi' => $administrasi,
								'rd' => $rd,
								'mt' => $mt,
								'pemda' => $pemda,
								'status' => $status
							);
					$st = "2";
				}                                                                                            
				
				mysql_query(VulnWalkerUpdate("admin",$data,"uid = '$username'"));
				$cek = VulnWalkerUpdate("admin",$data,"uid = '$username'");
				$content = array("st" => $st);
			}
		break;
	    }
					
		case 'simpan':{
			$get= $this->simpan();
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
			"
			<script type='text/javascript' src='js/hak_akses/".$this->Prefix.".js' language='JavaScript' ></script>
			".'<link rel="stylesheet" href="datepicker/jquery-ui.css">
			  <script src="datepicker/jquery-1.12.4.js"></script>
			  <script src="datepicker/jquery-ui.js"></script>'.
			$scriptload;
	}
	
	//form ==================================
	function setFormBaru(){

		//$this->form_idplh ='';
		$this->form_fmST = 0;
		 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 300;
	 $this->form_caption = 'BARU';	



	 $this->form_fields = array(
	 		'uid' => array( 
						'label'=>'UID',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='uid'  id='uid' value='".$uid."'  style='width:150px;text-align:left;'>
						</div>", 
						 ),
			'nama' => array( 
						'label'=>'NAMA',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama'  id='nama' value='".$nama."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'password' => array( 
						'label'=>'PASSWORD',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='password'  id='password' value='".$password."'  style='width:150px;text-align:left;'>
						</div>", 
						 ),
			'level' => array( 
						'label'=>'LEVEL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='level' value='1' checked> Administrator
							<input type='radio' name='level' value='2'>	Operator
						</div>", 
						 ),
			'produksi' => array( 
						'label'=>'PRODUKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='produksi' value='0' checked> Disabled
							<input type='radio' name='produksi' value='1' > Write
							<input type='radio' name='produksi' value='2'> Read
						</div>", 
						 ),
	 		'po' => array( 
						'label'=>'PO',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='po' value='0' checked> Disabled
							<input type='radio' name='po' value='1' > Write
							<input type='radio' name='po' value='2'> Read
						</div>", 
						 ),
			'admin' => array( 
						'label'=>'ADMINISTRASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='administrasi' value='0' checked> Disabled
							<input type='radio' name='administrasi' value='1' > Write
							<input type='radio' name='administrasi' value='2'> Read
						</div>", 
						 ),
			'rd' => array( 
						'label'=>'R/D',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='rd' value='0' checked> Disabled
							<input type='radio' name='rd' value='1' > Write
							<input type='radio' name='rd' value='2'> Read
						</div>", 
						 ),
			'mt' => array( 
						'label'=>'R/D',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='mt' value='0' checked> Disabled
							<input type='radio' name='mt' value='1' > Write
							<input type='radio' name='mt' value='2'> Read
						</div>", 
						 ),
			'pemda' => array( 
						'label'=>'PEMDA',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='pemda' value='0' checked> Disabled
							<input type='radio' name='pemda' value='1' > Write
							<input type='radio' name='pemda' value='2'> Read
						</div>", 
						 ),
			'stKorek' => array( 
						'label'=>'STATUS USER',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='status' value='0' checked > Disabled / Blocked
							<input type='radio' name='status' value='1'> Aktif
						</div>", 
						 ),
				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".saveUser()' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
   
  	function setFormEdit($dt){
	global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
			 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 300;
	 $this->form_caption = 'EDIT';	
	 
	 $got = mysql_fetch_array(mysql_query("select * from admin where uid = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 if($level = '1'){
	 	$levelAdmin = "checked";
	 }else{
	 	$levelOperator = "checked";
	 }
	 if($po == '0'){
	 	$poDisabled = 'checked';
	 }elseif($po == '1'){
	 	$poWrite = 'checked';
	 }elseif($po == '2'){
	 	$poRead = 'checked';
	 }
	 
	 if($administrasi == '0'){
	 	$adminDisabled = 'checked';
	 }elseif($administrasi == '1'){
	 	$adminWrite = 'checked';
	 }elseif($administrasi == '2'){
	 	$adminRead = 'checked';
	 }
	 
	 if($rd == '0'){
	 	$rdDisabled = 'checked';
	 }elseif($rd == '1'){
	 	$rdWrite = 'checked';
	 }elseif($rd == '2'){
	 	$rdRead = 'checked';
	 }
	 
	 if($mt == '0'){
	 	$mtDisabled = 'checked';
	 }elseif($mt == '1'){
	 	$mtWrite = 'checked';
	 }elseif($mt == '2'){
	 	$mtRead = 'checked';
	 }
	 
	 if($pemda == '0'){
	 	$pemdaDisabled = 'checked';
	 }elseif($pemda == '1'){
	 	$pemdaWrite = 'checked';
	 }elseif($pemda == '2'){
	 	$pemdaRead = 'checked';
	 }
	 
	 if($pemda == '0'){
	 	$pemdaDisabled = 'checked';
	 }elseif($pemda == '1'){
	 	$pemdaWrite = 'checked';
	 }elseif($pemda == '2'){
	 	$pemdaRead = 'checked';
	 }
	 
	 if($status == '0'){
	 	$statusDisabled = 'checked';
	 }elseif($status == '1'){
	 	$statusWrite = 'checked';
	 }



	 $this->form_fields = array(
	 		'uid' => array( 
						'label'=>'UID',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='uid'  id='uid' value='".$uid."'  readOnly style='width:150px;text-align:left;'>
						</div>", 
						 ),
			'nama' => array( 
						'label'=>'NAMA',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama'  id='nama' value='".$nama."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'password' => array( 
						'label'=>'PASSWORD',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='password'  id='password' value='".$password."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'level' => array( 
						'label'=>'LEVEL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='level' value='1' $levelAdmin > Administrator
							<input type='radio' name='level' value='2' $levelOperator > Operator
						</div>", 
						 ),
			'produksi' => array( 
						'label'=>'PRODUKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='produksi' value='0' checked> Disabled
							<input type='radio' name='produksi' value='1' > Write
							<input type='radio' name='produksi' value='2'> Read
						</div>", 
						 ),
	 		'po' => array( 
						'label'=>'PO',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='po' value='0' $poDisabled> Disabled
							<input type='radio' name='po' value='1' $poWrite> Write
							<input type='radio' name='po' value='2' $poRead> Read
						</div>", 
						 ),
			'admin' => array( 
						'label'=>'ADMINISTRASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='administrasi' value='0' $adminDisabled > Disabled
							<input type='radio' name='administrasi' value='1' $adminWrite> Write
							<input type='radio' name='administrasi' value='2' $adminRead> Read
						</div>", 
						 ),
			'rd' => array( 
						'label'=>'R/D',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='rd' value='0' $rdDisabled> Disabled
							<input type='radio' name='rd' value='1' $rdWrite> Write
							<input type='radio' name='rd' value='2' $rdRead> Read
						</div>", 
						 ),
			'mt' => array( 
						'label'=>'R/D',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='mt' value='0' $rdDisabled> Disabled
							<input type='radio' name='mt' value='1' $rdWrite> Write
							<input type='radio' name='mt' value='2' $rdRead> Read
						</div>", 
						 ),
			'pemda' => array( 
						'label'=>'PEMDA',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='pemda' value='0' $pemdaDisabled > Disabled
							<input type='radio' name='pemda' value='1' $pemdaWrite> Write
							<input type='radio' name='pemda' value='2' $pemdaRead> Read
						</div>", 
						 ),
			'stKorek' => array( 
						'label'=>'STATUS USER',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='status' value='0'  $statusDisabled> Disabled / Blocked
							<input type='radio' name='status' value='1' $statusWrite > Aktif
						</div>", 
						 ),
				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick =".$this->Prefix.".editUser('".$dt."') title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
	function checkhak_akses($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 350;
	 $this->form_caption = 'CHECK MAINTENCE';	
	
	
	 $got = mysql_fetch_array(mysql_query("select * from cek_hak_akses where id_rincian_pekerjaan = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal = explode('-',$tanggal);
	 $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	 $arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
	 $cmbCheck = cmbArray('cmbCheck',$status_cek,$arrayStatus,'-- STATUS CHECK --','style="width:200;"');
	 
	 $getDataRD = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$dt'"));
	 if(empty($getDataRD['koreksi_hak_akses']) || $getDataRD['koreksi_hak_akses'] == ' '){
	 	$statusKoreksi = "TIDAK";
	 }else{
	 	$statusKoreksi = "YA";
		$koreksihak_akses = $getDataRD['koreksi_hak_akses'];
	 }

	 $this->form_fields = array(
	 		'progres' => array( 
						'label'=>'TANGGAL CEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggal_cek' class='datepicker' id='tanggal_cek' value='".$tanggal_cek."' placeholder='TANGGAL CHECK' style='width:150px;text-align:left;'>
						</div>", 
						 ),
			'staff' => array( 
						'label'=>'URL INSTALL',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							<input type='text' name='url_install' id='url_install' value='".$url_install."' placeholder='URL INSTALL' style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'uraianCheck' => array( 
						'label'=>'URAIAN CHECK',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<textarea  name='uraian_cek'  id='uraian_cek'  placeholder='URAIAN CHECK' style='width:300px;'>$uraian_cek</textarea>
						</div>" 
						 ),	
	 		'check' => array( 
						'label'=>'STATUS CHECK',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbCheck
						</div>", 
						 ),
			'stKorek' => array( 
						'label'=>'STATUS KOREKSI',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$statusKoreksi
						</div>", 
						 ),
			'koreksihak_akses' => array( 
						'label'=>'KOREKSI hak_akses',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$koreksihak_akses
						</div>", 
						 ),
	 		'hasilKoreksi' => array( 
						'label'=>'HASIL KOREKSI',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<textarea  name='hasil_koreksi'  id='hasil_koreksi'  placeholder='HASIL KOREKSI' style='width:300px;'>$hasil_koreksi</textarea>
						</div>" 
						 ),	
					 	
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<textarea  name='keterangan'  id='keterangan'  placeholder='KETERANGAN' style='width:300px;'>$keterangan</textarea>
						</div>" 
						 ),	
					 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".saveCheck($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' rowspan='2' >No.</th>
  	   $Checkbox	
  	   <th class='th01' width='150'>ID PENGGUNA</th>	
	   <th class='th01' width='200'>NAMA LENGKAP</th>	
	   <th class='th01' width='100'>LEVEL</th>	
	   <th class='th01' width='200'>PO</th>	
	   <th class='th01' width='200'>ADMINISTRASI</th>	
	   <th class='th01' width='200'>R/D</th>	
	   <th class='th01' width='200'>MAINTENANCE</th>	
	   <th class='th01' width='200'>PEMDA</th>	
	   <th class='th01' width='200'>PRODUKSI</th>	

	   <th class='th01' width='100'>STATUS</th>	

	
	   </tr>
	   	 	

	   </thead>";
	 
		return $headerTable;
	}
	
	function infoSpesifikasi($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 140;
	 $this->form_caption = 'INFO SPESIFIKASI';	

	 $got = mysql_fetch_array(mysql_query("select * from aplikasi where id ='$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $namaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$id_pemda'"));
	 $namaPemda = $namaPemda['nama_pemda'];
	 
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id = '$id_aplikasi'"));
	 $namaAplikasi = $namaAplikasi['nama_aplikasi'];
	 
	 $namaKategori = mysql_fetch_array(mysql_query("select * from ref_kategori where id = '$id_kategori'"));
	 $namaKategori = $namaKategori['nama'];
	 
	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'NOMOR PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						$dt
						</div>", 
						 ),
	 		'tgl_update' => array( 
						'label'=>'TANGGAL PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						".VulnWalkerTitimangsa($tanggal_po)."
						</div>", 
						 ),
	 		'pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						$namaPemda
						</div>", ),	
			'apl' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						$namaAplikasi
						</div>"
						),	
			'kategori' => array( 
						'label'=>'KATEGORI',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						$namaKategori
						</div>",),	
			
			
			'kegiatan' => array( 
						'label'=>'NAMA KEGIATAN / PEKERJAAN',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						$nama_kegiatan
						</div>",),	
			'nilai' => array( 
						'label'=>'NILAI (Rp)',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<span id='bantuNilai' style='color:red;'>Rp. ".number_format($nilai,2,',','.')."</span>
						</div>" 
						 ),	
			'targetSelesai' => array( 
						'label'=>"<span id='tergantung'>TARGET SELESAI</span>",
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						 ".VulnWalkerTitimangsa($target_selesai)."
						</div>",),	
			'rincianPekerjaan' => array( 
						'label'=>'',
						'value'=> $this->tabelRincianPekerjaan($dt), 
						'type'=>'merge'
					 ),		 	
				
			
			);
		//tombol
		$this->form_menubawah =

			"<input type='button' value='Tutup' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm2();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	
	function showKoreksihak_akses($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 140;
	 $this->form_caption = 'KOREKSI MAINTENCE';	
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$dt'"));

	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						".$getKoreksi['koreksi_hak_akses']."
						</div>", 
						 ),
	 		
 	
				
			
			);
		//tombol
		$this->form_menubawah =

			"<input type='button' value='Tutup' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	
	function showKoreksiPemda($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 140;
	 $this->form_caption = 'KOREKSI PEMDA';	
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_hak_akses where id_rincian_pekerjaan = '$dt'"));

	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						".$getKoreksi['koreksi_pemda']."
						</div>", 
						 ),
	 		
 	
				
			
			);
		//tombol
		$this->form_menubawah =

			"<input type='button' value='Tutup' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	
	function tabelRincianPekerjaan($nomor_po){
				$header = "<tr>
								<th class='th01' width='20'>NO</th>
								<th class='th01' width='200'>MODUL</th>
								<th class='th01' width='600'>SPESIFIKASI</th>
								<th class='th01' width='400'>KETERANGAN</th>	
							
						</tr>";
						
						
				//getDaftar
				$arrKondisi = array();
				$grabingAll = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po'");
				while($wor = mysql_fetch_array($grabingAll)){
					foreach ($wor as $key => $value) { 
					  $$key = $value; 
					}
					if(empty($keterangan)){
						if(mysql_num_rows(mysql_query("select * from rincian_pekerjaan where id_parent = '$nomor_po' and id_parent='$nomor_po' and keterangan !='' and id_modul ='$id_modul'")) == 0){
						}else{
							$arrKondisi[] = " id != '$id' ";
						}
					}
				}
				if(sizeof($arrKondisi) == 0){
					
				}else{
					$kondisi= join(' and ',$arrKondisi);
					$kondisi = " and ".$kondisi;
				}
				
				//getDaftar
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi ohak_akseser by id_modul,spesifikasi,keterangan");
				$no = 1 ;
				while($rows = mysql_fetch_array($query)){
					foreach ($rows as $key => $value) { 
					  $$key = $value; 
					}
					if($no % 2 != 0){
						$tergantung = "row1";
					}else{
						$tergantung = "row0";
					}
					$namaModul = mysql_fetch_array(mysql_query("select* from ref_modul where id ='$id_modul'"));
					$namaModul = $namaModul['nama_modul'];
					if($lastNamaModul == $namaModul){
						$namaModul = "";
					}
					$action  = "<img src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";
					
					if($keterangan == ''){
						$action = "";
					}
					
					$isi =  "	
							<tr class='$tergantung'>
								<td align='center'>$no.</td>
								<td>$namaModul</td>
								<td>$spesifikasi</td>
								<td>$keterangan</td>
			   				</tr>
				
					";
					$lastNamaModul = $namaModul;					
					$data .= $isi;
					$no += 1;
				}	
		
		$content2 = 
					"
					
					RINCIAN PEKERJAAN :
					<table class='koptable' style='width:100%;' bohak_akseser='1' id='tabelRincianPekerjaan'>
						$header
						$data
					</table>
					"
				
				;
		return $content2;
	}
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 global $Ref;
	 foreach ($isi as $key => $value) { 
			  $$key = $value; 
			}
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	 
	 $getPO = mysql_fetch_array(mysql_query("select * from aplikasi where id='$id_parent'"));
	 foreach ($getPO as $key => $value) { 
			  $$key = $value; 
			}
		
	 
	 
	 
	 if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
		
	 if($level == '1'){
	 	$level = "Adminisrator";
	 }elseif($level == '2'){
	 	$level = "OPERATOR";
	 }
	 
	 
	 if($po == '0'){
	 	$statusPO = "DISABLED";
	 }elseif($po == '1'){
	 	$statusPO = "WRITE";
	 }elseif($po == '2'){
	 	$statusPO = "READ";
	 }
	 
	 if($administrasi == '0'){
	 	$statusAdministrasi = "DISABLED";
	 }elseif($administrasi == '1'){
	 	$statusAdministrasi = "WRITE";
	 }elseif($administrasi == '2'){
	 	$statusAdministrasi = "READ";
	 }
	 
	 if($rd == '0'){
	 	$statusRD = "DISABLED";
	 }elseif($rd == '1'){
	 	$statusRD = "WRITE";
	 }elseif($rd == '2'){
	 	$statusRD = "READ";
	 }
	 
	 if($mt == '0'){
	 	$statusMT = "DISABLED";
	 }elseif($mt == '1'){
	 	$statusMT = "WRITE";
	 }elseif($mt == '2'){
	 	$statusMT = "READ";
	 }
	 
	 if($pemda == '0'){
	 	$statusPemda = "DISABLED";
	 }elseif($pemda == '1'){
	 	$statusPemda = "WRITE";
	 }elseif($pemda == '2'){
	 	$statusPemda = "READ";
	 }
	  if($produksi == '0'){
	 	$produksi = "DISABLED";
	 }elseif($produksi == '1'){
	 	$produksi = "WRITE";
	 }elseif($produksi == '2'){
	 	$produksi = "READ";
	 }
	 
	 if($status == '0'){
	 	$statusstatus = "DISABLED";
	 }elseif($status == '1'){
	 	$statusstatus = "ACTIVE";
	 }
	 
	 $Koloms[] = array('align="left"',$uid);
	 $Koloms[] = array('align="left"',$nama);
	 $Koloms[] = array('align="left"',$level);
	 $Koloms[] = array('align="center"',$statusPO);
	 $Koloms[] = array('align="center"',$statusAdministrasi);
	 $Koloms[] = array('align="center"',$statusRD);
	 $Koloms[] = array('align="center"',$statusMT);
	 $Koloms[] = array('align="center"',$statusPemda);
	 $Koloms[] = array('align="center"',$produksi);
	 $Koloms[] = array('align="center"',$statusstatus);


	 
	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd, $fmSKPDUrusan;
	 $fmSKPDBidang = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST('fmSKPDBidang');
	 $fmSKPDskpd = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST('fmSKPDskpd');
	$fhak_aksesahun=  cekPOST('fhak_aksesahun')==''?$_COOKIE['coThnAnggaran']:cekPOST('fhak_aksesahun');
	$fmBIDANG = cekPOST('fmBIDANG');


	 $arr = array(
			//array('selectAll','Semua'),	
			array('nama_hak_akses','NAMA hak_akses'),		
			array('alamat','ALAMAT'),	
			array('kota','KOTA / KABUPATEN'),
			array('nama_pimpinan','NAMA PIMPINAN'),
			array('no_npwp','NO. NPWP'),			
			);
		
	 //data ohak_akseser ------------------------------
	 $arrOhak_akseser = array(
			     	array('1','NAMA hak_akses'),		
					array('2','ALAMAT'),	
					array('3','KOTA / KABUPATEN'),
					array('4','NAMA PIMPINAN'),
					array('5','NO. NPWP'),	
					);
	 
	$fmPILCARI = $_REQUEST['fmPILCARI'];	
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];		
	//tgl bulan dan tahun
	$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];
	$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
	$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
	$fmOhak_aksesER1 = cekPOST('fmOhak_aksesER1');
	$fmDESC1 = cekPOST('fmDESC1');
	$baris = $_REQUEST['baris'];
	if ($baris == ''){
		$baris = "25";		
	}
	$TampilOpt = 
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td><input type='button' value ='Tampilkan' onclick =$this->Prefix.refreshList(true);> </td>
			</tr>
			<tr>

			
			
			
			
			
			</table>".
			"</div>";
			
		return array('TampilOpt'=>$TampilOpt);
	}			
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 

		//kondisi -----------------------------------
				
		$arrKondisi = array();		
		
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Ohak_akseser -------------------------------------
		$fmOhak_aksesER1 = cekPOST('fmOhak_aksesER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOhak_aksesers = array();
		$arrOhak_aksesers[] = "id_modul,spesifikasi,keterangan";
/*		switch($fmOhak_aksesER1){
			case '1': $arrOhak_aksesers[] = " nama_hak_akses $Asc1 " ;break;
			case '2': $arrOhak_aksesers[] = " alamat $Asc1 " ;break;
			case '3': $arrOhak_aksesers[] = " kota $Asc1 " ;break;
			case '4': $arrOhak_aksesers[] = " nama_pimpinan $Asc1 " ;break;
			case '5': $arrOhak_aksesers[] = " no_npwp $Asc1 " ;break;
			case '6': $arrOhak_aksesers[] = " c $Asc1 " ;break;
		}	*/
		
		$Ohak_akseser= join(',',$arrOhak_aksesers);	
		$Ohak_aksesehak_aksesefault = '';// Ohak_akseser By no_terima desc ';
		$Ohak_akseser =  $Ohak_akseser ==''? $Ohak_aksesehak_aksesefault : ' Ohak_akseser By '.$Ohak_akseser;
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		//$Limit = " limit ".(($HalDefault	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal; //$LimitHal = '';
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	
		
		return array('Kondisi'=>$Kondisi, 'Ohak_akseser'=>$Ohak_akseser ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
	}
	
	function genForm2($withForm=TRUE){	
		$form_name = $this->Prefix.'_form';	
				
		if($withForm){
			$params->tipe=1;
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >"
					,//$this->setForm_menubawah_content(),
					$this->form_menu_bawah_height,
					'',$params
					).
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >"
					,//$this->setForm_menubawah_content(),
					$this->form_menu_bawah_height
				);
			
			
		}
		return $form;
	}	
	



	function Hapus($ids){ //validasi hapus ref_kota
		 $err=''; $cek='';
		for($i = 0; $i<count($ids); $i++)	{
		

			if($err=='' ){
					$qy = "DELETE FROM $this->TblName_Hapus WHERE uid='".$ids[$i]."' ";$cek.=$qy;
					$qry = mysql_query($qy);
						
			}else{
				break;
			}			
		}
		return array('err'=>$err,'cek'=>$cek);
	}
}
$hak_akses = new hak_aksesObj();
$hak_akses->username = $_COOKIE['coID'];
?>