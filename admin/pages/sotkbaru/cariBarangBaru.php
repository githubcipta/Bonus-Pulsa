<?php

class cariBarangBaruObj  extends DaftarObj2{	
	var $Prefix = 'cariBarangBaru';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_barang_baru'; //bonus
	var $TblName_Hapus = 'ref_barang_baru';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('f1','f2','f','g','h','i','j');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = 'REFERENSI BARANG BARU';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='ref_rekening.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'REKENING';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'cariBarangBaruForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	
	var $arrMapping3 = array( 
		array('A','A'),
		array('B','B'),
		array('C','C'),
		array('D','D'),
		array('E','E'),
		array('F','F'),
		array('G','G'),
		array('H','H'),
		array('I','I'),
		array('J','J'),
		array('K','K'),
		array('L','L'),
		array('M','M'),
		array('N','N'),
		array('O','O'),
		array('P','P'),
		array('Q','Q'),
		array('R','R'),
		array('S','S'),
		array('T','T'),
		array('U','U'),
		array('V','V'),
		array('W','W'),
		array('X','X'),
		array('Y','Y'),
		array('Z','Z'),
		array('AA','AA'),
		array('AB','AB'),
		array('AC','AC'),
		array('AD','AD'),
		array('AE','AE'),
		array('AF','AF'),
		array('AG','AG'),
		array('AH','AH'),
		array('AI','AI'),
		array('AJ','AJ'),
		array('AK','AK'),
		array('AL','AL'),
		array('AM','AM'),
		array('AN','AN'),
		array('AO','AO'),
		array('AP','AP')
		);
	
	
	function setTitle(){
		return 'REFERENSI BARANG BARU';
	}
	
