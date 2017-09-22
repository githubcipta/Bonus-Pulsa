<?php

class belanja_gajiObj  extends DaftarObj2{	
	var $Prefix = 'belanja_gaji';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'pengaturan_gaji'; //daftar 
	var $TblName_Hapus = 'pengaturan_gaji';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('Id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $fieldSum_lokasi = array(12);
	var $FieldSum_Cp1 = array( 11, 1, 1);//berdasar mode
	var $FieldSum_Cp2 = array( 11, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'Pengaturan Belanja Gaji';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	var $cetak_xls=TRUE ;
	var $fileNameExcel='LRA.xls';
	var $Cetak_Judul = 'DAFTAR LRA';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'belanja_gajiForm'; 
	var $kdbrg = '';	
			
	function setTitle(){
		return 'Pengaturan Belanja Gaji';
	}
	function setMenuEdit(){		
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","new_f2.png","Baru",'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus').
			"</td>";
	}
	
	var $stBulan = array(
			array('01','January'), 
			array('02','Febuary'),
			array('03','Maret'),
			array('04','April'),
			array('05','Mei'),
			array('06','Juni'),
			array('07','Juli'),
			array('08','Agustus'),
			array('09','September'),
			array('10','Oktober'),
			array('11','November'),
			array('12','Desember'),
		);	
	
	function setCetak_Header($Mode=''){
		global $Main, $HTTP_COOKIE_VARS;
		
		//$fmSKPD = cekPOST($this->Prefix.'SkpdfmSKPD'); //echo 'fmskpd='.$fmSKPD;
		//$fmUNIT = cekPOST($this->Prefix.'SkpdfmUNIT');
		//$fmSUBUNIT = cekPOST($this->Prefix.'SkpdfmSUBUNIT');
		return
			"<table style='width:100%' border=\"0\">
			<tr>
				<td class=\"judulcetak\">".$this->setCetakTitle()."</td>
			</tr>
			</table>";	
			/*"<table width=\"100%\" border=\"0\">
				<tr>
					<td class=\"subjudulcetak\">".PrintSKPD2($fmSKPD, $fmUNIT, $fmSUBUNIT)."</td>
				</tr>
			</table><br>";*/
	}	
	
	function simpanUrusan(){
	global $HTTP_COOKIE_VARS;
	global $Main;
	 
		$uid = $HTTP_COOKIE_VARS['coID'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		//get data -----------------
		$fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 	$idplh = $_REQUEST[$this->Prefix.'_idplh'];
		$dtc1= $_REQUEST['c1'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Bidang Belum Di Isi !!';
		if($fmST == 0){
			if($err==''){
				$aqry = "INSERT into ref_skpd (c1,c,d,e,e1,nm_skpd,nm_barcode) values('$dtc1','00','00','00','000','$nama','-')";	
				$cek .= $aqry;	
				$qry = mysql_query($aqry);
				$content=$dtc1;	
				}
			}
				
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanBidang(){
	global $HTTP_COOKIE_VARS;
	global $Main;
	 
		$uid = $HTTP_COOKIE_VARS['coID'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		//get data -----------------
		$fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 	$idplh = $_REQUEST[$this->Prefix.'_idplh'];
		$dtc1= $_REQUEST['c1'];
		$dtc= $_REQUEST['c'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Bidang Belum Di Isi !!';
		if($fmST == 0){
			if($err==''){
				$aqry = "INSERT into ref_skpd (c1,c,d,e,e1,nm_skpd,nm_barcode) values('$dtc1','$dtc','00','00','000','$nama','-')";	
				$cek .= $aqry;	
				$qry = mysql_query($aqry);
				$content=$dtc;	
				}
			}
				
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanSKPD(){
	global $HTTP_COOKIE_VARS;
	global $Main;
	 
		$uid = $HTTP_COOKIE_VARS['coID'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		//get data -----------------
		$fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 	$idplh = $_REQUEST[$this->Prefix.'_idplh'];
		$dtc1= $_REQUEST['c1'];
		$dtc= $_REQUEST['c'];
		$dtd= $_REQUEST['d'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Bidang Belum Di Isi !!';
		if($fmST == 0){
			if($err==''){
				$aqry = "INSERT into ref_skpd (c1,c,d,e,e1,nm_skpd,nm_barcode) values('$dtc1','$dtc','$dtd','00','000','$nama','-')";	
				$cek .= $aqry;	
				$qry = mysql_query($aqry);
				$content=$dtd;	
				}
			}
				
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanUnit(){
	global $HTTP_COOKIE_VARS;
	global $Main;
	 
		$uid = $HTTP_COOKIE_VARS['coID'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		//get data -----------------
		$fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 	$idplh = $_REQUEST[$this->Prefix.'_idplh'];
		$dtc1= $_REQUEST['c1'];
		$dtc= $_REQUEST['c'];
		$dtd= $_REQUEST['d'];
		$dte= $_REQUEST['e'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Unit Belum Di Isi !!';
		
			if($err==''){
				$aqrykd = "INSERT into ref_skpd (c1,c,d,e,e1,nm_skpd,nm_barcode) values('$dtc1','$dtc','$dtd','$dte','000','$nama','-')";	
				$cek .= $aqrykd;	
				$qry = mysql_query($aqrykd);
				$content=$dte;	
				}
			
				
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanEdit(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$dk= $_REQUEST['c1'];
	$dl= $_REQUEST['c'];
	$dm= $_REQUEST['d'];
	$dn= $_REQUEST['e'];
	$do= $_REQUEST['e1'];
	$nama= $_REQUEST['nm_skpd'];
	$barcode= $_REQUEST['nm_barcode'];
	

	//$ke = substr($ke,1,1);
	
								
	if($err==''){						
		
	$aqry = "UPDATE ref_skpd set c1='$dk',c='$dl',d='$dm',e='$dn',e1='$do',nm_skpd='$nama',nm_barcode='$barcode' where concat (c1,' ',c,' ',d,' ',e,' ',e1)='".$idplh."'";$cek .= $aqry;
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
	 /*$kode0 = $_REQUEST['fmc1'];
     $kode1= $_REQUEST['fmc'];
	 $kode2= $_REQUEST['fmd'];
	 $kode3= $_REQUEST['fme'];
	 $kode4= $_REQUEST['e1'];
	 $nama_skpd = $_REQUEST['nama'];
	 $nama_barcode = $_REQUEST['barcode'];*/
	 
	$istri = $_REQUEST['istri'];
	$anak = $_REQUEST['anak'];
	$umuranak = $_REQUEST['umuranak'];	
	$umuranaksarjana = $_REQUEST['umuranaksarjana'];
	$hargaberas = $_REQUEST['hargaberas'];
	$volumeberas = $_REQUEST['volumeberas'];
	$jmlpph = $_REQUEST['jmlpph'];
	$thnanggaran = $_REQUEST['thnanggaran'];
	$blnperhitungan = $_REQUEST['blnperhitungan'];		 
	$volume = $_REQUEST['volume'];
	$accres = $_REQUEST['accres'];
		
	if( $err=='' && $istri =='' ) $err= 'Data Istri Belum Di Isi !!'; 
	if( $err=='' && $anak =='' ) $err= 'Data Anak Belum Di Isi !!'; 
	if( $err=='' && $umuranak =='' ) $err= 'Data Umur Anak Belum Di Isi !!'; 
	if( $err=='' && $umuranaksarjana =='' ) $err= 'Data Umur Sarjana Anak Belum Di Isi !!'; 
	if( $err=='' && $hargaberas =='' ) $err= 'Data Harga Beras Belum Di Isi !!'; 
	if( $err=='' && $volumeberas =='' ) $err= 'Data Volume Beras Belum Di Isi !!'; 
	if( $err=='' && $jmlpph =='' ) $err= 'Data Jumlah PPH Belum Di Isi !!'; 
	if( $err=='' && $thnanggaran =='' ) $err= 'Data Tahun Anggaran Belum Di Isi !!'; 
	if( $err=='' && $blnperhitungan =='' ) $err= 'Data Bulan Perhitungan Belum Di Isi !!'; 
	if( $err=='' && $volume =='' ) $err= 'Data Volume Belum Di Isi !!'; 
	if( $err=='' && $accres =='' ) $err= 'Data Accres Belum Di Isi !!'; 
		
	 
			if($fmST == 0){
			
				if($err==''){
					$aqry = "INSERT into pengaturan_gaji (istri,anak,umur_anak,umur_anaksarjana,harga_beras,volume_beras,jml_pph,thn_anggaran,bln_perhitungan,volume,accres) values('$istri','$anak','$umuranak','$umuranaksarjana','$hargaberas','$volumeberas','$jmlpph','$thnanggaran','$blnperhitungan','$volume','$accres')";	$cek .= $aqry;	
					$qry = mysql_query($aqry);
				}
			}else{	
			
			if( $err=='' && $istri =='' ) $err= 'Data Istri Belum Di Isi !!'; 
			if( $err=='' && $anak =='' ) $err= 'Data Anak Belum Di Isi !!'; 
			if( $err=='' && $umuranak =='' ) $err= 'Data Umur Anak Belum Di Isi !!'; 
			if( $err=='' && $umuranaksarjana =='' ) $err= 'Data Umur Sarjana Anak Belum Di Isi !!'; 
			if( $err=='' && $hargaberas =='' ) $err= 'Data Harga Beras Belum Di Isi !!'; 
			if( $err=='' && $volumeberas =='' ) $err= 'Data Volume Beras Belum Di Isi !!'; 
			if( $err=='' && $jmlpph =='' ) $err= 'Data Jumlah PPH Belum Di Isi !!'; 
			if( $err=='' && $thnanggaran =='' ) $err= 'Data Tahun Anggaran Belum Di Isi !!'; 
			if( $err=='' && $blnperhitungan =='' ) $err= 'Data Bulan Perhitungan Belum Di Isi !!'; 
			if( $err=='' && $volume =='' ) $err= 'Data Volume Belum Di Isi !!'; 
			if( $err=='' && $accres =='' ) $err= 'Data Accres Belum Di Isi !!'; 
								
				if($err==''){
				$aqry = "UPDATE pengaturan_gaji SET istri='$istri',anak='$anak',umur_anak='$umuranak',umur_anaksarjana='$umuranaksarjana',harga_beras='$hargaberas',volume_beras='$volumeberas',jml_pph='$jmlpph',thn_anggaran='$thnanggaran',bln_perhitungan='$blnperhitungan',volume='$volume',accres='$accres' where Id='".$idplh."'";$cek .= $aqry;
						$qry = mysql_query($aqry) or die(mysql_error());
			
					}
			
			} //end else
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	/*function refreshUrusan(){
	global $Main;
	 
		$kc102 = $_REQUEST['fmc1'];	 
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kc1new= $_REQUEST['id_UrusanBaru'];
	 
		$queryKc1="SELECT c1, concat(c1, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1<>'00' and c = '00' and d='00' and e='00' and e1='000'" ;
	
	//	$cek.="SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1='$kc102' and c <> '00' and d='00' and e='00' and e1='000'";
		$content->unit=cmbQuery('fmc1',$kc1new,$queryKc1,'style="width:270;"onchange="'.$this->Prefix.'.pilihUrusan()"','&nbsp&nbsp-------- Pilih Urusan -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUrusan()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}	
	
	function refreshBidang(){
	global $Main;
	 
		$kc102 = $_REQUEST['fmc1'];	 
		$kc02 = $_REQUEST['fmc'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kcnew= $_REQUEST['id_BidangBaru'];
	 
		$queryKc="SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1='$kc102' and c <> '00' and d='00' and e='00' and e1='000'" ;
	
		$cek.="SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1='$kc102' and c <> '00' and d='00' and e='00' and e1='000'";
		$content->unit=cmbQuery('fmc',$kcnew,$queryKc,'style="width:270;"onchange="'.$this->Prefix.'.pilihBidang()"','&nbsp&nbsp-------- Pilih Bidang -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruBidang()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}	
	
	function refreshSKPD(){
	global $Main;
	 
		$kc102 = $_REQUEST['fmc1'];	 
		$kc02 = $_REQUEST['fmc'];
		$kd02 = $_REQUEST['fmd'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kdnew= $_REQUEST['id_SKPDBaru'];
	 
		$queryKd="SELECT d, concat(d, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1='$kc102' and c='$kc02' and d<>'00' and e='00' and e1='000'" ;
	
		$cek.="SELECT d, concat(d, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1='$kc102' and c='$kc02' and d<>'00' and e='00' and e1='000'";
		$content->unit=cmbQuery('fmd',$kdnew,$queryKd,'style="width:270;"onchange="'.$this->Prefix.'.pilihSKPD()"','&nbsp&nbsp-------- Pilih SKPD -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruSKPD()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}	
	
	function refreshUnit(){
	global $Main;
	 
		$ka02 = $_REQUEST['fmc1'];	 
		$kb02 = $_REQUEST['fmc'];
		$kc02 = $_REQUEST['fmd'];
		$kd02 = $_REQUEST['fme'];
	//	$fmJenis2 = $_REQUEST['fmJenis2'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kdnew= $_REQUEST['id_UnitBaru'];
	 
	 $queryKD="SELECT e, concat(e,' . ', nm_skpd) as vnama  FROM ref_skpd WHERE c1='$ka02' and c='$kb02' and d='$kc02' and e<>'00' and e1='000'" ;
	 $cek.="SELECT e, concat(e,' . ', nm_skpd) as vnama  FROM ref_skpd WHERE c1='$ka02' and c='$kb02' and d='$kc02' and e<>'00' and e1='000'";
	 
		$koden=$queryKD['e'];
		$new = sprintf("%02s", $koden);
		$kode_n=$new.".".$queryKD['nm_skpd'];
	
		$content->unit=cmbQuery('fme',$kdnew,$queryKD,'style="width:270;"onchange="'.$this->Prefix.'.pilihUnit()"','&nbsp&nbsp-------- Pilih UNIT -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUnit()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}*/
	
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
   
   function setMenuView(){
		
			}
	
	function setPage_OtherScript(){
		$scriptload = 

					"<script>
						$(document).ready(function(){ 
							".$this->Prefix.".loading();
						});
						
					</script>";
					
		return 
			 "<script src='js/skpd.js' type='text/javascript'></script>
			 <script type='text/javascript' src='js/pengaturan_belanja_gaji/belanja_gaji.js' language='JavaScript' ></script>
	
			 ".
			// "<script type='text/javascript' src='js/master/ref_aset/refjurnal.js' language='JavaScript' ></script>".
			
			$scriptload;
	}
	
	function setFormBaru(){
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$c1 = $_REQUEST[$this->Prefix.'SkpdfmUrusan'];
		$c = $_REQUEST[$this->Prefix.'SkpdfmSKPD'];
		$d = $_REQUEST[$this->Prefix.'SkpdfmUNIT'];
		$e = $_REQUEST[$this->Prefix.'SkpdfmSUBUNIT'];
		$cek = $cbid[0];
				
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 0;
			
	$dt=array();
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		$dt['tgl'] = date("Y-m-d"); //set waktu sekarang
		$dt['c1'] = $c1; 
		$dt['c'] = $c; 
		$dt['d'] = $d; 
		$dt['e'] = $e; 
		$fm = $this->setForm($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
  	function setFormEdit(){
		
	$cek ='';
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		
		$this->form_fmST = 1;				
		//get data 
		$aqry = "SELECT * FROM  pengaturan_gaji  WHERE Id='".$this->form_idplh."'"; $cek.=$aqry;
		$dt = mysql_fetch_array(mysql_query($aqry));
		$fm = $this->setForm($dt);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	
		
	function setForm($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 700;
	 $this->form_height = 370;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Form Pengaturan Belanja Gaji';
	  }else{
		$this->form_caption = 'Edit Pengaturan Belanja Gaji';
		//$readonly='readonly';
	  }
	  	
		
		$fmc1 = $_REQUEST['fmc1'];
		$fmc = $_REQUEST['fmc'];
		$fmd = $_REQUEST['fmd'];
		$fme = $_REQUEST['fme'];
		$fme1 = $_REQUEST['fme1'];
		
					
		$queryc1="SELECT c1, concat(c1, '. ', nm_skpd) as vnama FROM ref_skpd where c=00 and d=00 and e=00 and e1=000";
		$queryc="SELECT c,nm_skpd FROM ref_skpd where c1='$fmc1' and d=00 and e=00 and e1=000";
		$queryd="SELECT d,nm_skpd FROM ref_skpd where c1='$fmc1' and c='$fmc' and e=00 and e1=000";
		$querye="SELECT e,nm_skpd FROM ref_skpd where c1='$fmc1' and c='$fmc' and d='$fmd' and e1=000";
		$querye1="SELECT e1,nm_skpd FROM ref_skpd where c1='$fmc1' and c='$fmc' and d='$fmd' and e='$fme'";
		
		
		/*$queryc1="SELECT * FROM ref_skpd where c=00 and d=00 and e=00 and e1=000";
		$lvl1_1=mysql_query("SELECT count(*) as cnt, c1 , c , d , e, e1 FROM ref_skpd WHERE c1='$data_c1' and c='$data_c' and d='$data_d' and e='$data_e' and e1='$data_e1'");*/
		
       //items ----------------------
		  $this->form_fields = array(
		  
			'Penerimaan' => array( 
						'label'=>'',
						'labelWidth'=>100, 
						'value'=>'<b>1.Tunjangan Keluarga</b>', 
						'type'=>'merge',
						'param'=>""
						 ),
			'istri' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Suami/Istri (%)',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'><input type='text' name='istri' id='istri' value='".$dt['istri']."' style='width:220px;' ></div>", 
						 ),	
			
			'anak' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Anak (%)',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='anak' id='anak' value='".$dt['anak']."' style='width:220px;' ></div>", 
						 ),	
						 
			'umur_anak' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Umur Anak',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='umuranak' id='umuranak' value='".$dt['umur_anak']."' style='width:220px;' ></div>", 
						 ),	
						 
			'umur_anak_sarjana' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Umur Anak Sarjana',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='umuranaksarjana' id='umuranaksarjana' value='".$dt['umur_anaksarjana']."' style='width:220px;' ></div>", 
						 ),				 			 			 
						 
			'Tunjangan_beras' => array( 
						'label'=>'',
						'labelWidth'=>100, 
						'value'=>'<b>2.Tunjangan Beras</b>', 
						'type'=>'merge',
						'param'=>""
						 ),
			'harga_beras' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Harga Beras / Liter',
						'labelWidth'=>150, 
						'value'=>inputFormatRibuan('hargaberas','size=33', $dt['harga_beras'],'')
						 ),	
			
			'volume_beras' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Volume Beras',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='volumeberas' id='volumeberas' value='".$dt['volume_beras']."' style='width:220px;' ></div>", 
						 ),	
							 
			'Tunjangan_pph' => array( 
						'label'=>'',
						'labelWidth'=>100, 
						'value'=>'<b>3.Tunjangan PPH/Khusus</b>', 
						'type'=>'merge',
						'param'=>""
						 ),
			'jumlah' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Jumlah',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'><input type='text' name='jmlpph' id='jmlpph' value='".$dt['jml_pph']."' style='width:220px;' ></div>", 
						 ),	
			
			'Rencana_belanja_pegawai' => array( 
						'label'=>'',
						'labelWidth'=>100, 
						'value'=>'<b>4.Rencana Belanja Pegawai</b>', 
						'type'=>'merge',
						'param'=>""
						 ),
			'tahun_anggaran' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Tahun Anggaran',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'><input type='text' name='thnanggaran' id='thnanggaran' value='".$dt['thn_anggaran']."' style='width:220px;' ></div>", 
						 ),	
			'bulan_perhitungan' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Bulan Perhitungan',
						'labelWidth'=>100, 
						'value'=>cmbArray('blnperhitungan',$dt['bln_perhitungan'],$this->stBulan,'--PILIH--',''), 
						 ),
			/*'bulan_perhitungan1' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Bulan Perhitungan',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='blnperhitungan' id='blnperhitungan' value='".$dt['bln_perhitungan']."' style='width:220px;' placeholder='03'></div>", 
						 ),	*/
						 
			'volume' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Volume',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='volume' id='volume' value='".$dt['volume']."' style='width:220px;' ></div>", 
						 ),	
						 
			'accres' => array( 
						'label'=>'&nbsp&nbsp&nbsp&nbsp Accres (%)',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='accres' id='accres' value='".$dt['accres']."' style='width:220px;' ></div>", 
						 ),					 			 			 	  
		  
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
			
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	
		
	//daftar =================================	
	function setKolomHeader($Mode=1, $Checkbox=''){
		$cetak = $Mode==2 || $Mode==3 ;
		
			
		$headerTable =
				"<tr>
				<th class='th01' width='20' rowspan=2>No.</th>
  	  			$Checkbox 		
   	   			
				<th class='th02' width='50' colspan=4>Tunjangan Keluarga</th>
				<th class='th02' width='50' colspan=2>Tunjangan Beras</th>
				<th class='th02' width='10%' colspan=1>Tunjangan PPH/Khusus</th>
				<th class='th02' width='50' colspan=4>Rencana Belanja Pegawai</th>
				</tr>
				
				<tr>
				<th class='th01' width='5%' rowspan=2>Suami / Istri (%)</th>
				<th class='th01' width='5%' rowspan=2>Anak (%)</th>
				<th class='th01' width='5%' rowspan=2>Umur Anak</th>
				<th class='th01' width='5%' rowspan=2>Umur Anak Sarjana</th>
				<th class='th01' width='10%' rowspan=2>Harga Beras/Liter</th>
				<th class='th01' width='10%' rowspan=2>Volume Beras</th>
				<th class='th01' width='10' rowspan=2>Jumlah (%)</th>
				<th class='th01' width='10%' rowspan=2>Bulan Perhitungan</th>
				<th class='th01' width='10%' rowspan=2>Tahun Angggaran</th>
				
				<th class='th01'>Volume</th>
				<th class='th01'>Accres</th>
				</tr>
				";
				//$tambahgaris";
		return $headerTable;
	}
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Main,$HTTP_COOKIE_VARS;
			
		if($isi['bln_perhitungan']==01){
	 	$bln='January';
	 	}elseif($isi['bln_perhitungan']==02){
	 	$bln='Febuary';
	 	}elseif($isi['bln_perhitungan']==03){
	 	$bln='Maret';
		}elseif($isi['bln_perhitungan']==04){
	 	$bln='April';
		}elseif($isi['bln_perhitungan']==05){
	 	$bln='Mei';
		}elseif($isi['bln_perhitungan']==06){
	 	$bln='Juni';
		}elseif($isi['bln_perhitungan']==07){
	 	$bln='Juli';
		}elseif($isi['bln_perhitungan']==08){
	 	$bln='Agustus';
		}elseif($isi['bln_perhitungan']==09){
	 	$bln='September';
		}elseif($isi['bln_perhitungan']==10){
	 	$bln='Oktober';
		}elseif($isi['bln_perhitungan']==11){
	 	$bln='November';
		}elseif($isi['bln_perhitungan']==12){
	 	$bln='Desember';
		}	
			$Koloms[] = array('align="center" width="20"', $no.'.' );
 			if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 		
			$Koloms[] = array('align="right"',$isi['istri']);
			$Koloms[] = array('align="right"',$isi['anak']);
			$Koloms[] = array('align="right"',$isi['umur_anak']);
			$Koloms[] = array('align="right"',$isi['umur_anaksarjana']);
			$Koloms[] = array('align="right"',$isi['harga_beras']); 
			$Koloms[] = array('align="right"',$isi['volume_beras']);
			$Koloms[] = array('align="right"',$isi['jml_pph']);
	 		$Koloms[] = array('align="left"',$bln);
			$Koloms[] = array('align="left"',$isi['thn_anggaran']); 
	 		$Koloms[] = array('align="right"',$isi['volume']);
	 		$Koloms[] = array('align="right"',$isi['accres']);
	 		

		return $Koloms;
	}
	
	
	
	function genDaftarOpsi(){
	 global $Ref, $Main;
	 

	
	$fmPILCARI = $_REQUEST['fmPILCARI'];	
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];		
	$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];
	$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
	$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
	$fmORDER1 = cekPOST('fmORDER1');
	$fmDESC1 = cekPOST('fmDESC1');
	 $arrOrder = array(
	  	         array('1','Kode SKPD'),
			     array('2','Nama SKPD'),
					);
	$arr = array(
			//array('selectAll','Semua'),	
			array('selectKode','Kode SKPD'),	
			array('selectNama','Nama SKPD'),		
			);
	//$TampilOpt =
			//<table width=\"100%\" class=\"adminform\">
			"<table width=\"100%\" class=\"adminform\">	<tr>		
			
			</tr>
			<!--<tr><td>
				<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>
			</td></tr>			-->
			</table>".
			"<tr><td>".
			"<div id='skpd_pegawai' ></div>".
			$vOrder=			
			genFilterBar(
				array(							
					cmbArray('fmPILCARI',$fmPILCARI,$arr,'-- Cari Data --',''). //generate checkbox					
					"&nbsp&nbsp<input type='text' value='".$fmPILCARIvalue."' name='fmPILCARIvalue' id='fmPILCARIvalue'>&nbsp&nbsp"
					//<input type='button' id='btTampil' value='Cari' onclick='".$this->Prefix.".refreshList(true)'>"
					
					.cmbArray('fmORDER1',$fmORDER1,$arrOrder,'--Urutkan--','').
					"<input $fmDESC1 type='checkbox' id='fmDESC1' name='fmDESC1' value='checked'>&nbspmenurun."
					),			
				$this->Prefix.".refreshList(true)");
			"<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>";
			
		return array('TampilOpt'=>$TampilOpt);
	}			
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
		$arrKondisi = array();	
		$fmPILCARI = $_REQUEST['fmPILCARI'];	
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
		$ref_skpdSkpdfmUrusan = $_REQUEST['ref_skpdSkpdfmUrusan'];
		$ref_skpdSkpdfmSKPD = $_REQUEST['ref_skpdSkpdfmSKPD'];//ref_skpdSkpdfmSKPD
		$ref_skpdSkpdfmUNIT = $_REQUEST['ref_skpdSkpdfmUNIT'];
		$ref_skpdSkpdfmSUBUNIT = $_REQUEST['ref_skpdSkpdfmSUBUNIT'];
		$ref_skpdSkpdfmSEKSI = $_REQUEST['ref_skpdSkpdfmSEKSI'];
		//Cari 
		$isivalue=explode('.',$fmPILCARIvalue);
		switch($fmPILCARI){			
			//case 'selectKode': $arrKondisi[] = " c='".$isivalue[0]."' and d='".$isivalue[1]."' and e='".$isivalue[2]."' and e1='".$isivalue[3]."'"; break;
			case 'selectKode': $arrKondisi[] = " concat(c1,'.',c,'.',d,'.',e,'.',e1) like '$fmPILCARIvalue%'"; break;
			case 'selectNama': $arrKondisi[] = " nm_skpd like '%$fmPILCARIvalue%'"; break;	
								 	
		}	
		if($ref_skpdSkpdfmUrusan!='00' and $ref_skpdSkpdfmUrusan !='' and $ref_skpdSkpdfmUrusan!='0'){
			$arrKondisi[]= "c1='$ref_skpdSkpdfmUrusan'";
			if($ref_skpdSkpdfmSKPD!='00' and $ref_skpdSkpdfmSKPD !='')$arrKondisi[]= "c='$ref_skpdSkpdfmSKPD'";
			if($ref_skpdSkpdfmUNIT!='00' and $ref_skpdSkpdfmUNIT !='')$arrKondisi[]= "d='$ref_skpdSkpdfmUNIT'";
			if($ref_skpdSkpdfmSUBUNIT!='00' and $ref_skpdSkpdfmSUBUNIT !='')$arrKondisi[]= "e='$ref_skpdSkpdfmSUBUNIT'";
			if($ref_skpdSkpdfmSEKSI!='00' and $ref_skpdSkpdfmSEKSI !='')$arrKondisi[]= "e1='$ref_skpdSkpdfmSEKSI'";
		}
		
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		switch($fmORDER1){
			case '1': $arrOrders[] = " c1,c,d,e,e1 $Asc1 " ;break;
			case '2': $arrOrders[] = " nm_skpd $Asc1 " ;break;
			
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
}
$belanja_gaji = new belanja_gajiObj();
?>