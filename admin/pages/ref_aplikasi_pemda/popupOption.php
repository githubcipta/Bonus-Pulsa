<?php

class popupOptionObj  extends DaftarObj2{	
	var $Prefix = 'popupOption';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'temp_rincian_aplikasi_pemda'; //daftar
	var $TblName_Hapus = 'temp_rincian_aplikasi_pemda';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 1;
	var $PageTitle = 'Referensi Data';
	var $PageIcon = 'images/masterData_01.gif';
	var $pagePerHal ='';
	var $cetak_xls=TRUE ;
	var $fileNameExcel='usulansk.xls';
	var $Cetak_Judul = 'JURNAL';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'popupOptionForm'; 	
	var $username = "";
			
	function setTitle(){
		return '';
	}
	function setMenuEdit(){
		return
			"";
	}
	function setTopBar(){
		return "";
	}
	function setMenuView(){
		return "";
	}
	function setCetak_Header($Mode=''){
		global $Main, $HTTP_COOKIE_VARS;
		
		//$fmSKPD = cekPOST($this->Prefix.'SkpdfmSKPD'); //echo 'fmskpd='.$fmSKPD;
		//$fmUNIT = cekPOST($this->Prefix.'SkpdfmUNIT');
		//$fmSUBUNIT = cekPOST($this->Prefix.'SkpdfmSUBUNIT');
		return
			"<table style='width:100%' border=\"0\">
			<tr>
				<td class=\"judulcetak\">".$this->setCetakTitle()."</td>
			</tr>
			</table>";	
			/*"<table width=\"100%\" border=\"0\">
				<tr>
					<td class=\"subjudulcetak\">".PrintSKPD2($fmSKPD, $fmUNIT, $fmSUBUNIT)."</td>
				</tr>
			</table><br>";*/
	}		
	