	function setMenuEdit(){
		return "";
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
	 $nama= $_REQUEST['nama'];
	  
	 //if( $err=='' && $nama =='' ) $err= 'Satuan Belum Di Isi !!';
	 
				
		if($err==''){
			$aqry = "UPDATE ref_satuan set nama='$nama' WHERE Id='".$idplh."'";	$cek .= $aqry;
			$qry = mysql_query($aqry) or die(mysql_error());
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

		case 'formEdit':{				
			$fm = $this->setFormEdit();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
					
		case 'windowshow':{
				$fm = $this->windowShow();
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
		
		case 'getid':{
				$cek = '';
				$err = '';
				$content = '';	
				
				$kodebarangambil = $_REQUEST['kodebarangambil'];
				//if($idrekening == '' && $err == '')$err == "Data Belum Dipilih !";
				
				if($err == ''){
					$kode = explode(".",$kodebarangambil);
					
					$htng_stringKode = strlen($kode[6]);
					$kodei = $kode[6];
					
					$qry = "SELECT * FROM ref_barang_baru WHERE concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) = '$kodebarangambil' ";$cek.=$qry;
					$aqry = mysql_query($qry);
					$daqry = mysql_fetch_array($aqry);
						
					
					if($htng_stringKode >= 3){
						if($kodei == '000' || $daqry['nm_barang'] == null){
							$err='Kode Tidak Valid !';
						}else{
							$content['kodebarang'] = $kodebarangambil;
							$content['namabarang'] = $daqry['nm_barang'];
						}
					}else{
						$content['kodebarang'] = '';
						$content['namabarang'] = '';
					}
					
					
		
				}
				
					
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
			 <script type='text/javascript' src='js/sotkbaru/cariBarangBaru.js' language='JavaScript' ></script>
			 ".
			// "<script type='text/javascript' src='js/master/ref_aset/refjurnal.js' language='JavaScript' ></script>".
			
			$scriptload;
	}
	
	//form ==================================
	   
  	function setFormEdit(){
		$cek ='';
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$f1=$kode[0];
		$f2=$kode[1];
		$f=$kode[2];
		$g=$kode[3];
		$h=$kode[4];
		$i=$kode[5];
		$j=$kode[6];
		$this->form_fmST = 1;				
		//get data 
				
		$aqry = "SELECT * FROM  ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='$j' "; $cek.=$aqry;
		$dt = mysql_fetch_array(mysql_query($aqry));
				
		if ($dt['f1'] != '0' && $dt['f2'] !='0' && $dt['f'] !='00' && $dt['g'] !='00'&& $dt['h'] =='00' && $dt['i'] =='00' && $dt['j'] =='000'){
			$fm = $this->setFormEditlvl4($dt);
		}elseif($dt['f1'] != '0' && $dt['f2'] !='0' && $dt['f'] !='00' && $dt['g'] !='00'&& $dt['h'] !='00' && $dt['i'] =='00' && $dt['j'] =='000'){
			$fm = $this->setFormEditlvl5($dt);
		}elseif ($dt['f1'] == '1' && $dt['f2'] =='3' && $dt['f'] =='01' && $dt['g'] !='00'&& $dt['h'] !='00' && $dt['i'] !='00' && $dt['j'] =='000'){
			$fm = $this->setFormEditlvl6($dt);
		}else{
			$fm = $this->setFormEditdata1($dt);
		}
				
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
			
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	$NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   <!--$Checkbox-->		
	   <th class='th01' width='200' >Kode Barang</th>
	   <th class='th01' align='center'>Nama Barang</th>
	   <th class='th01' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}		
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	
	if ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] =='01' && $isi['g'] =='01'&& $isi['h'] =='01' && $isi['i'] !='00' && $isi['j'] =='000'){// 4 level
		$TampilCheckBox = $TampilCheckBox;
	 }elseif ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] !='01' && $isi['g'] !='00' && $isi['h'] =='00' && $isi['i'] =='00' && $isi['j'] =='000'){// 4 level dengan f1=1 f2=3 f=2
		$TampilCheckBox = $TampilCheckBox;
	 }elseif ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] !='01' && $isi['g'] !='00' && $isi['h'] !='00' && $isi['i'] =='00' && $isi['j'] =='000'){// 5 level dengan f1=1 f2=3 f=2
		$TampilCheckBox = $TampilCheckBox;
	 }elseif ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] =='01' && $isi['g'] =='01'&& $isi['h'] =='01' && $isi['i'] =='01' && $isi['j'] =='000'){// 5 level
		$TampilCheckBox = $TampilCheckBox;
	 }elseif ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] =='01' && $isi['g'] !='00'&& $isi['h'] !='00' && $isi['i'] !='00' && $isi['j'] =='000'){// 6 level f1=1 f2=3 f=1
		$TampilCheckBox = $TampilCheckBox;
	 }else{		
		$TampilCheckBox = '';
	 }
	
	$kodebarang = $isi['f1'].".".$isi['f2'].".".$isi['f'].".".$isi['g'].".".$isi['h'].".".$isi['i'].".".$isi['j'];
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	 // if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 /*$Koloms[] = array('align="center"',genNumber($isi['f1'],1));
	 $Koloms[] = array('align="center"',genNumber($isi['f2'],1));
	 $Koloms[] = array('align="center"',genNumber($isi['f'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['g'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['h'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['i'],2));*/
	 $Koloms[] = array('align="center"',"<a href='javascript:".$this->Prefix.".pilBar(`".$kodebarang."`)' >".
	 	$kodebarang."</a>");
	 $Koloms[] = array('align="left"',$isi['nm_barang']);
	 $Koloms[] = array('align="left"',$isi['mapping']);
	 
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	global $Ref, $Main;
		
	$fmAKUN = cekPOST('fmAKUN');
	$fmKELOMPOK = cekPOST('fmKELOMPOK');
	$fmJENIS = cekPOST('fmJENIS');
	$fmOBJEK = cekPOST('fmOBJEK');
	$fmRINOBJEK = cekPOST('fmRINOBJEK');
	$fmSUBRINOBJEK = cekPOST('fmSUBRINOBJEK');
	$fmKODE = cekPOST('fmKODE');
	$fmBARANG = cekPOST('fmBARANG');			
	
	 $arr = array(
			//array('selectAll','Semua'),
			array('selectfg','Kode Barang'),
			array('selectbarang','Nama Barang'),	
			);
			
	//data order ------------------------------
	 $arrOrder = array(
	  	         array('1','Kode Barang'),
			     array('2','Nama Barang'),	
	 );	
				
	$TampilOpt = 
			
			"<div class='FilterBar'>".
			
			"<table style='width:100%'>
			<tr>
			<td style='width:150px'>AKUN</td><td style='width:10px'>:</td>
			<td>".
			cmbQuery1("fmAKUN",$fmAKUN,"select f1,nm_barang from ref_barang_baru where f1!='0' and f2 ='0' and f = '00' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>KELOMPOK</td><td>:</td>
			<td>".
			cmbQuery1("fmKELOMPOK",$fmKELOMPOK,"select f2,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 !='0' and f = '00' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>JENIS</td><td>:</td>
			<td>".
			cmbQuery1("fmJENIS",$fmJENIS,"select f,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f != '00' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>OBJEK</td><td>:</td>
			<td>".
			cmbQuery1("fmOBJEK",$fmOBJEK,"select g,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f = '$fmJENIS' and g!='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr><tr>
			<td>RINCIAN OBJEK</td><td>:</td>
			<td>".
			cmbQuery1("fmRINOBJEK",$fmRINOBJEK,"select h,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f = '$fmJENIS' and g='$fmOBJEK' and h!='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr><tr>
			<td>SUB RINCIAN OBJEK</td><td>:</td>
			<td>".
			cmbQuery1("fmSUBRINOBJEK",$fmSUBRINOBJEK,"select i,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f = '$fmJENIS' and g='$fmOBJEK' and h='$fmRINOBJEK' and i!='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr>
			
			</table>".
			"</div>".
			"<div class='FilterBar'>".
			"<table style='width:100%'>
			<tr><td>
				Kode Barang : <input type='text' id='fmKODE' name='fmKODE' value='".$fmKODE."' size=20px>&nbsp
				Nama Barang : <input type='text' id='fmBARANG' name='fmBARANG' value='".$fmBARANG."' size=30px>&nbsp
				<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>
			</td></tr>
			</table>".
			"</div>".
			"<input type='hidden' id='fmORDER18' name='fmORDER18' value='".$fmORDER18."'>".
			"<input type='hidden' id='fmORDER19' name='fmORDER19' value='".$fmORDER19."'>";	
			"";
		return array('TampilOpt'=>$TampilOpt);
	}	
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
		$arrKondisi = array();	
		$fmPILCARI = $_REQUEST['fmPILCARI'];	
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
	 	$fmAKUN = cekPOST('fmAKUN');
	    $fmKELOMPOK = cekPOST('fmKELOMPOK');
		$fmJENIS = cekPOST('fmJENIS');
		$fmOBJEK = cekPOST('fmOBJEK');
		$fmRINOBJEK = cekPOST('fmRINOBJEK');
		$fmSUBRINOBJEK = cekPOST('fmSUBRINOBJEK');
		$fmKODE = cekPOST('fmKODE');
		$fmBARANG = cekPOST('fmBARANG');
		$fmIDBARANGLama = $_REQUEST['fmIDBARANGLama'];
		
		$aqry = mysql_query("select * from ref_barang where concat(f,'.',g,'.',h,'.',i,'.',j) = '$fmIDBARANGLama'");
		$get = mysql_fetch_array($aqry);
		$mapping = $get['mapping'];
		
		$arrKondisi[] = " f != '0'";
		$arrKondisi[] = " g != '00'";
		$arrKondisi[] = " h != '00'";
		$arrKondisi[] = " i != '00'";
		$arrKondisi[] = " j != '000'";
		$arrKondisi[] = " mapping = '$mapping'";
		
		//Cari 
		$isivalue=explode('.',$fmPILCARIvalue);
		switch($fmPILCARI){			
			
			case 'selectKode': $arrKondisi[] = " concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) like '$fmPILCARIvalue%'"; break;
			case 'selectNama': $arrKondisi[] = " nm_barang like '%$fmPILCARIvalue%'"; break;	
										 	
		}	
				
		/*if(empty($fmAKUN)) {
			$fmKELOMPOK = '';
			$fmJENIS='';
			$fmOBJEK='';
			$fmRINOBJEK='';
			$fmSUBRINOBJEK='';
		}
		if(empty($fmKELOMPOK)) {
			$fmJENIS='';
			$fmOBJEK='';
			$fmRINOBJEK='';
			$fmSUBRINOBJEK='';
		}
		
		if(empty($fmJENIS)) {		
			$fmOBJEK='';
			$fmRINOBJEK='';
			$fmSUBRINOBJEK='';
		}
		
		if(empty($fmOBJEK)) {		
			$fmRINOBJEK='';
			$fmSUBRINOBJEK='';
		}
		
		if(empty($fmRINOBJEK)) {		
			$fmSUBRINOBJEK='';
		}*/		
		
		if($fmAKUN != '')$arrKondisi[] = " f1 = '$fmAKUN'";
		if($fmKELOMPOK != '')$arrKondisi[] = " f2 = '$fmKELOMPOK'";
		if($fmJENIS != '')$arrKondisi[] = " f = '$fmJENIS'";
		if($fmOBJEK != '')$arrKondisi[] = " g = '$fmOBJEK'";
		if($fmRINOBJEK != '')$arrKondisi[] = " h = '$fmRINOBJEK'";
		if($fmSUBRINOBJEK != '')$arrKondisi[] = " i = '$fmSUBRINOBJEK'";
		if(!empty($_POST['fmKODE'])) $arrKondisi[] = " concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) like '".$_POST['fmKODE']."%'";					
		if(!empty($_POST['fmBARANG'])) $arrKondisi[] = " nm_barang like '%".$_POST['fmBARANG']."%'";
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		switch($fmORDER1){
			case '1': $arrOrders[] = " f1,f2,f,g,h,i,j $Asc1 " ;break;
			case '2': $arrOrders[] = " nm_barang $Asc1 " ;break;
			
		}	
		$Order= join(',',$arrOrders);	
		$OrderDefault = '';// Order By no_terima desc ';
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	
		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
	}
	
	function windowShow(){		
		$cek = ''; $err=''; $content=''; 
		$json = TRUE;	//$ErrMsg = 'tes';
				
		$form_name = $this->FormName;
		$fmIDBARANGLama = $_REQUEST['kdbrg_lama'];
		//$ref_jenis=$_REQUEST['ref_jenis'];
		//if($err==''){
			$FormContent = $this->genDaftarInitial($fmIDBARANGLama);
			$form = centerPage(
					"<form name='$form_name' id='$form_name' method='post' action=''>".
					createDialog(
						$form_name.'_div', 
						$FormContent,
						900,
						500,
						'Pilih Barang',
						'',
						/*"
						<input type='button' value='Pilih' onclick ='".$this->Prefix.".windowSave()' >".*/
						"<input type='button' value='Batal' onclick ='".$this->Prefix.".windowClose()' >".
						"<input type='hidden' value='' id='idrekeningnya1' >".
						"<input type='hidden' id='CariBarang_idplh' name='".$this->Prefix."_idplh' value='$this->form_idplh' >".
						"<input type='hidden' id='CariBarang_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >".
						"<input type='hidden' id='sesi' name='sesi' value='$sesi' >"
						,//$this->setForm_menubawah_content(),
						$this->form_menu_bawah_height
					).
					"</form>"
			);
			$content = $form;//$content = 'content';	
		//}
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	function genDaftarInitial($fmIDBARANGLama=''){
		$vOpsi = $this->genDaftarOpsi();
		return			
			"<div id='{$this->Prefix}_cont_title' style='position:relative'></div>". 
			"<div id='{$this->Prefix}_cont_opsi' style='position:relative'>". 		
				"<input type='hidden' id='fmIDBARANGLama' name='fmIDBARANGLama' value='$fmIDBARANGLama'>".
				//"<input type='hidden' id='".$this->Prefix."SkpdfmSUBUNIT' name='".$this->Prefix."SkpdfmSUBUNIT' value='$fmSUBUNIT'>".
				//"<input type='hidden' id='".$this->Prefix."tahun_anggaran' name='".$this->Prefix."tahun_anggaran' value='$tahun_anggaran'>".
			"</div>".					
			"<div id=garis style='height:1;border-bottom:1px solid #E5E5E5;'></div>".
			"<div id=contain style='overflow:auto;height:$height;'>".
			//"<div id=contain style='overflow:auto;height:256;'>".
			"<div id='{$this->Prefix}_cont_daftar' style='position:relative' >".					
			"</div>
			</div>".
			"<div id='{$this->Prefix}_cont_hal' style='position:relative'>".				
				"<input type='hidden' id='".$this->Prefix."_hal' name='".$this->Prefix."_hal' value='1'>".
			"</div>";
	}
}
$cariBarangBaru = new cariBarangBaruObj();
?>