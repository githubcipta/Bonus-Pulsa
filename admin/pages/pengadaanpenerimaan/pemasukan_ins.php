<?php
 //if($_COOKIE['cofmSEKSI'] == '000' || $_REQUEST['pemasukanSKPDfmSEKSI']=='')header("Location:pages.php?Pg=pemasukan");
class pemasukan_insObj  extends DaftarObj2{	
	var $Prefix = 'pemasukan_ins';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 't_penerimaan_barang'; //bonus
	var $TblName_Hapus = 't_penerimaan_barang';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('Id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'PENGADAAN DAN PENERIMAAN';
	var $PageIcon = 'images/pengadaan_ico.png';
	var $ico_width = '28.8';
	var $ico_height = '28.8';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='pemasukan.xls';
	var $namaModulCetak='PENGADAAN DAN PENERIMAAN';
	var $Cetak_Judul = 'Pemasukan';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'pemasukan_insForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	
	
	function setTitle(){
		return 'PENGADAAN DAN PENERIMAAN BARANG';
	}
	
	function setMenuEdit(){
		return "";
		/*return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","sections.png","Baru", 'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Atribusi", 'Atribusi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Distribusi", 'Distribusi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Validasi", 'Validasi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Posting", 'Posting')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","export_xls.png","Excel", 'Excel')."</td>";*/
	}
	
	function setMenuView(){
		return "";
	}
	
	function simpanNomorDokumen(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	 //$dokumen_sumber= $_REQUEST['dokumen_sumber2'];
	 $nomdok2= $_REQUEST['nomdok2'];
	 $tgl_dok= $_REQUEST['tgl_doku'];
	 
	 	  
	 //if( $err=='' && $dokumen_sumber =='' ) $err= 'Dokumen Sumber Belum Di Isi !!';
	 if( $err=='' && $nomdok2 =='' ) $err= 'Nomor Dokumen Belum Di Isi !!';
	 if( $err=='' && $tgl_dok =='' ) $err= 'Tanggal Dokumen Belum Di Isi !!';
	 
	 $tgl_dok = explode("-",$tgl_dok);
	 $tgl_dok = $tgl_dok[2].'-'.$tgl_dok[1].'-'.$tgl_dok[0];
	 if( $err=='' && !cektanggal($tgl_dok)) $err= 'Tanggal Dokumen Tidak Valid'; 
	 
	 $ketersediaan = "SELECT count(*) as cnt FROM ref_nomor_dokumen WHERE nomor_dok='$nomdok2' ";
	 $jmldata = mysql_query($ketersediaan);
	 $dtjml = mysql_fetch_array($jmldata);
	 
	 if($err == '' && $dtjml['cnt'] > 0)$err='Nomor Dokumen Telah Ada !';
	 
	 if($fmST == 0){
		if($err==''){
			$aqry = "INSERT into ref_nomor_dokumen (nomor_dok,tgl_dok)values('$nomdok2','$tgl_dok')";	$cek .= $aqry;	
			$qry = mysql_query($aqry);
			$content['nomdok'] = $nomdok2;
		}
	 } //end else
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanPenyedia(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	 
	 $namapenyedia= $_REQUEST['namapenyedia'];
	 $alamatpenyedia= $_REQUEST['alamatpenyedia'];
	 $kotapenyedia= $_REQUEST['kotapenyedia'];
	 $namapimpinan= $_REQUEST['namapimpinan'];
	 $nonpwp= $_REQUEST['nonpwp'];
	 $norekeningbank= $_REQUEST['norekeningbank'];
	 $namabank= $_REQUEST['namabank'];
	 $atasnamabank= $_REQUEST['atasnamabank'];
	 $c1= $_REQUEST['c1nya'];
	 $c= $_REQUEST['cnya'];
	 $d= $_REQUEST['dnya'];
	 
	 	  
	 if( $err=='' && $namapenyedia =='' ) $err= 'Nama Penyedia Belum Di Isi !!';
	 
	 
	 if($fmST == 0){
		if($err==''){
			$aqry = "INSERT into ref_penyedia(c1,c,d,nama_penyedia,alamat,kota,nama_pimpinan,no_npwp,nama_bank,norek_bank,atasnama_bank)values('$c1','$c','$d', '$namapenyedia', '$alamatpenyedia', '$kotapenyedia', '$namapimpinan', '$nonpwp', '$namabank', '$norekeningbank', '$atasnamabank')";	$cek .= $aqry;	
			$qry = mysql_query($aqry);
			
			$dtidpenyedia = "SELECT id,nama_penyedia FROM ref_penyedia WHERE c1='$c1' AND c='$c' AND d='$d' AND nama_penyedia='$namapenyedia' ORDER BY id DESC";
			$qrdtidpenyedia = mysql_query($dtidpenyedia);
			$dtId = mysql_fetch_array($qrdtidpenyedia);
			
			$qrypenyedia = "SELECT id,nama_penyedia FROM ref_penyedia WHERE c1='$c1' AND c='$c' AND d='$d' ";
			
			
			$content['penyedian'] = cmbQuery('penyedian',$dtId['id'],$qrypenyedia," style='width:303px;' ","--- PILIH PENYEDIA BARANG ---");
		}
	 } //end else
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function SimpanSemua(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $coThnAnggaran = $HTTP_COOKIE_VARS['coThnAnggaran'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	 $c1= $_REQUEST['c1nya'];
	 $c= $_REQUEST['cnya'];
	 $d= $_REQUEST['dnya'];
	 $e= $_REQUEST['enya'];
	 $e1= $_REQUEST['e1nya'];
	 
	 $jns_transaksi= $_REQUEST['jns_transaksi'];
	 $asalusul= $_REQUEST['asalusul'];
	 $sumberdana= $_REQUEST['sumberdana'];
	 $metodepengadaan= $_REQUEST['metodepengadaan'];
	 $pencairan_dana= $_REQUEST['pencairan_dana'];
	 $prog= $_REQUEST['prog'];
	 $kegiatan= $_REQUEST['kegiatan'];
	 $pekerjaan	= $_REQUEST['pekerjaan'];
	 $nomdok = $_REQUEST['nomdok'];
	 $tgl_dok = $_REQUEST['tgl_dok'];//Langsung
	 $cara_bayar = $_REQUEST['cara_bayar'];
	 $dokumen_sumber = $_REQUEST['dokumen_sumber'];
	 $tgl_dokumen_bast = $_REQUEST['tgl_dokumen_bast'];
	 $nomor_dokumen_bast = $_REQUEST['nomor_dokumen_bast'];
	 $penyedian = $_REQUEST['penyedian'];
	 $penerima = $_REQUEST['penerima'];
	 $tgl_buku = $_REQUEST['tgl_buku'];
	 
	 //default
	 $metodepengadaan = '1';
	 
	 $tanggal_dokumen_bast = explode("-",$tgl_dokumen_bast);
	 $tgl_dokumen_bast = $tanggal_dokumen_bast[2].'-'.$tanggal_dokumen_bast[1].'-'.$tanggal_dokumen_bast[0];
	 
	 $tgl_pembukuan = explode("-",$tgl_buku);
	 $tgl_buku = $tgl_pembukuan[2]."-".$tgl_pembukuan[1]."-".$tgl_pembukuan[0];
	 
		if($jns_transaksi == '' && $err=='')$err = 'Transaksi Belum di Pilih !';
		if($asalusul == '' && $err=='')$err = 'Cara Perolehan Belum di Pilih !';
		if($sumberdana == '' && $err=='')$err = 'Sumber Dana Belum di Pilih !';
		if($metodepengadaan == '' && $err=='')$err = 'Metode Pengadaan Belum di Pilih !';
		if($pencairan_dana == '' && $err=='')$err = 'Metode Pencairan Dana Belum di Pilih !';
		if($prog == '' && $err=='')$err = 'Program Belum di Isi !';
		if($kegiatan == '' && $err=='')$err = 'Kegiatan Belum di Pilih !';
		if($pekerjaan == '' && $err=='')$err = 'Pekerjaan Belum di Isi !';
		if($nomdok == '' && $err=='')$err = 'Dokumen Kontrak Belum di Pilih !';
		
		
		if($cara_bayar == '' && $err=='')$err = 'Cara Bayar Belum di Pilih !';
		if($dokumen_sumber == '' && $err=='')$err = 'Dokumen Sumber Belum di Pilih !';
		if($tgl_dok == '' && $err=='')$err = 'Tanggal Dokumen Sumber Belum di Isi !';
		if($tgl_dok == '' && $err=='')$err = 'Nomor Dokumen Sumber Belum di Isi !';
		if($tgl_buku == '' && $err=='')$err = 'Tanggal Buku Belum di Isi !';
		
		if( $err=='' && !cektanggal($tgl_dok)) $err= 'Tanggal Dokumen Tidak Valid';
		if( $err=='' && !cektanggal($tgl_dokumen_bast)) $err= 'Tanggal Dokumen BAST Tidak Valid';
		if( $err=='' && !cektanggal($tgl_buku)) $err= 'Tanggal Buku Tidak Valid';
		
		
		
		if($asalusul == '1'){
			$periksasesuai = $this->cekSesuai();
			$contentperiksa = $periksasesuai['content']; 
			if($contentperiksa['statussesuai'] != '1')$err='Total Belanja Dan Rincian Penerimaan Barang Belum Sesuai !';
			$idpenerimaan = $contentperiksa['idpenerimaaan'];
			$cek.=$periksasesuai['cek'];
			
		}
		
		if($err == ''){
			//Penerimaan Barang Detail
			$qrybrgdet = "UPDATE t_penerimaan_barang_det SET status='0', sttemp='0' WHERE refid_terima='$idplh' AND status='1'";$cek.=$qrybrgdet;
			$aqrybrgdet = mysql_query($qrybrgdet);
			
			$qrybrgdel = "DELETE FROM t_penerimaan_barang_det WHERE refid_terima='$idplh' AND status='2' ";$cek.=$qrybrgdel;
			$aqrybrgdel = mysql_query($qrybrgdel);
			
			//Penerimaan Data Rekening
			$qrybrgRek = "UPDATE t_penerimaan_rekening SET sttemp='0' WHERE refid_terima='$idplh' AND status='0'";$cek.=$qrybrgRek;
			$aqrybrgRek = mysql_query($qrybrgRek);
			
			$qrybrgRekdel = "DELETE FROM t_penerimaan_rekening WHERE status='2' AND  refid_terima='$idplh' ";$cek.=$qrybrgRekdel;
			$aqrybrgRekdel = mysql_query($qrybrgRekdel);
			
			//Perbarui Penerimaan
			$simpan = "UPDATE t_penerimaan_barang SET jns_trans='$jns_transaksi', asal_usul='$asalusul', sumber_dana='$sumberdana',metode_pengadaan='$metodepengadaan',pencairan_dana='$pencairan_dana', p='$prog', q='$kegiatan', pekerjaan='$pekerjaan', nomor_kontrak='$nomdok', tgl_kontrak='$tgl_dok', cara_bayar='$cara_bayar', id_penerimaan='$idpenerimaan', dokumen_sumber='$dokumen_sumber', tgl_dokumen_sumber='$tgl_dokumen_bast', no_dokumen_sumber='$nomdok', refid_penyedia='$penyedian', refid_penerima='$penerima', tgl_buku='$tgl_buku', sttemp='0', tahun='$coThnAnggaran' WHERE Id='$idplh' ";$cek.=' || '.$simpan;
			$qrysimpan = mysql_query($simpan);
		}
	  
						
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function set_selector_other2($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;
		
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function set_selector_other($tipe){
	 global $Main,$HTTP_COOKIE_VARS;
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
			$fm = $this->setFormEdit();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
					
		case 'SimpanSemua':{
			$get= $this->SimpanSemua();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		case 'CekSesuai':{
			$get= $this->CekSesuai();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
					
		break;
	    }
		
		case 'SimpanDet':{
			$get= $this->SimpanDet();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		case 'inputpenerimaanDET':{
			$dt = array();
			$dt['FMST_penerimaan_det'] = '0';
			$get= $this->inputpenerimaanDET($dt);
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		case 'UbahRincianPenerimaan':{
			
			$IdRincian = $_REQUEST['IdRincian'];
			
			$qry = "SELECT * FROM v1_penerimaan_barang_det WHERE Id='$IdRincian' ";$cek.=$qry;
			$aqry = mysql_query($qry);
			$dt = mysql_fetch_array($aqry);	
			
			$dt['kodebarangnya'] = $kodebarang = $dt['f1'].'.'.$dt['f2'].'.'.$dt['f'].'.'.$dt['g'].'.'.$dt['h'].'.'.$dt['i'].'.'.$dt['j'] ;	
			$dt['FMST_penerimaan_det'] = '1';	
						
			$get= $this->inputpenerimaanDET($dt);
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		case 'HapusRincianPenerimaan':{
			$cek = '';
			$err = '';
			$content = '';
			$IdRincian='';
			$pemasukan_ins_idplh='';
			if(isset($_REQUEST['IdRincian']))$IdRincian = addslashes($_REQUEST['IdRincian']);
			if(isset($_REQUEST['pemasukan_ins_idplh']))$pemasukan_ins_idplh = addslashes($_REQUEST['pemasukan_ins_idplh']);
			
			if($IdRincian == '' && $err == '')$err = "Data Tidak Ada ?";
			
			if($err == ''){
				$qry = "UPDATE t_penerimaan_barang_det SET status='2' WHERE Id='$IdRincian' AND refid_terima='$pemasukan_ins_idplh' ";$cek.=$qry;
				$aqry = mysql_query($qry);
				if($aqry == FALSE)$err = "Data Tidak Bisa Dihapus !";
			}
			
		break;
	    }
		
		case 'rincianpenerimaanDET':{
			$get= $this->rincianpenerimaanDET();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		case 'caraperolehan':{
			$get= $this->caraperolehan();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		case 'tabelRekening':{
			$pemasukan_ins_idplh = $_REQUEST['pemasukan_ins_idplh'];
			
			if(addslashes($_REQUEST['HapusData'])==1){	
				$qrydel1 = "DELETE FROM t_penerimaan_rekening WHERE refid_terima='$pemasukan_ins_idplh' AND status='1' ";
				$aqrydel1 = mysql_query($qrydel1);
			}
			$get= $this->tabelRekening();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		case 'InsertRekening':{
			$cek = '';
			$err = '';
			$content = '';
			$uid = $HTTP_COOKIE_VARS['coID'];
			$coThnAnggaran = $HTTP_COOKIE_VARS['coThnAnggaran'];
			$pemasukan_ins_idplh = $_REQUEST['pemasukan_ins_idplh'];
			
			$qrydel = "DELETE FROM t_penerimaan_rekening WHERE refid_terima='$pemasukan_ins_idplh' AND status='1' AND uid='$uid'";
			$aqrydel = mysql_query($qrydel);
			
			if($aqrydel){
				$qry="INSERT INTO t_penerimaan_rekening (refid_terima, status,uid, sttemp,tahun) values ('$pemasukan_ins_idplh','1','$uid','1','$coThnAnggaran')";$cek.=$qry;
				$aqry = mysql_query($qry);
				if($aqry){
					$content = 1;
				}else{
					$err= 'Gagal !';
				}
			}			
		break;
	    }
		
		case 'updKodeRek':{
			$cek = '';
			$err = '';
			$content = '';
			$uid = $HTTP_COOKIE_VARS['coID'];
			$pemasukan_ins_idplh = $_REQUEST['pemasukan_ins_idplh'];
			$idrek = $_REQUEST['idrek'];
			$koderek = $_REQUEST['koderek'];
			$jumlahharga = $_REQUEST['jumlahharga'];
			if($jumlahharga < 1 && $err=='')$err='Jumlah Harga Belum Di Isi !';
			
			$qry = "SELECT nm_rekening FROM ref_rekening WHERE concat(k,'.',l,'.',m,'.',n,'.',o) = '$koderek' AND k != '0' AND l != '0' AND m != '0' AND n != '00' AND o != '00'"; $cek.=$qry;
			$aqry = mysql_query($qry);
			
			if(mysql_num_rows($aqry) == 0 && $err=='')$err = "KODE REKENING TIDAK VALID !";
			
			if($err==''){
				$kode = explode(".",$koderek);
				$knya = $kode[0];
				$lnya = $kode[1];
				$mnya = $kode[2];
				$nnya = $kode[3];
				$onya = $kode[4];
				if($_REQUEST['statidrek'] == '1'){
					$qryupd="UPDATE t_penerimaan_rekening SET k='$knya',l = '$lnya',m = '$mnya', n= '$nnya',o= '$onya', jumlah='$jumlahharga', status='0' WHERE refid_terima='$pemasukan_ins_idplh' AND Id='$idrek'";
				}else{
					$qryupd="INSERT INTO t_penerimaan_rekening (k,l,m,n,o,status,refid_terima,sttemp,uid,jumlah)values('$knya','$lnya','$mnya','$nnya','$onya','0','$pemasukan_ins_idplh','0','$uid','$jumlahharga')";
					$updq = "UPDATE t_penerimaan_rekening SET status = '2' WHERE Id='$idrek'";
					$aupdq = mysql_query($updq); 
				}
				$cek.=" | ".$qryupd;
				$aqryupd = mysql_query($qryupd);
				if($aqryupd){
					$content['koderek'] = "<a href='javascript:pemasukan_ins.jadiinput(`".$idrek."`);' />".$koderek."</a>";
					$content['jumlahnya'] = number_format($jumlahharga,2,",",".");
					$content['idrek'] = $idrek;
					$content['option'] = "
				<a href='javascript:pemasukan_ins.HapusRekening(`$idrek`)' />
					<img src='datepicker/remove2.png' style='width:20px;height:20px;' />
				</a>";
				}else{
					$err= 'Gagal !';
				}
			}		
		break;
	    }
		
		case 'HapusRekening':{
			$cek = '';
			$err = '';
			$content = '';
			$uid = $HTTP_COOKIE_VARS['coID'];
			$idrekei = $_REQUEST['idrekei'];
			$pemasukan_ins_idplh = $_REQUEST['pemasukan_ins_idplh'];
			
			$qrydel = "UPDATE t_penerimaan_rekening SET status='2' WHERE Id='$idrekei'";$cek.=$qrydel;
			$aqrydel = mysql_query($qrydel);
			
			$qrydel1 = "DELETE FROM t_penerimaan_rekening WHERE refid_terima='$pemasukan_ins_idplh' AND status='1' AND uid='$uid'";
			$aqrydel1 = mysql_query($qrydel1);
			
			if(!$aqrydel)$err='Gagal Menghapus Data Rekening';
			if(!$aqrydel1)$err='Gagal Menghapus Data Rekening';
					
		break;
	    }
		
		case 'jadiinput':{
			$cek = '';
			$err = '';
			$content = '';
			$uid = $HTTP_COOKIE_VARS['coID'];
			$idrek = $_REQUEST['idrekeningnya'];
			
			$qry = "SELECT * FROM t_penerimaan_rekening WHERE Id='$idrek'";$cek.=$qry;
			$aqry = mysql_query($qry);
			$dt = mysql_fetch_array($aqry);
			
			$content['koderek'] = "
				<input type='text' onkeyup='setTimeout(function myFunction() {pemasukan_ins.namarekening();},100);' name='koderek' id='koderek' value='".$dt['k'].".".$dt['l'].".".$dt['m'].".".$dt['n'].".".$dt['o']."' style='width:80px;' maxlength='11' />
				"."<input type='hidden' name='idrek' id='idrek' value='".$idrek."' />".
				"<input type='hidden' name='statidrek' id='statidrek' value='".$dt['status']."' />
				<a href='javascript:cariRekening.windowShow(".$dt['Id'].");'> <img src='datepicker/search.png' style='width:20px;height:20px;margin-bottom:-5px;'  /></a>
				";
			
			$content['jumlahnya'] = "<input type='text' name='jumlahharga' id='jumlahharga' value='".intval($dt['jumlah'])."' style='text-align:right;' onkeypress='return isNumberKey(event)' onkeyup='document.getElementById(`formatjumlah`).innerHTML = pemasukan_ins.formatCurrency(this.value);' />
							<span id='formatjumlah'></span>";
			$content['idrek'] = $idrek;
			$content['option'] = "
				<a href='javascript:pemasukan_ins.updKodeRek()' />
					<img src='datepicker/save.png' style='width:20px;height:20px;' />
				</a>";
			$content['atasbutton'] = "<a href='javascript:pemasukan_ins.tabelRekening()' /><img src='datepicker/cancel.png' style='width:20px;height:20px;' /></a>";
			
				
		break;
	    }
			
		case 'namarekening':{
			$cek = '';
			$err = '';
			$content = '';
			$idrek = $_REQUEST['idrek'];
			$koderek = addslashes($_REQUEST['koderek']);
			
			$qry = "SELECT nm_rekening FROM ref_rekening WHERE concat(k,'.',l,'.',m,'.',n,'.',o) = '$koderek' AND k<>'0' AND l<>'0' AND m<>'0' AND n<>'00' AND o<>'00'"; $cek.=$qry;
			$aqry = mysql_query($qry);
			$daqry = mysql_fetch_array($aqry);
			$content['namarekening'] = $daqry['nm_rekening'];
			$content['idrek'] = $idrek;
			
		break;
	    }
		
		case 'nomordokumen':{
			$cek = '';
			$err = '';
			$content = '';
			
			$dokumen_sumber = $_REQUEST['dokumen_sumber'];
			$nomdok =$_REQUEST['nom'];
						
			$qrynomdok = "SELECT nomor_dok,nomor_dok FROM ref_nomor_dokumen ";
			$cek.=$qrynomdok;
			$content['isi'] = cmbQuery('nomdok',$nomdok,$qrynomdok," style='width:200px;' onchange='pemasukan_ins.TglNomorDokumen()' ","PILIH");
			
		break;
	    }
		
		case 'Tglnomordokumen':{
			$cek = '';
			$err = '';
			$content = '';
			
			$dokumen_sumber = $_REQUEST['dokumen_sumber'];
			$nomdok =$_REQUEST['nomdok'];
						
			$qrynomdok = "SELECT * FROM ref_nomor_dokumen WHERE nomor_dok='$nomdok' LIMIT 0,1";
			$cek.=$qrynomdok;
			$aqrtnomdok = mysql_query($qrynomdok);
			$dt = mysql_fetch_array($aqrtnomdok);
			
			
			if(mysql_num_rows($aqrtnomdok) != 0){
				$tgl = explode("-",$dt['tgl_dok']);
			
				$content['tgl'] = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
				$content['tgl_dok'] = $dt['tgl_dok'];
			}else{
				$content['tgl_dok'] ='';
				$content['tgl'] = '';
			}
			
			
		break;
	    }
		
		case 'formBaruNomDok':{				
			$fm = $this->setformBaruNomDok();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'simpanNomorDokumen':{				
			$fm = $this->simpanNomorDokumen();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formBaruPenyedia':{				
			$fm = $this->setformBaruPenyedia();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'simpanPenyedia':{				
			$fm = $this->simpanPenyedia();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
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
   
   function pageShow(){
		global $app, $Main; 
		
		$navatas_ = $this->setNavAtas();
		$navatas = $navatas_==''? // '0': '20';
			'':
			"<tr><td height='20'>".
					$navatas_.
			"</td></tr>";
		$form1 = $this->withform? "<form name='$this->FormName' id='$this->FormName' method='post' action=''>" : '';
		$form2 = $this->withform? "</form >": '';
		
		$cbid = $_REQUEST['pemasukan_cb'];
		
		return
		
		//"<html xmlns='http://www.w3.org/1999/xhtml'>".			
		"<html>".
			$this->genHTMLHead().
			"<body >".
			/*"<div id='pageheader'>".$this->setPage_Header()."</div>".
			"<div id='pagecontent'>".$this->setPage_Content()."</div>".
			$Main->CopyRight.*/
							
			"<table id='KerangkaHal' class='menubar' cellspacing='0' cellpadding='0' border='0' width='100%' height='100%' >".
				//header page -------------------		
				"<tr height='34'><td>".					
					//$this->setPage_Header($IconPage, $TitlePage).
					$this->setPage_Header().
					"<div id='header' ></div>".
				"</td></tr>".	
				$navatas.			
				//$this->setPage_HeaderOther().
				//Content ------------------------			
				//style='padding:0 8 0 8'
				"<tr height='*' valign='top'> <td >".
					
					$this->setPage_HeaderOther().
					"<div align='center' class='centermain' >".
					"<div class='main' >".
					$form1.
					"<input type='hidden' name='pemasukanSKPDfmUrusan' value='".$_REQUEST['pemasukanSKPDfmUrusan']."' />".
					"<input type='hidden' name='pemasukanSKPDfmSKPD' value='".$_REQUEST['pemasukanSKPDfmSKPD']."' />".
					"<input type='hidden' name='pemasukanSKPDfmUNIT' value='".$_REQUEST['pemasukanSKPDfmUNIT']."' />".
					"<input type='hidden' name='pemasukanSKPDfmSUBUNIT' value='".$_REQUEST['pemasukanSKPDfmSUBUNIT']."' />".
					"<input type='hidden' name='pemasukanSKPDfmSEKSI' value='".$_REQUEST['pemasukanSKPDfmSEKSI']."' />".
					"<input type='hidden' name='databaru' id='databaru' value='".$_REQUEST['YN']."' />".
					"<input type='hidden' name='idubah' id='idubah' value='".$cbid[0]."' />".
					
						//Form ------------------
						//$hidden.					
						//genSubTitle($TitleDaftar,$SubTitle_menu).						
						$this->setPage_Content().
						//$OtherInForm.
						
					$form2.//"</form>".
					"</div></div>".
				"</td></tr>".
				//$OtherContentPage.				
				//Footer ------------------------
				"<tr><td height='29' >".	
					//$app->genPageFoot(FALSE).
					$Main->CopyRight.							
				"</td></tr>".
				$OtherFooterPage.
			"</table>".
			/*'<script src="assets2/js/bootstrap.min.js"></script>'.
			'<script src="assets2/jquery.min.js"></script>'.*/
			"</body>
		</html>"; 
	}	
   
   function setPage_OtherScript(){
		$scriptload = 
					"<script>
						$(document).ready(function(){ 
							".$this->Prefix.".loading();
						});
						
						setTimeout(function myFunction() {".$this->Prefix.".caraperolehan()},1000);
						setTimeout(function myFunction() {".$this->Prefix.".inputpenerimaan()},1000);
						setTimeout(function myFunction() {".$this->Prefix.".rincianpenerimaan()},1000);
						setTimeout(function myFunction() {".$this->Prefix.".nyalakandatepicker()},1000);
						
					</script>";
		return
			/*'<link href="assets2/css/bootstrap.min.css" rel="stylesheet">'.
			'<script src="assets2/js/bootstrap.min.js"></script>'.
			'<script src="assets2/jquery.min.js"></script>'.*/
			"<script type='text/javascript' src='js/skpd.js' language='JavaScript' ></script>".	
			"<script type='text/javascript' src='js/pengadaanpenerimaan/".strtolower($this->Prefix).".js' language='JavaScript' ></script>".
			"<script type='text/javascript' src='js/pengadaanpenerimaan/pemasukan.js' language='JavaScript' ></script>".
			"<script type='text/javascript' src='js/pencarian/cariprogram.js' language='JavaScript' ></script>".
			"<script type='text/javascript' src='js/pencarian/cariRekening.js' language='JavaScript' ></script>".
			"<script type='text/javascript' src='js/pencarian/cariBarang.js' language='JavaScript' ></script>".
			'
			  <link rel="stylesheet" href="datepicker/jquery-ui.css">
			  <script src="datepicker/jquery-1.12.4.js"></script>
			  <script src="datepicker/jquery-ui.js"></script>
			'.
			$scriptload;
	}
	
	//form ==================================
	function setFormBaru(){
		$dt=array();
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		$dt['tgl'] = date("Y-m-d"); //set waktu sekarang
		$fm = $this->setForm($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setformBaruNomDok(){
		$dt=array();
		$cek = '';$err='';
		
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		 //set waktu sekarang
		
		/*$dokumen_sumber = addslashes($_REQUEST['dokumen_sumber']);	
		$qry = "SELECT * FROM ref_dokumensumber WHERE id='$dokumen_sumber' LIMIT 0,1";$cek.=$qry;
		$aqry = mysql_query($qry);
		$dt = mysql_fetch_array($aqry);*/
		$dt['tgl'] = date("d-m-Y");
		//if(!isset($dt['id']))$err='Dokumen Sumber Belum dipilih !';
		
		if($err == '')$fm = $this->setFormNomDok($dt);
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormNomDok($dt){	
	 global $SensusTmp;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 450;
	 $this->form_height = 100;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'BARU DOKUMEN SUMBER';
		$nip	 = '';
	  }else{
		$this->form_caption = 'UBAH DOKUMEN SUMBER';			
		$Id = $dt['Id'];			
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
	 //items ----------------------
	  $this->form_fields = array(
			/*'doksum' => array( 
						'label'=>'DOKUMEN SUMBER',
						'labelWidth'=>150, 
						'value'=>$dt['nama_dokumen'], 
						'type'=>'text',
						'param'=>"style='width:250px;' readonly"
						 ),*/
			'nomdok2' => array( 
						'label'=>'NOMOR',
						'labelWidth'=>150, 
						'value'=>'', 
						'type'=>'text',
						'param'=>"style='width:250px;'"
						 ),
			/*'datepicker' => array( 
						'label'=>'TANGGAL',
						'labelWidth'=>150, 
						'value'=>$dt['tgl'], 
						'type'=>'text',
						'param'=>"style='width:100px;'"
						 ),*/
			'tgl' => array( 
						'label'=>'TANGGAL',
						'labelWidth'=>150, 
						'value'=>"<input type='text' name='tgl_doku' id='tgl_doku' class='datepicker' style='width:80px;' value='".$dt['tgl']."' />", 
						
						 ),
						
			
			);
		//tombol
		$this->form_menubawah =
			//"<input type='hidden' name='dokumen_sumber2' id='dokumen_sumber2' value='".$dt['id']."' />".
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanNomorDokumen()' title='Simpan' >".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function setformBaruPenyedia(){
		global $Ref, $Main, $HTTP_COOKIE_VARS;
		$dt=array();
		$cek = '';$err='';
		
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		 //set waktu sekarang
		
		$dt['tgl'] = date("d-m-Y");
		$dt['c1'] = $_REQUEST['pemasukanSKPDfmUrusan'];
		$dt['c'] = $_COOKIE['cofmSKPD'];
		$dt['d'] = $_COOKIE['cofmUNIT'];
		$dt['idweh'] = $_REQUEST['pemasukan_ins_idplh'];
		
		if($err == '')$fm = $this->setFormPenyedia($dt);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormPenyedia($dt){	
	 global $SensusTmp, $Ref, $Main, $HTTP_COOKIE_VARS;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 470;
	 $this->form_height = 300;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'BARU PENYEDIA BARANG';
		$nip	 = '';
	  }else{
		$this->form_caption = 'UBAH DOKUMEN SUMBER';			
		$Id = $dt['Id'];			
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
	 //items ----------------------
	  $this->form_fields = array(
			'namapenyedia' => array( 
						'label'=>'NAMA PENYEDIA',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NAMA PENYEDIA'"
						 ),
			'alamatpenyedia' => array( 
						'label'=>'ALAMAT LENGKAP',
						'labelWidth'=>150, 
						'value'=>"<textarea name='alamatpenyedia' id='alamatpenyedia' style='width:270px;height:50px;' placeholder='ALAMAT LENGKAP'></textarea>",
						 ),
			'kotapenyedia' => array( 
						'label'=>'KOTA / KABUPATEN',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='KOTA / KABUPATEN'"
						 ),
			'namapimpinan' => array( 
						'label'=>'NAMA PIMPINAN',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NAMA PIMPINAN'"
						 ),
			'nonpwp' => array( 
						'label'=>'NO NPWP',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' maxlength='25' placeholder='NO NPWP'"
						 ),
			'norekeningbank' => array( 
						'label'=>'NO REKENING BANK',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' maxlength='30' placeholder='NO REKENING BANK'"
						 ),
			'namabank' => array( 
						'label'=>'NAMA BANK',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NAMA BANK'"
						 ),
			'atasnamabank' => array( 
						'label'=>'ATAS NAMA BANK',
						'labelWidth'=>150, 
						'value'=>"", 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='ATAS NAMA BANK'"
						 ),
			);
		//tombol
		$this->form_menubawah =
			/*"<input type='text' name='idweh' id='c1nya' value='".$dt['idweh']."' />".*/
			"<input type='hidden' name='c1nya' id='c1nya' value='".$dt['c1']."' />".
			"<input type='hidden' name='cnya' id='cnya' value='".$dt['c']."' />".
			"<input type='hidden' name='dnya' id='dnya' value='".$dt['d']."' />".
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanPenyedia()' title='Simpan' >".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
   
  	function setFormEdit(){
		$cek ='';
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;				
		//get data 
		$aqry = "SELECT * FROM  ref_satuan WHERE Id='".$this->form_idplh."' "; $cek.=$aqry;
		$dt = mysql_fetch_array(mysql_query($aqry));
		$fm = $this->setForm($dt);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}	
		
	function setForm($dt){	
	 global $SensusTmp;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 300;
	 $this->form_height = 50;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		$nip	 = '';
	  }else{
		$this->form_caption = 'Edit';			
		$Id = $dt['Id'];			
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
	 //items ----------------------
	  $this->form_fields = array(
			'nama' => array( 
						'label'=>'Satuan',
						'labelWidth'=>100, 
						'value'=>$dt['nama'], 
						'type'=>'text',
						'param'=>"style='width:200px;'"
						 ),			
			
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan()' title='Simpan' >".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function setPage_HeaderOther(){
	return 
			/*"<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='margin:0 0 0 0'>
	<tr><td class=\"menudottedline\" width=\"40%\" height=\"20\" style='text-align:right'><B>
	<A href=\"pages.php?Pg=bagian\" title='Organisasi' >Organisasi</a> |
	<A href=\"pages.php?Pg=pegawai\" title='Pegawai' >Pegawai</a> |
	<A href=\"pages.php?Pg=barang\" title='Barang'>Barang</a> |
	<A href=\"pages.php?Pg=jenis\" title='Jenis'  >Jenis</a> |
	<A href=\"pages.php?Pg=satuan\" title='Satuan' style='color:blue' >Satuan</a> 
	&nbsp&nbsp&nbsp	
	</td></tr></table>"*/"";
	}
		
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
	  	   <th class='th01' width='5' rowspan='2'>No.</th>
	  	   $Checkbox		
		   <th class='th01' rowspan='2'>TANGGAL BAST/ BUKU</th>
		   <th class='th01' rowspan='2'>NO BAST/ID PENERIMAAN</th>
		   <th class='th02' colspan='2'>DOKUMEN SUMBER</th>
		   <th class='th01' rowspan='2'>SUMBER DANA/ KODE AKUN / PENYEDIA BARANG</th>
		   <th class='th01' rowspan='2'>NAMA BARANG</th>
		   <th class='th01' rowspan='2'>MERK / TYPE/ SPESIFIKASI/ LOKASI</th>
		   <th class='th01' rowspan='2'>JUMLAH</th>
		   <th class='th01' rowspan='2'>HARGA SATUAN</th>
		   <th class='th01' rowspan='2'>JUMLAH HARGA</th>
		   <th class='th01' rowspan='2'>HARGA ATRIBUSI</th>
		   <th class='th01' rowspan='2'>HARGA PEROLEHAN</th>
		   <th class='th01' rowspan='2'>ADA ATRIBUSI</th>
		   <th class='th02' colspan='2'>DISTRIBUSI</th>
		   <th class='th01' rowspan='2'>VALIDASI</th>
		   <th class='th01' rowspan='2'>POSTING</th>
		   <th class='th01' rowspan='2'>KET.</th>
	   </tr>
	   <tr>
	   		<th class='th01'>DOKUMEN</th>
	   		<th class='th01'>TANGGAL DAN NOMOR</th>
	   		<th class='th01'>Y/T</th>
	   		<th class='th01'>SESUAI</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 $Koloms[] = array('align="left"',$isi['tgl_buku']."<br>".$isi['tgl_bast']);
	 $Koloms[] = array('align="left"',$isi['no_bast']."/".$isi['id_penerimaan']);
	 $Koloms[] = array('align="left"',$isi['id_dok_sumber']);
	 $Koloms[] = array('align="left"',$isi['nomor_dok']);
	 $Koloms[] = array('align="left"',$isi['sumber_dana']."<br>".$isi['ka'].".".$isi['kb'].".".$isi['kc'].".".$isi['kd'].".".$isi['ke'].".".$isi['kf']."<br>".$isi['id_penyedia']);
	 $Koloms[] = array('align="left"',"Nama Barang");
	 $Koloms[] = array('align="left"',"Keterangan Barang");
	 $Koloms[] = array('align="left"',"Jumlah");
	 $Koloms[] = array('align="left"',"Harga Satuan");
	 $Koloms[] = array('align="left"',"Jumlah Harga");
	 $Koloms[] = array('align="left"',"Harga Atribusi");
	 $Koloms[] = array('align="left"',"Harga Perolehan");
	 $Koloms[] = array('align="left"',"ada atribusi");
	 $Koloms[] = array('align="left"',"");
	 $Koloms[] = array('align="left"',"");
	 $Koloms[] = array('align="left"',"");
	 $Koloms[] = array('align="left"',"");
	 $Koloms[] = array('align="left"',"");
	 return $Koloms;
	}
	
	function tabelRekening(){
		$cek = '';
		$err = '';
		$jml_harga=0;
		$datanya='';
		
		$refid_terima = addslashes($_REQUEST[$this->Prefix."_idplh"]);
		$qry = "SELECT a.*,b.nm_rekening FROM t_penerimaan_rekening a LEFT JOIN ref_rekening b ON a.k=b.k AND a.l=b.l AND a.m=b.m AND a.n=b.n AND a.o=b.o WHERE a.refid_terima = '$refid_terima' AND status != '2' ORDER BY Id DESC";$cek.=$qry;
		$aqry = mysql_query($qry);
		$no=1;
		while($dt = mysql_fetch_array($aqry)){
			if($dt['status'] == '0'){
				$kode = "
					<a href='javascript:pemasukan_ins.jadiinput(`".$dt['Id']."`,`".$dt['k'].".".$dt['l'].".".$dt['m'].".".$dt['n'].".".$dt['o']."`);' />
						".$dt['k'].".".$dt['l'].".".$dt['m'].".".$dt['n'].".".$dt['o']."
					</a>
					";
				
				$idrek = '';
				
				$jumlahnya = number_format($dt['jumlah'],2,",",".");
				$btn ="
				<a href='javascript:pemasukan_ins.HapusRekening(`".$dt['Id']."`)' />
					<img src='datepicker/remove2.png' style='width:20px;height:20px;' />
				</a>";
				
				
			}
			
			if($dt['status'] == '1'){
			// DENGAN INPUTAN TEXT
				$kode = "<input type='text' onkeyup='setTimeout(function myFunction() {pemasukan_ins.namarekening();},100);' name='koderek' id='koderek' value='".$dt['k'].".".$dt['l'].".".$dt['m'].".".$dt['n'].".".$dt['o']."' style='width:80px;' maxlength='11' />"
				."<a href='javascript:cariRekening.windowShow(".$dt['Id'].");'> <img src='datepicker/search.png' style='width:20px;height:20px;margin-bottom:-5px;'  /></a>"
				;
						 
				$idrek = "<input type='hidden' name='idrek' id='idrek' value='".$dt['Id']."' />".
						"<input type='hidden' name='statidrek' id='statidrek' value='".$dt['status']."' />";
				
				$jumlahnya = "
					
							<input type='text' name='jumlahharga' id='jumlahharga' value='".intval($dt['jumlah'])."' style='text-align:right;' onkeypress='return isNumberKey(event)' onkeyup='document.getElementById(`formatjumlah`).innerHTML = pemasukan_ins.formatCurrency(this.value);' />
							<span id='formatjumlah'></span>
							
						";
				
				$btn ="
						<a href='javascript:pemasukan_ins.updKodeRek()' />
							<img src='datepicker/save.png' style='width:20px;height:20px;' />
						</a>
						";
			}
			
			$datanya.="
				<tr class='row0'>
					<td class='GarisDaftar' align='right'>$no</td>
					<td class='GarisDaftar' align='center'>
						<span id='koderekeningnya_".$dt['Id']."' >
							$kode $idrek
						</span>
					</td>
					<td class='GarisDaftar'>
						<span id='namaakun_".$dt['Id']."'>".$dt['nm_rekening']."</span>
					</td>
					<td class='GarisDaftar' align='right'>
						<span id='jumlanya_".$dt['Id']."'>$jumlahnya</span>
					</td>
					<td class='GarisDaftar' align='center'>
						<span id='option_".$dt['Id']."'>$btn</span>
					</td>
				</tr>
			";
			$no = $no+1;
			$jml_harga = $jml_harga+intval($dt['jumlah']);
		}
		
						
					
		$content['tabel'] =
			genFilterBar(
				array("
					<table class='koptable' style='min-width:780px;' border='1'>
						<tr>
							<th class='th01'>NO</th>
							<th class='th01' width='50px'>KODE REKENING</th>
							<th class='th01'>NAMA REKENING BELANJA</th>
							<th class='th01'>JUMLAH (Rp)</th>
							<th class='th01'>
								<span id='atasbutton'>
								<a href='javascript:pemasukan_ins.BaruRekening()' /><img src='datepicker/add-256.png' style='width:20px;height:20px;' /></a>
								</span>
							</th>
						</tr>
						$datanya
						
					</table>"
				)
			,'','','')
		;
		$content['jumlah'] = 
				$this->isiform(
						array(
								array(
									'label'=>'TOTAL BELANJA',
									'label-width'=>'200px;',
									'name'=>'totalbelanja',
									'value'=>"<input type='text' name='totalbelanja' id='totalbelanja' value='".number_format($jml_harga,2,",",".")."' style='width:150px;text-align:right' readonly /><span id='jumlahsudahsesuai'><input type='checkbox' name='jumlah_sesuai' value='1' id='jumlah_sesuai' style='margin-left:20px;' disabled /><span style='font-weight:bold;color:red;'>TOTAL HARGA SESUAI</span></span>",
									
								),
						)
				);
		$content['atasbutton'] = "<a href='javascript:pemasukan_ins.tabelRekening()' /><img src='datepicker/cancel.png' style='width:20px;height:20px;' /></a>";
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function genDaftarOpsi(){
	 global $Ref, $Main, $HTTP_COOKIE_VARS;
	 
	$arr = array(
			//array('selectAll','Semua'),	
			array('selectSatuan','Satuan'),		
			);
	$jns_trans = array(
			//array('selectAll','Semua'),	
			array('1','PENGADAAN BARANG'),	
			array('2','PEMELIHARAAN BARANG'),			
			);
	
	$arr_cara_bayar = array(
			//array('selectAll','Semua'),	
			array('1','UANG MUKA'),	
			array('2','TERMIN'),			
			array('3','PELUNASAN'),			
			);
	
	$cara_perolehan = array(
			//array('selectAll','Semua'),	
			array('1','PEMBELIAN'),	
			array('2','HIBAH'),			
			array('3','LAINNYA'),			
			);
	
	
	
	$arr_dokumen_sumber = array(
			array('1', "BAST"),
			array('2', "BAKF"),
			array('3', "BA HIBAH"),
			array('4', "SURAT KEPUTUSAN"),
			);
	 //data order ------------------------------
	 $arrOrder = array(
			     	array('1','Satuan'),
					);
	 
	$fmPILCARI = $_REQUEST['fmPILCARI'];	
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];		
	//tgl bulan dan tahun
	$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];
	$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
	$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
	$fmORDER1 = cekPOST('fmORDER1');
	$fmDESC1 = cekPOST('fmDESC1');
	
	if(isset($_REQUEST['databaru'])){
		if(addslashes($_REQUEST['databaru'] == '1')){
			$c1input = $_REQUEST['pemasukanSKPDfmUrusan'];
			$cinput = $_REQUEST['pemasukanSKPDfmSKPD'];
			$dinput = $_REQUEST['pemasukanSKPDfmUNIT'];
			$einput = $_REQUEST['pemasukanSKPDfmSUBUNIT'];
			$e1input = $_REQUEST['pemasukanSKPDfmSEKSI'];
			
			
			$uid = $HTTP_COOKIE_VARS['coID'];
			
			$qrybarupenerimaan = "INSERT INTO t_penerimaan_barang (c1,c,d,e,e1,uid,sttemp) values ('$c1input', '$cinput', '$dinput', '$einput', '$e1input', '$uid', '1')";
			$aqrybarupenerimaan = mysql_query($qrybarupenerimaan);
			
			$tmpl = "SELECT * FROM t_penerimaan_barang WHERE c1='$c1input' AND c='$cinput' AND d='$dinput' AND e='$einput' AND e1='$e1input' AND uid = '$uid' AND sttemp='1' ORDER BY Id DESC ";
			$qrytmpl = mysql_query($tmpl);
			$dataqrytmpl = mysql_fetch_array($qrytmpl);
			
			//Tambahan 
			$jns_transaksi = 1;
			$asalusul = 1;
			$sumberdana = "APBD";
			$cara_bayar = '3';
			$dokumen_sumber = '1';
			$tgl_dokumen_bast = date('d-m-Y');
			$nomor_dokumen_bast = '';
			$penyedia = '';
			$penerima = '';
			$tgl_buku = date('d-m-Y');
		}else{
			
			$IDUBAH = $_REQUEST['idubah'];
			$tmpl = "SELECT * FROM t_penerimaan_barang WHERE Id='$IDUBAH' ORDER BY Id DESC ";
			$qrytmpl = mysql_query($tmpl);
			$dataqrytmpl = mysql_fetch_array($qrytmpl);
			
			$jns_transaksi = $dataqrytmpl['jns_trans'];
			$asalusul = $dataqrytmpl['asal_usul'];
			$sumberdana = $dataqrytmpl['sumber_dana'];
			$cara_bayar = $dataqrytmpl['cara_bayar'];
			$dokumen_sumber = $dataqrytmpl['dokumen_sumber'];
			$tgl_dokumen_bast = explode("-",$dataqrytmpl['tgl_dokumen_sumber']);
			$tgl_dokumen_bast = $tgl_dokumen_bast[2]."-".$tgl_dokumen_bast[1]."-".$tgl_dokumen_bast[0];
			$nomor_dokumen_bast = $dataqrytmpl['no_dokumen_sumber'];
			$penyedia = $dataqrytmpl['refid_penyedia'];
			$penerima = $dataqrytmpl['refid_penerima'];
			$tgl_buku = explode("-",$dataqrytmpl['tgl_buku']);
			$tgl_buku = $tgl_buku[2]."-".$tgl_buku[1]."-".$tgl_buku[0];
			
		}
		
	}
	
	
	
	$idplhnya = $dataqrytmpl['Id'];
	$c1 = $dataqrytmpl['c1'];
	$c = $dataqrytmpl['c'];
	$d = $dataqrytmpl['d'];
	$e = $dataqrytmpl['e'];
	$e1 = $dataqrytmpl['e1'];
	
	$qry = "SELECT * FROM ref_skpd WHERE c='$c' AND d='00' AND e='00' AND e1='000'";$cek.=$qry;
	$aqry = mysql_query($qry);
	$data = mysql_fetch_array($aqry);
	
	$qry1 = "SELECT * FROM ref_skpd WHERE c='$c' AND d='$d' AND e='00' AND e1='000'";$cek.=$qry1;
	$aqry1 = mysql_query($qry1);
	$data1 = mysql_fetch_array($aqry1);
	
	$qry2 = "SELECT * FROM ref_skpd WHERE c='$c' AND d='$d' AND e='$e' AND e1='000'";$cek.=$qry2;
	$aqry2 = mysql_query($qry2);
	$data2 = mysql_fetch_array($aqry2);
	
	$qry3 = "SELECT * FROM ref_skpd WHERE c='$c' AND d='$d' AND e='$e' AND e1='$e1'";$cek.=$qry3;
	$aqry3 = mysql_query($qry3);
	$data3 = mysql_fetch_array($aqry3);
	
	$qry4 = "SELECT * FROM ref_skpd WHERE c1='$c1' AND c='00' AND d='00' AND e='00' AND e1='000'";$cek.=$qry;
	$aqry4 = mysql_query($qry4);
	$data4 = mysql_fetch_array($aqry4);
		

	
	$qrysumber_dn = "SELECT nama,nama FROM ref_sumber_dana";$cek.=$qrysumber_dn;
	
	$qrypenyedia = "SELECT id,nama_penyedia FROM ref_penyedia WHERE c1= '$c1' AND c='$c' AND d='$d'";
	
	$qrypenerima = "SELECT id,nama_pegawai FROM ref_penerimabarang WHERE c1= '$c1' AND c='$c' AND d='$d'";
	
	$TampilOpt =
			
			
			$vOrder=
			"<input type='hidden' name='c1nya' value='$c1' id='c1nya' />".
			"<input type='hidden' name='cnya' value='$c' id='cnya' />".
			"<input type='hidden' name='dnya' value='$d' id='dnya' />".
			"<input type='hidden' name='enya' value='$e' id='enya' />".
			"<input type='hidden' name='e1nya' value='$e1' id='e1nya' />".
			genFilterBar(
				array(
					$this->isiform(
						array(
							array(
								'label'=>'URUSAN',
								'name'=>'urusan',
								'label-width'=>'200px;',
								'type'=>'text',
								'value'=>$data4['c1'].'. '.$data4['nm_skpd'],
								'align'=>'left',
								'parrams'=>"style='width:400px;' readonly",
							),
							array(
								'label'=>'BIDANG',
								'name'=>'bidang',
								'label-width'=>'200px;',
								'type'=>'text',
								'value'=>$c.'. '.$data['nm_skpd'],
								'align'=>'left',
								'parrams'=>"style='width:400px;' readonly",
							),
							array(
								'label'=>'SKPD',
								'name'=>'skpd',
								'label-width'=>'200px;',
								'type'=>'text',
								'value'=>$d.'. '.$data1['nm_skpd'],
								'align'=>'left',
								'parrams'=>"style='width:400px;' readonly",
							),
							array(
								'label'=>'UNIT',
								'name'=>'unit',
								'label-width'=>'200px;',
								'type'=>'text',
								'value'=>$e.'. '.$data2['nm_skpd'],
								'align'=>'left',
								'parrams'=>"style='width:400px;' readonly",
							),
							array(
								'label'=>'SUB UNIT',
								'name'=>'subunit',
								'label-width'=>'200px',
								'type'=>'text',
								'value'=>$e1.'. '.$data3['nm_skpd'],
								'parrams'=>"style='width:400px;' readonly",
							),
						)
					)
				
				),'','','').
				
				genFilterBar(
				array(
					$this->isiform(
						array(
							array(
								'label'=>'TRANSAKSI',
								'name'=>'transaksi',
								'label-width'=>'200px;',
								'value'=>cmbArray('jns_transaksi',$jns_transaksi,$jns_trans,"--- PILIH JENIS TRANSAKSI ---", "style='width:300px;'"),
							),
							array(
								'label'=>'CARA PEROLEHAN',
								'name'=>'asalusul',
								'label-width'=>'200px;',
								'value'=>cmbArray('asalusul',$asalusul,$cara_perolehan,"--- PILIH CARA PEROLEHAN ---", "style='width:300px;' onchange='pemasukan_ins.caraperolehan()' "),
							),
							array(
								'label'=>'SUMBER DANA',
								'name'=>'sumberdana',
								'label-width'=>'200px;',
								'value'=>cmbQuery('sumberdana',$sumberdana,$qrysumber_dn, "style='width:300px;' onchange='pemasukan_ins.CekSesuai()' ","--- PILIH SUMBER DANA ---"),
							),						
						)
					).
					'<span id="pilCaraPerolehan"></span>'
				
				),'','','').
				
					"<div id='tbl_rekening' style='width:100%;'></div>".
								
				genFilterBar(
				array(
					"<span id='totalbelanja23'></span>".
					$this->isiform(
						array(
								array(
								'label'=>'SISTEM PEMBAYARAN',
								'label-width'=>'200px;',
								'value'=>cmbArray('cara_bayar',$cara_bayar,$arr_cara_bayar,"--- PILIH JENIS TRANSAKSI ---", "style='width:150px;'"),
								),
								array(
									'label'=>'ID PENERIMAAN',
									'label-width'=>'200px;',
									'type'=>'text',
									'name'=>'idpenerimaan',
									'value'=>'',
									'parrams'=>"style='width:300px;text-align:left' readonly"
									,
								),
								array(
								'label'=>'DOKUMEN SUMBER',
								'name'=>'dokumensumber',
								'label-width'=>'200px;',
								'value'=>cmbArray('dokumen_sumber',$dokumen_sumber,$arr_dokumen_sumber,'--- PILIH DOKUMEN SUMBER ---'," style='width:150px;' ")
										
								,						
								),
								array(
								'label'=>'TANGGAL DAN NOMOR',
								'name'=>'dokumensumber',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='tgl_dokumen_bast' id='tgl_dokumen_bast' class='datepicker' value='$tgl_dokumen_bast' style='width:80px;' /> <input type='text' name='nomor_dokumen_bast' id='nomor_dokumen_bast' value='$nomor_dokumen_bast' style='width:258px;' /> "
										
								,						
								),
								array(
									'label'=>'PENYEDIA BARANG',
									'label-width'=>'200px;',
									'value'=>"<span id='dafpenyedia'>".cmbQuery('penyedian',$penyedia,$qrypenyedia," style='width:303px;' ",'--- PILIH PENYEDIA BARANG ---')."</span> ".
											"<input type='button' name='BaruPenyedia' value='BARU' onclick='pemasukan_ins.BaruPenyedia()' />"
									,
								),
								array(
									'label'=>'PENERIMA BARANG',
									'label-width'=>'200px;',
									'value'=>"<span id='dafpenerima'>".cmbQuery('penerima',$penerima,$qrypenerima," style='width:303px;' ",'--- PILIH PENERIMA BARANG ---')."</span> ".
											"<input type='button' name='BaruPenerima' value='BARU' />"
									,					
								),
								array(
								'label'=>'TANGGAL BUKU',
								'name'=>'dokumensumber',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='tgl_buku' id='tgl_buku' value='$tgl_buku' style='width:80px;' onchange='pemasukan_ins.CekSesuai()'  class='datepicker'  />"
										
								,						
								),
								
						)
					)
				
				),'','','').
				
				genFilterBar(
				array(
					"<span id='inputpenerimaanbarang' style='color:black;font-size:14px;font-weight:bold;'/>INPUT PENERIMAAN BARANG</span>",
					
				
				),'','','').
				"<div id='databarangnya'></div>".
				genFilterBar(
				array(
					"<a href='javascript:pemasukan_ins.rincianpenerimaan();'><span id='rincianpenerimaanbarang' style='color:black;font-size:14px;font-weight:bold;' />RINCIAN PENERIMAAN BARANG</span></a>",
					
				
				),'','','').
				"<div id='rinciandatabarangnya'></div>".
				genFilterBar(
				array(
					"<input type='hidden' name='".$this->Prefix."_idplh' id='".$this->Prefix."_idplh' value='$idplhnya' />",
					
				
				),'','','')
								
			;
			
			
		return array('TampilOpt'=>$TampilOpt);
	}
	
	function caraperolehan(){
		global $Ref, $Main, $HTTP_COOKIE_VARS;
		$cek = '';$err='';
		$arr_metode_pengad = array(
			array('1', "PIHAK KE 3"),
			array('2', "SWAKELOLA"),
			);
		
		$arr_pencairan_dana = array(
			array('1', "SPP-LS"),
			array('2', "SPP-UP"),
			array('3', "SPP-GU"),
			array('4', "SPP-TU"),
			);
		if(addslashes($_REQUEST['databaru'] == '1')){	
			
			//TRANSAKSI
			$metodepengadaan='1';
			$pencairan_dana='1';
			
			//p,q
			$programnya = '';
			$prog = '';
			$kegiatan='';
			$qrykegitan = "SELECT q,nama_program_kegiatan FROM ref_programkegiatan WHERE p='00' AND q='00'";
			
			$kegiatanDSBL ='disabled';
			
			//PEKERJAAN
			$pekerjaan = '';
			
			//DOKUMEN
			$tgl_dok='';
			$tgl_dokcopy='';
			$nomdok='';
			
		}else{
			$IDUBAH = $_REQUEST['idubah'];
			$tmpl = "SELECT * FROM t_penerimaan_barang WHERE Id='$IDUBAH' ORDER BY Id DESC ";
			$qrytmpl = mysql_query($tmpl);
			$dataqrytmpl = mysql_fetch_array($qrytmpl);
			
			//TRANSAKSI
			$metodepengadaan=$dataqrytmpl['metode_pengadaan'];
			$pencairan_dana=$dataqrytmpl['pencairan_dana'];
			
			//p,q
			$prog = $dataqrytmpl['p'];
			$cariprogmnya = "SELECT p,nama_program_kegiatan FROM ref_programkegiatan WHERE p='".$prog."' AND q='00'";
			$qrycariprogmnya = mysql_fetch_array(mysql_query($cariprogmnya));
			
			$programnya = $qrycariprogmnya['p'].". ". $qrycariprogmnya['nama_program_kegiatan'];
						
			$kegiatanDSBL ='';
			$qrykegitan = "SELECT q,concat(q,'. ',nama_program_kegiatan) as nama FROM ref_programkegiatan WHERE p='".$qrycariprogmnya['p']."' AND q!='00'";
			$kegiatan=$dataqrytmpl['q'];
			
			//PEKERJAAN
			$pekerjaan = $dataqrytmpl['pekerjaan'];
			
			//DOKUMEN
			$tgl_dok=$dataqrytmpl['tgl_kontrak'];
			$tgl_dokcopy=explode("-", $tgl_dok);
			$tgl_dokcopy=$tgl_dokcopy[2]."-".$tgl_dokcopy[1]."-".$tgl_dokcopy[0];
			
			$nomdok=$dataqrytmpl['nomor_kontrak'];
		}
			
		
	
		$qrynomdok = "SELECT nomor_dok,nomor_dok FROM ref_nomor_dokumen";
			
		$content = $this->isiform(
						array(
							array(
								'label'=>'METODE PENGADAAN',
								'name'=>'metodepengadaan',
								'label-width'=>'200px;',
								'value'=>cmbArray('metodepengadaan',$metodepengadaan,$arr_metode_pengad,"--- PILIH METODE PENGADAAN DANA ---", "style='width:300px;' disabled"),
							),
							array(
								'label'=>'MEKANISME PENCAIRAN DANA',
								'name'=>'pencairan_dana',
								'label-width'=>'200px;',
								'value'=>cmbArray('pencairan_dana',$pencairan_dana,$arr_pencairan_dana,"--- PILIH MEKANISME PENCAIRAN DANA ---", "style='width:300px;'"),
							),
							array(
								'label'=>'PROGRAM',
								'name'=>'program',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='program' value='$programnya' readonly id='program' style='width:500px;' />
									<input type='button' name='progcar' id='progcar' value='CARI' onclick='pemasukan_ins.CariProgram()' />
									<input type='hidden' name='prog' value='$prog' id='prog' />
								",
							),
							array(
								'label'=>'KEGIATAN',
								'name'=>'kegiatan',
								'label-width'=>'200px;',
								'value'=>"<div id='dafkeg'>".cmbQuery('kegiatan',$kegiatan,$qrykegitan,"$kegiatanDSBL style='width:500px;' ",'--- PILIH KEGIATAN ---')."</div>"
										
								,
							),
							array(
								'label'=>'PEKERJAAN',
								'name'=>'pekerjaan',
								'label-width'=>'140px',
								'type'=>'text',
								'value'=>$pekerjaan,
								'parrams'=>"style='width:500px;' placeholder='PEKERJAAN'",
							),
							array(
								'label'=>'DOKUMEN KONTRAK',
								'name'=>'dokumensumber',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='tgl_dokcopy' value='$tgl_dokcopy' id='tgl_dokcopy' readonly style='width:100px;' /> ".
								"<span id='nomber'>".cmbQuery('nomdok',$nomdok,$qrynomdok," style='width:200px;'  onchange='pemasukan_ins.TglNomorDokumen()' ","--- PILIH NOMOR DOKUMEN ---")."</span>".
								"<input type='hidden' name='tgl_dok' id='tgl_dok' value='$tgl_dok' /> ".
								"<input type='button' name='BaruNomDok' id='BaruNoDok' value='BARU' onclick='pemasukan_ins.BaruNomDok()' />"
										
								,
							),
			)
		);
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function isiform($value){
		$isinya = '';
		$tbl ='<table width="100%">';
		for($i=0;$i<count($value);$i++){
			if(!isset($value[$i]['align']))$value[$i]['align'] = "left";
			if(!isset($value[$i]['valign']))$value[$i]['valign'] = "top";
			
			if(isset($value[$i]['type'])){
				switch ($value[$i]['type']){
					case "text" :
						$isinya = "<input type='text' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					case "hidden" :
						$isinya = "<input type='hidden' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					case "password" :
						$isinya = "<input type='password' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					default:
						$isinya = $value[$i]['value'];
					break;					
				}
			}else{
				$isinya = $value[$i]['value'];
			}
			
			$tbl .= "
				<tr>
					<td width='".$value[$i]['label-width']."' valign='top'>".$value[$i]['label']."</td>
					<td width='10px' valign='top'>:<br></td>
					<td align='".$value[$i]['align']."' valign='".$value[$i]['valign']."'> $isinya</td>
				</tr>
			";		
		}
		$tbl .= '</table>';
		
		return $tbl;
	}
	
	
	
	function tampilarrnya($value, $width='12'){
		$gabung = '<div class="col-lg-'.$width.' form-horizontal well bs-component"><fieldset>';
		for($i=0;$i<count($value);$i++){
			
			if(isset($value[$i]['type'])){
				switch ($value[$i]['type']){
					case "text" :
						$isinya = "<input type='text' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					case "hidden" :
						$isinya = "<input type='hidden' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					case "password" :
						$isinya = "<input type='password' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					default:
						$isinya = $value[$i]['value'];
					break;					
				}
			}else{
				$isinya = $value[$i]['value'];
			}
			
			$gabung .='<div class="form-group">
				<label for="'.$value[$i]['name'].'" class="col-lg-'.$value[$i]['label-width'].' control-label" style="text-align:left;font-size:15px;font-weight: bold;">'.$value[$i]['label'].' </label>
				<label class="col-lg-1 control-label" style="text-align:center;">:</label>
      			<div class="col-lg-'.$value[$i]['isi-width'].'">
					'.$isinya.'
				</div>
    		</div>';
		}
		$gabung .= '</fieldset></div>';
		return $gabung;
	}			
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
				
		$arrKondisi = array();		
		
		$fmPILCARI = $_REQUEST['fmPILCARI'];	
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
		//cari tgl,bln,thn
		$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];			
		$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
		$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
		//Cari 
		switch($fmPILCARI){			
			case 'selectSatuan': $arrKondisi[] = " nama like '%$fmPILCARIvalue%'"; break;						 	
		}
		if(!empty($fmFiltTglBtw_tgl1)) $arrKondisi[]= " tgl_daftar>='$fmFiltTglBtw_tgl1'";
		if(!empty($fmFiltTglBtw_tgl2)) $arrKondisi[]= " tgl_daftar<='$fmFiltTglBtw_tgl2'";	
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		switch($fmORDER1){
			case '1': $arrOrders[] = " nama $Asc1 " ;break;
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
	
	function inputpenerimaanDET($dt){
		global $Ref, $Main, $HTTP_COOKIE_VARS;
		$cek ='';$err='';$content='';
		$checDistri = '';
		$checAtri = '';
		if($dt['barangdistribusi'] == 1)$checDistri = 'checked';
		if($dt['biayaatribusi'] == 1)$checAtri = 'checked';
		
		
		$content = genFilterBar(
				array(
					$this->isiform(
						array(
							array(
								'label'=>'KODE BARANG',
								'name'=>'kodebarang',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='kodebarang' onkeyup='cariBarang.pilBar2(this.value)' id='kodebarang' placeholder='KODE BARANG' style='width:150px;' value='".$dt['kodebarangnya']."' /> 
									<input type='text' name='namabarang' id='namabarang' placeholder='NAMA BARANG' style='width:350px;' readonly value='".$dt['nm_barang']."' />
									<input type='button' name='caribarang' id='caribarang' value='CARI' onclick='cariBarang.windowShow();'/>
								",
							),
							array(
								'label'=>'MERK / TYPE/ SPESIFIKASI/ JUDUL/ LOKASI',
								'name'=>'merk',
								'label-width'=>'200px;',
								'value'=>"<textarea name='keteranganbarang' style='width:300px;height:50px;' placeholder='MERK / TYPE/ SPESIFIKASI/ JUDUL/ LOKASI'>".$dt['ket_barang']."</textarea>
								",
							),
							array(
								'label'=>'JUMLAH',
								'name'=>'jumlah_barang',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='jumlah_barang' value='".intval($dt['jml'])."' id='jumlah_barang' style='width:80px;text-align:right;' onkeypress='return isNumberKey(event)' onkeyup='pemasukan_ins.hitungjumlahHarga();' />
										<input type='checkbox' name='barang_didistribusi' value='1' id='barang_didistribusi' style='margin-left:90px;' $checDistri />BARANG AKAN DIDISTRIBUSIKAN
								",
							),
							array(
								'label'=>'SATUAN',
								'name'=>'satuan',
								'label-width'=>'200px;',
								'type'=>'text',
								'value'=>$dt['satuan'],
								'parrams'=>"style='width:150px;' readonly",
							),
							array(
								'label'=>'HARGA SATUAN',
								'name'=>'harga_satuan',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='harga_satuan' align='right' value='".intval($dt['harga_satuan'])."' id='harga_satuan' style='width:150px;text-align:right;' onkeypress='return isNumberKey(event)' onkeyup='document.getElementById(`harga_satuannya`).innerHTML = pemasukan_ins.formatCurrency(this.value);pemasukan_ins.hitungjumlahHarga();' /> Rp <span id='harga_satuannya'>".number_format($dt['harga_satuan'],2,",",".")."</span>
								",
							),array(
								'label'=>'JUMLAH HARGA',
								'name'=>'jumlah_harga',
								'label-width'=>'200px;',
								'value'=>"<input type='text' name='jumlah_harga' value='".number_format($dt['harga_total'],2,",",".")."' id='jumlah_harga' style='width:150;text-align:right;' readonly />
										<input type='checkbox' name='barang_atribusi' value='1' id='barang_atribusi' style='margin-left:20px;' $checAtri />DITAMBAH BIAYA ATRIBUSI",
								
							),array(
								'label'=>'KETERANGAN',
								'name'=>'merk',
								'label-width'=>'200px;',
								'value'=>"<textarea name='keterangan' style='width:300px;height:50px;' placeholder='KETERANGAN'>".$dt['keterangan']."</textarea>
								",
							),
						)
					)
				
				),'','','').
				genFilterBar(
					array(
					"
					<input type='hidden' name='refid_terimanya' id='refid_terimanya' value='".$dt['Id']."' />
					<input type='hidden' name='FMST_penerimaan_det' id='FMST_penerimaan_det' value='".$dt['FMST_penerimaan_det']."' />
					<table>
						<tr>
							<td>".$this->buttonnya($this->Prefix.'.SimpanDet()','save_f2.png','simpan','simpan','SIMPAN')."</td>
							<td>".$this->buttonnya($this->Prefix.'.inputpenerimaan()','cancel_f2.png','batal','batal','BATAL')."</td>
							<td><span id='selesaisesuai'>".$this->buttonnya($this->Prefix.'.SimpanSemua()','checkin.png','selesai','SELESAI','SELESAI')."</span></td>
						</tr>".
					"</table>"
					
					
					
				),'','','')
				
				;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function rincianpenerimaanDET(){
		$cek = '';$err='';
		
		$idplh = addslashes($_REQUEST['pemasukan_ins_idplh']);
		
		$qry = "SELECT * FROM v1_penerimaan_barang_det WHERE refid_terima='$idplh' AND status != '2' ";$cek.=$qry;
		$aqry = mysql_query($qry);
		
		//$datanya = ";
		$no = 1;
		$totalharga = 0;
		while($dt = mysql_fetch_array($aqry)){
			
			if($dt['barangdistribusi'] == '1'){
				$distri = "YA";
			}else{
				$distri = "TDK";
			}
			if($dt['biayaatribusi'] == '1'){
				$atri = "YA";
			}else{
				$atri = "TDK";
			}
			$datanya .= "
				<tr class='row0'>
					<td class='GarisDaftar' align='right'>$no</td>
					<td class='GarisDaftar'><a href='javascript:pemasukan_ins.UbahRincianPenerimaan(`".$dt['Id']."`)' >".$dt['nm_barang']."</a></td>
					<td class='GarisDaftar'>".$dt['ket_barang']."</td>
					<td class='GarisDaftar' align='right'>".number_format($dt['jml'],0,".",",")."</td>
					<td class='GarisDaftar'>".$dt['satuan']."</td>
					<td class='GarisDaftar' align='right'>".number_format($dt['harga_satuan'],2,",",".")."</td>
					<td class='GarisDaftar' align='right'>".number_format($dt['harga_total'],2,",",".")."</td>
					<td class='GarisDaftar' align='center'>".$distri."</td>
					<td class='GarisDaftar' align='center'>".$atri."</td>
					<td class='GarisDaftar'>".$dt['keterangan']."</td>
					<td class='GarisDaftar' align='center'>
						<a href='javascript:pemasukan_ins.HapusRincianPenerimaan(`".$dt['Id']."`)' />
							<img src='datepicker/remove2.png' style='width:20px;height:20px;' />
						</a>
					</td>
				</tr>
			";
			$no = $no+1;
			$totalharga = $totalharga + $dt['harga_total'];
		} 
		
		$content = 
					"
					<div class='FilterBar' style='padding:10px;'>
					<table class='koptable' style='width:100%;' border='1'>
						<tr>
							<th class='th01'>NO</th>
							<th class='th01'>NAMA BARANG</th>
							<th class='th01'>MERK / TYPE/ SPESIFIKASI/ JUDUL/ LOKASI</th>
							<th class='th01'>JUMLAH</th>
							<th class='th01'>SATUAN</th>
							<th class='th01'>HARGA SATUAN</th>
							<th class='th01'>JUMLAH HARGA</th>
							<th class='th01' width='50px'>DISTR</th>
							<th class='th01' width='50px'>ATRIB</th>
							<th class='th01'>KET.</th>
							<th class='th01'>Hapus</th>
						</tr>
						$datanya
						<tr>
							<td class='GarisDaftar' colspan='6' align='center'><b>TOTAL</b></td>
							<td class='GarisDaftar' align='right'><b>".number_format($totalharga,2,",",".")."</b></td>
							<td class='GarisDaftar' colspan='4'></td>
						</tr>
					</table>
					</div>"
				
				;
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function buttonnya($js,$img,$name,$alt,$judul){
		return "<table cellpadding='0' cellspacing='0' border='0' id='toolbar'>
					<tbody><tr valign='middle' align='center'> 
					<td class='border:none'> 
						<a class='toolbar' id='btsave' 
							href='javascript:$js'> 
						<img src='images/administrator/images/$img' alt='$alt' name='$name' width='32' height='32' border='0' align='middle' title='$judul'> $judul</a> 
					</td> 
					</tr> 
					</tbody></table> ";
	}
	
	function SimpanDet(){
		global $Ref, $Main, $HTTP_COOKIE_VARS;
		
		$cek = '';$err='';$content='';
		
	 	$uid = $HTTP_COOKIE_VARS['coID'];
	 	$coThnAnggaran = $HTTP_COOKIE_VARS['coThnAnggaran'];
		
		$idplh = addslashes($_REQUEST['pemasukan_ins_idplh']);
		$caraperolehan = addslashes($_REQUEST['asalusul']);
		$c1nya = addslashes($_REQUEST['c1nya']);
		$cnya = addslashes($_REQUEST['cnya']);
		$dnya = addslashes($_REQUEST['dnya']);
		$enya = addslashes($_REQUEST['enya']);
		$e1nya = addslashes($_REQUEST['e1nya']);
		
		$kodebarang = addslashes($_REQUEST['kodebarang']);
		$keteranganbarang = addslashes($_REQUEST['keteranganbarang']);
		$jumlah_barang = addslashes($_REQUEST['jumlah_barang']);
		$satuan = addslashes($_REQUEST['satuan']);
		$harga_satuan = addslashes($_REQUEST['harga_satuan']);
		$keterangan = addslashes($_REQUEST['keterangan']);
		if(isset($_REQUEST['barang_atribusi'])){
			$barang_atribusi = addslashes($_REQUEST['barang_atribusi']);
		}else{
			$barang_atribusi = '0';
		}
		if(isset($_REQUEST['barang_didistribusi'])){
			$barang_didistribusi = addslashes($_REQUEST['barang_didistribusi']);
		}else{
			$barang_didistribusi = '0';
		}
		
		
		if($caraperolehan == '1'){
			$qry_cekbarang = "SELECT * FROM ref_barang WHERE concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) = '$kodebarang' AND j!='000' ";$cek.=$qry_cekbarang;
			$aqry = mysql_query($qry_cekbarang);
			if(mysql_num_rows($aqry) < 1)$err = "Kode Barang Tidak Valid !";
		}
		
		if($jumlah_barang < 1)$err = "Jumlah Barang Tidak Boleh 0 !";
		if($harga_satuan < 1)$err = "Harga Satuan Belum Diisi !";
		
		
		if($err == ''){
			if($_REQUEST['FMST_penerimaan_det'] == '1'){
				if($_REQUEST['refid_terimanya'] != ''){
					$idterima = addslashes($_REQUEST['refid_terimanya']);
					$upd = "UPDATE t_penerimaan_barang_det SET status='2' WHERE Id='$idterima' ";$cek.=$upd; 
					$qryupd = mysql_query($upd);
				}
			}
			$kodebrg = explode(".",$kodebarang);
			$f1 = $kodebrg[0];
			$f2 = $kodebrg[1];
			$f = $kodebrg[2];
			$g = $kodebrg[3];
			$h = $kodebrg[4];
			$i = $kodebrg[5];
			$j = $kodebrg[6];
			
			$hargatotal = $jumlah_barang*$harga_satuan;
						
			$simpan = "INSERT INTO t_penerimaan_barang_det (c1,c,d,e,e1,f1,f2,f,g,h,i,j,ket_barang,jml,satuan,harga_satuan, harga_total,keterangan,barangdistribusi,biayaatribusi,status,refid_terima,sttemp,uid,tahun) values ('$c1nya', '$cnya', '$dnya', '$enya', '$e1nya', '$f1', '$f2', '$f', '$g', '$h', '$i', '$j', '$keteranganbarang', '$jumlah_barang', '$satuan', '$harga_satuan', '$hargatotal', '$keterangan', '$barang_didistribusi', '$barang_atribusi', '1', '$idplh', '1','$uid','$coThnAnggaran')";$cek .= $simpan ; 
			
			$qrysimpan = mysql_query($simpan);
		}
		
		
		
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function cekSesuai(){
		$cek='';$err='';$content='';
		
			$idplh = addslashes($_REQUEST['pemasukan_ins_idplh']);
			
			$hitungrincian = "SELECT SUM(harga_total) as harga FROM t_penerimaan_barang_det WHERE refid_terima='$idplh' AND status !='2' ";
			$qryhitungrincian = mysql_query($hitungrincian);
			$jmlhtng_rincian = mysql_fetch_array($qryhitungrincian);
			
			$hitungrekening = "SELECT SUM(jumlah) as harga FROM t_penerimaan_rekening WHERE refid_terima='$idplh' AND status !='2' ";
			$qryhitungrekening = mysql_query($hitungrekening);
			$jmlhtngrekening = mysql_fetch_array($qryhitungrekening);
			
			if($jmlhtng_rincian['harga'] != 0 && $jmlhtngrekening['harga'] != 0 && $jmlhtng_rincian['harga'] == $jmlhtngrekening['harga'] ){
				$idpenerimaan = $this->KodePenerimaan();
				$cek.=$idpenerimaan['cek'];
				
				
				$content['statussesuai'] = 1;
				$content['idpenerimaaan'] = $idpenerimaan['content'];
				$content['ceklis'] = "<input type='checkbox' name='jumlah_sesuai' value='1' id='jumlah_sesuai' style='margin-left:20px;' disabled checked /><span style='font-weight:bold;color:black;'>TOTAL HARGA SESUAI</span>";
			}else{
				$content['statussesuai'] = 0;
				$content['ceklis'] = "<input type='checkbox' name='jumlah_sesuai' value='1' id='jumlah_sesuai' style='margin-left:20px;' disabled /><span style='font-weight:bold;color:red;'>TOTAL HARGA BELUM SESUAI</span>";
				$content['idpenerimaaan'] = '';
			}
			
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
			
	}
	
	function KodePenerimaan(){
		global $Main;
		$cek = '';
		$jns_transaksi = $_REQUEST['jns_transaksi'];
		$sumberdana = $_REQUEST['sumberdana'];
		$tgl_buku = explode("-", addslashes($_REQUEST['tgl_buku']));
		$tgl = $tgl_buku[2].'-'.$tgl_buku[1];
		
		$c1 = $_REQUEST['c1nya'];
		$c = $_REQUEST['cnya'];
		$d = $_REQUEST['dnya'];
		
		
		$tmpl1 = "SELECT * FROM t_penerimaan_barang WHERE Id='".$_REQUEST['idubah']."' AND sumber_dana='$sumberdana' ORDER BY Id DESC ";
		$qrytmpl1 = mysql_query($tmpl1);$cek.=$tmpl1;
					
		if(mysql_num_rows($qrytmpl1) == 0){
			$qry = "SELECT id_penerimaan, SUBSTRING(id_penerimaan,1,5) as kodeAngka  FROM t_penerimaan_barang WHERE c='$c' AND d='$d' AND tgl_buku LIKE '$tgl-%' AND sumber_dana='$sumberdana'  ORDER BY kodeAngka DESC LIMIT 0,1";$cek.= $qry;
			$aqry = mysql_query($qry);
			
			$bln = $tgl_buku[1];
			$bulanRomawi = $Main->BulanRomawi[$bln];
			$tahun = $tgl_buku[2];
				
			if(mysql_num_rows($aqry) > 0){
				$dt = mysql_fetch_array($aqry);
				$kodeAngka = $dt['kodeAngka'];
				
	
				$kodeAmbil = intval($kodeAngka)+1;
									
					
				if(strlen($kodeAmbil) == 1)$kodeAmbil = "0000".$kodeAmbil;
				if(strlen($kodeAmbil) == 2)$kodeAmbil = "000".$kodeAmbil;
				if(strlen($kodeAmbil) == 3)$kodeAmbil = "00".$kodeAmbil;
				if(strlen($kodeAmbil) == 4)$kodeAmbil = "0".$kodeAmbil;					
				
				$content = $kodeAmbil."/BP/$c.$d/$sumberdana/$bulanRomawi/$tahun";
				
			}else{
				$content = "00001/BP/$c.$d/$sumberdana/$bulanRomawi/$tahun";
			}
		}else{
			$IDUBAH = $_REQUEST['idubah'];
			$tmpl = "SELECT * FROM t_penerimaan_barang WHERE Id='$IDUBAH' ORDER BY Id DESC ";
			$qrytmpl = mysql_query($tmpl);
			$dataqrytmpl = mysql_fetch_array($qrytmpl);
			
			$content = $dataqrytmpl['id_penerimaan'];
		}
		return	array ('cek'=>$cek, 'content'=>$content);
	}
}
$pemasukan_ins = new pemasukan_insObj();
?>