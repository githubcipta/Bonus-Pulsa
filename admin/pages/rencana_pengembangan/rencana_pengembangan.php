<?php

class rencana_pengembanganObj  extends DaftarObj2{	
	var $Prefix = 'rencana_pengembangan';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'rencana_pengembangan'; //bonus
	var $TblName_Hapus = 'rencana_pengembangan';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berencana_pengembanganasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berencana_pengembanganasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'RENCANA PENGEMBANGAN';
	var $PageIcon = 'images/masterdata_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='rencana_pengembangan.xls';
	var $namaModulCetak='PURCHASING Orencana_pengembanganER rencana_pengembangan';
	var $Cetak_Judul = 'DAFTAR rencana_pengembangan';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'rencana_pengembanganForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'RENCANA PENGEMBANGAN';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if( $produksi !='2'){
			return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","new_f2.png","Baru",'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus').
			"</td>";
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
	 if( $err=='' && $namarencana_pengembangan =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_rencana_pengembangan (c1,c,d,nama_rencana_pengembangan,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namarencana_pengembangan','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_rencana_pengembangan (c1,c,d,nama_rencana_pengembangan,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namarencana_pengembangan','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_rencana_pengembangan set  nama_rencana_pengembangan ='$namarencana_pengembangan', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
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
		case 'newrincian_pekerjaan':{			
				$fm = $this->newrincian_pekerjaan();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}	
		case 'Saverincian_pekerjaan':{			
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}
				if(empty($rencanaPengembangan)){
					$err = "Isi Rencana Pengembangan";
				}else{
					$mulai = explode('-',$mulai);
					$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];
					$selesai = explode('-',$selesai);
					$selesai = $selesai[2]."-".$selesai[1]."-".$selesai[0];
					$data = array(
								'rencana_pengembangan' => $rencanaPengembangan,
								'mulai' => $mulai,
								'selesai' => $selesai,
								'username' => $this->username
								);
					mysql_query(VulnWalkerInsert("temp_rencana_pengembangan",$data));
					
				}			
			break;
		}	
		case 'Editrincian_pekerjaan':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				
				if(empty($rencanaPengembangan)){
					$err = "Isi Rencana Pengembangan";
				}else{
					$mulai = explode('-',$mulai);
					$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];
					$selesai = explode('-',$selesai);
					$selesai = $selesai[2]."-".$selesai[1]."-".$selesai[0];
					$data = array(
								'rencana_pengembangan' => $rencanaPengembangan,
								'username' => $this->username,
								'mulai' => $mulai,
								'selesai' => $selesai,
								);
					mysql_query(VulnWalkerUpdate("temp_rencana_pengembangan",$data,"id = '$id'"));
					
				}			
				
				
				
