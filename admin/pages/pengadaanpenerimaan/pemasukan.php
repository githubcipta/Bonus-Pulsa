<?php

class pemasukanObj  extends DaftarObj2{	
	var $Prefix = 'pemasukan';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'v1_penerimaan_barang'; //bonus
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
	var $Cetak_WIDTH = '21cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'pemasukanForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0
	var $pid = '';
	
	function setTitle(){
		return 'DAFTAR PENGADAAN DAN PENERIMAAN BARANG';
	}
	
	function setMenuEdit(){
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".InputBaru()","sections.png","Baru", 'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Atribusi", 'Atribusi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Distribusi", 'Distribusi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Validasi", 'Validasi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","new_f2.png","Posting", 'Posting')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","export_xls.png","Excel", 'Excel')."</td>";
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
	  
	 if( $err=='' && $nama =='' ) $err= 'Satuan Belum Di Isi !!';
	 
			if($fmST == 0){
				if($err==''){
					$aqry = "INSERT into ref_satuan (nama)values('$nama')";	$cek .= $aqry;	
					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){
				$aqry = "UPDATE ref_satuan set nama='$nama' WHERE Id='".$idplh."'";	$cek .= $aqry;
						$qry = mysql_query($aqry) or die(mysql_error());
					}
			} //end else
					
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
		
		case 'hapus':{
			$get= $this->Hapus();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
		}
		
		case 'CetakPermohonan': {
			$json=FALSE;		
			$this->CetakPermohonan();
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
			"<script type='text/javascript' src='js/skpd.js' language='JavaScript' ></script>".		
			"<script type='text/javascript' src='js/pengadaanpenerimaan/".strtolower($this->Prefix).".js' language='JavaScript' ></script>".
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
	return '';
			/*"<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='margin:0 0 0 0'>
	<tr><td class=\"menudottedline\" width=\"40%\" height=\"20\" style='text-align:right'><B>
	<A href=\"pages.php?Pg=satuan\" title='Satuan' style='color:blue' >PENGADAAN DAN PENERIMAAN</a> 
	&nbsp&nbsp&nbsp	
	</td></tr></table>";*/
	}
		
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
		 $cek.= $this->BersihkanData();
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
	  	   <th class='th01' width='5' rowspan='2'>No.</th>
	  	   $Checkbox		
		   <th class='th01' rowspan='2'>TANGGAL</th>
		   <th class='th01' rowspan='2'>ID PENERIMAAN</th>
		   <th class='th02' colspan='2'>DOKUMEN SUMBER</th>
		   <th class='th01' rowspan='2'>SUMBER DANA/ MEKANISME</th>
		   <th class='th01' rowspan='2'>NAMA BARANG</th>
		   <th class='th01' rowspan='2'>MERK / TYPE/ SPESIFIKASI/ LOKASI</th>
		   <th class='th01' rowspan='2'>JUMLAH</th>
		   <th class='th01' rowspan='2'>HARGA BELI</th>
		   <th class='th01' rowspan='2'>JUMLAH HARGA</th>
		   <th class='th01' rowspan='2'>HARGA ATRIBUSI</th>
		   <th class='th01' rowspan='2'>HARGA SATUAN PEROLEHAN</th>
		   <th class='th01' rowspan='2'>JUMLAH HARGA PEROLEHAN</th>
		   <th class='th02' colspan='2'>STATUS</th>
		   <th class='th01' rowspan='2'>VALID</th>
		   <th class='th01' rowspan='2'>POST</th>
		   <th class='th01' rowspan='2'>KET.</th>
	   </tr>
	   <tr>
	   		<th class='th01'>NAMA</th>
	   		<th class='th01'>NOMOR</th>
	   		<th class='th01'>ATRIB</th>
	   		<th class='th01'>DISTRI</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 $tgl_buku = explode("-",$isi['tgl_buku']);
	 $tgl_buku = $tgl_buku[2]."-".$tgl_buku[1]."-".$tgl_buku[0];
	 	
		//DOKUMEN SUMBER
		switch($isi['dokumen_sumber']){
			case '1' : $doksum = 'BAST';break;
			case '2' : $doksum = 'BAKF';break;
			case '3' : $doksum = 'BA HIBAH';break;
			case '4' : $doksum = 'SURAT KEPUTUSAN';break;
		}
		
		//NAMA BARANG
		
		if($isi['jns_trans'] == '1'){
			$namabarang = "SELECT nm_barang FROM ref_barang WHERE f1='".$isi['f1']."' AND f2='".$isi['f2']."'  AND f='".$isi['f']."'  AND g='".$isi['g']."' AND h='".$isi['h']."' AND i='".$isi['i']."' AND j='".$isi['j']."' LIMIT 0,1";
		}
		
		$qry = mysql_fetch_array(mysql_query($namabarang));
		
		//DISTRIBUSI
		$brgdistribusi = 'TDK';
		if($isi['barangdistribusi'] == '1')$brgdistribusi='YA';
		
		//DISTRIBUSI
		$atribusi = 'TDK';
		if($isi['biayaatrib'] == '1')$atribusi='YA';
		
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	 
	if($this->pid != $isi['Id']){
	  if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
	 $Koloms[] = array('align="center" style="width:70px;"',$tgl_buku);
	 $Koloms[] = array('align="center"',"<h7 title='".$isi['id_penerimaan']."'>".substr($isi['id_penerimaan'],0,5)."...</h7>");
	 $Koloms[] = array('align="left"',$doksum);
	 $Koloms[] = array('align="left"',"<h7 title='".$isi['no_dokumen_sumber']."' >".substr($isi['no_dokumen_sumber'],0,5)."...</h7>");
	 $Koloms[] = array('align="left"',$isi['sumber_dana']);
	}else{
	 $Koloms[] = array('align="center"','');
	 $Koloms[] = array('align="center"','');
	 $Koloms[] = array('align="center"','');
	 $Koloms[] = array('align="left"','');
	 $Koloms[] = array('align="left"',"");
	 $Koloms[] = array('align="left"',"");
	}
	 $Koloms[] = array('align="left"',$qry['nm_barang']);
	 $Koloms[] = array('align="left"',$isi['ket_barang']);
	 $Koloms[] = array('align="right"',number_format($isi['jml'],0,".",","));
	 $Koloms[] = array('align="right"',number_format($isi['harga_satuan'],2,",","."));
	 $Koloms[] = array('align="right"',number_format($isi['harga_total'],2,",","."));
	 $Koloms[] = array('align="left"',"Harga Atribusi");
	 $Koloms[] = array('align="left"',"Harga Perolehan");
	 $Koloms[] = array('align="left"',"Jml Harga Perolehan");
	 $Koloms[] = array('align="center"',$brgdistribusi);
	 $Koloms[] = array('align="center"',$atribusi);
	 $Koloms[] = array('align="center"',"<input type='checkbox' name='valid' value='".$isi['Id']."' />");
	 $Koloms[] = array('align="center"',"<input type='checkbox' name='posting' value='".$isi['Id']."' />");
	 $Koloms[] = array('align="left"',$isi['keterangan']);
	 
	 $this->pid = $isi['Id'];
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	 global $Ref, $Main;
	 
	 $arr = array(
			//array('selectAll','Semua'),	
			array('selectSatuan','Satuan'),		
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
	
	$TampilOpt =
			//<table width=\"100%\" class=\"adminform\">
			"<tr><td>".
			$vOrder=
				"<table width=\"100%\" class=\"adminform\">	<tr>		
				<td width=\"100%\" valign=\"top\">" . 
					WilSKPD_ajxVW($this->Prefix.'SKPD') . 
				"</td>
				<td valign='top'>" . 		
				"</td></tr>
				<!--<tr><td>
					<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>
				</td></tr>			-->
				</table>"
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
		//cari tgl,bln,thn
		$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];			
		$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
		$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
		
		
		//Cari 
		$arrKondisi[] = " sttemp ='0' ";
		$arrKondisi[] = " sttemp_det ='0' ";
		
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
			"</table>
			
			".
			/*'<script src="assets2/js/bootstrap.min.js"></script>'.
			'<script src="assets2/jquery.min.js"></script>'.*/
			"</body>
		</html>"; 
	}
	
