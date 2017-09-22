<?php

class ref_aplikasi_pemdaObj  extends DaftarObj2{	
	var $Prefix = 'ref_aplikasi_pemda';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_aplikasi_pemda'; //bonus
	var $TblName_Hapus = 'ref_aplikasi_pemda';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //beref_aplikasi_pemdaasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//beref_aplikasi_pemdaasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'REFERENSI APLIKASI PEMDA';
	var $PageIcon = 'images/masterdata_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='ref_aplikasi_pemda.xls';
	var $namaModulCetak='PURCHASING Oref_aplikasi_pemdaER ref_aplikasi_pemda';
	var $Cetak_Judul = 'DAFTAR ref_aplikasi_pemda';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'ref_aplikasi_pemdaForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'REFERENSI APLIKASI PEMDA';
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
	 if( $err=='' && $namaref_aplikasi_pemda =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_ref_aplikasi_pemda (c1,c,d,nama_ref_aplikasi_pemda,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namaref_aplikasi_pemda','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_ref_aplikasi_pemda (c1,c,d,nama_ref_aplikasi_pemda,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namaref_aplikasi_pemda','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_ref_aplikasi_pemda set  nama_ref_aplikasi_pemda ='$namaref_aplikasi_pemda', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
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
			mysql_query("delete from temp_rincian_aplikasi_pemda where username = '$this->username'");			
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		case 'showOptions':{				
			  foreach ($_REQUEST as $key => $value) { 
			 	 $$key = $value; 
			  }
			  mysql_query("delete from temp_rincian_aplikasi_pemda where username = '$this->username' and id_aplikasi != '$idAplikasi'");
			  $grabingAllSubModul = mysql_query("select * from ref_aplikasi where kode_aplikasi = '$idAplikasi' and kode_modul != '0' and kode_sub_modul !='0'");
			  while($rows = mysql_fetch_array($grabingAllSubModul)){
				  	foreach ($rows as $key => $value) { 
				 	 	$$key = $value; 
					}
					
					if(mysql_num_rows(mysql_query("select * from rincian_aplikasi_pemda where id_pemda = '$cmbPemda' and id_aplikasi = '$kode_aplikasi' and id_modul = '$kode_modul' and id_sub_modul = '$kode_sub_modul'")) != 0){
						$status = "checked";
					}else{
						$status = "";
					}
				    $data = array(
									'id_aplikasi_pemda' => $cmbPemda,
									'id_aplikasi' => $kode_aplikasi,
									'id_modul' => $kode_modul,
									'id_sub_modul' => $kode_sub_modul,
									'status' => $status,
									'username' => $this->username,
									);
					mysql_query(VulnWalkerInsert("temp_rincian_aplikasi_pemda",$data));
					$cek = VulnWalkerInsert("temp_rincian_aplikasi_pemda",$data);
			  }
					
			  											
		break;
		}
		
		case 'formEdit':{	
			mysql_query("delete from temp_rincian_aplikasi_pemda where username = '$this->username'");		
			$dt = $_REQUEST['ref_aplikasi_pemda_cb'];
			$getDataDulu = mysql_fetch_array(mysql_query("select * from rincian_aplikasi_pemda where id_aplikasi_pemda = '".$dt[0]."'"));
			foreach ($getDataDulu as $key => $value) { 
				 	 	$$key = $value; 
					}
			$grabingAllSubModul = mysql_query("select * from ref_aplikasi where kode_aplikasi = '$idAplikasi' and kode_modul != '0' and kode_sub_modul !='0'");
			  while($rows = mysql_fetch_array($grabingAllSubModul)){
				  	foreach ($rows as $key => $value) { 
				 	 	$$key = $value; 
					}
					
					if(mysql_num_rows(mysql_query("select * from rincian_aplikasi_pemda where id_pemda = '$cmbPemda' and id_aplikasi = '$kode_aplikasi' and id_modul = '$kode_modul' and id_sub_modul = '$kode_sub_modul'")) != 0){
						$status = "checked";
					}else{
						$status = "";
					}
				    $data = array(
									'id_aplikasi_pemda' => $cmbPemda,
									'id_aplikasi' => $kode_aplikasi,
									'id_modul' => $kode_modul,
									'id_sub_modul' => $kode_sub_modul,
									'status' => $status,
									'username' => $this->username,
									);
					mysql_query(VulnWalkerInsert("temp_rincian_aplikasi_pemda",$data));
					$cek = VulnWalkerInsert("temp_rincian_aplikasi_pemda",$data);
			  }
			/*$moveToTemp = mysql_query("select * from rincian_aplikasi_pemda where id_aplikasi_pemda ='".$dt[0]."'");
			while($rows = mysql_fetch_array($moveToTemp)){
				foreach ($rows as $key => $value) { 
				  $$key = $value; 
				}
				
				$data = array( 
								'id_aplikasi_pemda' => $dt[0],
								'id_pemda' => $id_pemda,
								'id_aplikasi' => $id_aplikasi,
								'id_modul' => $id_modul,
								'id_sub_modul' => $id_sub_modul,
								'status' => "checked",
								'username' => $this->username
							
							);
				mysql_query(VulnWalkerInsert('temp_rincian_aplikasi_pemda',$data));
			}	*/		
			$fm = $this->setFormEdit($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'checkref_aplikasi_pemda':{	
					
			$dt = $_REQUEST['ref_aplikasi_pemda_cb'];	
			$fm = $this->checkref_aplikasi_pemda($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['ref_aplikasi_pemda_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showKoreksiref_aplikasi_pemda':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->showKoreksiref_aplikasi_pemda($dt);				
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
				
				if(mysql_num_rows(mysql_query("select * from cek_ref_aplikasi_pemda where id_rincian_pekerjaan = '$idSpek'")) == 0){
					mysql_query(VulnWalkerInsert('cek_ref_aplikasi_pemda',$data));
				}else{
					mysql_query(VulnWalkerUpdate('cek_ref_aplikasi_pemda',$data,"id_rincian_pekerjaan = '$idSpek'"));
				}
				
				
			}
		break;
	    }
		
		case 'saveAplikasi':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if($kode_aplikasi == ''){
				$err = "Isi Kode";
			}elseif($kode_modul == ''){
				$err = "Isi Kode";
			}elseif($kode_sub_modul == ''){
				$err = "Isi Kode";
			}elseif(empty($nama)){
				$err = "Isi Nama";
			}else{
				$data = array(
								'kode_aplikasi' => $kode_aplikasi,
								'kode_modul' => $kode_modul,
								'kode_sub_modul' => $kode_sub_modul,
								'nama_aplikasi' => $nama,
								
							);
				
				$query = VulnWalkerInsert("ref_aplikasi_pemda",$data);
				if($kode_modul != '0' && $kode_sub_modul != '0' && mysql_num_rows(mysql_query("select *  from ref_aplikasi_pemda where kode_aplikasi = '$kode_aplikasi' and kode_modul = '0' and kode_sub_modul = '0'")) == 0){
					$err = "Aplikasi belum ada, silakan isi kode ke dua dan ke tiga dengan angka 0";
				}elseif($kode_sub_modul != '0' && mysql_num_rows(mysql_query("select *  from ref_aplikasi_pemda where kode_aplikasi = '$kode_aplikasi' and kode_modul = '$kode_modul' and kode_sub_modul = '0'")) == 0){
					$err = "Modul belum ada, silakan isi ke tiga dengan angka 0";
				}else{
					if(mysql_num_rows(mysql_query("select * from ref_aplikasi_pemda where kode_aplikasi = '$kode_aplikasi' and kode_modul ='$kode_modul' and kode_sub_modul ='$kode_sub_modul'")) == 0){
						mysql_query($query);
					}else{
						$err = "Data Sudah Ada";
					}
				}
				$cek = $query;
				
			}
		break;
	    }
		
		
		case 'editAplikasi':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if($kode_aplikasi == ''){
				$err = "Isi Kode";
			}elseif($kode_modul == ''){
				$err = "Isi Kode";
			}elseif($kode_sub_modul == ''){
				$err = "Isi Kode";
			}elseif(empty($nama)){
				$err = "Isi Nama";
			}else{
				$data = array(
								'kode_aplikasi' => $kode_aplikasi,
								'kode_modul' => $kode_modul,
								'kode_sub_modul' => $kode_sub_modul,
								'nama_aplikasi' => $nama,
								
							);
				
				$query = VulnWalkerUpdate("ref_aplikasi_pemda",$data,"id = '$username'");
				if($kode_modul != '0' && $kode_sub_modul != '0' && mysql_num_rows(mysql_query("select *  from ref_aplikasi_pemda where kode_aplikasi = '$kode_aplikasi' and kode_modul = '0' and kode_sub_modul = '0'")) == 0){
					$err = "Aplikasi belum ada, silakan isi kode ke dua dan ke tiga dengan angka 0";
				}elseif($kode_sub_modul != '0' && mysql_num_rows(mysql_query("select *  from ref_aplikasi_pemda where kode_aplikasi = '$kode_aplikasi' and kode_modul = '$kode_modul' and kode_sub_modul = '0'")) == 0){
					$err = "Modul belum ada, silakan isi ke tiga dengan angka 0";
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
		$scriptload = 
					"<script>
						$(document).ready(function(){ 
							".$this->Prefix.".loading();
						});
					</script>";
		return 	
			"
			<script type='text/javascript' src='js/ref_aplikasi_pemda/".$this->Prefix.".js' language='JavaScript' ></script>
			<script type='text/javascript' src='js/ref_aplikasi_pemda/popupOption.js' language='JavaScript' ></script>
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
	 $this->form_height = 150;
	 $this->form_caption = 'BARU';
	 

	 $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota != '0'","onchange=$this->Prefix.pemdaChanged();",'-- Pilih Pemda --');
	 $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'","onchange=$this->Prefix.aplikasiChanged();",'-- Pilih Aplikasi --');
	 $this->form_fields = array(
	 		'pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							$cmbPemda
						</div>", 
						 ),
			'aplikasi' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							$cmbAplikasi
						</div>", 
						 ),
						 
			'asd' => array( 
						'label'=>'RINCIAN MODUL / SUBMODUL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='button' id='pilih' value='Pilih' >
							<input type='hidden' id='lock' name = 'lock' value='0'>
						</div>", 
						 ),

				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			
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
	 $this->form_height = 150;
	 $this->form_caption = 'EDIT';
	 
	 $getData = mysql_fetch_array(mysql_query("select * from ref_aplikasi_pemda where id = '$dt'"));
	 foreach ($getData as $key => $value) { 
			  $$key = $value; 
			}

	 $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota != '0'","onchange=$this->Prefix.pemdaChanged(); disabled",'-- Pilih Pemda --');
	 $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'","onchange=$this->Prefix.aplikasiChanged(); disabled",'-- Pilih Aplikasi --');
	 $this->form_fields = array(
	 		'pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
							$cmbPemda
						</div>", 
						 ),
			'aplikasi' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							$cmbAplikasi
						</div>", 
						 ),
						 
			'asd' => array( 
						'label'=>'RINCIAN MODUL / SUBMODUL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
							<input type='button' id='pilih' value='Pilih' onclick=popupOption.windowShow($id_aplikasi); >
							<input type='hidden' id='lock' name = 'lock' value='0'>
						</div>", 
						 ),

				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
	function checkref_aplikasi_pemda($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 350;
	 $this->form_caption = 'CHECK MAINTENCE';	
	
	
	 $got = mysql_fetch_array(mysql_query("select * from cek_ref_aplikasi_pemda where id_rincian_pekerjaan = '$dt'"));
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
	 if(empty($getDataRD['koreksi_ref_aplikasi_pemda']) || $getDataRD['koreksi_ref_aplikasi_pemda'] == ' '){
	 	$statusKoreksi = "TIDAK";
	 }else{
	 	$statusKoreksi = "YA";
		$koreksiref_aplikasi_pemda = $getDataRD['koreksi_ref_aplikasi_pemda'];
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
			'koreksiref_aplikasi_pemda' => array( 
						'label'=>'KOREKSI ref_aplikasi_pemda',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$koreksiref_aplikasi_pemda
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
	  	   <th class='th01'	width='100' >NAMA PEMDA</th>	
		   <th class='th01' width='1100'>NAMA APLIKASI</th>	

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
	 $namaPemda = mysql_fetch_array(mysql_query("select * from ref_aplikasi_pemda where id = '$id_pemda'"));
	 $namaPemda = $namaPemda['nama_pemda'];
	 
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi_pemda where id = '$id_aplikasi'"));
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
	
	function showKoreksiref_aplikasi_pemda($dt){	
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
						".$getKoreksi['koreksi_ref_aplikasi_pemda']."
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
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_ref_aplikasi_pemda where id_rincian_pekerjaan = '$dt'"));

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
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi oref_aplikasi_pemdaer by id_modul,spesifikasi,keterangan");
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
					$action  = "<img src='images/ref_aplikasi_pemdaistrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/ref_aplikasi_pemdaistrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";
					
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
					<table class='koptable' style='width:100%;' boref_aplikasi_pemdaer='1' id='tabelRincianPekerjaan'>
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
	 
	
	 $Koloms[] = array('align="center"',$TampilCheckBox);
	 $getDataPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$id_pemda'"));
	 $namaPemda = $getDataPemda['nama_pemda']; 
	 
	 $getDataAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '0'"));
	 $namaAplikasi = $getDataAplikasi['nama_aplikasi']; 
	 $Koloms[] = array('align="left"',$namaPemda);
	 $Koloms[] = array('align="left"',$namaAplikasi);



	 
	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd, $fmSKPDUrusan;
	 $fmSKPDBidang = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST('fmSKPDBidang');
	 $fmSKPDskpd = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST('fmSKPDskpd');
	$fref_aplikasi_pemdaahun=  cekPOST('fref_aplikasi_pemdaahun')==''?$_COOKIE['coThnAnggaran']:cekPOST('fref_aplikasi_pemdaahun');
	$fmBIDANG = cekPOST('fmBIDANG');


	 $arr = array(
			//array('selectAll','Semua'),	
			array('nama_ref_aplikasi_pemda','NAMA ref_aplikasi_pemda'),		
			array('alamat','ALAMAT'),	
			array('kota','KOTA / KABUPATEN'),
			array('nama_pimpinan','NAMA PIMPINAN'),
			array('no_npwp','NO. NPWP'),			
			);
		
	 //data oref_aplikasi_pemdaer ------------------------------
	 $arrOref_aplikasi_pemdaer = array(
			     	array('1','NAMA ref_aplikasi_pemda'),		
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
	$fmOref_aplikasi_pemdaER1 = cekPOST('fmOref_aplikasi_pemdaER1');
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
/*			$OrderDefault = ' Order By kode_aplikasi,kode_modul,kode_sub_modul ';// Order By no_terima desc ';*/
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
$ref_aplikasi_pemda = new ref_aplikasi_pemdaObj();
$ref_aplikasi_pemda->username = $_COOKIE['coID'];
?>