<?php

class rincianCekObj  extends DaftarObj2{	
	var $Prefix = 'rincianCek';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'ref_cek'; //bonus
	var $TblName_Hapus = 'ref_rincian_template';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = 'RINCIAN TEMPLATE';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='rincianCek.xls';
	var $namaModulCetak='RINCIAN TEMPLATE';
	var $Cetak_Judul = 'RINCIAN TEMPLATE';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'rincianCekForm';
	var $noModul=14; 
	var $TampilFilterColapse = 0; //0

	var $username = "";
	
	function set_selector_other2($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;
		
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	
	function set_selector_other($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	  
	  switch($tipe){	
			
		
		case 'windowshow':{
				$fm = $this->windowShow();
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];	
		break;
		}
		case 'saveEdit':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}	
					
			   if(empty($itemCheck)){
			   		$err = "Isi Item";
			   }elseif(empty($hasil)){
			   		$err = "Isi hasil";
			   }elseif(empty($tanggal)){
			   		$err = "Isi tanggal";
			   }elseif(empty($status)){
			   		$err = "Pilih Stus";
			   }else{
			   		$tanggal_check = explode('-',$tanggal);
					$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
					$data = array(
									'item' => $itemCheck,
									'tanggal_check' =>$tanggal_check,
									'hasil' => $hasil,
									'status' => $status,
								
								);
				  $query = VulnWalkerUpdate('ref_cek',$data,"id = '$id'");
				  mysql_query($query);
			   }	
		break;
		}
		
		case 'delete':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}	
				mysql_query("delete from $this->TblName where id='$id'");
		break;
		}
		
		case 'Laporan':{	
			$grabAll = mysql_query("select * from cek_aplikasi");
		while($rows = mysql_fetch_array($grabAll)){
			foreach ($rows as $key => $value) { 
			  $$key = $value; 
			}
			if(mysql_num_rows(mysql_query("select * from ref_cek where id_parent = '$id' and status !='OK'")) == 0){
				$data = array('status' => "OK");
				mysql_query(VulnWalkerUpdate('cek_aplikasi',$data, "id ='$id'"));
			}else{
				$data = array('status' => "TIDAK");
				mysql_query(VulnWalkerUpdate('cek_aplikasi',$data, "id ='$id'"));
			}
		}
			$json = FALSE;
			$this->Laporan();										
		break;
		}
		
		case 'updateTempDetail':{
			foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}	
			$data = array('jumlah' => $VALUE);
			mysql_query(VulnWalkerUpdate("ref_cek",$data,"id = '$ID'"));
			
			$grabTotalJumlah = mysql_fetch_array(mysql_query("select sum(jumlah) from  ref_cek where username = '$this->username'"));
			$content = array('total' => $grabTotalJumlah['sum(jumlah)']);
			
			break;
		}
		
		case 'setTempTemplate': {
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
			}
			$username = $_COOKIE['coID'];
			$status = "";
			
			$get = mysql_fetch_array(mysql_query("select * from temp_template where username = '$username'"));
			
			if($get['username'] == $username){
				$status = "644"; 
			}else{
				$status = "777";
			}
			
			if ($status == "644" ){
			
			}else{
				$aqry = "insert into temp_template (username,nama_template,tanggal,nomor_distribusi,c1,c,d)  values('$username','$nama_template','$tanggal','$nomor_distribusi','$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm')";	$cek .= $aqry;	
				$execute = mysql_query($aqry);	
				if($execute){
					$status = "ADDED";
				}else{
					$status = "FAILURE";
				}
				
				
				$maxID = "";
		
				$get = mysql_fetch_array(mysql_query("select max(id) as aaa from temp_template where username = '$username' "));
				$maxID = $get['aaa'];
				
				
				$query = mysql_query("select * from ref_skpd where c1='$cmbUrusanForm' and c='$cmbBidangForm' and d='$cmbSKPDForm' and e !='00' and e1 !='000'");
				while($row = mysql_fetch_array($query)){
					$e = $row['e'];
					$e1= $row['e1'];
					$nama_sub_unit = $row['nm_skpd'];	
		
					$aqry = "INSERT into ref_cek (c1,c,d,e,e1,nama_sub_unit,ref_id_template,username) values ('$cmbUrusanForm','$cmbBidangForm','$cmbSKPDForm','$e','$e1','$nama_sub_unit','$maxID','$username')";
					mysql_query($aqry);	
					
							
				}
				
				
				
			
			
			}
			
			


			
			$content = array('c1' => $cmbUrusanForm, 'c' =>$cmbBidangForm, 'd' => $cmbSKPDForm, 'e' => $cmbUnitForm, 'nama_template' => $nama_template , 'nomor_distribusi' => $nomor_distribusi, 'tanggal' => $tanggal, 'username' => $username, 'status' => $status );
			break;
		}
		
		
		case 'setCookiesUnit': {
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
			}
			setcookie('TemplateUrusan',$cmbUrusanForm);
			setcookie('TemplateBidang',$cmbBidangForm);
			setcookie('TemplateSkpd',$cmbSKPDForm);	
			setcookie('TemplateUnit',$cmbUnitForm);
			break;
		}
		
		 case 'setValueTemplate':{
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
			} 
			
		$username = $_COOKIE['coID'];
		$arrayID = array();
		$query = "select id from ref_cek where c1='$c1' and c='$c' and d='$d' and e='$e' and username = '$username' ";
		$execute = mysql_query($query);
		while($row = mysql_fetch_array($execute)){
				array_push($arrayID,array('id' => $row['id']));
		}
			$content = json_encode($arrayID) ;		
			$cek = sizeof($arrayID) - 1;

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
			<script type='text/javascript' src='js/cekAplikasi/rincianCek.js' language='JavaScript' ></script>
			 <script type='text/javascript' src='js/cekAplikasi/cekAplikasi.js' language='JavaScript' ></script>
			
			".
			
			$scriptload;
	}
	
	function setTopBar(){
	   	return '';
	}
	
	//form ==================================
	
	
	function setPage_HeaderOther(){

	}
		