	function BersihkanData(){
		$cek='';
		//Penerimaan Rekening
		$hapusrek = "DELETE FROM t_penerimaan_rekening WHERE tgl_update < DATE_SUB(NOW(), INTERVAL 2 HOURS) AND sttemp='1'"; $cek.="| ".$hapusrek;
		$qry_hapusrek = mysql_query($hapusrek);
		
		$updrek = "UPDATE t_penerimaan_rekening SET status='0' WHERE tgl_update < DATE_SUB(NOW(), INTERVAL 45 MINUTE) AND sttemp='0'";$cek.="| ".$updrek;
		$qry_updrek = mysql_query($updrek);		
					
					
		//Penerimaan Detail -----------------------------------------------------------------------------------
		$hapuspenerimaan_det = "DELETE FROM t_penerimaan_barang_det WHERE tgl_update < DATE_SUB(NOW(), INTERVAL 2 HOURS) AND sttemp='1'"; $cek.="| ".$hapuspenerimaan_det;
		$qry_hapuspenerimaan_det	= mysql_query($hapuspenerimaan_det);
		
		$updpenerimaan_det =  "UPDATE t_penerimaan_barang_det SET status='0' WHERE tgl_update < DATE_SUB(NOW(), INTERVAL 45 MINUTE) AND sttemp='0'"; $cek.='| '.$updpenerimaan_det;
		
		$qry_updpenerimaan_det = mysql_query($updpenerimaan_det);		
					
		//Penerimaan ------------------------------------------------------------------------------------------
		$hapus_penerimaan = "DELETE FROM t_penerimaan_barang WHERE tgl_create < DATE_SUB(NOW(), INTERVAL 2 DAY) AND sttemp='1'"; $cek.="| ".$hapus_penerimaan;		
		$qry_hapus_penerimaan = mysql_query($hapus_penerimaan);
		
		
		return $cek;
	}
	
