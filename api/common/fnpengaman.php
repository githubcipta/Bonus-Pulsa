<?phpfunction Pengaman_ProsesSimpan(){		global $HTTP_COOKIE_VARS, $Main; 		$MyModulKU = explode(".",$HTTP_COOKIE_VARS["coModul"]);					 	if ($MyModulKU[6]=='1'){			$fmTANGGALPENGAMANAN= $_GET['fmTANGGALPENGAMANAN']; 	$fmJENISPENGAMANAN= $_GET['fmJENISPENGAMANAN'];	$fmURAIANKEGIATAN= $_GET['fmURAIANKEGIATAN']; 	$fmPENGAMANINSTANSI= $_GET['fmPENGAMANINSTANSI']; 	$fmPENGAMANALAMAT= $_GET['fmPENGAMANALAMAT']; 	$fmSURATNOMOR= $_GET['fmSURATNOMOR']; 	$fmSURATTANGGAL= $_GET['fmSURATTANGGAL']; 	$fmBIAYA= $_GET['fmBIAYA']; 	$fmBUKTIPENGAMANAN= $_GET['fmBUKTIPENGAMANAN']; 	$fmKET= $_GET['fmKET']; 	$fmTAMBAHASET = $_GET['fmTAMBAHASET'];	$fmTANGGALPEROLEHAN = $_GET['fmTANGGALPEROLEHAN'];		$UID = $HTTP_COOKIE_VARS['coID'];		$idbi = $_GET['idbi'];	$idplh = $_GET['idplh'];	$idbi_awal = $_GET['idbi_awal']; 	$fmst = $_GET['fmst'];			if ($fmst==0){			if ($idplh!='')			{												$isix =  mysql_fetch_array( mysql_query (								" select idbi_awal  from pengamanan where id ='$idplh'"			));			$idbi=$isix['idbi_awal'];			}					}			if ($fmBIAYA == ''){$fmBIAYA = 0;}		$errmsg ='';		//validasi -----------------------	if($fmTANGGALPEROLEHAN == '0000-00-00' || $fmTANGGALPEROLEHAN=='' ){ $errmsg = 'Tanggal Perolehan belum diisi !';	}	if($fmTANGGALPENGAMANAN == '0000-00-00' || $fmTANGGALPENGAMANAN=='' ){ $errmsg = 'Tanggal Pengamanan belum diisi !';	}	if($errmsg=='' && !cektanggal($fmTANGGALPENGAMANAN)){ $errmsg = "Tanggal Pengamanan $fmTANGGALPENGAMANAN Salah!";	}		if($errmsg =='' && compareTanggal($fmTANGGALPENGAMANAN, date('Y-m-d'))==2  ) $errmsg = 'Tanggal Pengaman tidak lebih besar dari Hari ini!';					if($errmsg =='' && compareTanggal($fmTANGGALPEROLEHAN,$fmTANGGALPENGAMANAN )==2) $errmsg = 'Tanggal Perolehan tidak lebih besar dari Tanggal Pengamanan !';							//if($Main->VERSI_NAME <> 'SERANG'){		$thn_perolehan = substr($fmTANGGALPEROLEHAN,0,4);		$query_susut = "select count(*)as jml_susut from penyusutan where idbi='$idbi' and tahun>='$thn_pengaman'";		$get_susut = mysql_fetch_array(mysql_query($query_susut));			$get_cd = mysql_fetch_array(mysql_query("select c,d,e,e1,tgl_buku,thn_perolehan from buku_induk where id='$idbi'"));		$tgl_closing=getTglClosing($get_cd['c'],$get_cd['d'],$get_cd['e'],$get_cd['e1']);		//get tglakhir susut,koreksi,penilaian,penghapusan_sebagian dgn idbi_awal yg sama		$tgl_susutAkhir = mysql_fetch_array(mysql_query("select tgl from penyusutan where idbi_awal='$idbi' order by tgl desc limit 1"));		$tgl_korAkhir = mysql_fetch_array(mysql_query("select tgl,tgl_create from t_koreksi where idbi_awal='$idbi' order by tgl desc limit 1"));		$tgl_nilaiAkhir = mysql_fetch_array(mysql_query("select tgl_penilaian,tgl_create from penilaian where idbi_awal='$idbi' order by tgl_penilaian desc limit 1"));		$tgl_hpsAkhir = mysql_fetch_array(mysql_query("select tgl_penghapusan,tgl_create from penghapusan_sebagian where idbi_awal='$idbi' order by tgl_penghapusan desc limit 1"));		//-------------------------------------		if ($fmst==1 && $errmsg==''){			//jika tambah aset =1 atau tambah manfaat = 1:			//if($fmTAMBAHASET==1 || $fmTAMBAHMasaManfaat==1){				if($errmsg =='' && compareTanggal($get_cd['tgl_buku'],$fmTANGGALPENGAMANAN)==2) $errmsg = 'Tanggal Pengamanan tidak kecil dari Tanggal Buku Barang !';								if($errmsg =='' && $thn_perolehan<$get_cd['thn_perolehan']) $errmsg = 'Tahun Perolehan tidak kecil dari Tahun Perolehan Buku Barang !';								if($errmsg=='' && $fmTANGGALPENGAMANAN<=$tgl_closing)$errmsg ='Tanggal sudah Closing !';				if($errmsg=='' && $fmTANGGALPENGAMANAN<=$tgl_susutAkhir['tgl'] || $fmTANGGALPEROLEHAN<=$tgl_susutAkhir['tgl'])$errmsg ='Sudah ada penyusutan !';				if($errmsg=='' && $fmTANGGALPENGAMANAN<$tgl_korAkhir['tgl'] )$errmsg ='Sudah ada koreksi harga!';				if($errmsg=='' && $fmTANGGALPENGAMANAN<$tgl_nilaiAkhir['tgl_penilaian'] )$errmsg ='Sudah ada penilaian!';				if($errmsg=='' && $fmTANGGALPENGAMANAN<$tgl_hpsAkhir['tgl_penghapusan'] )$errmsg ='Sudah ada penghapusan sebagian!';			//}		}else{			//cek sudah ada penyusutan / tdk untuk data edit				$old_pengaman = mysql_fetch_array(mysql_query("select * from pengamanan where id='$idplh'"));			//$oldthn_pengaman = substr($old_pengaman['tgl_pengamanan'],0,4);				//cek tgl buku lama <= tgl closing			if($errmsg=='' && $old_pengaman['tgl_pengamanan']<=$tgl_closing){				if($errmsg=='' && $old_pengaman['tgl_pengamanan']!=$fmTANGGALPENGAMANAN)$errmsg = 'Tanggal Buku Pengamanan tidak bisa di edit,karena sudah closing !';				if($errmsg=='' && $old_pengaman['tgl_perolehan']!=$fmTANGGALPEROLEHAN)$errmsg = 'Tanggal Perolehan tidak bisa di edit,karena sudah closing !';				if($errmsg=='' && $old_pengaman['biaya_pengamanan']!=$fmBIAYA)$errmsg = 'Biaya Pengamanan tidak bisa di edit,karena sudah closing !';				if($errmsg=='' && $old_pengaman['tambah_aset']!=$fmTAMBAHASET)$errmsg = 'Manambah Aset tidak bisa di edit,karena sudah closing !';			}						//cek tgl perolehan lama < tgl susut akhir 			if($errmsg=='' && ($old_pengaman['tgl_perolehan']<$tgl_susutAkhir['tgl'] && $old_pengaman['tgl_pengamanan']<$tgl_susutAkhir['tgl'])){				if($errmsg=='' && $old_pengaman['tgl_pengamanan']!=$fmTANGGALPENGAMANAN)$errmsg = 'Tanggal Buku Pengamanan tidak bisa di edit,sudah ada penyusutan !';				if($errmsg=='' && $old_pengaman['tgl_perolehan']!=$fmTANGGALPEROLEHAN)$errmsg = 'Tanggal Perolehan tidak bisa di edit,sudah ada penyusutan !';				if($errmsg=='' && $old_pengaman['biaya_pengamanan']!=$fmBIAYA)$errmsg = 'Biaya Pengamanan tidak bisa di edit,sudah ada penyusutan !';				if($errmsg=='' && $old_pengaman['tambah_aset']!=$fmTAMBAHASET)$errmsg = 'Manambah Aset tidak bisa di edit,sudah ada penyusutan !';			}			//cek (tgl buku lama < tgl buku koreksi terakhir) atau (tgl buku lama = tgl buku koreksi terakhir  dan waktu create < waktu create koreksi terakhir)			if(($errmsg=='' && $old_pengaman['tgl_pengamanan']<$tgl_korAkhir['tgl']) || ($old_pengaman['tgl_pengamanan']==$tgl_korAkhir['tgl'] && $old_pengaman['tgl_create']<$tgl_korAkhir['tgl_create'])){				if($errmsg=='' && $old_pengaman['tgl_pengamanan']!=$fmTANGGALPENGAMANAN)$errmsg = 'Tanggal Buku Pengamanan tidak bisa di edit,sudah ada koreksi harga !';				if($errmsg=='' && $old_pengaman['tgl_perolehan']!=$fmTANGGALPEROLEHAN)$errmsg = 'Tanggal Perolehan tidak bisa di edit,sudah ada koreksi harga !';				if($errmsg=='' && $old_pengaman['biaya_pengamanan']!=$fmBIAYA)$errmsg = 'Biaya Pengamanan tidak bisa di edit,sudah ada koreksi harga !';				if($errmsg=='' && $old_pengaman['tambah_aset']!=$fmTAMBAHASET)$errmsg = 'Manambah Aset tidak bisa di edit,sudah ada koreksi harga !';			}			//cek (tgl buku lama < tgl buku penilaian terakhir) atau (tgl buku lama = tgl buku penilaian terakhir  dan waktu create < waktu create penilaian terakhir)			if(($errmsg=='' && $old_pengaman['tgl_pengamanan']<$tgl_nilaiAkhir['tgl_penilaian']) || ($old_pengaman['tgl_pengamanan']==$tgl_nilaiAkhir['tgl_penilaian'] && $old_pengaman['tgl_create']<$tgl_nilaiAkhir['tgl_create'])){				if($errmsg=='' && $old_pengaman['tgl_pengamanan']!=$fmTANGGALPENGAMANAN)$errmsg = 'Tanggal Buku Pengamanan tidak bisa di edit,sudah ada penilaian !';				if($errmsg=='' && $old_pengaman['tgl_perolehan']!=$fmTANGGALPEROLEHAN)$errmsg = 'Tanggal Perolehan tidak bisa di edit,sudah ada penilaian !';				if($errmsg=='' && $old_pengaman['biaya_pengamanan']!=$fmBIAYA)$errmsg = 'Biaya Pengamanan tidak bisa di edit,sudah ada penilaian !';				if($errmsg=='' && $old_pengaman['tambah_aset']!=$fmTAMBAHASET)$errmsg = 'Manambah Aset tidak bisa di edit,sudah ada penilaian !';			}						//cek (tgl buku lama < tgl buku hapus sebagian terakhir) atau (tgl buku lama = tgl buku hapus sebagian terakhir  dan waktu create < waktu create hapus sebagian terakhir)			if(($errmsg=='' && $old_pengaman['tgl_pengamanan']<$tgl_hpsAkhir['tgl_penghapusan']) || ($old_pengaman['tgl_pengamanan']==$tgl_hpsAkhir['tgl_penghapusan'] && $old_pengaman['tgl_create']<$tgl_hpsAkhir['tgl_create'])){				if($errmsg=='' && $old_pengaman['tgl_pengamanan']!=$fmTANGGALPENGAMANAN)$errmsg = 'Tanggal Buku Pengamanan tidak bisa di edit,sudah ada penghapusan sebagian !';				if($errmsg=='' && $old_pengaman['tgl_perolehan']!=$fmTANGGALPEROLEHAN)$errmsg = 'Tanggal Perolehan tidak bisa di edit,sudah ada penghapusan sebagian !';				if($errmsg=='' && $old_pengaman['biaya_pengamanan']!=$fmBIAYA)$errmsg = 'Biaya Pengamanan tidak bisa di edit,sudah ada penghapusan sebagian !';				if($errmsg=='' && $old_pengaman['tambah_aset']!=$fmTAMBAHASET)$errmsg = 'Manambah Aset tidak bisa di edit,sudah ada penghapusan sebagian !';			}			}		//}			if ($errmsg ==''){		$bi =  mysql_fetch_array( mysql_query (							" select tgl_buku from buku_induk where id ='$idbi'"		));		if ($errmsg =='' && compareTanggal($fmTANGGALPENGAMANAN, $bi['tgl_buku'])==0  ) $errmsg = 'Tanggal Pengamanan tidak lebih kecil dari Tanggal Buku!';				}	if( $errmsg =='' & (!($fmSURATTANGGAL == '0000-00-00' || $fmSURATTANGGAL==''))){		if( !cektanggal($fmSURATTANGGAL)){ $errmsg = 'Tanggal Surat Salah!';}		if($errmsg =='' && compareTanggal($fmSURATTANGGAL, date('Y-m-d'))==2  ) $errmsg = 'Tanggal Surat tidak lebih besar dari Hari ini!';						}		if ($errmsg=='' && $fmst==1){		 $errmsg=Pengaman_CekdataCutoff('insert',$idplh,$fmTANGGALPENGAMANAN,$idbi);			 }				if($errmsg == ''){			if ($fmst==1){//simpan baru			$isibi= table_get_rec("select * from view_buku_induk2 where id = '$idbi'" );			$idbi_awal = $isibi['idawal'] ==''? $isibi['id']: $isibi['idawal'];			$aqry = "insert into pengamanan (id_bukuinduk, 				tgl_pengamanan, jenis_pengamanan, uraian_kegiatan, 				pengaman_instansi, pengaman_alamat,	surat_no, surat_tgl, 				biaya_pengamanan, ket, tambah_aset,tgl_perolehan,				idbi_awal, tgl_update, uid  ) 				values ('$idbi',					'$fmTANGGALPENGAMANAN', '$fmJENISPENGAMANAN', '$fmURAIANKEGIATAN',					'$fmPENGAMANINSTANSI', '$fmPENGAMANALAMAT', 					'$fmSURATNOMOR', '$fmSURATTANGGAL', '$fmBIAYA',  '$fmKET', '$fmTAMBAHASET','$fmTANGGALPEROLEHAN',					'$idbi_awal', now(), '$UID'								) ";//echo "aqry=$aqry<r>";			$sukses = mysql_query($aqry);			if($Main->VERSI_NAME <> 'SERANG'){				if($sukses && $fmTAMBAHASET==1 ){				$id = mysql_insert_id();				if($Main->MODUL_JURNAL) jurnalPengamanan($id,$UID,1);				}			}						}else{//smpan edit				if($errmsg ==''){				//ambil id buku induk				$old = mysql_fetch_array(mysql_query(					"select idbi_awal, id_bukuinduk from pengamanan where id='$idplh'"				));						//cek status barangnya				$penatausaha = mysql_fetch_array(mysql_query(					"select status_barang from buku_induk where id='{$old['id_bukuinduk']}'"				));				if ($errmsg =='' && $penatausaha['status_barang']==3 ) $errmsg = "Gagal Edit. Barang untuk Pengamanan ini sudah dihapuskan!";				if ($errmsg =='' && $penatausaha['status_barang']==4 ) $errmsg = 'Gagal Edit. Barang untuk Pengamanan ini sudah dipindah tangankan!';				if ($errmsg =='' && $penatausaha['status_barang']==5 ) $errmsg = 'Gagal Edit. Barang untuk Pengamanan ini sudah diganti rugi!';			}				if ($errmsg=='') $errmsg=Pengaman_CekdataCutoff('edit',$idplh,$fmTANGGALPENGAMANAN,$idbi_awal);							if ($errmsg ==''){					$old= mysql_fetch_array(mysql_query("select * from pengamanan where id='$idplh'"));									$aqry = "update pengamanan set						tgl_pengamanan = '$fmTANGGALPENGAMANAN', 						jenis_pengamanan = '$fmJENISPENGAMANAN',						uraian_kegiatan = '$fmURAIANKEGIATAN', 						pengaman_instansi = '$fmPENGAMANINSTANSI', 						pengaman_alamat = '$fmPENGAMANALAMAT',						surat_no = '$fmSURATNOMOR', 						surat_tgl = '$fmSURATTANGGAL', 						biaya_pengamanan = '$fmBIAYA', 												ket = '$fmKET',						tgl_update = now(),						uid = '$UID',						tambah_aset = '$fmTAMBAHASET',										tgl_perolehan = '$fmTANGGALPEROLEHAN'									where id = '$idplh'";//echo "aqry=$aqry<br>";				$sukses = mysql_query($aqry);				if($Main->VERSI_NAME <> 'SERANG'){					if($sukses) {						if($Main->MODUL_JURNAL){						if($old['tambah_aset']==$fmTAMBAHASET && $fmTAMBAHASET ==1) jurnalPengamanan($idplh,$UID, 2);						if($old['tambah_aset']==0 && $fmTAMBAHASET ==1 ) jurnalPengamanan($idplh,$UID, 1); //$errmsg= $plh['cek']; $sukses=FALSE;						if($old['tambah_aset']==1 && $fmTAMBAHASET ==0 ) jurnalPengamanan($idplh,$UID, 3);						}					}				}								}		}								if($sukses){				}else{			if($errmsg =='') $errmsg = 'Gagal!. Data Tidak dapat di ubah atau di simpan ';//.$aqry;		}	}	}else{		$errmsg = 'Gagal Simpan Data. Anda Tidak Mempunyai Hak Akses!';		}	return $errmsg;}function Pengaman_GetData($id){	global $fmTANGGALPENGAMANAN, $fmJENISPENGAMANAN, $fmURAIANKEGIATAN, $fmPENGAMANINSTANSI,		$fmPENGAMANALAMAT, $fmSURATNOMOR, $fmSURATTANGGAL, $fmBIAYA, $fmBUKTIPENGAMANAN, $fmKET,$fmTAMBAHASET,$fmTANGGALPEROLEHAN;	global $idbi; //idbi nya	global $idbi_awal; //idbi nya					$aqry = "select * from pengamanan where id = '$id'";	$qry = mysql_query($aqry);	if ($isi = mysql_fetch_array($qry)){		$fmTANGGALPENGAMANAN= $isi['tgl_pengamanan']=='0000-00-00'? '': $isi['tgl_pengamanan'];		$fmJENISPENGAMANAN= $isi['jenis_pengamanan'];		$fmURAIANKEGIATAN= $isi['uraian_kegiatan']; 		$fmPENGAMANINSTANSI= $isi['pengaman_instansi']; 		$fmPENGAMANALAMAT= $isi['pengaman_alamat']; 		$fmSURATNOMOR= $isi['surat_no']; 		$fmSURATTANGGAL= $isi['surat_tgl'] == '0000-00-00'? '': $isi['surat_tgl'];		$fmBIAYA= $isi['biaya_pengamanan']; 		$fmBUKTIPENGAMANAN= $isi['bukti_pengamanan']; 		$fmKET= $isi['ket']; 		$fmTAMBAHASET = $isi['tambah_aset'];		$fmTANGGALPEROLEHAN = $isi['tgl_perolehan'];				$idbi= $isi['id_bukuinduk'];//'333';			$idbi_awal= $isi['idbi_awal'];		}		}function Pengaman_FormEntry(){	global $fmTANGGALPENGAMANAN, $fmJENISPENGAMANAN, $fmURAIANKEGIATAN, $fmPENGAMANINSTANSI,		$fmPENGAMANALAMAT, $fmSURATNOMOR, $fmSURATTANGGAL, $fmBIAYA, $fmBUKTIPENGAMANAN, $fmKET,		$fmTAMBAHASET,$fmTANGGALPEROLEHAN;	global $Main;	global $idbi_awal;		//echo "fmJENISPENGAMANAN=$fmJENISPENGAMANAN";$fmTmbahAset_checked =$fmTAMBAHASET==1?'checked':'';$space = formEntryBase2('','','',""," style='width:5'",'','valign="middle" height="0"');	return "			<div><div>		$FormEntry_Script		$FormEntry_Hidden		<input type='hidden' name='idbi_awal' id='idbi_awal' value='".$idbi_awal."' >		<input type='hidden' name='idplh' id='idplh' value='".$_GET['idplh']."' >		<input type='hidden' name='fmst' id='fmst' value='".$_GET['fmst']."' >	</div></div>		<table width=\"100%\"  height='100%' class=\"adminform\" style='border-width:0'><tr><td valign='top' style='padding:8;'>	<table width='100%'>	$space		".formEntryBase2('Tanggal Buku Pengamanan',':',		createEntryTgl('fmTANGGALPENGAMANAN',$fmTANGGALPENGAMANAN, false, '','','FormPengaman','2').		'&nbsp&nbsp<span style="color: red;"></span>'		,"style='width:170'","style='width:10'",'','valign="middle" height="21"')."	".formEntryBase2('Tanggal Perolehan',':',		createEntryTgl('fmTANGGALPEROLEHAN',$fmTANGGALPEROLEHAN, false, '','','FormPengaman').		'&nbsp&nbsp<span style="color: red;"></span>'		,"style=''","style=''",'','valign="middle" height="21"')."	<tr valign=\"middle\">	  <td>Jenis Pengamanan</td>	  <td>:</td>	  <td>		".cmb2D('fmJENISPENGAMANAN',$fmJENISPENGAMANAN,$Main->JenisPengamanan,'')."	</td>	</tr>			<tr valign=\"top\">	  <td>Uraian Kegiatan</td>	  <td>:</td>	  <td>		<textarea id=\"fmURAIANKEGIATAN\" name=\"fmURAIANKEGIATAN\" cols=\"60\" >$fmURAIANKEGIATAN</textarea>	</td>	</tr>	<tr valign=\"middle\">	  <td>Yang Mengamankan</td>	  <td></td>	  <td>		&nbsp;	</td>	</tr>			<tr valign=\"middle\">	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Instansi/CV/PT</td>	  <td>:</td>	  <td>		".txtField('fmPENGAMANINSTANSI',$fmPENGAMANINSTANSI,'100','59','text')."	</td>	</tr>	<tr valign=\"middle\">	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>	  <td>:</td>	  <td>		".txtField('fmPENGAMANALAMAT',$fmPENGAMANALAMAT,'100','59','text')."	</td>	</tr>	<tr valign=\"middle\">	  <td>Surat Perjanjian / Kontrak</td>	  <td></td>	  <td>		&nbsp;	</td>	</tr>			<tr valign=\"middle\">	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor</td>	  <td>:</td>	  <td>		".txtField('fmSURATNOMOR',$fmSURATNOMOR,'100','59','text')."	</td>	</tr>			".formEntryBase2('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal',':',		createEntryTgl('fmSURATTANGGAL', $fmSURATTANGGAL,false, '','','FormPengaman').		'&nbsp&nbsp<span style="color: red;"></span>'		,"style='width:150'","style=''",'','valign="middle" height="21"')."	<!--<tr valign=\"top\">	  <td>Biaya Pengamanan</td>	  <td>:</td>	  <td>		".txtField('fmBIAYA',$fmBIAYA,'18','18','text')."	</td>	</tr>-->		".formEntryBase2('Biaya Pengamanan',':',			'Rp.'.inputFormatRibuan("fmBIAYA", 			 	($entryMutasi==FALSE? '':' readonly="" ') ),'','','','valign="top" height="21"')."				".formEntryBase2('Manambah Aset',':',			"<input id='fmTAMBAHASET' type='checkbox' value='checked' $fmTmbahAset_checked > Ya" 			,'','','','valign="top" height="21"')."		<!--<tr valign=\"top\">	  <td>Bukti Pengamanan</td>	  <td>:</td>	  <td>		".txtField('fmBUKTIPENGAMANAN',$fmBUKTIPENGAMANAN,'50','50','text')."	</td>	</tr>-->	<tr valign=\"top\">	  <td>Keterangan</td>	  <td>:</td>	  <td><textarea id=\"fmKET\"  name=\"fmKET\" cols=\"60\" >$fmKET</textarea></td>	</tr>	</table></td></tr>	</table>		";}//function Pengaman_List($aqry){function Pengaman_List($Tbl, $Fields='*', $Kondisi='', $Limit='', $Order='', $Style=1, $TblStyleClass='koptable', 	$Cetak=FALSE,$NoAwal=0, $ReadOnly=FALSE, $fmKIB='',$Xls=FALSE){	global $jmlTampilPGN, $Main;		$TdStyle= $Cetak ? 'GarisCetak':'GarisDaftar';		$no=$NoAwal;	$jmlTampilPGN= 0;	$cb = 0;	$aqry="select $Fields from $Tbl $Kondisi $Order $Limit "; //echo " $aqry<br>";	$Qry = mysql_query($aqry);	while ($isi = mysql_fetch_array($Qry)){		$jmlTampilPGN++;		$no++;		$jmlTotalHargaDisplay += $isi['biaya_pengamanan'];		$kdBarang = $isi['f'].$isi['g'].$isi['h'].$isi['i'].$isi['j'];		$kdKelBarang = $isi['f'].$isi['g']."00";		$nmBarang = mysql_fetch_array(mysql_query("select * from ref_barang where concat(f,g,h,i,j)='$kdBarang'"));		$nmKelBarang = mysql_fetch_array(mysql_query("select * from ref_barang where concat(f,g,h)='$kdKelBarang'"));		$clRow = $no % 2 == 0 ?"row1":"row0";				global $ISI5, $ISI6;												$ISI5 = ''; $ISI6 = '';					$KondisiKIB = "	where a1= '{$isi['a1']}' and a = '{$isi['a']}' and 	c = '{$isi['c']}' and d = '{$isi['d']}' and e = '{$isi['e']}' and e1 = '{$isi['e1']}' and					f = '{$isi['f']}' and g = '{$isi['g']}' and h = '{$isi['h']}' and i = '{$isi['i']}' and j = '{$isi['j']}' and 					tahun = '{$isi['thn_perolehan']}' and noreg = '{$isi['noreg']}'  ";				//echo "KondisiKIB=$KondisiKIB";		if($fmKIB==''){			Penatausahaan_BIGetKib($isi['f'], $KondisiKIB );		}else{			Penatausahaan_BIGetKib_hapus($isi['f'], $KondisiKIB );			}		$tampilAlamat = $Style ==1? '':			"<td class='$TdStyle' align=left>$ISI5</td>	<td class='$TdStyle' align=left>$ISI6</td>	";		$TampilCheckBox = $Cetak? '' : "<td class=\"$TdStyle\" align='center'><input type=\"checkbox\" id=\"cbPGN$cb\" name=\"cidPGN[]\" value=\"{$isi['id']}\" onClick=\"isChecked2(this.checked,'Pengaman_checkbox');\" />&nbsp;</td>";		$TampilCheckBoxKol1 = $Style==1? '' : $TampilCheckBox;			$TampilCheckBoxKol2 = $Style==1? $TampilCheckBox	: '';			/*		$TampilCheckBoxKol = $Style==1? $TampilCheckBox	:"";					$TampilNo = "<td class=\"$TdStyle\" align=center>$no</td>";					//$TampilNoKol = $Style == 1?	$TampilNo :	"$TampilNo	$TampilCheckBox	";		*/		$List_ = $Style==2?			"<td class=\"$TdStyle\" align=center>{$isi['f']}.{$isi['g']}.{$isi['h']}.{$isi['i']}.{$isi['j']}</td>			<td class=\"$TdStyle\" align=center>{$isi['noreg']}</td>			<td class=\"$TdStyle\">{$nmBarang['nm_barang']}</td>			$tampilAlamat			<td class=\"$TdStyle\" align=center>{$isi['thn_perolehan']}</td>"			:"";		/*$CheckBox = $Style==1?			"<td class=\"$TdStyle\" align='center'><input type=\"checkbox\" id=\"cbPGN$cb\" name=\"cidPGN[]\" value=\"{$isi['id']}\" onClick=\"isChecked2(this.checked,'Pengaman_checkbox');\" />&nbsp;</td>"			:"";		*/		if ($Xls){		$ListData .= "				<tr class='$clRow' height='21'>			<td class=\"$TdStyle\" align=center>$no</td>			$TampilCheckBoxKol1			<!-- <td><input type=\"checkbox\" id=\"cbPLH$cb\" name=\"cidPLH[]\" value=\"{$isi['id']}\" onClick=\"isChecked(this.checked);\" />&nbsp;</td> -->			<!--<td class=\"$TdStyle\" align=center>{$isi['f']}.{$isi['g']}.{$isi['h']}.{$isi['i']}.{$isi['j']}</td>			<td class=\"$TdStyle\" align=center>{$isi['noreg']}</td>			<td class=\"$TdStyle\">{$nmBarang['nm_barang']}</td>			<td class=\"$TdStyle\" align=center>{$isi['thn_perolehan']}</td>-->			$List_			<td class=\"$TdStyle\" align=center>".TglInd($isi['tgl_pengamanan'])."</td>						<td class=\"$TdStyle\">".$Main->JenisPengamanan[$isi['jenis_pengamanan']-1][1]."</td>						<td class=\"$TdStyle\">{$isi['uraian_kegiatan']}</td>						<td class=\"$TdStyle\">{$isi['pengaman_instansi']}</td>			<td class=\"$TdStyle\">{$isi['pengaman_alamat']}</td>			<td class=\"$TdStyle\">{$isi['surat_no']}</td>			<td class=\"$TdStyle\" align=center>".TglInd($isi['surat_tgl'])."</td>			<td class=\"$TdStyle\" align=right>".number_format(($isi['biaya_pengamanan']), 2, '.', '')."</td>						<td class=\"$TdStyle\">{$isi['ket']}</td>			$TampilCheckBoxKol2			</tr>		";			} else 		{		$ListData .= "				<tr class='$clRow' height='21'>			<td class=\"$TdStyle\" align=center>$no </td>			$TampilCheckBoxKol1			<!-- <td><input type=\"checkbox\" id=\"cbPLH$cb\" name=\"cidPLH[]\" value=\"{$isi['id']}\" onClick=\"isChecked(this.checked);\" />&nbsp;</td> -->			<!--<td class=\"$TdStyle\" align=center>{$isi['f']}.{$isi['g']}.{$isi['h']}.{$isi['i']}.{$isi['j']}</td>			<td class=\"$TdStyle\" align=center>{$isi['noreg']}</td>			<td class=\"$TdStyle\">{$nmBarang['nm_barang']}</td>			<td class=\"$TdStyle\" align=center>{$isi['thn_perolehan']}</td>-->			$List_			<td class=\"$TdStyle\" align=center>".TglInd($isi['tgl_pengamanan'])."/<br>".TglInd($isi['tgl_perolehan'])."</td>						<td class=\"$TdStyle\">".$Main->JenisPengamanan[$isi['jenis_pengamanan']-1][1]."</td>						<td class=\"$TdStyle\">{$isi['uraian_kegiatan']}</td>						<td class=\"$TdStyle\">{$isi['pengaman_instansi']}</td>			<td class=\"$TdStyle\">{$isi['pengaman_alamat']}</td>			<td class=\"$TdStyle\">{$isi['surat_no']}</td>			<td class=\"$TdStyle\" align=center>".TglInd($isi['surat_tgl'])."</td>			<td class=\"$TdStyle\" align=right>".number_format(($isi['biaya_pengamanan']), 2, ',', '.')."</td>						<td class=\"$TdStyle\">{$isi['ket']}</td>			$TampilCheckBoxKol2			</tr>		";			} 				$cb++;	}		//total & Hal ----------------------------------------------------------	if ($Style==2 && $Cetak==FALSE ){			//total ------------		$totalHal = "			<tr class='row0'>			<td colspan=15 class=\"$TdStyle\">Total Harga per Halaman </td>			<td align=right class=\"$TdStyle\"><b>".number_format(($jmlTotalHargaDisplay), 2, ',', '.')."</td>			<td   class=\"$TdStyle\">&nbsp;</td>			</tr>";					$aqry = "select sum(biaya_pengamanan) as total  from $Tbl $Kondisi"; // echo " $aqry<br>";		$jmlTotalHarga =  table_get_value($aqry,'total');		if ($Xls){		$totalAll = "				<tr class='row0'>			<td class=\"$TdStyle\" colspan=15 >Total Harga Seluruhnya </td>			<td class=\"$TdStyle\" align=right><b>".number_format(($jmlTotalHarga), 2, '.', '')."</td>			<td class=\"$TdStyle\" >&nbsp;</td>			</tr>";					} else {		$totalAll = "				<tr class='row0'>			<td class=\"$TdStyle\" colspan=15 >Total Harga Seluruhnya </td>			<td class=\"$TdStyle\" align=right><b>".number_format(($jmlTotalHarga), 2, ',', '.')."</td>			<td class=\"$TdStyle\" >&nbsp;</td>			</tr>";					}		//Hal --------------			$aqry = "select count(*) as cnt  from $Tbl $Kondisi"; // echo " $aqry";		$jmlDataPGN =  table_get_value($aqry,'cnt');		$Hal = "<tr>				<td colspan=19 align=center>".Halaman($jmlDataPGN,$Main->PagePerHal,"HalPMN")."</td>			</tr>";	}	if($Cetak ){		$totalHal = "			<tr class='row0'>			<td colspan=14 class=\"$TdStyle\">Total</td>			<td align=right class=\"$TdStyle\"><b>".number_format(($jmlTotalHargaDisplay), 2, ',', '.')."</td>			<td   class=\"$TdStyle\">&nbsp;</td>			</tr>";	}		//header---------------	if($fmKIB=='01' || $fmKIB=='03' || $fmKIB=='04' || $fmKIB=='06' ){		$tampilMerk = "<th class='th01' style='width:200'>Alamat</th>";	}else{		$tampilMerk = "<th class='th01' width='70'>Merk/ Tipe</th>";		}	if($fmKIB=='01' ){		$tampilSert = "<th class=\"th01\" width='70'>No. Sertifikat/ Tanggal/ Hak</th>";	}else if( $fmKIB=='03' || $fmKIB=='04' || $fmKIB=='06' ){		$tampilSert = "<th class=\"th01\" width='70'>No. Dokumen/ Tanggal </th>";	}else{		$tampilSert = "<th class=\"th01\" width='70'>No. Sertifikat/ No. Pabrik/ No. Chasis/ No. Mesin</th>";		}	$tampilSertMerk	= $tampilMerk .$tampilSert;	$TampilCheckBox = $Cetak? '' : "<TH class=\"th01\" rowspan=2 style='width:30'><input type=\"checkbox\" name=\"Pengaman_toggle\" value=\"\" onClick=\"checkAll1b($jmlTampilPGN,'cbPGN','Pengaman_toggle','Pengaman_checkbox');\" /></TH>";	$TampilCheckBoxKol1 = $Style==1? '' : $TampilCheckBox;		$TampilCheckBoxKol2 = $Style==1? $TampilCheckBox	: '';		$Head1 = $Style==2?		"<TH class=\"th01\" rowspan=2 style='width:70'>Kode Barang</TH>			<TH class=\"th01\" rowspan=2 style='width:40'>Nomor<br>Reg.</TH>			<TH class=\"th02\" colspan=3 style='width:200'>Spesifikasi Barang</TH>			<TH class=\"th01\" rowspan=2 style='width:40'>Tahun<br>Perolehan</TH>"		:'';	$Head2 =  $Style==2?		"<TH class=\"th01\" rowspan=1 style='width:200'>Nama Barang</TH>		$tampilSertMerk	"		: '';	/*$CheckBox = $Style==1?		"<TH class=\"th01\" rowspan=2 style='width:30'><input type=\"checkbox\" name=\"Pengaman_toggle\" value=\"\" onClick=\"checkAll1b($jmlTampilPGN,'cbPGN','Pengaman_toggle','Pengaman_checkbox');\" /></TH>"		:"";*/	$Pengaman_header = 		"<TR>			<TH class=\"th01\" rowspan=2 style='width:40'>No</TD>						$TampilCheckBoxKol1			$Head1			<TH class=\"th01\" rowspan=2 style='width:70'>Tanggal Buku / Tanggal Perolehan</TH>			<TH class=\"th01\" rowspan=2 style='width:100;'>Jenis<br>Pengamanan</TH>			<TH class=\"th01\" rowspan=2 style=''>Uraian<br>Pengamanan</TH>			<TH class=\"th02\" colspan=2>Pihak Pengaman</TH>			<TH class=\"th02\" colspan=2>Surat Perjanjian / Kontrak</TH>			<TH class=\"th01\" rowspan=2 style='width:100'>Biaya</TH>						<TH class=\"th01\" rowspan=2 style='width:100'>Keterangan</TH>			$TampilCheckBoxKol2		</TR>		<TR>			$Head2			<TH class=\"th01\">Instansi</TH>			<TH class=\"th01\" style=''>Alamat</TH>			<TH class=\"th01\" style='width:75'>Nomor</TH>			<TH class=\"th01\" style='width:60'>Tanggal</TH>		</TR>		";							//menu	if ($Style==1){	$Pengaman_Menu = $ReadOnly? '':		"<li><a href='javascript:PengamanHapus.Hapus()' title='Hapus Pengamanan' class='btdel'></a></li>		<li><a href='javascript:PengamanForm.Edit()' title='Edit Pengamanan' class='btedit'></a>			<ul id='bgn_ulEntry'>				<li style='width:470;top:-4;z-index:99;'>													</li>			</ul>		</li>		<li><a  href='javascript:PengamanForm.Baru()' title='Tambah Pengamanan' class='btadd'></a>			<ul id='bgn_ulEntry'>				<li style='width:470;top:-4;z-index:99;'>					</li>			</ul>		</li>";	$Pengaman_Menu=		"<table class='' width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td style='padding:0'>		<div class='menuBar2' style='' >		<ul>		$Pengaman_Menu			<li><a  href='javascript:PengamanRefresh.Refresh()' title='Refresh Pengamanan' class='btrefresh'></a></li>		<!--<li><a style='padding:2;width:55;color:white;font-size:11;' href='javascript:PengamanRefresh.Refresh()' title='Refresh Pengamanan' class=''>[ Refresh ]</a></li>-->		</ul>			<a id='Pengaman_jmldata' style='cursor:default;position:relative;left:2;top:2;color:gray;font-size:11;' title='Jumlah Pengamanan'>[ $jmlTampilPGN ]</a>			</div>		</td></tr></table>";	}		//echo "jmlTampilPGN = $jmlTampilPGN";	return $Pengaman_Menu.			"<table class='$TblStyleClass' border='1' width='100%'  >			$Pengaman_header			$ListData			$totalHal			$totalAll			$Hal			</table>			<input type='hidden' value='' id='Pengaman_checkbox' >			<input type='hidden' value='$jmlTampilPGN' id='jmlTampilPGN' >			"			;}function Pengaman_Hapus(){	global $Main;	$errmsg=''; $Del = FALSE;	$cidPGN= $_GET['cidPGN'];	for($i = 0; $i<count($cidPGN); $i++)	{		//$id= $cidPLH[$i]; //$str.=$id.'-';		if($errmsg ==''){				//ambil id buku induk				$old = mysql_fetch_array(mysql_query(					"select idbi_awal, id_bukuinduk,tgl_pengamanan from pengamanan where id='{$cidPGN[$i]}'"				));						//cek status barangnya				$penatausaha = mysql_fetch_array(mysql_query(					"select status_barang,c,d,e,e1 from buku_induk where id='{$old['id_bukuinduk']}'"				));				//if($Main->VERSI_NAME <> 'SERANG'){					//cek sudah ada penyusutan / tdk						$fmTANGGALPENGAMANAN = $old['tgl_pengamanan'];					$idbi = $old['id_bukuinduk'];					$idbi_awal = $old['idbi_awal'];					$thn_pengaman = substr($fmTANGGALPENGAMANAN,0,4);					$query_susut = "select count(*)as jml_susut from penyusutan where idbi='$idbi' and tahun>='$thn_pengaman'";					$get_susut = mysql_fetch_array(mysql_query($query_susut));					if($get_susut['jml_susut']>0){						$errmsg="Id ".$cidPGN[$i].", Sudah ada penyusutan !";					}					//cek sudah ada Closing					if(sudahClosing($fmTANGGALPENGAMANAN,$penatausaha['c'],$penatausaha['d'],$penatausaha['e'],$penatausaha['e1'])){						$errmsg = "Id ".$cidPGN[$i].", Tanggal Sudah Closing !";					}					//cek ada tgl_koreksi dan tgl_koreksi > tgl_pengamanan					$get_koreksi = mysql_fetch_array(mysql_query("select count(*) as cnt from t_koreksi where idbi_awal='$idbi_awal' and tgl>'$fmTANGGALPENGAMANAN'"));					//$errmsg="old=".$old_pengaman['biaya_pengamanan'];					if($get_koreksi['cnt']>0 )$errmsg = 'Data tidak bisa di hapus,Tanggal koreksi melebihi tanggal pengamanan !';					//--------------------------------------				//}				if ($errmsg =='' && $penatausaha['status_barang']==3 ) $errmsg = "Gagal Hapus. Barang untuk Pengamanan ini sudah dihapuskan!";				if ($errmsg =='' && $penatausaha['status_barang']==4 ) $errmsg = 'Gagal Hapus. Barang untuk Pengamanan ini sudah dipindah tangankan!';				if ($errmsg =='' && $penatausaha['status_barang']==5 ) $errmsg = 'Gagal Hapus. Barang untuk Pengamanan ini sudah diganti rugi!';		}		if($Main->VERSI_NAME <> 'SERANG'){			$xid=$cidPGN[$i];		}else{			$xid=$cidPLH[$i];		}		if ($errmsg=='') $errmsg=Pengaman_CekdataCutoff('hapus',$xid,'');					if ($errmsg ==''){			$aqry = "delete from pengamanan where id='{$cidPGN[$i]}' limit 1";			$Del = mysql_query($aqry);						if($Main->VERSI_NAME <> 'SERANG'){				if (!$Del){				$errmsg = "Gagal Hapus ID {$cidPGN[$i]} ";				}else{					if($Main->MODUL_JURNAL) jurnalPengamanan($cidPGN[$i],'',3);				}			}else{				if (!$Del){				$errmsg = "Gagal Hapus ID {$cidPGN[$i]} ";				}			}		}				if($errmsg !='') break;	}	return $errmsg ;}function Pengaman_createScriptJs($Style=1){	//$elemArr = implode(',', array("'PengamanList'") );		switch( $Style){		case 1:{ 			return "				<div><div><script>					PengamanRefresh= new AjxRefreshObj('PengamanList','Pengaman_cover', 'divPengamanList', new Array('idbi_awal') );					PengamanSimpan= new AjxSimpanObj('PengamanSimpan','PengamanSimpan_cover',						new Array('fmTANGGALPENGAMANAN','fmJENISPENGAMANAN','fmURAIANKEGIATAN',							'fmPENGAMANINSTANSI','fmPENGAMANALAMAT', 'fmSURATNOMOR', 'fmSURATTANGGAL', 							'fmBIAYA', 'fmKET','fmTAMBAHASET','fmTANGGALPEROLEHAN','idbi','idbi_awal','idplh','fmst'),						'PengamanForm.Close();PengamanRefresh.Refresh();' );					PengamanForm= new AjxFormObj('PengamanForm','Pengaman_cover','Pengaman_checkbox','jmlTampilPGN', 						'cbPGN', new Array('idbi','idbi_awal'), 'document.getElementById(\'fmTANGGALPENGAMANAN_tgl\').focus()');					PengamanHapus= new AjxHapusObj('PengamanHapus',  'Pengaman_cover', 'Pengaman_checkbox', 'jmlTampilPGN', 						'cbPGN', 'cidPGN','PengamanRefresh.Refresh();');						</script></div></div>";			break;		}		case 2:{ 			$refresh = '';//"document.getElementById(\'btTampil\').click()";			return "				<div><div><script>					//PengamanRefresh= new AjxRefreshObj('PengamanList','Pengaman_cover', 'divPengamanList', new Array('idbi_awal') );					PengamanSimpan= new AjxSimpanObj('PengamanSimpan','PengamanSimpan_cover',						new Array('fmTANGGALPENGAMANAN','fmJENISPENGAMANAN','fmURAIANKEGIATAN',							'fmPENGAMANINSTANSI','fmPENGAMANALAMAT', 'fmSURATNOMOR', 'fmSURATTANGGAL', 							'fmBIAYA', 'fmKET','fmTAMBAHASET','fmTANGGALPEROLEHAN','idplh','fmst','idbi_awal'),						'PengamanForm.Close();$refresh' );					PengamanForm= new AjxFormObj('PengamanForm','Pengaman_cover','Pengaman_checkbox','jmlTampilPGN', 						'cbPGN', new Array(), 'document.getElementById(\'fmTANGGALPENGAMANAN_tgl\').focus()');					PengamanHapus= new AjxHapusObj('PengamanHapus',  'Pengaman_cover', 'Pengaman_checkbox', 'jmlTampilPGN', 						'cbPGN', 'cidPGN','$refresh');						</script></div></div>";			break;		}	}}function Pengaman_CekdataCutoff($mode='insert',$id='',$tgl='',$idbi=''){global $Main;$usrlevel=$Main->UserLevel;$errmsg='';if ($usrlevel!='1'){	$tglcutoff=$Main->TAHUN_CUTOFF."-12-31";switch ($mode){	case 'insert':{	if ($tgl<$tglcutoff) $errmsg="Tgl. pengamanan(".$tgl.") lebih kecil dari tgl. cut off (".$tglcutoff.")";		 		break;}case 'edit':{//	if ($tgl<$tglcutoff) $errmsg="Data dengan tgl. penghapusan lebih kecil dari tgl. ".$tglcutoff; 			//cek tanggal buku	if ($errmsg==''){			$datax = mysql_fetch_array(mysql_query(				"select * from pengamanan where id='$id'"));				$tgl=$datax['tgl_pengamanan'];				if ($tgl<=$tglcutoff)				$errmsg="Data dengan tgl. pengamanan(".$tgl.") lebih kecil dari tgl. cut off (".$tglcutoff.") tidak dapat diedit";	}		break;}case 'hapus':{	if ($errmsg==''){			$datax = mysql_fetch_array(mysql_query(				"select * from pengamanan where id='$id'"));					$tgl=$datax['tgl_pengamanan'];				if ($tgl<=$tglcutoff)				$errmsg="Data dengan tgl. pengamanan(".$tgl.") lebih kecil dari tgl. cut off (".$tglcutoff.") tidak dapat dihapus";	}		break;}	}}return $errmsg;}?>