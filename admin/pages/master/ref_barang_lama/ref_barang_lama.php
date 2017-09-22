<?php

class ref_barang_lamaObj extends DaftarObj2{
	var $Prefix = 'ref_barang_lama';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_barang'; //daftar
	var $TblName_Hapus = 'ref_barang';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('f','g','h','i','j');
	var $FieldSum = array();
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = 'Kode Barang Lama';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	var $cetak_xls=TRUE ;
	var $fileNameExcel='usulansk.xls';
	var $Cetak_Judul = 'REFERENSI Barang Lama';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'ref_barang_lamaForm'; 
//	var $pid='';
	
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
		global $Main;
		return 'Kode Barang Lama';	

	}
	
	function setNavAtas(){
		return
			"";
	}
	
	function setMenuEdit(){		
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Mapping", 'Mapping')."</td>".
			"</td>";
	}
	
	function setMenuView(){		
		return "";			
		
	}
	
	function simpanEdit(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
	$h= $_REQUEST['h'];
	$i= $_REQUEST['i'];
	$j= $_REQUEST['j'];
	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
	
	
	if($f=='05'){
		if($err=='')
					
		
	$aqry = "UPDATE ref_barang set f='$f',g='$g',h='$h',i='$i', mapping='$mapping' where f='$f' and g='$g' and h='$h' and i='$i'";$cek .= $aqry;
						$qry = mysql_query($aqry);			
						
				}elseif($f!='01'){
					$aqry1 = "UPDATE ref_barang set f='$f',g='$g',h='$h', mapping='$mapping' where f='$f'and g='$g'and h='$h'";$cek .= $aqry1;
						$qry1 = mysql_query($aqry1);
				}else{
				//	$aqry2 = "UPDATE ref_barang set f='$f',g='$g', mapping='$mapping' where f='$f'and g=='$g' and $h=='00' and $i=='00' and $j=='000'";$cek .= $aqry2;
					$aqry2 = "UPDATE ref_barang set f='$f',g='$g', mapping='$mapping' where f='$f'and g='$g' and h='00' and i='00' and j='000'";$cek .= $aqry2;
						$qry2 = mysql_query($aqry2);
				}
							
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }
	
	function simpanEdit2(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
//	$h= $_REQUEST['h'];
//	$i= $_REQUEST['i'];
//	$j= $_REQUEST['j'];
	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
									
	if($err==''){						
		
		$aqry = "UPDATE ref_barang set f='$f',g='$g', mapping='$mapping' where f='$f' and g='$g' and h='00' and i='00' and j='000'";$cek .= $aqry;
		$qry = mysql_query($aqry);
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanEdit3(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
	$h= $_REQUEST['h'];
	$i= $_REQUEST['i'];
//	$j= $_REQUEST['j'];
	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
									
	if($err==''){						
		
		$aqry = "UPDATE ref_barang set f='$f',g='$g',h='$h', mapping='$mapping' where f='$f' and g='$g' and h='$h'";$cek .= $aqry;
		$qry = mysql_query($aqry);
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }		
	
	function simpanEdit4(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
	$h= $_REQUEST['h'];
	$i= $_REQUEST['i'];
//	$j= $_REQUEST['j'];
	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
									
	if($err==''){						
		
		$aqry = "UPDATE ref_barang set f='$f',g='$g',h='$h',i='$i', mapping='$mapping' where f='$f' and g='$g' and h='$h' and i='$i'";$cek .= $aqry;
		$qry = mysql_query($aqry);
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }		
		
	function genDaftarOpsi(){
	 global $Ref, $Main;
	
	$fmGolongan = cekPOST('fmGolongan');			
	$fmBidang = cekPOST ('fmBidang');
	$fmNamaBrg = cekPOST('fmNamaBrg');
	
	$queryBidang="SELECT f, concat(f, '. ', nm_barang) as vnama FROM ref_barang WHERE f<'06' AND g ='00' AND h='00' AND i='00' AND j='000'";
		
	$VFilter = "<table style='width:100%'>
					<tr>
						<td width='90'>GOLONGAN</td><td style='width:10px'>:</td>
						<td>".
						cmbQuery1("fmGolongan",$fmGolongan,"select f,nm_barang from ref_barang where f<'06' and g ='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
						"</td>
					</tr>
					<tr>
						<td width='90'>BIDANG</td><td>:</td>
						<td>".
						cmbQuery1("fmBidang",$fmBidang,"select g,nm_barang from ref_barang where f='$fmGolongan' and g !='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
					"</td>
					</tr>
						
						</table>";		
	 
	$arrOrder = array(
			     	array('1','Kode Barang'),
			     	array('2','Nama Barang'),
					); 
	  
	$queryCari = "SELECT Id,nama FROM ref_jenis" ;
		
	$TampilOpt = 									
					"<div class='FilterBar'>
					$VFilter
						<table style='width:100%'>
						<tr>
						<td width='105'>Cari Data &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </td>
							<td ><input type='text' name='fmKodeBarang' id='fmKodeBarang' value='$fmKodeBarang' placeholder='Kode Barang'>
							<input type='text' name='fmNamaBrg' id='fmNamaBrg' value='$fmNamaBrg'placeholder='Nama Barang'>
							
						".cmbArray('arrOrder',$fmOrder,$arrOrder,'--Urutkan--','').
						"<input $fmDESC1 type='checkbox' id='fmDESC1' name='fmDESC1' value='checked'>&nbspmenurun.
						<input type='hidden' id='status_filter' name='status_filter' value='$status_filter'>
						<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>	
						</td>
						</tr>
						</table>
						</div>";

		return array('TampilOpt'=>$TampilOpt);
	}			

	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
				
		$arrKondisi = array();
		$fmKodeBarang = $_REQUEST ['fmKodeBarang'];
		$fmNamaBrg = $_REQUEST ['nama'];		
		$fmGolongan = cekPOST('fmGolongan');
		$fmBidang = cekPOST('fmBidang');
		
		
		$fmBidang = $_REQUEST ['fmBidang'];
		$fmGolongan = $_REQUEST ['fmGolongan'];
		$fmKelompok = $_REQUEST['fmKelompok'];
		$fmObjek = $_REQUEST['fmObjek'];
		$fmJenis = $_REQUEST['fmJenis'];
		$fmNmBrg = $_REQUEST['fmNmBrg'];
		$arrOrder = $_REQUEST['arrOrder'];
		$status_filter=$_REQUEST['status_filter'];
		$fmNamaBrg = cekPOST('fmNamaBrg');
		
		if(empty($fmGolongan)) {
			$fmBidang = '';
		}
		
		
		if(!empty($fmGolongan) && $fmGolongan=='01' && empty($fmBidang))
		{
			$arrKondisi[]= "f='01' and g!='00' and h!='00' and i='00' and j='000'";
		}
		elseif(!empty($fmGolongan) && $fmGolongan=='05' && empty($fmBidang))
		{
			$arrKondisi[]= "f='05' and g!='00' and h!='00' and i!='00' and j='000'";
		}	
		
		elseif(!empty($fmGolongan) && empty($fmBidang))
		{
			$arrKondisi[]= "f='$fmGolongan' and g!='00' and h='00' and i='00' and j='000'";
		}
		elseif(!empty($fmGolongan) && !empty($fmBidang))
		{
			$arrKondisi[]= "f='$fmGolongan' and g='$fmBidang' and h!='00' and i='00' and j='000'";
		}	
		
		
		if(!empty($fmKelompok)) $arrKondisi[]= " g = '$fmKelompok'";
		if(!empty($fmObjek)) $arrKondisi[]= " h = '$fmObjek'";
		if(!empty($fmJenis)) $arrKondisi[]= " i = '$fmJenis'";
		if(!empty($fmNmBrg)) $arrKondisi[]= " j = '$fmNmBrg'";	
		if(!empty($fmNamaBrg)) $arrKondisi[]= " nm_barang = '$fmNamaBrg'";	
		if ($status_filter==1)
		//{*/
		{//$arrKondisi[]= " f <> '00'";
		//if(!empty($fmBidang)) $arrKondisi[]= " f <> '00'";
		$arrKondisi[]= " f>='05' && f<='05'";
	//	$arrKondisi[]= " f <> '00";
		$arrKondisi[]= " g <> '00'";
		$arrKondisi[]= " h <> '00'";
		$arrKondisi[]= " i <> '00'";
		$arrKondisi[]= " j <> '000'";		
		}else{
			
		}
		if(!empty($fmKodeBarang)) $arrKondisi[]= " concat(f,'.',g,'.',h,'.',i,'.',j) like '$fmKodeBarang%'";
		if(!empty($fmNamaBrg)) $arrKondisi[]= " nm_barang like '%$fmNamaBrg%'";
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		
		switch($arrOrder){
			case '1': $arrOrders[] = " concat(f,g,h,i,j) $Asc1 " ;break;
			case '2': $arrOrders[] = " nm_barang $Asc1 " ;break;
		}
		
		$Order= join(',',$arrOrders);	
		$OrderDefault = '';// Order By no_terima desc ';
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	
		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
	}	
	
	
	function genDaftarInitial(){
		$vOpsi = $this->genDaftarOpsi();
		$fmFiltThnAnggaran=$_COOKIE['coThnAnggaran'];
		return			
			"<div id='{$this->Prefix}_cont_title' style='position:relative'></div>". 
			"<div id='{$this->Prefix}_cont_opsi' style='position:relative'>". 		
				
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
		
	
	function setPage_OtherScript(){
		$scriptload = 
					"<script>
						
						$(document).ready(function(){ 
							".$this->Prefix.".loading();
						});
										
					</script>";
		return "<script src='js/skpd.js' type='text/javascript'></script>
				<script src='js/barcode.js' type='text/javascript'></script>
				<script type='text/javascript' src='js/master/ref_barang_lama/".strtolower($this->Prefix).".js' language='JavaScript' ></script>
				".
						$scriptload;
	}
	
	function setKolomHeader($Mode=1, $Checkbox=''){
	$NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox		
	   <th class='th01' width='200' colspan='5'>Kode Barang</th>
	   <th class='th01' width='450' align='center'>Nama Barang</th>
	   <th class='th01' width='450' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	
	if($isi['f'] == '01' && $isi['g']!='00' && $isi['h']!='00' && $isi['i']=='00' && $isi['j']=='000') {	
		$TampilCheckBox = $TampilCheckBox; //3 level awal
	 }elseif($isi['f'] != '01' && $isi['g']!='00' && $isi['h']=='00' && $isi['i']=='00' && $isi['j']=='000') {	
		$TampilCheckBox = $TampilCheckBox;// 2 level
	 }elseif($isi['f'] != '01' && $isi['g']!='00' && $isi['h']!='00' && $isi['i']=='00' && $isi['j']=='000') {	
		$TampilCheckBox = $TampilCheckBox; // 3 level
	 }elseif($isi['f'] == '05' && $isi['g']!='00' && $isi['h']!='00' && $isi['i'] !='00' && $isi['j']=='000') {	
		$TampilCheckBox = $TampilCheckBox;// 4 level
	 }else{
	 			
		$TampilCheckBox = '';
	 }
	
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 $Koloms[] = array('align="center"',genNumber($isi['f'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['g'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['h'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['i'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['j'],3));
	 $Koloms[] = array('align="left"',$isi['nm_barang']);
	 $Koloms[] = array('align="left"',$isi['mapping']);
	 
	 return $Koloms;
	}
		
	function set_selector_other($tipe){
		global $Main;
		$cek = ''; $err=''; $content=''; $json=TRUE;
		
		switch($tipe){
		
		case 'simpanEdit':{
			$get= $this->simpanEdit();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }
	   case 'simpanEdit2':{
			$get= $this->simpanEdit2();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }
	   case 'simpanEdit3':{
			$get= $this->simpanEdit3();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }
	   case 'simpanEdit4':{
			$get= $this->simpanEdit4();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }
	   
	  /* case 'simpanEdit4':{
			$get= $this->simpanEdit4();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }	*/
		
		case 'simpan':{
			$get= $this->simpan();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
				
		case 'formEdit':{				
			$fm = $this->setFormEdit();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formEdit2':{								
			$this->setFormEdit();				
			$json = FALSE;				
			break;
		}
			
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function setFormEdit(){
		
	 $err='';$cek ='';
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$f=$kode[0];
		$g=$kode[1];
		$h=$kode[2];
		$i=$kode[3];
		$j=$kode[4];
		$this->form_fmST = 1;				
		//get data 
		$ceklvl4=mysql_query("SELECT * FROM  ref_barang WHERE f='".$kode[0]."' and g='".$kode[1]."' and h='".$kode[2]."'  and  i='".$kode[3]."' and j='".$kode[4]."'"); $cek.="SELECT * FROM  ref_barang WHERE f='".$kode[0]."' and g='".$kode[1]."' and h='".$kode[2]."'  and  i='".$kode[3]."' and j='".$kode[4]."'";
		
		$ceklevl4=mysql_fetch_array($ceklvl4);
		
		if($ceklevl4['f'] =='01' && $ceklevl4['g']!='00' && $ceklevl4['h']!='00' && $ceklevl4['i']=='00' && $ceklevl4['j']=='000'){
		$fm= $this->setFormEditdata($dt);		
		}elseif($ceklevl4['f'] != '01' && $ceklevl4['g']!='00' && $ceklevl4['h']=='00' && $ceklevl4['i']=='00' && $ceklevl4['j']=='000'){
			$fm= $this->setFormEditdata2($dt);	
			
		}elseif($ceklevl4['f'] == '05' && $ceklevl4['g']!='00' && $ceklevl4['h']!='00' && $ceklevl4['i'] =='00' && $ceklevl4['j']=='000'){	
			
			$err='data tidak bisa di Mapping !!';
		
		}elseif($ceklevl4['f'] != '01' && $ceklevl4['g']!='00' && $ceklevl4['h']!='00' && $ceklevl4['i']=='00' && $ceklevl4['j']=='000'){
		//	$err='data tidak bisa di Mapping !!';
			$fm= $this->setFormEditdata($dt);
			
			
			
		//	$fm= $this->setFormEditJenisLvl4($dt);	
		}elseif($ceklevl4['f'] == '05' && $ceklevl4['g']!='00' && $ceklevl4['h']!='00' && $ceklevl4['i'] !='00' && $ceklevl4['j']=='000'){
		//	$err='data tidak bisa di Mapping !!';
			$fm= $this->setFormEditJenisLvl4($dt);		
		}
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$err.$fm['err'], 'content'=>$fm['content']);
	}	
	
	function setFormEditdata2($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 670;
	 $this->form_height = 100;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'Barang Lama - Mapping';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$f=$kode[0];
		$g=$kode[1];
		$h=$kode[2];
		$i=$kode[3];
		$j=$kode[4];
	
		
		$query_f=mysql_fetch_array(mysql_query("SELECT f, nm_barang FROM ref_barang WHERE f='$f' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_g=mysql_fetch_array(mysql_query("SELECT g, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h= '00' and i='00' and j='000'")) ;
		$query_h=mysql_fetch_array(mysql_query("SELECT h, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		$query_i=mysql_fetch_array(mysql_query("SELECT i, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$query_j=mysql_fetch_array(mysql_query("SELECT j, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='$j'")) ;
		
		$query_mapping=mysql_fetch_array(mysql_query("SELECT mapping FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		
		$dat_f=$query_f['f'].".  ".$query_f['nm_barang'];
		$dat_g=$query_g['g'].". ".$query_g['nm_barang'];
		$dat_h=$query_h['h']." .  ".$query_h['nm_barang'];
		$dat_i=$query_i['i'].". ".$query_i['nm_barang'];
		$dat_j=$query_j['j'].". ".$query_j['nm_barang'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'golongan' => array( 
						'label'=>'GOLONGAN',
						'labelWidth'=>140, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef' id='ef' value='".$dat_f."' style='width:490px;' readonly>
						<input type ='hidden' name='f' id='f' value='".$query_f['f']."'>
						</div>", 
						 ),
			'BIDANG' => array( 
						'label'=>'BIDANG',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$dat_g."' style='width:490px;' readonly>
						<input type ='hidden' name='g' id='g' value='".$query_g['g']."'>
						</div>", 
						 ),
			
			
			'mapping' => array( 
						'label'=>'KODE MAPPING',
						'labelWidth'=>100, 
						'value'=>cmbArray('mapping',$query_mapping['mapping'],$this->arrMapping3,'--PILIH--','style=width:130px;'), 
						 )	
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit2()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	
	function setFormEditdata($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 670;
	 $this->form_height = 130;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'Barang Lama - Mapping';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$f=$kode[0];
		$g=$kode[1];
		$h=$kode[2];
		$i=$kode[3];
		$j=$kode[4];
	
		
		$query_f=mysql_fetch_array(mysql_query("SELECT f, nm_barang FROM ref_barang WHERE f='$f' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_g=mysql_fetch_array(mysql_query("SELECT g, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h= '00' and i='00' and j='000'")) ;
		$query_h=mysql_fetch_array(mysql_query("SELECT h, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		$query_i=mysql_fetch_array(mysql_query("SELECT i, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$query_j=mysql_fetch_array(mysql_query("SELECT j, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='$j'")) ;
		
		$query_mapping=mysql_fetch_array(mysql_query("SELECT mapping FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		
		$dat_f=$query_f['f'].".  ".$query_f['nm_barang'];
		$dat_g=$query_g['g'].". ".$query_g['nm_barang'];
		$dat_h=$query_h['h']." .  ".$query_h['nm_barang'];
		$dat_i=$query_i['i'].". ".$query_i['nm_barang'];
		$dat_j=$query_j['j'].". ".$query_j['nm_barang'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'golongan' => array( 
						'label'=>'GOLONGAN',
						'labelWidth'=>140, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef' id='ef' value='".$dat_f."' style='width:490px;' readonly>
						<input type ='hidden' name='f' id='f' value='".$query_f['f']."'>
						</div>", 
						 ),
			'BIDANG' => array( 
						'label'=>'BIDANG',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$dat_g."' style='width:490px;' readonly>
						<input type ='hidden' name='g' id='g' value='".$query_g['g']."'>
						</div>", 
						 ),
			'KEL' => array( 
						'label'=>'KELOMPOK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$dat_h."' style='width:490px;' readonly>
						<input type ='hidden' name='h' id='h' value='".$query_h['h']."'>
						</div>", 
						 ),
			
			'mapping' => array( 
						'label'=>'KODE MAPPING',
						'labelWidth'=>100, 
						'value'=>cmbArray('mapping',$query_mapping['mapping'],$this->arrMapping3,'--PILIH--','style=width:130px;'), 
						 )	
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit3()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
	function setFormEditJenisLvl4($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 670;
	 $this->form_height = 130;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'Barang Lama - Mapping';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$f=$kode[0];
		$g=$kode[1];
		$h=$kode[2];
		$i=$kode[3];
		$j=$kode[4];
				
		$query_f=mysql_fetch_array(mysql_query("SELECT f, nm_barang FROM ref_barang WHERE f='$f' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_g=mysql_fetch_array(mysql_query("SELECT g, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h= '00' and i='00' and j='000'")) ;
		$query_h=mysql_fetch_array(mysql_query("SELECT h, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		$query_i=mysql_fetch_array(mysql_query("SELECT i, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$query_j=mysql_fetch_array(mysql_query("SELECT j, nm_barang FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='$j'")) ;
		
		$query_mapping=mysql_fetch_array(mysql_query("SELECT mapping FROM ref_barang WHERE f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$dat_f=$query_f['f'].".  ".$query_f['nm_barang'];
		$dat_g=$query_g['g'].". ".$query_g['nm_barang'];
		$dat_h=$query_h['h']." .  ".$query_h['nm_barang'];
		$dat_i=$query_i['i'].". ".$query_i['nm_barang'];
		$dat_j=$query_j['j'].". ".$query_j['nm_barang'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'golongan' => array( 
						'label'=>'GOLONGAN',
						'labelWidth'=>140, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef' id='ef' value='".$dat_f."' style='width:490px;' readonly>
						<input type ='hidden' name='f' id='f' value='".$query_f['f']."'>
						</div>", 
						 ),
			'BIDANG' => array( 
						'label'=>'BIDANG',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$dat_g."' style='width:490px;' readonly>
						<input type ='hidden' name='g' id='g' value='".$query_g['g']."'>
						</div>", 
						 ),
			'KEL' => array( 
						'label'=>'KELOMPOK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$dat_h."' style='width:490px;' readonly>
						<input type ='hidden' name='h' id='h' value='".$query_h['h']."'>
						</div>", 
						 ),
			
			'subkel' => array( 
						'label'=>'SUB KELOMPOK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$dat_i."' style='width:490px;' readonly>
						<input type ='hidden' name='i' id='i' value='".$query_i['i']."'>
						</div>", 
						 ),
			
			'mapping' => array( 
						'label'=>'KODE MAPPING',
						'labelWidth'=>100, 
						'value'=>cmbArray('mapping',$query_mapping['mapping'],$this->arrMapping3,'--PILIH--','style=width:130px;'), 
						 )	
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit4()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
}
	
$ref_barang_lama = new ref_barang_lamaObj();

?>