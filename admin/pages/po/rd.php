<?php

class rdObj  extends DaftarObj2{	
	var $Prefix = 'rd';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'rincian_pekerjaan'; //bonus
	var $TblName_Hapus = 'rincian_pekerjaan';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'PURCHASING ORDER R/D';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='rd.xls';
	var $namaModulCetak='PURCHASING ORDER rd';
	var $Cetak_Judul = 'DAFTAR rd';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'rdForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'PURCHASING ORDER R/D';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if( $rd !='2'){
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".checkRD()","sections.png","Check R/D", 'Check R/D')."</td>";
		}
		
		
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
	 if( $err=='' && $namard =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_rd (c1,c,d,nama_rd,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namard','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_rd (c1,c,d,nama_rd,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namard','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_rd set  nama_rd ='$namard', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
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
		
		case 'checkRD':{	
					
			$dt = $_REQUEST['rd_cb'];	
			$fm = $this->checkRD($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'statusChanged':{	
				$status = $_REQUEST['status'];
				if($status == "OK"){
					$visibli = "";
					$label  = '<span id="labelCheck" style="display: '.$visibli.' ;">TANGGAL CHECK</span>';
					$isi   = "<div style='float:left;display: $visibli;' id='isiCheck'>
						<input type='text' name='tanggal_check' id='tanggal_check' value='".date("d-m-Y")."' placeholder='TANGGAL CHECK'  style='width:100px;text-align:left;'>
						
						</div>";
				}else{
					$visibli = "none";
					$label  = '<span id="labelCheck" style="display: '.$visibli.' ;">TANGGAL CHECK</span>';
					$isi   = "<div style='float:left;display: $visibli;' id='isiCheck'>
						<input type='text' name='tanggal_check' id='tanggal_check' value='".date("d-m-Y")."' placeholder='TANGGAL CHECK'  style='width:100px;text-align:left;'>
						
						</div>";
					
				}			
				$content = array('label' => $label, 'isiCheck' => $isi);			
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['rd_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showKoreksiMT':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->showKoreksiMT($dt);				
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
			if(empty($progress)){
				$err = "Isi Progress";
			}elseif(empty($cmbPegawai)){
				$err = "Pilih Programer";
			}/*elseif(empty($url_source)){
				$err = "Isi URL Source";
			}*/elseif(empty($cmbRD)){
				$err = "Pilih Status R/D";
			}else{
				$grabSpekData = mysql_fetch_array(mysql_query("select * from rincian_pekerjaan where id = '$idSpek'"));
				$tanggal_progress = explode('-',$tanggal_progress);
				$tanggal_progress = $tanggal_progress[2]."-".$tanggal_progress[1]."-".$tanggal_progress[0];
				$tanggal_check = explode('-',$tanggal_check);
				$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
				$data = array(
								'id_po' => $grabSpekData['id_parent'],
								'id_rincian_pekerjaan' => $idSpek,
								'progress' => $progress,
								'staff' => $cmbPegawai,
								'url_source' => $url_source,
								'rd' => $cmbRD,
								'tanggal_check' => $tanggal_check,
								'tanggal_progress' => $tanggal_progress,
				);
				
				if(mysql_num_rows(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$idSpek'")) == 0){
					mysql_query(VulnWalkerInsert('cek_rd',$data));
				}else{
					mysql_query(VulnWalkerUpdate('cek_rd',$data,"id_rincian_pekerjaan = '$idSpek'"));
				}
				
				if($cmbRD == "OK"){
					mysql_query("update cek_mt set koreksi = '',status_cek = 'TIDAK'  where id_rincian_pekerjaan = '$idSpek'");
					mysql_query("update cek_pemda set koreksi = '' where id_rincian_pekerjaan = '$idSpek'");
				}
				
				
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
		if($rd != '1' && $rd !='2'){
		
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
			<script type='text/javascript' src='js/po/".$this->Prefix.".js' language='JavaScript' ></script>
			
			".'<link rel="stylesheet" href="datepicker/jquery-ui.css">
			  <script src="datepicker/jquery-1.12.4.js"></script>
			  <script src="datepicker/jquery-ui.js"></script>'.
			$scriptload;
	}
	
	//form ==================================
	function setFormBaru(){
		$dt=array();
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		$c1 = $_REQUEST[$this->Prefix.'SkpdfmUrusan'];
		$c = $_REQUEST[$this->Prefix.'SkpdfmSKPD'];
		$d = $_REQUEST[$this->Prefix.'SkpdfmUNIT'];
		$dt['tgl'] = date("Y-m-d"); //set waktu sekarang
		$dt['urusan'] = $_REQUEST['fmSKPDUrusan'];
		$dt['bidang'] = $_REQUEST['fmSKPDBidang'];
		$dt['skpd'] = $_REQUEST['fmSKPDskpd'];
		$fm = $this->setForm($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
   
  	function setFormEdit(){
		$cek ='';
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;				

		if($cnt['cnt'] > 0) $err = "rd Tidak Bisa Diubah ! Sudah Digunakan Di Ref Barang.";
		if($err == ''){
			$aqry = "SELECT * FROM  ref_rd WHERE id='".$this->form_idplh."' "; $cek.=$aqry;
			$dt = mysql_fetch_array(mysql_query($aqry));
			$fm = $this->setForm($dt);
		}
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}	
		
	function checkRD($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 200;
	 $this->form_caption = 'CHECK R/D';	
	
	
	 $got = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal = explode('-',$tanggal);
	 $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	 $arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
	$arrayProgress = array(
						array('25' , '25 %'),
						array('50' , '50 %'),
						array('75' , '75 %'),
						array('90' , '90 %'),
						array('100' , '100 %'),
						
	 				);
					
					
	 if($rd == '' ){
	 	$rd = "TIDAK";
	 }
	 
	 if($rd == "OK"){
	 	$label = "TANGGAL CHECK";
		$tanggal_check = explode('-',$tanggal_check);
		$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
		$isiCheck = "	<input type='text' name='tanggal_check' id='tanggal_check' value='".$tanggal_check."' placeholder='TANGGAL CHECK'  style='width:100px;text-align:left;'>"; 
	 }
	 
	 if(empty($tanggal_progress)){
	 	$tanggal_progress = date('d-m-Y');
	 }else{
	 	$tanggal_progress = explode('-',$tanggal_progress);
		$tanggal_progress = $tanggal_progress[2]."-".$tanggal_progress[1]."-".$tanggal_progress[0];
	 }
	 /*if(empty($tanggal_check)){
	 	$tanggal_check = date('d-m-Y');
	 }*/
	 
	 if(empty($url_source)){
	 	$url_source = "http://123.231.253.228/atis";
	 }
	 
	 $cmbRD = cmbArray('cmbRD',$rd,$arrayStatus,'-- STATUS R/D --',"onchange = $this->Prefix.statusChanged();");
	 if($progress == '')$progress ="25";
	 $cmbProgress = cmbArray('progress',$progress,$arrayProgress,'-- PROGRESS --','');

	 $cmbPegawai = cmbQuery('cmbPegawai',$staff,"select Id,nama from ref_pegawai","style='width:150;' ",'-- Pilih Pegawai --');
	 $this->form_fields = array(
	 		'progres' => array( 
						'label'=>'PROGRESS',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'> 
							$cmbProgress
						</div>", 
						 ),
			'staff' => array( 
						'label'=>'PROGRAMER',
						'labelWidth'=>60, 
						'value'=>"<div style='float:left;'>
								$cmbPegawai
						</div>", 
						 ),
			'tgl' => array( 
						'label'=>'TANGGAL PROGRESS',
						'labelWidth'=>60, 
						'value'=>"<div style='float:left;'>
								<input type='text' name='tanggal_progress' id='tanggal_progress' value='".$tanggal_progress."' placeholder='TANGGAL PROGRESS' style='width:100px;text-align:left;'>
						</div>", 
						 ),
			'urlSource' => array( 
						'label'=>'URL SOURCE',
						'labelWidth'=>60, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='url_source'  id='url_source' value='".$url_source."' placeholder='URL SOURCE' style='width:400px;'>
						</div>" 
						 ),	
	 		'rd' => array( 
						'label'=>'STATUS R/D',
						'labelWidth'=>60, 
						'value'=>"<div style='float:left;'>
								$cmbRD
						</div>", 
						 ),
			'tanggalCheckRD' => array( 
						'label'=>'<span id="labelCheck" >'.$label.'</span>',
						'labelWidth'=>60, 
						'value'=>"<div id='isiCheck'>
						$isiCheck
						</div>", 
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
  	   <th class='th01' width='120'>NO PO / TANGGAL</th>	
	   <th class='th01' width='400' >NAMA PEMDA / NAMA PEKERJAAN</th>	
	   <th class='th01' width='300'>RINCIAN PEKERJAAN</th>	
	   <th class='th01' width='200'>SPESIFIKASI PEKERJAAN</th>	
	   <th class='th01' width='50'>PROGRESS / PROG</th>	
	   <th class='th01' width='50'>URL SOURCE</th>	
	   <th class='th01' width='50'>STATUS R/D</th>	
	   <th class='th01' width='50'>STATUS MAINTENANCE</th>	
	   <th class='th01' width='50'>KOREKSI MAINTENANCE</th>	
	   <th class='th01' width='50'>KOREKSI PEMDA</th>	

	
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
	
	function showKoreksiMT($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 140;
	 $this->form_caption = 'KOREKSI MAINTENANCE';	
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from tabel_koreksi where id = '$dt'"));

	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						".$getKoreksi['koreksi']."
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
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from tabel_koreksi where id = '$dt'"));

	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						".$getKoreksi['koreksi']."
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
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi order by id_modul,spesifikasi,keterangan");
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
					<table class='koptable' style='width:100%;' border='1' id='tabelRincianPekerjaan'>
						$header
						$data
					</table>
					"
				
				;
		return $content2;
	}
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 foreach ($isi as $key => $value) { 
			  $$key = $value; 
			}
	 
	 

	 	
	 $getPO = mysql_fetch_array(mysql_query("select * from po where id='$id_parent'"));
	 foreach ($getPO as $key => $value) { 
			  $$key = $value; 
			}
	 $getDataRD = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '".$isi['id']."'"));
	 foreach ($getDataRD as $key => $value) { 
			  $$key = $value; 
			}
	 $getNamaPegawai = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$staff'"));
	 $namaPegawai = $getNamaPegawai['nama'];
	 if($rd == "OK"){
	 	$statusRD = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusRD = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 if($mt == "OK"){
	 	$statusMT = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusMT = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	
	 
	
	 
	 
	 

	 $getNamaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$id_pemda'"));
	 $namaPemda = $getNamaPemda['nama_pemda'];
	
	 $Koloms.= "<td class='$cssclass' align='center'>".$no.'.'."</td>"; 
	 $Koloms.= "<td class='$cssclass' align='center'>".$TampilCheckBox."</td>"; 
	 $getNomorPO = mysql_fetch_array(mysql_query("select * from po where id = '".$isi['id_parent']."'"));
	 $nomorPO = $getNomorPO['nomor_po'];
	 if($id_parent == $this->hublaConcat){
	 	$namaPemda = "";
		$nama_kegiatan = "";
		$tanggal_po = "";
		$target_selesai = "";
		$nomorPO = "";
	 }
	 
	 if($id_parent == $this->hublaConcat && $id_modul == $this->modulConcat){
	 	$namaModul = "";
	 }else{
	 	 $getModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_modul='".$isi['id_modul']."' and kode_aplikasi = '".$getPO['id_aplikasi']."' and kode_sub_modul = '0'"));
	 	 $namaModul = "<b>".$getModul['nama_aplikasi']."</b> <br>";
		 if($id_modul == '0')$namaModul="<b>NON MODUL</b> <br>";
	 }		
	 $Koloms.= "<td class='$cssclass' align='left'>".$nomorPO."<br>".VulnWalkerTitiMangsa($tanggal_po)."</td>";

	 
	 $Koloms.= "<td class='$cssclass' align='left'>"."<b>".$namaPemda."</b><br> &nbsp".$nama_kegiatan."<br> &nbsp".VulnWalkerTitiMangsa($target_selesai)."</td>";
	 $this->hublaConcat = $id_parent;
	 $this->modulConcat = $id_modul;
	 $Koloms.= "<td class='$cssclass' align='left'>$namaModul &nbsp ".str_replace("\n","<br> &nbsp ",$rincian_pekerjaan)."</td>";
	 $Koloms.= "<td class='$cssclass' align='left'>".str_replace("\n","<br>",$isi[keterangan])."</td>";
	 
	 if(!empty($progress)){
	 	$progress = $progress." %";
	 }
	 $Koloms.= "<td class='$cssclass' align='left'>".$progress."<br>".substr($namaPegawai, 0, 10)."</td>";
	 $Koloms.= "<td class='$cssclass' align='left'>"."<a href='$url_source' target='_blank'>$url_source</a>"."</td>";
	 $Koloms.= "<td class='$cssclass' align='center'>".$statusRD."</td>";
	 $Koloms.= "<td class='$cssclass' align='center'>".$statusMT."</td>";
	 
	 
	 
	 
	
	 $getDataMt = mysql_fetch_array(mysql_query("select * from cek_mt where id_rincian_pekerjaan = '".$isi['id']."'"));
	 if($mt == 'TIDAK' && $getDataMt['koreksi'] !='' ){
	 	$grabIdKoreksi = mysql_fetch_array(mysql_query("select max(id) from tabel_koreksi where id_rincian_pekerjaan = '".$isi['id']."' and koreksi_dari = 'MT'"));
		$idKoreksi = $grabIdKoreksi['max(id)'];
	 	$statusKoreksiMT = "ADA";
	 	$styleMT = "style='cursor:pointer;color:red;' onclick=$this->Prefix.showKoreksiMT($idKoreksi)  ";
	 }else{
		 $statusKoreksiMT = "TIDAK";
	 }
	 
	 $getDataPemda = mysql_fetch_array(mysql_query("select * from cek_pemda where id_rincian_pekerjaan = '".$isi['id']."'"));
	 if($mt == 'TIDAK' && $getDataPemda['koreksi'] != ''){
	 	$grabIdKoreksi = mysql_fetch_array(mysql_query("select max(id) from tabel_koreksi where id_rincian_pekerjaan = '".$isi['id']."' and koreksi_dari = 'PEMDA'"));
		$idKoreksi = $grabIdKoreksi['max(id)'];
	 	$statusKoreksiPemda = "ADA";
	 	$stylePemda = "style='cursor:pointer;color:red;' onclick=$this->Prefix.showKoreksiPemda(".$idKoreksi.")";
	 }else{
	 	$statusKoreksiPemda = "TIDAK";
	 }
	 $Koloms.= "<td class='$cssclass' align='center'>"."<span $styleMT>$statusKoreksiMT</span>"."</td>";
	 $Koloms.= "<td class='$cssclass' align='center'>"."<span $stylePemda>$statusKoreksiPemda</span>"."</td>";
	 $Koloms = array(
						 	array("Y", $Koloms),
						 );
	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd, $fmSKPDUrusan;
	 $fmSKPDBidang = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST('fmSKPDBidang');
	 $fmSKPDskpd = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST('fmSKPDskpd');
	$fmTahun=  cekPOST('fmTahun')==''?$_COOKIE['coThnAnggaran']:cekPOST('fmTahun');
	$fmBIDANG = cekPOST('fmBIDANG');



	 
	$fmPILCARI = $_REQUEST['fmPILCARI'];	
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];		
	//tgl bulan dan tahun
	$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];
	$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
	$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
	$fmORDER1 = cekPOST('fmORDER1');
	$fmDESC1 = cekPOST('fmDESC1');
	$baris = $_REQUEST['baris'];
	if ($baris == ''){
		$baris = "25";		
	}
	$queryCmbPemda = "select id, nama_pemda from ref_pemda where kota !='0'";
	$cmbPemda = $_REQUEST['cmbPemda'];
	$cmbAplikasi = $_REQUEST['cmbAplikasi'];
	$cmbModul = $_REQUEST['cmbModul'];
	$comboPemda = cmbQuery('cmbPemda',$cmbPemda,$queryCmbPemda,"' onchange =$this->Prefix.refreshList(true); ",'-- Semua Pemda --');
	$querycmbAplikasi = "select kode_aplikasi, nama_aplikasi from ref_aplikasi where kode_modul = '0'";
	$comboApp = cmbQuery('cmbAplikasi',$cmbAplikasi,$querycmbAplikasi,"' onchange =$this->Prefix.refreshList(true); ",'-- Semua Aplikasi --');
	$queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
	$comboMod = cmbQuery('cmbModul',$cmbModul,$queryCmbModul,"' onchange=$this->Prefix.refreshList(true);",'-- Semua Modul --');
	     
	$TampilOpt = 
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td>PEMDA </td>
			<td>: </td>
			<td style='width:90%;'>$comboPemda </td>
			</tr>
			<tr>
			<td>APLIKASI </td>
			<td>: </td>
			<td style='width:90%;'>$comboApp </td>
			</tr>
			<tr>
			<td>MODUL </td>
			<td>: </td>
			<td style='width:90%;'>$comboMod </td>
			</tr>
			<tr>
			<td>NOMOR PO </td>
			<td>: </td>
			<td style='width:90%;'><input type='text' name='filterNomorPo' id='filterNomorPo' style='width:50px;' value='".$_REQUEST['filterNomorPo']."' > &nbsp <input type='button' onclick=$this->Prefix.refreshList(true); value='Cari' >  </td>
			</tr>
			</table>".
			"</div>";
			
		return array('TampilOpt'=>$TampilOpt);
	}			
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}	

		//kondisi -----------------------------------
		
		$arrKondisi = array();		
		$arrayParent = array();

		$grabingAllRD = mysql_query("select * from rincian_pekerjaan");
		while($rows = mysql_fetch_array($grabingAllRD)){
			if(in_array($rows['id_parent'],$arrayParent)){
					
				}else{
					$arrayParent[] = $rows['id_parent'];
				}
			if(mysql_num_rows(mysql_query("select * from po where id = '".$rows['id_parent']."'")) == 0){
				mysql_query("delete from rincian_pekerjaan where id_parent = '".$rows['id_parent']."'");
			}	
			if(mysql_num_rows(mysql_query("select * from po where id = '".$rows['id_parent']."' and id_kategori ='1'")) == 0){
				$arrKondisi[] = "id != '".$rows['id']."'";		
			}
		}
		
		if(!empty($cmbPemda)){
			for($i = 0 ; $i <= sizeof($arrayParent); $i ++){
				if(mysql_num_rows(mysql_query("select * from po where id = '".$arrayParent[$i]."' and id_pemda = '$cmbPemda'"))==0){
					$arrKondisi[] = "id_parent !='".$arrayParent[$i]."'";
				}
			}
			
		}
		
		if(!empty($filterNomorPo)){
			for($i = 0 ; $i <= sizeof($arrayParent); $i ++){
				if(mysql_num_rows(mysql_query("select * from po where id = '".$arrayParent[$i]."' and nomor_po = '$filterNomorPo'"))==0){
					$arrKondisi[] = "id_parent !='".$arrayParent[$i]."'";
				}
			}
		}
		
		if(!empty($cmbAplikasi)){
			for($i = 0 ; $i <= sizeof($arrayParent); $i ++){
				if(mysql_num_rows(mysql_query("select * from po where id = '".$arrayParent[$i]."' and id_aplikasi = '$cmbAplikasi'"))==0){
					$arrKondisi[] = "id_parent !='".$arrayParent[$i]."'";
				}
			}
			if(!empty($cmbModul)){
				$arrKondisi[] = "id_modul ='".$cmbModul."'";
				
			}
		}
				
		
		
		
		/*$arrKondisi[] = "id_aplikasi = '0'";	
		$arrKondisi[] = "id_pemda = '0'";	*/
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		//$arrOrders[] = "id_modul,rincian_pekerjaan,keterangan";
/*		switch($fmORDER1){
			case '1': $arrOrders[] = " nama_rd $Asc1 " ;break;
			case '2': $arrOrders[] = " alamat $Asc1 " ;break;
			case '3': $arrOrders[] = " kota $Asc1 " ;break;
			case '4': $arrOrders[] = " nama_pimpinan $Asc1 " ;break;
			case '5': $arrOrders[] = " no_npwp $Asc1 " ;break;
			case '6': $arrOrders[] = " c $Asc1 " ;break;
		}	*/
		$arrOrders[] = "id_parent,id_modul";
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
		/*$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		//$Limit = " limit ".(($HalDefault	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal; //$LimitHal = '';
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	*/
		
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
		
			$a = "SELECT count(*) as cnt, aa.rd_terbesar, aa.rd_terkecil, bb.nama, aa.f, aa.g, aa.h, aa.i, aa.j FROM ref_barang aa INNER JOIN ref_rd bb ON aa.rd_terbesar = bb.nama OR aa.rd_terkecil = bb.nama WHERE bb.nama='".$ids[$i]."' "; $cek .= $a;
		$aq = mysql_query($a);
		$cnt = mysql_fetch_array($aq);
		
		if($cnt['cnt'] > 0) $err = "rd ".$ids[$i]." Tidak Bisa DiHapus ! Sudah Digunakan Di Ref Barang.";
		
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
$rd = new rdObj();
$rd->username = $_COOKIE['coID'];
?>