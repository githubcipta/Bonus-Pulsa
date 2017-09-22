<?php

class popupProgramObj  extends DaftarObj2{	
	var $Prefix = 'popupProgram';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_programkegiatan'; //bonus
	var $TblName_Hapus = 'ref_programkegiatan';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('p','q');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = '';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='popupProgram.xls';
	var $namaModulCetak='DAFTAR PROGRAM DAN KEGIATAN';
	var $Cetak_Judul = 'DAFTAR PROGRAM DAN KEGIATAN';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'popupProgramForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	
	function setTitle(){
		return '';
	}
	
	function setMenuEdit(){
		return
			"";
	}
	function setMenuView(){
		return "";
	}
	function setTopBar(){
		return "";
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
		case 'windowshow':{
				$fm = $this->windowShow();
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];	
			break;
		}
		
		case 'numberFormat':{
				$angka = $_REQUEST['angka'];
				
				$content = array("hasil" => number_format($angka,0,",","."));
			break;
	   }
	    case 'getdata':{
				$Id = $_REQUEST['id'];
					    	
				$get = mysql_fetch_array( mysql_query("select * from ref_programkegiatan where concat(p,'.',q)='$Id'"));
				$selectedP  = $get['p'];
				$refDataNamaKegiatan= "SELECT q, nama_program_kegiatan  FROM ref_programkegiatan where p = '$selectedP' and q <> '00'";
				$content = array('p' => $get['p'], 'q' => $get['q'], 'nama_program_kegiatan' => $get['nama_program_kegiatan'], 'cmbLucknut' => cmbQuery('cmbKegiatan', $get['q'], $refDataNamaKegiatan,'','-- Pilih Kegiatan --') );
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
			"<script type='text/javascript' src='js/perencanaan/popupProgram.js' language='JavaScript' ></script>".
			$scriptload;
	}
	
	//form ==================================
	
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox	
  	   <th class='th01' width='60'>KODE</th>	
	   <th class='th01' width='900'>NAMA PROGRAM</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	function windowShow(){		
		$cek = ''; $err=''; $content=''; 
		$json = TRUE;	//$ErrMsg = 'tes';		
		$form_name = $this->FormName;
		
		
		
			$FormContent = $this->genDaftarInitial();
			$form = centerPage(
					"<form name='$form_name' id='$form_name' method='post' action=''>".
					createDialog(
						$form_name.'_div', 
						$FormContent,
						1200,
						500,
						'Pilih Program',
						'',
						"<input type='button' value='Batal' onclick ='".$this->Prefix.".windowClose()' >".
						"<input type='hidden' id='".$this->Prefix."_idplh' name='".$this->Prefix."_idplh' value='$this->form_idplh' >".
						"<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >".
						"<input type='hidden' id='sesi' name='sesi' value='$sesi' >"
						,//$this->setForm_menubawah_content(),
						$this->form_menu_bawah_height
					).
					"</form>"
			);
			$content = $form;//$content = 'content';	
		
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 $Koloms[] = array('align="center"',$isi['p']. ".".$isi['q'] ); 
	 $kodeProgram = $isi['p'].".".$isi['q'];
	 $Koloms[] = array('align="left" ',"<a style='cursor:pointer;' onclick = popupProgram.windowSave('$kodeProgram')>".$isi['nama_program_kegiatan']."</a>");
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	 global $Ref, $Main;
	 
	 $arr = array(
			//array('selectAll','Semua'),	
			array('program','PROGRAM')
			);

					
	 
	$fmPILCARI ='program';	
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];	
	$cmbProgram = $_REQUEST['cmbProgram'];	
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
			"<div class='FilterBar' >".	
			"<table style='width:100%'>
			<tr>
			<td> <input type='text' value='".$fmPILCARIvalue."' name='fmPILCARIvalue' id='fmPILCARIvalue' placeholder='NAMA PROGRAM'>
					<input type='button' id='btTampil' value='Cari' onclick='".$this->Prefix.".refreshList(true)'> </td>
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
		
		$fmPILCARI = 'program';	
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
		//cari tgl,bln,thn
		$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];			
		$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
		$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
		$cmbProgram = $_REQUEST['cmbProgram'];
		$fmLimit = $_REQUEST['baris'];
		$this->pagePerHal=$fmLimit;

		//Cari 
			if(!empty($fmPILCARIvalue)){
			$get = mysql_fetch_array( mysql_query("select p from ref_programkegiatan where nama_program_kegiatan like '%$fmPILCARIvalue%' and q ='00'"));
			$selectedP  = $get['p'];
			$arrKondisi[] = " p = '$selectedP'";
			}
		 
		
		
		
			$arrKondisi[] = " q =  '00' "; 
		
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();

		$arrOrders[] = " concat(p,'.',q) $Asc1 " ;
		$Order= join(',',$arrOrders);	
		$OrderDefault = '';// Order By no_terima desc ';
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;


		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
	}
	
	function Hapus($ids){ 
		 $err=''; $cek='';
		for($i = 0; $i<count($ids); $i++)	{
		
		
			if($err=='' ){
					$get = mysql_fetch_array( mysql_query("select * from ref_programkegiatan where concat(p,' ',q)='".$ids[$i]."'"));
					$qsamadengannol  = $get['q'];
					$getP = $get['p'];
					if($qsamadengannol == '00'){
						$qy = "DELETE FROM $this->TblName_Hapus WHERE p = '$getP' ";$cek.=$qy;
						$qry = mysql_query($qy);
					}else{
						$qy = "DELETE FROM $this->TblName_Hapus WHERE concat(p,' ',q)='".$ids[$i]."' ";$cek.=$qy;
						$qry = mysql_query($qy);	
					}
			}else{
				break;
			}			
		}
		return array('err'=>$err,'cek'=>$cek);
	}
}
$popupProgram = new popupProgramObj();
?>