	function Hapus($ids){ //validasi hapus ref_pegawai
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		
		
		for($i = 0; $i<count($ids); $i++)	{
			//Hapus Rekening
			$hapusrek = "DELETE FROM t_penerimaan_rekening WHERE refid_terima ='".$ids[$i]."'"; $cek.="| ".$hapusrek;
			$qry_hapusrek = mysql_query($hapusrek);
			//Hapus Penerimaan Detail
			$hapuspenerimaan_det = "DELETE FROM t_penerimaan_barang_det WHERE refid_terima ='".$ids[$i]."' "; $cek.="| ".$hapuspenerimaan_det;
			$qry_hapuspenerimaan_det	= mysql_query($hapuspenerimaan_det);
			
			//Hapus Penerimaan
			$hapus_penerimaan = "DELETE FROM t_penerimaan_barang WHERE Id='".$ids[$i]."'"; $cek.="| ".$hapus_penerimaan;		
			$qry_hapus_penerimaan = mysql_query($hapus_penerimaan);
			
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function CetakPermohonan($xls= FALSE, $Mode=''){
		global $Main;
		$id=$_REQUEST['idnya'];
		/*
		<style>
		.nfmt1 {mso-number-format:'\#\,\#\#0_\)\;\[Red\]\\(\#\,\#\#0\\)';}
		.nfmt2 {mso-number-format:'0\.00_';}
		.nfmt3 {mso-number-format:'00000';}
		.nfmt4 {mso-number-format:'\#\,\#\#0.00_\)\;\[Red\]\\(\#\,\#\#0\\)';}
		.nfmt5 {mso-number-format:'\@';} 
		table {mso-displayed-decimal-separator:'\.';
			mso-displayed-thousand-separator:'\,';}	
		br {mso-data-placement:same-cell;}	
		</style>*/ 	
		//if($this->cetak_xls){
		if($xls){
			header("Content-type: application/msexcel");
			header("Content-Disposition: attachment; filename=$this->fileNameExcel");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		
		
		//$css = $this->cetak_xls	? 
		$css = $xls	? 
			"<style>
			.nfmt5 {mso-number-format:'\@';}			
			</style>":
			"<link rel=\"stylesheet\" href=\"css/template_css.css\" type=\"text/css\" />";
		echo 
			"<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
				</head>".
			"<body >
			<form name='adminForm' id='pemasukanForm' method='post' action=''>
			<div style='width:$this->Cetak_WIDTH'>
			<table class=\"rangkacetak\" style='width:$this->Cetak_WIDTH;font-family:Times New Roman;'>
			<tr><td valign=\"top\">
				<div style='text-align:center;'>
				<span style='font-size:16px;font-weight:bold;text-decoration: underline;'>
					SURAT PERMOHONAN VALIDASI INPUT DATA
				</span><br>
				ID DATA : ".$_REQUEST['idnya']."</div><br>
				<div style='font-size:14px;'>
					<p><b>Kepada Yth ;</b></p>
					<p>Bidang Aset</p>
					<p>BPKAD</p>
					<p>Jl. …….</p>
					<p>Pemerintah Kota…</p><br>
					Perihal : Permohonan Validasi Data<br><br>
					<p style='text-align: justify;'>
					Bersama surat ini kami sampaikan bahwa Nama SKPD telah melakukan input data Pengadaan Barang pada aplikasi aset NamaAplikasi dengan rincian data barang sebagai berikut :</p>
					<table width='100%' border='1'>
						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Merk/Type/Spek/Judul/Lokasi</th>
							<th>Jml</th>
							<th>Jumlah Harga (Rp)</th>
						</tr>
					</table>
				</div>
				".
				//$this->cetak_xls.		
				//$this->setCetak_HeaderBA($Mode,2).//$this->Cetak_Header.//
				
				"<div id='cntTerimaKondisi'>".
				"</div>
				<div id='cntTerimaDaftar' >";
			
				
		echo	"</div>	".			
				//$this->setcetakfooterformat($xls).
				
			"</td></tr>
			</table>
			</div>
			</form>		
			</body>	
			</html>";
	}
		
}
$pemasukan = new pemasukanObj();
?>