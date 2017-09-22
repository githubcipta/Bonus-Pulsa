<?php

class ref_sotk_baruObj extends DaftarObj2{
	var $Prefix = 'ref_sotk_baru';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_skpd_baru'; //daftar
	var $TblName_Hapus = 'ref_skpd_baru';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('c1','c2','d2','e2','e12');
	var $FieldSum = array();
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = 'Referensi SOTK Baru';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	var $cetak_xls=TRUE ;
	var $fileNameExcel='usulansk.xls';
	var $Cetak_Judul = 'REFERENSI SOTK BARU';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'ref_sotk_baruForm'; 
	
	
	function setTitle(){
		global $Main;
		return 'REFERENSI SOTK BARU';	

	}
	
	function setNavAtas(){
		return
			/*'<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
			<td class="menudottedline" width="60%" height="20" style="text-align:right"><b>
				<a href="pages.php?Pg=lra" title="Daftar LRA">DAFTAR LRA</a> 
				  &nbsp;&nbsp;&nbsp;
			</b></td>
			</tr>
			</table>';	*/"";
	}
	
	function setMenuEdit(){		
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","new_f2.png","Baru",'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus').
			"</td>";
	}
	
	function setMenuView(){		
		return 			
			"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakHal(\"$Op\")","print_f2.png",'Halaman',"Cetak Daftar per Halaman")."</td>";			
			//"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakAll(\"$Op\")","print_f2.png",'Cetak',"Cetak Daftar")."</td>".
		//	"<td>".genPanelIcon("javascript:".$this->Prefix.".exportXls(\"$Op\")","export_xls.png",'Excel',"Export Excel")."</td>";					

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
				$aqry = "INSERT into ref_skpd_baru (c1,c2,d2,e2,e12,nm_skpd,nm_barcode) values('$dtc1','00','00','00','000','$nama','-')";	
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
		$dtc= $_REQUEST['c2'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Bidang Belum Di Isi !!';
		if($fmST == 0){
			if($err==''){
				$aqry = "INSERT into ref_skpd_baru (c1,c2,d2,e2,e12,nm_skpd,nm_barcode) values('$dtc1','$dtc','00','00','000','$nama','-')";	
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
		$dtc= $_REQUEST['c2'];
		$dtd= $_REQUEST['d2'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Bidang Belum Di Isi !!';
		if($fmST == 0){
			if($err==''){
				$aqry = "INSERT into ref_skpd_baru (c1,c2,d2,e2,e12,nm_skpd,nm_barcode) values('$dtc1','$dtc','$dtd','00','000','$nama','-')";	
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
		$dtc= $_REQUEST['c2'];
		$dtd= $_REQUEST['d2'];
		$dte= $_REQUEST['e2'];
		$nama= $_REQUEST['nama'];
	if( $err=='' && $nama =='' ) $err= 'Nama Kode Unit Belum Di Isi !!';
		
			if($err==''){
				$aqrykd = "INSERT into ref_skpd_baru (c1,c2,d2,e2,e12,nm_skpd,nm_barcode) values('$dtc1','$dtc','$dtd','$dte','000','$nama','-')";	
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
		
	$aqry = "UPDATE ref_skpd_baru set c1='$dk',c2='$dl',d2='$dm',e2='$dn',e12='$do',nm_skpd='$nama', nm_barcode='$barcode' where concat (c1,' ',c2,' ',d2,' ',e2,' ',e12)='".$idplh."'";$cek .= $aqry;
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
	 $kode0 = $_REQUEST['fmc1'];
     $kode1= $_REQUEST['fmc'];
	 $kode2= $_REQUEST['fmd'];
	 $kode3= $_REQUEST['fme'];
	 $kode4= $_REQUEST['e1'];
	 $nama_skpd = $_REQUEST['nama'];
	 $nama_barcode = $_REQUEST['barcode'];
	
	 
	
	 if( $err=='' && $kode0 =='' ) $err= 'Kode Urusan Belum Di Isi !!';
	 if( $err=='' && $kode1 =='' ) $err= 'Kode Bidang Belum Di Isi !!';
	 if( $err=='' && $kode2 =='' ) $err= 'Kode SKPD Belum Di Isi !!';
	 if( $err=='' && $kode3 =='' ) $err= 'Kode UNIT Belum Di Isi !!';
	 if( $err=='' && $kode4 =='' ) $err= 'Kode SUB UNIT Belum Di Isi !!';
	 if( $err=='' && $nama_skpd =='' ) $err= 'nama skpd Belum Di Isi !!';
	// if( $err=='' && $nama_barcode =='') $err= 'nama barcode Belum Di Isi !!';
	 
	 	
	
	 
			if($fmST == 0){
			/*$ck1=mysql_fetch_array(mysql_query("Select * from ref_skpd_baru where c1= '$kode0' and c2='$kode1' and d2 ='$kode2' and e2 ='$kode3' and e12='$kode4'"));
			if ($ck1>=1)$err= 'Gagal Simpan'.mysql_error();*/
				if($err==''){
					$aqry = "INSERT into ref_skpd_baru (c1,c2,d2,e2,e12,nm_skpd,nm_barcode) values('$kode0','$kode1','$kode2','$kode3','$kode4','$nama_skpd','$nama_barcode')";	$cek .= $aqry;	
					$qry = mysql_query($aqry);
				}
			}else{						
				if($err==''){
				$aqry = "UPDATE ref_skpd SET nm_skpd='$nama_skpd', nm_barcode='$nama_barcode',nm_skpd_singkatan='$nm_skpd_singkatan',alamat='$alamat',kota='$kota',nm_kop_surat='$nmkopsurata',no_telp_fax='$fax' WHERE c1='$kode0' and c='$kode1' and d='$kode2' and e='$kode3' and e1='$kode4'";	$cek .= $aqry;
						$qry = mysql_query($aqry) or die(mysql_error());
			
					}
			
			} //end else
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	
	function genDaftarOpsi(){
		global $Ref,$Main,$fmFiltThnBuku;
		Global $fmSKPDBidang,$fmSKPDskpd;
		 $fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		 $fmSKPDBidang = cekPOST('fmSKPDBidang');
		 $fmSKPDskpd = cekPOST('fmSKPDskpd');
		 $fmSKPDUnit = cekPOST('fmSKPDUnit');
		 $fmSKPDSubUnit = cekPOST('fmSKPDSubUnit');
		$stmutasi = $_REQUEST['stmutasi'];
		$staset = $_REQUEST['staset'];
		$jmPerHal = $_REQUEST['jmPerHal']==''?$Main->PagePerHal:$_REQUEST['jmPerHal'];
		$fmCariComboField = $_REQUEST['fmCariComboField'];
		$fmCariComboIsi = $_REQUEST['fmCariComboIsi'];
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');
		$arrMutasi = array(
					array("1","Belum Mutasi"),
					array("2","Sudah Mutasi"),
				);
		
		$ArFieldCari = array(
				array('nm_barang', 'Nama Barang'),
				array('kd_barang', 'Kode Barang'),
				array('thn_perolehan', 'Tahun Perolehan'),
				//array('ket', 'Keterangan')
					);
		
		 $arrOrder = array(
	  	          array('1','Kode SKPD'),
			     	array('2','Nama SKPD'),
					);
		$arr = array(
			//array('selectAll','Semua'),	
			array('selectKode','Kode SKPD'),	
			array('selectNama','Nama SKPD'),		
			);			
		
		$OptCari =  //$Main->ListData->OptCari =
			"<table width=\"100%\" height=\"100%\" class=\"adminform\" style='margin: 4 0 0 0;'>
			<tr > 
			<td align='Left'> &nbsp;&nbsp;".
			"<div style='float:left'>".
				CariCombo4($ArFieldCari, $fmCariComboField, $fmCariComboIsi,"ref_skpd_baru.refreshList(true)" ).
			"</div>".
			"<div id='".$this->prefix."_pilihan_msg' style='float:right;padding: 4 4 4 8;'></div>".
			"</td>".
			"<td width='375'>".
				/*"<span style='color:red'>BARCODE</span><br>			
				<input type='TEXT' value='' 
					id='barcodeSensus_input' name='barcodeSensus_input'
					style='font-size:24;width: 379px;' 
					size='28' maxlength='28'>
				<span id='barcodeSensus_msg' name='barcodeSensus_msg' ></span>". 
				*/
				$barcodeCari.
				
					
				//<input type='TEXT' value='' 	style='	font-weight:bold' 	size='50'	>-->
			"</td>
			</tr>
		</table>";
		
		$BarisPerHalaman = 		
			"<div style='float:left;padding: 2 8 0 0;height:20;padding: 4 4 0 0'> ".	
			" Baris per halaman <input type=text name='jmPerHal' id='jmPerHal' size=4 value='$jmPerHal'> </div>"
			;
		
		$TampilOpt =
				"<table width=\"100%\" class=\"adminform\">	
				<tr><td width='100'>URUSAN</td><td width='10'>:</td><td>".
						cmbQuery("fmSKPDUrusan",$fmSKPDUrusan,"SELECT c1,concat(c1, '. ', nm_skpd) as vnama FROM ref_skpd_baru where c1!='0' and c2='00' and d2='00' and e2='00' and e12='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
						
						
						
						/*$this->cmbQueryUrusan('fmSKPDUrusan',$fmSKPDUrusan,'','onchange=ref_sotk_baru.UrusanAfter() '.$disabled1,'--- Pilih URUSAN ---','00').*/"</td></tr>
					<tr><td>BIDANG</td><td >:</td><td>".
						cmbQuery("fmSKPDBidang",$fmSKPDBidang,"SELECT c2,concat(c2, '. ', nm_skpd) as vnama FROM ref_skpd_baru where c1='$fmSKPDUrusan' and c2!='00' and d2='00' and e2='00' and e12='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
						
						
						/*$this->cmbQueryBidang('fmSKPDBidang2',$fmSKPDBidang2,'','onchange=ref_sotk_baru.BidangAfter2() '.$disabled1,'--- Pilih BIDANG ---','00').*/"</td></tr>".
					"<tr><td>SKPD</td><td >:</td><td>".
						
						cmbQuery("fmSKPDskpd",$fmSKPDskpd,"SELECT d2,concat(d2, '. ', nm_skpd) as vnama FROM ref_skpd_baru where c1='$fmSKPDUrusan' and c2='$fmSKPDBidang' and d2!='00' and e2='00' and e12='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
						
						/*$this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=ref_sotk_baru.SKPDAfter2() '.$disabled1,'--- Pilih SKPD ---','00').*/
					"</td></tr>".
					"<tr><td>UNIT</td><td >:</td><td>".
						
						cmbQuery("fmSKPDUnit",$fmSKPDUnit,"SELECT e2,concat(e2, '. ', nm_skpd) as vnama FROM ref_skpd_baru where c1='$fmSKPDUrusan' and c2='$fmSKPDBidang' and d2='$fmSKPDskpd' and e2!='00' and e12='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
						
						//$this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=ref_sotk_baru.UnitAfter2() '.$disabled1,'--- Pilih UNIT ---','00').
					"</td></tr>".
					"<tr><td>SUB UNIT</td><td >:</td><td>".
						
						
						cmbQuery("fmSKPDSubUnit",$fmSKPDSubUnit,"SELECT e12,concat(e12, '. ', nm_skpd) as vnama FROM ref_skpd_baru where c1='$fmSKPDUrusan' and c2='$fmSKPDBidang' and d2='$fmSKPDskpd' and e2='$fmSKPDUnit' and e12!='000'","onChange=\"$this->Prefix.refreshList(true)\"",'Pilih','').
					//	$this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'',''.$disabled1,'--- Pilih SUB UNIT ---','000').
			"</td>
			<td >" . 		
			"</td></tr>
			<!--<tr><td>
				<input type='button' id='btTampil' value='Tampilkan' onclick='".$this->Prefix.".refreshList(true)'>
			</td></tr>			-->
			</table>".
				
					
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
		/*$ref_skpdSkpdfmUrusan = $_REQUEST['fmSKPDUrusan'];
		$ref_skpdSkpdfmSKPD = $_REQUEST['fmSKPDBidang2'];//ref_skpdSkpdfmSKPD
		$ref_skpdSkpdfmUNIT = $_REQUEST['fmSKPDskpd2'];
		$ref_skpdSkpdfmSUBUNIT = $_REQUEST['fmSKPDUnit2'];
		$ref_skpdSkpdfmSEKSI = $_REQUEST['fmSKPDSubUnit2'];*/
		
		$c1 = $_REQUEST['fmSKPDUrusan'];
		$c = $_REQUEST['fmSKPDBidang'];
		$d = $_REQUEST['fmSKPDskpd'];
		$e = $_REQUEST['fmSKPDUnit'];
		$e1 = $_REQUEST['fmSKPDSubUnit'];
		
		if(empty($c1)) {
			$c= '';
			$d='';
			$e='';
			$e1='';
		}
		
		if(empty($c)) {
			$d='';
			$e='';
			$e1='';
		}
		
		if(empty($d)) {
			$e='';
			$e1='';
		}
		
		if(empty($e)) {
			$e1='';
		}
		
		if(empty($c1) && empty($c) && empty($d) && empty($e)  && empty($e1))
		{
			
		}
		
		elseif(!empty($c1) && empty($c) && empty($d) && empty($e) && empty($e1))
		{
			$arrKondisi[]= "c1='$c1'";		
		}
		
		elseif(!empty($c1) && !empty($c) && empty($d) && empty($e) && empty($e1))
		{
			$arrKondisi[]= "c1='$c1' and c2='$c'";		
		}
		
		elseif(!empty($c1) && !empty($c) && !empty($d) && empty($e) && empty($e1))
		{
			$arrKondisi[]= "c1='$c1' and c2='$c' and d2='$d'";		
		}
		
		elseif(!empty($c1) && !empty($c) && !empty($d) && !empty($e) && empty($e1))
		{
			$arrKondisi[]= "c1='$c1' and c2='$c' and d2='$d' and e2='$e'";		
		}
		
		elseif(!empty($c1) && !empty($c) && !empty($d) && !empty($e) && !empty($e1))
		{
			$arrKondisi[]= "c1='$c1' and c2='$c' and d2='$d' and e2='$e' and e12='$e1'";		
		}
		
		
		//Cari 
		$isivalue=explode('.',$fmPILCARIvalue);
		switch($fmPILCARI){			
			
			case 'selectKode': $arrKondisi[] = " concat(c1,'.',c2,'.',d2,'.',e2,'.',e12) like '$fmPILCARIvalue%'"; break;
			case 'selectNama': $arrKondisi[] = " nm_skpd like '%$fmPILCARIvalue%'"; break;	
								 	
		}	
		/*if($ref_skpdSkpdfmUrusan!='0' and $ref_skpdSkpdfmUrusan !='' and $ref_skpdSkpdfmUrusan!='0'){
			$arrKondisi[]= "c1='$ref_skpdSkpdfmUrusan'";
			if($ref_skpdSkpdfmSKPD!='00' and $ref_skpdSkpdfmSKPD !='')$arrKondisi[]= "c2='$ref_skpdSkpdfmSKPD'";
			if($ref_skpdSkpdfmUNIT!='00' and $ref_skpdSkpdfmUNIT !='')$arrKondisi[]= "d2='$ref_skpdSkpdfmUNIT'";
			if($ref_skpdSkpdfmSUBUNIT!='00' and $ref_skpdSkpdfmSUBUNIT !='')$arrKondisi[]= "e2='$ref_skpdSkpdfmSUBUNIT'";
			if($ref_skpdSkpdfmSEKSI!='00' and $ref_skpdSkpdfmSEKSI !='')$arrKondisi[]= "e12='$ref_skpdSkpdfmSEKSI'";
		}*/
		
		/*$arrKondisi = array();		
		
		$fmPILCARI = $_REQUEST['fmPILCARI'];	
		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
		//cari tgl,bln,thn
		$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];			
		$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
		$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
		//Cari 
		switch($fmPILCARI){			
			case 'selectNama': $arrKondisi[] = " nama_pasien like '%$fmPILCARIvalue%'"; break;
			case 'selectAlamat': $arrKondisi[] = " alamat like '%$fmPILCARIvalue%'"; break;						 	
		}
		if(!empty($fmFiltTglBtw_tgl1)) $arrKondisi[]= " tgl_daftar>='$fmFiltTglBtw_tgl1'";
		if(!empty($fmFiltTglBtw_tgl2)) $arrKondisi[]= " tgl_daftar<='$fmFiltTglBtw_tgl2'";	*/
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		switch($fmORDER1){
			case '1': $arrOrders[] = " c1,c2,d2,e2,e12 $Asc1 " ;break;
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
	
	function genDaftarInitial(){
		$vOpsi = $this->genDaftarOpsi();
		$fmFiltThnAnggaran=$_COOKIE['coThnAnggaran'];
		return			
			"<div id='{$this->Prefix}_cont_title' style='position:relative'></div>". 
			"<div id='{$this->Prefix}_cont_opsi' style='position:relative'>". 		
				//"<input type='hidden' id='fmFiltThnAnggaran' name='fmFiltThnAnggaran' value='$fmFiltThnAnggaran'>".
				//"<input type='hidden' id='fmNMBARANG' name='fmNMBARANG' value='$fmNMBARANG'>".
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
	
	function setPage_OtherScript(){
		$scriptload = 
					"<script>
						
						$(document).ready(function(){ 
							".$this->Prefix.".loading();
							
						});
						
						
					</script>";
		return "<script src='js/skpd.js' type='text/javascript'></script>
				<script src='js/barcode.js' type='text/javascript'></script>
				<script type='text/javascript' src='js/master/ref_sotk_baru/".strtolower($this->Prefix).".js' language='JavaScript' ></script>
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
	   <th class='th01' width='200' colspan='5'>Kode</th>
	   <th class='th01' width='450' align='center'>Nama SKPD</th>
	   <th class='th01' width='450' align='center'>Nama Barcode</th>
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 $Koloms[] = array('align="center"',genNumber($isi['c1'],1));
	 $Koloms[] = array('align="center"',genNumber($isi['c2'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['d2'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['e2'],2));
	 $Koloms[] = array('align="center"',genNumber($isi['e12'],3));
	 $Koloms[] = array('align="left"',$isi['nm_skpd']);
	 $Koloms[] = array('align="left"',$isi['nm_barcode']);
	 
	 return $Koloms;
	}
	
	
	
	
	
	function set_selector_other($tipe){
		global $Main;
		$cek = ''; $err=''; $content=''; $json=TRUE;
		
		switch($tipe){
		
		case 'hapus':{	
				$fm= $this->Hapus($pil);
				$err= $fm['err']; 
				$cek = $fm['cek'];
				$content = $fm['content'];
		break;
		}
		
		 case 'simpanUrusan':{
				$get= $this->simpanUrusan();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    }
	   
	   case 'simpanBidang':{
				$get= $this->simpanBidang();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    }
		
		case 'simpanSKPD':{
				$get= $this->simpanSKPD();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    }
	   
	   case 'simpanUnit':{
				$get= $this->simpanUnit();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    	}
			
	   case 'simpanEdit':{
			$get= $this->simpanEdit();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	   }	
		
		case 'simpan':{
			$get= $this->simpan();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		
		case 'getKode_e1':{
			$get= $this->getKode_e1();
			$cek = $get['cek'];
			$err = $get['err'];
			$content = $get['content'];
		break;
	    }
		
		 case 'refreshUrusan':{
				$get= $this->refreshUrusan();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    	}
	   
	   case 'refreshBidang':{
				$get= $this->refreshBidang();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    	}
			
		 case 'refreshSKPD':{
				$get= $this->refreshSKPD();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    	}
			
		case 'refreshUnit':{
				$get= $this->refreshUnit();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
	    	}			
		
		case 'pilihUrusan':{				
				$fm = $this->pilihUrusan();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}
			
		case 'pilihBidang':{				
				$fm = $this->pilihBidang();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}
		case 'pilihSKPD':{				
				$fm = $this->pilihSKPD();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}
			
		case 'pilihUnit':{				
				$fm = $this->pilihUnit();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}	
		case 'BaruUrusan':{				
				$fm = $this->setFormBaruUrusan();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}	
		
		case 'BaruBidang':{				
				$fm = $this->setFormBaruBidang();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}	
		case 'BaruSKPD':{				
				$fm = $this->setFormBaruSKPD();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
			}	
		
		case 'BaruUnit':{				
				$fm = $this->setFormBaruUnit();				
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
		
			case 'UrusanAfter':{
				$content= $this->cmbQueryBidang('fmSKPDBidang2',$fmSKPDBidang2,'','onchange=ref_sotk_baru.refreshList(true)','--- Pilih BIDANG ---','00');
			break;
			}
			case 'BidangAfter2':{
				$content= $this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=ref_sotk_baru.BidangAfter2()','--- Pilih SKPD ---','00');
			break;
			}
				
			case 'SKPDAfter2':{
				$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=ref_sotk_baru.UnitAfter2() ','--- Pilih UNIT ---','00');
			break;
		    }
			
			case 'UnitAfter2':{
				$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'','onchange=ref_sotk_baru.refreshList(true) ','--- Pilih SUB UNIT ---','000');
			break;
		    }
			case 'formBaru2':{				
				//echo 'tes';
				$this->setFormBaru();				
				//$cek = $fm['cek'];
				//$err = $fm['err'];
				//$content = $fm['content'];
				$json = FALSE;				
				break;
			}
			
			case 'formEdit2':{								
				$this->setFormEdit();				
				$json = FALSE;				
				break;
			}
			/*case 'simpan2' : {
				$get = $this->simpan2();
				$cek = $get['cek']; $err = $get['err']; $content=$get['content']; 
				break;
			}*/
						
			case 'batal':{
				$cbid= $_POST[$this->Prefix.'_cb'];				
				$get= $this->Batal($cbid);
				$err= $get['err']; 
				$cek = $get['cek'];
				$json=TRUE;	
				break;
			}
			
			case 'pilihreport':{
				$c = $_COOKIE['cofmSKPD'];
				$d = $_COOKIE['cofmUNIT'];
				$e = $_COOKIE['cofmSUBUNIT'];
				$e1 = $_COOKIE['cofmSEKSI'];
				
				$KondSkpd = $c == '00'? '' : "where c='$c' and d='$d' and e='$e' and e1='$e1'";
				
				$aqry = "select * from ref_bast $KondSkpd"; $cek .= $aqry;
				$qry = mysql_query($aqry);
				$Input = "<option value=''>--NOMOR BAST--</option>";
				while ($Hasil = mysql_fetch_array($qry)) {
					$Input .= "<option value='{$Hasil[no_ba]}'>{$Hasil[no_ba]}";
		    	}
				$Input = "<select name='cmbPilihBast' id='cmbPilihBast' style='width:200;'> $Input</select>";
				$content=$Input;
			break;
		    }			
			
			case 'cetakReport':{	
				$json= FALSE;
	   			$this->cetakReport();							
			break;
			}
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function Hapus($ids){ //validasi hapus tbl_sppd
		 $err=''; $cek='';
		 $cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		
		if ($err ==''){
			
		for($i = 0; $i<count($ids); $i++){
		$idplh1 = explode(" ",$ids[$i]);
		$data_c1= $idplh1[0];
	 	$data_c= $idplh1[1];
		$data_d= $idplh1[2];
		$data_e= $idplh1[3];
		$data_e1= $idplh1[4];
		
		
		if ($data_c1 != '0'){
			$sk1="select c1,c2,d2,e2,e12 from ref_skpd_baru where c1='$data_c1' and c2!='00'";
		}
		
		if ($data_c != '00'){
			$sk1="select c1,c2,d2,e2,e12 from ref_skpd_baru where c1='$data_c1' and c2='$data_c' and d2!='00'";
		}
		
		if ($data_d != '00'){
			$sk1="select c1,c2,d2,e2,e12 from ref_skpd_baru where c1='$data_c1'  and c2='$data_c' and d2='$data_d' and e2!='00'";
		}
		if ($data_e != '00'){
			$sk1="select c1,c2,d2,e2,e12 from ref_skpd_baru where c1='$data_c1'  and c2='$data_c' and d2='$data_d' and e2='$data_e' and e12!='000'";
		}
	//	$err='tes';
		if ($data_e1=='000'){
			$qrycek=mysql_query($sk1);$cek.=$sk1;
			if(mysql_num_rows($qrycek)>0)$err='data tidak bisa di hapus';
		}
		
		
		if($err=='' ){
					$qy = "DELETE FROM ref_skpd_baru WHERE c1='$data_c1' and c2='$data_c' and d2='$data_d'  and  e2='$data_e' and e12='$data_e1' and  concat (c1,' ',c2,' ',d2,' ',e2,' ',e12) ='".$ids[$i]."' ";$cek.=$qy;
					$qry = mysql_query($qy);
					
			}else{
				break;
			}			
		}
		}
		return array('err'=>$err,'cek'=>$cek);
	}	  
	
	function getKode_e1(){
	 global $Main;
	 
	 	$ka02 = $_REQUEST['fmc1'];	 
		$kb02 = $_REQUEST['fmc'];
		$kc02 = $_REQUEST['fmd'];
		$kd02 = $_REQUEST['fme'];
		$ke02 = $_REQUEST['fme1'];
	//	$ke02 = $_REQUEST['ke'];
	//	$fmJenis2 = $_REQUEST['fmJenis2'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kenew= $_REQUEST['id_UnitBaru'];
	 
	 	$aqry5="SELECT MAX(e12) AS maxno FROM ref_skpd_baru WHERE c1='$ka02' and c2='$kb02' and d2='$kc02' and e2='$kd02'";
	 //	$cek.="SELECT MAX(o) AS maxno FROM ref_rekening WHERE k='$ka02' and l='$kb02' and m='$kc02' and n='$kd02'";
		$get=mysql_fetch_array(mysql_query($aqry5));
		$newke=$get['maxno'] + 1;
		$newke1 = sprintf("%03s", $newke);
		$content->e1=$newke1;	
	
	/* $get1=mysql_fetch_array(mysql_query($aqry5));
		$lastkode1=$get1['maxno'];
		$kode1 = (int) substr($lastkode1, 1, 3);
		$kode1++;
		$$newke1 = sprintf("%03s", $kode1);
	 $content->e1=$newke1;*/
	
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function setFormBaruUrusan(){
		$dt=array();
		$this->form_fmST = 0;
		
		$fm = $this->BaruUrusan($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormBaruBidang(){
		$dt=array();
		$this->form_fmST = 0;
		
		$fm = $this->BaruBidang($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormBaruSKPD(){
		$dt=array();
		$this->form_fmST = 0;
		
		$fm = $this->BaruSKPD($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormBaruUnit(){
		$dt=array();
		$this->form_fmST = 0;
		
		$fm = $this->BaruUnit($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	
	
	function refreshUrusan(){
	global $Main;
	 
		$kc102 = $_REQUEST['fmc1'];	 
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kc1new= $_REQUEST['id_UrusanBaru'];
	 
		$queryKc1="SELECT c1, concat(c1, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1<>'00' and c2 = '00' and d2='00' and e2='00' and e12='000'" ;
	
	//	$cek.="SELECT c, concat(c, '. ', nm_skpd) as vnama FROM ref_skpd WHERE c1='$kc102' and c <> '00' and d='00' and e='00' and e1='000'";
		$content->unit=cmbQuery('fmc1',$kc1new,$queryKc1,'style="width:500;"onchange="'.$this->Prefix.'.pilihUrusan()"','&nbsp&nbsp-------- Pilih Urusan -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUrusan()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}	
	
	function refreshBidang(){
	global $Main;
	 
		$kc102 = $_REQUEST['fmc1'];	 
		$kc02 = $_REQUEST['fmc'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kcnew= $_REQUEST['id_BidangBaru'];
	 
		$queryKc="SELECT c2, concat(c2, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1='$kc102' and c2 <> '00' and d2='00' and e2='00' and e12='000'" ;
	
		$cek.="SELECT c2, concat(c2, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1='$kc102' and c2 <> '00' and d2='00' and e2='00' and e12='000'";
		$content->unit=cmbQuery('fmc',$kcnew,$queryKc,'style="width:500;"onchange="'.$this->Prefix.'.pilihBidang()"','&nbsp&nbsp-------- Pilih Bidang -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruBidang()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}	
	
	function refreshSKPD(){
	global $Main;
	 
		$kc102 = $_REQUEST['fmc1'];	 
		$kc02 = $_REQUEST['fmc'];
		$kd02 = $_REQUEST['fmd'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$kdnew= $_REQUEST['id_SKPDBaru'];
	 
		$queryKd="SELECT d2, concat(d2, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1='$kc102' and c2='$kc02' and d2<>'00' and e2='00' and e12='000'" ;
	
		$cek.="SELECT d2, concat(d2, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1='$kc102' and c2='$kc02' and d2<>'00' and e2='00' and e12='000'";
		$content->unit=cmbQuery('fmd',$kdnew,$queryKd,'style="width:500;"onchange="'.$this->Prefix.'.pilihSKPD()"','&nbsp&nbsp-------- Pilih SKPD -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruSKPD()' title='Baru' >";
	 
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
	 
	 $queryKD="SELECT e2, concat(e2,' . ', nm_skpd) as vnama  FROM ref_skpd_baru WHERE c1='$ka02' and c2='$kb02' and d2='$kc02' and e2<>'00' and e12='000'" ;
	 $cek.="SELECT e2, concat(e2,' . ', nm_skpd) as vnama  FROM ref_skpd_baru WHERE c1='$ka02' and c2='$kb02' and d2='$kc02' and e2<>'00' and e12='000'";
	 
		$koden=$queryKD['e2'];
		$new = sprintf("%02s", $koden);
		$kode_n=$new.".".$queryKD['nm_skpd'];
	
		$content->unit=cmbQuery('fme',$kdnew,$queryKD,'style="width:500;"onchange="'.$this->Prefix.'.pilihUnit()"','&nbsp&nbsp-------- Pilih UNIT -------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUnit()' title='Baru' >";
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	
	function pilihUrusan(){
	global $Main;	 
	
		$c1 = $_REQUEST['fmc1'];
		
		$cek = ''; $err=''; $content=''; $json=TRUE;
		$queryc="SELECT c2, concat(c2, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1='$c1' and c2<>'00' and d2 = '00' and e2='00' and e12='000'" ;$cek.=$queryc;
		$content->unit=cmbQuery('fmc',$fmc,$queryc,'style="width:500px;"onchange="'.$this->Prefix.'.pilihBidang()"','-------- Pilih Kode BIDANG ------------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruBidang()' title='Baru' >";
	
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function pilihBidang(){
	global $Main;
		$c1 = $_REQUEST['fmc1'];
		$c = $_REQUEST['fmc'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
	 
		$queryd="SELECT d2, concat(d2, '. ', nm_skpd) as vnama FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2 <> '00' and e2='00' and e12='000'" ;$cek.=$queryd;
		$content->unit=cmbQuery('fmd',$fmd,$queryd,'style="width:500px;"onchange="'.$this->Prefix.'.pilihSKPD()"','-------- Pilih Kode SKPD ----------------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruSKPD()' title='Baru' >";$cek.=$queryJenis;
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function pilihSKPD(){
	global $Main;
		$c1 = $_REQUEST['fmc1'];
		$c = $_REQUEST['fmc'];
		$d = $_REQUEST['fmd'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
	 
	
		 $querye="SELECT e2, concat(e2,' . ', nm_skpd) as vnama  FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2='$d' and e2<>'00' and e12='000'" ;$cek.=$querye;
		
		$content->unit=cmbQuery('fme',$fme,$querye,'style="width:500px;"onchange="'.$this->Prefix.'.pilihUnit()"','-------- Pilih Kode UNIT -----------------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUnit()' title='Baru' >";$cek.=$queryJenis;
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function pilihUnit(){
	global $Main;
	
		$c1 = $_REQUEST['fmc1'];
		$c = $_REQUEST['fmc'];
		$d = $_REQUEST['fmd'];
		$e = $_REQUEST['fme'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
	 
		$queryKE="SELECT max(e12) as e1, nm_skpd FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2 = '$d' and e2='$e'" ;$cek.=$queryKE;
		$get=mysql_fetch_array(mysql_query($queryKE));
		$lastkode=$get['e12'] + 1;	
		$kode_e1 = sprintf("%03s", $lastkode);
		$content->e1=$kode_e1;
	 
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function setFormBaru(){
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$c1 = $_REQUEST[$this->Prefix.'fmSKPDUrusan'];
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
		$c1=$kode[0];
		$c=$kode[1];
		$d=$kode[2];
		$e=$kode[3];
		$e1=$kode[4];
		$this->form_fmST = 1;				
		//get data 
		$aqry = "SELECT * FROM  ref_skpd_baru WHERE c1= '$c1' and c2='$c' and d2='$d' and e2='$e' and e12='$e1' "; $cek.=$aqry;
		$dt = mysql_fetch_array(mysql_query($aqry));
		$fm = $this->setFormEditdata($dt);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormEditdata($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 670;
	 $this->form_height = 180;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'REFERENSI SOTK BARU - EDIT';
	  }
	 
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;	
		$c1=$kode[0];
		$c=$kode[1];
		$d=$kode[2];
		$e=$kode[3];
		$e1=$kode[4];
		
		
		
		$queryKAedit=mysql_fetch_array(mysql_query("SELECT c1, nm_skpd FROM ref_skpd_baru WHERE c1='$c1' and c2 = '00' and d2='00' and e2='00' and e12='000'")) ;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT c2, nm_skpd FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2= '00' and e2='00' and e12='000'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT d2, nm_skpd FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2='$d' and e2='00' and e12='000'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT e2, nm_skpd FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2='$d' and e2='$e' and e12='000'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT e12, nm_skpd FROM ref_skpd_baru WHERE c1='$c1' and c2='$c' and d2='$d' and e2='$e' and e12='$e1'")) ;
		
		$datka=$queryKAedit['c1'].".  ".$queryKAedit['nm_skpd'];
		$datkb=$queryKBedit['c2'].". ".$queryKBedit['nm_skpd'];
		$datkc=$queryKCedit['d2']." .  ".$queryKCedit['nm_skpd'];
		$datkd=$queryKDedit['e2'].". ".$queryKDedit['nm_skpd'];
		$datke=$queryKEedit['e12'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'URUSAN' => array( 
						'label'=>'URUSAN',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ek' id='ek' value='".$datka."' style='width:490px;' readonly>
						<input type ='hidden' name='c1' id='c1' value='".$queryKAedit['c1']."'>
						</div>", 
						 ),
			'BIDANG' => array( 
						'label'=>'BIDANG',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$datkb."' style='width:490px;' readonly>
						<input type ='hidden' name='c2' id='c2' value='".$queryKBedit['c2']."'>
						</div>", 
						 ),
			'SKPD' => array( 
						'label'=>'SKPD',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$datkc."' style='width:490px;' readonly>
						<input type ='hidden' name='d2' id='d2' value='".$queryKCedit['d2']."'>
						</div>", 
						 ),
			'UNIT' => array( 
						'label'=>'UNIT',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='en' id='en' value='".$datkd."' style='width:490px;' readonly>
						<input type ='hidden' name='e2' id='e2' value='".$queryKDedit['e2']."'>
						</div>", 
						 ),
			
			'SUB_UNIT' => array( 
						'label'=>'SUB UNIT',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='eo' id='eo' value='".$datke."' style='width:30px;' readonly>
						<input type ='hidden' name='e12' id='e12' value='".$queryKEedit['e12']."'>
						<input type='text' name='nm_skpd' id='nm_skpd' value='".$dt['nm_skpd']."' size='71px'>
						</div>", 
						 ),			 			 			 
			
			'BARCODE' => array( 
						'label'=>'LABEL BARCODE',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						
						<input type='text' name='nm_barcode' id='nm_barcode' value='".$dt['nm_barcode']."' size='77px'>
						</div>", 
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
	
	function BaruUrusan($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKA';				
	 $this->form_width = 500;
	 $this->form_height = 50;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Kode URUSAN';
		$nip	 = '';
		$C1 = $_REQUEST ['fmc1'];
			
		$aqry2="SELECT MAX(c1) AS maxno FROM ref_skpd_baru where c2='00' and d2='00' and e2='00' and e12='000'";
		$cek.="SELECT MAX(c1) AS maxno FROM ref_skpd_baru where c2='00' and d2='00' and e2='00' and e12='000'";
		$get=mysql_fetch_array(mysql_query($aqry2));
		$newc=$get['maxno'] + 1;
			
		$queryc1=mysql_fetch_array(mysql_query("SELECT c1, nm_skpd FROM ref_skpd_baru where c2=00 and d2=00 and e2=00 and e12=000")); 		$datak1=$queryc1['c1'].".".$queryc1['nm_skpd'];
		
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
			
	 //items ----------------------
	  $this->form_fields = array(
			
									 			
			'kode_urusan' => array( 
						'label'=>'Kode URUSAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='c1' id='c1' value='".$newc."' style='width:50px;' readonly>
					
						<input type='text' name='nama' id='nama' value='".$nama."' placeholder='Nama Kode Urusan' style='width:200px;'>
						</div>", 
						 ),		
			
			
			'Add' => array( 
						'label'=>'',
						'value'=>"<div id='Add'></div>",
						'type'=>'merge'
					 )			
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanUrusan()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close1()' >";
							
		$form = $this->genFormUrusan();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function genFormUrusan($withForm=TRUE, $params=NULL, $center=TRUE){	
		$form_name = $this->Prefix.'_KAform';	
		
		if($withForm){
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params).
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params
				);
		}
		
		if($center){
			$form = centerPage( $form );	
		}
		return $form;
	}
	
	function BaruBidang($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 100;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Kode BIDANG';
		$nip	 = '';
		$C1 = $_REQUEST ['fmc1'];
			
		$aqry2="SELECT MAX(c2) AS maxno FROM ref_skpd_baru WHERE c1='$C1' and d2='00' and e2='00' and e12='000'";
	//	$cek.="SELECT MAX(c) AS maxno FROM ref_skpd WHERE c1='$C1' and d='00' and e='00' and e1='000'";
		$get=mysql_fetch_array(mysql_query($aqry2));
		$newc=$get['maxno'] + 1;
		
		$newdtc1 = sprintf("%02s", $newc);
		$queryc1=mysql_fetch_array(mysql_query("SELECT c1, nm_skpd FROM ref_skpd_baru where c1='$C1' and c2=00 and d2=00 and e2=00 and e12=000")); 
		$datak1=$queryc1['c1'].".".$queryc1['nm_skpd'];
		
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'urusan' => array( 
						'label'=>'Kode URUSAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='urusan' id='urusan' value='".$datak1."' style='width:255px;' readonly>
						
						<input type ='hidden' name='c1' id='c1' value='".$queryc1['c1']."'>
						</div>", 
						 ),	
									 			
			'bidang' => array( 
						'label'=>'Kode Bidang',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='c2' id='c2' value='".$newdtc1."' style='width:50px;' readonly>
					
						<input type='text' name='nama' id='nama' value='".$nama."' placeholder='Nama Kode Bidang' style='width:200px;'>
						</div>", 
						 ),		
			
			
			'Add' => array( 
						'label'=>'',
						'value'=>"<div id='Add'></div>",
						'type'=>'merge'
					 )			
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanBidang()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormBidang();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function genFormBidang($withForm=TRUE, $params=NULL, $center=TRUE){	
		$form_name = $this->Prefix.'_KBform';	
		
		if($withForm){
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params).
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params
				);
		}
		
		if($center){
			$form = centerPage( $form );	
		}
		return $form;
	}
	
	function BaruSKPD($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKC';				
	 $this->form_width = 500;
	 $this->form_height = 100;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Kode SKPD';
		$nip	 = '';
		$C1 = $_REQUEST ['fmc1'];
		$C = $_REQUEST ['fmc'];
			
		$aqry2="SELECT MAX(d2) AS maxno FROM ref_skpd_baru WHERE c1='$C1' and c2='$C'";
		$cek.="SELECT MAX(c) AS maxno FROM ref_skpd_baru WHERE c1='$C1'";
		$get=mysql_fetch_array(mysql_query($aqry2));
		$newd=$get['maxno'] + 1;
		
		$newdtd = sprintf("%02s", $newd);
		$queryc1=mysql_fetch_array(mysql_query("SELECT c1, nm_skpd FROM ref_skpd_baru where c1='$C1' and c2=00 and d2=00 and e2=00 and e12=000")); 
		$queryc=mysql_fetch_array(mysql_query("SELECT c2, nm_skpd FROM ref_skpd_baru where c1='$C1' and c2='$C' and d2=00 and e2=00 and e12=000")); 
		$datak1=$queryc1['c1'].".".$queryc1['nm_skpd'];
		$datac=$queryc['c2'].".".$queryc['nm_skpd'];
		
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'urusan' => array( 
						'label'=>'Kode URUSAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='urusan' id='urusan' value='".$datak1."' style='width:255px;' readonly>
						
						<input type ='hidden' name='c1' id='c1' value='".$queryc1['c1']."'>
						</div>", 
						 ),	
						 
			'bidang' => array( 
						'label'=>'Kode BIDANG',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='bidang' id='bidang' value='".$datac."' style='width:255px;' readonly>
						
						<input type ='hidden' name='c2' id='c2' value='".$queryc['c2']."'>
						</div>", 
						 ),				 
									 			
			'skpd' => array( 
						'label'=>'Kode SKPD',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='d2' id='d2' value='".$newdtd."' style='width:50px;' readonly>
					
						<input type='text' name='nama' id='nama' value='".$nama."' placeholder='Nama Kode SKPD' style='width:200px;'>
						</div>", 
						 ),		
			
			
			'Add' => array( 
						'label'=>'',
						'value'=>"<div id='Add'></div>",
						'type'=>'merge'
					 )			
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanSKPD()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close3()' >";
							
		$form = $this->genFormSKPD();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function genFormSKPD($withForm=TRUE, $params=NULL, $center=TRUE){	
		$form_name = $this->Prefix.'_KCform';	
		
		if($withForm){
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params).
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params
				);
		}
		
		if($center){
			$form = centerPage( $form );	
		}
		return $form;
	}
	
	function BaruUnit($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKD';				
	 $this->form_width = 600;
	 $this->form_height = 120;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Kode Unit';
		$nip	 = '';
		$KA1 = $_REQUEST['fmc1'];
		$KB1 = $_REQUEST['fmc'];
		$KC1 = $_REQUEST['fmd'];
		$KD1 = $_REQUEST['fme'];
		
	
		$aqry4="SELECT MAX(e2) AS maxno FROM ref_skpd_baru WHERE c1='$KA1' and c2='$KB1' and d2='$KC1'";
	//	$cek.="SELECT MAX(n) AS maxno FROM ref_rekening WHERE k='$KA1' and l='$KB1' and m='$KC1'";
		$get=mysql_fetch_array(mysql_query($aqry4));

		$newkm=$get['maxno'] + 1;
		$newkm1 = sprintf("%02s", $newkm);
		$queryKA1=mysql_fetch_array(mysql_query("SELECT c1, nm_skpd FROM ref_skpd_baru where c1='$KA1' and c2=00 and d2=00 and e2=00 and e12=000"));  
		$queryKB1=mysql_fetch_array(mysql_query("SELECT c2, nm_skpd FROM ref_skpd_baru where c1='$KA1' and c2='$KB1' and d2=00 and e2=00 and e12=000"));  
		$queryKC1=mysql_fetch_array(mysql_query("SELECT d2, nm_skpd FROM ref_skpd_baru where c1='$KA1' and c2='$KB1' and d2='$KC1' and e2=00 and e12=000"));  
	//	$cek.="SELECT m, nm_rekening FROM ref_rekening where k='$KA1' and l='$KB1' and m='$KC1' and n=00 and o=00";
//		
		$datak1=$queryKA1['c1'].".".$queryKA1['nm_skpd'];
		$datak2=$queryKB1['c2'].".".$queryKB1['nm_skpd'];
		$datak3=$queryKC1['d2'].".".$queryKC1['nm_skpd'];
		
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'urusan' => array( 
						'label'=>'Kode URUSAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='urusan' id='urusan' value='".$datak1."' style='width:480px;' readonly>
						
						<input type ='hidden' name='c1' id='c1' value='".$queryKA1['c1']."'>
						</div>", 
						 ),	
			
			'bidang' => array( 
						'label'=>'Kode BIDANG',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='Kelompok' id='Kelompok' value='".$datak2."' style='width:480px;' readonly>
						
						<input type ='hidden' name='c2' id='c2' value='".$queryKB1['c2']."'>
						</div>", 
						 ),	
						 
			'SKPD' => array( 
						'label'=>'Kode SKPD',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='jenis' id='jenis' value='".$datak3."' style='width:480px;' readonly>
						<input type ='hidden' name='d2' id='d2' value='".$queryKC1['d2']."'>
						</div>", 
						 ),				 
									 		
			'UNIT' => array( 
						'label'=>'Kode UNIT',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='e2' id='e2' value='".$newkm1."' style='width:50px;' readonly>
						<input type='text' name='nama' id='nama' value='".$nama."' placeholder='Nama Kode Objek' style='width:426px;'>
						</div>", 
						 ),		
						 
			
			'Add' => array( 
						'label'=>'',
						'value'=>"<div id='Add'></div>",
						'type'=>'merge'
					 )			
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanUnit()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close4()' >";
							
		$form = $this->genFormUnit();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function genFormUnit($withForm=TRUE, $params=NULL, $center=TRUE){	
		$form_name = $this->Prefix.'_KDform';	
		
		if($withForm){
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params).
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >",
					$this->form_menu_bawah_height,'',$params
				);
		}
		
		if($center){
			$form = centerPage( $form );	
		}
		return $form;
	}
	
	function setForm($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 730;
	 $this->form_height = 180;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Referensi SOTK Baru - BARU';
	  }
	  	
		
		$fmc1 = $_REQUEST['fmc1'];
		$fmc = $_REQUEST['fmc'];
		$fmd = $_REQUEST['fmd'];
		$fme = $_REQUEST['fme'];
		$fme1 = $_REQUEST['fme1'];
		
					
		$queryc1="SELECT c1, concat(c1, '. ', nm_skpd) as vnama FROM ref_skpd_baru where c2=00 and d2=00 and e2=00 and e12=000";
		$queryc="SELECT c2,nm_skpd FROM ref_skpd_baru where c1='$fmc1' and d2=00 and e2=00 and e12=000";
		$queryd="SELECT d2,nm_skpd FROM ref_skpd_baru where c1='$fmc1' and c2='$fmc' and e2=00 and e12=000";
		$querye="SELECT e2,nm_skpd FROM ref_skpd_baru where c1='$fmc1' and c2='$fmc' and d2='$fmd' and e12=000";
		$querye1="SELECT e12,nm_skpd FROM ref_skpd_baru where c1='$fmc1' and c2='$fmc' and d2='$fmd' and e2='$fme'";
		
		
		/*$queryc1="SELECT * FROM ref_skpd where c=00 and d=00 and e=00 and e1=000";
		$lvl1_1=mysql_query("SELECT count(*) as cnt, c1 , c , d , e, e1 FROM ref_skpd WHERE c1='$data_c1' and c='$data_c' and d='$data_d' and e='$data_e' and e1='$data_e1'");*/
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  	'urusan' => array( 
						'label'=>'URUSAN',
						'labelWidth'=>120, 
						'value'=>
					//	"<div id='cont_c1'>".cmbQuery('fmc1',$c1,$queryc1,'style="width:210;"onchange="'.$this->Prefix.'.pilihUrusan()"','-------- Pilih Kode URUSAN ------------------')."</div>",
					"<div id='cont_c1'>".cmbQuery('fmc1',$c,$queryc1,'style="width:500px;"onchange="'.$this->Prefix.'.pilihUrusan()"','-------- Pilih Kode URUSAN ------------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUrusan()' title='Kode Urusan' ></div>",
						 ),		
						 	
			'bidang' => array( 
						'label'=>'BIDANG',
						'labelWidth'=>100, 
						'value'=>
						"<div id='cont_c'>".cmbQuery('fmc',$c,$queryc,'style="width:500px;"onchange="'.$this->Prefix.'.pilihBidang()"','-------- Pilih Kode BIDANG -----------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruBidang()' title='Kode Bidang' ></div>",
						 ),
						 		 
			'skpd' => array( 
						'label'=>'SKPD',
						'labelWidth'=>100, 
						'value'=>
						"<div id='cont_d'>".cmbQuery('fmd',$d,$queryd,'style="width:500px;"onchange="'.$this->Prefix.'.pilihSKPD()"','-------- Pilih Kode SKPD ---------------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruSKPD()' title='kode SKPD' ></div>",
						 ),	
						 
			'unit' => array( 
						'label'=>'UNIT',
						'labelWidth'=>100, 
						'value'=>
						"<div id='cont_e'>".cmbQuery('fme',$e,$querye,'style="width:500px;"onchange="'.$this->Prefix.'.pilihUnit()"','-------- Pilih Kode UNIT -----------------')."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".BaruUnit()' title='Kode UNIT' ></div>",
						 ),		
				
			'sub_unit' => array( 
						'label'=>'SUB UNIT',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='e1' id='e1' value='".$newke."' style='width:50px;' readonly>
						<input type='text' name='nama' id='nama' value='".$nama."' placeholder='Nama Sub Unit' style='width:449px;'>
						</div>", 
						 ),		
			
			'barcode' => array( 
						'label'=>'LABEL BARCODE',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='barcode' id='barcode' value='".$nama."' placeholder='Label Barcode' style='width:500px;'>
						</div>", 
						 )	
						 
			
			 
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
			
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	
	function cmbQueryUrusan($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE) {
     global $Ref,$Main;
	 Global $fmSKPDUrusan;
		$fmSKPDUrusan = cekPOST('fmSKPDUrusan');
	 $aqry = "select * from ref_skpd_baru where c1 !='0' and  c2 ='00' and d2='00' and e2 ='00' and e12 ='000'  order by c1";
	 $Input = "<option value='$vAtas'>$Atas</option>";
	 $Query = mysql_query($aqry);
	 $nmSKPDUrusan='';
    	while ($Hasil = mysql_fetch_array($Query)) {
        	$Sel = $Hasil['c1'] ==  $value ? "selected" : "";
				if ($nmSKPDUrusan=='' ) $nmSKPDUrusan =  $value == $Hasil['c1'] ? $Hasil['nm_skpd'] : '';
			$Input .= "<option $Sel value='{$Hasil[c1]}'>{$Hasil['c1']}. {$Hasil[nm_skpd]}";
    	}
     $Input = $readonly == false ?
	 "<select $param name='$name' id='$name'> $Input</select>":
	 "$nmSKPDUrusan <input type='hidden' name='$name' id='$name' value='". $value."' >";
     return $Input;
	}
	
	function cmbQueryBidang($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE) {
     global $Ref,$Main;
	 Global $fmSKPDUrusan,$fmSKPDBidang2;
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
	 $aqry = "select * from ref_skpd_baru where 1=1 and c2!= '00' and d2='00' and c1='$fmSKPDUrusan' order by c2";
	 $Input = "<option value='$vAtas'>$Atas</option>";
	 $Query = mysql_query($aqry);
	 $nmSKPDBidang='';
    	while ($Hasil = mysql_fetch_array($Query)) {
        	$Sel = $Hasil['c2'] ==  $value ? "selected" : "";
				if ($nmSKPDBidang=='' ) $nmSKPDBidang =  $value == $Hasil['c2'] ? $Hasil['nm_skpd'] : '';
			$Input .= "<option $Sel value='{$Hasil[c2]}'>{$Hasil['c2']}. {$Hasil[nm_skpd]}";
    	}
     $Input = $readonly == false ?
	 "<select $param name='$name' id='$name'> $Input</select>":
	 "$nmSKPDBidang <input type='hidden' name='$name' id='$name' value='". $value."' >";
     return $Input;
	}
	
	function cmbQuerySKPD($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE) {
	 global $Ref,$Main;
	 Global $fmSKPDUrusan,$fmSKPDBidang2,$fmSKPDskpd2;
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
		//setcookie('cofmSKPD',$fmSKPDBidang);
		//setcookie('cofmUNIT',$fmSKPDskpd);
	 $aqry="select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2 <> '00' and e2 = '00' and c1='$fmSKPDUrusan' order by d2";
	 $Input = "<option value='$vAtas'>$Atas</option>";
	 $Query = mysql_query($aqry);
	 $nmSKPDskpd='';
    	while ($Hasil = mysql_fetch_array($Query)) {
        	$Sel = $Hasil['d2'] ==  $value ? "selected" : "";
				if ($nmSKPDskpd=='' ) $nmSKPDskpd =  $value == $Hasil['d2'] ? $Hasil['nm_skpd'] : '';
			$Input .= "<option $Sel value='{$Hasil[d2]}'>{$Hasil[d2]}. {$Hasil[nm_skpd]}";
    	}
     $Input = $readonly == false ?
	 "<select $param name='$name' id='$name'> $Input</select>":
	 "$nmSKPDskpd <input type='hidden' name='$name' id='$name' value='". $value."' >";
     return $Input;
	}
	
	function cmbQueryUnit($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE,$edit='') {
	 global $Ref,$Main,$HTTP_COOKIE_VARS;
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
		$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
		
			
	 $aqry = "select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2 = '$fmSKPDskpd2' and e2 <> '00' and e12='000' and c1='$fmSKPDUrusan'  order by e2";
	 $Input = "<option value='$vAtas'>$Atas</option>";
	 $Query = mysql_query($aqry);
	 $nmSKPDUnit='';
    	while ($Hasil = mysql_fetch_array($Query)) {
        	$Sel = $Hasil['e2'] ==  $value ? "selected" : "";
				if ($nmSKPDUnit=='' ) $nmSKPDUnit =  $value == $Hasil['e2'] ? $Hasil['nm_skpd'] : '';
			$Input .= "<option $Sel value='{$Hasil[e2]}'>{$Hasil[e2]}. {$Hasil[nm_skpd]}";
    	}
     $Input = $readonly == false ?
	 "<select $param name='$name' id='$name'> $Input</select>":
	 "$nmSKPDUnit <input type='hidden' name='$name' id='$name' value='". $value."' >";
     return $Input;
	}
	
	function cmbQuerySubUnit($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE,$edit='') {
	 global $Ref,$Main,$HTTP_COOKIE_VARS;
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
		$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
		$fmSKPDSubUnit2 = cekPOST('fmSKPDSubUnit2');
			
	 $aqry="select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2='$fmSKPDskpd2' and e2='$fmSKPDUnit2' and e12!='000' order by e12";
	 $Input = "<option value='$vAtas'>$Atas</option>";
	 $Query = mysql_query($aqry);
	 $nmSKPDSubUnit='';
    	while ($Hasil = mysql_fetch_array($Query)) {
        	$Sel = $Hasil['e12'] ==  $value ? "selected" : "";
				if ($nmSKPDSubUnit=='' ) $nmSKPDSubUnit =  $value == $Hasil['e12'] ? $Hasil['nm_skpd'] : '';
			$Input .= "<option $Sel value='{$Hasil[e12]}'>{$Hasil[nm_skpd]}";
    	}
     $Input = $readonly == false ?
	 "<select $param name='$name' id='$name'> $Input</select>":
	 "$nmSKPDSubUnit <input type='hidden' name='$name' id='$name' value='". $value."' >";
     return $Input;
	}
	
	function Batal($ids){ //validasi hapus ref_pegawai
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID'];
		$cek = ''; $err=''; $content=''; $json=TRUE;
		
		if($err == ''){
			for($i = 0; $i<count($ids); $i++){
				
				//Batalkan SOTK Baru
				$batal = "UPDATE buku_induk set ".
				"c1 = '',".
				"c2 = '',".
				"d2 = '',".
				"e2 = '',".
				"e12 = '',".
				"no_ba2 = '',".
				"tgl_ba2 = '',".
				"uid = '$UID',".
				"tgl_update = now() ".
				"WHERE id='".$ids[$i]."'"; 
				$cek.="| ".$batal;		
				$qry = mysql_query($batal);
				
			}
		}
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function cetakReport(){
	 global $Main;
	 $cmbreport=$_REQUEST['jnsReport'];//combo value
		echo "<html>
			<head><link rel='stylesheet' href='css/template_css.css' type='text/css'></head>
			<body>";
			
			if($cmbreport=='1'){
				$this->cetakBast();
			}elseif($cmbreport=='2'){
				$this->cetakRincian();
			}elseif($cmbreport=='3'){
				$this->cetakRekap();
			}
			
		echo "</body></html>";
	 
	}
	
	function cetakRekap(){
	global $Main,$HTTP_COOKIE_VARS;
		$width='33cm';//'21cm';
		$height='21cm';//'33cm';
		$f_size1='11pt';
		$f_size2='12pt';
		$isiCetakST1='st1';
		
		$c = $HTTP_COOKIE_VARS['cofmSKPD'];
		$d = $HTTP_COOKIE_VARS['cofmUNIT'];
		$e = $HTTP_COOKIE_VARS['cofmSUBUNIT'];	
		$e1 = $HTTP_COOKIE_VARS['cofmSEKSI'];
		
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='00'"));
		$nmBidang = $get['nm_skpd']==''?'Semua BIDANG':$get['nm_skpd'];
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='00'"));
		$nmSkpd = $get['nm_skpd']==''?'Semua SKPD':$get['nm_skpd'];
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='$e' and e1='000'"));
		$nmUnit = $get['nm_skpd']==''?'Semua UNIT':$get['nm_skpd'];
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='$e' and e1='$e1'"));
		$nmSubUnit = $get['nm_skpd']==''?'Semua SUB UNIT':$get['nm_skpd'];
		
		$kondWil = " a='10' and b='03' ";
		$kondStatusBrg = " and status_barang <> '3' and status_barang <> '4' and status_barang <> '5' ";
		$arrKond = array();
		if(!($c == '' || $c=='00') ) $arrKond[] = " c= '$c'";
		if(!($d == '' || $d=='00') ) $arrKond[] = " d= '$d'";
		if(!($e == '' || $e=='00') ) $arrKond[] = " e= '$e'";
		if(!($e1 == '' || $e1=='00' || $e1=='000') ) $arrKond[] = " e1= '$e1'";
		$KondisiSKPD = join(' and ', $arrKond);
		$KondisiSKPD = $KondisiSKPD==''? '' : ' and '.$KondisiSKPD;
		
		//===================================================DAFTAR SOTK LAMA===================================================
		$aqry = "SELECT 'TANAH' as nm_aset, '3' as staset, '01' as f, '00' as g union
					SELECT 'PERALATAN DAN MESIN' as nm_aset, '3' as staset, '02' as f, '00' as g union
					SELECT 'GEDUNG DAN BANGUNAN' as nm_aset, '3' as staset, '03' as f, '00' as g union
					SELECT 'JARINGAN, IRIGASI DAN JALAN' as nm_aset, '3' as staset, '04' as f, '00' as g union
					SELECT 'ASET TETAP LAINNYA' as nm_aset, '3' as staset, '05' as f, '00' as g union
					SELECT 'KONSTRUKSI DALAM PENGERJAAN' as nm_aset, '3' as staset, '06' as f, '00' as g union
					SELECT 'TUNTUTAN GANTI RUGI' as nm_aset, '6' as staset, '07' as f, '24' as g union
					SELECT 'ASET LAIN-LAIN' as nm_aset, '9' as staset, '07' as f, '25' as g union
					SELECT 'ASET TIDAK BERWUJUD' as nm_aset, '8' as staset, '07' as f, '24' as g union
					SELECT 'KEMITRAAN DENGAN PIHAK KETIGA (PEMANFAATAN)' as nm_aset, '7' as staset, '07' as f, '23' as g union 
					SELECT 'EKSTRAKOMPTABLE' as nm_aset, '10' as staset, '00' as f, '00' as g";
		$qry = mysql_query($aqry);
		$no = 0;
		$totJmlBrgAudit = 0;
		$totJmlHrgAudit = 0;
		$totJmlBrgTambah = 0;
		$totJmlHrgTambah = 0;
		$totJmlBrgKurang = 0;
		$totJmlHrgKurang = 0;
		$totJmlBrgAkhir = 0;
		$totJmlHrgAkhir = 0;
		$daftarSOTKLama = "<tr>
								<td><b>1</b></td>
								<td colspan='2'><b>SOTK LAMA</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>";
		while($isi = mysql_fetch_array($qry)){
		$no++;
		$kondStaset = $isi['staset']==3?" and staset='{$isi['staset']}' and f='{$isi['f']}' " : " and staset='{$isi['staset']}' ";
		//if($isi['staset']=='') $kondStaset = " and nilai_susut<>'0'";
		$aqry="select ifnull(sum(jml_barang),0) as jml_brg_audit, 
				ifnull(sum(nilai_buku),0) as jml_hrg_audit,
				ifnull(sum(nilai_susut),0) as jml_susut_audit,
				'0' as jml_brg_tambah, '0' as jml_hrg_tambah, '0' as jml_susut_tambah, 
				ifnull(sum(if(c1<>'',jml_barang,0)),0) as jml_brg_kurang, 
				ifnull(sum(if(c1<>'',nilai_buku,0)),0) as jml_hrg_kurang,
				ifnull(sum(if(c1<>'',nilai_susut,0)),0) as jml_susut_kurang,
				ifnull(sum(jml_barang-if(c1<>'',jml_barang,0)),0) as jml_brg_akhir, 
				ifnull(sum(nilai_buku-if(c1<>'',nilai_buku,0)),0) as jml_hrg_akhir,
				ifnull(sum(nilai_susut-if(c1<>'',nilai_susut,0)),0) as jml_susut_akhir
				from view_buku_induk2 
				where $kondWil $KondisiSKPD $kondStaset $kondStatusBrg";
		$isix = mysql_fetch_array(mysql_query($aqry));
		$totJmlBrgAudit += $isix['jml_brg_audit'];
		$totJmlHrgAudit += $isix['jml_hrg_audit'];
		$totJmlSstAudit += $isix['jml_susut_audit'];
		$totJmlBrgTambah += $isix['jml_brg_tambah'];
		$totJmlHrgTambah += $isix['jml_hrg_tambah'];
		$totJmlSstTambah += $isix['jml_susut_tambah'];
		$totJmlBrgKurang += $isix['jml_brg_kurang'];
		$totJmlHrgKurang += $isix['jml_hrg_kurang'];
		$totJmlSstKurang += $isix['jml_susut_kurang'];
		$totJmlBrgAkhir += $isix['jml_brg_akhir'];
		$totJmlHrgAkhir += $isix['jml_hrg_akhir'];
		$totJmlSstAkhir += $isix['jml_susut_akhir'];
			$daftarSOTKLama .= "<tr>
									<td></td>
									<td style='border-right:0px;' valign='top'>$no</td>
									<td style='border-left:0px;'>{$isi['nm_aset']}</td>
									<td align='center'>{$isix['jml_brg_audit']}</td>
									<td align='right'>".number_format($isix['jml_hrg_audit'],2,',','.')."</td>
									<td align='right'>".number_format($isix['jml_susut_audit'],2,',','.')."</td>
									<td align='center'>{$isix['jml_brg_tambah']}</td>
									<td align='right'>".number_format($isix['jml_hrg_tambah'],2,',','.')."</td>
									<td align='right'>".number_format($isix['jml_susut_tambah'],2,',','.')."</td>
									<td align='center'>{$isix['jml_brg_kurang']}</td>
									<td align='right'>".number_format($isix['jml_hrg_kurang'],2,',','.')."</td>
									<td align='right'>".number_format($isix['jml_susut_kurang'],2,',','.')."</td>
									<td align='center'>{$isix['jml_brg_akhir']}</td>
									<td align='right'>".number_format($isix['jml_hrg_akhir'],2,',','.')."</td>
									<td align='right'>".number_format($isix['jml_susut_akhir'],2,',','.')."</td>
								</tr>";
		}
		
		$totalJmlHrgAudit = number_format($totJmlHrgAudit,2,',','.');
		$totalJmlSstAudit = number_format($totJmlSstAudit,2,',','.');
		$totalJmlHrgTambah = number_format($totJmlHrgTambah,2,',','.');
		$totalJmlSstTambah = number_format($totJmlSstTambah,2,',','.');
		$totalJmlHrgKurang = number_format($totJmlHrgKurang,2,',','.');
		$totalJmlSstKurang = number_format($totJmlSstKurang,2,',','.');
		$totalJmlHrgAkhir = number_format($totJmlHrgAkhir,2,',','.');
		$totalJmlSstAkhir = number_format($totJmlSstAkhir,2,',','.');
		$daftarSOTKLama .= "<tr>
									<td></td>
									<td style='border-right:0px;'></td>
									<td style='border-left:0px;' align='center'><b>TOTAL</b></td>
									<td align='center'><b>$totJmlBrgAudit</b></td>
									<td align='right'><b>$totalJmlHrgAudit</b></td>
									<td align='right'><b>$totalJmlSstAudit</b></td>
									<td align='center'><b>$totJmlBrgTambah</b></td>
									<td align='right'><b>$totalJmlHrgTambah</b></td>
									<td align='right'><b>$totalJmlSstTambah</b></td>
									<td align='center'><b>$totJmlBrgKurang</b></td>
									<td align='right'><b>$totalJmlHrgKurang</b></td>
									<td align='right'><b>$totalJmlSstKurang</b></td>
									<td align='center'><b>$totJmlBrgAkhir</b></td>
									<td align='right'><b>$totalJmlHrgAkhir</b></td>
									<td align='right'><b>$totalJmlSstAkhir</b></td>
								</tr>";
								
		//===================================================DAFTAR SOTK BARU============================================================
		//query cari sotk lama yg bersangkutan 27-04-2017 : tambahin where c1 is not null
		$aqry = "select c1,c2,d2,e2,e12 from view_buku_induk2 
				where $kondWil $KondisiSKPD $kondStatusBrg and c1<>''
				group by c1,c2,d2,e2,e12";
		$qry = mysql_query($aqry);
		$noo = 1;
		while($isi = mysql_fetch_array($qry)){
		$noo++;
		
		$c1 = $isi['c1'];
		$c2 = $isi['c2'];
		$d2 = $isi['d2'];
		$e2 = $isi['e2'];	
		$e12 = $isi['e12'];
		
		$arrKond2 = array();
		if(!($c1 == '' || $c1=='00') ) $arrKond2[] = " c1= '$c1'";
		if(!($c2 == '' || $c2=='00') ) $arrKond2[] = " c2= '$c2'";
		if(!($d2 == '' || $d2=='00') ) $arrKond2[] = " d2= '$d2'";
		if(!($e2 == '' || $e2=='00') ) $arrKond2[] = " e2= '$e2'";
		if(!($e12 == '' || $e12=='00' || $e12=='000') ) $arrKond2[] = " e12= '$e12'";
		$KondisiSKPD2 = join(' and ', $arrKond2);
		$KondisiSKPD2 = $KondisiSKPD2==''? '' : ' and '.$KondisiSKPD2;
		
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd_baru where c1='$c1' and c2='00'"));
		$urusan = $get['nm_skpd'];
		$get2 = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd_baru where c1='$c1' and c2='$c2' and d2='00'"));
		$bidang2 = $get2['nm_skpd'];
		$get3 = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd_baru where c1='$c1' and c2='$c2' and d2='$d2' and e2='00'"));
		$skpd2 = $get3['nm_skpd'];
		$get4 = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd_baru where c1='$c1' and c2='$c2' and d2='$d2' and e2='$e2' and e12='000'"));
		$unit2 = $get4['nm_skpd'];
		$get5 = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd_baru where c1='$c1' and c2='$c2' and d2='$d2' and e2='$e2' and e12='$e12'"));
		$subunit2 = $get5['nm_skpd'];
			$daftarref_skpd_baru .= "<tr>
								<td><b>$noo</b></td>
								<td colspan='5'><b>SOTK BARU</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='5'><b>URUSAN&nbsp;&nbsp;:&nbsp;$urusan</b></td>
								<td></td>
								<td></td><td></td><td></td><td></td>
								<td></td><td></td><td></td><td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='5'><b>BIDANG&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;$bidang2</b></td>
								<td></td>
								<td></td><td></td><td></td><td></td>
								<td></td><td></td><td></td><td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='5'><b>SKPD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;$skpd2</b></td>
								<td></td>
								<td></td><td></td><td></td><td></td>
								<td></td><td></td><td></td><td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='5'><b>UNIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;$unit2</b></td>
								<td></td>
								<td></td><td></td><td></td><td></td>
								<td></td><td></td><td></td><td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan='5'><b>SUB UNIT&nbsp;:&nbsp;$subunit2</b></td>
								<td></td>
								<td></td><td></td><td></td><td></td>
								<td></td><td></td><td></td><td></td>
							</tr>";
							
			$aqry2 = "SELECT 'TANAH' as nm_aset, '3' as staset, '01' as f, '00' as g union
					SELECT 'PERALATAN DAN MESIN' as nm_aset, '3' as staset, '02' as f, '00' as g union
					SELECT 'GEDUNG DAN BANGUNAN' as nm_aset, '3' as staset, '03' as f, '00' as g union
					SELECT 'JARINGAN, IRIGASI DAN JALAN' as nm_aset, '3' as staset, '04' as f, '00' as g union
					SELECT 'ASET TETAP LAINNYA' as nm_aset, '3' as staset, '05' as f, '00' as g union
					SELECT 'KONSTRUKSI DALAM PENGERJAAN' as nm_aset, '3' as staset, '06' as f, '00' as g union
					SELECT 'TUNTUTAN GANTI RUGI' as nm_aset, '6' as staset, '07' as f, '24' as g union
					SELECT 'ASET LAIN-LAIN' as nm_aset, '9' as staset, '07' as f, '25' as g union
					SELECT 'ASET TIDAK BERWUJUD' as nm_aset, '8' as staset, '07' as f, '24' as g union
					SELECT 'KEMITRAAN DENGAN PIHAK KETIGA (PEMANFAATAN)' as nm_aset, '7' as staset, '07' as f, '23' as g union 
					SELECT 'EKSTRAKOMPTABLE' as nm_aset, '10' as staset, '00' as f, '00' as g";
			$qryr = mysql_query($aqry2);
			$totJmlBrgAudit2 = 0;
			$totJmlHrgAudit2 = 0;
			$totJmlSstAudit2 = 0;
			$totJmlBrgTambah2 = 0;
			$totJmlHrgTambah2 = 0;
			$totJmlSstTambah2 = 0;
			$totJmlBrgKurang2 = 0;
			$totJmlHrgKurang2 = 0;
			$totJmlSstKurang2 = 0;
			$totJmlBrgAkhir2 = 0;
			$totJmlHrgAkhir2 = 0;
			$totJmlSstAkhir2 = 0;
			while($isiy = mysql_fetch_array($qryr)){
				$kondStaset2 = $isiy['staset']==3?" and staset='{$isiy['staset']}' and f='{$isiy['f']}' " : " and staset='{$isiy['staset']}' ";
				//if($isiy['staset']=='') $kondStaset2 = " and nilai_susut<>'0'";
				$aqry3="select '0' as jml_brg_audit, 
						'0' as jml_hrg_audit,
						'0' as jml_susut_audit,
						ifnull(sum(jml_barang),0) as jml_brg_tambah, 
						ifnull(sum(nilai_buku),0) as jml_hrg_tambah, 
						ifnull(sum(nilai_susut),0) as jml_susut_tambah, 
						'0' as jml_brg_kurang, 
						'0' as jml_hrg_kurang, 
						'0' as jml_susut_kurang, 
						ifnull(0+sum(jml_barang),0) as jml_brg_akhir, 
						ifnull(0+sum(nilai_buku),0) as jml_hrg_akhir,
						ifnull(0+sum(nilai_susut),0) as jml_susut_akhir
						from view_buku_induk2 where $kondWil $KondisiSKPD $KondisiSKPD2 $kondStaset2 $kondStatusBrg";
				$isiz = mysql_fetch_array(mysql_query($aqry3));
				$totJmlBrgAudit2 += $isiz['jml_brg_audit'];
				$totJmlHrgAudit2 += $isiz['jml_hrg_audit'];
				$totJmlSstAudit2 += $isiz['jml_susut_audit'];
				$totJmlBrgTambah2 += $isiz['jml_brg_tambah'];
				$totJmlHrgTambah2 += $isiz['jml_hrg_tambah'];
				$totJmlSstTambah2 += $isiz['jml_susut_tambah'];
				$totJmlBrgKurang2 += $isiz['jml_brg_kurang'];
				$totJmlHrgKurang2 += $isiz['jml_hrg_kurang'];
				$totJmlSstKurang2 += $isiz['jml_susut_kurang'];
				$totJmlBrgAkhir2 += $isiz['jml_brg_akhir'];
				$totJmlHrgAkhir2 += $isiz['jml_hrg_akhir'];
				$totJmlSstAkhir2 += $isiz['jml_susut_akhir'];
				$daftarref_skpd_baru .= "<tr>
										<td></td>
										<td style='border-right:0px;'></td>
										<td style='border-left:0px;'>{$isiy['nm_aset']}</td>
										<td align='center'></td>
										<td align='right'></td>
										<td align='right'></td>
										<td align='center'>{$isiz['jml_brg_tambah']}</td>
										<td align='right'>".number_format($isiz['jml_hrg_tambah'],2,',','.')."</td>
										<td align='right'>".number_format($isiz['jml_susut_tambah'],2,',','.')."</td>
										<td align='center'>{$isiz['jml_brg_kurang']}</td>
										<td align='right'>".number_format($isiz['jml_hrg_kurang'],2,',','.')."</td>
										<td align='right'>".number_format($isiz['jml_susut_kurang'],2,',','.')."</td>
										<td align='center'>{$isiz['jml_brg_akhir']}</td>
										<td align='right'>".number_format($isiz['jml_hrg_akhir'],2,',','.')."</td>
										<td align='right'>".number_format($isiz['jml_susut_akhir'],2,',','.')."</td>
									</tr>";
			}
			$totalJmlHrgAudit2 = number_format($totJmlHrgAudit2,2,',','.');
			$totalJmlSstAudit2 = number_format($totJmlSstAudit2,2,',','.');
			$totalJmlHrgTambah2 = number_format($totJmlHrgTambah2,2,',','.');
			$totalJmlSstTambah2 = number_format($totJmlSstTambah2,2,',','.');
			$totalJmlHrgKurang2 = number_format($totJmlHrgKurang2,2,',','.');
			$totalJmlSstKurang2 = number_format($totJmlSstKurang2,2,',','.');
			$totalJmlHrgAkhir2 = number_format($totJmlHrgAkhir2,2,',','.');
			$totalJmlSstAkhir2 = number_format($totJmlSstAkhir2,2,',','.');
			$daftarref_skpd_baru .= "<tr>
									<td></td>
									<td style='border-right:0px;'></td>
									<td style='border-left:0px;' align='center'><b>TOTAL</b></td>
									<td align='center'><b></b></td>
									<td align='right'><b></b></td>
									<td align='right'><b></b></td>
									<td align='center'><b>$totJmlBrgTambah2</b></td>
									<td align='right'><b>$totalJmlHrgTambah2</b></td>
									<td align='right'><b>$totalJmlSstTambah2</b></td>
									<td align='center'><b>$totJmlBrgKurang2</b></td>
									<td align='right'><b>$totalJmlHrgKurang2</b></td>
									<td align='right'><b>$totalJmlSstKurang2</b></td>
									<td align='center'><b>$totJmlBrgAkhir2</b></td>
									<td align='right'><b>$totalJmlHrgAkhir2</b></td>
									<td align='right'><b>$totalJmlSstAkhir2</b></td>
								</tr>";
			
		}
		
		//DAFTAR REKAP	
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
				"<link rel=\"stylesheet\" href=\"css/template_css.css\" type=\"text/css\" />
				<style type=\"text/css\" media=\"print\">
				   table thead 
				   {
				    display: table-header-group;
				   }
				</style>
				<style type=\"text/css\" media=\"print\">
					
					.footer { position: fixed; bottom: 0px;}
					.pagenum {
						counter-increment:page;
						counter-reset : 2;
					}
      				.pagenum:after { 
						content: counter(page);
						 }
				</style>";
			echo"<div class=\"page\" style='width:$width;font-family:Arial;page-break-after:always;'>
			<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
				</head>".
			"<body >
			
			<form name='adminForm' id='adminForm' method='post' action=''>".
				//$this->cetak_xls.		
				//$this->setCetak_Header_Nominatif($Mode).//$this->Cetak_Header.//
				"<div id='cntTerimaKondisi'>".
					//$TampilOpt['TampilOpt'].
				"</div>";
			echo "
				
				<table class='rangkacetak' style='width:$width'>
					<tr>
						<td align=center style='font-size:16pt;'><b>REKAPITULASI MUTASI BARANG DARI SOTK LAMA KE SOTK BARU</b><br><br></td>
					</tr>
				</table>
				<br><br>
				<table>
					<tr>
						<td><b>BIDANG</b></td>
						<td><b>:</b></td>
						<td><b>$nmBidang</b></td>
					</tr>
					<tr>
						<td><b>SKPD</b></td>
						<td><b>:</b></td>
						<td><b>$nmSkpd</b></td>
					</tr>
					<tr>
						<td><b>UNIT</b></td>
						<td><b>:</b></td>
						<td><b>$nmUnit</b></td>
					</tr>
					<tr>
						<td><b>SUB UNIT</b></td>
						<td><b>:</b></td>
						<td><b>$nmSubUnit</b></td>
					</tr>
				</table>
				<br><br>
				<table border=1 style='width:100%;border-collapse: collapse;' cellpadding='5'>
				<thead>
					<tr style='background-color: #DBDBDB;text-align:center;'>
						<td width='5' rowspan='2'><b>NO</b></td>
						<td width='300' rowspan='2' colspan='2'><b>SOTK DAN NAMA BARANG</b></td>
						<td colspan='3'><b>NERACA AUDITED THN 2016</b></td>
						<td colspan='3'><b>BERTAMBAH</b></td>
						<td colspan='3'><b>BERKURANG</b></td>
						<td colspan='3'><b>NERACA AWAL THN 2017</b></td>
					</tr>
					<tr style='background-color: #DBDBDB;text-align:center;'>
						<td ><b>JUMLAH</b></td>
						<td ><b>HARGA (Rp)</b></td>
						<td ><b>AKUMULASI<BR>PENYUSUTAN</b></td>
						<td ><b>JUMLAH</b></td>
						<td ><b>HARGA (Rp)</b></td>
						<td ><b>AKUMULASI<BR>PENYUSUTAN</b></td>
						<td ><b>JUMLAH</b></td>
						<td ><b>HARGA (Rp)</b></td>
						<td ><b>AKUMULASI<BR>PENYUSUTAN</b></td>
						<td ><b>JUMLAH</b></td>
						<td ><b>HARGA (Rp)</b></td>
						<td ><b>AKUMULASI<BR>PENYUSUTAN</b></td>
					</tr>
				</thead>
					$daftarSOTKLama
					$daftarref_skpd_baru
				</table>
				<table border=1 style='width:100%;border-collapse: collapse;' cellpadding='3'>
					
				</table>
				<div class=\"footer\" text-align=right>Page: <span class=\"pagenum\"></span></div>
				</body>
				</html>
				</div>";
				
	}
	
	function cetakBast(){
	global $Main,$HTTP_COOKIE_VARS;
		$width='21cm';
		$height='33cm';
		$f_size1='11pt';
		$f_size2='12pt';
		$isiCetakST1='st1';
		
		$c = $HTTP_COOKIE_VARS['cofmSKPD'];
		$d = $HTTP_COOKIE_VARS['cofmUNIT'];
		$e = $HTTP_COOKIE_VARS['cofmSUBUNIT'];	
		$e1 = $HTTP_COOKIE_VARS['cofmSEKSI'];
		
		$kondWil = " a='10' and b='03' ";
		$kondStatusBrg = " and status_barang <> '3' and status_barang <> '4' and status_barang <> '5' ";
		$arrKond = array();
		if(!($c == '' || $c=='00') ) $arrKond[] = " c= '$c'";
		if(!($d == '' || $d=='00') ) $arrKond[] = " d= '$d'";
		if(!($e == '' || $e=='00') ) $arrKond[] = " e= '$e'";
		if(!($e1 == '' || $e1=='00' || $e1=='000') ) $arrKond[] = " e1= '$e1'";
		$KondisiSKPD = join(' and ', $arrKond);
		$KondisiSKPD = $KondisiSKPD==''? '' : ' and '.$KondisiSKPD;
		
		$cmbbast=$_REQUEST['bast'];//combo value
	 	$tgl=$_REQUEST['tgl'];//combo value
	 	$bln=$_REQUEST['bln'];//combo value
	 	$thn=$_REQUEST['thn'];//combo value
		$tanggal = $thn."-".$bln."-".$tgl;
		$day = date('D',strtotime($tanggal));
		$arrDay = array('Sun'=>'Minggu','Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>'Jumat','Sat'=>'Sabtu');
		$hari = $arrDay[$day];
		
		$bul = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );
		//$month = substr($bln,0,1)=='0'? substr($bln,-1) : $bln;
		$bulan = $bul[$bln];
		
		$aqry = "select * from ref_bast where no_ba='$cmbbast' and c='$c' and d='$d' and e='$e' and e1='$e1'";
		$isi = mysql_fetch_array(mysql_query($aqry));
		
		$nm_yg_menyerahkan = $isi['nm_yg_menyerahkan'];
		$nip_yg_menyerahkan = $isi['nip_yg_menyerahkan'];
		$jbt_yg_menyerahkan = $isi['jbt_yg_menyerahkan'];
		
		$nm_yg_menerima = $isi['nm_yg_menerima'];
		$nip_yg_menerima = $isi['nip_yg_menerima'];
		$jbt_yg_menerima = $isi['jbt_yg_menerima'];
		
		$kota = $isi['kota'];
		
		$tgl_cetak = JuyTgl1($tanggal);
		
		$skpd = mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='00'");
		$get = mysql_fetch_array($skpd);
		$nmSkpdPertama = $get['nm_skpd'];
		$skpd1 = mysql_fetch_array(mysql_query("select c1,c2,d2,e2,e12 from view_buku_induk2 where no_ba2 = '$cmbbast' group by c1"));
		$queSKPD1 = mysql_query("select nm_skpd from ref_skpd_baru where c1='{$skpd1['c1']}' and c2='{$skpd1['c2']}' and d2='{$skpd1['d2']}' and e2='00'");
		$get = mysql_fetch_array($queSKPD1);
		$nmSkpdKedua = $get['nm_skpd'];
		
		
		$aqry = "SELECT 'TANAH' as nm_aset, '3' as staset, '01' as f, '00' as g union
					SELECT 'PERALATAN DAN MESIN' as nm_aset, '3' as staset, '02' as f, '00' as g union
					SELECT 'GEDUNG DAN BANGUNAN' as nm_aset, '3' as staset, '03' as f, '00' as g union
					SELECT 'JARINGAN, IRIGASI DAN JALAN' as nm_aset, '3' as staset, '04' as f, '00' as g union
					SELECT 'ASET TETAP LAINNYA' as nm_aset, '3' as staset, '05' as f, '00' as g union
					SELECT 'KONSTRUKSI DALAM PENGERJAAN' as nm_aset, '3' as staset, '06' as f, '00' as g union
					SELECT 'TUNTUTAN GANTI RUGI' as nm_aset, '6' as staset, '07' as f, '24' as g union
					SELECT 'ASET LAIN-LAIN' as nm_aset, '9' as staset, '07' as f, '25' as g union
					SELECT 'ASET TIDAK BERWUJUD' as nm_aset, '8' as staset, '07' as f, '24' as g union
					SELECT 'KEMITRAAN DENGAN PIHAK KETIGA (PEMANFAATAN)' as nm_aset, '7' as staset, '07' as f, '23' as g union 
					SELECT 'EKSTRAKOMPTABLE' as nm_aset, '10' as staset, '00' as f, '00' as g";
		$qry = mysql_query($aqry);
		$no=0;
		$JmlBrg = 0;
		$JmlHrg = 0;
		$JmlSusut = 0;
		while($isi = mysql_fetch_array($qry)){
		$no++;
		$kondStaset = $isi['staset']==3?" and staset='{$isi['staset']}' and f='{$isi['f']}' " : " and staset='{$isi['staset']}' ";
		$aqry2="select sum(jml_barang) as jml_barang,
				sum(nilai_buku) as jml_hrg,
				sum(nilai_susut) as jml_susut
				from view_buku_induk2
				where $kondWil 
				$KondisiSKPD
				$kondStatusBrg
				$kondStaset
				and no_ba2='$cmbbast'";
		$isix = mysql_fetch_array(mysql_query($aqry2));
		$JmlBrg += $isix['jml_barang'];
		$JmlHrg += $isix['jml_hrg'];
		$JmlSusut += $isix['jml_susut'];
			$daftarTampil .= "<tr>
								<td style='border-right:0px;'>$no</td>
								<td>{$isi['nm_aset']}</td>
								<td align='center'>".number_format($isix['jml_barang'],0,',','.')."</td>
								<td align='right'>".number_format($isix['jml_hrg'],2,',','.')."</td>
								<td align='right'>".number_format($isix['jml_susut'],2,',','.')."</td>
							</tr>";
		}
		
		$totJmlBrg = number_format($JmlBrg,0,',','.');
		$totJmlHrg = number_format($JmlHrg,2,',','.');
		$totJmlSusut = number_format($JmlSusut,2,',','.');
		$daftarTampil .= "<tr>
							<td colspan='2' align='right'><b>TOTAL</b></td>
							<td align='center'><b>$totJmlBrg</b></td>
							<td align='right'><b>$totJmlHrg</b></td>
							<td align='right'><b>$totJmlSusut</b></td>
						</tr>";
		
		
		//DAFTAR REKAP	
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
			echo"<div style='width:$width;font-family:Times New Roman;page-break-after:always;padding: 5cm 2.54cm 2.54cm;'>
			<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
				</head>".
			"<body >
			
			<form name='adminForm' id='adminForm' method='post' action=''>".
				//$this->cetak_xls.		
				//$this->setCetak_Header_Nominatif($Mode).//$this->Cetak_Header.//
				"<div id='cntTerimaKondisi'>".
					//$TampilOpt['TampilOpt'].
				"</div>";
			echo "<table class='rangkacetak' style='width:$width'>
					<tr>
						<td align=center style='font-size:12pt;'><b><u>BERITA ACARA SERAH TERIMA BARANG</u></b></td>
					</tr>
					<tr>
						<td align=center style='font-size:12pt;'>Nomor : $cmbbast</td>
					</tr>
				</table>
				<br><br>
				<table border='0' class='rangkacetak' style='width: 100%;line-height:125%;' >
					<tr>
						<td colspan=3  style='font-size:$f_size2;'>Pada hari ini $hari Tanggal $tgl Bulan $bulan Tahun $thn kami yang bertanda tangan dibawah ini :</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;width:150'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$nm_yg_menyerahkan</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$nip_yg_menyerahkan</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$jbt_yg_menyerahkan</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SKPD</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$nmSkpdPertama</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'>Selanjutnya disebut <b>PIHAK PERTAMA</b></td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$nm_yg_menerima</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$nip_yg_menerima</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$jbt_yg_menerima</td>
					</tr>
					<tr>
						<td  style='font-size:$f_size2;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SKPD</td>
						<td  style='font-size:$f_size2;'>:</td>
						<td  style='font-size:$f_size2;'>$nmSkpdKedua</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'>Selanjutnya disebut <b>PIHAK KEDUA</b></td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'><br>
							PIHAK PERTAMA menyerahkan barang kepada PIHAK KEDUA, dan PIHAK KEDUA 
							menyatakan telah menerima barang dari PIHAK PERTAMA berupa daftar terlampir :<br><br>
						</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'>
							<table border=1 style='width:90%;border-collapse: collapse;' cellpadding='5'>
								<tr style='background-color: #DBDBDB;text-align:center;'>
									<td><b>No</b></td>
									<td><b>Nama dan Jenis Barang</b></td>
									<td><b>Jumlah</b></td>
									<td><b>Jumlah Harga (Rp)</b></td>
									<td><b>Akumulasi Penyusutan</b></td>
								</tr>
								$daftarTampil
							</table>
						</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'><br>
							Demikianlah berita acara serah terima barang ini dibuat oleh kedua belah pihak, 
							adapun barang-barang tersebut dalam keadaan baik dan cukup, sejak penandatanganan berita acara ini, 
							maka barang tersebut, menjadi tanggung jawab PIHAK KEDUA.
						</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'><br>
							$kota, $tgl_cetak
						</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:$f_size2;'><br>
							<div align='center'>
								<table style='width:90%;'>
									<tr>
										<td  style='font-size:$f_size2;text-align:center;'>Yang Menerima :</td>
										<td  style='font-size:$f_size2;text-align:center;'>Yang Menyerahkan,</td>
									</tr>
									<tr>
										<td  style='font-size:$f_size2;text-align:center;'>PIHAK KEDUA</td>
										<td  style='font-size:$f_size2;text-align:center;'>PIHAK PERTAMA</td>
									</tr>
									<tr>
										<td><br><br><br><br><br><br><br><br></td>
										<td><br><br><br><br><br><br><br><br></td>
									</tr>
									<tr>
										<td  style='font-size:$f_size2;text-align:center;'><u>($nm_yg_menerima)</u></td>
										<td  style='font-size:$f_size2;text-align:center;'><u>($nm_yg_menyerahkan)</u></td>
									</tr>
									<tr>
										<td  style='font-size:$f_size2;text-align:center;'>NIP :$nip_yg_menerima</td>
										<td  style='font-size:$f_size2;text-align:center;'>NIP :$nip_yg_menyerahkan</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
				</body>
				</html>
				</div>";
				
	}
	
	function cetakRincian(){
	global $Main,$HTTP_COOKIE_VARS;
		$width='33cm';//'21cm';
		$height='21cm';//'33cm';
		$f_size1='11pt';
		$f_size2='12pt';
		$isiCetakST1='st1';
		
		$c = $HTTP_COOKIE_VARS['cofmSKPD'];
		$d = $HTTP_COOKIE_VARS['cofmUNIT'];
		$e = $HTTP_COOKIE_VARS['cofmSUBUNIT'];	
		$e1 = $HTTP_COOKIE_VARS['cofmSEKSI'];
		
		$bast = $_REQUEST['bast'];
		$getba = mysql_fetch_array(mysql_query("select * from ref_bast where no_ba = '$bast' and c='$c' and d='$d' and e='$e' and e1='$e1'"));
		$tglba = TglInd($getba['tgl_ba']);
		
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='00'"));
		$nmBidang = $get['nm_skpd']==''?'Semua BIDANG':$get['nm_skpd'];
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='00'"));
		$nmSkpd = $get['nm_skpd']==''?'Semua SKPD':$get['nm_skpd'];
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='$e' and e1='000'"));
		$nmUnit = $get['nm_skpd']==''?'Semua UNIT':$get['nm_skpd'];
		$get = mysql_fetch_array(mysql_query("select nm_skpd from ref_skpd where c='$c' and d='$d' and e='$e' and e1='$e1'"));
		$nmSubUnit = $get['nm_skpd']==''?'Semua SUB UNIT':$get['nm_skpd'];
		
		$arrKond = array();
		$kondWil = " a='10' and b='03' ";
		if(!($c == '' || $c=='00') ) $arrKond[] = " c= '$c'";
		if(!($d == '' || $d=='00') ) $arrKond[] = " d= '$d'";
		if(!($e == '' || $e=='00') ) $arrKond[] = " e= '$e'";
		if(!($e1 == '' || $e1=='00' || $e1=='000') ) $arrKond[] = " e1= '$e1'";
		if(!($bast == '') ) $arrKond[] = " no_ba2= '$bast'";
		$arrKond[] = " status_barang <> '3' and status_barang <> '4' and status_barang <> '5' ";
		$Kondisi = join(' and ', $arrKond);
		$Kondisi = $Kondisi==''? '' : ' and '.$Kondisi;
		
		$aqry = "select * from view_buku_induk2 where $kondWil $Kondisi";
		$qry = mysql_query($aqry);
		$no=0;
		while($isi = mysql_fetch_array($qry)){
			$no++;
			$kode_brg = $isi['f'].'.'.$isi['g'].'.'.$isi['h'].'.'.$isi['i'].'.'.$isi['j'];
			$tampilHarga = !empty($cbxDlmRibu)? number_format($isi['nilai_buku']/1000, 2, ',', '.') : number_format($isi['nilai_buku'], 2, ',', '.');
			$tampilAkumSusut = !empty($cbxDlmRibu)? number_format($isi['nilai_susut']/1000, 2, ',', '.') : number_format($isi['nilai_susut'], 2, ',', '.');
			$jns_hibah = $isi['jns_hibah'] == 0?'':$isi['jns_hibah'];
			$AsalUsul = $isi['asal_usul'];	
			if($Main->TAMPIL_BIDANG){				
				$nmopdarr=array();	
				$isi['vBidang']='';	
				$fmSKPD = $_REQUEST['ref_skpd_baruSkpdfmSKPD'];
				if($fmSKPD==''||$fmSKPD=='00'){
					$get = mysql_fetch_array(mysql_query(
						"select * from v_bidang where c='".$isi['c']."' "
					));		
					if($get['nmbidang']<>'') $nmopdarr[] = $get['c'].'. '. $get['nmbidang'];
				}
				$fmUNIT = $_REQUEST['ref_skpd_baruSkpdfmUNIT'];
				if($fmUNIT==''||$fmUNIT=='00'){
					$get = mysql_fetch_array(mysql_query(
						"select * from v_opd where c='".$isi['c']."' and d='".$isi['d']."' "
					));		
					if($get['nmopd']<>'') $nmopdarr[] =  $get['d'].'. '. $get['nmopd'];
				}	
				$fmSUBUNIT = $_REQUEST['ref_skpd_baruSkpdfmSUBUNIT'];
				if($fmSUBUNIT==''||$fmSUBUNIT=='00'){			
					$get = mysql_fetch_array(mysql_query(
						"select * from v_unit where c='".$isi['c']."' and d='".$isi['d']."' and e='".$isi['e']."'"
					));		
					if($get['nmunit']<>'') $nmopdarr[] =  $get['e'].'. '. $get['nmunit'];
				}
				
				$fmSEKSI = $_REQUEST['ref_skpd_baruSkpdfmSEKSI'];
				if($fmSEKSI==''||$fmSEKSI=='000'){		
					$get = mysql_fetch_array(mysql_query(
						"select * from ref_skpd where c='".$isi['c']."' and d='".$isi['d']."' and e='".$isi['e']."' and e1='".$isi['e1']."'"
					));		
					if($get['nm_skpd']<>'') $nmopdarr[] =  $get['e1'].'. '. $get['nm_skpd'];
				}
				
				//$isi['vBidang'] = "<td class=\"$clGaris\">".join(' / ', $nmopdarr )."</td>";
				//$isi['vBidang'] = "<td class=\"$clGaris\">".join(' - ', $nmopdarr )."</td>";
				$isi['vBidang'] = join(' - ', $nmopdarr );
				if($isi['vBidang']<>'') $isi['vBidang'] = 'SKPD: '.$isi['vBidang'];				
			}
			if($Main->MODUL_BAST){
				$no_ba = $isi['no_ba'];
				$keg = $isi['bk_p'].'.'.$isi['ck_p'].'.'.$isi['dk_p'].'.'.$isi['p'].'.'.$isi['q'];
				$vkegiatan = $isi['p']==0 ? '' : "$keg";
				$tgl_ba = TglInd( $isi['tgl_ba'] );
				$vbast = "<td class=\"$clGaris\">$no_ba/<br>$tgl_ba/<br>$vkegiatan</td>";
			}
			if($Main->MODUL_SPK){
				$no_spk = $isi['no_spk'];
				$tgl_spk = TglInd( $isi['tgl_spk'] );
				$vspk = "<td class=\"$clGaris\">$no_spk/<br>$tgl_spk</td>";
			}
			$pgw = mysql_fetch_array(mysql_query(
				"select * from ref_pegawai where id ='".$isi['ref_idpemegang2']."'"
			));
			$ketpenanggungjawab = '<br>Nip. '.$pgw['nip'].' / '.$pgw['nama'];
			$gbr = mysql_fetch_array(mysql_query("select count(*) as cnt from gambar where idbi='".$isi['idawal']."' "));
			$ketgbr = '<br>Gambar : '.$gbr['cnt'];	
			$ISI5 = "";	$ISI6 = "";	$ISI7 = "";	$ISI10 = ""; $ISI15='';
			//--- ambil data kib by noreg --------------------------------				
			if ($isi['f'] == "01" || $isi['f'] == "02" || $isi['f'] == "03" || $isi['f'] == "04" || $isi['f'] == "05" || $isi['f'] == "06" || $isi['f'] == "07") {
				$KondisiKIB = "
				where 
				a1= '{$isi['a1']}' and 
				a = '{$isi['a']}' and 
				b = '{$isi['b']}' and 
				c = '{$isi['c']}' and 
				d = '{$isi['d']}' and 
				e = '{$isi['e']}' and 
				e1 = '{$isi['e1']}' and 
				f = '{$isi['f']}' and 
				g = '{$isi['g']}' and 
				h = '{$isi['h']}' and 
				i = '{$isi['i']}' and 
				j = '{$isi['j']}' and 
				noreg = '{$isi['noreg']}' and 
				tahun = '{$isi['tahun']}' ";
			}
			if ($isi['f'] == "01") {//KIB A
				//"concat(a1,a,b,c,d,e,f,g,h,i,j,noreg,tahun)='{$isi['a1']}{$isi['a']}{$isi['b']}{$isi['c']}{$isi['d']}{$isi['e']}{$isi['f']}{$isi['g']}{$isi['h']}{$isi['i']}{$isi['j']}{$isi['noreg']}{$isi['tahun']}'
				$QryKIB_A = mysql_query("select * from kib_a  $KondisiKIB  limit 0,1");
				while ($isiKIB_A = mysql_fetch_array($QryKIB_A)) {
					$isiKIB_A = array_map('utf8_encode', $isiKIB_A);	
	
					//if($SPg == 'belumsensus'){
						$alm = '';
						$alm .= ifempty($isiKIB_A['alamat'],'-');
						$alm .= ($isi['rt'] && $isi['rw']) == ''? '' : '<br>RT/RW. '.$isi['rt'].'/'.$isi['rw'];		
						$alm .= $isi['kampung'] == ''? '' : '<br>Kp/Komp. '.$isi['kampung'];		
						$alm .= $isiKIB_A['alamat_kel'] != ''? '<br>Kel/Desa. '.$isiKIB_A['alamat_kel'] : '';
						$alm .= $isiKIB_A['alamat_kec'] != ''? '<br>Kec. '.$isiKIB_A['alamat_kec'] : '';
						$alm .= $isiKIB_A['alamat_kota'] != ''? '<br>'.$isiKIB_A['alamat_kota'] : '';
						$ISI5 = $alm;
					//}else{
					//	$ISI5 = '';
					//}
					$ISI6 = "{$isiKIB_A['sertifikat_no']}";  //$ISI10 = "{$isiKIB_A['luas']}";
					$ISI15 = "{$isiKIB_A['ket']}";
					$ISI10 = number_format($isiKIB_A['luas'],2,',','.');
				}
			}
			if ($isi['f'] == "02") {//KIB B;
				//"concat(a1,a,b,c,d,e,f,g,h,i,j,noreg,tahun)='{$isi['a1']}{$isi['a']}{$isi['b']}{$isi['c']}{$isi['d']}{$isi['e']}{$isi['f']}{$isi['g']}{$isi['h']}{$isi['i']}{$isi['j']}{$isi['noreg']}{$isi['tahun']}'";
				$QryKIB_B = mysql_query("select * from kib_b  $KondisiKIB limit 0,1");
				while ($isiKIB_B = mysql_fetch_array($QryKIB_B)) {
					$isiKIB_B = array_map('utf8_encode', $isiKIB_B);
					$ISI5 = "{$isiKIB_B['merk']}";
					$ISI6 = "{$isiKIB_B['no_pabrik']} /<br> {$isiKIB_B['no_rangka']} /<br> {$isiKIB_B['no_mesin']} /<br> {$isiKIB_B['no_polisi']}";
					$ISI7 = "{$isiKIB_B['bahan']}";							
					$ISI15 = "{$isiKIB_B['ket']}";
				}
			}
			if ($isi['f'] == "03") {//KIB C;
				$QryKIB_C = mysql_query("select * from kib_c  $KondisiKIB limit 0,1");
				while ($isiKIB_C = mysql_fetch_array($QryKIB_C)) {
					$isiKIB_C = array_map('utf8_encode', $isiKIB_C);
					//if($SPg == 'belumsensus'){
						$alm = '';
						$alm .= ifempty($isiKIB_C['alamat'],'-');		
						$alm .= ($isi['rt'] && $isi['rw']) == ''? '' : '<br>RT/RW. '.$isi['rt'].'/'.$isi['rw'];		
						$alm .= $isi['kampung'] == ''? '' : '<br>Kp/Komp. '.$isi['kampung'];
						$alm .= $isiKIB_C['alamat_kel'] != ''? '<br>Kel/Desa. '.$isiKIB_C['alamat_kel'] : '';
						$alm .= $isiKIB_C['alamat_kec'] != ''? '<br>Kec. '.$isiKIB_C['alamat_kec'] : '';
						$alm .= $isiKIB_C['alamat_kota'] != ''? '<br>'.$isiKIB_C['alamat_kota'] : '';
						$ISI5 = $alm;
					//}else{
					//	$ISI5 = '';
					//}
					$ISI6 = "{$isiKIB_C['dokumen_no']}";
					$ISI10 = $Main->Bangunan[$isiKIB_C['kondisi_bangunan'] - 1][1];
					$ISI15 = "{$isiKIB_C['ket']}";
				}
			}
			if ($isi['f'] == "04") {//KIB D;
				$QryKIB_D = mysql_query("select * from kib_d  $KondisiKIB limit 0,1");
				while ($isiKIB_D = mysql_fetch_array($QryKIB_D)) {
					$isiKIB_D = array_map('utf8_encode', $isiKIB_D);
					//if($SPg == 'belumsensus'){
						$alm = '';
						$alm .= ifempty($isiKIB_D['alamat'],'-');
						$alm .= ($isi['rt'] && $isi['rw']) == ''? '' : '<br>RT/RW. '.$isi['rt'].'/'.$isi['rw'];		
						$alm .= $isi['kampung'] == ''? '' : '<br>Kp/Komp. '.$isi['kampung'];		
						$alm .= $isiKIB_D['alamat_kel'] != ''? '<br>Kel/Desa. '.$isiKIB_D['alamat_kel'] : '';
						$alm .= $isiKIB_D['alamat_kec'] != ''? '<br>Kec. '.$isiKIB_D['alamat_kec'] : '';
						$alm .= $isiKIB_D['alamat_kota'] != ''? '<br>'.$isiKIB_D['alamat_kota'] : '';
						$ISI5 = $alm;
					//}else{
					//	$ISI5 = '';
					//}
					$ISI6 = "{$isiKIB_D['dokumen_no']}";
					$ISI15 = "{$isiKIB_D['ket']}";
				}
			}
			if ($isi['f'] == "05") {//KIB E;
				$QryKIB_E = mysql_query("select * from kib_e  $KondisiKIB limit 0,1");
				while ($isiKIB_E = mysql_fetch_array($QryKIB_E)) {
					$isiKIB_E = array_map('utf8_encode', $isiKIB_E);
					$ISI7 = "{$isiKIB_E['seni_bahan']}";
					$ISI15 = "{$isiKIB_E['ket']}";
				}
			}
			if ($isi['f'] == "06") {//KIB F;
				$sQryKIB_F = "select * from kib_f  $KondisiKIB limit 0,1";
				$QryKIB_F = mysql_query($sQryKIB_F);
				//echo "<br>qrykibf= $sQryKIB_F";
				while ($isiKIB_F = mysql_fetch_array($QryKIB_F)) {
					$isiKIB_F = array_map('utf8_encode', $isiKIB_F);
					//if($SPg == 'belumsensus'){
						$alm = '';
						$alm .= ifempty($isiKIB_F['alamat'],'-');
						$alm .= ($isi['rt'] && $isi['rw']) == ''? '' : '<br>RT/RW. '.$isi['rt'].'/'.$isi['rw'];		
						$alm .= $isi['kampung'] == ''? '' : '<br>Kp/Komp. '.$isi['kampung'];		
						$alm .= $isiKIB_F['alamat_kel'] != ''? '<br>Kel/Desa. '.$isiKIB_F['alamat_kel'] : '';
						$alm .= $isiKIB_F['alamat_kec'] != ''? '<br>Kec. '.$isiKIB_F['alamat_kec'] : '';
						$alm .= $isiKIB_F['alamat_kota'] != ''? '<br>'.$isiKIB_F['alamat_kota'] : '';
						$ISI5 = $alm;
					//}else{
					//	$ISI5 = '';
					//}
					$ISI6 = "{$isiKIB_F['dokumen_no']}";
					$ISI10 = $Main->Bangunan[$isiKIB_F['bangunan'] - 1][1];
					$ISI15 = "{$isiKIB_F['ket']}";
				}
			}
			if ($isi['f'] == "07") {//KIB E;
				$QryKIB_E = mysql_query("select * from kib_g  $KondisiKIB limit 0,1");
				while ($isiKIB_E = mysql_fetch_array($QryKIB_E)) {
					$isiKIB_E = array_map('utf8_encode', $isiKIB_E);
					$ISI7 = "{$isiKIB_E['pencipta']}";
	//							$ISI7 = "{$isiKIB_E['jenis']}";
					$ISI15 = "{$isiKIB_E['ket']}";
				}
			}
			
			$ISI5 = !empty($ISI5) ? $ISI5 : "-";
			$ISI6 = !empty($ISI6) ? $ISI6 : "-";
			$ISI7 = !empty($ISI7) ? $ISI7 : "-";
			$ISI10 = !empty($ISI10) ? $ISI10 : "-";
			$ISI12 = !empty($ISI12) ? $ISI12 : "-";
			$ISI15 = !empty($ISI15) ? $ISI15 : "-";
		
			$daftarRincian .= "<tr>
							<td align=center>$no</td>
							<td>$kode_brg/<br>".$isi['id']."/<br>".$isi['idawal']."</td>
							<td align=center>{$isi['noreg']}</td>
							<td>{$isi['nm_barang']}</td>
							<td>$ISI5</td>
							<td>$ISI6</td>
							<td>$ISI7</td>
							<td>".$Main->AsalUsul[$isi['asal_usul']-1][1]."<br>/".$jns_hibah."<br>/".$Main->StatusBarang[$isi['status_barang']-1][1]."</td>
							<td align=center>".$isi['thn_perolehan']."</td>
							<td>$ISI10</td>
							<td align=center>".$Main->KondisiBarang[$isi['kondisi']-1][1]."</td>
							<td align=right>{$isi['jml_barang']} {$isi['satuan']}</td>
							<td align=right>$tampilHarga</td>
							<td align=right>$tampilAkumSusut</td>
							<!--$vbast
							$vspk-->
							<td>$ISI15 $ketgbr $ketpenanggungjawab ".'<br>'.$isi['vBidang']."</td>
							</tr>"; 
			
			$jmlBrg += $isi['jml_barang'];
			$jmlHrg += $isi['nilai_buku'];
			$jmlSusut += $isi['nilai_susut'];
		}
		$totJmlBrg = number_format($jmlBrg, 0, ',', '.');
		$totJmlHrg = number_format($jmlHrg, 2, ',', '.');
		$totJmlSusut = number_format($jmlSusut, 2, ',', '.');
		$daftarRincian .= "<tr>
							<td colspan='12' align=center><b>TOTAL</b></td>
							<!--<td align=right><b>$totJmlBrg</b></td>-->
							<td align=right><b>$totJmlHrg</b></td>
							<td align=right><b>$totJmlSusut</b></td>
							<td></td>
							</tr>";
		
		
		//DAFTAR REKAP	
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
			echo"<div style='width:$width;font-family:Arial;'>
			<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
				</head>".
			"<body >
			
			<form name='adminForm' id='adminForm' method='post' action=''>".
				//$this->cetak_xls.		
				//$this->setCetak_Header_Nominatif($Mode).//$this->Cetak_Header.//
				"<div id='cntTerimaKondisi'>".
					//$TampilOpt['TampilOpt'].
				"</div>";
			echo "
				
				<table class='rangkacetak' style='width:$width'>
					<tr>
						<td align=center style='font-size:12pt;'><b><u>LAMPIRAN MUTASI BARANG DARI SOTK LAMA KE SOTK BARU</u></b></td>
					</tr>
					<tr>
						<td align=center style='font-size:10pt;'>NO BAST : $bast &nbsp;&nbsp;&nbsp; TANGGAL BAST : $tglba</td>
					</tr>
				</table>
				<br><br>
				<table>
					<tr>
						<td><b>BIDANG</b></td>
						<td><b>:</b></td>
						<td><b>$nmBidang</b></td>
					</tr>
					<tr>
						<td><b>SKPD</b></td>
						<td><b>:</b></td>
						<td><b>$nmSkpd</b></td>
					</tr>
					<tr>
						<td><b>UNIT</b></td>
						<td><b>:</b></td>
						<td><b>$nmUnit</b></td>
					</tr>
					<tr>
						<td><b>SUB UNIT</b></td>
						<td><b>:</b></td>
						<td><b>$nmSubUnit</b></td>
					</tr>
					
				</table>
				<br><br>
				<table border=1 style='width:100%;border-collapse: collapse;' cellpadding='5'>
				
					<tr style='background-color: #DBDBDB;text-align:center;'>
						<td colspan='3' style='font-size:8pt;'><b>Nomor</b></td>
						<td colspan='3' style='font-size:8pt;'><b>Spesifikasi Barang</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Bahan</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Cara Perolehan /<br>Sumber Dana /<br>Status Barang /<br>Penggunaan</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Tahun Perolehan</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Ukuran Barang /<br>Konstruksi (P,SP,D)</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Keadaan Barang<br>(B,KB,RB)</b></td>
						<td colspan='2' style='font-size:8pt;'><b>Jumlah</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Akumulasi <br>Penyusutan</b></td>
						<!--<td rowspan='2' style='font-size:8pt;'><b>BAST Lama/<br>Kegiatan</b></td>
						<td rowspan='2' style='font-size:8pt;'><b>Kontrak</b></td>-->
						<td rowspan='2' style='font-size:8pt;'><b>Keterangan/<br>Tgl. Buku/<br>Tahun Sensus</b></td>
					</tr>
					<tr style='background-color: #DBDBDB;text-align:center;'>
						<td style='font-size:8pt;'><b>No</b></td>
						<td style='font-size:8pt;'><b>Kode Barang/<br>ID Barang/<br>ID Awal</b></td>
						<td style='font-size:8pt;'><b>Reg.</b></td>
						<td style='font-size:8pt;'><b>Nama / Jenis Barang</b></td>
						<td style='font-size:8pt;'><b> Merk / Tipe / Alamat</b></td>
						<td style='font-size:8pt;'><b>No. Sertifikat / No. Pabrik / No. Chasis /<br>No. Mesin / No. Polisi</b></td>
						<td style='font-size:8pt;'><b>Barang</b></td>
						<td style='font-size:8pt;'><b>Harga</b></td>
					</tr>
				
					<!--$aqry-->
					$daftarRincian
				</table>
				<table border=1 style='width:100%;border-collapse: collapse;' cellpadding='3'>
					
				</table>
				<br><br><br>
				<br><br><br>
				</body>
				</html>
				</div>";
				
	}
}
	
$ref_sotk_baru = new ref_sotk_baruObj();

?>