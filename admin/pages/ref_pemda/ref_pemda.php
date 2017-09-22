<?php

class ref_pemdaObj  extends DaftarObj2{	
	var $Prefix = 'ref_pemda';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_pemda'; //bonus
	var $TblName_Hapus = 'ref_pemda';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //beref_pemdaasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//beref_pemdaasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'REFERENSI PEMDA';
	var $PageIcon = 'images/masterdata_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='ref_pemda.xls';
	var $namaModulCetak='PURCHASING Oref_pemdaER ref_pemda';
	var $Cetak_Judul = 'DAFTAR ref_pemda';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'ref_pemdaForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'REFERENSI PEMDA';
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
	 if( $err=='' && $namaref_pemda =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_ref_pemda (c1,c,d,nama_ref_pemda,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namaref_pemda','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_ref_pemda (c1,c,d,nama_ref_pemda,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namaref_pemda','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_ref_pemda set  nama_ref_pemda ='$namaref_pemda', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
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
			$dt = $_REQUEST['ref_pemda_cb'];			
			$fm = $this->setFormEdit($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'checkref_pemda':{	
					
			$dt = $_REQUEST['ref_pemda_cb'];	
			$fm = $this->checkref_pemda($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['ref_pemda_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showKoreksiref_pemda':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->showKoreksiref_pemda($dt);				
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
				
				if(mysql_num_rows(mysql_query("select * from cek_ref_pemda where id_rincian_pekerjaan = '$idSpek'")) == 0){
					mysql_query(VulnWalkerInsert('cek_ref_pemda',$data));
				}else{
					mysql_query(VulnWalkerUpdate('cek_ref_pemda',$data,"id_rincian_pekerjaan = '$idSpek'"));
				}
				
				
			}
		break;
	    }
		
		case 'savePemda':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($provinsi)){
				$err = "Isi Kode";
			}elseif($kota == ''){
				$err = "Isi Kode";
			}elseif(empty($nama)){
				$err = "Isi Nama Pemda";
			}else{
				$data = array(
								'provinsi' => $provinsi,
								'kota' => $kota,
								'nama_pemda' => $nama,
								'nama_kontak' => $nama_kontak,
								'nomor_kontak' => $nomor_kontak,
								'status' => $status
							);
				
				$query = VulnWalkerInsert("ref_pemda",$data);
				if($kota != '0' && mysql_num_rows(mysql_query("select *  from ref_pemda where provinsi = '$provinsi' and kota = '0'")) == 0){
					$err = "Provinsi Belum Ada, silakan isi kode ke dua dengan angka 0";
				}else{
					if(mysql_num_rows(mysql_query("select * from ref_pemda where provinsi = '$provinsi' and kota  ='$kota' ")) == 0){
						mysql_query($query);
					}else{
						$err = "Data Sudah Ada";
					}
					
				}
				$cek = $query;
				
			}
		break;
	    }
		
		
		case 'editPemda':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($provinsi)){
				$err = "Isi Kode";
			}elseif($kota == ''){
				$err = "Isi Kode";
			}elseif(empty($nama)){
				$err = "Isi Nama Pemda";
			}else{
				$data = array(
								'provinsi' => $provinsi,
								'kota' => $kota,
								'nama_pemda' => $nama,
								'nama_kontak' => $nama_kontak,
								'nomor_kontak' => $nomor_kontak,
								'status' => $status
							);
				
				$query = VulnWalkerUpdate("ref_pemda",$data,"id = '$username'");
				if($kota != '0' && mysql_num_rows(mysql_query("select *  from ref_pemda where provinsi = '$provinsi' and kota = '0'")) == 0){
					$err = "Provinsi Belum Ada, silakan isi kode ke dua dengan angka 0";
				}else{
					mysql_query($query);
				}
				$cek = $query;
				
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
			<script type='text/javascript' src='js/ref_pemda/".$this->Prefix.".js' language='JavaScript' ></script>
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
	 			
	 $this->form_width = 500;
	 $this->form_height = 150;
	 $this->form_caption = 'BARU';	



	 $this->form_fields = array(
	 		'kode' => array( 
						'label'=>'KODE',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='provinsi'  id='provinsi' value='".$provinsi."'  style='width:50px;text-align:left;'> &nbsp
						<input type='text' name='kota'  id='kota' value='".$kota."'  style='width:50px;text-align:left;'> &nbsp <span style='color:red;'>*1.1</span>
						</div>", 
						 ),
			'nama' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama'  id='nama' value='".$nama."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'2' => array( 
						'label'=>'KONTAK PERSON',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama_kontak'  id='nama_kontak' value='".$nama_kontak."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'na3ma' => array( 
						'label'=>'NOMOR TELEPON',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nomor_kontak'  id='nomor_kontak' value='".$nomor_kontak."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			
			'stKorek' => array( 
						'label'=>'STATUS',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='status' value='0' checked > Belum
							<input type='radio' name='status' value='1'> Sudah
						</div>", 
						 ),
				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".savePemda()' title='Simpan' > &nbsp".
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
	 			
	 $this->form_width = 500;
	 $this->form_height = 150;
	 $this->form_caption = 'EDIT';	
	 
	 $got = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}

	 if($status == '0'){
	 	$statusDisabled = 'checked';
	 }elseif($status == '1'){
	 	$statusWrite = 'checked';
	 }



	$this->form_fields = array(
	 		'kode' => array( 
						'label'=>'KODE',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='provinsi'  id='provinsi' value='".$provinsi."'  style='width:50px;text-align:left;'> &nbsp
						<input type='text' name='kota'  id='kota' value='".$kota."'  style='width:50px;text-align:left;'> &nbsp <span style='color:red;'>*1.1</span>
						</div>", 
						 ),
			'nama' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama'  id='nama' value='".$nama_pemda."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'2' => array( 
						'label'=>'KONTAK PERSON',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nama_kontak'  id='nama_kontak' value='".$nama_kontak."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			'na3ma' => array( 
						'label'=>'NOMOR TELEPON',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nomor_kontak'  id='nomor_kontak' value='".$nomor_kontak."'  style='width:300px;text-align:left;'>
						</div>", 
						 ),
			
			'stKorek' => array( 
						'label'=>'STATUS',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							<input type='radio' name='status' value='0' $statusDisabled > Belum
							<input type='radio' name='status' value='1' $statusWrite> Sudah
						</div>", 
						 ),
				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick =".$this->Prefix.".editPemda('".$dt."') title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
	function checkref_pemda($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 350;
	 $this->form_caption = 'CHECK MAINTENCE';	
	
	
	 $got = mysql_fetch_array(mysql_query("select * from cek_ref_pemda where id_rincian_pekerjaan = '$dt'"));
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
	 if(empty($getDataRD['koreksi_ref_pemda']) || $getDataRD['koreksi_ref_pemda'] == ' '){
	 	$statusKoreksi = "TIDAK";
	 }else{
	 	$statusKoreksi = "YA";
		$koreksiref_pemda = $getDataRD['koreksi_ref_pemda'];
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
			'koreksiref_pemda' => array( 
						'label'=>'KOREKSI ref_pemda',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$koreksiref_pemda
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
	  	   <th class='th01' colspan = '2' rowspan='2' width='80'>KODE</th>	
		   <th class='th01' rowspan='2' width='700'>NAMA PEMDA</th>	
		   <th class='th02' rowspan='1' colspan='2' width='300'>KONTAK</th>	
		   <th class='th01' rowspan='2' width='100'>STATUS</th>	
	   </tr>
	   <tr>
	   		<th class='th01'  width='150'>NAMA</th>
	   		<th class='th01'  width='150'>TELEPON</th>
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
	
	function showKoreksiref_pemda($dt){	
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
						".$getKoreksi['koreksi_ref_pemda']."
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
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_ref_pemda where id_rincian_pekerjaan = '$dt'"));

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
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi oref_pemdaer by id_modul,spesifikasi,keterangan");
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
					$action  = "<img src='images/ref_pemdaistrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/ref_pemdaistrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";
					
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
					<table class='koptable' style='width:100%;' boref_pemdaer='1' id='tabelRincianPekerjaan'>
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
		

	 if($kota == 0){
	 	
	 }else{
	 	$margin = "<span style='margin-left:10px;'>";
	 	if($status == '0'){
		 	$statusstatus = '<img src="images/administrator/images/invalid.png" width="20px" heigh="20px" style="cursor : pointer;">';
		 }elseif($status == '1'){
		 	$statusstatus =  '<img src="images/administrator/images/valid.png" width="20px" heigh="20px" style="cursor : pointer;">';
		 }
	 }
	 
	 
	 $Koloms[] = array('align="center"',$provinsi);
	 $Koloms[] = array('align="center"',$kota);
	 $Koloms[] = array('align="left"',$margin.$nama_pemda);
	 $Koloms[] = array('align="left"',$nama_kontak);
	 $Koloms[] = array('align="left"',$nomor_kontak);
	 $Koloms[] = array('align="center"',$statusstatus);


	 
	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd, $fmSKPDUrusan;
	 $fmSKPDBidang = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST('fmSKPDBidang');
	 $fmSKPDskpd = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST('fmSKPDskpd');
	$fref_pemdaahun=  cekPOST('fref_pemdaahun')==''?$_COOKIE['coThnAnggaran']:cekPOST('fref_pemdaahun');
	$fmBIDANG = cekPOST('fmBIDANG');


	 $arr = array(
			//array('selectAll','Semua'),	
			array('nama_ref_pemda','NAMA ref_pemda'),		
			array('alamat','ALAMAT'),	
			array('kota','KOTA / KABUPATEN'),
			array('nama_pimpinan','NAMA PIMPINAN'),
			array('no_npwp','NO. NPWP'),			
			);
		
	 //data oref_pemdaer ------------------------------
	 $arrOref_pemdaer = array(
			     	array('1','NAMA ref_pemda'),		
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
	$fmOref_pemdaER1 = cekPOST('fmOref_pemdaER1');
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
		
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		

			$Order= join(',',$arrOrders);	
			$OrderDefault = ' Order By provinsi,kota ';// Order By no_terima desc ';
			$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;

		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; 
		$Limit = $Mode == 3 ? '': $Limit;
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	
		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
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
					$qy = "DELETE FROM $this->TblName_Hapus WHERE id='".$ids[$i]."' ";$cek.=$qy;
					$qry = mysql_query($qy);
						
			}else{
				break;
			}			
		}
		return array('err'=>$err,'cek'=>$cek);
	}
}
$ref_pemda = new ref_pemdaObj();
$ref_pemda->username = $_COOKIE['coID'];
?>