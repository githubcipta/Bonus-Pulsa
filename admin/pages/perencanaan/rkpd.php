<?php

class rkpdObj  extends DaftarObj2{	
	var $Prefix = 'rkpd';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'view_rkpd'; //bonus
	var $TblName_Hapus = 'rkpd';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('urut');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = 'RKPD';
	var $PageIcon = 'images/perencanaan_ico.png';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='rkpd.xls';
	var $namaModulCetak='DAFTAR rkpd';
	var $Cetak_Judul = 'DAFTAR rkpd';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'rkpdForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	
	function setTitle(){
		return 'RENCANA KERJA PEMBANGUNAN DAERAH (RKPD) TAHUN '.$_COOKIE['coThnAnggaran'];
	}
	
	function setMenuEdit(){
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","sections.png","Baru", 'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>";
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
	if($transaksi=="RKPD-MURNI"){
		$statusMurni= "1";
		$statusPerubahan = "0";
	}else{
		$statusMurni= "1";
		$statusPerubahan = "1";
	}
	$tanggalMulai = explode("-",$tanggalMulai);
	$tanggalMulai = $tanggalMulai[2]."-".$tanggalMulai[1]."-".$tanggalMulai[0];
	$tanggalSelesai = explode("-",$tanggalSelesai);
	$tanggalSelesai = $tanggalSelesai[2]."-".$tanggalSelesai[1]."-".$tanggalSelesai[0];
	 
			if($fmST == 0){
				if($err==''){
				   
				   
					$getUrusanJudul = mysql_num_rows(mysql_query("select * from rkpd where c1= '$cmbUrusanForm' and c='00' and d='00'"));
					if($getUrusanJudul > 0){
						
					}else{
						$dataUrusan = array(
											'c1' => $cmbUrusanForm,
											'c'	=> '00',
											'd' => '00',
											'tahun' => $tahunAnggaran,
											
											);
						mysql_query(VulnWalkerInsert('rkpd',$dataUrusan));
					}
					
					$getBidangJudul = mysql_num_rows(mysql_query("select * from rkpd where c1= '$cmbUrusanForm' and c='$cmbBidangForm' and d='00'"));
					if($getBidangJudul > 0){
						
					}else{
						$dataBidang = array(
											'c1' => $cmbUrusanForm,
											'c'	=>  $cmbBidangForm,
											'd' => '00',
											'tahun' => $tahunAnggaran,
											
											);
						mysql_query(VulnWalkerInsert('rkpd',$dataBidang));
					}
					
					$getSKPDJudul = mysql_num_rows(mysql_query("select * from rkpd where c1= '$cmbUrusanForm' and c='$cmbBidangForm' and d='$cmbSKPDForm'"));
					if($getSKPDJudul > 0){
						
					}else{
						$dataSKPD = array(
											'c1' => $cmbUrusanForm,
											'c'	=>  $cmbBidangForm,
											'd' => $cmbSKPDForm,
											'tahun' => $tahunAnggaran,
											);
						mysql_query(VulnWalkerInsert('rkpd',$dataSKPD));
					}
					
				
					$dataRKPD = array("c1" => $cmbUrusanForm ,
									  "c"  => $cmbBidangForm ,
									  "d"  => $cmbSKPDForm ,
									  "tahun" => $tahunAnggaran,
									  "murni" => $statusMurni,
									  "perubahan" => $statusPerubahan,
									  "anggaran_murni" => $plafon,
									  "anggaran_perubahan" => $plafonPerubahan
								 	 );
					$querySKPD = "select * from rkpd where c1='$cmbUrusanForm' and c='$cmbBidangForm' and d = '$cmbSKPDForm' and tahun = '$tahunAnggaran' and murni ='1' ";
					$content .= "INI cek RKPD : ".$querySKPD;
					$cekSKPD = mysql_num_rows(mysql_query($querySKPD));
					if($cekSKPD > 0){
				
			
					}else{
						mysql_query( VulnWalkerInsert("rkpd",$dataRKPD));
					}
					
					$getRKPD = mysql_fetch_array(mysql_query("select max(id) as max from rkpd"));
					$idRKPD = $getRKPD['max'];		 
					
					//sd
					
					$programKosong = $tahunAnggaran.".".$cmbUrusanForm.".".$cmbBidangForm.".".$cmbSKPDForm.".".$p.".00";
					$getProgram = mysql_num_rows(mysql_query("select concat(rkpd.tahun,'.',rkpd.c1,'.',rkpd.c,'.',rkpd.d,'.',pelaksanaan.p,'.',q) as programKosong from rkpd inner join pelaksanaan on rkpd.id = pelaksanaan.id_rkpd where concat(rkpd.tahun,'.',rkpd.c1,'.',rkpd.c,'.',rkpd.d,'.',pelaksanaan.p,'.',q) = '$programKosong' "));
					
					
					
					$content .= " DZAKIR : "."select concat(rkpd.tahun,'.',rkpd.c1,'.',rkpd.c,'.',rkpd.d,'.',pelaksanaan.p,'.',q) as programKosong from rkpd inner join pelaksanaan on rkpd.id = pelaksanaan.id_rkpd where concat(rkpd.tahun,'.',rkpd.c1,'.',rkpd.c,'.',rkpd.d,'.',pelaksanaan.p,'.',q) = '$programKosong'";
					if($getProgram > 0){
						
					}else{
						$dataProgram = array(
											  "e" => '00',
											  "e1" => '000',
											  "p" => $p,
											  "q" => '00',
											  'id_rkpd' => $idRKPD
											
											);
						mysql_query(VulnWalkerInsert('pelaksanaan',$dataProgram));
					}
					
					
					//sd
					
					
					$cekPelaksanaan = mysql_num_rows(mysql_query("select * from pelaksanaan where id_rkpd = '$idRKPD' and e='$cmbUnitForm' and e1='$cmbSubUnitForm' and p='$p' and q='$cmbKegiatan' "));				 
					if($cekPelaksanaan > 0){
						$err = "Kegiatan dan Sub Unit sudah di inputkan";
					}else{
						$dataPelaksanaan = array( 
											  "e" => $cmbUnitForm,
											  "e1" => $cmbSubUnitForm,
											  "p" => $p,
											  "q" => $cmbKegiatan,
											  "lokasi_kegiatan" => $lokasiKegiatan,
											  "jenis_kegiatan" =>$cmbKegiatan,
											  "plus" => $plus,
											  "min" => $minus,
											  'tahun_jamak' => $tahunJamak,
											  'tanggal_mulai' => $tanggalMulai,
											  'tanggal_selesai' => $tanggalSelesai,
											  'pagu_indikatif_murni' => $paguIndikatif,
											  'pagu_indikatif_perubahan' => $paguIndikatifPerubahan,
											  'sumber_dana' => $cmbSumberDana,
											  'capaian_program_tk' => $CPTK,
											  'capaian_program_tuk' => $CPTU,
											  'masuk_tk' => $MTK,
											  'masuk_tuk' =>$MTU,
											  'keluaran_tk' => $KTK,
											  'keluaran_tuk' =>$KTU,
											  'hasil_tk' => $HTK,
											  'hasil_tuk' =>$HTU,
											  'kelompok_sasaran_kegiatan' => $sasaranKegiatan,
											  'id_rkpd' => $idRKPD
											);				 
						mysql_query(VulnWalkerInsert("pelaksanaan",$dataPelaksanaan));
					}		
									 
					
					
					
					
					$content .= VulnWalkerInsert("rkpd",$dataRKPD);
					$content .= VulnWalkerInsert("plafon",$dataPlafon);
					$content .= VulnWalkerInsert("pelaksanaan",$dataPelaksanaan);
					
				}
			}else{						
				if($err==''){


					}
			} 
					
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
			$fm = $this->setFormEdit();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'lihatRKPD':{				
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
	   case 'BidangAfter':{
				$fmBidang = $_REQUEST['fmBidang'];
				$fmKELOMPOK = cekPOST('fmKELOMPOK2');
				$fmSUBKELOMPOK = cekPOST('fmSUBKELOMPOK2');
				$fmSUBSUBKELOMPOK = cekPOST('fmSUBSUBKELOMPOK2');
				$content->kelompok = cmbQuery1("fmKELOMPOK2",$fmKELOMPOK,"select g,nm_barang from ref_barang where f='$fmBidang' and g !='00' and h = '00' and i='00' and j='$Main->KODEBARANGJ'","onChange=\"$this->Prefix.KelompokAfter()\"",'Pilih','');
				$content->subkelompok = cmbQuery1("fmSUBKELOMPOK2",$fmSUBKELOMPOK,"select h,nm_barang from ref_barang where f='$fmBIDANG' and g ='$fmKELOMPOK' and h != '00' and i='00' and j='$Main->KODEBARANGJ'","",'Pilih','');
				$content->subsubkelompok = cmbQuery1("fmSUBSUBKELOMPOK2",$fmSUBSUBKELOMPOK,"select i,nm_barang from ref_barang where f='$fmBIDANG' and g ='$fmKELOMPOK' and h = '$fmSUBKELOMPOK' and i!='00' and j='$Main->KODEBARANGJ'","",'Pilih','');
			break;
		}

	case 'BidangAfterForm':{
			 $kondisiBidang = "";
			 $selectedUrusan = $_REQUEST['fmSKPDUrusan'];
			 $selectedBidang = $_REQUEST['fmSKPDBidang'];
			 $selectedskpd = $_REQUEST['fmSKPDskpd'];
			 $selectedUnit = $_REQUEST['fmSKPDUnit'];
			 $selectedSubUnit = $_REQUEST['fmSKPDSubUnit'];
			 
			 $codeAndNameUrusan = "select c1, concat(c1, '. ', nm_skpd) as vnama from ref_skpd where d='00' and c ='00' order by c1";
		
		     $codeAndNameBidang = "SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd where d = '00' and e = '00' and c!='00'and c1 = '$selectedUrusan'  and e1='000'";	
		
		     $codeAndNameskpd = "SELECT d, concat(d, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1='$selectedUrusan' and d != '00' and  e = '00' and e1='000' ";
			 
			 $codeAndNameUnit = "SELECT e, concat(e, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1='$selectedUrusan' and d = '$selectedskpd' and  e != '00' and e1='000' ";
			
			 $codeAndNameSubUnit = "SELECT e1, concat(e1, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1='$selectedUrusan' and d = '$selectedskpd' and  e = '$selectedUnit' and e1!='000' ";
			
				$bidang =  cmbQuery('cmbBidangForm', $selectedBidang, $codeAndNameBidang,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Bidang --');	
				$skpd = cmbQuery('cmbSKPDForm', $selectedskpd, $codeAndNameskpd,''.$cmbRo.'onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih SKPD --');
				$Unit = cmbQuery('cmbUnitForm', $selectedUnit, $codeAndNameUnit,''.$cmbRo.'onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Unit --');
				$SubUnit = cmbQuery('cmbSubUnitForm', $selectedSubUnit, $codeAndNameSubUnit,''.$cmbRo.'onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Sub Unit --');
				$content = array('bidang' => $bidang, 'skpd' =>$skpd, 'unit' =>$Unit , 'subunit' =>$SubUnit ,'queryGetBidang' => $kondisiBidang);
			break;
			}
				
			case 'SKPDAfter':{
				$fmSKPDUnit = cekPOST('fmSKPDUnit');
				$fmSKPDBidang = cekPOST('fmSKPDBidang');
				$fmSKPDskpd = cekPOST('fmSKPDskpd');
			break;
		    }
			
			case 'inputLagi':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				
				$getMaxID = mysql_fetch_array(mysql_query("select max(id) as maxID from rkpd"));
				$idRKPD = $getMaxID['maxID'];
				$getSisa = mysql_fetch_array(mysql_query("select sum(pagu_indikatif_murni) as jumlahPagu, sum(plus) as jumlahPlus , sum(min) as jumlahMin from pelaksanaan where id_rkpd = '$idRKPD' "));
	 			$sisaDariDB = $getSisa['jumlahPagu'] + $getSisa['jumlahPlus'] + $getSisa['jumlahMin']  ;
				
				
				//combobox 3 biji
				$selectedUrusan = $c1;
				$selectedBidang = $c;
				$selectedskpd = $d;
				
				$codeAndNameUrusan = "select c1, concat(c1, '. ', nm_skpd) as vnama from ref_skpd where d='00' and c ='00' and c1='$c1'";
				$codeAndNameBidang = "SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd where d = '00' and e = '00' and c='$c' and c1 = '$selectedUrusan'  and e1='000'";
					
				$codeAndNameskpd = "SELECT d, concat(d, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1='$selectedUrusan' and d = '$d' and  e = '00' and e1='000' ";
				
				$urusan =  cmbQuery('cmbUrusanForm', $selectedUrusan, $codeAndNameUrusan,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Urusan --');	
				
				$bidang =  cmbQuery('cmbBidangForm', $selectedBidang, $codeAndNameBidang,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Bidang --');	
				$skpd = cmbQuery('cmbSKPDForm', $selectedskpd, $codeAndNameskpd,''.$cmbRo.'onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih SKPD --');
				
				
				//
				
				$content = array('sisaBuatKurang' => $sisaDariDB, 'urusan' => $urusan , 'bidang' => $bidang, 'skpd' => $skpd  );
			break;
		    }
	   	
			case 'jenisChanged':{
				$jenisKegiatan = $_REQUEST['jenisKegiatan'];
				if($jenisKegiatan == 'baru'){
					$plus = "<input type='text' name ='plus' id ='plus'  readonly> ";
					$minus = "<input type='text' name ='minus' id ='minus' readonly> ";
				}else{
					$plus = "<input type='text' name ='plus' id ='plus' style='width:200px; text-align:right;'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='document.getElementById(`keyPP`).textContent = `Rp. ` + popupProgram.formatCurrency(this.value);' > ";
					$minus = "<input type='text' name ='minus' id ='minus' style='width:200px; text-align:right;'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='document.getElementById(`keyMM`).textContent = `Rp. ` + popupProgram.formatCurrency(this.value);'> ";
				}
				$content = array('plus' => $plus, 'minus' => $minus);
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
			"<script src='js/skpd.js' type='text/javascript'></script>
			<script type='text/javascript' src='js/perencanaan/rkpd.js' language='JavaScript' ></script>
			<script type='text/javascript' src='js/perencanaan/popupProgram.js' language='JavaScript' ></script>
			<script type='text/javascript' src='js/master/ref_template/VulnWalkerFrameWork.js' language='JavaScript' ></script>
			<script type='text/javascript' src='js/master/ref_template/jquery.js' language='JavaScript' ></script>
			<script type='text/javascript' src='js/master/ref_template/jquery-ui.min.js' language='JavaScript'></script>
			<link rel='stylesheet' type='text/css' href='js/master/ref_template/jquery-ui.css'>
			<script type='text/javascript' src='js/master/refstandarharga/refbarang.js' language='JavaScript' ></script>".
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
		$kode = explode('.',$this->form_idplh);
		$this->form_fmST = 1;				

		if($cnt['cnt'] > 0) $err = "rkpd Tidak Bisa Diubah ! Sudah Digunakan Di Ref Barang.";
		if($err == ''){
			$aqry = "SELECT * FROM  view_rkpd WHERE urut='".$this->form_idplh."' "; $cek.=$aqry;
			$dt = mysql_fetch_array(mysql_query($aqry));
			$fm = $this->setForm($dt);
		}
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}	
		
	function setForm($dt){	
	 global $SensusTmp;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	s 	
	 $form_name = $this->Prefix.'_form';
	 
				
	 $this->form_width = 600;
	 $this->form_height = 400;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		
	 $selectedUrusan = $_REQUEST['fmSKPDUrusan'];
	 $selectedBidang = $_REQUEST['fmSKPDBidang'];
     $selectedskpd = $_REQUEST['fmSKPDskpd'];
	 $dt['tahun'] =$_COOKIE['coThnAnggaran'];
	 $idRKPD = $_REQUEST['idRKPD'];
	 $getSisa = mysql_fetch_array(mysql_query("select sum(pagu_indikatif_murni) as jumlahPagu, sum(plus) as jumlahPlus , sum(min) as jumlahMin from pelaksanaan where id_rkpd = '$idRKPD' "));
	 $sisaDariDB = $getSisa['jumlahPagu'] + $getSisa['jumlahPlus'] + $getSisa['jumlahMin']  ;
	 if(date("m") < 10){
	 	$dt['transaksi'] = "RKPD-MURNI";
	 }else{
	 	$dt['transaksi'] = "RKPD-PERUBAHAN";
	 }

		$cmbRo = '';
	  }else{
		$this->form_caption = 'Edit';	
		$kode = $dt['kode'];				
		$namarkpd = $dt['nama_program_kegiatan'];
		$dt['urusan'] = $dt['c1'];	
		$dt['bidang'] = $dt['c'];	
		$dt['skpd'] = $dt['d'];
		$cmbRo = 'disabled';	
		$selectedUrusan = $dt['c1'];
		$selectedBidang = $dt['c'];
     	$selectedskpd =  $dt['d'];
		$selectedProgram = $dt['p'];
		$selectedKegiatan = $dt['q'];
		$getNamaProgram = mysql_fetch_array(mysql_query("select nama_program_kegiatan from ref_programkegiatan where p ='$selectedProgram' and q='00'"));
		$program = $getNamaProgram['nama_program_kegiatan'];
		
		$plafon = $dt['anggaran_murni'];


	  }
	    //ambil data trefditeruskan
	 
     $kondisiBidang = "";
	 $codeAndNameKegiatan = "select q, concat(q, '. ', nama_program_kegiatan) as vnama from ref_programkegiatan where p='$selectedProgram' and q!='00'";
	 $codeAndNameUrusan = "select c1, concat(c1, '. ', nm_skpd) as vnama from ref_skpd where d='00' and c ='00' order by c1";

	
     $codeAndNameBidang = "SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd where d = '00' and e = '00' and c!='00' and c1 = '$selectedUrusan'  and e1='000'";	

     $codeAndNameskpd = "SELECT d, concat(d, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1 = '$selectedUrusan'  and d != '00' and  e = '00' and e1='000' ";
     $cek .= $codeAndNameskpd;
	 
	 $codeAndNameUnit = "SELECT e, concat(e, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1 = '$selectedUrusan'  and d = '$selectedskpd' and  e != '00' and e1='000' ";
     $cek .= $codeAndNameUnit;
	 
	 $codeAndNameSubUnit = "SELECT e1, concat(e1, '. ', nm_skpd) as vnama FROM ref_skpd  where c='$selectedBidang' and c1 = '$selectedUrusan'  and d = '$selectedskpd' and  e = '$selectedUnit' and e1 !='000' ";
     $cek .= $codeAndNameUnit;

$comboBoxUrusanForm = cmbQuery('cmbUrusanForm', $selectedUrusan, $codeAndNameUrusan,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Urusan --');
		
$comboBoxBidangForm =  cmbQuery('cmbBidangForm', $selectedBidang, $codeAndNameBidang,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Bidang --');

$comboBoxSKPD =  cmbQuery('cmbSKPDForm', $selectedskpd, $codeAndNameskpd,''.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih SKPD --');     

$comboBoxUnit =  cmbQuery('cmbUnitForm', $selectedUnit, $codeAndNameUnit,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Unit --'); 

$comboBoxSubUnit =  cmbQuery('cmbSubUnitForm', $selectedSubUnit, $codeAndNameSubUnit,' '.$cmbRo.' onChange=\''.$this->Prefix.'.BidangAfterform()\'','-- Pilih Sub Unit --');          
	
$arrayComboJenisKegiatan = array(
			//array('selectAll','Semua'),	
			array('baru','BARU'),		
			array('lanjutan','LANJUTAN')			
			);
$comboBoxKegiatan = cmbQuery('cmbKegiatan', $selectedKegiatan, $codeAndNameKegiatan,' '.$cmbRo.'','-- KEGIATAN --');  
			
$comboBoxJenisKegiatan = cmbArray('jenisKegiatan',$jenisKegiatan,$arrayComboJenisKegiatan,'-- JENIS KEGIATAN --','onchange = rkpd.jenisChanged();');			

$codeAndNameSumberDana = "select nama, nama from ref_sumber_dana";
$comboBoxSumberDana = cmbQuery('cmbSumberDana', $selectedSumberDana, $codeAndNameSumberDana,' '.$cmbRo.'','-- SUMBER DANA --');    

$mulai = "<input type ='text' id='tanggalMulai' name='tanggalMulai'> ";
$selesai = "<input type ='text' id='tanggalSelesai' name='tanggalSelesai'> ";
$tahunJamak = "<input type='checkbox' name='tahunJamak' id='tahunJamak'> TAHUN JAMAK";
$waktuPelaksanaan = $mulai."&nbsp&nbsp s/d &nbsp&nbsp ".$selesai." &nbsp&nbsp ".$tahunJamak;
	
	 //items ----------------------
	  $this->form_fields = array(
	  	    'kode0' => array(
	  					'label'=>'URUSAN',
						'labelWidth'=>150, 
						'value'=> $comboBoxUrusanForm
						 ),
	  		'kode1' => array(
	  					'label'=>'BIDANG',
						'labelWidth'=>150, 
						'value'=> $comboBoxBidangForm
						 ),
			'kode2' => array( 
						'label'=>'SKPD',
						'labelWidth'=>150, 
						'value'=>$comboBoxSKPD
						 ),
			'1' => array( 
						'value'=> "<div style='margin-top: 20px;'></div>"
						 ),
			'tahunAnggaran' => array( 
						'label'=>'TAHUN ANGGARAN',
						'labelWidth'=>250, 
						'value'=>$dt['tahun'], 
						'type'=>'text',
						'param'=>"style='width:60px;' readonly"
						 ),	
						 
			'transaksi' => array( 
						'label'=>'TRANSAKSI',
						'labelWidth'=>250, 
						'value'=>$dt['transaksi'], 
						'type'=>'text',
						'param'=>"style='width:400px;' readOnly"
						 ),
			'2' => array( 
						'label'=>'PLAFON ANGGARAN SKPD',
						'labelWidth'=>250, 
						'value'=>"<input type='text' name='plafon' id='plafon' value='$plafon' onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='document.getElementById(`keyPlafon`).textContent = `Rp. ` + popupBarang.formatCurrency(this.value);'></div> <span>  PERUBAHAN</span>  : <input type='text' id='plafonPerubahan' name='plafonPerubahan' readonly>  <strong id='keyPlafon' style='color:red; width: 200px;'>Rp.</strong> ", 
						 ),
			'3' => array( 
						'label'=>'SISA PLAFON ANGGARAN SKPD',
						'labelWidth'=>250, 
						'value'=>"<input type='text' id='sisaPlafon' name='sisaPlafon' readonly>  <span>PERUBAHAN</span>  : <input type='text' id='sisaPlafonPerubahan' name='sisaPlafonPerubahan' readonly> ", 
						 ),
			'4' => array( 
								'label'=>'PROGRAM',
								'labelWidth'=>250, 
								'value'=>"<input type='hidden' name='p' id='p'><input type='text' name='program' value='".$program."' size='73px' id='program' readonly>&nbsp
										  <input type='button' value='Cari' id='findProgram' onclick ='".$this->Prefix.".CariProgramKegiatan()'  title='Cari Program dan Kegiatan' >" 
									 ),
			'q' => array( 
						'label'=>'KEGIATAN',
						'labelWidth'=>150, 
						'value'=>$comboBoxKegiatan				
						 ),	
			'5' => array( 'label' => "UNIT KERJA PELAKSANA",
						  'value' => "<div style='margin-top: 20px;'></div>"
						 ),
					 
			'kode3' => array( 
						'label'=>'&nbsp&nbspUNIT',
						'labelWidth'=>150, 
						'value'=>$comboBoxUnit						
						 ),
			'kode4' => array( 
						'label'=>'&nbsp&nbspSUB UNIT',
						'labelWidth'=>150, 
						'value'=>$comboBoxSubUnit						
						 ),			 
			'lokasiKegiatan' => array( 
						'label'=>'LOKASI KEGIATAN',
						'labelWidth'=>250, 
						'value'=> '', 
						'type'=>'text',
						'param'=>"style='width:400px;'"
						 ),		
			'6' => array( 
						'label'=>'JENIS KEGIATAN',
						'labelWidth'=>150, 
						'value'=>$comboBoxJenisKegiatan					
						 ),	
			'7' => array( 
						'label'=>'WAKTU PELAKSANAAN',
						'labelWidth'=>150, 
						'value'=>$waktuPelaksanaan				
						 ),		
			'8' => array( 
						'label'=>'PAGU INDIKATIF',
						'labelWidth'=>250, 
						'value'=>"<input type='text' name='paguIndikatif' id='paguIndikatif'  onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='document.getElementById(`keyPagu`).textContent = `Rp. ` + popupProgram.formatCurrency(this.value);'>  <span>PERUBAHAN</span>  : <input type='text' id='paguIndikatifPerubahan' name='paguIndikatifPerubahan' readonly> <strong id='keyPagu' style='color:red; width: 200px;'>Rp.</strong> <input type='hidden' name='sisaPlafonDariDB' id='sisaPlafonDariDB' value='$sisaDariDB' > ", 
						 ),
			'pp' => array( 
						'label'=>'JUMLAH TAHUN N+1',
						'labelWidth'=>250, 
						'value'=> "<span id='tempatPlus'> <input type='text'  readonly></div> <strong id='keyPP' style='color:red; width: 200px;'>Rp.</span> ", 
						 ),
			'mm' => array( 
						'label'=>'JUMLAH TAHUN N-1',
						'labelWidth'=>250, 
						'value'=> "<span id='tempatMinus'><input type='text' readonly></div> <strong id='keyMM' style='color:red; width: 200px;'>Rp.</span> ", 
						 ),
			'9' => array( 
						'label'=>'SUMBER DANA',
						'labelWidth'=>150, 
						'value'=>$comboBoxSumberDana."<tr> 
	
						<table border='1' style='width:70%;'>
							<tr bgcolor='gray'>
								<th>INDIKATOR</th>
								<th>TOLAK UKUR KINERJA</th>
								<th>TARGET KINERJA</th>	
							</tr>
							<tr >
								<td>CAPAIAN PROGRAM</td>
								<td><textarea name='CPTU' id='CPTU' style='width:100%; '></textarea></td>
								<td><textarea name='CPTK' id='CPTK' style='width:100%; '></textarea></td>
							</tr>
							<tr >
								<td>MASUKAN</td>
								<td><textarea name='MTU' id='MTU' style='width:100%; '></textarea></td>
								<td><textarea name='MTK' id='MTK' style='width:100%;'></textarea></td>
							</tr>
							<tr >
								<td>KELUARAN</td>
								<td><textarea name='KTU' id='KTU' style='width:100%; '></textarea></td>
								<td><textarea name='KTK' id='KTK' style='width:100%;'></textarea></td>
							</tr>
							<tr >
								<td>HASIL</td>
								<td><textarea name='HTU' id='HTU' style='width:100%;'></textarea></td>
								<td><textarea name='HTK' id='HTK' style='width:100%;'></textarea></td>
							</tr>
						</table>
		
						</tr>
						
						<table style='width:100%;'>
						<tr>
						<td style='width:250;'>KELOMPOK SASARAN KEGIATAN </td>
						<td style='width:10;'>:</td>	
						<td><input type='text' name='sasaranKegiatan' id='sasaranKegiatan' placeholder='KELOMPOK SASARAN KEGIATAN
' style='width:230px;'></td>	
						</tr>
						<tr>
						</tr>
						</table>
						<div style='padding: 8;height:22; border-top: 2px solid #ddd;'>
			<div style='float:right;'>
				<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan()' title='Simpan'> &nbsp; <input type='button' value='Batal' onclick ='".$this->Prefix.".Close()'><input type='hidden' id='template_idplh' name='template_idplh' value=''>
					<input type='hidden' id='template_fmST' name='template_fmST' value='0'>
			</div>
			</div>
						"				
						 )
				 
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan()' title='Simpan' >  &nbsp  ".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm2();		
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

		
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox	
  	   <th class='th01' width='100'>KODE</th>	
	   <th class='th01' width='900'>NAMA URUSAN PEMERINTAHAN, ORGANISASI, PROGRAM DAN KEGIATAN</th>	
	   <th class='th01' width='200'>UNIT KERJA PELAKSANA</th>	
	   <th class='th01' width='100'>SASARAN</th>	
	   <th class='th01' width='100'>TARGET KINERJA</th>	
	   <th class='th01' width='100'>SUMBER DANA</th>	
	   <th class='th01' width='100'>PAGU ANGGARAN (Rp)</th>
	   <th class='th01' width='100'>PAGU ANGGARAN (Rp) SETELAH PERUBAHAN</th>
	   <th class='th01' width='100'>BERTAMBAH/(BERKURANG)</th>		
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	  
	 $arrayKode = explode(".",$isi['urut']); 
	 if($arrayKode[1] == '00'){
	 	$kode = $arrayKode[0];
		$getUrusan = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c1='$kode' and c='00' and d='00' and e='00' and e1='000'"));
		$urusan =$getUrusan['nm_skpd'];
		$deskripsi = "<span style='font-weight:bold; margin-left:0px'> $urusan </span>";
		$unitKerjaPelaksana = "";
	 }elseif($arrayKode[2] == '00'){
	 	$kode = $arrayKode[0].".".$arrayKode[1];
		$getBidang = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c1='$arrayKode[0]' and c='$arrayKode[1]' and d='00' and e='00' and e1='000'"));
		$bidang =$getBidang['nm_skpd'];
		$deskripsi = "<span style='font-weight:bold; margin-left:5px'> $bidang </span>";
		$unitKerjaPelaksana = "";
	 }elseif($arrayKode[3] == '00'){
	 	$kode = $arrayKode[0].".".$arrayKode[1].".".$arrayKode[2];
		$getSKPD = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c1='$arrayKode[0]' and c='$arrayKode[1]' and d='$arrayKode[2]' and e='00' and e1='000'"));
		$SKPD =$getSKPD['nm_skpd'];
		$deskripsi = "<span style='font-weight:bold; margin-left:10px'> $SKPD </span>";
		$unitKerjaPelaksana = "";
	 }elseif($arrayKode[4] == '00'){
	 	$kode = $arrayKode[0].".".$arrayKode[1].".".$arrayKode[2].".".$arrayKode[3];
		$p= $isi['p'];
		$getProgram = mysql_fetch_array(mysql_query("select nama_program_kegiatan from ref_programkegiatan where p='$p' and q ='00'"));
		$Program = $getProgram['nama_program_kegiatan'];
		$deskripsi = "<span style='font-weight:bold; margin-left:15px'> $Program </span>";
		$unitKerjaPelaksana = "";
	 }else{
	 	$kode = $isi['urut'];
		$p= $isi['p'];
		$q= $isi['q'];
		$getProgram = mysql_fetch_array(mysql_query("select nama_program_kegiatan from ref_programkegiatan where p='$p' and q ='$q'"));
		$Program = $getProgram['nama_program_kegiatan'];
		
		$kodeRKPD = $kode;
		$deskripsi = "<span style='font-weight:bold; margin-left:20px'> <a style='cursor:pointer;' onclick=rkpd.detailRKPD('$kodeRKPD');> $Program </a> </span>";
		$e= $isi['e'];
		$e1= $isi['e1'];
		$getSKPD = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c1='$arrayKode[0]' and c='$arrayKode[1]' and d='$arrayKode[2]' and e='$e' and e1='$e1'"));
		$unitKerjaPelaksana = $getSKPD['nm_skpd'];
	 }
	  
	 $Koloms[] = array('align="left"',$kode); 
	 $Koloms[] = array('align="left"',$deskripsi); 
	 $Koloms[] = array('align="left"',$unitKerjaPelaksana); 
	 $Koloms[] = array('align="left"',$isi['sasaran']);
	 $Koloms[] = array('align="left"',$isi['capaian_program_tk']);
	 $Koloms[] = array('align="left"',$isi['sumber_dana']);
	 $Koloms[] = array('align="right"',number_format($isi['anggaran_murni'],2,',','.')); 
	 $Koloms[] = array('align="right"',number_format($isi['anggaran_perubahan'],2,',','.')); 
	 
	 if($isi['anggaran_murni'] > $isi['anggaran_perubahan']){
	 	$sisa = "+ ".number_format(($isi['anggaran_murni'] - $isi['anggaran_perubahan']),2,',','.');
		/*$sisa = "situ";*/
	 }else{
	 	$sisa = "- ".number_format(($isi['anggaran_perubahan'] - $isi['anggaran_murni']),2,',','.');
		/*$sisa = "sini";*/
	 }
	 
	 $Koloms[] = array('align="right"',$sisa); 

	
	
	 /*$c1 = $isi['c1'];
	 $c = $isi['c'];
	 $d = $isi['d'];
	 $get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c1='$c1' and c ='$c' and d='$d' ")) ;       
	 $Koloms[] = array('align="left"',$get['nm_skpd']);*/
	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd, $fmSKPDUrusan;
	 $fmSKPDBidang = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST('fmSKPDBidang');
	 $fmSKPDskpd = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST('fmSKPDskpd');
	$fmTahun=  cekPOST('fmTahun')==''?$_COOKIE['coThnAnggaran']:cekPOST('fmTahun');
	$fmBIDANG = cekPOST('fmBIDANG');


	 $arr = array(
			//array('selectAll','Semua'),	
			array('nama_rkpd','NAMA rkpd'),		
			array('alamat','ALAMAT'),	
			array('kota','KOTA / KABUPATEN'),
			array('nama_pimpinan','NAMA PIMPINAN'),
			array('no_npwp','NO. NPWP'),			
			);
		
	 //data order ------------------------------
	 $arrOrder = array(
			     	array('1','NAMA rkpd'),		
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
	$fmORDER1 = cekPOST('fmORDER1');
	$fmDESC1 = cekPOST('fmDESC1');
	$baris = $_REQUEST['baris'];
	if ($baris == ''){
		$baris = "25";		
	}
	$TampilOpt = 
	"<div class='FilterBar' style='margin-top:10px;'><table style='width:100%'>".
			CmbUrusanBidangSkpd('rkpd').
"</table></div>"."<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td style='width:250px;' ><input style='width:200px;' type='text' value='".$fmPILCARIvalue."' name='fmPILCARIvalue' id='fmPILCARIvalue' placeholder='NAMA PROGRAM'>  &nbsp <input type='button' id='btTampil' value='Cari' onclick='".$this->Prefix.".refreshList(true)'></td> <td><input type='checkbox' id='perubahan' name='perubahan'> Perubahan </td>
			 </tr>
			</table>".
			"</div>"."<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td style='width:200px;' >Jumlah Data : <input type='text' name='baris' value='$baris' id='baris' style='width:30px;'>  </td><td align='left' ><input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'></td>
			 </tr>
			</table>".
			"</div>";
			
		return array('TampilOpt'=>$TampilOpt);
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

		$kueBidang = $_COOKIE['cofmSKPD'];
		$kueSKPD =  $_COOKIE['cofmUNIT'];
		$ref_skpdSkpdfmUrusan = $_REQUEST['fmSKPDUrusan'];
		$ref_skpdSkpdfmSKPD = $_REQUEST['fmSKPDBidang'];
		$ref_skpdSkpdfmUNIT = $_REQUEST['fmSKPDskpd'];
		$fmLimit = $_REQUEST['baris'];
		$this->pagePerHal=$fmLimit;

		//Cari 
		switch($fmPILCARI){			
			case 'nama_rkpd': $arrKondisi[] = " nama_rkpd like '%$fmPILCARIvalue%'"; break;						 
			case 'alamat': $arrKondisi[] = " alamat like '%$fmPILCARIvalue%'"; break;	
			case 'kota': $arrKondisi[] = " kota like '%$fmPILCARIvalue%'"; break;	
			case 'nama_pimpinan': $arrKondisi[] = " nama_pimpinan like '%$fmPILCARIvalue%'"; break;	
			case 'no_npwp': $arrKondisi[] = " no_npwp like '%$fmPILCARIvalue%'"; break;
			case 'SKPD': $arrKondisi[] = " c like '%$fmPILCARIvalue%' or d like '%$fmPILCARIvalue%' "; break;				
		}
		

		if($kueBidang!='00' and $kueBidang!='')$arrKondisi[]= "c='$kueBidang'";
		if($kueSKPD!='00' and $kueSKPD!='')$arrKondisi[]= "d='$kueSKPD'";


		if($ref_skpdSkpdfmUrusan!='0' and $ref_skpdSkpdfmUrusan !='' and $ref_skpdSkpdfmUrusan!='00' ){
			$arrKondisi[]= "c1='$ref_skpdSkpdfmUrusan'";
		if($ref_skpdSkpdfmSKPD!='00' and $ref_skpdSkpdfmSKPD !=''  )$arrKondisi[]= "c='$ref_skpdSkpdfmSKPD'";

		if($ref_skpdSkpdfmSKPD!='00'){

		if($ref_skpdSkpdfmUNIT!='00' and $ref_skpdSkpdfmUNIT !='' )$arrKondisi[]= "d='$ref_skpdSkpdfmUNIT'";
		}
		}
		$tahunAnggaran = $_COOKIE['coThnAnggaran'];
		$arrKondisi[]= "tahun= $tahunAnggaran";

		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		switch($fmORDER1){
			case '1': $arrOrders[] = " nama_rkpd $Asc1 " ;break;
			case '2': $arrOrders[] = " alamat $Asc1 " ;break;
			case '3': $arrOrders[] = " kota $Asc1 " ;break;
			case '4': $arrOrders[] = " nama_pimpinan $Asc1 " ;break;
			case '5': $arrOrders[] = " no_npwp $Asc1 " ;break;
			case '6': $arrOrders[] = " c $Asc1 " ;break;
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
	
	


	function Hapus($ids){ //validasi hapus ref_kota
		 $err=''; $cek='';
		for($i = 0; $i<count($ids); $i++)	{
		
			$a = "SELECT count(*) as cnt, aa.rkpd_terbesar, aa.rkpd_terkecil, bb.nama, aa.f, aa.g, aa.h, aa.i, aa.j FROM ref_barang aa INNER JOIN ref_rkpd bb ON aa.rkpd_terbesar = bb.nama OR aa.rkpd_terkecil = bb.nama WHERE bb.nama='".$ids[$i]."' "; $cek .= $a;
		$aq = mysql_query($a);
		$cnt = mysql_fetch_array($aq);
		
		if($cnt['cnt'] > 0) $err = "rkpd ".$ids[$i]." Tidak Bisa DiHapus ! Sudah Digunakan Di Ref Barang.";
		
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
$rkpd = new rkpdObj();
?>