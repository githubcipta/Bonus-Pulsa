<?php

class ref_barang_baruObj  extends DaftarObj2{	
	var $Prefix = 'ref_barang_baru';
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
	var $FormName = 'ref_barang_baruForm';
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
			 <script type='text/javascript' src='js/master/ref_barang_baru/".strtolower($this->Prefix).".js' language='JavaScript' ></script>
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
			$fm = $this->setFormEditlvl4($dt);
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
	function setKolomHeader($Mode=1, $Checkbox=''){
	$NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox		
	   <th class='th01' width='200' colspan='7'>Kode Barang</th>
	   <th class='th01' width='450' align='center'>Nama Barang</th>
	   <th class='th01' width='450' align='center'>Kode Mapping</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}		
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	
	if ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] =='01' && $isi['g'] =='01'&& $isi['h'] =='01' && $isi['i'] !='00' && $isi['j'] =='000'){// 4 level
		$TampilCheckBox = $TampilCheckBox;
	 }elseif ($isi['f1'] == '1' && $isi['f2'] =='3' && $isi['f'] =='02' && $isi['g'] =='00'&& $isi['h'] =='00' && $isi['i'] =='00' && $isi['j'] =='000'){// 4 level
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
	
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 $Koloms[] = array('align="center"',genNumber($isi['f1'],1));
	 $Koloms[] = array('align="center"',genNumber($isi['f2'],1));
	 $Koloms[] = array('align="center"',genNumber($isi['f'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['g'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['h'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['i'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['j'],3));
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
	$fmAKUN = $_REQUEST ['fmAKUN'];	 
	$fmKelompok = $_REQUEST ['fmKelompok'];	 
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
	$fmAKUN=mysql_fetch_array(mysql_query("select f1,nm_barang from ref_barang_baru where f1!='0' and f2 ='0' and f = '00' and g='00' and h='00' and i='00' and j='000'" ));			
	$fmKelompok=mysql_fetch_array(mysql_query("select f2,nm_barang from ref_barang_baru where f1='".$fmAKUN['f1']."' and f2 !='0' and f = '00' and g='00' and h='00' and i='00' and j='000'" )); $cek.="select f2,nm_barang from ref_barang_baru where f1='$fmAKUN' and f2 !='0' and f = '00' and g='00' and h='00' and i='00' and j='000'";			
	$TampilOpt = 
			
			"<div class='FilterBar'>".
			
			"<table style='width:100%'>
			<tr>
			<td style='width:150px'>AKUN</td><td style='width:10px'>:</td>
			<td>
				<input type='text' name='' id='' value='".$fmAKUN['f1'].".".$fmAKUN['nm_barang']."' size='30' readonly>
				<input type ='hidden' name='fmBidang' id='fmBidang' value='".$fmAKUN['f1']."' readonly></td>
			</tr><tr>
			<td>KELOMPOK</td><td>:</td>
			<td>
				<input type='text' name='' id='' value='".$fmKelompok['f2'].".".$fmKelompok['nm_barang']."' size='30' readonly>
				<input type ='hidden' name='fmKelompok' id='fmKelompok' value='".$fmKelompok['f2']."' readonly></td>
			</tr><tr>
			<td>JENIS</td><td>:</td>
			<td>".
			cmbQuery1("fmJENIS",$fmJENIS,"select f,nm_barang from ref_barang_baru where f1='1' and f2 ='3' and f!='00' and f <= '05' and g='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
			</tr><tr>
			<td>OBJEK</td><td>:</td>
			<td>".
			cmbQuery1("fmOBJEK",$fmOBJEK,"select g,nm_barang from ref_barang_baru where f1='1' and f2 ='3' and f = '$fmJENIS' and g!='00' and h='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr><tr>
			<td>RINCIAN OBJEK</td><td>:</td>
			<td>".
			cmbQuery1("fmRINOBJEK",$fmRINOBJEK,"select h,nm_barang from ref_barang_baru where f1='1' and f2 ='3' and f = '$fmJENIS' and g='$fmOBJEK' and h!='00' and i='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
			"</td>
				</tr><tr>
			<td>SUB RINCIAN OBJEK</td><td>:</td>
			<td>".
			cmbQuery1("fmSUBRINOBJEK",$fmSUBRINOBJEK,"select i,nm_barang from ref_barang_baru where f1='1' and f2 ='3' and f = '$fmJENIS' and g='$fmOBJEK' and h='$fmRINOBJEK' and i!='00' and j='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
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
	 	$fmAKUN = $_REQUEST['fmAKUN'];
	    $fmKELOMPOK = $_REQUEST['fmKELOMPOK'];
		/*$fmAKUN = cekPOST('fmAKUN');
	    $fmKELOMPOK = cekPOST('fmKELOMPOK');*/
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
		}*/
		
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
		
		if(empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
		}
		/*elseif(!empty($fmAKUN) && empty($fmKELOMPOK) && empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN";
		}
		elseif(!empty($fmAKUN) && !empty($fmKELOMPOK) && empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 =$fmAKUN and f2=$fmKELOMPOK";			
		}*/
		elseif(!empty($fmJENIS) && empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			//fiter 4 level dengan f1=1 f2=3 f=2
			$arrKondisi[]= "f1 ='1' and f2='3' and f=$fmJENIS and g!=00 and h=00 and i=00 and j=000";					
		}
		elseif(!empty($fmJENIS) && !empty($fmOBJEK) && empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 ='1' and f2='3' and f=$fmJENIS and g=$fmOBJEK and h!=00 and i=00 and j=000";			
		}
		elseif(!empty($fmJENIS) && !empty($fmOBJEK) && !empty($fmRINOBJEK) && empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 ='1' and f2='3' and f=$fmJENIS and g=$fmOBJEK and h=$fmRINOBJEK and i!=00 and j=000";	///filter 6 f1=1 f2=3 f=1		
		}
		elseif(!empty($fmJENIS) && !empty($fmOBJEK) && !empty($fmRINOBJEK) && !empty($fmSUBRINOBJEK))
		{
			$arrKondisi[]= "f1 ='1' and f2='3' and f=$fmJENIS and g=$fmOBJEK and h=$fmRINOBJEK and i=$fmSUBRINOBJEK";			
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
$ref_barang_baru = new ref_barang_baruObj();
?>