	//function setPage_IconPage(){		return 'images/masterData_ico.gif';	}	
	function simpan(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 $uid = $HTTP_COOKIE_VARS['coID'];
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	 //get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];
	 $kode_jurnal = $_REQUEST['kode_jurnal'];
	 $nm_account = $_REQUEST['nm_account'];
 	 /*if($err=='' && $kode_jurnal =='' ) $err= 'Kode Akun belum diisi';
 	 if($err=='' && $nama_jurnal =='' ) $err= 'Nama Akun belum diisi';*/	 	 	 	 	 
	 
			if($fmST == 0){ //input ref_jurnal
				if($err==''){ 
					 $kode_jurnal = explode('.',$_REQUEST['kode_jurnal']);
					 $ka=$kode_jurnal[0];	
					 $kb=$kode_jurnal[1];
					 $kc=$kode_jurnal[2];	
					 $kd=$kode_jurnal[3];
					 $ke=$kode_jurnal[4];	 	  
					$kf=$kode_jurnal[5];  
					$aqry1 ="INSERT into ref_jurnal (ka,kb,kc,kd,ke,kf, nm_account)
							 "."values('$ka','$kb','$kc','$kd','$ke','$kf','$nm_account')";	$cek .= $aqry1;	
					$qry = mysql_query($aqry1);
					if($qry==FALSE) $err="Gagal Simpan Kode Akun Sudah Ada";
							
				}else{
					$err="Gagal Simpan Kode Akun Sudah Ada";
				}
			}elseif($fmST == 1){						
				if($err==''){
					 $kode_jurnal = explode('.',$idplh);
					 $ka=$kode_jurnal[0];	
					 $kb=$kode_jurnal[1];
					 $kc=$kode_jurnal[2];	
					 $kd=$kode_jurnal[3];
					 $ke=$kode_jurnal[4];
					$kf=$kode_jurnal[5];
					
					$aqry2 = "UPDATE ref_jurnal
			        		 set "." nm_account = '$nm_account' ".
					 		 "WHERE concat(ka,'.',kb,'.',kc,'.',kd,'.',ke,'.',kf)= '".$_REQUEST['kode_jurnal']."'";	$cek .= $aqry2;
					$qry = mysql_query($aqry2);
					if($qry==FALSE) $err="Gagal Edit jurnal";							
				}else{
					$err="Gagal menyimpan jurnal";
				}
			}else{
			/*if($err==''){ 
						$kode_barang = explode(' ',$idplh);
						 $f=$kode_barang[0];	
						 $g=$kode_barang[1];
						 $h=$kode_barang[2];	
						 $i=$kode_barang[3];
						 $j=$kode_barang[4];
 						
						$aqry1 = "INSERT into ref_hargabarang_persediaan (f,g,h,i,j,tahun_anggaran,harga)
						"."values('$f','$g','$h','$i','$j','$tahun_anggaran','$harga')";	$cek .= $aqry1;	
						$qry = mysql_query($aqry1);
						 
				}*/
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
		
		case 'clear':{				
			mysql_query("delete from $this->TblName where username = '$this->username'");				
		break;
		}
		
		case 'checkboxChanged':{				
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('status' => $jenis);
				mysql_query(VulnWalkerUpdate($this->TblName,$data,"id = '$id'"));	
				
		break;
		}
				
		case 'formEdit':{				
			$fm = $this->setFormEdit();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'windowshow':{
				$fm = $this->windowShow($_REQUEST['idAplikasi']);
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];	
			break;
		}

	   	case 'getData':{
			foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
			$getIdAplikasiPemda = mysql_fetch_array(mysql_query("select * from temp_rincian_aplikasi_pemda where username = '$this->username'"));
			mysql_query("delete from rincian_aplikasi_pemda where id_aplikasi_pemda = '".$getIdAplikasiPemda['id_aplikasi_pemda']."'");
			if(mysql_num_rows(mysql_query("select * from temp_rincian_aplikasi_pemda where id_aplikasi = '$idAplikasi' and username = '$this->username' and status = 'checked'")) == 0){
				$err = "Tidak ada data yang di pilih";
			}else{

				$grabingTemp = mysql_query("select * from temp_rincian_aplikasi_pemda where id_aplikasi = '$idAplikasi' and username = '$this->username' and status = 'checked' ");
				while($rows = mysql_fetch_array($grabingTemp)){
					foreach ($rows as $key => $value) { 
						  $$key = $value; 
						}
					$data = array(	
									'id_aplikasi_pemda' => $id_aplikasi_pemda,
									'id_pemda' => $id_pemda,
									'id_aplikasi' => $idAplikasi,
									'id_modul' => $id_modul,
									'id_sub_modul' => $id_sub_modul,
									'status' => '1'
									);
					mysql_query(VulnWalkerInsert('rincian_aplikasi_pemda',$data));
					$cek = VulnWalkerInsert('rincian_aplikasi_pemda',$data);
				}
				
			}
		break;
	   }

					
		case 'simpan':{
			$get= $this->simpan();
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
			 "<script type='text/javascript' src='js/temp_rincian_aplikasi_pemda_pemda/popupOption.js' language='JavaScript' ></script>".		
			$scriptload;
	}
	function Hapus_Validasi($id){//id -> multi id with space delimiter
		$errmsg ='';
		$kode_jurnal = explode(' ',$id);
		$ka=$kode_jurnal[0];	
		$kb=$kode_jurnal[1];
		$kc=$kode_jurnal[2];	
		$kd=$kode_jurnal[3];
		$ke=$kode_jurnal[4];
		$kf=$kode_jurnal[5];
		
		$quricoy="select count(*) as cnt from ref_barang where ka='$ka' and kb='$kb' and kc='$kc' and kd='$kd' and ke='$ke' and kf='$kf'";
		$dt3 = mysql_fetch_array(mysql_query($quricoy));
		$korong = $dt3 ['cnt'];
		
		if($korong>0){
		
		$korong;
		$errmsg = "ada kode barang tidak bisa di edit/hapus, karena masih ada rinciannya !";
		}
		
		if($errmsg=='' && 
				mysql_num_rows(mysql_query(
					"select Id from buku_induk where ka='$ka' and kb='$kb' and kc='$kc' and kd='$kd' and ke='$ke' and kf='$kf' ")
				) >0 )
			{ $errmsg = 'Gagal Hapus! KODE AKUN Sudah ada di Buku Induk!';}
		return $errmsg;
	}
	//form ==================================
	function setFormBaru(){
		//$cbid = $_REQUEST[$this->Prefix.'_cb'];
		//$c = $_REQUEST[$this->Prefix.'SkpdfmSKPD'];
		//$d = $_REQUEST[$this->Prefix.'SkpdfmUNIT'];
		//$e = $_REQUEST[$this->Prefix.'SkpdSUBUNIT'];
		$cek =$cbid[0];				
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 0;
		$dt['readonly']='';
		$fmBIDANG = $_REQUEST['fmBIDANG'];
		$fmKELOMPOK = $_REQUEST['fmKELOMPOK'];
		$fmSUBKELOMPOK = $_REQUEST['fmSUBKELOMPOK'];
		$fmSUBSUBKELOMPOK = $_REQUEST['fmSUBSUBKELOMPOK'];
		if(!empty($fmBIDANG) && empty($fmKELOMPOK) && empty($fmSUBKELOMPOK) && empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.';
		}
		elseif(!empty($fmBIDANG) && !empty($fmKELOMPOK) && empty($fmSUBKELOMPOK) && empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.'.$fmKELOMPOK.'.';
		}
		elseif(!empty($fmBIDANG) && !empty($fmKELOMPOK) && !empty($fmSUBKELOMPOK) && empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.'.$fmKELOMPOK.'.'.$fmSUBKELOMPOK.'.';
		}
		elseif(!empty($fmBIDANG) && !empty($fmKELOMPOK) && !empty($fmSUBKELOMPOK) && !empty($fmSUBSUBKELOMPOK))
		{
			$dt['kode_jurnal']=$fmBIDANG.'.'.$fmKELOMPOK.'.'.$fmSUBKELOMPOK.'.'.$fmSUBSUBKELOMPOK.'.';
		}
		$fm = $this->setForm($dt);		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}	
   
  	function setFormEdit(){
		$cbid = $_REQUEST[$this->Prefix.'_cb'];
		//$c = $_REQUEST[$this->Prefix.'SkpdfmSKPD'];
		//$d = $_REQUEST[$this->Prefix.'SkpdfmUNIT'];
		//$e = $_REQUEST[$this->Prefix.'SkpdSUBUNIT'];
		$cek =$cbid[0];				
		$this->form_idplh = $cbid[0];
		$kode = explode(' ',$this->form_idplh);
		$this->form_fmST = 1;
		//get data
		$ka=$kode[0];
		$kb=$kode[1]; 
		$kc=$kode[2]; 
		$kd=$kode[3]; 
		$ke=$kode[4]; 
		$kf=$kode[5]; 
		//$bulan=date('Y-m-')."1";
		//query ambil data ref_jurnal
		$aqry = "select * from ref_jurnal where concat(ka,'.',kb,'.',kc,'.',kd,'.'ke,'.',kf)='".$ka.'.'.$kb.'.'.$kc.'.'.$kd.'.'.$ke.'.'.$kf."'"; $cek.=$aqry;
		$dt = mysql_fetch_array(mysql_query($aqry));
		$dt['kode_jurnal']=$ka.'.'.$kb.'.'.$kc.'.'.$kd.'.'.$ke.'.'.$kf; 
		$dt['readonly']='readonly';
		$fm = $this->setForm($dt);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	function setForm($dt){	
	 global $SensusTmp;
	 $cek = ''; $err=''; $content=''; 
		
	 $json = TRUE;	//$ErrMsg = 'tes';
	 	
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 550;
	 $this->form_height = 120;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'BARU';
	  }else{
		$this->form_caption = 'EDIT';
	  }
	  				

		//query ref_batal
		//$queryKB = "SELECT f,nama_barang FROM ref_barang_persediaan where f !=0 and g=0";
       //items ----------------------
		  $this->form_fields = array(
			'kode_jurnal' => array( 
								'label'=>'Kode Akun',
								'labelWidth'=>100, 
								'value'=>"<input type='text' name='kode_jurnal' value='".$dt['kode_jurnal']."' size='17px' id='kode_jurnal' ".$dt['readonly'].">&nbsp&nbsp  <font color=red>*1.3.1.1.1.1</font>" 
									 ),	
									 
			'nm_account' => array( 
								'label'=>'Nama Akun',
								'labelWidth'=>100, 
								'value'=>$dt['nm_account'], 
								'type'=>'text',
								'id'=>'nm_account',
								'param'=>"style='width:250ppx;text-transform: uppercase;' size=50px"
									 ),	
								 
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan()' title='Batal kunjungan' >".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}

	function windowShow($idAplikasi){		
		$cek = ''; $err=''; $content=''; 
		$json = TRUE;		
		$form_name = $this->FormName;

			$FormContent = $this->genDaftarInitial($fmSKPD, $fmUNIT, $fmSUBUNIT,$tahun_anggaran);
			$form = centerPage(
					"<form name='$form_name' id='$form_name' method='post' action=''>
					<input type='hidden' id = 'idAplikasi' name = 'idAplikasi' value = '$idAplikasi' >
					".
					createDialog(
						$form_name.'_div', 
						$FormContent,
						800,
						500,
						'Pilih Sub Modul Aplikasi',
						'',
						
						"<input type='button' value='Simpan' onclick ='".$this->Prefix.".windowSave()' >&nbsp".
						"<input type='button' value='Batal' onclick ='".$this->Prefix.".windowClose()' >".
						"<input type='hidden' id='".$this->Prefix."_idplh' name='".$this->Prefix."_idplh' value='$this->form_idplh' >".
						"<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >".
						"<input type='hidden' id='sesi' name='sesi' value='$sesi' >"
						,//$this->setForm_menubawah_content(),
						$this->form_menu_bawah_height
					).
					"</form>"
			);
			$content = $form;//$content = 'content';	
		//}
		
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function genDaftarInitial($nm_account='', $height=''){
		$filterAkun = $_REQUEST['filterAkun'];
		$vOpsi = $this->genDaftarOpsi();
		return			
			"<div id='{$this->Prefix}_cont_title' style='position:relative'></div>". 
			"<div id='{$this->Prefix}_cont_opsi' style='position:relative'>". 		
				//"<input type='hidden' id='".$this->Prefix."SkpdfmSKPD' name='".$this->Prefix."SkpdfmSKPD' value='$fmSKPD'>".
				//"<input type='hidden' id='".$this->Prefix."SkpdfmUNIT' name='".$this->Prefix."SkpdfmUNIT' value='$fmUNIT'>".
				//"<input type='hidden' id='".$this->Prefix."SkpdfmSUBUNIT' name='".$this->Prefix."SkpdfmSUBUNIT' value='$fmSUBUNIT'>".
				"<input type='hidden' id='".$this->Prefix."nm_account' name='".$this->Prefix."nm_account' value='$nm_account'>".
				//"<input type='hidden' id='".$this->Prefix."tahun_anggaran' name='".$this->Prefix."tahun_anggaran' value='$tahun_anggaran'>".
				"<input type='hidden' id='filterAkun' name='filterAkun' value='".$filterAkun."'>".
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
		
	//daftar =================================	
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $fmBIDANG = $_REQUEST['fmBIDANG'];
	 $fmKELOMPOK = $_REQUEST['fmKELOMPOK'];
	 $fmSUBKELOMPOK = $_REQUEST['fmSUBKELOMPOK'];
	 $fmSUBSUBKELOMPOK = $_REQUEST['fmSUBSUBKELOMPOK'];				 
	 $headerTable =
	 "<thead>
	 <tr>
  	   <th class='th01' width='50' >No.</th>	
	   <th class='th01' width='50' ></th>		
   	   <th class='th01' align='center' colspan='2' width='200'>KODE</th>
	   <th class='th01' align='center' width='600'>NAMA</th>	   	   	   
	   </tr>
	   </thead>";
	
		return $headerTable;
	}	
	
	
	function setCekBox($cb, $KeyValueStr, $isi){
		$hsl = '';
		/*if($KeyValueStr!=''){*/
			$hsl = "<input type='checkbox' $isi id='".$this->Prefix."_cb$cb' name='".$this->Prefix."_cb[]' 
					value='".$KeyValueStr."' onchange = $this->Prefix.thisChecked($KeyValueStr,'".$this->Prefix."_cb$cb'); >";					
		/*}*/
		return $hsl;
	}
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 global $Main;
	 
	 $Koloms = array();
	 foreach ($isi as $key => $value) { 
			  $$key = $value; 
			}
	 
	 $Koloms[] = array('align="center" width=""', $no.'.' );
	 
	 $TampilCheckBox =  $this->setCekBox($id, $id, $status);
	 if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 
	 $Koloms[] = array('align="center" width="" ',$id_modul);
	 $Koloms[] = array('align="center" width="" ',$id_sub_modul);
	 $getNamaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '".$_REQUEST['idAplikasi']."' and kode_modul ='$id_modul' and kode_sub_modul = '$id_sub_modul'"));
 	 $nama_aplikasi = $getNamaAplikasi['nama_aplikasi'];
	 $Koloms[] = array('align="left" width=""',$nama_aplikasi);	 	 	 	 
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	 global $Ref, $Main;	 
	 foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
		
		
	$TampilOpt = 
			//"<tr><td>".	
			"<div class='FilterBar'>".			
			"<table style='width:100%'>
			<tr>
			<td style='width:120px'>MODUL</td><td style='width:10px'>:</td>
			<td>".
			cmbQuery("cmbModul",$cmbModul,"select id,nama_aplikasi from ref_aplikasi where  kode_modul !='0' and kode_sub_modul = '0' ","onChange=\"$this->Prefix.refreshList(true)\"",'Semua Modul','').
			"</td>
			</tr>
			</table>".
			"</div>"
			;		
		return array('TampilOpt'=>$TampilOpt);
	}	
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//$thn_akun = $HTTP_COOKIE_VARS['coThnAnggaran'];
		//kondisi -----------------------------------
		$idAplikasi = $_REQUEST['idAplikasi'];
		$kode_modul = $_REQUEST['cmbModul'];
		$arrKondisi = array();		
		
		
		if(!empty($kode_modul)){
		
			$grabingModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id ='$kode_modul'"));
			$kode_modul = $grabingModul['kode_modul'];
			$arrKondisi[] = "id_modul = '$kode_modul'";
		}
		
		$arrKondisi[] = " id_aplikasi = '$idAplikasi'";

 		
	
		
		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		$arrOrders[] = "id_aplikasi,id_modul,id_sub_modul";

			$Order= join(',',$arrOrders);	
			$OrderDefault = ' ';// Order By no_terima desc ';
			$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;

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
	
}
$popupOption = new popupOptionObj();
$popupOption->username = $_COOKIE['coID'];

?> 