function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5'>No.</th>
  	   <th class='th01' width='400'>ITEM CHECK</th>	
	    <th class='th01' width='600'>HASIL</th>
	   <th class='th01' width='100'>TANGGAL CHECK</th>		
	  		
	   <th class='th01' width='50'>STATUS</th>	
	   <th class='th01' width='50'>AKSI</th>	
	   	
	   </tr>
	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 $idnya = $isi['id'];
	 foreach ($isi as $key => $value) { 
				  $$key = $value; 
			}
	 $Koloms = array();
	 
	 $Koloms[] = array('align="center"', $no.'.' );
	 $Koloms[] = array('align="left"',"<span id='spanItem$id'>".$item."</span>"); 
	 $tanggal_check = explode('-',$tanggal_check);
	 $tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
	 $Koloms[] = array('align="left"',"<span id='spanHasil$id'>".$hasil."</span>"); 
	 $Koloms[] = array('align="center"',"<span id='spanTanggal$id'>".$tanggal_check."</span>"); 
	 $Koloms[] = array('align="center"',"<span id='spanStatus$id'>".$status."</span>"); 
	 $aksi  = "<img src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=cekAplikasi.edit('$id');></img> &nbsp  &nbsp  <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapus('$id');></img> ";
	 $Koloms[] = array('align="center"',"<span id='spanAction$id'>".$aksi."</span>"); 

	 return $Koloms;
	}
	


	function genDaftarOpsi(){

	global $Ref, $Main;
	 Global $fmSKPDBidang,$fmSKPDskpd;
	 $fmSKPDBidang = isset($HTTP_COOKIE_VARS['cofmSKPD'])? $HTTP_COOKIE_VARS['cofmSKPD']: cekPOST('fmSKPDBidang');
	 $fmSKPDskpd = isset($HTTP_COOKIE_VARS['cofmUNIT'])? $HTTP_COOKIE_VARS['cofmUNIT']: cekPOST('fmSKPDskpd');
	$fmTahun=  cekPOST('fmTahun')==''?$_COOKIE['coThnAnggaran']:cekPOST('fmTahun');
	$fmBIDANG = cekPOST('fmBIDANG');


		
$baris = $_REQUEST['baris'];
	if ($baris == ''){
		$baris = "25";		
	}
	$fmPILCARI = $_REQUEST['fmPILCARI'];	
	$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];		
	//tgl bulan dan tahun
	$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];
	$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
	$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];
	$fmORDER1 = cekPOST('fmORDER1');
	$fmDESC1 = cekPOST('fmDESC1');
	$baris = $_REQUEST['baris'];
	
	$getTotalInput = mysql_fetch_array(mysql_query("select sum(jumlah) from $this->TblName where username = '$this->username'"));
	$totalInput = $getTotalInput['sum(jumlah)'];
	
	$TampilOpt =
			
			"<table cellpadding='0' cellspacing='0' border='0' id='toolbar' > 
			<tr valign='middle' align='center'> 
			<td class='border:none' > 
				<a class='toolbar' id='$id' href='javascript:cekAplikasi.addNew()'  title='Baru Item' $aparams> 					
					<img src='".$PATH_IMG."images/administrator/images/sections.png'  alt='button' name='save' 
					width='32' height='32' border='0' align='middle'  /> 
					<br>Baru Item
				</a> 
				
			</td> 
			<td class='border:none'>&nbsp
			</td>
			<td class='border:none'>
				<a class='toolbar' id='$id' href='javascript:rincianCek.Laporan()'  title='laporan' $aparams> 					
					<img src='".$PATH_IMG."images/administrator/images/print_f2.png'  alt='button' name='laporan' 
					width='32' height='32' border='0' align='middle'  /> 
					<br>Laporan
				</a> 
			</td>
			</tr> 
			</table>"
			
			;
	
	
			
		/*$TampilOpt ="<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td align='right'> </td>
			<td align='right'> <input type='hidden' name ='idParent' id = 'idParent' value='' >".genPanelIcon("javascript:cekAplikasi.addNew()","sections.png","Baru Item", 'Baru Item')."</td>
			 </tr>
			</table>".
			"</div>";
	*/

		return array('TampilOpt'=>$TampilOpt);
	}			
	
	function Laporan($xls =FALSE){
		global $Main;
		
	
		
		if($xls){
			header("Content-type: application/msexcel");
			header("Content-Disposition: attachment; filename=$this->fileNameExcel");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		
		
		
		
		

		
		

		$qry ="select * from ref_cek where id_parent = '".$_COOKIE['coParentCek']."'";
		$aqry = mysql_query($qry);
	
		
		$grabCekAplikasi = mysql_fetch_array(mysql_query("select * from cek_aplikasi where id = '".$_COOKIE['coParentCek']."'"));
		$namaAplikasi =mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi='".$grabCekAplikasi['id_aplikasi']."' and kode_modul = '0'"));		
		$namaAplikasi = $namaAplikasi['nama_aplikasi'];
		$namaModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi='".$grabCekAplikasi['id_aplikasi']."' and kode_modul =  '".$grabCekAplikasi['id_modul']."' and kode_sub_modul = '0'"));
		$namaModul = $namaModul['nama_aplikasi'];	
		$namaPegawai = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id ='".$grabCekAplikasi['dari']."'"));
		$namaPegawai = $namaPegawai['nama'];
		$status = $grabCekAplikasi['status'];
		
		//MULAI Halaman Laporan ------------------------------------------------------------------------------------------ 
		$css = $xls	? "<style>.nfmt5 {mso-number-format:'\@';}</style>":"<link rel=\"stylesheet\" href=\"css/template_css.css\" type=\"text/css\" />";
		echo 
			"<html>".
				"<head>
					<title>$Main->Judul</title>
					$css					
					$this->Cetak_OtherHTMLHead
					<style>
						.ukurantulisan{
							font-size:17px;
						}
						.ukurantulisan1{
							font-size:20px;
						}
						.ukurantulisanIdPenerimaan{
							font-size:16px;
						}
					</style>
				</head>".
			"<body >
				<div style='width:$this->Cetak_WIDTH_Landscape;'>
					<table class=\"rangkacetak\" style='width:33cm;font-family:Times New Roman;margin-left:2cm;margin-top:2cm;'>
						<tr>
							<td valign=\"top\"> <div style='text-align:center;'>
				<span style='font-size:18px;font-weight:bold;text-decoration: '>
					RINCIAN CEK APLIKASI
				</span><br>
				<table width=\"100%\" border=\"0\" class='subjudulcetak'>
					<tr>
						<td width='15%' valign='top'>NAMA APLIKASI</td>
						<td width='1%' valign='top'> : </td>
						<td valign='top'>$namaAplikasi</td>
					</tr>
					<tr>
						<td width='10%' valign='top'>MODUL</td>
						<td width='1%' valign='top'> : </td>
						<td valign='top'>$namaModul</td>
					</tr>
					<tr>
						<td width='10%' valign='top'>TANGGAL ORDER</td>
						<td width='1%' valign='top'> : </td>
						<td valign='top'>".VulnWalkerTitiMangsa($grabCekAplikasi['tanggal'])."</td>
					</tr>
					<tr>
						<td width='10%' valign='top'>DARI</td>
						<td width='1%' valign='top'> : </td>
						<td valign='top'>$namaPegawai</td>
					</tr>
					<tr>
						<td width='10%' valign='top'>STATUS</td>
						<td width='1%' valign='top'> : </td>
						<td valign='top'>$status</td>
					</tr>
					
				<br>
				";
		echo "
				<span style='font-size:16px;font-weight:bold;text-decoration: '>
				</span><br>
								<table table width='100%' class='cetak' border='1' style='margin:4 0 0 0;width:100%;'>
									<tr>
										<th class='th01' width = '50' >NO</th>
										<th class='th01' width = '500' >ITEM CEK</th>
										<th class='th01' width = '300' >HASIL</th>
										<th class='th01' width = '100' >TANGGAL CEK</th>
										
										<th class='th01' width = '50' >STATUS</th>
							
										
									</tr>
									
								
									
		";

		$no = 1;
		while($daqry = mysql_fetch_array($aqry)){
			foreach ($daqry as $key => $value) { 
				  $$key = $value; 
			} 
			
			

					echo "
								<tr valign='top'>
									<td align='center' class='GarisCetak' >".$no."</td>
									<td align='left' class='GarisCetak' >".$item."</td>
									<td align='left' class='GarisCetak' >".$hasil."</td>
									<td align='center' class='GarisCetak' >".$tanggal_check."</td>
									<td align='center' class='GarisCetak' >".$status."</td>

								</tr>
				";
				
				
				//echo json_encode($this->publicExcept);
			
		
			$no++;
			$k = "";
			$l = "";
		    $m = "";
			$n = "";
			$o = "";
			$uraian = "";
			$volume_rek = "";
			$satuan_rek = "";
			$jumlah = "";
			$jumlah_harga = "";
			
		}

	}
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 

		//kondisi -----------------------------------
				
		$arrKondisi = array();		
		

		$fmPILCARIvalue = $_REQUEST['fmPILCARIvalue'];
		$fmFiltTglBtw = $_REQUEST['fmFiltTglBtw'];			
		$fmFiltTglBtw_tgl1 = $_REQUEST['fmFiltTglBtw_tgl1'];
		$fmFiltTglBtw_tgl2 = $_REQUEST['fmFiltTglBtw_tgl2'];



		$username = $_COOKIE['coID'];
		$parentID = $_COOKIE['coParentCek'];

		$this->pagePerHal=$fmLimit;


		$arrKondisi[]= "id_parent='$parentID'";	
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		$arrOrders[] = " id $Asc1 " ;
			
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
		$cmbUnit = $_REQUEST['cmbUnit'];
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order , 'NoAwal'=>$NoAwal);
		
	}
	

}
$rincianCek = new rincianCekObj();
$rincianCek->username = $_COOKIE['coID'];
?>