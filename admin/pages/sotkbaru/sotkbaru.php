<?php

class SOTKBaruObj extends DaftarObj2{
	var $Prefix = 'SOTKBaru';
	var $SHOW_CEK = TRUE;	
	var $TblName = 'view_buku_induk2';//view2_sensus';
	var $TblName_Hapus = 'buku_induk';
	var $TblName_Edit = 'buku_induk';
	var $KeyFields = array('id');
	var $FieldSum = array('nilai_buku','nilai_susut');
	var $SumValue = array('nilai_buku','nilai_susut');
	var $FieldSum_Cp1 = array( 9, 8, 8);
	var $FieldSum_Cp2 = array( 3, 3, 3);	
	var $FormName = 'SOTKBaruForm';
	var $pagePerHal = '';
	//var $withSumAll = FALSE;
	//var $withSumHal = FALSE;
	//var $WITH_HAL = FALSE;
	
	var $PageTitle = 'SOTK Baru';
	var $PageIcon = 'images/penatausahaan_ico.gif';
	var $ico_width = '20';
	var $ico_height = '30';
	
	var $fileNameExcel='Daftar SOTK Baru.xls';
	var $Cetak_Judul = 'MUTASI BARANG KE SOTK BARU';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $fmST = 0;
	var $idpilih = '';
	//var $row_params= " valign='top'";
	
	
	function setTitle(){
		global $Main;
		return 'MUTASI BARANG KE SOTK BARU';	

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
			"<td>".genPanelIcon("javascript:".$this->Prefix.".sotkbaru()","mutasi.png","Mutasi", 'Mutasi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Batal()","delete_f2.png","Batal", 'Batal')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Report(\"$uid\")","edit_f2.png","Report", 'Report')."</td>";
	}
	
	function setMenuView(){		
		return 			
			"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakHal(\"$Op\")","print_f2.png",'Halaman',"Cetak Daftar per Halaman")."</td>".			
			//"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakAll(\"$Op\")","print_f2.png",'Cetak',"Cetak Daftar")."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".exportXls(\"$Op\")","export_xls.png",'Excel',"Export Excel")."</td>";					

	}
	
	function genDaftarOpsi(){
		global $Main,$fmFiltThnBuku;
		Global $fmSKPDBidang,$fmSKPDskpd;
		 $fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		 $fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
		 $fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
		 $fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
		 $fmSKPDSubUnit2 = cekPOST('fmSKPDSubUnit2');
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
			array('1','Tahun Perolehan'),
			array('2','Keadaan Barang'),	
			array('3','Tahun Buku'),		
		);
		
