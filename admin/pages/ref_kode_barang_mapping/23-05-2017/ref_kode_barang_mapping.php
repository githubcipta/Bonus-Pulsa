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
	var $KeyFields = array('f','g','h','f1','f2','fbaru','gbaru','hbaru','i','j');
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
	var $FormName = 'ref_kode_barang_mappingForm';
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
		return
		//	"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","sections.png","Baru", 'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Mapping", 'Mapping')."</td>";
		//	"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>";		
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
	
	$f1= $_REQUEST['f1'];
	$f2= $_REQUEST['f2'];
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
	$h= $_REQUEST['h'];
	$i= $_REQUEST['i'];
	$j= $_REQUEST['j'];
//	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
	
					
	if($err==''){
		
					$aqry1 = "UPDATE ref_barang_baru set f1='$f1',f2='$f2',f='$f',g='$g',h='$h', mapping='$mapping' where f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='000'";$cek .= $aqry1;
						$qry1 = mysql_query($aqry1);
						
					$aqry2 = "UPDATE ref_barang_baru set f1='$f1',f2='$f2',f='$f',g='$g',h='$h', mapping='$mapping' where f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i'";$cek .= $aqry2;
						$qry2 = mysql_query($aqry2);	
				}
							
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function simpanEditlvl4(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$f1= $_REQUEST['f1'];
	$f2= $_REQUEST['f2'];
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
	$h= $_REQUEST['h'];
	$i= $_REQUEST['i'];
	$j= $_REQUEST['j'];
//	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
	
					
	if($err==''){
		
					$aqry1 = "UPDATE ref_barang_baru set f1='$f1',f2='$f2',f='$f',g='$g', mapping='$mapping' where f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='00' and i='00' and j='000'";$cek .= $aqry1;
						$qry1 = mysql_query($aqry1);
						
					
				}
							
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	
	function simpanEditlvl5(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	
	$f1= $_REQUEST['f1'];
	$f2= $_REQUEST['f2'];
	$f= $_REQUEST['f'];
	$g= $_REQUEST['g'];
	$h= $_REQUEST['h'];
	$i= $_REQUEST['i'];
	$j= $_REQUEST['j'];
//	$nama= $_REQUEST['nm'];
	$mapping= $_REQUEST['mapping'];
	
					
	if($err==''){
		
					$aqry1 = "UPDATE ref_barang_baru set f1='$f1',f2='$f2',f='$f',g='$g',h='$h', mapping='$mapping' where f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='00' and j='000'";$cek .= $aqry1;
						$qry1 = mysql_query($aqry1);
						
					$aqry2 = "UPDATE ref_barang_baru set f1='$f1',f2='$f2',f='$f',g='$g',h='$h', mapping='$mapping' where f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h'";$cek .= $aqry2;
						$qry2 = mysql_query($aqry2);		
					
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
					
		case 'simpanEdit':{
			$get= $this->simpanEdit();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }
	   
	   case 'simpanEditlvl4':{
			$get= $this->simpanEditlvl4();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }	
	   
	    case 'simpanEditlvl5':{
			$get= $this->simpanEditlvl5();
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
	
	function setFormEditlvl4($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 650;
	 $this->form_height = 150;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'REFERENSI Barang BARU - Mapping';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$f1=$kode[0];
		$f2=$kode[1];
		$f=$kode[2];
		$g=$kode[3];
		$h=$kode[4];
		$i=$kode[5];
		$j=$kode[6];
		
		$query_f1=mysql_fetch_array(mysql_query("SELECT f1, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='0' and f='00' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_f2=mysql_fetch_array(mysql_query("SELECT f2, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='00' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_f=mysql_fetch_array(mysql_query("SELECT f, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_g=mysql_fetch_array(mysql_query("SELECT g, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h= '00' and i='00' and j='000'")) ;
		$query_h=mysql_fetch_array(mysql_query("SELECT h, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		$query_i=mysql_fetch_array(mysql_query("SELECT i, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$query_j=mysql_fetch_array(mysql_query("SELECT j, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='$j'")) ;
		
		$dat_f1=$query_f1['f1'].".  ".$query_f1['nm_barang'];
		$dat_f2=$query_f2['f2'].".  ".$query_f2['nm_barang'];
		$dat_f=$query_f['f'].".  ".$query_f['nm_barang'];
		$dat_g=$query_g['g'].". ".$query_g['nm_barang'];
		$dat_h=$query_h['h']." .  ".$query_h['nm_barang'];
		$dat_i=$query_i['i'].". ".$query_i['nm_barang'];
		$dat_j=$query_j['j'].". ".$query_j['nm_barang'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'akun' => array( 
						'label'=>'AKUN',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef1' id='ef1' value='".$dat_f1."' style='width:490px;' readonly>
						<input type ='hidden' name='f1' id='f1' value='".$query_f1['f1']."'>
						</div>", 
						 ),
		  
		  'kel' => array( 
						'label'=>'KELOMPOK',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef2' id='ef2' value='".$dat_f2."' style='width:490px;' readonly>
						<input type ='hidden' name='f2' id='f2' value='".$query_f2['f2']."'>
						</div>", 
						 ),
			'JENIS' => array( 
						'label'=>'JENIS',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef' id='ef' value='".$dat_f."' style='width:490px;' readonly>
						<input type ='hidden' name='f' id='f' value='".$query_f['f']."'>
						</div>", 
						 ),
			'OBJEK' => array( 
						'label'=>'OBJEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$dat_g."' style='width:490px;' readonly>
						<input type ='hidden' name='g' id='g' value='".$query_g['g']."'>
						</div>", 
						 ),
			
			
			
			'mapping' => array( 
						'label'=>'KODE MAPPING',
						'labelWidth'=>100, 
						'value'=>cmbArray('mapping',$dt['mapping'],$this->arrMapping3,'--PILIH--','style=width:130px;'), 
						 )	
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEditlvl4()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	
	function setFormEditlvl5($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 650;
	 $this->form_height = 160;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'REFERENSI Barang BARU - Mapping';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$f1=$kode[0];
		$f2=$kode[1];
		$f=$kode[2];
		$g=$kode[3];
		$h=$kode[4];
		$i=$kode[5];
		$j=$kode[6];
		
		$query_f1=mysql_fetch_array(mysql_query("SELECT f1, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='0' and f='00' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_f2=mysql_fetch_array(mysql_query("SELECT f2, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='00' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_f=mysql_fetch_array(mysql_query("SELECT f, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_g=mysql_fetch_array(mysql_query("SELECT g, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h= '00' and i='00' and j='000'")) ;
		$query_h=mysql_fetch_array(mysql_query("SELECT h, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		$query_i=mysql_fetch_array(mysql_query("SELECT i, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$query_j=mysql_fetch_array(mysql_query("SELECT j, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='$j'")) ;
		
		$dat_f1=$query_f1['f1'].".  ".$query_f1['nm_barang'];
		$dat_f2=$query_f2['f2'].".  ".$query_f2['nm_barang'];
		$dat_f=$query_f['f'].".  ".$query_f['nm_barang'];
		$dat_g=$query_g['g'].". ".$query_g['nm_barang'];
		$dat_h=$query_h['h']." .  ".$query_h['nm_barang'];
		$dat_i=$query_i['i'].". ".$query_i['nm_barang'];
		$dat_j=$query_j['j'].". ".$query_j['nm_barang'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'akun' => array( 
						'label'=>'AKUN',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef1' id='ef1' value='".$dat_f1."' style='width:490px;' readonly>
						<input type ='hidden' name='f1' id='f1' value='".$query_f1['f1']."'>
						</div>", 
						 ),
		  
		  'kel' => array( 
						'label'=>'KELOMPOK',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef2' id='ef2' value='".$dat_f2."' style='width:490px;' readonly>
						<input type ='hidden' name='f2' id='f2' value='".$query_f2['f2']."'>
						</div>", 
						 ),
			'JENIS' => array( 
						'label'=>'JENIS',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef' id='ef' value='".$dat_f."' style='width:490px;' readonly>
						<input type ='hidden' name='f' id='f' value='".$query_f['f']."'>
						</div>", 
						 ),
			'OBJEK' => array( 
						'label'=>'OBJEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$dat_g."' style='width:490px;' readonly>
						<input type ='hidden' name='g' id='g' value='".$query_g['g']."'>
						</div>", 
						 ),
			'RINOBJEK' => array( 
						'label'=>'RINCIAN OBJEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$dat_h."' style='width:490px;' readonly>
						<input type ='hidden' name='h' id='h' value='".$query_h['h']."'>
						</div>", 
						 ),
						
			'mapping' => array( 
						'label'=>'KODE MAPPING',
						'labelWidth'=>100, 
						'value'=>cmbArray('mapping',$dt['mapping'],$this->arrMapping3,'--PILIH--','style=width:130px;'), 
						 )	
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEditlvl5()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
		
	function setFormEditlvl6($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 650;
	 $this->form_height = 200;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'REFERENSI Barang BARU - Mapping';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$f1=$kode[0];
		$f2=$kode[1];
		$f=$kode[2];
		$g=$kode[3];
		$h=$kode[4];
		$i=$kode[5];
		$j=$kode[6];
		
		$query_f1=mysql_fetch_array(mysql_query("SELECT f1, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='0' and f='00' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_f2=mysql_fetch_array(mysql_query("SELECT f2, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='00' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_f=mysql_fetch_array(mysql_query("SELECT f, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g = '00' and h='00' and i='00' and j='000'")) ;
		$query_g=mysql_fetch_array(mysql_query("SELECT g, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h= '00' and i='00' and j='000'")) ;
		$query_h=mysql_fetch_array(mysql_query("SELECT h, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='00' and j='000'")) ;
		$query_i=mysql_fetch_array(mysql_query("SELECT i, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='000'")) ;
		$query_j=mysql_fetch_array(mysql_query("SELECT j, nm_barang FROM ref_barang_baru WHERE f1='$f1' and f2='$f2' and f='$f' and g='$g' and h='$h' and i='$i' and j='$j'")) ;
		
		$dat_f1=$query_f1['f1'].".  ".$query_f1['nm_barang'];
		$dat_f2=$query_f2['f2'].".  ".$query_f2['nm_barang'];
		$dat_f=$query_f['f'].".  ".$query_f['nm_barang'];
		$dat_g=$query_g['g'].". ".$query_g['nm_barang'];
		$dat_h=$query_h['h']." .  ".$query_h['nm_barang'];
		$dat_i=$query_i['i'].". ".$query_i['nm_barang'];
		$dat_j=$query_j['j'].". ".$query_j['nm_barang'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'akun' => array( 
						'label'=>'AKUN',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef1' id='ef1' value='".$dat_f1."' style='width:490px;' readonly>
						<input type ='hidden' name='f1' id='f1' value='".$query_f1['f1']."'>
						</div>", 
						 ),
		  
		  'kel' => array( 
						'label'=>'KELOMPOK',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef2' id='ef2' value='".$dat_f2."' style='width:490px;' readonly>
						<input type ='hidden' name='f2' id='f2' value='".$query_f2['f2']."'>
						</div>", 
						 ),
			'JENIS' => array( 
						'label'=>'JENIS',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ef' id='ef' value='".$dat_f."' style='width:490px;' readonly>
						<input type ='hidden' name='f' id='f' value='".$query_f['f']."'>
						</div>", 
						 ),
			'OBJEK' => array( 
						'label'=>'OBJEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$dat_g."' style='width:490px;' readonly>
						<input type ='hidden' name='g' id='g' value='".$query_g['g']."'>
						</div>", 
						 ),
			'RINOBJEK' => array( 
						'label'=>'RINCIAN OBJEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$dat_h."' style='width:490px;' readonly>
						<input type ='hidden' name='h' id='h' value='".$query_h['h']."'>
						</div>", 
						 ),
			'SUB_RINCIAN' => array( 
						'label'=>'SUB RINCIAN OBJEK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='en' id='en' value='".$dat_i."' style='width:490px;' readonly>
						<input type ='hidden' name='i' id='i' value='".$query_i['i']."'>
						</div>", 
						 ),
			
			
			'mapping' => array( 
						'label'=>'KODE MAPPING',
						'labelWidth'=>100, 
						'value'=>cmbArray('mapping',$dt['mapping'],$this->arrMapping3,'--PILIH--','style=width:130px;'), 
						 )	
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	
	
	
	function setFormEditdata1($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 490;
	 $this->form_height = 150;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'FORM EDIT KODE Rekening';
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
				
	
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  
			'Kode_Rincian_Objek' => array( 
						'label'=>'Kode Rincian Objek',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='eo' id='eo' value='".$datke."' style='width:20px;' readonly>
						<input type ='hidden' name='o' id='o' value='".$queryKEedit['o']."'>
						<input type='text' name='nm_rekening' id='nm_rekening' value='".$dt['nm_rekening']."' size='36px'>
						</div>", 
						 ),			 			 			 
									 
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
			
			"<input type='hidden' name='ke' id='ke' value='".$dt['ke']."'>".
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
		
	//daftar =================================
	/*function setKolomHeader($Mode=1, $Checkbox=''){
	$NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox		
	   <th class='th01' width='450'>Kode Barang</th>
	   <th class='th01' width='450' align='center'>Nama Barang</th>
	   <th class='th01' width='450' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}		*/
	
	function setKolomHeader($Mode=1, $Checkbox=''){
		$status_filter=$_REQUEST['status_filter'];
		$NomorColSpan = $Mode==1? 2: 1;
	 if ($status_filter==1){
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox		
	   <th class='th01' width='450'>Kode Barang</th>
	   <th class='th01' width='450' align='center'>Nama Barang</th>
	   <th class='th01' width='450' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	}else{	
	 $headerTable =
	  "<thead>
	   <tr>
  	  <th class='th01' width='5' >No.</th>
  	   $Checkbox
	   <th class='th02' colspan=2>Berita Acara</th>		
	   <th class='th01' width='450'>Kode Barang</th>
	   <th class='th01' width='450' align='center'>Nama Barang</th>
	   <th class='th01' width='450' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	 }
		return $headerTable;
	}	
	
	
	/*function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 $f = $isi['f'];
	 $g = $isi['g'];
	 $h = $isi['h'];
	 
	 $f1 = $isi['f1'];
	 $f2 = $isi['f2'];
	 $fb = $isi['fbaru'];
	 $gb = $isi['gbaru'];
	 $hb = $isi['hbaru'];
	 $ib = $isi['i'];
	 $jb = $isi['j'];
	 
	 if($isi['f1'] != '0'){
	  $kd=$f1;
	  }elseif($isi['f2'] != '0'){
	   $kd=$f1.'.'.$f2;
	   }elseif($isi['fb'] != '00'){
	   	$kd=$f1.'.'.$f2.'.'.$fb;
	   }elseif($isi['gb'] != '00'){
	   	$kd=$f1.'.'.$f2.'.'.$fb.'.'.$gb;
	   }elseif($isi['hb'] != '00'){
	   	$kd=$f1.'.'.$f2.'.'.$fb.'.'.$gb.'.'.$hb;
	   }elseif($isi['i'] != '00'){
	   $kd=$f1.'.'.$f2.'.'.$fb.'.'.$gb.'.'.$hb.'.'.$i;	
	   } elseif($isi['j'] != '00'){
	    $kd=$f1.'.'.$f2.'.'.$fb.'.'.$gb.'.'.$hb.'.'.$i.'.'.$j;
	  $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 $Koloms[] = array('align="left" width="5"',$kd);
	 $Koloms[] = array('align="left"',$isi['nm_barang']);
	 $Koloms[] = array('align="left"',$isi['mapping']);
	 
	 }else{
	 	
	 
	 if($isi['f'] != '00') $kd=$f;	
	 if($isi['g'] != '00' )$kd=$f.'.'.$g;	 
	 if($isi['h'] != '00') $kd=$f.'.'.$g.'.'.$h;
	 
	 
	 
	  $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 $Koloms[] = array('align="left" width="5"',$kd);
	 $Koloms[] = array('align="left"',$isi['nm_barang']);
	 $Koloms[] = array('align="left"',$isi['mapping']);
	 }
	 return $Koloms;
	}*/
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Ref;
		
		$status_filter=$_REQUEST['status_filter'];
	//	$kdbrg=mysql_fetch_array(mysql_query("select * from ref_barang where f='".$isi['f']."' and g='".$isi['g']."' and h='".$isi['h']."' and i='".$isi['i']."' and j='".$isi['j']."'"));
	
		if ($status_filter==$isi['f1']){
			$VFilter = "";
			$Koloms = array();	
	 		$Koloms[] = array('align="center"', $no.'.' );
	  	if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 		$Koloms[] = array('align="left" width="10px"',$isi['f1'].'.'.$isi['f2'].'.'.$isi['fbaru'].'.'.$isi['gbaru'].'.'.$isi['hbaru'].'.'.$isi['i'].'.'.$isi['j']	);
	 		$Koloms[] = array('align="left" width="1500px"',$isi['nm_barangbaru']);
		}else{
		
		/*if($isi['g'] == '00' ||  $isi['h'] == '00' ||  $isi['i'] == '000' ||  $isi['j'] == '0000' ){
	 	$margin = '';
		if($isi['g'] != '00') $margin = 'style="margin-left:15px;"';
		if($isi['h'] != '00') $margin = 'style="margin-left:25px;"';
		if($isi['i'] != '000') $margin = 'style="margin-left:30px;"';
		if($isi['j'] != '0000') $margin = 'style="margin-left:35px;"';*/
		
	 /*else{
	 	
		$margin = 'style="margin-left:40px;"';
	 }*/

	/* $f = $isi['f'];
	 $g = $isi['g'];
	 $h = $isi['h'];
	 $i = $isi['i'];
	 $j = $isi['j'];
	 if($isi['f'] != '00') $kd=$f;	
	 if($isi['g'] != '00' )$kd=$f.'.'.$g;	 
	 if($isi['h'] != '00') $kd=$f.'.'.$g.'.'.$h;
	 if($isi['i'] != '000') $kd=$f.'.'.$g.'.'.$h.'.'.$i;
	 if($isi['j'] != '0000') $kd=$f.'.'.$g.'.'.$h.'.'.$i.'.'.$j;*/
		
		
	 		$Koloms = array();
	 		$Koloms[] = array('align="center"', $no.'.' );
	 	if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 		$Koloms[] = array('align="left" width="10px"',$isi['f'].'.'.$isi['g'].'.'.$isi['h']);
	 		$Koloms[] = array('align="left" width="3000px"',"<span $margin>".$isi['nama']."</span>");
	 		$Koloms[] = array('align="left" width="250px"',$isi['satuan_terkecil']);
	 		
	 }
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	global $Ref, $Main;
		
	$fmGolongan1 = cekPOST('fmGolongan1');
	$fmBidang1 = cekPOST('fmBidang1');
	$fmKelompok1 = cekPOST('fmKelompok1');
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
			"<table width=\"100%\" class=\"adminform\">	<tr>		
			<td width=\"50%\" valign=\"top\"><h2>KODE BARANG LAMA</h2>			
			 <table style='width:100%'>
			<tr>
			<td style='width:150px'>GOLONGAN</td><td style='width:10px'>:</td>
			<td>".
			cmbQuery1("fmGolongan1",$fmGolongan1,"select f,nm_barang from ref_barang where f!='00' and g ='00' and h = '00'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>BIDANG</td><td>:</td>
			<td>".
			cmbQuery1("fmBidang1",$fmBidang1,"select g,nm_barang from ref_barang where f='$fmGolongan1' and g !='00' and h = '00' ","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>KELOMPOK</td><td>:</td>
			<td>".
			cmbQuery1("fmKelompok1",$fmKelompok1,"select h,nm_barang from ref_barang where f='$fmGolongan1' and g ='$fmBidang1' and h != '00'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr>
			<input type='hidden' id='status_filter' name='status_filter' value='$fmGolongan1'>
			</table>
			</td>
			<td width=\"50%\" valign=\"top\"><h2>KODE BARANG BARU</h2>			
			<table style='width:100%'>
			<tr>
			<td style='width:150px'>AKUN</td><td style='width:10px'>:</td>
			<td>".
			cmbQuery2("fmAKUN",$fmAKUN,"select f1,nm_barang from ref_barang_baru where f1!='0' and f2 ='0' and f = '00' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>KELOMPOK</td><td>:</td>
			<td>".
			cmbQuery2("fmKELOMPOK",$fmKELOMPOK,"select f2,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 !='0' and f = '00' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>JENIS</td><td>:</td>
			<td>".
			cmbQuery2("fmJENIS",$fmJENIS,"select f,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f != '00' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>OBJEK</td><td>:</td>
			<td>".
			cmbQuery2("fmOBJEK",$fmOBJEK,"select g,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f = '$fmJENIS' and g!='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr><tr>
			<td>RINCIAN OBJEK</td><td>:</td>
			<td>".
			cmbQuery2("fmRINOBJEK",$fmRINOBJEK,"select h,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f = '$fmJENIS' and g='$fmOBJEK' and h!='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr><tr>
			<td>SUB RINCIAN OBJEK</td><td>:</td>
			<td>".
			cmbQuery2("fmSUBRINOBJEK",$fmSUBRINOBJEK,"select i,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 ='$fmKELOMPOK' and f = '$fmJENIS' and g='$fmOBJEK' and h='$fmRINOBJEK' and i!='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr>
			<input type='hidden' id='status_filter' name='status_filter' value='$fmAKUN'>
			</table>
			</td>
			</table>".
			$OptCari.
			genFilterBar(
				array(	
					"<div style='float:left;padding: 0 4 0 0;height:22;padding: 4 4 0 0'>".
					cmb2D_v2('stmutasi', $stmutasi, $arrMutasi, '', 'Status Mutasi', '').
					"</div>".
					"<div  style='float:left;padding: 0 4 0 0;height:22;padding: 4 4 0 0'>".
					cmb2D_v2('staset', $staset, $Main->StatusAsetView, '','Semua Status Aset').
					"</div>".
					$BarisPerHalaman.
					'Urutkan : '.
					cmbArray('fmORDER1',$fmORDER1,$arrOrder,'--','').
					"<input type='checkbox' $fmDESC1 id='fmDESC1' name='fmDESC1' value='checked'>Desc."
				),$this->Prefix.".refreshList(true)",TRUE
			)
			;
		
		return array('TampilOpt'=>$TampilOpt);
		
	
	}
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
		$arrKondisi = array();	
		$fmPILCARI = $_REQUEST['fmPILCARI'];	
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
	 	$fmGolongan1 = cekPOST('fmGolongan1');
	 	$fmGolongan1 = cekPOST('fmGolongan1');
		$fmBidang1 = cekPOST('fmBidang1');
		$fmKelompok1 = cekPOST('fmKelompok1');
		$fmAKUN = cekPOST('fmAKUN');
	    $fmKELOMPOK = cekPOST('fmKELOMPOK');
		$fmJENIS = cekPOST('fmJENIS');
		$fmOBJEK = cekPOST('fmOBJEK');
		$fmRINOBJEK = cekPOST('fmRINOBJEK');
		$fmSUBRINOBJEK = cekPOST('fmSUBRINOBJEK');
		$fmKODE = cekPOST('fmKODE');
		$fmBARANG = cekPOST('fmBARANG');
		//Cari 
		$isivalue=explode('.',$fmPILCARIvalue);
		switch($fmPILCARI){			
			
			case 'selectKode': $arrKondisi[] = " concat(f1,'.',f2,'.',f,'.',g,'.',h,'.',i,'.',j) like '$fmPILCARIvalue%'"; break;
			case 'selectNama': $arrKondisi[] = " nm_barang like '%$fmPILCARIvalue%'"; break;	
										 	
		}	
		
		if(empty($fmGolongan1)) {
			$fmBidang1 = '';
			$fmKelompok1='';
		}
		
		if(empty($fmBidang1)) {
			$fmKelompok1 = '';
			
		}
		
				
		if(empty($fmAKUN)) {
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
		}		
		if(empty($fmGolongan1) && empty($fmBidang1) && empty($fmKelompok1))
		{
		}
		elseif(!empty($fmGolongan1) && empty($fmBidang1) && empty($fmKelompok1))
		{
			$arrKondisi[]= "f =$fmGolongan1";
		}
		elseif(!empty($fmGolongan1) && !empty($fmBidang1) && empty($fmKelompok1))
		{
			$arrKondisi[]= "f =$fmGolongan1 and g=$fmBidang1";			
		}
		elseif(!empty($fmGolongan1) && !empty($fmBidang1) && !empty($fmKelompok1))
		{
			//fiter 4 level dengan f1=1 f2=3 f=2
			$arrKondisi[]= "f =$fmGolongan1 and g=$fmBidang1 and h=$fmKelompok1";					
		}
		
		
		
		if(empty($fmAKUN) && empty($fmKELOMPOK) && empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
		}
		elseif(!empty($fmAKUN) && empty($fmKELOMPOK) && empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN";
		}
		elseif(!empty($fmAKUN) && !empty($fmKELOMPOK) && empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN and f2=$fmKELOMPOK";			
		}
		elseif(!empty($fmAKUN) && !empty($fmKELOMPOK) && !empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			//fiter 4 level dengan f1=1 f2=3 f=2
			$arrKondisi[]= "f1 =$fmAKUN and f2=$fmKELOMPOK and f=$fmJENIS and g!=00 and h=00 and i=00 and j=000";					
		}
		elseif(!empty($fmAKUN) && !empty($fmKELOMPOK) && !empty($fmJENIS) && !empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN and f2=$fmKELOMPOK and f=$fmJENIS and g=$fmOBJEK and h!=00 and i=00 and j=000";			
		}
		elseif(!empty($fmAKUN) && !empty($fmKELOMPOK) && !empty($fmJENIS) && !empty($fmOBJEK) && !empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN and f2=$fmKELOMPOK and f=$fmJENIS and g=$fmOBJEK and h=$fmRINOBJEK and i!=00 and j=000";	///filter 6 f1=1 f2=3 f=1		
		}
		elseif(!empty($fmAKUN) && !empty($fmKELOMPOK) && !empty($fmJENIS) && !empty($fmOBJEK) && !empty($fmRINOBJEK) && !empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN and f2=$fmKELOMPOK and f=$fmJENIS and g=$fmOBJEK and h=$fmRINOBJEK and i=$fmSUBRINOBJEK";			
		}
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
}
$ref_kode_barang_mapping = new ref_kode_barang_mappingObj();
?>