<?php

class administrasiObj  extends DaftarObj2{	
	var $Prefix = 'administrasi';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'po'; //bonus
	var $TblName_Hapus = 'po';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'PURCHASING ORDER ADMINISTRASI';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='administrasi.xls';
	var $namaModulCetak='PURCHASING ORDER ADMINISTRASI';
	var $Cetak_Judul = 'DAFTAR administrasi';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'administrasiForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $username = '';
	
	function setTitle(){
		return 'PURCHASING ORDER ADMINISTRASI';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if($administrasi !='2'){
			return
				"<td>".genPanelIcon("javascript:".$this->Prefix.".checkAdmin()","sections.png","Check Admin", 'Check Admin')."</td>".
				"<td>".genPanelIcon("javascript:".$this->Prefix.".infoSpesifikasi()","info.png","INFO SPEK", 'INFO SPEK')."</td>";
		}else{
			return
				
				"<td>".genPanelIcon("javascript:".$this->Prefix.".infoSpesifikasi()","info.png","INFO SPEK", 'INFO SPEK')."</td>";
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
	 if( $err=='' && $namaadministrasi =='' || $alamatLengkap == '' || $kota == '' || $nama_pimpinan = ''  ) $err= 'Lengkapi !!';
	 
			if($fmST == 0){
				if($err==''){
					if ($_COOKIE['cofmSKPD'] != '00' && $_COOKIE['cofmSKPD'] != '') {
$kueBidang = $_COOKIE['cofmSKPD'];
$kueSKPD = $_COOKIE['cofmUNIT'];
					$aqry = "INSERT into ref_administrasi (c1,c,d,nama_administrasi,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$kueBidang','$kueSKPD','$namaadministrasi','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;	
					}else{
					$aqry = "INSERT into ref_administrasi (c1,c,d,nama_administrasi,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$namaadministrasi','$alamatLengkap','$kota','$nama_pimpinan_2','$nomorNPWP','$nama_bank','$norek_bank','$atasnama_bank')";	$cek .= $aqry;		
					}

					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){

				$aqry = "UPDATE ref_administrasi set  nama_administrasi ='$namaadministrasi', alamat = '$alamatLengkap', kota = '$kota', nama_pimpinan = '$nama_pimpinan_2', no_npwp = '$nomorNPWP', nama_bank = '$nama_bank', norek_bank = '$norek_bank', atasnama_bank = '$atasnama_bank'  WHERE id='".$idplh."'";	$cek .= $aqry;
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
		
		case 'checkAdmin':{	
					
			$dt = $_REQUEST['administrasi_cb'];	
			$fm = $this->checkAdmin($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['administrasi_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'saveCheck':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			if(empty($cmbRAB)){
				$err = "Pilih Status RAB";
			}elseif(empty($cmbKAK)){
				$err = "Pilih Status KAK";
			}elseif(empty($cmbBerkasTagihan)){
				$err = "Pilih Status Berkas Tagihan";
			}elseif(empty($cmbLaporan)){
				$err = "Pilih Status Laporan";
			}elseif(empty($cmbSP2D)){
				$err = "Pilih Status SP2D";
			}elseif(empty($cmbPajak)){
				$err = "Pilih Status Pajak";
			}elseif(empty($keterangan)){
				$err = "Isi keterangan";
			}else{
				$data = array(
								'id_po' => $nomor_po,
								'rab' => $cmbRAB,
								'kak' => $cmbKAK,
								'berkas_tagihan' => $cmbBerkasTagihan,
								'laporan' => $cmbLaporan,
								'sp2d' => $cmbSP2D,
								'pajak' => $cmbPajak,
								'keterangan' => $keterangan,
								'tanggal_update' => date('Y-m-d'),
								'username' => $this->username
							);
				if(mysql_num_rows(mysql_query("select * from cek_admin where id_po = '$nomor_po'")) == 0){
					mysql_query(VulnWalkerInsert('cek_admin',$data));
				}else{
					mysql_query(VulnWalkerUpdate('cek_admin',$data,"id_po ='$nomor_po'"));
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
		if($administrasi != '1' && $administrasi !='2'){
		
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

		if($cnt['cnt'] > 0) $err = "administrasi Tidak Bisa Diubah ! Sudah Digunakan Di Ref Barang.";
		if($err == ''){
			$aqry = "SELECT * FROM  ref_administrasi WHERE id='".$this->form_idplh."' "; $cek.=$aqry;
			$dt = mysql_fetch_array(mysql_query($aqry));
			$fm = $this->setForm($dt);
		}
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}	
		
	function checkAdmin($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 200;
	 $this->form_caption = 'CHECK ADMINISTRASI';	
	
	
	 $got = mysql_fetch_array(mysql_query("select * from cek_admin where id_po = '$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal = explode('-',$tanggal);
	 $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	 $arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
	 if(empty($rab))$rab="TIDAK";
	 if(empty($kak))$kak="TIDAK";
	 if(empty($berkas_tagihan))$berkas_tagihan="TIDAK";
	 if(empty($laporan))$laporan="TIDAK";
	 if(empty($sp2d))$sp2d="TIDAK";
	 if(empty($pajak))$pajak="TIDAK";
	 $cmbRAB = cmbArray('cmbRAB',$rab,$arrayStatus,'-- STATUS RAB --','style="width:150;"');
	 $cmbKAK = cmbArray('cmbKAK',$kak,$arrayStatus,'-- STATUS KAK --','style="width:150;"');
	 $cmbBerkasTagihan = cmbArray('cmbBerkasTagihan',$berkas_tagihan,$arrayStatus,'-- STATUS BERKAS TAGIHAN --','style="width:200;"');
	 $cmbLaporan = cmbArray('cmbLaporan',$laporan,$arrayStatus,'-- STATUS LAPORAN --','style="width:150;"');
	 $cmbSP2D = cmbArray('cmbSP2D',$sp2d,$arrayStatus,'-- STATUS SP2D --','style="width:150;"');
	 $cmbPajak = cmbArray('cmbPajak',$pajak,$arrayStatus,'-- STATUS PAJAK --','style="width:150;"');
	 
	 $getNomorPO = mysql_fetch_array(mysql_query("select * from po where id = '$dt'"));
	 $nomorPo = $getNomorPO['nomor_po'];
	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'NOMOR PO',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text'  value='".$nomorPo."' placeholder='NOMOR PO' readonly style='width:100px;'>
						<input type='hidden' name='nomor_po' id='nomor_po' value='".$dt."' placeholder='NOMOR PO' readonly style='width:100px;'>
						</div>", 
						 ),
	 		'rab' => array( 
						'label'=>'RAB',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbRAB
						</div>", 
						 ),
	 		'kak' => array( 
						'label'=>'KAK',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbKAK
						</div>", 
						 ),
			'tagihan' => array( 
						'label'=>'BERKAS TAGIHAN',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbBerkasTagihan
						</div>", 
						 ),
			'laporan' => array( 
						'label'=>'LAPORAN',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbLaporan
						</div>", 
						 ),
			'sp2d' => array( 
						'label'=>'SPD2',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbSP2D
						</div>", 
						 ),
			'pajak' => array( 
						'label'=>'PAJAK',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
								$cmbPajak
						</div>", 
						 ),
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='keterangan'  id='keterangan' value='".$keterangan."' placeholder='Keterangan' style='width:300px;'>
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
  	   <th class='th01' width='50'  rowspan='2'>NOMOR PO</th>	
  	   $Checkbox	
  	   <th class='th01' width='110' rowspan='2'>TANGGAL</th>	
	   <th class='th01' width='100' rowspan='2'>KATEGORI / NAMA PEMDA</th>	
	   <th class='th01' width='500' rowspan='2'>NAMA PEKERJAAN</th>	
	   <th class='th01' width='80' rowspan='2'>NILAI</th>	
	   <th class='th01' width='110' rowspan='2'>TARGET SELESAI</th>	
	   <th class='th02' width='50' rowspan='1' colspan ='2'>KONTAK</th>
	   <th class='th01' width='50' rowspan='2'>RAB</th>	
	   <th class='th01' width='50' rowspan='2'>KAK</th>	
	   <th class='th01' width='50' rowspan='2'>BERKAS TAGIHAN</th>	
	   <th class='th01' width='50' rowspan='2'>LAPORAN</th>	
	   <th class='th01' width='50' rowspan='2'>SP2D</th>	
	   <th class='th01' width='50' rowspan='2'>PAJAK</th>	
	   <th class='th01' width='50' rowspan='2'>KET</th>	
	
	   </tr>
	   	 	
	   <tr>
	   	<th class='th01' width='50' >NAMA</th>	
	   	 <th class='th01' width='50' >TELEPON</th>
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
	 $this->form_caption = 'INFO RINCIAN PEKERJAAN';	

	 $got = mysql_fetch_array(mysql_query("select * from po where id ='$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $namaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$id_pemda'"));
	 $namaPemda = $namaPemda['nama_pemda'];
	 
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '0'"));
	 $namaAplikasi = $namaAplikasi['nama_aplikasi'];
	 
	 $namaKategori = mysql_fetch_array(mysql_query("select * from ref_kategori where id = '$id_kategori'"));
	 $namaKategori = $namaKategori['nama'];
	 
	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'NOMOR PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						$nomor_po
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
	
	function tabelRincianPekerjaan($nomor_po){
				$header = "<tr>
								<th class='th01' width='20'>NO</th>
								<th class='th01' width='200'>MODUL</th>
								<th class='th01' width='600'>RINCIAN PEKERJAAN</th>
								<th class='th01' width='400'>KETERANGAN</th>	
							
						</tr>";
						
						
				//getDaftar
				$arrKondisi = array();
				$grabingAll = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' ");
				while($wor = mysql_fetch_array($grabingAll)){
					foreach ($wor as $key => $value) { 
					  $$key = $value; 
					}
					if(empty($keterangan)){
						if(mysql_num_rows(mysql_query("select * from rincian_pekerjaan where id_parent = '$nomor_po' and id_parent='$nomor_po' and keterangan !='' ")) == 0){
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
				$query = mysql_query("select * from rincian_pekerjaan where  id_parent = '$nomor_po' $kondisi order by id_modul,rincian_pekerjaan,keterangan");
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
					
					$getIdAplikasi = mysql_fetch_array(mysql_query("select * from po where id = '$id_parent'"));
					$id_aplikasi = $getIdAplikasi['id_aplikasi'];
					$getNamaModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul = '0'"));
					$namaModul = $getNamaModul['nama_aplikasi'];
					if($id_modul == '0'){
						$namaModul = "NON MODUL";
					}
					if($lastIDModul == $id_modul){
						$namaModul = "";
					}
					
					$isi =  "	
							<tr class='$tergantung'>
								<td align='center'>$no.</td>
								<td>$namaModul</td>
								<td>$rincian_pekerjaan</td>
								<td>$keterangan</td>
			   				</tr>
				
					";
					$lastIDModul = $id_modul;						
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
	 
	 global $Ref;
	 foreach ($isi as $key => $value) { 
			  $$key = $value; 
			}
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"',$nomor_po);
	  
	 $nama_pegawai = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$dari'"));
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id = '$id_aplikasi'"));
	 $nama_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_modul'"));
	 $nama_sub_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_sub_modul'"));
	 
	 $getKontak = mysql_fetch_array(mysql_query("select * from pengguna_aplikasi where id_pemda = '$id_pemda' and id_aplikasi ='$id_aplikasi'"));
	 $kontak_admin = $getKontak['kontak_person_admin'];
	 $telepon_admin = $getKontak['telepon_admin'];
	 
	 
	 
	 $grabCheckAdmin = mysql_fetch_array(mysql_query("select * from cek_admin where id_po ='$id'"));
	 $statusRAB = $grabCheckAdmin['rab'];
	 $statusKAK = $grabCheckAdmin['kak'];
	 $statusBerkasTagihan = $grabCheckAdmin['berkas_tagihan'];
	 $statusLaporan = $grabCheckAdmin['laporan'];
	 $statusSP2D = $grabCheckAdmin['sp2d'];
	 $statusPajak = $grabCheckAdmin['pajak'];
	 $ket = $grabCheckAdmin['keterangan'];
	 
	 if($statusRAB == "OK"){
	 	$statusRAB = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusRAB = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 if($statusKAK == "OK"){
	 	$statusKAK = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusKAK = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 if($statusBerkasTagihan == "OK"){
	 	$statusBerkasTagihan = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusBerkasTagihan = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 if($statusLaporan == "OK"){
	 	$statusLaporan = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusLaporan = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 if($statusSP2D == "OK"){
	 	$statusSP2D = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusSP2D = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 if($statusPajak == "OK"){
	 	$statusPajak = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusPajak = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 
	 if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);

	 $Koloms[] = array('align="left"',VulnWalkerTitiMangsa($tanggal_po));
	 $getkategori = mysql_fetch_array(mysql_query("select * from ref_kategori where id = '$id_kategori'"));
	 $namaKategori = $getkategori['nama'];
	 $getNamaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$id_pemda'"));
	 $namaPemda = $getNamaPemda['nama_pemda'];
	 $Koloms[] = array('align="left"',"<b>".$namaKategori."</b><br>".$namaPemda);
	 $Koloms[] = array('align="left"',$nama_kegiatan);
	 
	 
	 $Koloms[] = array('align="right"',number_format($nilai,2,',','.'));
	 $Koloms[] = array('align="left"',VulnWalkerTitiMangsa($target_selesai));
	 $Koloms[] = array('align="left"',$kontak_admin);
	 $Koloms[] = array('align="left"',$telepon_admin);
	 $Koloms[] = array('align="center"',$statusRAB);
	 $Koloms[] = array('align="center"',$statusKAK);
	 $Koloms[] = array('align="center"',$statusBerkasTagihan);
	 $Koloms[] = array('align="center"',$statusLaporan);
	 $Koloms[] = array('align="center"',$statusSP2D);
	 $Koloms[] = array('align="center"',$statusPajak);
	 $Koloms[] = array('align="left"',$ket);
	 
	 return $Koloms;
	}
	


	function genDaftarOpsi(){
	 global $Ref, $Main;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
		
	
				
	$TampilOpt = 
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td>NAMA PEMDA </td>
			<td>:</td>
			<td style='width:90%;'> 
			<input type = 'text' name ='cariPemda' id ='cariPemda' value ='$cariPemda'> <input type='button' value ='Cari' onclick =$this->Prefix.refreshList(true);>
			</td>
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
		$cariPemda = $_REQUEST['cariPemda'];
		if(!empty($cariPemda)){
			$exc = mysql_query("select id from ref_pemda where nama_pemda like '%$cariPemda%' and kota !='0'");
			$connn = array();
			while($rows = mysql_fetch_array($exc)){
				$connn[] = " id_pemda = '".$rows['id']."'";
			}
			
			if(sizeof($jsjs) != 1){
				$jsjs = join(' or ',$connn);
				$arrKondisi[] = "( $jsjs )";
			}else{
				$arrKondisi[] = $connn[0];
			}
			
			
			
		}

		$arrKondisi[] = "id_pemda != ''";

		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
/*		switch($fmORDER1){
			case '1': $arrOrders[] = " nama_administrasi $Asc1 " ;break;
			case '2': $arrOrders[] = " alamat $Asc1 " ;break;
			case '3': $arrOrders[] = " kota $Asc1 " ;break;
			case '4': $arrOrders[] = " nama_pimpinan $Asc1 " ;break;
			case '5': $arrOrders[] = " no_npwp $Asc1 " ;break;
			case '6': $arrOrders[] = " c $Asc1 " ;break;
		}	*/
		$arrOrders[] = 'nomor_po';
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
		
			$a = "SELECT count(*) as cnt, aa.administrasi_terbesar, aa.administrasi_terkecil, bb.nama, aa.f, aa.g, aa.h, aa.i, aa.j FROM ref_barang aa INNER JOIN ref_administrasi bb ON aa.administrasi_terbesar = bb.nama OR aa.administrasi_terkecil = bb.nama WHERE bb.nama='".$ids[$i]."' "; $cek .= $a;
		$aq = mysql_query($a);
		$cnt = mysql_fetch_array($aq);
		
		if($cnt['cnt'] > 0) $err = "administrasi ".$ids[$i]." Tidak Bisa DiHapus ! Sudah Digunakan Di Ref Barang.";
		
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
$administrasi = new administrasiObj();
$administrasi->username = $_COOKIE['coID'];
?>