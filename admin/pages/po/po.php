<?php

class poObj  extends DaftarObj2{	
	var $Prefix = 'po';
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
	var $PageTitle = 'PURCHASING ORDER';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='po.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'pengguna_aplikasi';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'poForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	var $username = "";
	
	function setTitle(){
		return 'PURCHASING ORDER';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
			foreach ($getUserInfo as $key => $value) { 
				  $$key = $value; 
				}	
		if($po == '2'){
				return
			"";		
		}else{
				return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Order()","sections.png","PO", 'PO')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>";		
		}
	
	}
	
	function setMenuView(){
		return 
			"<td>".genPanelIcon("javascript:".$this->Prefix.".infoSpesifikasi()","info.png","Info", 'INFO')."</td>"
			.				
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Laporan()","print_f2.png",'Laporan',"Laporan")."</td>";		
			
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
	$nama= $_REQUEST['nm_pengguna_aplikasi'];
	

	//$ke = substr($ke,1,1);
	
								
	if($err==''){						
		
	$aqry = "UPDATE po set k='$dk',l='$dl',m='$dm',n='$dn',o='$do',nm_pengguna_aplikasi='$nama' where concat (k,' ',l,' ',m,' ',n,' ',o)='".$idplh."'";$cek .= $aqry;
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
		
		if(empty($cmbPemda)){
			$err = "Pilih Pemda";
		}elseif(empty($cmbAplikasi)){
			$err = "Pilih po";
		}elseif(empty($cmbModul)){
			$err = "Pilih Modul";
		}elseif(empty($cmbSubModul)){
			$err = "Pilih Sub Modul";
		}elseif(empty($uraian)){
			$err = "Isi Uraian";
		}elseif(empty($cmbValidasi)){
			$err = "Pilih Status Validasi";
		}

			if($fmST == 0){
				if($err == ''){
				
					if(mysql_num_rows(mysql_query("select * from po where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('po',$data));					
					}
					
					if(mysql_num_rows(mysql_query("select * from po where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul'  and id_sub_modul = '$cmbSubModul' ")) != 0){
						$err = "Data Sub Modul Sudah Ada";
					}else{
						$data = array(
									 	'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => $cmbSubModul,
										'uraian' => $uraian,
										'validasi' => $cmbValidasi,
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
										);
						mysql_query(VulnWalkerInsert('po',$data));	
					}

					
				}
			}else{	
					if(mysql_num_rows(mysql_query("select * from po where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('po',$data));					
					}
					
					/*if(mysql_num_rows(mysql_query("select * from po where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul'  and id_sub_modul = '$cmbSubModul' ")) != 0){
						$err = "Data Sub Modul Sudah Ada";
					}else{*/
						$data = array(
									 	'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => $cmbSubModul,
										'uraian' => $uraian,
										'validasi' => $cmbValidasi,
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
										);
						mysql_query(VulnWalkerUpdate('po',$data, "id = '$hubla'"));
						$cek = VulnWalkerUpdate('po',$data, "id = '$hubla'");	
					//}
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
				$get = mysql_fetch_array( mysql_query("select *, concat(k,'.',l,'.',m,'.',n,'.',o) as kodepengguna_aplikasi  from po where k='$k' AND l='$l' AND m='$m' AND n='$n' AND o='$o'"));
			
				
				$content = array('kode_pengguna_aplikasi' => $get['kodepengguna_aplikasi'], 'nm_pengguna_aplikasi' => $get['nm_pengguna_aplikasi']);
					
				
		break;
	    }
		
		case 'Laporan':{	
			$json = FALSE;
			$this->Laporan();										
		break;
		}
		
		case 'cetakDetail':{	
			$json = FALSE;
			$this->cetakDetail();										
		break;
		}
		
		case 'infoSpesifikasi':{	
					
			$dt = $_REQUEST['po_cb'];	
			$fm = $this->infoSpesifikasi($dt[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		case 'GenerateNomorPO':{
				$getLastNomorPO = mysql_fetch_array(mysql_query("select max(nomor_po) from po where tahun = '".date('Y')."' "));
				$nomoPoTerakhir = $getLastNomorPO['max(nomor_po)'];
				$nomorPO = $nomoPoTerakhir + 1;
				if($nomorPO < 10){
					$nomorPO = "00".$nomorPO;
				}elseif($nomorPO < 100){
					$nomorPO = "0".$nomorPO;
				}
				$content = array('nomorPO' => $nomorPO);
		break;
	    }
		case 'Saverincian_pekerjaan':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				
				if(empty($rincian_pekerjaan)){
					$err = "Isi rincian_pekerjaan";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}else{
				
					$data = array(
								'id_parent' => $id_po, 
								'id_modul' => $id_modul,
								'rincian_pekerjaan' => $rincian_pekerjaan, 
								'keterangan' => $keterangan,
								'username' => $this->username 
						);	
					mysql_query(VulnWalkerInsert('temp_rincian_pekerjaan',$data));
				}
				
				
				
		break;
	    }
		
		case 'Editrincian_pekerjaan':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				
				if(empty($rincian_pekerjaan)){
					$err = "Isi rincian_pekerjaan";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}else{
				
					
					
					$data = array(
								'rincian_pekerjaan' => $rincian_pekerjaan, 
								'keterangan' => $keterangan,
								'id_modul' => $id_modul
						);	
					mysql_query(VulnWalkerUpdate('temp_rincian_pekerjaan',$data,"id = '$id'"));
				}
				
				
				
		break;
	    }
		
		case 'getTabel':{
			foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}
			$aksi = '<a href="javascript:po.newrincian_pekerjaan()" id="pengguna_aplikasiAtasButton"><img id="gambarAtasButton" src="datepicker/add-256.png" style="width:20px;height:20px;"></a>';
			$header = "<tr>
								<th class='th01' width='20'>NO</th>
								<th class='th01' width='200'>MODUL</th>
								<th class='th01' width='600'>RINCIAN PEKERJAAN</th>
								<th class='th01' width='400'>SPESIFIKASI PEKERJAAN</th>	
								<th class='th01' width='50'>$aksi</th>	
							
						</tr>";
						
						
				//getDaftar
				$arrKondisi = array();
				$grabingAll = mysql_query("select * from temp_rincian_pekerjaan where  id_parent = '$id_po' and username = '$this->username'");
				
				//getDaftar
				$query = mysql_query("select * from temp_rincian_pekerjaan where  id_parent = '$id_po' $kondisi and username = '$this->username' order by id_modul,rincian_pekerjaan,keterangan");
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
					$getNamaModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul = '0'"));
					$namaModul = $getNamaModul['nama_aplikasi'];
					if($id_modul == '0'){
						$namaModul = "NON MODUL";
					}
					if($lastIDModul == $id_modul){
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
								<td>".str_replace("\n","<br>",$rincian_pekerjaan)."</td>
								<td>".str_replace("\n","<br>",$keterangan)."</td>
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
		
		case 'hapusRincian':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$getIDawal = mysql_fetch_array(mysql_query("select * from temp_rincian_pekerjaan where id = '$id'"));
				$idAwal = $getIDawal['id_awal'];
				$checkRD = mysql_fetch_array(mysql_query("select * from cek_rd where id_rincian_pekerjaan = '$idAwal'"));
				if($checkRD['rd'] == 'OK'){
					$err = "Rincian Pekerjaan Sudah Di Periksa R/D";
				}else{
					$getIdParent = mysql_fetch_array(mysql_query("select * from temp_rincian_pekerjaan where id ='$id'"));
					$id_awal = $getIdParent['id_awal'];
					$data = array('id' => $id_awal,
								  'username' => $this->username
								  );
					mysql_query(VulnWalkerInsert("sampah_rincian",$data) );
					mysql_query("delete from temp_rincian_pekerjaan where id ='$id'");
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
		case 'formBaruPemda':{			
				$idPemda = $_REQUEST['idPemda'];
				$fm = $this->setFormBaruPemda($idPemda);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		
		case 'newrincian_pekerjaan':{			
				$fm = $this->newrincian_pekerjaan();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		case 'editrincian_pekerjaan':{	
						
				$fm = $this->editrincian_pekerjaan($_REQUEST['idTemp']);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		
		case 'saveOrder':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($tanggalPO)){
					$err = "Isi Tanggal PO";
				}elseif(empty($idPemda)){
					$err = "Pilih Pemda";
				}elseif(empty($idAplikasi)){
					$err = "Pilih Aplikasi";
				}elseif(empty($idKategori)){
					$err = "Pilih Kategori";
				}elseif(empty($namaKegiatan)){
					$err = "Isi Nama Kegiatan";
				}elseif(empty($nilai)){
					$err = "Isi Nilai";
				}elseif(empty($targetSelesai)){
					$err = "Isi Target Selesai";
				}elseif(empty($kontakTeknis)){
					$err = "Isi Kontak Teknis";
				}elseif(empty($teleponTeknis)){
					$err = "Isi Telepon Teknis";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}elseif(empty($nomor_po)){
					$err = "Isi nomor PO";
				}elseif(mysql_num_rows(mysql_query("select * from po where tahun = '".date('Y')."' and nomor_po = '$nomor_po'")) != 0){
					$err = "Nomor PO ".$nomor_po." untuk tahun ".date('Y').' sudah ada';
				}else{
					$tanggalPO = explode("-",$tanggalPO);
					$tanggalPO = $tanggalPO[2]."-".$tanggalPO[1]."-".$tanggalPO[0];
					$targetSelesai = explode("-",$targetSelesai);
					$targetSelesai = $targetSelesai[2]."-".$targetSelesai[1]."-".$targetSelesai[0];
					$data = array(
									'tanggal_po' => $tanggal_order,
									'nomor_po' => $nomor_po,
									'id_pemda' => $idPemda,
									'id_aplikasi' => $idAplikasi,
									'id_kategori' => $idKategori,
									'nama_kegiatan' => $namaKegiatan,
									'nilai' => $nilai,
									'tanggal_po' => $tanggalPO,
									'target_selesai' => $targetSelesai,
									'keterangan' => $keterangan,
									'status' => "BELUM",
									'kontak_teknis' => $kontakTeknis,
									'telepon_teknis' => $teleponTeknis,
									'tanggal_update' => date('Y-m-d'),
									'username' => $this->username,
									
									);
					mysql_query(VulnWalkerUpdate("po",$data,"id = '$id_po'"));
					

					
					$get = mysql_query("select * from temp_rincian_pekerjaan where id_parent = '$id_po' ");
					while($rows = mysql_fetch_array($get)){
						foreach ($rows as $key => $value) { 
						  $$key = $value; 
						}
						
						$data1 = array(
										'id_parent' => $id_parent,
										'id_modul' => $id_modul,
										'username' => $this->username,
										'tanggal_update' => date('Y-m-d'),
										'rincian_pekerjaan' => $rincian_pekerjaan,
										'keterangan' => $keterangan,
										);
						mysql_query(VulnWalkerInsert("rincian_pekerjaan",$data1));
					}
					
				}
				
					
				
		break;
	    }
		
		
		case 'saveEditOrder':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($tanggalPO)){
					$err = "Isi Tanggal PO";
				}elseif(empty($idPemda)){
					$err = "Pilih Pemda";
				}elseif(empty($idAplikasi)){
					$err = "Pilih Aplikasi";
				}elseif(empty($idKategori)){
					$err = "Pilih Kategori";
				}elseif(empty($namaKegiatan)){
					$err = "Isi Nama Kegiatan";
				}elseif(empty($nilai)){
					$err = "Isi Nilai";
				}elseif(empty($targetSelesai)){
					$err = "Isi Target Selesai";
				}elseif(empty($kontakTeknis)){
					$err = "Isi Kontak Teknis";
				}elseif(empty($teleponTeknis)){
					$err = "Isi Telepon Teknis";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}else{
					$tanggalPO = explode("-",$tanggalPO);
					$tanggalPO = $tanggalPO[2]."-".$tanggalPO[1]."-".$tanggalPO[0];
					$targetSelesai = explode("-",$targetSelesai);
					$targetSelesai = $targetSelesai[2]."-".$targetSelesai[1]."-".$targetSelesai[0];
					$data = array(
									'tanggal_po' => $tanggal_order,
									'nomor_po' => $nomor_po,
									'id_pemda' => $idPemda,
									'id_aplikasi' => $idAplikasi,
									'id_kategori' => $idKategori,
									'nama_kegiatan' => $namaKegiatan,
									'nilai' => $nilai,
									'tanggal_po' => $tanggalPO,
									'target_selesai' => $targetSelesai,
									'keterangan' => $keterangan,
									'status' => "BELUM",
									'kontak_teknis' => $kontakTeknis,
									'telepon_teknis' => $teleponTeknis,
									'tanggal_update' => date('Y-m-d'),
									'username' => $this->username,
									
									);
					mysql_query(VulnWalkerUpdate("po",$data,"id = '$id_po'"));
					
					//moveList
					$kondisinya = array();
					$sampah  =  mysql_query("select * from sampah_rincian where username = '$this->username'");
					while($got = mysql_fetch_array($sampah)){
						$kondisinya[] = "id = '".$got['id']."' " ; 
						$kondisinya2[] = "id_rincian_pekerjaan = '".$got['id']."' " ; 
					}
					$kondisinya= join(' or ',$kondisinya);		
					$hubla = ' Where '.$kondisinya;
					if(!empty($kondisinya)){
						mysql_query("delete from rincian_pekerjaan $hubla");
						$kondisinya2= join(' or ',$kondisinya2);		
						$hubla2 = ' Where '.$kondisinya2;
						mysql_query("delete from cek_rd $hubla2");
						mysql_query("delete from cek_mt $hubla2");
						mysql_query("delete from cek_pemda $hubla2");
					}
					
					$get = mysql_query("select * from temp_rincian_pekerjaan where id_parent = '$id_po' ");
					while($rows = mysql_fetch_array($get)){
						foreach ($rows as $key => $value) { 
						  $$key = $value; 
						}
						
						if(mysql_fetch_array(mysql_query("select * from rincian_pekerjaan where id = '$id_awal'")) != 0){
							$data1 = array(
										'username' => $this->username,
										'tanggal_update' => date('Y-m-d'),
										'id_modul' => $id_modul,
										'rincian_pekerjaan' => $rincian_pekerjaan,
										'keterangan' => $keterangan,
										);
							mysql_query(VulnWalkerUpdate("rincian_pekerjaan",$data1,"id = '$id_awal'"));
						}else{
							$data1 = array(
										'id_parent' => $id_parent,
										'username' => $this->username,
										'tanggal_update' => date('Y-m-d'),
										'id_modul' => $id_modul,
										'rincian_pekerjaan' => $rincian_pekerjaan,
										'keterangan' => $keterangan,
										);
							mysql_query(VulnWalkerInsert("rincian_pekerjaan",$data1));
						}
						

					}
					
					mysql_query("delete from sampah_rincian where username = '$this->username'");
				}
				
			
					
				
		break;
	    }
		
		
		case 'saveCheck':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				if(empty($cmbCheck)){
					$err = "Pilih Status Check";
				}elseif(empty($cmbChecker)){
					$err = "Pilih Checker";
				}elseif(empty($cmbInstall)){
					$err = "Pilih Status Install";
				}elseif(empty($cmbInstaller)){
					$err = "Pilih Installer";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}
				else{
					$data = array('cek' =>$cmbCheck,
								  'checker' => $cmbChecker,
								  'install' => $cmbInstall,
								  'installer' => $cmbInstaller,
								  'keterangan' => $keterangan,
								  'username' => $this->username,
								  'tanggal_update' => date('Y-m-d')
								 
								 );
					mysql_query(VulnWalkerUpdate("po",$data, "id = '$hubla'"));
					$cek = VulnWalkerUpdate("po",$data, "id = '$hubla'");
				}
				
					
				
		break;
	    }
		

		case 'kategoriChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				

	
		break;
		}
		
		case 'pemdaChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				mysql_query("delete from temp_rincian_pekerjaan where username = '$this->username'");

					$queryCmbAplikasi = "select pengguna_aplikasi.id_aplikasi,ref_aplikasi.nama_aplikasi from pengguna_aplikasi 
inner join ref_aplikasi on pengguna_aplikasi.id_aplikasi = ref_aplikasi.kode_aplikasi where pengguna_aplikasi.id_pemda = '$idPemda' and ref_aplikasi.kode_modul = '0'";
					$cmbAplikasi = cmbQuery('cmbAplikasi','',$queryCmbAplikasi,"style='width:200;' onclick =$this->Prefix.aplikasiChanged(); ",'-- Pilih Aplikasi --');
					
					$header = "<tr>
								<th class='th01' width='20px'>NO</th>
								<th class='th01' width='100px'>MODUL</th>
								<th class='th01' width='500px'>RINCIAN PEKERJAAN</th>
								<th class='th01' width='300px'>SPESIFIKASI PEKERJAAN</th>	
								<th class='th01' width='50px'>AKSI</th>	
							
						</tr>";

				$content = array( 'cmbAplikasi' => $cmbAplikasi,
									'rincian' => $header);
	
		break;
		}
		case 'aplikasiChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}

				$grabKontak = mysql_fetch_array(mysql_query("select * from pengguna_aplikasi where id_pemda ='$idPemda' and id_aplikasi = '$idAplikasi'"));
				$kontakTeknis = $grabKontak['kontak_person_teknis'];
				$teleponTeknis = $grabKontak['telepon_teknis'];
				
				
				$content = array(
									'kontak' => $kontakTeknis,
									'telepon' => $teleponTeknis,
									'rincian' => $header.$data
								);
		break;
		}
		
		case 'modulChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$queryCmbSubModul = "select id, nama_modul from ref_modul where id_aplikasi = '$cmbAplikasi' and parent = '$cmbModul'";
				$content = array('cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --')
								
								 );
	
		break;
		}
		

		case 'simpanModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_modul where nama_modul = '$namaModul' and parent ='0' and id_aplikasi = '$cmbAplikasi'")) > 0){
					$err = "Modul Sudah Ada";
				}else{
					$data = array('nama_modul' => $namaModul,
								  'parent' => '0',
								  'id_aplikasi' => $cmbAplikasi
								  );
					mysql_query(VulnWalkerInsert('ref_modul',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaModul' and parent = '0' and id_aplikasi = '$cmbAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='0' and id_aplikasi = '$cmbAplikasi'",'style="width:500;" onchange=$this->Prefix.modulChanged();','-- Pilih Modul --'),
									 'cmbSubModul' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='".$idnya['id']."' and id_aplikasi = '$cmbAplikasi'",'style="width:500;" ','-- Pilih Sub Modul --')
					 );
				}
		break;
		}
		
		case 'changeRow':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$grabData = mysql_fetch_array(mysql_query("select * from ref_cek where id = '$idCek' "));
				foreach ($grabData as $key => $value) { 
				  $$key = $value; 
				}
				$tanggal_check = explode('-',$tanggal_check);
				$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
				$item = "<input type='text' name ='itemCheck$id' id='itemCheck$id' value='$item' style='width:400px;' >";
				$hasil = "<input type='text' name ='hasil$id' id='hasil$id' value='$hasil' style='width:600px;' >";
				$tanggal = "<input type='text' name ='tanggal$id' id='tanggal$id' style='width:80;' value='$tanggal_check' >";
				
				$aksi  = " <img src='images/administrator/images/save_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=rincianCek.saveEdit('$id');></img>&nbsp  &nbsp   <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=rincianCek.refreshList(true);></img>";
				$arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
				
				$status = cmbArray('cmbStatus'.$idCek,$status,$arrayStatus,'-- STATUS --','style="width:80;"');
				
				$content = array(
									'spanItem' => $item,
									'spanHasil' => $hasil,
									'spanTanggal' => $tanggal,
									'spanStatus' => $status,
									'spanAction' => $aksi
								 
								 );
		break;
		}
		
		
		case 'simpanItem':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($itemCek)){
					$err = "Isi item cek";
				}/*elseif(empty($tanggal_check)){
					$err = "Isi tanggal check";
				}elseif(empty($hasil)){
					$err = "Isi Hasil";
				}elseif(empty($cmbStatus)){
					$err = "Pilih Status";
				}*/else{
					$tanggal_check = explode('-',$tanggal_check);
					$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
					$data = array(
									'item' => $itemCek,
									'tanggal_check' => '',
									'hasil' => '',
									'status' => 'TIDAK',
									'id_parent' => $_COOKIE['coParentCek'],
									
								
								
								);
					$query = VulnWalkerInsert('ref_cek',$data);
					mysql_query($query);
					
				}
		break;
		}
		
		
		case 'editItem':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($itemCek)){
					$err = "Isi item cek";
				}elseif(empty($tanggal_check)){
					$err = "Isi tanggal check";
				}elseif(empty($hasil)){
					$err = "Isi Hasil";
				}elseif(empty($cmbStatus)){
					$err = "Pilih Status";
				}else{
					$tanggal_check = explode('-',$tanggal_check);
					$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
					$data = array(
									'item' => $itemCek,
									'tanggal_check' => $tanggal_check,
									'hasil' => $hasil,
									'status' => $cmbStatus,
								
								);
					$query = VulnWalkerUpdate('ref_cek',$data,"id = '$id'");
					mysql_query($query);
					
				}
		break;
		}
		
		
		case 'simpanSubModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_modul where nama_modul = '$namaSubModul' and parent ='$cmbModul' and id_aplikasi = '$cmbAplikasi'")) > 0){
					$err = "Sub Modul Sudah Ada";
				}else{
					$data = array('nama_modul' => $namaSubModul,
								  'parent' => $cmbModul,
								  'id_aplikasi' => $cmbAplikasi
								  );
					mysql_query(VulnWalkerInsert('ref_modul',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaSubModul' and parent = '$cmbModul' and id_aplikasi = '$cmbAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='$cmbModul' and id_aplikasi = '$cmbAplikasi'",'style="width:500;" ','-- Pilih Sub Modul --') );
				}
		break;
		}
		
		case 'simpanpo':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_po where nama_pemda = '$namapo'")) > 0){
					$err = "po Sudah Ada";
				}else{
					$data = array('nama_po' => $namapo);
					mysql_query(VulnWalkerInsert('ref_po',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_po where nama_po = '$namapo'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_po from ref_po",'style="width:500;"','-- Pilih po --') );
				}
		break;
		}
		
		case 'editModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_modul' => $namaModul);
				mysql_query(VulnWalkerUpdate("ref_modul",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaModul' and parent = '0' and id_aplikasi = '$cmbAplikasi' "));
				$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='0' and id_aplikasi = '$cmbAplikasi'","style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --') );
		break;
		}
		
		case 'editSubModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_modul' => $namaSubModul);
				mysql_query(VulnWalkerUpdate("ref_modul",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaSubModul' and parent = '$cmbModul' and id_aplikasi = '$cmbAplikasi' "));
				$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='$cmbModul' and id_aplikasi = '$cmbAplikasi'",'style="width:500;"','-- Pilih Sub Modul --') );
		break;
		}
		
		
		case 'editpo':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_po' => $namapo);
				mysql_query(VulnWalkerUpdate("ref_po",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_po where nama_po = '$namapo'"));
				$content = array('replacer' => cmbQuery('cmbAplikasi',$idnya['id'],"select id,nama_po from ref_po",'style="width:500;"','-- Pilih po --') );
		break;
		}


			

		case 'formBaru':{				
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formOrder':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			$data = array(
						'username' => $this->username,
						'tahun' => date('Y'),
						'tanggal_update' => date('Y-m-d'),
					);
		mysql_query(VulnWalkerInsert("po",$data));
		$grabID = mysql_fetch_array(mysql_query("select max(id) from po "));
		$idpo = $grabID['max(id)'];
			$fm = $this->Order($idpo);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		case 'formEditPO':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			mysql_query("delete from temp_rincian_pekerjaan where username = '$this->username'");
			$fm = $this->EditOrder($po_cb[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		
		case 'formCheck':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			$dt = $po_cb[0];		
			$fm = $this->Check($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		

		
		case 'formAddNew':{			
				$idCek = $_REQUEST['idCek'];
				
				$fm = $this->setFormAddNew($idCek);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		
		case 'formBaruSubModul':{			
				$idSubModul = $_REQUEST['idSubModul'];
				$fm = $this->setFormBaruSubModul($idSubModul);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		
		case 'formBarupo':{			
				$idpo = $_REQUEST['idpo'];
				$fm = $this->setFormBarupo($idpo);				
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
	
	 function setFormAddNew($idCek){
		
		$this->form_fmST = 0;
		
		$fm = $this->AddNew($idCek);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBaruSubModul($idSubModul){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruSubModul($idSubModul);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBarupo($idpo){
		
		$this->form_fmST = 0;
		
		$fm = $this->Barupo($idpo);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	

	
	
	function AddNew($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 70;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Item';
		$kemana = "EditItem($dt)";
		$get = mysql_fetch_array(mysql_query("select * from ref_cek where id='$dt'"));
		foreach ($get as $key => $value) { 
				  $$key = $value; 
				}
		$tanggal_check = explode('-',$tanggal_check);
		$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Item';


		$kemana = 'SimpanItem()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
		$arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
		$cmbStatus = cmbArray('cmbStatus',$status,$arrayStatus,'-- STATUS --','style="width:300;"');
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'ITEM CHECK',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='itemCek' id='itemCek' value='$item' style='width:255px;' >

						</div>", 
						 ),
			/*'tgl_update' => array( 
						'label'=>'TANGGAL CHECK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggal_check' class='datepicker' id='tanggal_check' value='".$tanggal_check."' placeholder='TANGGAL CHECK' style='width:150px;'>
						</div>", 
						 ),
			'Keloasdasmpok' => array( 
						'label'=>'HASIL',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='hasil' id='hasil' value='$hasil' style='width:255px;' >

						</div>", 
						 ),
		    'Keloasdasmpok' => array( 
						'label'=>'HASIL',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='hasil' id='hasil' value='$hasil' style='width:255px;' >

						</div>", 
						 ),
			'status' => array( 
						'label'=>'STATUS',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						$cmbStatus
						<input type='hidden' id ='jenis' name='jenis' value=''>
						</div>", 
						 ),*/
									 			
				
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".$kemana' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormKB();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function BaruSubModul($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Sub Modul';
		$kemana = "EditSubModul($dt)";
		$namaSubModul = mysql_fetch_array(mysql_query("select * from ref_modul where id='$dt'"));
		$namaSubModul = $namaSubModul['nama_modul'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Sub Modul';


		$kemana = 'SimpanSubModul()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama Sub Modul',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaSubModul' id='namaSubModul' value='$namaSubModul' style='width:255px;' >

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
	
	function Barupo($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit po';
		$kemana = "Editpo($dt)";
		$namapo = mysql_fetch_array(mysql_query("select * from ref_po where id='$dt'"));
		$namapo = $namapo['nama_po'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru po';
		$nip	 = '';

			
		$kemana = 'Simpanpo()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama po',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namapo' id='namapo' value='$namapo' style='width:255px;' >

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
	
	function newrincian_pekerjaan($id){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 200;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	 	$this->form_caption = 'BARU';
		if(!empty($id)){
			$kemana = "Editrincian_pekerjaan($id)";
			$read = "disabled";
		}else{
			$kemana = "Saverincian_pekerjaan()";
		}
		

	

		$cmbModul = cmbQuery('cmbModul',$id_modul,"select kode_modul,nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'","style='width:255px;' $read",'-- NON MODUL --');
		
		
	 //items ----------------------
	  $this->form_fields = array(
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>150, 
						'value'=>$cmbModul, 
						 ),

			'spek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'rincian_pekerjaan' id = 'rincian_pekerjaan' style='width:475px;height:50px;' >$rincian_pekerjaan</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'ket' => array( 
						'label'=>'SPESIFIKASI PEKERJAAN',
						'labelWidth'=>100, 
						'value'=>"", 
						 ),	
			'keasdast' => array( 
						'label'=>'SPESIFIKASI PEKERJAAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'ket' id = 'ket' style='width:475px; height:50px;'>$keterangan</textarea>

						</div>", 
						'type' => 'merge'
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
	
	function editrincian_pekerjaan($id){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 200;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	 	$this->form_caption = 'EDIT';
		
		
		$getData = mysql_fetch_array(mysql_query("select * from temp_rincian_pekerjaan where id = '$idTemp'"));
		foreach ($getData as $key => $value) { 
				  $$key = $value; 
				}

		
		$cmbModul = cmbQuery('cmbModul',$id_modul,"select kode_modul,nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'","style='width:255px;' $read",'-- NON MODUL --');
		
		
	 //items ----------------------
	  $this->form_fields = array(
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>150, 
						'value'=>$cmbModul, 
						 ),

			'spek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'rincian_pekerjaan' id = 'rincian_pekerjaan' style='width:475px;height:50px;' >$rincian_pekerjaan</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'ket' => array( 
						'label'=>'SPESIFIKASI PEKERJAAN',
						'labelWidth'=>100, 
						'value'=>"", 
						 ),	
			'keasdast' => array( 
						'label'=>'SPESIFIKASI PEKERJAAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'ket' id = 'ket' style='width:475px; height:50px;'>$keterangan</textarea>

						</div>", 
						'type' => 'merge'
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
	
	function setPage_OtherScript(){
	
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if($po != '1' && $po !='2'){
		
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
			 <script type='text/javascript' src='js/po/po.js' language='JavaScript' ></script>
			 <script type='text/javascript' src='js/po/rincianPekerjaan.js' language='JavaScript' ></script>
			 
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
		
		$fm = $this->setForm($po_cb[0]);
		
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
		$this->form_caption = 'FORM EDIT KODE pengguna_aplikasi';
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
		
		
		
		$queryKAedit=mysql_fetch_array(mysql_query("SELECT k, nm_pengguna_aplikasi FROM po WHERE k='$k' and l = '0' and m='0' and n='00' and o='00'")) ;
		$cek.=$queryKAedit;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT l, nm_pengguna_aplikasi FROM po WHERE k='$k' and l='$l' and m= '0' and n='00' and o='00'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT m, nm_pengguna_aplikasi FROM po WHERE k='$k' and l='$l' and m='$m' and n='00' and o='00'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT n, nm_pengguna_aplikasi FROM po WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='00'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT o, nm_pengguna_aplikasi FROM po WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='$o'")) ;
	//	$cek.="SELECT ke, nm_account FROM ref_jurnal WHERE ka='$data_ka' and kb='$data_kb' and kc='$data_kc' and kd='$data_kd' and ke='$data_ke' and kf='0'";
					
	
		$datka=$queryKAedit['k'].".  ".$queryKAedit['nm_pengguna_aplikasi'];
		$datkb=$queryKBedit['l'].". ".$queryKBedit['nm_pengguna_aplikasi'];
		$datkc=$queryKCedit['m']." .  ".$queryKCedit['nm_pengguna_aplikasi'];
		$datkd=$queryKDedit['n'].". ".$queryKDedit['nm_pengguna_aplikasi'];
		$datke=$queryKEedit['o'];
	//	$datke=sprintf("%02s",$queryKEedit['ke'])." .  ".$queryKEedit['nm_account'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'kode_Akun' => array( 
						'label'=>'kode pengguna_aplikasi',
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
						<input type='text' name='nm_pengguna_aplikasi' id='nm_pengguna_aplikasi' value='".$dt['nm_pengguna_aplikasi']."' size='36px'>
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
	 			
	$this->form_width = 720;
	 $this->form_height = 180;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		
	//	$nip	 = '';
	  }else{
		$this->form_caption = 'Edit';			
		$readonly='readonly';
		$get = mysql_fetch_array(mysql_query("select * from po where id ='$dt'"));
		foreach ($get as $key => $value) { 
			  $$key = $value; 
			}	
			
	  }
	    //ambil data trefditeruskan
		$arrayValidasi = array(
						array('YA' , 'YA'),
						array('TIDAK' , 'TIDAK'),
						
						);
	  $cmbPegawai = cmbQuery('cmbPegawai',$dari,"select id,nama_pemda from ref_pemda","style='width:500;' onchange=$this->Prefix.pemdaChanged();",'-- Pilih Pemda --');
	  $cmbModul = cmbQuery('cmbModul',$id_modul,"select id,nama_modul from ref_modul where parent = '0' and id_aplikasi = '$id_aplikasi'","style='width:400;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --');
	  $cmbSubModul = cmbQuery('cmbSubModul',$id_sub_modul,"select id,nama_modul from ref_modul where parent = '$id_modul' and id_aplikasi = '$id_aplikasi'","style='width:400;' ",'-- Pilih Sub Modul --');
	  
	  $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select pengguna_aplikasi.id_aplikasi,ref_po.nama_po from pengguna_aplikasi inner join ref_po on pengguna_aplikasi.id_aplikasi = ref_po.id  where pengguna_aplikasi.id_pemda = '$id_pemda'","style='width:500;' onchange=$this->Prefix.poChanged();",'-- Pilih po --');
	
	  $cmbValidasi = cmbArray('cmbValidasi',$validasi,$arrayValidasi,'-- VALIDASI --','style="width:500;"');			

	 //items ----------------------
	  $this->form_fields = array(
			
			'nama_pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>120, 
						'value'=> $cmbPemda 
						 ),	
						 	
			
			'nama_po' => array( 
						'label'=>'NAMA po',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi 
						 ),	
						 	
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>100, 
						'value'=> $cmbModul."&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".ModulBaru()' title='Kode Kelompok' >" ."&nbsp&nbsp&nbsp"."<input type='button' value='Edit' onclick ='".$this->Prefix.".ModulEdit()' title='Kode Kelompok' >" , 
						 ),
			'sub_modul' => array( 
						'label'=>'SUB MODUL',
						'labelWidth'=>100, 
						'value'=> $cmbSubModul."&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".SubModulBaru()' title='Kode Kelompok' >" ."&nbsp&nbsp&nbsp"."<input type='button' value='Edit' onclick ='".$this->Prefix.".SubModulEdit()' title='Kode Kelompok' >" , 
						 ),		
			'uraian' => array( 
						'label'=>'URAIAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='uraian' id='uraian' value='".$uraian."' placeholder='URAIAN' style='width:500px;'>
						</div>", 
						 ),
			'validasi' => array( 
						'label'=>'VALIDASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						$cmbValidasi
						</div>", 
						 ),	
			
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
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
	

function Order($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 140;
	 $this->form_caption = 'PURCHASING ORDER';	
	 mysql_query("delete from temp_rincian_pekerjaan where username = '$this->username'");
	
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal = explode('-',$tanggal);
	 $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	 $arrayStatus = array(
						array('SUDAH' , 'SUDAH'),
						array('BELUM' , 'BELUM'),
						
	 				);
	 $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'","style='width:300;' onchange=$this->Prefix.aplikasiChanged();",'-- Pilih Aplikasi --'); //items ----------------------
	  	
	 $cmbKategori = cmbQuery('cmbKategori','1',"select id,nama from ref_kategori","style='width:300;' onchange=$this->Prefix.kategoriChanged();",'-- Pilih Kategori --');
		
	 $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota != '0'","style='width:300;'  onchange=$this->Prefix.pemdaChanged(); ",'-- Pilih Pemda --');
	 $tanggal_po = date("d-m-Y");
	 
	 /*&nbsp <input type='button' value='No Terakhir' onclick = $this->Prefix.GenerateNomorPO();  >*/
	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'NOMOR PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nomor_po' id='nomor_po' value='".$nomor_po."' placeholder='NOMOR PO' maxlength='3'  style='width:50px;text-align:right;'> 
						<input type='hidden' name='id_po' id='id_po' value='".$dt."' >
						</div>", 
						 ),
	 		'tgl_update' => array( 
						'label'=>'TANGGAL PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggalPO' class='datepicker' id='tanggalPO' value='".$tanggal_po."' placeholder='TANGGAL PO' style='width:150px;'>
						</div>", 
						 ),
			'kategori' => array( 
						'label'=>'KATEGORI',
						'labelWidth'=>120, 
						'value'=> $cmbKategori."&nbsp <span id='spanAplikasi'></span>"
						 ),	
	 		'pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>120, 
						'value'=> $cmbPemda
						 ),	
			'apl' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi 
						 ),	
			
			
			'kegiatan' => array( 
						'label'=>'NAMA KEGIATAN / PEKERJAAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='kegiatan'  id='kegiatan' value='".$kegiatan."' placeholder='KEGIATAN / PEKERJAAN' style='width:500px;'>
						</div>" 
						 ),	
			'nilai' => array( 
						'label'=>'NILAI (Rp)',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='nilai'  id='nilai' value='".$nilai."' placeholder='Nilai' style='width:150px;text-align:right' onkeyup = '$this->Prefix.nilaiChanged()'>
						<span id='bantuNilai' style='color:red;'></span>
						</div>" 
						 ),	
			'targetSelesai' => array( 
						'label'=>"<span id='tergantung'>TARGET SELESAI</span>",
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='target_selesai' class='datepicker' id='target_selesai' value='".$target_selesai."' placeholder='TARGET SELESAI' style='width:150px;'>
						</div>", 
						 ),
			'kontakPerson' => array( 
						'label'=>'KONTAK PERSON / NO HP',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='kontak_teknis'  id='kontak_teknis' value='".$kontak_teknis."' placeholder='' style='width:200px;' >
						<input type='text' name='telepon_teknis'  id='telepon_teknis' value='".$telepon_teknis."' placeholder='' style='width:100px;' >
						</div>", 
						 ),
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='keterangan'  id='keterangan' value='".$keterangan."' placeholder='Keterangan' style='width:300px;'>
						</div>" 
						 ),		
			'rincianPekerjaan' => array( 
						'label'=>'',
						'value'=> $this->tabelRincianPekerjaan(), 
						'type'=>'merge'
					 ),	
				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveOrder($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm2();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
		
function EditOrder($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 140;
	 $this->form_caption = 'PURCHASING ORDER';	
	 //moving
	 	$getDataRincian = mysql_query("select * from rincian_pekerjaan where id_parent = '$dt'");
		while($tot = mysql_fetch_array($getDataRincian)){
			foreach ($tot as $key => $value) { 
			  $$key = $value; 
			}
			
			$data1 = array(
										'id_parent' => $id_parent,
										'id_modul' => $id_modul,
										'id_awal' => $id,
										'rincian_pekerjaan' => $rincian_pekerjaan,
										'keterangan' => $keterangan,
										'username' => $this->username
										);
						mysql_query(VulnWalkerInsert("temp_rincian_pekerjaan",$data1));
			
		}
	 
	 //moving
	 
	 $got = mysql_fetch_array(mysql_query("select * from po where id ='$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal_po = explode('-',$tanggal_po);
	 $tanggal_po = $tanggal_po[2]."-".$tanggal_po[1]."-".$tanggal_po[0];
	 $target_selesai = explode('-',$target_selesai);
	 $target_selesai = $target_selesai[2]."-".$target_selesai[1]."-".$target_selesai[0];
	 $arrayStatus = array(
						array('SUDAH' , 'SUDAH'),
						array('BELUM' , 'BELUM'),
						
	 				);
					//disini
	 	
	 $cmbKategori = cmbQuery('cmbKategori',$id_kategori,"select id,nama from ref_kategori","style='width:300;' onchange=$this->Prefix.kategoriChanged();",'-- Pilih Kategori --');
		
	 $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota != '0'","style='width:300;'  onchange=$this->Prefix.pemdaChanged(); ",'-- Pilih Pemda --');
	 
	 $queryCmbAplikasi = "select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'";
					$cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,$queryCmbAplikasi,"style='width:200;' onclick =$this->Prefix.aplikasiChanged(); disabled ",'-- Pilih Aplikasi --');
					
	 $this->form_fields = array(
	 		'idPO' => array( 
						'label'=>'NOMOR PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='nomor_po' id='nomor_po' value='".$nomor_po."' placeholder='NOMOR PO' maxlength='3'  style='width:50px;text-align:right;'>
						<input type='hidden' name='id_po' id='id_po' value='".$dt."' >
						</div>", 
						 ),
	 		'tgl_update' => array( 
						'label'=>'TANGGAL PO',
						'labelWidth'=>200, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggalPO' class='datepicker' id='tanggalPO' value='".$tanggal_po."' placeholder='TANGGAL PO' style='width:150px;'>
						</div>", 
						 ),
			'kategori' => array( 
						'label'=>'KATEGORI',
						'labelWidth'=>120, 
						'value'=> $cmbKategori."&nbsp <span id='spanAplikasi'></span>"
						 ),	
	 		'pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>120, 
						'value'=> $cmbPemda
						 ),	
			'apl' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi 
						 ),	
			
			
			'kegiatan' => array( 
						'label'=>'NAMA KEGIATAN / PEKERJAAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='kegiatan'  id='kegiatan' value='".$nama_kegiatan."' placeholder='KEGIATAN / PEKERJAAN' style='width:500px;'>
						</div>" 
						 ),	
			'nilai' => array( 
						'label'=>'NILAI (Rp)',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='nilai'  id='nilai' value='".$nilai."' placeholder='Nilai' style='width:150px;text-align:right' onkeyup = '$this->Prefix.nilaiChanged()'>
						<span id='bantuNilai' style='color:red;'> Rp ".number_format($nilai,2,',','.')." </span>
						</div>" 
						 ),	
			'targetSelesai' => array( 
						'label'=>"<span id='tergantung'>TARGET SELESAI</span>",
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='target_selesai' class='datepicker' id='target_selesai' value='".$target_selesai."' placeholder='TARGET SELESAI' style='width:150px;'>
						</div>", 
						 ),
			'kontakPerson' => array( 
						'label'=>'KONTAK PERSON / NO HP',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='kontak_teknis'  id='kontak_teknis' value='".$kontak_teknis."' placeholder='' style='width:200px;' >
						<input type='text' name='telepon_teknis'  id='telepon_teknis' value='".$telepon_teknis."' placeholder='' style='width:100px;' >
						</div>", 
						 ),
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "<div style='float:left;'>
						<input type='text' name='keterangan'  id='keterangan' value='".$keterangan."' placeholder='Keterangan' style='width:300px;'>
						</div>" 
						 ),		
			'rincianPekerjaan' => array( 
						'label'=>'',
						'value'=> $this->tabelRincianPekerjaan(), 
						'type'=>'merge'
					 ),	
				 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveEditOrder($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm2();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
		

function Check($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 setcookie('coParentCek', $dt);
	 $this->form_width = 400;
	 $this->form_height = 140;
	 $this->form_caption = 'RINCIAN ORDER';	
	 $this->form_fields = array(
			'rincianCek' => array( 
						'label'=>'',
						'value'=>"
						
						<div id='rincianCek' style='height:5px'></div>", 
						
						'type'=>'merge'
					 ),						
			
			);
		//tombol
		
		/*"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveCheck($dt)' title='Simpan' > &nbsp".*/
		$this->form_menubawah =
			
			
			"<input type='button' value='Tutup' onclick ='".$this->Prefix.".Tutup()' >";
							
		$form = $this->genForm2();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$dt, 'err'=>$err, 'content'=>$content);
	}
		
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' rowspan='2' width='5' >NOMOR PO</th>
  	   $Checkbox		
		   <th class='th01' width='110' rowspan='2' >TANGGAL</th>
		   <th class='th01' width='150' rowspan='2' >KATEGORI / NAMA PEMDA</th>
		   <th class='th01' width='500' rowspan='2' align='center'>NAMA PEKERJAAN</th>
		   <th class='th01' width='80' rowspan='2' align='center'>NILAI</th>
		   <th class='th01' width='110' rowspan='2' align='center'>TARGET SELESAI</th>
		   <th class='th02' width='150' rowspan='1' colspan='3' align='center'>STATUS</th>
		   <th class='th01' width='80' rowspan='2' align='center'>KETERANGAN</th>
	   </tr>
	   <tr>
	   		<th class='th01' width='50' rowspan='1' align='center'>ADMIN</th>
	   		<th class='th01' width='50' rowspan='1' align='center'>R/D</th>
	   		<th class='th01' width='50' rowspan='1' align='center'>MAINTENANCE</th>
	   	
	   </tr>

	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 foreach ($isi as $key => $value) { 
			  $$key = $value; 
			}
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $nomor_po );
	  
	 $nama_pegawai = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$dari'"));
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id = '$id_aplikasi'"));
	 $nama_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_modul'"));
	 $nama_sub_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_sub_modul'"));
	 
	 
	 $grabStatusAdmin = mysql_fetch_array(mysql_query("select * from cek_admin where id_po ='$id'"));
	 if($grabStatusAdmin['rab'] == "OK" && $grabStatusAdmin['kak'] == "OK" && $grabStatusAdmin['berkas_tagihan'] == "OK" && $grabStatusAdmin['laporan'] == "OK" && $grabStatusAdmin['sp2d'] == "OK" && $grabStatusAdmin['pajak'] == "OK" ){
	 	$jumlahTiga = "OK";
		$statusAdmin = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusAdmin = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 $jumlahSpeksifikasi = mysql_num_rows(mysql_query("select * from rincian_pekerjaan where rincian_pekerjaan !='' and id_parent ='$id'"));
	 $grabStatusRD = mysql_num_rows(mysql_query("select * from cek_rd where id_po ='$id' and rd='OK'"));
	 if($grabStatusRD == $jumlahSpeksifikasi ){
	 	$statusRD = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
		$jumlahSatu = "OK";
	 }else{
	 	$statusRD = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 
	 
	 $grabStatusMT = mysql_num_rows(mysql_query("select * from cek_mt where id_po ='$id' and status_cek='OK'"));
	 if($grabStatusMT == $jumlahSpeksifikasi ){
	 	$jumlahDua = "OK";
	 	$statusMT = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusMT = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 
	 if($jumlahSatu = "OK" && $jumlahDua == "OK" && $jumlahTiga == "OK"){
	 	mysql_query("update po set status = 'SUDAH' where id = '$id'");
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
	 $Koloms[] = array('align="center"',$statusAdmin);
	 $Koloms[] = array('align="center"',$statusRD);
	 $Koloms[] = array('align="center"',$statusMT);
	 $Koloms[] = array('align="left"',$keterangan);
	 
	 
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
		
		
		/*$grabAllParent = mysql_query("select * from po where id_sub_modul = '0'");
		while($rows = mysql_fetch_array($grabAllParent)){
			foreach ($rows as $key => $value) { 
			  $$key = $value; 
			}
			if(mysql_num_rows(mysql_query("select * from po where id_modul = '$id_modul' and id_sub_modul !='0' and id_pemda = '$id_pemda' and id_aplikasi ='$id_aplikasi'")) == 0){
				$concat = $id_pemda.".".$id_aplikasi.".".$id_modul;
				$arrKondisi[] = "concat(id_pemda,'.',id_aplikasi,'.',id_modul) != '$concat'";
			}
		}*/
		
		
		$grabAll = mysql_query("select * from cek_aplikasi");
		while($rows = mysql_fetch_array($grabAll)){
			foreach ($rows as $key => $value) { 
			  $$key = $value; 
			}
			if(mysql_num_rows(mysql_query("select * from ref_cek where id_parent = '$id' and status !='OK'")) == 0){
				$data = array('status' => "OK");
				mysql_query(VulnWalkerUpdate('cek_aplikasi',$data, "id ='$id'"));
			}else{
				$data = array('status' => "TIDAK");
				mysql_query(VulnWalkerUpdate('cek_aplikasi',$data, "id ='$id'"));
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
		/*$arrOrders[] = "id_pemda,id_aplikasi,id_modul,id_sub_modul";*/
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
	
	function Hapus($ids){
		$err=''; $cek=''; $content = '';
		//$cid= $POST['cid'];
		//$err = ''.$ids;
		for($i = 0; $i<count($ids); $i++)	{
			$err .= $this->Hapus_Validasi($ids[$i]);
			
			if($err ==''){
				$get = $this->Hapus_Data($ids[$i]);
				$err .= $get['err'];
				$cek .= $get['cek'];
				$content .= $get['content'];
				if ($errmsg=='') {
					$after = $this->Hapus_Data_After($ids[$i]);
					mysql_query("delete from rincian_pekerjaan where id_parent = '$ids[$i]'");
					mysql_query("delete from cek_rd where id_po = '$ids[$i]'");
					mysql_query("delete from cek_mt where id_po = '$ids[$i]'");
					mysql_query("delete from cek_admin where id_po = '$ids[$i]'");
					mysql_query("delete from cek_pemda where id_po = '$ids[$i]'");
					$err .=$after['err'];
					$cek .=$after['cek'];
					$content .= $after['content'];
				}
				if ($err != '') break;
				 				
			}else{
				break;
			}			
		}
		return array('err'=>$err,'cek'=>$cek, 'content' => $content);
	} 
	
	function tabelRincianPekerjaan(){
			/*$datanya = "
				<tr class='row0'>
					<td align='center'>1.</td>
					<td><textarea name='CPTK' id='CPTK' style='width:100%; '>$CPTK</textarea></td>
					<td><textarea name='CPTU' id='CPTU' style='width:100%; '>$CPTU</textarea></td>
					<td><textarea name='CPTK' id='CPTK' style='width:100%; '>$CPTK</textarea></td>
			   </tr>
			   
			  
			";*/
			
		$aksi = '<a href="javascript:po.newrincian_pekerjaan()" id="pengguna_aplikasiAtasButton"><img id="gambarAtasButton" src="datepicker/add-256.png" style="width:20px;height:20px;"></a>';
	
		$content2 = 
					"
					
					RINCIAN PEKERJAAN :
					<table class='koptable' style='width:100%;' border='1' id='tabelRincianPekerjaan'>
						<tr>
								<th class='th01'>NO</th>

								<th class='th01'>RINCIAN PEKERJAAN</th>
								<th class='th01'>KETERANGAN</th>
								<th class='th01'>$aksi</th>	
							
						</tr>
						$datanya
					</table>
					"
				
				;
		return $content2;
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
						'value'=> $this->tabelRincianPekerjaanInfo($dt), 
						'type'=>'merge'
					 ),		 	
				
			
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Cetak' onclick ='".$this->Prefix.".cetakDetail($dt)' >&nbsp " 
			."<input type='button' value='Tutup' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm2();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	

function tabelRincianPekerjaanInfo($nomor_po){
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
		
function Laporan($xls =FALSE){
		global $Main;
		
	
		
		if($xls){
			header("Content-type: application/msexcel");
			header("Content-Disposition: attachment; filename=$this->fileNameExcel");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		
		
		
		$arrKondisi = array();


			

			
		
		$arrKondisi[] = "id_pemda != ''";

		$Kondisi= join(' and ',$arrKondisi);		
		
		/*if(sizeof($arrKondisi) == 0){
			$Kondisi= '';
		}else{
			$Kondisi = " and ".$Kondisi;
		}*/
		$qry ="select * from po where $Kondisi ";
		$aqry = mysql_query($qry);

				
		//MULAI Halaman Laporan ------------------------------------------------------------------------------------------ 
		$css = $xls	? "<style>.nfmt5 {mso-number-format:'\@';}</style>":"<link rel=\"stylesheet\" href=\"css/template_css.css\" type=\"text/css\" />";
		echo 
			"<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
					<style>
						.ukurantulisan{
							font-size:17px;
						}
						.ukurantulisan1{
							font-size:20px;
						}
						.ukurantulisanIdPenerimaan{
							font-size:16px;
						}
					</style>
				</head>".
			"<body >
				<div style='width:$this->Cetak_WIDTH_Landscape;'>
					<table class=\"rangkacetak\" style='width:33cm;font-family:Times New Roman;margin-left:2cm;margin-top:2cm;'>
						<tr>
							<td valign=\"top\"> <div style='text-align:center;'>
				<span style='font-size:18px;font-weight:bold;text-decoration: '>
					PURCHASING ORDER
				</span><br><br>

				
				
				
				";
		echo "

								<table table width='100%' class='cetak' border='1' style='margin:4 0 0 0;width:100%;'>
									<tr>
										<th class='th01' rowspan='2' width='50' >NOMOR PO</th>
										<th class='th01' rowspan='2' width='110' >TANGGAL</th>
										<th class='th01' rowspan='2' width='80' >KATEGORI</th>
										<th class='th01' rowspan='2' width='150' >NAMA PEMDA</th>
										<th class='th01' rowspan='2' width='400' >NAMA PEKERJAAN</th>
										<th class='th01' rowspan='2' width='100' >NILAI</th>
										<th class='th01' rowspan='2' width='110' >TARGET SELESAI</th>
										<th class='th02' rowspan='1' colspan='3' >STATUS</th>
										<th class='th01' rowspan='2' width='200' >KETERANGAN</th>
										
									</tr>
									<tr>
										<th class='th01' width='50' >ADMIN</th>
										<th class='th01' width='50' >R/D</th>
										<th class='th01' width='50' >MAINTENANCE</th>
									</tr>
								
									
		";
		$getTotal = mysql_fetch_array(mysql_query("select sum(nilai) from po where $Kondisi  "));
		$total = number_format($getTotal['sum(nilai)'],2,',','.');
		$no = 1;
		while($daqry = mysql_fetch_array($aqry)){
			foreach ($daqry as $key => $value) { 
				  $$key = $value; 
			} 
			
			 $nama_pegawai = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$dari'"));
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id = '$id_aplikasi'"));
	 $nama_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_modul'"));
	 $nama_sub_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_sub_modul'"));
	 
	 
	 $grabStatusAdmin = mysql_fetch_array(mysql_query("select * from cek_admin where id_po ='$id'"));
	 if($grabStatusAdmin['rab'] == "OK" && $grabStatusAdmin['kak'] == "OK" && $grabStatusAdmin['berkas_tagihan'] == "OK" && $grabStatusAdmin['laporan'] == "OK" && $grabStatusAdmin['sp2d'] == "OK" && $grabStatusAdmin['pajak'] == "OK" ){
	 	$jumlahTiga = "OK";
		$statusAdmin = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusAdmin = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 $jumlahSpeksifikasi = mysql_num_rows(mysql_query("select * from rincian_pekerjaan where rincian_pekerjaan !='' and id_parent ='$id'"));
	 $grabStatusRD = mysql_num_rows(mysql_query("select * from cek_rd where id_po ='$id' and rd='OK'"));
	 if($grabStatusRD == $jumlahSpeksifikasi ){
	 	$statusRD = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
		$jumlahSatu = "OK";
	 }else{
	 	$statusRD = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	 
	 
	 $grabStatusMT = mysql_num_rows(mysql_query("select * from cek_mt where id_po ='$id' and status_cek='OK'"));
	 if($grabStatusMT == $jumlahSpeksifikasi ){
	 	$jumlahDua = "OK";
	 	$statusMT = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }else{
	 	$statusMT = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;'></img>";
	 }
	 
	  $getkategori = mysql_fetch_array(mysql_query("select * from ref_kategori where id = '$id_kategori'"));
	 $namaKategori = $getkategori['nama'];
	 $getNamaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$id_pemda'"));
	 $namaPemda = $getNamaPemda['nama_pemda'];
			echo "
								<tr valign='top'>
									<td align='center' class='GarisCetak' >".$nomor_po."</td>
									<td align='left' class='GarisCetak' >".VulnWalkerTitiMangsa($tanggal_po)."</td>
									<td align='left' class='GarisCetak' >".$namaKategori."</td>
									<td align='left' class='GarisCetak' >".$namaPemda."</td>
									<td align='left' class='GarisCetak' >".$nama_kegiatan."</td>
									<td align='right' class='GarisCetak' >".number_format($nilai,2,',','.')."</td>
									<td align='left' class='GarisCetak' >".VulnWalkerTitiMangsa($target_selesai)."</td>
									<td align='center' class='GarisCetak'>$statusAdmin</td>
									<td align='center' class='GarisCetak' >".$statusRD."</td>
									<td align='center' class='GarisCetak' >".$statusMT."</td>
									<td align='left' class='GarisCetak' >".$keterangan."</td>
								</tr>
			";
			$no++;
			
			
			
			
		}
		
		echo 				"<tr valign='top'>
									<td align='right' colspan='5' class='GarisCetak'>Jumlah</td>
									<td align='right' class='GarisCetak' ><b>".$total."</b></td>
									<td align='right' colspan='5'  class='GarisCetak' ></b></td>

									
								</tr>
							 </table>";		
		echo 			
						"<br>
			</body>	
		</html>";
	}
	
	
	function cetakDetail($xls =FALSE){
		global $Main;
		
		$id= $_GET['id'];
		
		if($xls){
			header("Content-type: application/msexcel");
			header("Content-Disposition: attachment; filename=$this->fileNameExcel");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		
		
		
		$arrKondisi = array();


			

			
		
		$arrKondisi[] = "id_pemda != ''";

		$Kondisi= join(' and ',$arrKondisi);		
		
		/*if(sizeof($arrKondisi) == 0){
			$Kondisi= '';
		}else{
			$Kondisi = " and ".$Kondisi;
		}*/
		$qry ="select * from rincian_pekerjaan where id_parent = '$id' order by id_modul,rincian_pekerjaan";
		$aqry = mysql_query($qry);
			
				
		//MULAI Halaman Laporan ------------------------------------------------------------------------------------------ 
		$css = $xls	? "<style>.nfmt5 {mso-number-format:'\@';}</style>":"<link rel=\"stylesheet\" href=\"css/template_css.css\" type=\"text/css\" />";
		echo 
			"<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
					<style>
						.ukurantulisan{
							font-size:17px;
						}
						.ukurantulisan1{
							font-size:20px;
						}
						.ukurantulisanIdPenerimaan{
							font-size:16px;
						}
					</style>
				</head>".
			"<body >
				<div style='width:$this->Cetak_WIDTH_Landscape;'>
					<table class=\"rangkacetak\" style='width:33cm;font-family:Times New Roman;margin-left:2cm;margin-top:2cm;'>
						<tr>
							<td valign=\"top\"> <div style='text-align:center;'>
				<span style='font-size:18px;font-weight:bold;text-decoration: '>
					RINCIAN PEKERJAAN
				</span><br><br>
				";
		$grabDataPO = mysql_fetch_array(mysql_query("select * from po where id = '$id' "));	
		foreach ($grabDataPO as $key => $value) { 
				  $$key = $value; 
			} 	
		$namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '0'"));
		$namaAplikasi = $namaAplikasi['nama_aplikasi'];
		
		$getkategori = mysql_fetch_array(mysql_query("select * from ref_kategori where id = '$id_kategori'"));
		$namaKategori = $getkategori['nama'];
		$getNamaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$id_pemda'"));
		$namaPemda = $getNamaPemda['nama_pemda'];
		echo '<table style="width:100%" class="cetak">
				<tbody><tr>
						<td style="width:200">NOMOR PO</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						'.$nomor_po.'
						</div></td>
					</tr><tr>
						<td style="width:200">TANGGAL PO</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						'.VulnWalkerTitiMangsa($tanggal_po).'
						</div></td>
					</tr><tr>
						<td style="width:120">NAMA PEMDA</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						'.$namaPemda.'
						</div></td>
					</tr><tr>
						<td style="width:120">NAMA APLIKASI</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						'.$namaAplikasi.'
						</div></td>
					</tr><tr>
						<td style="width:120">KATEGORI</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						'.$namaKategori.'
						</div></td>
					</tr><tr>
						<td style="width:120">NAMA KEGIATAN / PEKERJAAN</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						'.$nama_kegiatan.'
						</div></td>
					</tr><tr>
						<td style="width:120">NILAI (Rp)</td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						<span id="bantuNilai" >Rp. '.number_format($nilai,2,',','.').'</span>
						</div></td>
					</tr><tr>
						<td style="width:100"><span id="tergantung">TARGET SELESAI</span></td>
						<td style="width:10">:</td>
						<td><div style="float:left;">
						 '.VulnWalkerTitiMangsa($target_selesai).'
						</div></td>
					</tr><tr>
						<td colspan="3">
					
					RINCIAN PEKERJAAN :
					
				';
		
		echo "

								<table table width='100%' class='cetak' border='1' style='margin:4 0 0 0;width:100%;'>
									<tr>
										<th class='th01' width = '50' >NO</th>
										<th class='th01' width='200' >MODUL</th>
										<th class='th01' width='500' >RINCIAN PEKERJAAN</th>
										<th class='th01' width='200' >KETERANGAN</th>

										
									</tr>

								
									
		";

		$no = 1;
		while($daqry = mysql_fetch_array($aqry)){
			foreach ($daqry as $key => $value) { 
				  $$key = $value; 
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
			echo "
								<tr valign='top'>
									<td align='center' class='GarisCetak' >".$no."</td>
									<td align='left' class='GarisCetak' >".$namaModul."</td>
									<td align='left' class='GarisCetak' >".$rincian_pekerjaan."</td>
									<td align='left' class='GarisCetak' >".$keterangan."</td>

								</tr>
			";
			
			$lastIDModul = $id_modul;	
			$no++;
			
			
			
			
		}
		
		echo 				"
							 </table>";		
		echo 			
						"<br>
			</body>	
		</html>";
	}


}
$po = new poObj();
$po->username = $_COOKIE['coID'];
?>