		$OptCari =  //$Main->ListData->OptCari =
			"<table width=\"100%\" height=\"100%\" class=\"adminform\" style='margin: 4 0 0 0;'>
			<tr > 
			<td align='Left'> &nbsp;&nbsp;".
			"<div style='float:left'>".
				CariCombo4($ArFieldCari, $fmCariComboField, $fmCariComboIsi,"SOTKBaru.refreshList(true)" ).
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
			<td width=\"50%\" valign=\"top\"><h2>SOTK LAMA</h2>		
				" . WilSKPD_ajx3($this->Prefix.'Skpd') . 
			"</td>
			<td width=\"50%\" valign=\"top\"><h2>SOTK BARU</h2>			
				<table>
					<tr><td width='100'>URUSAN</td><td width='10'>:</td><td>".
						$this->cmbQueryUrusan('fmSKPDUrusan',$fmSKPDUrusan,'','onchange=SOTKBaru.UrusanAfter() '.$disabled1,'--- Pilih URUSAN ---','00')."</td></tr>
					<tr><td width='100'>BIDANG</td><td width='10'>:</td><td>".
						$this->cmbQueryBidang('fmSKPDBidang2',$fmSKPDBidang2,'','onchange=SOTKBaru.BidangAfter2() '.$disabled1,'--- Pilih BIDANG ---','00')."</td></tr>".
					"<tr><td width='100'>SKPD</td><td width='10'>:</td><td>".
						$this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=SOTKBaru.SKPDAfter2() '.$disabled1,'--- Pilih SKPD ---','00').
					"</td></tr>".
					"<tr><td width='100'>UNIT</td><td width='10'>:</td><td>".
						$this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=SOTKBaru.UnitAfter2() '.$disabled1,'--- Pilih UNIT ---','00').
					"</td></tr>".
					"<tr><td width='100'>SUB UNIT</td><td width='10'>:</td><td>".
						$this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'',''.$disabled1,'--- Pilih SUB UNIT ---','000').
					"</td></tr>".
				"</table>".
			"</td>
			</tr></table>".
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
		global $fmPILCARI;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
				
		$arrKondisi = array();
		$fmSKPD = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST($this->Prefix.'SkpdfmSKPD');
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
		);
		
		$fmSKPDUrusan = cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
		$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
		$fmSKPDSubUnit2 = cekPOST('fmSKPDSubUnit2');
		
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
			if(!empty($fmStMutasi)) $arrKondisi[] = " c1 = '' ";
		}else{
			if(!empty($fmStMutasi)) $arrKondisi[] = " c1 <> '' ";	
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
				<!--<th class='th01'rowspan=2>Bahan</th>
				<th class='th01'rowspan=2>Cara Perolehan/<br>Sumber Dana</th>-->
				<th class='th01'rowspan=2>Tahun <br> Perolehan</th>
				<th class='th02'colspan=3>Jumlah</th>
				<th class='th02'colspan=2>Mutasi ke SOTK Baru</th>
				</tr>
				
				<tr>
				<th class='th01' width='20' rowspan=2>No.</th>
  	  			$Checkbox 		
				<th class='th01'>Kode Barang/ <br> ID Barang</th>
				<th class='th01'>Reg</th>
				<th class='th01'>Nama/ Jenis Barang</th>
				<th class='th01'>Merk/ Type/ Lokasi</th>
				<th class='th01'>No. Sertifikat/ <br>No. Pabrik</th>
				<th class='th01'>Barang</th>
				<th class='th01'>Harga</th>
				<th class='th01'>Akumulasi<br>Penyusutan</th>
				<th class='th01'>Kode/Nama</th>
				<th class='th01'>BAST</th>
				</tr>
				
				";
				
		return $headerTable;
	}
	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
		global $Ref;
		$arrStatus = array ('','','', 'Batal','Dihapus');
		
		$kode_brg = $isi['f'].'.'.$isi['g'].'.'.$isi['h'].'.'.$isi['i'].'.'.$isi['j'];
		$kode_sotk = $isi['c1']==''? '' : $isi['c1'].'.'.$isi['c2'].'.'.$isi['d2'].'.'.$isi['e2'].'.'.$isi['e12'];
		
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
		$jns_hibah = $isi['jns_hibah'] == 0?'':$isi['jns_hibah'];
		$Koloms = array();
		$Koloms[] = array('align=right', $no.'.' );
		if ($Mode == 1) $Koloms[] = array(" align='center'  ", $TampilCheckBox);
		$Koloms[] = array('', $kode_brg.'/<br>'.$isi['id']);		
		$Koloms[] = array('', $isi['noreg']);		
		$Koloms[] = array('', $isi['nm_barang']);
		
		$Koloms[] = array('', $ISI5 );
		$Koloms[] = array('', $ISI6 );
		//$Koloms[] = array('', $ISI7 );
		//$Koloms[] = array('', $Main->AsalUsul[$isi['asal_usul']-1][1]."<br>/".$jns_hibah."<br>/".$Main->StatusBarang[$isi['status_barang']-1][1] );
		
		$Koloms[] = array('', $isi['thn_perolehan'] );
		$Koloms[] = array('', $isi['jml_barang']." ".$isi['satuan'] );
		$Koloms[] = array('align=right', $tampilHarga );
		$Koloms[] = array('align=right', $tampilAkumSusut );
		$Koloms[] = array('', $sotkbaru);
		$Koloms[] = array('', $bastbaru );
		
		return $Koloms;
	}	
	
	function set_selector_other($tipe){
		global $Main;
		$cek = ''; $err=''; $content=''; $json=TRUE;
		switch($tipe){
			case 'UrusanAfter':{
				$content= $this->cmbQueryBidang('fmSKPDBidang2',$fmSKPDBidang2,'','onchange=SOTKBaru.refreshList(true)','--- Pilih BIDANG ---','00');
			break;
			}
			case 'BidangAfter2':{
				$content= $this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=SOTKBaru.BidangAfter2()','--- Pilih SKPD ---','00');
			break;
			}
				
			case 'SKPDAfter2':{
				$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=SOTKBaru.UnitAfter2() ','--- Pilih UNIT ---','00');
			break;
		    }
			
			case 'UnitAfter2':{
				$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'','onchange=SOTKBaru.refreshList(true) ','--- Pilih SUB UNIT ---','000');
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
			
	 $aqry="select * from ref_skpd_baru where c2='$fmSKPDBidang2' and d2='$fmSKPDskpd2' and e2='$fmSKPDUnit2' and e12!='000' and c1='$fmSKPDUrusan' order by e12";
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
			$daftarSOTKBaru .= "<tr>
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
				$daftarSOTKBaru .= "<tr>
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
			$daftarSOTKBaru .= "<tr>
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
				<!--<style type=\"text/css\" media=\"print\">
					
					.footer { position: fixed; bottom: 0px;}
					.pagenum {
						counter-increment:page;
						counter-reset:page;
					}
      				.pagenum:after { 
					
						content: counter(page);
						
					}
				</style>-->
				<style>
					body {
					  counter-reset: section;
					  text-align: justify;
					}
					
					@page {
					  size: Folio;
					  margin: 5%;
					  padding: 0 0 10%;
					}
					
					@media print {
					  h3 {
					    position: absolute;
					    page-break-before: always;
					    page-break-after: always;
					    bottom: 0;
					    right: 0;
					  }
					  h3::before {
					    position: relative;
					    bottom: -20px;
					    counter-increment: section;
					    content: counter(section);
					  }
					  .print {
					    display: none;
					  }
					}

				</style>";
			echo"
			<html>".
				"<head>
					<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
					
					<script src='js/sotkbaru/pagenumber.js' type='text/javascript'></script>
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
				<div id=\"content\" style='width:$width;height:$height;font-family:Arial;page-break-after:always;'>
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
					$daftarSOTKBaru
				</table>
				<table border=1 style='width:100%;border-collapse: collapse;' cellpadding='3'>
					
				</table>
				
				</div>
				 <button class=\"print\">Print</button>
				<h3 class=\"first\"></h3>
  				<div class=\"insert\"></div>
				</body>
				</html>
				";
				
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
					<!--<style type=\"text/css\" media=\"print\">
						body {font-size: 12pt; line-height: 125%; } 
						@page { size: 21cm 33cm }
					</style>-->
					<style>
						@media print {
						  html, body {
						    width: 21cm;
						    height: 33cm;
						  }
					</style>					
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
						<td colspan=3  style='font-size:$f_size2;text-align:justify;'><br>
							PIHAK PERTAMA menyerahkan barang kepada PIHAK KEDUA, dan PIHAK KEDUA 
							menyatakan telah menerima barang dari PIHAK PERTAMA berupa daftar terlampir :<br><br>
						</td>
					</tr>
					<tr>
						<td colspan=3  style='font-size:12pt;'>
							<table border=1 style='width:90%;border-collapse: collapse;font-size:12pt;' cellpadding='5' align='center'>
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
						<td colspan=3  style='font-size:$f_size2;text-align:justify;'><br>
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
				$fmSKPD = $_REQUEST['SOTKBaruSkpdfmSKPD'];
				if($fmSKPD==''||$fmSKPD=='00'){
					$get = mysql_fetch_array(mysql_query(
						"select * from v_bidang where c='".$isi['c']."' "
					));		
					if($get['nmbidang']<>'') $nmopdarr[] = $get['c'].'. '. $get['nmbidang'];
				}
				$fmUNIT = $_REQUEST['SOTKBaruSkpdfmUNIT'];
				if($fmUNIT==''||$fmUNIT=='00'){
					$get = mysql_fetch_array(mysql_query(
						"select * from v_opd where c='".$isi['c']."' and d='".$isi['d']."' "
					));		
					if($get['nmopd']<>'') $nmopdarr[] =  $get['d'].'. '. $get['nmopd'];
				}	
				$fmSUBUNIT = $_REQUEST['SOTKBaruSkpdfmSUBUNIT'];
				if($fmSUBUNIT==''||$fmSUBUNIT=='00'){			
					$get = mysql_fetch_array(mysql_query(
						"select * from v_unit where c='".$isi['c']."' and d='".$isi['d']."' and e='".$isi['e']."'"
					));		
					if($get['nmunit']<>'') $nmopdarr[] =  $get['e'].'. '. $get['nmunit'];
				}
				
				$fmSEKSI = $_REQUEST['SOTKBaruSkpdfmSEKSI'];
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
	
$SOTKBaru = new SOTKBaruObj();

?>