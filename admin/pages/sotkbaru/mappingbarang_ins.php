<?php

class MappingBarang_insObj extends DaftarObj2{
	var $Prefix = 'MappingBarang_ins';
	var $SHOW_CEK = TRUE;	
	var $TblName = 'view_buku_induk2';//view2_sensus';
	var $TblName_Hapus = 'buku_induk';
	var $TblName_Edit = 'buku_induk';
	var $KeyFields = array('id');
	var $FieldSum = array('nilai_buku','nilai_susut');
	var $SumValue = array('nilai_buku','nilai_susut');
	var $FieldSum_Cp1 = array( 9, 8, 8);
	var $FieldSum_Cp2 = array( 3, 3, 3);	
	var $FormName = 'MappingBarang_insForm';
	var $pagePerHal = 25;
	
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
		return "";
			/*"<td>".genPanelIcon("javascript:".$this->Prefix.".sotkbaru()","mutasi.png","Mutasi", 'Mutasi')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Batal", 'Batal')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Report()","edit_f2.png","Report", 'Report')."</td>";*/
	}
	
	function setMenuView(){		
		return 			"";
			/*"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakHal(\"$Op\")","print_f2.png",'Halaman',"Cetak Daftar per Halaman")."</td>".			
			//"<td>".genPanelIcon("javascript:".$this->Prefix.".cetakAll(\"$Op\")","print_f2.png",'Cetak',"Cetak Daftar")."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".exportXls(\"$Op\")","export_xls.png",'Excel',"Export Excel")."</td>";*/					

	}
	
	function SimpanBAST(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	 
	 $c = $_REQUEST['c'];
	 $d = $_REQUEST['d'];
	 $e = $_REQUEST['e'];
	 $e1 = $_REQUEST['e1'];
	 $no_ba= $_REQUEST['no_ba'];
	 $tgl_ba= $_REQUEST['tgl_ba'];
	 $yg_menyerahkan_nm= $_REQUEST['yg_menyerahkan_nm'];
	 $yg_menyerahkan_nip= $_REQUEST['yg_menyerahkan_nip'];
	 $yg_menyerahkan_jbt= $_REQUEST['yg_menyerahkan_jbt'];
	 $yg_mengetahui_nm= $_REQUEST['yg_mengetahui_nm'];
	 $yg_mengetahui_nip= $_REQUEST['yg_mengetahui_nip'];
	 $yg_mengetahui_jbt= $_REQUEST['yg_mengetahui_jbt'];
	 $yg_menerima_nm= $_REQUEST['yg_menerima_nm'];
	 $yg_menerima_nip= $_REQUEST['yg_menerima_nip'];
	 $yg_menerima_jbt= $_REQUEST['yg_menerima_jbt'];
	 $kota= $_REQUEST['kota'];
	 
	 	  
	 if( $err=='' && $no_ba =='' ) $err= 'Nomor BAST Belum Di Isi !!';
	 if( $err=='' && $tgl_ba =='' ) $err= 'Tanggal BAST Belum Di Isi !!';
	 
	 
	 if($fmST == 0){
		if($err==''){
			$aqry = "INSERT into ref_bast(no_ba,tgl_ba,c,d,e,e1,nm_yg_menyerahkan,nip_yg_menyerahkan,jbt_yg_menyerahkan,nm_yg_mengetahui,nip_yg_mengetahui,jbt_yg_mengetahui,nm_yg_menerima,nip_yg_menerima,jbt_yg_menerima,kota)
			values('$no_ba','$tgl_ba','$c','$d','$e','$e1','$yg_menyerahkan_nm', '$yg_menyerahkan_nip', '$yg_menyerahkan_jbt', '$yg_mengetahui_nm', '$yg_mengetahui_nip', '$yg_mengetahui_jbt','$yg_menerima_nm','$yg_menerima_nip','$yg_menerima_jbt','$kota')";	$cek .= $aqry;	
			$qry = mysql_query($aqry);
			
			$dtidBA = "SELECT no_ba,tgl_ba FROM ref_bast where no_ba='$id'";
			$qrdtidBA = mysql_query($dtidBA);
			$dtId = mysql_fetch_array($qrdtidBA);
			
			
		}
	 }elseif($fmST == 1){
	 	if($err==''){
			$aqry = "UPDATE ref_bast set ".
					"no_ba='$no_ba',".
					"tgl_ba='$tgl_ba',".
					"nm_yg_menyerahkan='$yg_menyerahkan_nm',".
					"nip_yg_menyerahkan='$yg_menyerahkan_nip',".
					"jbt_yg_menyerahkan='$yg_menyerahkan_jbt',".
					"nm_yg_mengetahui='$yg_mengetahui_nm',".
					"nip_yg_mengetahui='$yg_mengetahui_nip',".
					"jbt_yg_mengetahui='$yg_mengetahui_jbt',".
					"nm_yg_menerima='$yg_menerima_nm',".
					"nip_yg_menerima='$yg_menerima_nip',".
					"jbt_yg_menerima='$yg_menerima_jbt',".
					"kota='$kota' ".
					"where no_ba='$no_ba' and c='$c' and d='$d' and e='$e' and e1='$e1'";
			$cek .= $aqry;	
			$qry = mysql_query($aqry);
		}
	 } //end else
			 $qrypenyedia = "SELECT no_ba,no_ba FROM ref_bast where c='$c' and d='$d' and e='$e' and e1='$e1'";
			 $content['bast'] = cmbQuery('no_bast','',$qrypenyedia," style='width:303px;' ","--- NOMOR BAST ---","");
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }
	
	function Simpan(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	 
	 $fmSKPDUrusan = $_REQUEST['fmSKPDUrusan'];
	 $fmSKPDBidang2 = $_REQUEST['fmSKPDBidang2'];
	 $fmSKPDskpd2 = $_REQUEST['fmSKPDskpd2'];
	 $fmSKPDUnit2 = $_REQUEST['fmSKPDUnit2'];
	 $fmSKPDSubUnit2 = $_REQUEST['fmSKPDSubUnit2'];
	 $fmIDBARANG_lama = $_REQUEST['fmIDBARANG_lama'];
	 $kdlama = explode(".",$fmIDBARANG_lama);
	 $fmNMBARANG_lama = $_REQUEST['fmNMBARANG_lama'];
	 $kodebarangbaru= $_REQUEST['kodebarang'];
	 $namabarangbaru= $_REQUEST['namabarang'];
	 $cbxSemua= $_REQUEST['cbxSemua'];
	 $idubah= $_REQUEST['idubah'];
	 $kdBrgBaru = explode(".",$kodebarangbaru);
	 $f1 = $kdBrgBaru[0];
	 $f2 = $kdBrgBaru[1];
	 $f12 = $kdBrgBaru[2];
	 $g2 = $kdBrgBaru[3];
	 $h2 = $kdBrgBaru[4];
	 $i2 = $kdBrgBaru[5];
	 $j2 = $kdBrgBaru[6];

	 if( $err=='' && $kodebarangbaru =='' ) $err= 'Kode Barang Baru Belum Di Isi !!';
	 if( $err=='' && $namabarangbaru =='' ) $err= 'Nama Barang Baru Belum Di Isi !!';
	 
	 
		if($err==''){
			//for($i=0;$i<count($idplh);$i++){
			if($cbxSemua){
				if($fmSKPDUrusan=='' || $fmSKPDUrusan=='00'){
					$kondisi = "where f='".$kdlama[0]."' and g='".$kdlama[1]."' and h='".$kdlama[2]."' and i='".$kdlama[3]."' and j='".$kdlama[4]."' ";
				}else{
					$kondisi = "where f='".$kdlama[0]."' and g='".$kdlama[1]."' and h='".$kdlama[2]."' and i='".$kdlama[3]."' and j='".$kdlama[4]."' ".
								"and c1='$fmSKPDUrusan' and c2='$fmSKPDBidang2' and d2='$fmSKPDskpd2' and e2='$fmSKPDUnit2' and j='$fmSKPDSubUnit2' ";
				}
				$aqry = "UPDATE buku_induk set ".
						"f1 = '$f1',".
						"f2 = '$f2',".
						"f12 = '$f12',".
						"g2 = '$g2',".
						"h2 = '$h2',".
						"i2 = '$i2',".
						"j2 = '$j2', ".
						"uid = '$uid', ".
						"tgl_update = now() ".
						$kondisi;
			}else{
				$aqry = "UPDATE buku_induk set ".
						"f1 = '$f1',".
						"f2 = '$f2',".
						"f12 = '$f12',".
						"g2 = '$g2',".
						"h2 = '$h2',".
						"i2 = '$i2',".
						"j2 = '$j2', ".
						"uid = '$uid', ".
						"tgl_update = now() ".
						"where id='".$idubah."'";
			}
					$cek .= $aqry;	
				$qry = mysql_query($aqry);
			//}

		}
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }
	
	function genDaftarOpsi(){
		global $Main,$fmFiltThnBuku;
		Global $fmSKPDBidang,$fmSKPDskpd;
		
		if(isset($_REQUEST['databaru'])){
		if(addslashes($_REQUEST['databaru'] == '1')){
			$c1 = $_REQUEST['urusan_lama'];
			$c2 = $_REQUEST['skpd_lama'];
			$d2 = $_REQUEST['unit_lama'];
			$e2 = $_REQUEST['subunit_lama'];
			$e12 = $_REQUEST['seksi_lama'];
			
			$cekid = explode(" ",$_REQUEST['idubah']);
			$jmlcek = count($cekid);
			
			$uid = $HTTP_COOKIE_VARS['coID'];
			
			
		}else{
			
			$IDUBAH = $_REQUEST['idubah'];
			
		}
		
	}
	
	 $fmSKPDUrusan = cekPOST('fmSKPDUrusan')==''?$c1:cekPOST('fmSKPDUrusan');
	 $fmSKPDBidang2 = cekPOST('fmSKPDBidang2')==''?$c2:cekPOST('fmSKPDBidang2');
	 $fmSKPDskpd2 = cekPOST('fmSKPDskpd2')==''?$d2:cekPOST('fmSKPDskpd2');
	 $fmSKPDUnit2 = cekPOST('fmSKPDUnit2')==''?$e2:cekPOST('fmSKPDUnit2');
	 $fmSKPDSubUnit2 = cekPOST('fmSKPDSubUnit2')==''?$e12:cekPOST('fmSKPDSubUnit2');
	
	$qry_bast = "SELECT no_ba,no_ba FROM ref_bast where c='$c' and d='$d' and e='$e' and e1='$e1'";	
	
	$brgLama = mysql_fetch_array(mysql_query("select * from view_buku_induk2 where id='{$_REQUEST['idubah']}'"));
	$fmNMBARANG_lama = $brgLama['nm_barang'];
	$fmIDBARANG_lama = $brgLama['f'].'.'.$brgLama['g'].'.'.$brgLama['h'].'.'.$brgLama['i'].'.'.$brgLama['j'];
		
		$TampilOpt =
			$vOrder=
			
			genFilterBar(
				array(
					$this->isiform(
						array(
							array(
								'label'=>'URUSAN',
								'name'=>'fmSKPDUrusan',
								'label-width'=>'150px;',
								'value'=>$this->cmbQueryUrusan('fmSKPDUrusan',$fmSKPDUrusan,'','onchange=MappingBarang_ins.UrusanAfter() '.$disabled1,'--- Pilih URUSAN ---','00'),
								
							),
							array(
								'label'=>'BIDANG',
								'name'=>'fmSKPDBidang2',
								'label-width'=>'150px;',
								'value'=>$this->cmbQueryBidang('fmSKPDBidang2',$fmSKPDBidang2,'','onchange=MappingBarang_ins.BidangAfter2() '.$disabled1,'--- Pilih BIDANG ---','00'),
								
							),
							array(
								'label'=>'SKPD',
								'name'=>'fmSKPDskpd2',
								'label-width'=>'150px;',
								'value'=>$this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=MappingBarang_ins.SKPDAfter2() '.$disabled1,'--- Pilih SKPD ---','00'),
								
							),
							array(
								'label'=>'UNIT',
								'name'=>'fmSKPDUnit2',
								'label-width'=>'150px;',
								'value'=>$this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=MappingBarang_ins.UnitAfter2() '.$disabled1,'--- Pilih UNIT ---','00'),
								
							),
							array(
								'label'=>'SUB UNIT',
								'name'=>'fmSKPDSubUnit2',
								'label-width'=>'150px',
								'value'=>$this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'',''.$disabled1,'--- Pilih SUB UNIT ---','000'),
								
							),
						)
					)
				
				),'','','').
				genFilterBar(
				array(
					"<span id='inputpenerimaanbarang' style='color:black;font-size:14px;font-weight:bold;'/>KODE BARANG (LAMA)</span>",
					
				
				),'','','').
				genFilterBar(
				array(
					"<input type='text'  id='fmIDBARANG_lama' name='fmIDBARANG_lama' value='$fmIDBARANG_lama' style='width:150px;' placeholder='KODE' readonly>
					<input type='text'  id='fmNMBARANG_lama' name='fmNMBARANG_lama' value='$fmNMBARANG_lama' style='width:350px;' placeholder='NAMA BARANG' readonly>",
					
				
				),
				'','','').
				genFilterBar(
				array(
					"<span id='inputpenerimaanbarang' style='color:black;font-size:14px;font-weight:bold;'/>KODE BARANG (BARU)</span>",
					
				
				),'','','').
				genFilterBar(
				array(
					"<input type='text' name='kodebarang' onkeyup='cariBarang.pilBar2(this.value)' id='kodebarang' placeholder='KODE BARANG' style='width:150px;' value='".$dt['kodebarangnya']."' /> 
					<input type='text' name='namabarang' id='namabarang' placeholder='NAMA BARANG' style='width:350px;' readonly value='".$dt['nm_barang']."' />
					<input type='button' name='caribarang' id='caribarang' value='CARI' onclick='MappingBarang_ins.CariBrgBaru();'/><br><br>
					<input type='checkbox' name='cbxSemua' value='1' id='cbxSemua' $cbxSemua />SEMUA",
					
				
				),'','','').
				genFilterBar(
					array(
					"
					
					<table>
						<tr>
							<td>".$this->buttonnya('MappingBarang_ins.Simpan()','save_f2.png','SIMPAN','SIMPAN','SIMPAN')."</td>
							<td>".$this->buttonnya('javascript:window.close();window.opener.location.reload();','cancel_f2.png','BATAL','BATAL','BATAL')."</td>
						</tr>".
					"</table>"
					
					
					
				),'','','').
				"<div id='rincianbarangbaru'></div>"
			;
		
		return array('TampilOpt'=>$TampilOpt);
		
	
	}
	
	function isiform($value){
		$isinya = '';
		$tbl ='<table width="100%">';
		for($i=0;$i<count($value);$i++){
			if(!isset($value[$i]['align']))$value[$i]['align'] = "left";
			if(!isset($value[$i]['valign']))$value[$i]['valign'] = "top";
			
			if(isset($value[$i]['type'])){
				switch ($value[$i]['type']){
					case "text" :
						$isinya = "<input type='text' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					case "hidden" :
						$isinya = "<input type='hidden' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					case "password" :
						$isinya = "<input type='password' name='".$value[$i]['name']."' id='".$value[$i]['name']."' ".$value[$i]['parrams']." value='".$value[$i]['value']."' />";
					break;
					default:
						$isinya = $value[$i]['value'];
					break;					
				}
			}else{
				$isinya = $value[$i]['value'];
			}
			
			$tbl .= "
				<tr>
					<td width='".$value[$i]['label-width']."' valign='top'>".$value[$i]['label']."</td>
					<td width='10px' valign='top'>:<br></td>
					<td align='".$value[$i]['align']."' valign='".$value[$i]['valign']."'> $isinya</td>
				</tr>
			";		
		}
		$tbl .= '</table>';
		
		return $tbl;
	}
	
	function buttonnya($js,$img,$name,$alt,$judul){
		return "<table cellpadding='0' cellspacing='0' border='0' id='toolbar'>
					<tbody><tr valign='middle' align='center'> 
					<td class='border:none'> 
						<a class='toolbar' id='btsave' 
							href='javascript:$js'> 
						<img src='images/administrator/images/$img' alt='$alt' name='$name' width='32' height='32' border='0' align='middle' title='$judul'> $judul</a> 
					</td> 
					</tr> 
					</tbody></table> ";
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
		
		$fmCariComboIsi = cekPOST('fmCariComboIsi');
		$fmCariComboField = cekPOST('fmCariComboField');
		if (!empty($fmCariComboIsi) && !empty($fmCariComboField)) {
			//if ($fmCariComboField != 'ket' && $fmCariComboField != 'Cari Data') {
			if ($fmCariComboField != 'Cari Data') {
			//if(  $fmCariComboField == 'nm_barang'){
				
			//	$Kondisi .=  " and  concat(f,g,h,i,j) in (  select concat(f,g,h,i,j) from ref_barang where nm_barang like '%$fmCariComboIsi%' ) ";
			//}else{
				$arrKondisi[] = " $fmCariComboField like '%$fmCariComboIsi%' ";
			//}
				
			}
		}
		
		$arrKondisi[] = "status_barang <> '3' and status_barang <> '4' and status_barang <> '5'";
		
		$fmStMutasi=  cekPOST('stmutasi');
		$fmStAset=  cekPOST('staset');
		$fmThn2=  cekPOST('fmThn2');
		$fmSemester = cekPOST('fmSemester');
		
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
		
		$cbid = $_REQUEST['MappingBarang_cb'];
		$idplh = implode(" ",$cbid);
		
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
					"<input type='hidden' name='urusan_lama' id='urusan_lama' value='".$_REQUEST['MappingBarangfmSKPDUrusan']."' />".
					"<input type='hidden' name='skpd_lama' id='skpd_lama' value='".$_REQUEST['MappingBarangfmSKPDBidang2']."' />".
					"<input type='hidden' name='unit_lama' id='unit_lama' value='".$_REQUEST['MappingBarangfmSKPDskpd2']."' />".
					"<input type='hidden' name='subunit_lama' id='subunit_lama' value='".$_REQUEST['MappingBarangfmSKPDUnit2']."' />".
					"<input type='hidden' name='seksi_lama' id='seksi_lama' value='".$_REQUEST['MappingBarangfmSKPDSubUnit2']."' />".
					"<input type='hidden' name='databaru' id='databaru' value='".$_REQUEST['baru']."' />".
					"<input type='hidden' name='idubah' id='idubah' value='".$idplh."' />".
					
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
			"</table>".
			/*'<script src="assets2/js/bootstrap.min.js"></script>'.
			'<script src="assets2/jquery.min.js"></script>'.*/
			"</body>
		</html>"; 
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
				<script src='js/sotkbaru/cariBarangBaru.js' type='text/javascript'></script>
				<script type='text/javascript' src='js/sotkbaru/".strtolower($this->Prefix).".js' language='JavaScript' ></script>
				".
						$scriptload;
	}
	
	function setFormBaruBAST(){
		$dt=array();
		$cek = '';$err='';
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		$dt['tgl'] = date("Y-m-d"); //set waktu sekarang
		$fm = $this->setFormBAST($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormEditBAST(){
		$cek ='';
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;
		$no_ba = $_REQUEST['no_bast'];				
		//get data 
		$aqry = "SELECT * FROM  ref_bast WHERE no_ba='$no_ba' "; $cek.=$aqry;
		$dt = mysql_fetch_array(mysql_query($aqry));
		$fm = $this->setFormBAST($dt);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setFormBAST($dt){	
	 global $SensusTmp, $Ref, $Main, $HTTP_COOKIE_VARS;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 500;
	 $this->form_height = 330;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'NOMOR BAST BARU';
	  }else{
		$this->form_caption = 'NOMOR BAST EDIT';			
		//$Id = $dt['Id'];			
	  }
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
	 //items ----------------------
	  $this->form_fields = array(
			'no_ba' => array( 
						'label'=>'NOMOR BAST',
						'labelWidth'=>200, 
						'value'=>$dt['no_ba'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NOMOR BAST'"
						 ),
			'tgl_ba' => array('label'=>'TANGGAL',
							   'value'=> createEntryTgl3($dt['tgl_ba'], 'tgl_ba', false,''),  
							   'type'=>'' ,
							   'param'=> "",
							 ),
			'yg_menyerahkan_nm' => array( 
						'label'=>'PEJABAT YANG MENYERAHKAN',
						'labelWidth'=>150, 
						'value'=>$dt['nm_yg_menyerahkan'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NAMA LENGKAP'"
						 ),
			'yg_menyerahkan_nip' => array( 
						'label'=>'',
						'labelWidth'=>150, 
						'value'=>$dt['nip_yg_menyerahkan'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NIP'"
						 ),
			'yg_menyerahkan_jbt' => array( 
						'label'=>'',
						'labelWidth'=>150, 
						'value'=>$dt['jbt_yg_menyerahkan'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='JABATAN'"
						 ),
			
			'yg_menerima_nm' => array( 
						'label'=>'PEJABAT YANG MENERIMA',
						'labelWidth'=>150, 
						'value'=>$dt['nm_yg_menerima'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NAMA LENGKAP'"
						 ),
			'yg_menerima_nip' => array( 
						'label'=>'',
						'labelWidth'=>150, 
						'value'=>$dt['nip_yg_menerima'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NIP'"
						 ),
			'yg_menerima_jbt' => array( 
						'label'=>'',
						'labelWidth'=>150, 
						'value'=>$dt['jbt_yg_menerima'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='JABATAN'"
						 ),
			
			'yg_mengetahui_nm' => array( 
						'label'=>'PEJABAT YANG MENGETAHUI',
						'labelWidth'=>150, 
						'value'=>$dt['nm_yg_mengetahui'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NAMA LENGKAP'"
						 ),
			'yg_mengetahui_nip' => array( 
						'label'=>'',
						'labelWidth'=>150, 
						'value'=>$dt['nip_yg_mengetahui'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='NIP'"
						 ),
			'yg_mengetahui_jbt' => array( 
						'label'=>'',
						'labelWidth'=>150, 
						'value'=>$dt['jbt_yg_mengetahui'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='JABATAN'"
						 ),
			'kota' => array( 
						'label'=>'KOTA',
						'labelWidth'=>200, 
						'value'=>$dt['kota'], 
						'type'=>'text',
						'param'=>"style='width:270px;' placeholder='KOTA'"
						 ),
			);
		//tombol
		$this->form_menubawah =
			"<input type='hidden' name='c' id='c' value='".$_REQUEST['skpd_lama']."' />".
			"<input type='hidden' name='d' id='d' value='".$_REQUEST['unit_lama']."' />".
			"<input type='hidden' name='e' id='e' value='".$_REQUEST['subunit_lama']."' />".
			"<input type='hidden' name='e1' id='e1' value='".$_REQUEST['seksi_lama']."' />".
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanBAST()' title='Simpan' >".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
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
		$kdBrgBaru = $isi['f1'].'.'.$isi['f2'].'.'.$isi['f12'].'.'.$isi['g2'].'.'.$isi['h2'].'.'.$isi['i2'].'.'.$isi['j2'];
		$kode_brg_baru = $isi['f1'] == '' ? '' : '/<br>'.$kdBrgBaru;
		
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
		$Koloms[] = array('', $isi['id'].'/<br>'.$kode_brg.$kode_brg_baru);		
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
		$Koloms[] = array('', );
		$Koloms[] = array('',  );
		
		return $Koloms;
	}	
	
	function set_selector_other($tipe){
		global $Main;
		$cek = ''; $err=''; $content=''; $json=TRUE;
		switch($tipe){
			case 'UrusanAfter':{
				$content['c2']= $this->cmbQueryBidang('fmSKPDBidang2','05','','onchange=MappingBarang_ins.refreshList(true)','--- Pilih BIDANG ---','00');
				//$content['d2']= $this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=MappingBarang_ins.BidangAfter2()','--- Pilih SKPD ---','00');
				//$content['e2']= $this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=MappingBarang_ins.UnitAfter2() ','--- Pilih UNIT ---','00');
				//$content['e12']= $this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'','onchange=MappingBarang_ins.refreshList(true)','--- Pilih SUB UNIT ---','000');
			break;
			}
			case 'BidangAfter2':{
				$content= $this->cmbQuerySKPD('fmSKPDskpd2',$fmSKPDskpd2,'','onchange=MappingBarang_ins.BidangAfter2()','--- Pilih SKPD ---','00');
			break;
			}
				
			case 'SKPDAfter2':{
				//$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				//$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQueryUnit('fmSKPDUnit2',$fmSKPDUnit2,'','onchange=MappingBarang_ins.UnitAfter2() ','--- Pilih UNIT ---','00');
			break;
		    }
			
			case 'UnitAfter2':{
				//$fmSKPDBidang2 = cekPOST('fmSKPDBidang2');
				//$fmSKPDskpd2 = cekPOST('fmSKPDskpd2');
				//$fmSKPDUnit2 = cekPOST('fmSKPDUnit2');
				//setcookie('cofmSKPD2',$fmSKPDBidang2);
				//setcookie('cofmUNIT2',$fmSKPDskpd2);
				$content=$this->cmbQuerySubUnit('fmSKPDSubUnit2',$fmSKPDSubUnit2,'','','--- Pilih SUB UNIT ---','000');
			break;
		    }
			case 'formBaruBAST':{				
				$fm = $this->setformBaruBAST();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
				break;
			}
			
			case 'formEditBAST':{				
				$fm = $this->setformEditBAST();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
				break;
			}
			case 'simpanBAST':{
				$get= $this->SimpanBAST();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
		    }
			case 'simpan':{
				$get= $this->Simpan();
				$cek = $get['cek'];
				$err = $get['err'];
				$content = $get['content'];
			break;
		    }
						
			case 'hapus':{
				$cbid= $_POST[$this->Prefix.'_cb'];				
				$get= $this->Hapus($cbid);
				$err= $get['err']; 
				$cek = $get['cek'];
				$json=TRUE;	
				break;
			}
			
			case 'ambilTglBA':{				
				global $Main;
				$cek = ''; $err=''; $content=''; $json=TRUE;
				
				$noba = $_REQUEST['noba'];
				
				$query = "select * FROM ref_bast WHERE no_ba='$noba'" ;
				$get=mysql_fetch_array(mysql_query($query));$cek.=$query;
				$content=$get['tgl_ba'];											
				break;
			}			
		}
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function cmbQueryUrusan($name='txtField', $value='', $query='', $param='', $Atas='Pilih', $vAtas='',$readonly=FALSE) {
     global $Ref,$Main;
	 Global $fmSKPDUrusan;
		$fmSKPDUrusan = cekPOST('fmSKPDUrusan')==''?$_REQUEST['urusan_lama']:cekPOST('fmSKPDUrusan');
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
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan')==''?$_REQUEST['urusan_lama']:cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2')==''?$_REQUEST['skpd_lama']:cekPOST('fmSKPDBidang2');
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
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan')==''?$_REQUEST['urusan_lama']:cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2')==''?$_REQUEST['skpd_lama']:cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2')==''?$_REQUEST['unit_lama']:cekPOST('fmSKPDskpd2');
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
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan')==''?$_REQUEST['urusan_lama']:cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2')==''?$_REQUEST['skpd_lama']:cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2')==''?$_REQUEST['unit_lama']:cekPOST('fmSKPDskpd2');
		$fmSKPDUnit2 = cekPOST('fmSKPDUnit2')==''?$_REQUEST['subunit_lama']:cekPOST('fmSKPDUnit2');
		
			
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
	 	$fmSKPDUrusan = cekPOST('fmSKPDUrusan')==''?$_REQUEST['urusan_lama']:cekPOST('fmSKPDUrusan');
		$fmSKPDBidang2 = cekPOST('fmSKPDBidang2')==''?$_REQUEST['skpd_lama']:cekPOST('fmSKPDBidang2');
		$fmSKPDskpd2 = cekPOST('fmSKPDskpd2')==''?$_REQUEST['unit_lama']:cekPOST('fmSKPDskpd2');
		$fmSKPDUnit2 = cekPOST('fmSKPDUnit2')==''?$_REQUEST['subunit_lama']:cekPOST('fmSKPDUnit2');
		$fmSKPDSubUnit2 = cekPOST('fmSKPDSubUnit2')==''?$_REQUEST['seksi_lama']:cekPOST('fmSKPDSubUnit2');
			
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
	
}
$MappingBarang_ins = new MappingBarang_insObj();

?>