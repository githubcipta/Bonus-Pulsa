<?php

class pemdaObj  extends DaftarObj2{	
	var $Prefix = 'pemda';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'rincian_pekerjaan'; //bonus
	var $TblName_Hapus = 'rincian_pekerjaan';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //bepemdaasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//bepemdaasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'PURCHASING ORDER PEMDA';
	var $PageIcon = 'images/masterdata_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='pemda.xls';
	var $namaModulCetak='PURCHASING OpemdaER pemda';
	var $Cetak_Judul = 'DAFTAR pemda';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'pemdaForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'PURCHASING ORDER PEMDA';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if($pemda !='2'){
			return
				"<td>".genPanelIcon("javascript:".$this->Prefix.".checkpemda()","sections.png","Check Pemda", 'Check Pemda')."</td>"
				/*"<td>".genPanelIcon("javascript:".$this->Prefix.".infoSpesifikasi()","info.png","INFO SPEK", 'INFO SPEK')."</td>"*/;
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
	 if( $err=='' && $namapemda =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_pemda (c1,c,d,nama_pemda,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namapemda','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_pemda (c1,c,d,nama_pemda,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namapemda','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_pemda set  nama_pemda ='$namapemda', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
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
		
		case 'checkpemda':{	
					
			$dt = $_REQUEST['pemda_cb'];	
			$fm = $this->checkpemda($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['pemda_cb'];	
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
			
				$grabSpekData = mysql_fetch_array(mysql_query("select * from rincian_pekerjaan where id = '$idSpek'"));
				
				$data = array(
								'id_po' => $grabSpekData['id_parent'],
								'id_rincian_pekerjaan' => $idSpek,
								'koreksi' => $koreksiPemda,
								'keterangan' => $keterangan
				);
				
				if(mysql_num_rows(mysql_query("select * from cek_pemda where id_rincian_pekerjaan = '$idSpek'")) == 0){
					mysql_query(VulnWalkerInsert('cek_pemda',$data));
				}else{
					mysql_query(VulnWalkerUpdate('cek_pemda',$data,"id_rincian_pekerjaan = '$idSpek'"));
				}
				
				if(!empty($koreksiPemda)){
					$dataKoreksi = array(
											'id_rincian_pekerjaan' =>$idSpek,
											'koreksi' => $koreksiPemda,
											'koreksi_dari' => "PEMDA",
											'username' => $this->username,
											'tanggal' => date('Y-m-d')
										
										);
					mysql_query(VulnWalkerInsert('tabel_koreksi',$dataKoreksi));
					
					$getDataBarusan = mysql_fetch_array(mysql_query("select max(id) from tabel_koreksi where id_rincian_pekerjaan = '$idSpek'"));
					$dataRequest = array(
											'id_sumber' => $grabSpekData['id_parent'],
											'id_koreksi' => $getDataBarusan['max(id)'],
											'username' => $this->username,
											'tanggal' => date('Y-m-d')
										);
					mysql_query(VulnWalkerInsert("t_request",$dataRequest));
					
					
					$dataSetUncheckedRd = array('rd' => 'TIDAK',
												'mt' => 'TIDAK'
												);
					mysql_query(VulnWalkerUpdate('cek_rd',$dataSetUncheckedRd,"id_rincian_pekerjaan = '$idSpek'"));
					
				}else{
					
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
		if($pemda != '1' && $pemda !='2'){
		
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
			<script type='text/javascript' src='js/po/".$this->Prefix.".js' language='JavaScript' ></script>".
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

		if($cnt['cnt'] > 0) $err = "pemda Tidak Bisa Diubah ! Sudah Digunakan Di Ref Barang.";
		if($err == ''){
			$aqry = "SELECT * FROM  ref_pemda WHERE id='".$this->form_idplh."' "; $cek.=$aqry;
			$dt = mysql_fetch_array(mysql_query($aqry));
			$fm = $this->setForm($dt);
		}
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}	
		
	function checkpemda($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 250;
	 $this->form_caption = 'CHECK PEMDA';	
		  $getDataPemda = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$dt'"));
		 if(empty($getDataPemda['koreksi_pemda']) || $getDataPemda['koreksi_pemda'] == ' '){
		 	$statusKoreksi = "TIDAK";
		 }else{
		 	$statusKoreksi = "YA";
			$koreksiPemda = $getDataPemda['koreksi_pemda'];
		 }

	
	 $got = mysql_fetch_array(mysql_query("select * from cek_pemda where id_rincian_pekerjaan = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal = explode('-',$tanggal);
	 $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	 $arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);


	 
	 $this->form_fields = array(

			'hasilKoreksiPemda' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>120, 
						'value'=> "",
						 
						 ),
			'hasilKoreksiPem213da' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<textarea  name='koreksiPemda'  id='koreksiPemda'  placeholder='Koreksi Pemda' style='width:450px;height:75px;'>$koreksi</textarea>
						</div>",
						'type' => 'merge'
						 ),	
			'hasilK12312oreksiPemda' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "" 
						 ),		
			'hasilK12312or12321eksiPemda' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<textarea  name='keterangan'  id='keterangan'  placeholder='KETERANGAN' style='width:450px;height:75px;'>$keterangan</textarea>
						</div>",
						'type' => 'merge'
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
	   <th class='th01' width='500' >NAMA PEMDA / NAMA PEKERJAAN</th>	
	   <th class='th01' width='400'>RINCIAN PEKERJAAN</th>	
	   <th class='th01' width='120'>TARGET</th>
	   <th class='th01' width='50'>URL INSTALL</th>	
	   <th class='th01' width='50'>KOREKSI</th>	
	   <th class='th01' width='50'>KETERANGAN</th>	

	
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
	 $this->form_caption = 'KOREKSI MAINTENCE';	
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_pemda where id_rincian_pekerjaan = '$dt'"));

	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'KOREKSI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						".$getKoreksi['koreksi_mt']."
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
	 $getKoreksi = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$dt'"));

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
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi opemdaer by id_modul,spesifikasi,keterangan");
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
					<table class='koptable' style='width:100%;' bopemdaer='1' id='tabelRincianPekerjaan'>
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
	 
	 $getPO = mysql_fetch_array(mysql_query("select * from po where id='$id_parent'"));
	 foreach ($getPO as $key => $value) { 
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
	 
	
	 
	 $Koloms.= "<td class='$cssclass' align='center'>".$no.'.'."</td>"; 
	 $Koloms.= "<td class='$cssclass' align='center'>".$TampilCheckBox."</td>"; 		
	 $getkategori = mysql_fetch_array(mysql_query("select * from ref_kategori where id = '$id_kategori'"));
	 $namaKategori = $getkategori['nama'];
	 $getNamaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$id_pemda'"));
	 $namaPemda = $getNamaPemda['nama_pemda'];
	 $getModul = mysql_fetch_array(mysql_query("select * from ref_modul where id='".$isi['id_modul']."'"));
	 $namaModul = $getModul['nama_modul'];
	 if($id_parent == $this->hublaConcat){
	 	$namaPemda = "";
		$nama_kegiatan = "";
	 }
	 $Koloms.= "<td class='$cssclass' align='left'>"."<b>".$namaPemda."</b><br> &nbsp".$nama_kegiatan."<br>".VulnWalkerTitiMangsa($tanggal_po)."</td>";
	
	 if($id_parent == $this->hublaConcat && $id_modul == $this->modulConcat){
	 	$namaModul = "";
	 }else{
	 	 $getModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_modul='".$isi['id_modul']."' and kode_aplikasi = '".$getPO['id_aplikasi']."' and kode_sub_modul = '0'"));
	 	 $namaModul = "<b>".$getModul['nama_aplikasi']."</b> <br>";
		 if($id_modul == '0')$namaModul="<b>NON MODUL</b> <br>";
	 }	
	  $this->hublaConcat = $id_parent;
	 $this->modulConcat = $id_modul;
	 $Koloms.= "<td class='$cssclass' align='left'>$namaModul &nbsp ".str_replace("\n","<br> &nbsp ",$rincian_pekerjaan)."</td>";
	 
	  $Koloms.= "<td class='$cssclass' align='left'>".VulnWalkerTitiMangsa($target_selesai)."</td>";
	  $getDataRD = mysql_fetch_array(mysql_query("select * from cek_mt where id_rincian_pekerjaan = '".$isi['id']."'"));
	 foreach ($getDataRD as $key => $value) { 
			  $$key = $value; 
			}
	 $Koloms.= "<td class='$cssclass' align='left'>"."<a href='$url_install' target='_blank'>$url_install</a>"."</td>";
	 
	 
	 
	 
	 $getDataPemda = mysql_fetch_array(mysql_query("select * from cek_pemda where id_rincian_pekerjaan = '".$isi['id']."'"));
	 foreach ($getDataPemda as $key => $value) { 
			  $$key = $value; 
			}

	 

	 $Koloms.= "<td class='$cssclass' align='left'>".$getDataPemda['koreksi']."</td>";
	 $Koloms.= "<td class='$cssclass' align='left'>".$getDataPemda['keterangan']."</td>";
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
		$grabingAll = mysql_query("select * from rincian_pekerjaan");
		while($rows = mysql_fetch_array($grabingAll)){
			if(in_array($rows['id_parent'],$arrayParent)){
					
				}else{
					$arrayParent[] = $rows['id_parent'];
				}
			if(mysql_num_rows(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '".$rows['id']."' and mt = 'OK'")) == 0){
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
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Opemdaer -------------------------------------
		$fmOpemdaER1 = cekPOST('fmOpemdaER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOpemdaers = array();
		$arrOpemdaers[] = "id_modul,spesifikasi,keterangan";
/*		switch($fmOpemdaER1){
			case '1': $arrOpemdaers[] = " nama_pemda $Asc1 " ;break;
			case '2': $arrOpemdaers[] = " alamat $Asc1 " ;break;
			case '3': $arrOpemdaers[] = " kota $Asc1 " ;break;
			case '4': $arrOpemdaers[] = " nama_pimpinan $Asc1 " ;break;
			case '5': $arrOpemdaers[] = " no_npwp $Asc1 " ;break;
			case '6': $arrOpemdaers[] = " c $Asc1 " ;break;
		}	*/
		
		$Opemdaer= join(',',$arrOpemdaers);	
		$Opemdaepemdaefault = '';// Opemdaer By no_terima desc ';
		$Opemdaer =  $Opemdaer ==''? $Opemdaepemdaefault : ' Opemdaer By '.$Opemdaer;
		//$Opemdaer ="";
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
		
		return array('Kondisi'=>$Kondisi, 'Opemdaer'=>$Opemdaer ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
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
		
			$a = "SELECT count(*) as cnt, aa.pemda_terbesar, aa.pemda_terkecil, bb.nama, aa.f, aa.g, aa.h, aa.i, aa.j FROM ref_barang aa INNER JOIN ref_pemda bb ON aa.pemda_terbesar = bb.nama OR aa.pemda_terkecil = bb.nama WHERE bb.nama='".$ids[$i]."' "; $cek .= $a;
		$aq = mysql_query($a);
		$cnt = mysql_fetch_array($aq);
		
		if($cnt['cnt'] > 0) $err = "pemda ".$ids[$i]." Tidak Bisa DiHapus ! Sudah Digunakan Di Ref Barang.";
		
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
$pemda = new pemdaObj();
$pemda->username = $_COOKIE['coID'];
?>