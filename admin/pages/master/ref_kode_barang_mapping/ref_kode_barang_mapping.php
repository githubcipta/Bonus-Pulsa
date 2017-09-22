<?php

class ref_kode_barang_mappingObj  extends DaftarObj2{	
	var $Prefix = 'ref_kode_barang_mapping';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'v_mapping'; //bonus
	var $TblName_Hapus = 'v_mapping';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('f_lama','g_lama','h_lama','i_lama','j_lama','f1','f2','f','g','h','i','j');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
//	var $checkbox_rowspan = 2;
	var $PageTitle = 'REFERENSI MAPPING KODE BARANG';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='ref_rekening.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = '';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'ref_kode_barang_mappingForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	var $pid='';
	
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
		return 'REFERENSI MAPPING KODE BARANG';
	}
	
	function setMenuEdit(){
		return "";		
	}
	
	function setMenuView(){
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

		 default:{
				$other = $this->set_selector_other2($tipe);
				$cek = $other['cek'];
				$err = $other['err'];
				$content=$other['content'];
				$json=$other['json'];
		 break;
		 }	 
	 }
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
			 <script type='text/javascript' src='js/master/ref_kode_barang_mapping/".strtolower($this->Prefix).".js' language='JavaScript' ></script>
			 ".
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
	/*function setKolomHeader($Mode=1, $Checkbox=''){
	$NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' rowspan=2 width='5' >No.</th>
  		
	   		<th class='th01' width='225'colspan=3>Kode Barang Lama</th>
	   		<th class='th01' width='450'colspan=3>Kode Barang Baru</th>
	   </tr>
	   <tr>
	    	<th class='th01' width='450'>Kode Barang</th>
	   		<th class='th01' width='450' align='center'>Nama Barang</th>
	   		<th class='th01' width='450' align='center'>Kode Mapping</th>
			<th class='th01' width='450'>Kode Barang</th>
	   		<th class='th01' width='450' align='center'>Nama Barang</th>
	   		<th class='th01' width='450' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}		
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Ref;
		
			$Koloms = array();
	 		$Koloms[] = array('align="center"', $no.'.' );
	// 	if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 		$Koloms[] = array('align="left" width="5"',$isi['f_lama'].'.'.$isi['g_lama'].'.'.$isi['h_lama'].'.'.$isi['i_lama'].'.'.$isi['j_lama']);
	 		$Koloms[] = array('align="left" width="350px"',"<span $margin>".$isi['nm_barang_lama']."</span>");
	 		$Koloms[] = array('align="left" width="250px"',$isi['mapping_lama']);
			$Koloms[] = array('align="left" width="50px"',$isi['f1'].'.'.$isi['f2'].'.'.$isi['f'].'.'.$isi['g'].'.'.$isi['h'].'.'.$isi['h'].'.'.$isi['j']);
			$Koloms[] = array('align="left" width="250px"',"<span $margin>".$isi['nm_barang']."</span>");
	 		$Koloms[] = array('align="left" width="250px"',$isi['mapping']);
	 		
	 
	 return $Koloms;
	}*/
	
	function setKolomHeader($Mode=1, $Checkbox=''){
		$cetak = $Mode==2 || $Mode==3 ;
		
			
		$headerTable =
				"<tr>
				
				<th class='th01'rowspan=2 width='5' >No.</th>
				<th class='th02'colspan=3>Kode Barang Lama</th>
				<th class='th02'colspan=3>Kode Barang Baru</th>
				</tr>
				
				<tr>
				
				<th class='th01'>Kode Barang</th>
				<th class='th01'>Nama Barang</th>
				<th class='th01'>Kode Mapping</th>
				<th class='th01'>Kode Barang</th>
				<th class='th01'>Nama Barang</th>
				<th class='th01'>Kode Mapping</th>
				</tr>
				
				";
				
		return $headerTable;
	}
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Ref;
		//'f_lama','g_lama','h_lama','i_lama','j_lama'
		if($this->pid <> $isi['f_lama'].'.'.$isi['g_lama'].'.'.$isi['h_lama'].'.'.$isi['i_lama'].'.'.$isi['j_lama']){
	 	$nm_barang_lama = $isi['nm_barang_lama'];
		$mapping_lama = $isi['mapping_lama'];
		$this->pid = $isi['f_lama'].'.'.$isi['g_lama'].'.'.$isi['h_lama'].'.'.$isi['i_lama'].'.'.$isi['j_lama'];
		$kodebarang = $isi['f_lama'].'.'.$isi['g_lama'].'.'.$isi['h_lama'].'.'.$isi['i_lama'].'.'.$isi['j_lama'];
		
	 }else{
	 	$kodebarang='';
	 	$nm_barang_lama = '';
		$mapping_lama = '';
	 }
		
		
			
			
			$Koloms = array();
	 		$Koloms[] = array('align="center" width="5"', $no.'.' );
	// 	if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 		$Koloms[] = array('align="left" width="5"',$kodebarang);
	 		$Koloms[] = array('align="left" width="350px"',"<span $margin>".$nm_barang_lama."</span>");
	 		$Koloms[] = array('align="center" width="100px"',$mapping_lama);
			$Koloms[] = array('align="left" width="50px"',$isi['f1'].'.'.$isi['f2'].'.'.$isi['f'].'.'.$isi['g'].'.'.$isi['h'].'.'.$isi['i'].'.'.$isi['j']);
			$Koloms[] = array('align="left" width="350px"',"<span $margin>".$isi['nm_barang']."</span>");
	 		$Koloms[] = array('align="center" width="100px"',$isi['mapping']);
	 		
	 
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	global $Ref, $Main;
	//$fmBidang = $_REQUEST ['fmBidang'];	
	$fmGolongan1 = $_REQUEST['fmGolongan1'];
	$fmBidang = $_REQUEST['fmBidang'];
	$fmMapping = $_REQUEST['fmMapping'];
	/*$fmGolongan1 = cekPOST('fmGolongan1');
	$fmBidang1 = cekPOST('fmBidang1');
	$fmKelompok1 = cekPOST('fmKelompok1');
	$fmMapping = cekPOST('fmMapping');
	$fmAKUN = cekPOST('fmAKUN');
	$fmKELOMPOK = cekPOST('fmKELOMPOK');
	$fmJENIS = cekPOST('fmJENIS');
	$fmOBJEK = cekPOST('fmOBJEK');
	$fmRINOBJEK = cekPOST('fmRINOBJEK');
	$fmSUBRINOBJEK = cekPOST('fmSUBRINOBJEK');
	$fmKODE1 = cekPOST('fmKODE1');
	$fmBARANG1 = cekPOST('fmBARANG1');			
	$fmKODE2 = cekPOST('fmKODE2');
	$fmBARANG2 = cekPOST('fmBARANG2');*/
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
			"<table width=\"100%\" class=\"adminform\">	<tr>		
			<td width=\"50%\" valign=\"top\"><h2>KODE BARANG LAMA</h2>			
			 <table style='width:100%'>
			<tr>
			<td style='width:50px'>GOLONGAN</td><td style='width:10px'>:</td>
			<td>".
			cmbQuery1("fmGolongan1",$fmGolongan1,"select f,nm_barang from ref_barang where f<'06' and g ='00' and h = '00'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr>
			<tr>
			<td style='width:50px'>BIDANG</td><td style='width:10px'>:</td>
			<td>".
			cmbQuery1("fmBidang",$fmBidang,"select g,nm_barang from ref_barang where f='$fmGolongan1' and g !='00' and h = '00'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr>
			<tr>
			<td style='width:50px'>Mapping</td><td style='width:10px'>:</td>
			<td>".
			cmbArray("fmMapping",$fmMapping,$this->arrMapping3,'Pilih','style=width:130px;')."
			<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>
			</td>
			</tr>
			
			
			
			</table>
			</td>
			
			</table>".
			"<div class='FilterBar'>".
			"<table style='width:100%'>
			
			
			</table>".
			"</div>".
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
	 	$fmGolongan1 = $_REQUEST['fmGolongan1'];
	 	$fmBidang = $_REQUEST['fmBidang'];
		$fmMapping = cekPOST('fmMapping');
		/*$fmGolongan1 = cekPOST('fmGolongan1');
	 	$fmBidang1 = cekPOST('fmBidang1');
		$fmKelompok1 = cekPOST('fmKelompok1');
		$fmMapping = cekPOST('fmMapping');
		$fmJENIS = cekPOST('fmJENIS');
		$fmOBJEK = cekPOST('fmOBJEK');
		$fmRINOBJEK = cekPOST('fmRINOBJEK');
		$fmSUBRINOBJEK = cekPOST('fmSUBRINOBJEK');
		$fmKODE1 = cekPOST('fmKODE1');
		$fmBARANG1 = cekPOST('fmBARANG1');
		$fmKODE2 = cekPOST('fmKODE2');
		$fmBARANG2 = cekPOST('fmBARANG2');*/
		//Cari 
		$isivalue=explode('.',$fmPILCARIvalue);
		switch($fmPILCARI){			
			
			case 'selectKode': $arrKondisi[] = " concat(f_lama,'.',g_lama,'.',h_lama,'.',i_lama,'.',j_lama) like '$fmPILCARIvalue%'"; break;
			case 'selectNama': $arrKondisi[] = " nm_barang_lama like '%$fmPILCARIvalue%'"; break;	
			
			case 'selectKode': $arrKondisi[] = " concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) like '$fmPILCARIvalue%'"; break;
			case 'selectNama': $arrKondisi[] = " nm_barang like '%$fmPILCARIvalue%'"; break;								 	
		}	
		
		if(empty($fmGolongan1)) {
			$fmMapping='';
		}
		
		/*if(empty($fmJENIS)) {		
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
		}		*/
		if(empty($fmGolongan1))// && empty($fmMapping))
		{
			$fmBidang='';
		}
		elseif(!empty($fmGolongan1) && empty($fmBidang))
		{
			$arrKondisi[]= "f_lama =$fmGolongan1 and g_lama!='00' and h_lama='00' and i_lama='00' and j_lama='000' and f1='1' and f2='3' and f=$fmGolongan1 and  j='000'";
		}
		elseif(!empty($fmGolongan1) && !empty($fmBidang))
		{
			$arrKondisi[]= "f_lama =$fmGolongan1 and g_lama=$fmBidang and h_lama!='00' and i_lama='00' and j_lama='000' and f1='1' and f2='3' and f=$fmGolongan1 and  j='000'";
		}		
		/*if(empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
		}
		
		elseif(!empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =1 and f2=3 and f=$fmJENIS and g!=00";				
		}
		elseif(!empty($fmJENIS) && !empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =1 and f2=3 and f=$fmJENIS and g=$fmOBJEK and h!=00 ";			
		}
		elseif(!empty($fmJENIS) && !empty($fmOBJEK) && !empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =1 and f2=3 and f=$fmJENIS and g=$fmOBJEK and h=$fmRINOBJEK and i!=00 and j=000";
		}
		elseif(!empty($fmJENIS) && !empty($fmOBJEK) && !empty($fmRINOBJEK) && !empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =1 and f2=3 and f=$fmJENIS and g=$fmOBJEK and h=$fmRINOBJEK and i=$fmSUBRINOBJEK";			
		}*/
		if(!empty($_POST['fmMapping']) ) $arrKondisi[] = " mapping like '%".$_POST['fmMapping']."%'";
		if(!empty($_POST['fmKODE1'])) $arrKondisi[] = " concat(f_lama,'.',g_lama,'.',h_lama,'.',i_lama,'.',j_lama) like '".$_POST['fmKODE1']."%'";					
		if(!empty($_POST['fmBARANG1'])) $arrKondisi[] = " nm_barang_lama like '%".$_POST['fmBARANG1']."%'";
		
		if(!empty($_POST['fmKODE2'])) $arrKondisi[] = " concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) like '".$_POST['fmKODE2']."%'";					
		if(!empty($_POST['fmBARANG2'])) $arrKondisi[] = " nm_barang like '%".$_POST['fmBARANG2']."%'";		
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		switch($fmORDER1){
			case '1': $arrOrders[] = " f_lama,g_lama,h_lama,i_lama,j_lama $Asc1 " ;break;
			case '2': $arrOrders[] = " nm_barang_lama $Asc1 " ;break;
			case '3': $arrOrders[] = " f1,f2,f,g,h,i,j $Asc1 " ;break;
			case '4': $arrOrders[] = " nm_barang $Asc1 " ;break;
		}	
		$Order= join(',',$arrOrders);	
	//	$OrderDefault = '';
	//	$arrKondisi[]= 'group by f_lama ,g_lama,h_lama,i_lama,j_lama';
	
	//	$OrderDefault = 'group by f_lama ,g_lama,h_lama,i_lama,j_lama order by f_lama,g_lama,h_lama,i_lama,j_lama,mapping_lama asc';// Order By no_terima desc ';
	//	$OrderDefault = 'group by mapping_lama order by mapping_lama asc';// Order By no_terima desc ';
	//	$OrderDefault = 'group by f_lama,g_lama,h_lama,i_lama,j_lama order by f_lama,g_lama,h_lama,i_lama,j_lama,mapping_lama asc';// Order By no_terima desc ';
	
	//	$OrderDefault ='order by mapping_lama,f_lama,g_lama,h_lama,i_lama,j_lama asc';// Order By no_terima desc ';
	//	$OrderDefault ='order by mapping_lama,f_lama,g_lama,h_lama asc';// Order By no_terima desc ';
		$OrderDefault ='order by mapping_lama,f_lama,g_lama,h_lama asc';// Order By no_terima desc ';
		
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	
		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
	}
}
$ref_kode_barang_mapping = new ref_kode_barang_mappingObj();
?>