		break;
	    }
		
		case 'getTabel':{
			foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}
			$aksi = '<a href="javascript:rencana_pengembangan.newrincian_pekerjaan()" id="pengguna_aplikasiAtasButton"><img id="gambarAtasButton" src="datepicker/add-256.png" style="width:20px;height:20px;"></a>';
			$header = "<tr>
								<th class='th01' width='20'>NO</th>

								<th class='th01' width='1200'>RENCANA PENGEMBANGAN</th>

								<th class='th01' width='50'>$aksi</th>	
							
						</tr>";
						
						
				//getDaftar
				$arrKondisi = array();
				
				$query = mysql_query("select * from temp_rencana_pengembangan where username = '$this->username'");
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
					
					$action  = "<img src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";

					
					$isi =  "	
							<tr class='$tergantung'>
								<td align='center'>$no.</td>
								<td>$rencana_pengembangan</td>
								<td align='center'><span id='spanAction$id'>$action</span></td>
			   				</tr>
				
					";
					$lastIDModul = $id_modul;					
					$data .= $isi;
					$no += 1;
				}
			
			$content = array('tabel' => $header.$data);
			
		break;
	    }
		
		case 'hapusRincian':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				mysql_query("delete from temp_rencana_pengembangan where id ='$id'");
				
				
				
		break;
		}
		
		case 'editrincian_pekerjaan':{	
						
				$fm = $this->editrincian_pekerjaan($_REQUEST['idTemp']);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		case 'formBaru':{		
			mysql_query("delete from temp_rencana_pengembangan where username = '$this->username'");		
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formEdit':{	
			$dt = $_REQUEST['rencana_pengembangan_cb'];	
			mysql_query("delete from temp_rencana_pengembangan where username = '$this->username'");
			$getRencanaPengembanga = mysql_query("select * from detail_rencana_pengembangan where id_rencana_pengembangan ='$dt[0]'");
			 while($rows = mysql_fetch_array($getRencanaPengembanga)){
			 	$data = array(
								'rencana_pengembangan' => $rows['rencana_pengembangan'],
								'username' => $this->username,
								'mulai' => $rows['mulai'],
								'selesai' => $rows['selesai']
							);
			 	mysql_query(VulnWalkerInsert("temp_rencana_pengembangan",$data));
			 }		
			$fm = $this->setFormEdit($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'updateStatus':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->updateStatus($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['rencana_pengembangan_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showKoreksirencana_pengembangan':{	
					
			$dt = $_REQUEST['id'];	
			$fm = $this->showKoreksirencana_pengembangan($dt);				
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
				 if(!empty($tanggalSelesai)){
				 	$tanggalSelesai = explode('-',$tanggalSelesai);
					$tanggalSelesai = $tanggalSelesai[2]."-".$tanggalSelesai[1]."-".$tanggalSelesai[0];
				 }
				 if(!empty($mulai)){
				 	$mulai = explode('-',$mulai);
					$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];
				 }
				 $grabSpekData = mysql_fetch_array(mysql_query("select * from rincian_pekerjaan where id = '$idSpek'"));
				
				 $data = array(	'status' => $cmbCheck,
								'selesai' => $tanggalSelesai,
								'target' => $target,
								'mulai' => $mulai,
								'lama' => $lama,
								//'user' => $this->username
				 );
				 if($cmbCheck == "SUDAH" && $tanggalSelesai == ''){
				 	$err = "Isi tanggal selesai";
				 }else{
				 	mysql_query(VulnWalkerUpdate('rencana_pengembangan',$data,"id = '$id'"));
				 }
				 

				

		break;
	    }
		
		case 'saveAplikasi':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			
				
			if(empty($cmbAplikasi)){
				$err = "Pilih Aplikasi";
			}elseif(empty($cmbModul)){
				$err = "Pilih Modul";
			}elseif(empty($rencanaPengembangan)){
				$err = "Isi Rencana Pengembangan";
			}else{

				$mulai = explode('-',$mulai);
				$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];

				$data = array(
									'id_aplikasi' => $cmbAplikasi,
									'id_modul' => $cmbModul,
									'rencana_pengembangan' => $rencanaPengembangan,
									'spesifikasi' => $spesifikasi,
									'user' => $this->username
									
									);
				mysql_query(VulnWalkerInsert("rencana_pengembangan",$data));
				$cek = VulnWalkerInsert("rencana_pengembangan",$data) ;
			}
		break;
	    }
		
		
		case 'editAplikasi':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($cmbModul)){
				$err = "Pilih Modul";
			}elseif(empty($rencanaPengembangan)){
				$err = "Isi Rencana Pengembangan";
			}else{

				$mulai = explode('-',$mulai);
				$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];

				$data = array(
									'id_modul' => $cmbModul,
									'rencana_pengembangan' => $rencanaPengembangan,
									'spesifikasi' => $spesifikasi,
									'user' => $this->username
									);
				mysql_query(VulnWalkerUpdate("rencana_pengembangan",$data,"id = '$idAwal'"));
				
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
		if($produksi != '1' && $produksi !='2'){
		
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
			<script type='text/javascript' src='js/rencana_pengembangan/".$this->Prefix.".js' language='JavaScript' ></script>
			".'<link rel="stylesheet" href="datepicker/jquery-ui.css">
			  <script src="datepicker/jquery-1.12.4.js"></script>
			  <script src="datepicker/jquery-ui.js"></script>'
			  
			.'
		    <link href="monthpicker/jquery-ui.css" rel="stylesheet" type="text/css" />
		
		    <link href="monthpicker/MonthPicker.min.css" rel="stylesheet" type="text/css" />

		
		    <script src="monthpicker/jquery-1.12.1.min.js"></script>
		    <script src="monthpicker/jquery-ui.min.js"></script>
		    <script src="monthpicker/jquery.maskedinput.min.js"></script>
		
		    <script src="monthpicker/MonthPicker.min.js"></script>
		  '.
			$scriptload;
	}
	
	//form ==================================
	function setFormBaru(){

		//$this->form_idplh ='';
		$this->form_fmST = 0;
		 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 600;
	 $this->form_height = 260;
	 $this->form_caption = 'BARU';	
	foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}	
	$arr = array(	
			array('BELUM','BELUM'),		
			array('PROSES','PROSES'),		
			array('SUDAH','SUDAH'),		
			);
	 $cmbStatus = cmbArray('cmbStatus',"BELUM",$arr,'-- STATUS --','');
	 $queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
	 $cmbModul =  cmbQuery('cmbModul',$filterModul,$queryCmbModul,"",'-- Semua Modul --');
	 $this->form_fields = array(
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						 $cmbModul
						</div>", 
						 ),
			'spek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>175, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'rencanaPengembangan' id = 'rencanaPengembangan' style='width:575px;height:75px;' ></textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'speasdk' => array( 
						'label'=>'SPESIFIKASI',
						'labelWidth'=>175, 
						'value'=>"", 
						 ),
			'sasdasdpek' => array( 
						'label'=>'SPESIFIKASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'spesifikasi' id = 'spesifikasi' style='width:575px;height:75px;' ></textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".saveAplikasi()' title='Simpan' > &nbsp".
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
	 $this->form_height = 260;
	 $this->form_caption = 'EDIT';	
	 
	 $got = mysql_fetch_array(mysql_query("select * from rencana_pengembangan where id = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}


	$arr = array(	
			array('BELUM','BELUM'),		
			array('SUDAH','SUDAH'),		
			);
	 $cmbStatus = cmbArray('cmbStatus',$status,$arr,'-- STATUS --','');
	 $queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
	 
     $cmbModul =  cmbQuery('cmbModul',$id_modul,$queryCmbModul,"",'-- Semua Modul --');
	

	$mulai = explode('-',$mulai);
	$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];

	 $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'","style='width:300;' onchange=$this->Prefix.aplikasiChanged();",'-- Pilih Aplikasi --'); //items ----------------------
	  	
	
	 $this->form_fields = array(
	 		
			
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						 $cmbModul
						</div>"), 
			'spek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>175, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'rencanaPengembangan' id = 'rencanaPengembangan' style='width:575px;height:75px;' >$rencana_pengembangan</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'speasdk' => array( 
						'label'=>'SPESIFIKASI',
						'labelWidth'=>175, 
						'value'=>"", 
						 ),
			'sasdasdpek' => array( 
						'label'=>'SPESIFIKASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'spesifikasi' id = 'spesifikasi' style='width:575px;height:75px;' >$spesifikasi</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			
				
			
			);
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick =".$this->Prefix.".editAplikasi('".$dt."') title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
	function updateStatus($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 150;
	 $this->form_caption = 'UPDATE STATUS';	
	
	
	 $got = mysql_fetch_array(mysql_query("select * from rencana_pengembangan where id = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $arrayStatus = array(	
			array('BELUM','BELUM'),		
			array('PROSES','PROSES'),		
			array('SUDAH','SUDAH'),		
			);
	 $cmbCheck = cmbArray('cmbCheck',$status,$arrayStatus,'-- STATUS --',"onchange = $this->Prefix.checkedChanged()");
	 if(!empty($selesai)){
	 	$selesai = explode('-',$selesai);
		$selesai = $selesai[2]."-".$selesai[1]."-".$selesai[0];
	 }
	 if(!empty($mulai)){
	 	$mulai = explode('-',$mulai);
		$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];
	 }
	 $this->form_fields = array(
			'nama' => array( 
						'label'=>'TARGET ',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='target'   id='target' value='".$target."'  style='width:100px;text-align:left;'>
						</div>", 
						 ),
	 		'check' => array( 
						'label'=>'STATUS',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
								$cmbCheck
						</div>", 
						 ),
			'mulai' => array( 
						'label'=>'MULAI',
						'labelWidth'=>100, 
						'value'=>"<input type = 'text' name='mulai' id='mulai' value='".date("d-m-Y")."'>", 
						 ),
			'lama' => array( 
						'label'=>'LAMA',
						'labelWidth'=>100, 
						'value'=>"<input style='width:30px;' type = 'text' name='lama' id='lama'> &nbsp Hari", 
						 ),
			'stKorek' => array( 
						'label'=>'TANGGAL SELESAI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
								<input type = 'text' name='tanggalSelesai' id = 'tanggalSelesai' value='$selesai' >
						</div>", 
						 ),
			'mulai' => array( 
						'label'=>'MULAI',
						'labelWidth'=>100, 
						'value'=>"<input type = 'text' name='mulai' id='mulai' value='$mulai'>", 
						 ),
			'lama' => array( 
						'label'=>'LAMA',
						'labelWidth'=>100, 
						'value'=>"<input style='width:30px;' type = 'text' name='lama' id='lama' value='$lama'> &nbsp Hari", 
						 )
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Reset' onclick ='".$this->Prefix.".resetCheck()' title='Reset' > &nbsp".
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

		  
		   <th class='th01' width = '700' >RENCANA PENGEMBANGAN</th>	
		   <th class='th01' width = '200' >SPESIFIKASI</th>	
		   <th class='th01' width = '120' >TARGET</th>	
		   <th class='th01' width = '150' >WAKTU</th>	
		   <th class='th01' width = '50' >STATUS</th>	

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
	 $namaPemda = mysql_fetch_array(mysql_query("select * from rencana_pengembangan where id = '$id_pemda'"));
	 $namaPemda = $namaPemda['nama_pemda'];
	 
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from rencana_pengembangan where id = '$id_aplikasi'"));
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
	
	function showKoreksirencana_pengembangan($dt){	
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
						".$getKoreksi['koreksi_rencana_pengembangan']."
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
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_rencana_pengembangan where id_rincian_pekerjaan = '$dt'"));

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
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi orencana_pengembanganer by id_modul,spesifikasi,keterangan");
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
					$action  = "<img src='images/rencana_pengembanganistrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/rencana_pengembanganistrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";
					
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
					<table class='koptable' style='width:100%;' borencana_pengembanganer='1' id='tabelRincianPekerjaan'>
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
	 
	 /*$getNamaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul ='0'"));
	 $namaAplikasi = $getNamaAplikasi['nama_aplikasi'];*/

	 if($this->lastIdAplikasi == $id_aplikasi)$namaAplikasi = "";
	 //$Koloms[] = array('align="left"',$namaAplikasi);
	 $this->lastIdAplikasi = $id_aplikasi;
	 $grabModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul = '0'"));
	 $namaModul = $grabModul['nama_aplikasi'];
	 $grabProgramer = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$id_programer'"));
	 $namaProgramer = $grabProgramer['nama'];
	 $modulProgramer = "<b>".$namaModul."</b> / ".$namaProgramer."<br>";
	 if($this->concatAplikasiModul == $id_aplikasi.".".$id_modul){
	 	$modulProgramer = "";
	 }
	 $Koloms[] = array('align="left"',$modulProgramer."<span style='margin-left:15px;'>".str_replace("\n","<br>",$rencana_pengembangan)."</span><br><span style='margin-left:15px;'>( ".$user." )</span>");
	 $this->concatAplikasiModul = $id_aplikasi.".".$id_modul;
	 $Koloms[] = array('align="left"',str_replace("\n","<br>",$spesifikasi));
	 $Koloms[] = array('align="left"',$this->GenerateBulan($target));
	 if(!empty($lama))$lama = "/ $lama Hari";
	 $Koloms[] = array('align="left"',VulnWalkerTitiMangsa($mulai)." $lama<br>".VulnWalkerTitiMangsa($selesai));
	 $Koloms[] = array('align="center"',"<span style='cursor:pointer;color:red;' onclick='$this->Prefix.updateStatus(".$isi['id'].");'>$status</span>");


	 
	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd, $fmSKPDUrusan;
	 
	$baris = $_REQUEST['baris'];
	$id_aplikasi = $_REQUEST['cmbAplikasi'];
	$cmbProgramer = $_REQUEST['cmbProgramer'];
	$cmbStatus = $_REQUEST['cmbStatus'];
	$filterTarget = $_REQUEST['filterTarget'];
	
	/*if(!isset($_REQUEST['filterTarget'])){
		$filterTarget = date('m-Y');
	}*/
	$filterModul = $_REQUEST['filterModul'];
	if ($baris == ''){
		$baris = "25";		
	}
	$cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'","' onchange=$this->Prefix.refreshList(true);",'-- Semua Aplikasi --'); //items ----------------------
	$comboProgramer = cmbQuery('cmbProgramer',$cmbProgramer,"select Id,nama from ref_pegawai ","' onchange=$this->Prefix.refreshList(true);",'-- Semua Programer --'); //items ----------------------
	
	$arr = array(	
			array('BELUM','BELUM'),		
			array('PROSES','PROSES'),		
			array('SUDAH','SUDAH'),		
			);
	 $comboStatus = cmbArray('cmbStatus',$cmbStatus,$arr,'-- SEMUA STATUS --',"onchange= $this->Prefix.refreshList(true)");  	
	 $queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
	 $comboModul =  cmbQuery('filterModul',$filterModul,$queryCmbModul,"onchange = $this->Prefix.refreshList(true)",'-- Semua Modul --');
	$TampilOpt = 
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td style='width:1%;'>APLIKASI </td>
			<td style='width:1%;'>: </td>
			<td style='width:90%;' >$cmbAplikasi </td>
			</tr>
			<tr>
			<td style='width:1%;'>MODUL </td>
			<td style='width:1%;'>: </td>
			<td style='width:90%;' >$comboModul </td>
			</tr>
			<tr>
			<td style='width:1%;'>PROGRAMER </td>
			<td style='width:1%;'>: </td>
			<td style='width:90%;' >$comboProgramer &nbsp TARGET : &nbsp <input type='text' name='filterTarget'  id='filterTarget' value='".$filterTarget."' onChange= '$this->Prefix.refreshList(true)'  style='width:60px;text-align:left;'> &nbsp STATUS &nbsp : &nbsp $comboStatus &nbsp <input type='button' value ='Tampilkan' onclick =$this->Prefix.refreshList(true);></td>
			</tr>



			
			
			
			</table>".
			"</div>";
			
		return array('TampilOpt'=>$TampilOpt);
	}			
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
		$cmbAplikasi = $_REQUEST['cmbAplikasi'];
		$cmbStatus = $_REQUEST['cmbStatus'];
		$filterTarget = $_REQUEST['filterTarget'];
		$filterModul = $_REQUEST['filterModul'];
		$cmbProgramer = $_REQUEST['cmbProgramer'];
		/*if(!isset($_REQUEST['filterTarget'])){
			$filterTarget = date('m-Y');
		}*/
		$getAll = mysql_query("select * from rencana_pengembangan");
		while($baris = mysql_fetch_array($getAll)){
				
			$concat = $baris['id_aplikasi'].".".$baris['id_modul'];
			$getDataAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where concat(kode_aplikasi,'.',kode_modul) = '$concat' and kode_sub_modul = '0' "));
			$data = array('id_programer' => $getDataAplikasi['id_programer']);
			mysql_query(VulnWalkerUpdate("rencana_pengembangan",$data,"id = '".$baris['id']."'"));
		}
		if(!empty($cmbProgramer)){
			/*$blockList = array();
			$grabModul = mysql_query("select * from ref_aplikasi where kode_modul != '0' and kode_sub_modul = '0' and id_programer !='$cmbProgramer'");
			while($rows = mysql_fetch_array($grabModul)){
				foreach ($rows as $key => $value) { 
				  $$key = $value; 
				}
				$concatBlock = $kode_aplikasi.".".$kode_modul;
				$blockList[] = $concatBlock;
			}
			
			$getAll = mysql_query("select * from rencana_pengembangan");
			while($baris = mysql_fetch_array($getAll)){
				
				$concat = $baris['id_aplikasi'].".".$baris['id_modul'];
				if(in_array($concat,$blockList)){
					$arrKondisi[]  = "concat(id_aplikasi,'.',id_modul) != '$concat'";
				}
			}*/
			$arrKondisi[] = "id_programer = '$cmbProgramer'";
			
		}
		if(!empty($cmbAplikasi))$arrKondisi[] = "id_aplikasi = '$cmbAplikasi'";
		if(!empty($filterModul))$arrKondisi[] = "id_modul = '$filterModul'";
		if(!empty($cmbStatus))$arrKondisi[] = "status = '$cmbStatus'";
		if(!empty($filterTarget))$arrKondisi[] = "target = '$filterTarget'";
		
		
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		

			$Order= join(',',$arrOrders);	

			$OrderDefault = " Order By concat(id_aplikasi,'.',right((100 +id_modul),2),'.',target) asc ";// Order By no_terima desc ';
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
	
function tabelRencanaPengembangan(){

			
		$aksi = '<a href="javascript:rencana_pengembangan.newrincian_pekerjaan()" id="pengguna_aplikasiAtasButton"><img id="gambarAtasButton" src="datepicker/add-256.png" style="width:20px;height:20px;"></a>';
	
		$content2 = 
					"
					
					RINCIAN PEKERJAAN :
					<table class='koptable' style='width:100%;' border='1' id='tabelRincianPekerjaan'>
						<tr>
								<th class='th01'>NO</th>
								<th class='th01'>RENCANA PENGEMBANGAN</th>
	
								<th class='th01'>$aksi</th>	
							
						</tr>
						$datanya
					</table>
					"
				
				;
		return $content2;
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
	
	
	function newrincian_pekerjaan(){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 520;
	 $this->form_height = 150;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	 	$this->form_caption = 'BARU';

		
	 //items ----------------------
	  $this->form_fields = array(


			'spek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>175, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'rencanaPengembangan' id = 'rencanaPengembangan' style='width:475px;height:50px;' ></textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'mulai' => array( 
						'label'=>'MULAI',
						'labelWidth'=>100, 
						'value'=>"<input type = 'text' name='mulai' id='mulai' value='".date("d-m-Y")."'>", 
						 ),
			'selesai' => array( 
						'label'=>'SELESAI',
						'labelWidth'=>100, 
						'value'=>"<input type = 'text' name='selesai' id='selesai' value='".date("d-m-Y")."'>", 
						 ),
							 			
				
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Saverincian_pekerjaan()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormKB();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function editrincian_pekerjaan($id){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 520;
	 $this->form_height = 150;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	 	$this->form_caption = 'EDIT';
		
		
		$getData = mysql_fetch_array(mysql_query("select * from temp_rencana_pengembangan where id = '$idTemp'"));
		foreach ($getData as $key => $value) { 
				  $$key = $value; 
				}
		$mulai = explode('-',$mulai);
					$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];
					$selesai = explode('-',$selesai);
					$selesai = $selesai[2]."-".$selesai[1]."-".$selesai[0];

		
	 //items ----------------------
	 $this->form_fields = array(


			'spek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>175, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RENCANA PENGEMBANGAN',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'rencanaPengembangan' id = 'rencanaPengembangan' style='width:475px;height:50px;' >$rencana_pengembangan</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			 'mulai' => array( 
						'label'=>'MULAI',
						'labelWidth'=>100, 
						'value'=>"<input type = 'text' name='mulai' id='mulai' value='".$mulai."'>", 
						 ),
			'selesai' => array( 
						'label'=>'SELESAI',
						'labelWidth'=>100, 
						'value'=>"<input type = 'text' name='selesai' id='selesai'  value='".$selesai."'>", 
						 ),				 			
				
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Editrincian_pekerjaan($idTemp)' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormKB();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}

	function Hapus($ids){ //validasi hapus ref_kota
		 $err=''; $cek='';
		for($i = 0; $i<count($ids); $i++)	{
		

			if($err=='' ){
					$qy = "DELETE FROM $this->TblName_Hapus WHERE id='".$ids[$i]."' ";$cek.=$qy;
					$qry = mysql_query($qy);
					mysql_query("delete from detail_rencana_pengembangan where id_rencana_pengembangan ='".$ids[$i]."'");
						
			}else{
				break;
			}			
		}
		return array('err'=>$err,'cek'=>$cek);
	}
	function GenerateBulan($date) { 
    $BulanIndo    = array("Januari", "Februari", "Maret","April", "Mei", "Juni","Juli", "Agustus", "September","Oktober", "November", "Desember");
    $tahun        = substr($date, 3, 4); 
    $bulan        = substr($date, 0, 2); 
 
    $result       = $BulanIndo[(int)$bulan-1]." ".$tahun;
    return($result);
}
}
$rencana_pengembangan = new rencana_pengembanganObj();
$rencana_pengembangan->username = $_COOKIE['coID'];
?>