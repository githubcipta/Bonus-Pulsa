<?php

class MappingBarangObj extends DaftarObj2{
	var $Prefix = 'MappingBarang';
	var $SHOW_CEK = TRUE;	
	var $TblName = 'view_buku_induk2';//view2_sensus';
	var $TblName_Hapus = 'buku_induk';
	var $TblName_Edit = 'buku_induk';
	var $KeyFields = array('id');
	var $FieldSum = array('nilai_buku','nilai_susut');
	var $fieldSum_lokasi = array( 12,12);
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 11, 8, 8);
	var $FieldSum_Cp2 = array( 1, 1, 1);
	var $totalCol = 14;	
	var $FormName = 'MappingBarangForm';
	var $pagePerHal = '';
	//var $withSumAll = FALSE;
	//var $withSumHal = FALSE;
	//var $WITH_HAL = FALSE;
	
	var $PageTitle = 'Mapping Kode Barang';
	var $PageIcon = 'images/penatausahaan_ico.gif';
	var $ico_width = '20';
	var $ico_height = '30';
	
	var $fileNameExcel='MAPPING KODE BARANG PERMEN 108 THN 2016.xls';
	var $Cetak_Judul = 'MAPPING KODE BARANG PERMEN 108 THN 2016';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $fmST = 0;
	var $idpilih = '';
	//var $row_params= " valign='top'";
	
	
	function setTitle(){
		global $Main;
		return 'MAPPING KODE BARANG PERMEN 108 THN 2016';	

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
		$uid = $_COOKIE['coID'];
		return 
			"<td>".genPanelIcon("javascript:".$this->Prefix.".mapping()","mutasi.png","Mapping", 'Mapping')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".NoUrut()","edit_f2.png","No Urut", 'No Urut')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Batal()","delete_f2.png","Batal", 'Batal')."</td>";
	}
	
	function setMenuView(){		
		return 			
			"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakHal(\"$Op\")","print_f2.png",'Cetak',"Cetak Daftar per Halaman")."</td>".			
			//"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakAll(\"$Op\")","print_f2.png",'Cetak',"Cetak Daftar")."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".exportXls(\"$Op\")","export_xls.png",'Excel',"Export Excel")."</td>";					

	}
	
	function genDaftarOpsi(){
		global $Main,$fmFiltThnBuku,$HTTP_COOKIE_VARS;
		Global $fmSKPDBidang,$fmSKPDskpd;
		 $fmSKPDUrusan = ($HTTP_COOKIE_VARS['cofmURUSAN']=='' || $HTTP_COOKIE_VARS['cofmURUSAN']=='0') ? cekPOST($this->Prefix.'fmSKPDUrusan') : $HTTP_COOKIE_VARS['cofmURUSAN'];
		 $fmSKPDBidang2 = ($HTTP_COOKIE_VARS['cofmSKPD2']=='' || $HTTP_COOKIE_VARS['cofmSKPD2']=='00') ? cekPOST($this->Prefix.'fmSKPDBidang2') : $HTTP_COOKIE_VARS['cofmSKPD2'];
		 $fmSKPDskpd2 = ($HTTP_COOKIE_VARS['cofmUNIT2']=='' || $HTTP_COOKIE_VARS['cofmUNIT2']=='00') ? cekPOST($this->Prefix.'fmSKPDskpd2') : $HTTP_COOKIE_VARS['cofmUNIT2'];
		 $fmSKPDUnit2 = ($HTTP_COOKIE_VARS['cofmSUBUNIT2']=='' || $HTTP_COOKIE_VARS['cofmSUBUNIT2']=='00') ? cekPOST($this->Prefix.'fmSKPDUnit2') : $HTTP_COOKIE_VARS['cofmSUBUNIT2'];
		 $fmSKPDSubUnit2 = ($HTTP_COOKIE_VARS['cofmSEKSI2']=='' || $HTTP_COOKIE_VARS['cofmSEKSI2']=='000') ? cekPOST($this->Prefix.'fmSKPDSubUnit2') : $HTTP_COOKIE_VARS['cofmSEKSI2'];
		$stmutasi = $_REQUEST['stmutasi'];
		$staset = $_REQUEST['staset'];
		$jmPerHal = $_REQUEST['jmPerHal']==''?$Main->PagePerHal:$_REQUEST['jmPerHal'];
		$fmCariComboField = $_REQUEST['fmCariComboField'];
		$fmCariComboIsi = $_REQUEST['fmCariComboIsi'];
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');
		$arrMutasi = array(
					array("1","Belum Mapping"),
					array("2","Sudah Mapping"),
				);
		
		$ArFieldCari = array(
				array('nm_barang', 'Nama Barang'),
				array('kd_barang', 'Kode Barang'),
				array('thn_perolehan', 'Tahun Perolehan'),
				//array('ket', 'Keterangan')
					);
		
		$arrOrder = array(
			array('1','Tahun Perolehan'),
			array('2','Keadaan Barang'),	
			array('3','Tahun Buku'),		
		);
		
		$OptCari =  //$Main->ListData->OptCari =
			"<table width=\"100%\" height=\"100%\" class=\"adminform\" style='margin: 4 0 0 0;'>
			<tr > 
			<td align='Left'> &nbsp;&nbsp;".
			"<div style='float:left'>".
				CariCombo4($ArFieldCari, $fmCariComboField, $fmCariComboIsi,"MappingBarang.refreshList(true)" ).
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
			"<table width=\"100%\" class=\"adminform\">	<tr>		
			<td width=\"50%\" valign=\"top\">		
				<table>
					<tr><td width='100'>URUSAN</td><td width='10'>:</td><td>".
						$this->cmbQueryUrusan($this->Prefix.'fmSKPDUrusan',$fmSKPDUrusan,'','onchange=MappingBarang.UrusanAfter() '.$disabled1,'--- Pilih URUSAN ---','00')."</td></tr>
					<tr><td width='100'>BIDANG</td><td width='10'>:</td><td>".
						$this->cmbQueryBidang($this->Prefix.'fmSKPDBidang2',$fmSKPDBidang2,'','onchange=MappingBarang.BidangAfter2() '.$disabled1,'--- Pilih BIDANG ---','00')."</td></tr>".
					"<tr><td width='100'>SKPD</td><td width='10'>:</td><td>".
						$this->cmbQuerySKPD($this->Prefix.'fmSKPDskpd2',$fmSKPDskpd2,'','onchange=MappingBarang.SKPDAfter2() '.$disabled1,'--- Pilih SKPD ---','00').
					"</td></tr>".
					"<tr><td width='100'>UNIT</td><td width='10'>:</td><td>".
						$this->cmbQueryUnit($this->Prefix.'fmSKPDUnit2',$fmSKPDUnit2,'','onchange=MappingBarang.UnitAfter2() '.$disabled1,'--- Pilih UNIT ---','00').
					"</td></tr>".
					"<tr><td width='100'>SUB UNIT</td><td width='10'>:</td><td>".
						$this->cmbQuerySubUnit($this->Prefix.'fmSKPDSubUnit2',$fmSKPDSubUnit2,'','onchange=MappingBarang.refreshList(true) '.$disabled1,'--- Pilih SUB UNIT ---','000').
					"</td></tr>".
				"</table>". 
			"</td>
			
			</tr></table>".
			$OptCari.
			genFilterBar(
				array(	
					"<div style='float:left;padding: 0 4 0 0;height:22;padding: 4 4 0 0'>".
					cmb2D_v2('stmutasi', $stmutasi, $arrMutasi, '', 'Status Mapping', '').
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
		global $fmPILCARI;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
				
		$arrKondisi = array();
		/*$fmSKPD = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST($this->Prefix.'SkpdfmSKPD');
		$fmUNIT = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST($this->Prefix.'SkpdfmUNIT');
		$fmSUBUNIT = isset($HTTP_COOKIE_VARS['cofmSUBUNIT'])? $HTTP_COOKIE_VARS['cofmSUBUNIT']: cekPOST($this->Prefix.'SkpdfmSUBUNIT');
		$fmSEKSI = isset($HTTP_COOKIE_VARS['cofmSEKSI'])? $HTTP_COOKIE_VARS['cofmSEKSI']: cekPOST($this->Prefix.'SkpdfmSEKSI');

		$arrKondisi[] = 
		//$tes =
		getKondisiSKPD3(
			$Main->DEF_KEPEMILIKAN, 
			$Main->Provinsi[0], 
			$Main->DEF_WILAYAH, 
			$fmSKPD, 
			$fmUNIT, 
			$fmSUBUNIT,
			$fmSEKSI
		);*/
		
		$fmSKPDUrusan = cekPOST('MappingBarangfmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('MappingBarangfmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('MappingBarangfmSKPDskpd2');
		$fmSKPDUnit2 = cekPOST('MappingBarangfmSKPDUnit2');
		$fmSKPDSubUnit2 = cekPOST('MappingBarangfmSKPDSubUnit2');
		
		if($fmSKPDUrusan <> '00' && $fmSKPDBidang2 == '00'){
			$SOTKBaru = $fmSKPDUrusan;
		}elseif($fmSKPDUrusan <> '00' && $fmSKPDBidang2 <> '00' && $fmSKPDskpd2 == '00'){
			$SOTKBaru = $fmSKPDUrusan.$fmSKPDBidang2;
		}elseif($fmSKPDUrusan <> '00' && $fmSKPDBidang2 <> '00' && $fmSKPDskpd2 <> '00' && $fmSKPDUnit2 == '00'){
			$SOTKBaru = $fmSKPDUrusan.$fmSKPDBidang2.$fmSKPDskpd2;
		}elseif($fmSKPDUrusan <> '00' && $fmSKPDBidang2 <> '00' && $fmSKPDskpd2 <> '00' && $fmSKPDUnit2 <> '00' && $fmSKPDSubUnit2 == '000'){
			$SOTKBaru = $fmSKPDUrusan.$fmSKPDBidang2.$fmSKPDskpd2.$fmSKPDUnit2;
		}elseif($fmSKPDUrusan <> '00' && $fmSKPDBidang2 <> '00' && $fmSKPDskpd2 <> '00' && $fmSKPDUnit2 <> '00' && $fmSKPDSubUnit2 <> '000'){
			$SOTKBaru = $fmSKPDUrusan.$fmSKPDBidang2.$fmSKPDskpd2.$fmSKPDUnit2.$fmSKPDSubUnit2;
		}else{
			$SOTKBaru = '';
		}
		
		if(!empty($SOTKBaru)) $arrKondisi[] = " concat(c1,c2,d2,e2,e12) like '$SOTKBaru%' ";
		
		
		$fmCariComboIsi = cekPOST('fmCariComboIsi');
		$fmCariComboField = cekPOST('fmCariComboField');
		if (!empty($fmCariComboIsi) && !empty($fmCariComboField)) {
			//if ($fmCariComboField != 'ket' && $fmCariComboField != 'Cari Data') {
			if ($fmCariComboField != 'Cari Data') {
				if(  $fmCariComboField == 'kd_barang'){
					
					$arrKondisi[] = " concat(f,'.',g,'.',h,'.',i,'.',j,'.') like '$fmCariComboIsi%' ";
				}else{
					$arrKondisi[] = " $fmCariComboField like '%$fmCariComboIsi%' ";
				}
				
			}
		}
		
		$arrKondisi[] = "status_barang <> '3' and status_barang <> '4' and status_barang <> '5'";
		
		$fmStMutasi=  cekPOST('stmutasi');
		$fmStAset=  cekPOST('staset');
		$fmThn2=  cekPOST('fmThn2');
		$fmSemester = cekPOST('fmSemester');
		
		if($fmStAset==1){
			if(!empty($fmStAset)) $arrKondisi[] = " staset <= '9' ";
		}else{
			if(!empty($fmStAset)) $arrKondisi[] = " staset = '$fmStAset' ";	
		}
		
		if($fmStMutasi==1){
			if(!empty($fmStMutasi)) $arrKondisi[] = " (f1 is null or f1 = '0') ";
		}else{
			if(!empty($fmStMutasi)) $arrKondisi[] = " (f1 is not null or f1 <> '0') ";	
		}
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
			switch($fmORDER1){
				//case '': $arrOrders[] = " tgl DESC " ;break;
				case '1': $arrOrders[] = " thn_perolehan $Asc1 " ;break;
				case '2': $arrOrders[] = " kondisi $Asc1 " ;break;
				case '3': $arrOrders[] = " year(tgl_buku) $Asc1 " ;break;			
			
			}
			$arrOrders [] = " a1,a,b,c,d,e,e1,f,g,h,i,j,tahun,noreg";
			$Order= join(',',$arrOrders);	
			$OrderDefault = '';// Order By no_terima desc ';
			$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		//}
		//$Order ="";
		//limit --------------------------------------
		/**$HalDefault=cekPOST($this->Prefix.'_hal',1);	//Cat:Settingan Lama				
		$Limit = " limit ".(($HalDefault	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $Main->PagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;		
		**/
		$jmPerHal = cekPOST("jmPerHal"); 
		$Main->PagePerHal = !empty($jmPerHal) ? $jmPerHal : $Main->PagePerHal;
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
	
	function genDaftarInitial($tipe='',$fmSKPD='',$fmUNIT='',$height=''){
		global $HTTP_COOKIE_VARS;
		$vOpsi = $this->genDaftarOpsi();
		$fmSKPDUrusan = $HTTP_COOKIE_VARS['cofmURUSAN'];
		$fmSKPDSkpd = $HTTP_COOKIE_VARS['cofmSKPD2'];
		$fmSKPDUnit = $HTTP_COOKIE_VARS['cofmUNIT2'];
		$fmSKPDSubUnit = $HTTP_COOKIE_VARS['cofmSUBUNIT2'];
		$fmSKPDSeksi = $HTTP_COOKIE_VARS['cofmSEKSI2'];
		$fmFiltThnAnggaran = $HTTP_COOKIE_VARS['coThnAnggaran'];
		
		if($tipe=='windowshow'){
			$jns = "<input type='hidden' value='windowshow' id='jns' name='jns' >";
			$title = "";
		}else{
			$jns = "<input type='hidden' value='' id='jns' name='jns' >";
			$title = "<div id='{$this->Prefix}_cont_title' style='position:relative'></div>";
		}
		
		return			
			"<div id='{$this->Prefix}_cont_title' style='position:relative'></div>".
			"<div id='{$this->Prefix}_cont_opsi' style='position:relative'>". 		
				"<input type='hidden' value='$fmFiltThnAnggaran' id='fmFiltThnAnggaran' name='fmFiltThnAnggaran' >".
				//$jns.		
				"<input type='hidden' id='".$this->Prefix."fmSKPDUrusan' name='".$this->Prefix."fmSKPDUrusan' value='$fmSKPDUrusan'>".
				"<input type='hidden' id='".$this->Prefix."fmSKPDBidang2' name='".$this->Prefix."fmSKPDBidang2' value='$fmSKPDSkpd'>".
				"<input type='hidden' id='".$this->Prefix."fmSKPDskpd2' name='".$this->Prefix."fmSKPDskpd2' value='$fmSKPDUnit'>".
				"<input type='hidden' id='".$this->Prefix."fmSKPDUnit2' name='".$this->Prefix."fmSKPDUnit2' value='$fmSKPDSubUnit'>".
				"<input type='hidden' id='".$this->Prefix."fmSKPDSubUnit2' name='".$this->Prefix."fmSKPDSubUnit2' value='$fmSKPDSeksi'>".
				"<input type='hidden' id='".$this->Prefix."tahun_anggaran' name='".$this->Prefix."tahun_anggaran' value='$tahun_anggaran'>".
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
				<script type='text/javascript' src='js/sotkbaru/".strtolower($this->Prefix).".js' language='JavaScript' ></script>
				".
						$scriptload;
	}
	
	function setKolomHeader($Mode=1, $Checkbox=''){
		$cetak = $Mode==2 || $Mode==3 ;
		
			
		$headerTable =
				"<tr>
				<th class='th02'colspan=4>Nomor</th>
				<th class='th02'colspan=3>Spesifikasi Barang</th>
				<th class='th01'rowspan=2>Bahan</th>
				<th class='th01'rowspan=2>Cara Perolehan/<br>Sumber Dana</th>
				<th class='th01'rowspan=2>Tahun <br> Perolehan</th>
				<th class='th02'colspan=3>Jumlah</th>
				<th class='th02' width='20' rowspan=2>Keterangan</th>
				<!--<th class='th02'colspan=2>Mutasi ke SOTK Baru</th>-->
				</tr>
				
				<tr>
				<th class='th01' width='20' rowspan=2>No.</th>
  	  			$Checkbox 		
				<th class='th01'>ID Barang/<br>Kode Barang Lama/<br>Kode Barang Baru</th>
				<th class='th01'>No Reg/<br>No Urut</th>
				<th class='th01'>Nama Barang Lama/<br>Nama Barang Baru</th>
				<th class='th01'>Merk/ Type/ Lokasi</th>
				<th class='th01'>No. Sertifikat/ <br>No. Pabrik</th>
				<th class='th01'>Barang</th>
				<th class='th01'>Harga</th>
				<th class='th01'>Akumulasi<br>Penyusutan</th>
				<!--<th class='th01'>Kode/Nama</th>
				<th class='th01'>BAST</th>-->
				</tr>
				
				";
				
		return $headerTable;
	}
	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Ref;
		$arrStatus = array ('','','', 'Batal','Dihapus');
		
		$kode_brg = $isi['f'].'.'.$isi['g'].'.'.$isi['h'].'.'.$isi['i'].'.'.$isi['j'];
		$kdBrgBaru = $isi['f1'].'.'.$isi['f2'].'.'.$isi['f12'].'.'.$isi['g2'].'.'.$isi['h2'].'.'.$isi['i2'].'.'.$isi['j2'];
		$kode_brg_baru = $isi['f1'] == '' ? '' : '/<br>'.$kdBrgBaru;
		$kode_sotk = $isi['c1']==''? '' : $isi['c1'].'.'.$isi['c2'].'.'.$isi['d2'].'.'.$isi['e2'].'.'.$isi['e12'];
		$brg = mysql_fetch_array(mysql_query("select * from ref_barang_baru where f1='{$isi['f1']}' and f2='{$isi['f2']}' and f='{$isi['f12']}' and g='{$isi['g2']}' and h='{$isi['h2']}' and i='{$isi['i2']}' and j='{$isi['j2']}'"));
		$nmbrgbaru = $isi['f1'] == ''?'':"/<br>".$brg['nm_barang'];
		
		$qry = "select nm_skpd from ref_skpd_baru where c1='".$isi['c1']."' and c2='00'";
		$get = mysql_fetch_array(mysql_query($qry));
		$urusan = $get['nm_skpd'];
		
		$qry = "select nm_skpd from ref_skpd_baru where c1='".$isi['c1']."' and c2='".$isi['c2']."' and d2='00'";
		$get = mysql_fetch_array(mysql_query($qry));
		$bidang2 = $get['nm_skpd'];
		
		$qry = "select nm_skpd from ref_skpd_baru where c1='".$isi['c1']."' and c2='".$isi['c2']."' and d2='".$isi['d2']."' and e2='00'";
		$get = mysql_fetch_array(mysql_query($qry));
		$skpd2 = $get['nm_skpd'];
		
		$qry = "select nm_skpd from ref_skpd_baru where c1='".$isi['c1']."' and c2='".$isi['c2']."' and d2='".$isi['d2']."' and e2='".$isi['e2']."' and e12='000'";
		$get = mysql_fetch_array(mysql_query($qry));
		$unit2 = $get['nm_skpd'];
		
		$qry = "select nm_skpd from ref_skpd_baru where c1='".$isi['c1']."' and c2='".$isi['c2']."' and d2='".$isi['d2']."' and e2='".$isi['e2']."' and e12='".$isi['e12']."'";
		$get = mysql_fetch_array(mysql_query($qry));
		$subunit2 = $get['nm_skpd'];
		
		$sotkbaru = $isi['c1']==''? '' : $kode_sotk.'/<br>'.$urusan.' - <br>'.$bidang2.' - <br>'.$skpd2.' - <br>'.$unit2.' - <br>'.$subunit2;
		$bastbaru = $isi['no_ba2']==''? '' : $isi['no_ba2'].'/<br>'.$isi['tgl_ba2'];
		
		//list StatusBarang
		$ArrStatusBarang = array(
								array("1","Inventaris"),
								array("2","Pemanfaatan"),
								array("3","Penghapusan"),
								array("4","Pemindahtanganan"),
								array("5","Tuntutan Ganti Rugi")
							);
							
		//list Asal Usul
		$ArrAsalUsul = array(
						array("1","Pembelian"),
						array("2","Hadiah/Hibah"),
						array("3","Lainnya"),
						array("4","Mutasi"),
						array("5","Reclass"),
						array("6","Kapitalisasi"),
						array("7","Koreksi"),
						array("8","Pinjam"),
						array("9","Sewa"),
						array("10","Hak Guna Usaha"),
						array("11","Ganti Rugi"),
						
						);
		
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
		$tampilHarga = !empty($cbxDlmRibu)? number_format($isi['nilai_buku']/1000, 2, ',', '.') : number_format($isi['nilai_buku'], 2, ',', '.');
		$tampilAkumSusut = !empty($cbxDlmRibu)? number_format($isi['nilai_susut']/1000, 2, ',', '.') : number_format($isi['nilai_susut'], 2, ',', '.');
		$jns_hibah = ($isi['jns_hibah'] == '0' || $isi['jns_hibah'] == '') ? '' : $isi['jns_hibah'];
		$Koloms = array();
		$Koloms[] = array('align=right', $no.'.' );
		if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
		$Koloms[] = array('', $isi['id'].'/<br>'.$kode_brg.$kode_brg_baru);		
		$Koloms[] = array('align=center', $isi['noreg']);		
		$Koloms[] = array('', $isi['nm_barang'].$nmbrgbaru);
		
		$Koloms[] = array('', $ISI5 );
		$Koloms[] = array('', $ISI6 );
		$Koloms[] = array('', $ISI7 );
		$Koloms[] = array('', $ArrAsalUsul[$isi['asal_usul']-1][1]."<br>/".$jns_hibah."<br>/".$ArrStatusBarang[$isi['status_barang']-1][1] );
		
		$Koloms[] = array('align=center', $isi['thn_perolehan'] );
		$Koloms[] = array('align=right', $isi['jml_barang']." ".$isi['satuan'] );
		$Koloms[] = array('align=right', $tampilHarga );
		$Koloms[] = array('align=right', $tampilAkumSusut );
		$Koloms[] = array('', $ISI15);
		//$Koloms[] = array('', $bastbaru );
		
		return $Koloms;
	}	
	
	function set_selector_other($tipe){
		global $Main;
		$cek = ''; $err=''; $content=''; $json=TRUE;
		switch($tipe){
			case 'UrusanAfter':{
				$fmSKPDBidang2 = $_COOKIE['cofmSKPD2'];
				$content= $this->cmbQueryBidang($this->Prefix.'fmSKPDBidang2',$fmSKPDBidang2,'','onchange=MappingBarang.refreshList(true)','--- Pilih BIDANG ---','00');
			break;
			}
			case 'BidangAfter2':{
				$content= $this->cmbQuerySKPD($this->Prefix.'fmSKPDskpd2',$fmSKPDskpd2,'','onchange=MappingBarang.BidangAfter2()','--- Pilih SKPD ---','00');
			break;
			}
				
			case 'SKPDAfter2':{
				$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQueryUnit($this->Prefix.'fmSKPDUnit2',$fmSKPDUnit2,'','onchange=MappingBarang.UnitAfter2() ','--- Pilih UNIT ---','00');
			break;
		    }
			
			case 'UnitAfter2':{
				$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQuerySubUnit($this->Prefix.'fmSKPDSubUnit2',$fmSKPDSubUnit2,'','onchange=MappingBarang.refreshList(true) ','--- Pilih SUB UNIT ---','000');
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
			case 'simpan2' : {
				$get = $this->simpan2();
				$cek = $get['cek']; $err = $get['err']; $content=$get['content']; 
				break;
			}
						
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
	
	function cmbQueryUrusan($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE) {
     global $Ref,$Main,$HTTP_COOKIE_VARS;
	 Global $fmSKPDUrusan;
	 $KondUrusan = $HTTP_COOKIE_VARS['coURUSAN'] == '0' ? "" : " and c1 = '{$HTTP_COOKIE_VARS['coURUSAN']}'";
		$fmSKPDUrusan = cekPOST('MappingBarangfmSKPDUrusan');
	 $aqry = "select * from ref_skpd_baru where c1 !='0' and  c2 ='00' and d2='00' and e2 ='00' and e12 ='000' $KondUrusan order by c1";
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
     global $Ref,$Main,$HTTP_COOKIE_VARS;
	 Global $fmSKPDUrusan,$fmSKPDBidang2;
	 $KondBidang = $HTTP_COOKIE_VARS['coSKPD2'] == '0' ? "" : " and c2 = '{$HTTP_COOKIE_VARS['coSKPD2']}'";
	 	$fmSKPDUrusan = $_REQUEST['MappingBarangfmSKPDUrusan'];
		$fmSKPDBidang2 = cekPOST('MappingBarangfmSKPDBidang2');
	 $aqry = "select * from ref_skpd_baru where 1=1 and c2!= '00' and d2='00' and c1='$fmSKPDUrusan' $KondBidang order by c2";
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
	 global $Ref,$Main,$HTTP_COOKIE_VARS;
	 Global $fmSKPDUrusan,$fmSKPDBidang2,$fmSKPDskpd2;
	 $KondSKPD = $HTTP_COOKIE_VARS['coUNIT2'] == '0' ? "" : " and d2 = '{$HTTP_COOKIE_VARS['coUNIT2']}'";
	 	$fmSKPDUrusan = $_REQUEST['MappingBarangfmSKPDUrusan'];
		$fmSKPDBidang2 = $_REQUEST['MappingBarangfmSKPDBidang2'];
		$fmSKPDskpd2 = cekPOST('MappingBarangfmSKPDskpd2');
		//setcookie('cofmSKPD',$fmSKPDBidang);
		//setcookie('cofmUNIT',$fmSKPDskpd);
	 $aqry="select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2 <> '00' and e2 = '00' and c1='$fmSKPDUrusan' $KondSKPD order by d2";
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
	 $KondUNIT = $HTTP_COOKIE_VARS['coSUBUNIT2'] == '0' ? "" : " and e2 = '{$HTTP_COOKIE_VARS['coSUBUNIT2']}'";
	 	$fmSKPDUrusan = $_REQUEST['MappingBarangfmSKPDUrusan'];
		$fmSKPDBidang2 = $_REQUEST['MappingBarangfmSKPDBidang2'];
		$fmSKPDskpd2 = $_REQUEST['MappingBarangfmSKPDskpd2'];
		$fmSKPDUnit2 = cekPOST('MappingBarangfmSKPDUnit2');
		
			
	 $aqry = "select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2 = '$fmSKPDskpd2' and e2 <> '00' and e12='000' and c1='$fmSKPDUrusan' $KondUNIT order by e2";
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
	 $KondSUBUNIT = $HTTP_COOKIE_VARS['coSEKSI2'] == '0' ? "" : " and e12 = '{$HTTP_COOKIE_VARS['coSEKSI2']}'";
	 	$fmSKPDUrusan = $_REQUEST['MappingBarangfmSKPDUrusan'];
		$fmSKPDBidang2 = $_REQUEST['MappingBarangfmSKPDBidang2'];
		$fmSKPDskpd2 = $_REQUEST['MappingBarangfmSKPDskpd2'];
		$fmSKPDUnit2 = $_REQUEST['MappingBarangfmSKPDUnit2'];
		$fmSKPDSubUnit2 = cekPOST('MappingBarangfmSKPDSubUnit2');
			
	 $aqry="select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2='$fmSKPDskpd2' and e2='$fmSKPDUnit2' and c1='$fmSKPDUrusan' and e12!='000' $KondSUBUNIT order by e12";
	 $Input = "<option value='$vAtas'>$Atas</option>";
	 $Query = mysql_query($aqry);
	 $nmSKPDSubUnit='';
    	while ($Hasil = mysql_fetch_array($Query)) {
        	$Sel = $Hasil['e12'] ==  $value ? "selected" : "";
				if ($nmSKPDSubUnit=='' ) $nmSKPDSubUnit =  $value == $Hasil['e12'] ? $Hasil['nm_skpd'] : '';
			$Input .= "<option $Sel value='{$Hasil[e12]}'>{$Hasil[e12]}. {$Hasil[nm_skpd]}";
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
				"f1 = '',".
				"f2 = '',".
				"f12 = '',".
				"g2 = '',".
				"h2 = '',".
				"i2 = '',".
				"j2 = '',".
				"uid = '$UID',".
				"tgl_update = now() ".
				"WHERE id='".$ids[$i]."'"; 
				$cek.="| ".$batal;		
				$qry = mysql_query($batal);
				
			}
		}
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
}
	
$MappingBarang = new MappingBarangObj();

?>