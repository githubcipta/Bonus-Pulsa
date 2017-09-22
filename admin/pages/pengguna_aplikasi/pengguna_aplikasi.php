<?php

class pengguna_aplikasiObj  extends DaftarObj2{	
	var $Prefix = 'pengguna_aplikasi';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'pengguna_aplikasi'; //bonus
	var $TblName_Hapus = 'pengguna_aplikasi';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'PENGGUNA APLIKASI';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='pengguna_aplikasi.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'pengguna_aplikasi';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'pengguna_aplikasiForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	var $username = "";
	
	function setTitle(){
		return 'PENGGUNA APLIKASI';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if( $produksi !='2'){
			return
				"<td>".genPanelIcon("javascript:".$this->Prefix.".Modul()","sections.png","Modul", 'Modul')."</td>".
				"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","sections.png","Baru", 'Baru')."</td>".
				"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
				"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>";	
			}	
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
	
	$dk= $_REQUEST['k'];
	$dl= $_REQUEST['l'];
	$dm= $_REQUEST['m'];
	$dn= $_REQUEST['n'];
	$do= $_REQUEST['o'];
	$nama= $_REQUEST['nm_pengguna_aplikasi'];
	

	//$ke = substr($ke,1,1);
	
								
	if($err==''){						
		
	$aqry = "UPDATE pengguna_aplikasi set k='$dk',l='$dl',m='$dm',n='$dn',o='$do',nm_pengguna_aplikasi='$nama' where concat (k,' ',l,' ',m,' ',n,' ',o)='".$idplh."'";$cek .= $aqry;
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
    	foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
		if(empty($cmbPemda))$err = "Pilih Pemda";
		if(empty($cmbAplikasi))$err = "Pilih Aplikasi";
		if(empty($url))$err = "Isi URL";
		if(empty($tanggal_update))$err = "Isi tanggal";
/*		if(empty($kontak_person_admin))$err = "Isi kontak admin";
		if(empty($telepon_admin))$err = "Isi telepon admin";
		if(empty($kontak_person_teknis))$err = "Isi kontak teknis";
		if(empty($telepon_teknis))$err = "Isi telepon teknis";
		if(empty($telepon))$err = "Isi nomor telepon";*/
		if(empty($cmbLokasi))$err = "Pilih lokasi server";
		/*if(empty($keterangan))$err = "Isi keterangan";
		if(empty($ip_publik))$err = "Isi ip publik";*/
		
		
		
	
			
			if($fmST == 0){
				if($err == ''){
					$tanggal_update = explode('-',$tanggal_update);
					$tanggal_update = $tanggal_update[2]."-".$tanggal_update[1]."-".$tanggal_update[0];
					$data = array(
								  'id_pemda' => $cmbPemda,
								  'id_aplikasi' => $cmbAplikasi,
								  'url' => $url,
								  'tanggal_update' => $tanggal_update,
								  'telepon' => $telepon,
								  'kontak_person_admin' => $kontak_person_admin,
								  'telepon_admin' => $telepon_admin,
								  'kontak_person_teknis' => $kontak_person_teknis,
								  'telepon_teknis' => $telepon_teknis,
								  'lokasi_server' => $cmbLokasi,
								  'ip_publik' => $ip_publik,
								  'keterangan' => $keterangan,
								  'username' => $this->username,
								  'tgl_update' => date('Y-m-d'),
								  
								);
					mysql_query(VulnWalkerInsert('pengguna_aplikasi',$data));
					$cek = VulnWalkerInsert('pengguna_aplikasi',$data);
				}
			}else{						
			$tanggal_update = explode('-',$tanggal_update);
					$tanggal_update = $tanggal_update[2]."-".$tanggal_update[1]."-".$tanggal_update[0];
					$data = array(
								  'id_pemda' => $cmbPemda,
								  'id_aplikasi' => $cmbAplikasi,
								  'url' => $url,
								  'tanggal_update' => $tanggal_update,
								  'telepon' => $telepon,
								  'kontak_person_admin' => $kontak_person_admin,
								  'telepon_admin' => $telepon_admin,
								  'kontak_person_teknis' => $kontak_person_teknis,
								  'telepon_teknis' => $telepon_teknis,
								  'lokasi_server' => $cmbLokasi,
								  'ip_publik' => $ip_publik,
								  'keterangan' => $keterangan,
								  'username' => $this->username,
								  'tgl_update' => date('Y-m-d'),
								  
								);
				mysql_query(VulnWalkerUpdate('pengguna_aplikasi',$data,"id='$hubla'"));
				$cek = VulnWalkerUpdate('pengguna_aplikasi',$data,"id='$hubla'");
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

		case 'getdata':{
				$Id = $_REQUEST['id'];
				$k = substr($Id, 0,1);
				$l = substr($Id, 2,1);
				$m = substr($Id, 4,1);
				$n = substr($Id, 6,2);
				$o = substr($Id, 9,2);
				$get = mysql_fetch_array( mysql_query("select *, concat(k,'.',l,'.',m,'.',n,'.',o) as kodepengguna_aplikasi  from pengguna_aplikasi where k='$k' AND l='$l' AND m='$m' AND n='$n' AND o='$o'"));
			
				
				$content = array('kode_pengguna_aplikasi' => $get['kodepengguna_aplikasi'], 'nm_pengguna_aplikasi' => $get['nm_pengguna_aplikasi']);
					
				
		break;
	    }
		
		case 'modul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				mysql_query("delete from temp_rincian_aplikasi_pemda where username = '$this->username'");	
				$idPenggunaAplikasi = $pengguna_aplikasi_cb[0];
				$getIdAplikasi = mysql_fetch_array(mysql_query("select * from $this->TblName where id = '$idPenggunaAplikasi'"));
				$idAplikasi = $getIdAplikasi['id_aplikasi'];
				$grabingAllSubModul = mysql_query("select * from ref_aplikasi where kode_aplikasi = '$idAplikasi' and kode_modul != '0' and kode_sub_modul !='0'");
			  while($rows = mysql_fetch_array($grabingAllSubModul)){
				  	foreach ($rows as $key => $value) { 
				 	 	$$key = $value; 
					}
					
					if(mysql_num_rows(mysql_query("select * from rincian_aplikasi_pemda where id_aplikasi_pemda= '$idPenggunaAplikasi' and id_pemda = '".$getIdAplikasi['id_pemda']."' and id_aplikasi = '$kode_aplikasi' and id_modul = '$kode_modul' and id_sub_modul = '$kode_sub_modul'")) != 0){
						$status = "checked";
					}else{
						$status = "";
					}
				    $data = array(	
									'id_aplikasi_pemda' => $idPenggunaAplikasi,
									'id_pemda' => $getIdAplikasi['id_pemda'],
									'id_aplikasi' => $kode_aplikasi,
									'id_modul' => $kode_modul,
									'id_sub_modul' => $kode_sub_modul,
									'status' => $status,
									'username' => $this->username,
									);
					mysql_query(VulnWalkerInsert("temp_rincian_aplikasi_pemda",$data));
					$cek ="select * from rincian_aplikasi_pemda where id_aplikasi_pemda= '$idPenggunaAplikasi' and id_pemda = '".$getIdAplikasi['id_pemda']."' and id_aplikasi = '$kode_aplikasi' and id_modul = '$kode_modul' and id_sub_modul = '$kode_sub_modul'";
			  }
				
				$content = array('idAplikasi'=>$idAplikasi);
		break;
	    }



		case 'simpanPemda':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_pemda where nama_pemda = '$namaPemda'")) > 0){
					$err = "Pemda Sudah Ada";
				}else{
					$data = array('nama_pemda' => $namaPemda);
					mysql_query(VulnWalkerInsert('ref_pemda',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_pemda where nama_pemda = '$namaPemda'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_pemda from ref_pemda",'style="width:500;"','-- Pilih Pemda --') );
				}
		break;
		}
		
		case 'simpanAplikasi':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_aplikasi where nama_pemda = '$namaAplikasi'")) > 0){
					$err = "Aplikasi Sudah Ada";
				}else{
					$data = array('nama_aplikasi' => $namaAplikasi);
					mysql_query(VulnWalkerInsert('ref_aplikasi',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_aplikasi where nama_aplikasi = '$namaAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_aplikasi from ref_aplikasi",'style="width:500;"','-- Pilih Aplikasi --') );
				}
		break;
		}
		
		case 'editPemda':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_pemda' => $namaPemda);
				mysql_query(VulnWalkerUpdate("ref_pemda",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_pemda where nama_pemda = '$namaPemda'"));
				$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_pemda from ref_pemda",'style="width:500;"','-- Pilih Pemda --') );
		break;
		}
		case 'editAplikasi':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_aplikasi' => $namaAplikasi);
				mysql_query(VulnWalkerUpdate("ref_aplikasi",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_aplikasi where nama_aplikasi = '$namaAplikasi'"));
				$content = array('replacer' => cmbQuery('cmbAplikasi',$idnya['id'],"select id,nama_aplikasi from ref_aplikasi",'style="width:500;"','-- Pilih Aplikasi --') );
		break;
		}


			

		case 'formBaru':{				
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		

		
		case 'formBaruPemda':{			
				$idPemda = $_REQUEST['idPemda'];
				$fm = $this->setFormBaruPemda($idPemda);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		case 'formBaruAplikasi':{			
				$idAplikasi = $_REQUEST['idAplikasi'];
				$fm = $this->setFormBaruAplikasi($idAplikasi);				
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
		

			
		case 'simpanEdit':{
			$get= $this->simpanEdit();
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
   


	
	 function setFormBaruPemda($idPemda){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruPemda($idPemda);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBaruAplikasi($idAplikasi){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruAplikasi($idAplikasi);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	

	
	
	function BaruPemda($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Pemda';
		$kemana = "EditPemda($dt)";
		$namaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id='$dt'"));
		$namaPemda = $namaPemda['nama_pemda'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Pemda';
		$nip	 = '';
		$KA1 = $_REQUEST ['fmKA'];
			
		$kemana = 'SimpanPemda()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama Pemda',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaPemda' id='namaPemda' value='$namaPemda' style='width:255px;' >

						</div>", 
						 ),	
									 			
				
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".$kemana' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormKB();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function BaruAplikasi($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Aplikasi';
		$kemana = "EditAplikasi($dt)";
		$namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id='$dt'"));
		$namaAplikasi = $namaAplikasi['nama_aplikasi'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Aplikasi';
		$nip	 = '';

			
		$kemana = 'SimpanAplikasi()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama Aplikasi',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaAplikasi' id='namaAplikasi' value='$namaAplikasi' style='width:255px;' >

						</div>", 
						 ),	
									 			
				
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".$kemana' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormKB();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	function genFormKB($withForm=TRUE, $params=NULL, $center=TRUE){	
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
	
	
	function setPage_OtherScript(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if($produksi != '1' && $produksi !='2'){
		
			$scriptload = 
					"<script>
						alert('Akses Ditolak');
						history.go(-1);
					</script>";
			
		}else{
			$scriptload = 
					"<script>
						$(document).ready(function(){ 
							".$this->Prefix.".loading();
						});
					</script>";
		}
		return 
			 "<script src='js/skpd.js' type='text/javascript'></script>
			 <script type='text/javascript' src='js/pengguna_aplikasi/pengguna_aplikasi.js' language='JavaScript' ></script>
			 <script type='text/javascript' src='js/ref_aplikasi_pemda/popupOption.js' language='JavaScript' ></script>
			 
			 ".'<link rel="stylesheet" href="datepicker/jquery-ui.css">
			  <script src="datepicker/jquery-1.12.4.js"></script>
			  <script src="datepicker/jquery-ui.js"></script>'.
			
			$scriptload;
	}
	
	//form ==================================
	/*function setFormBaru(){
		$dt=array();
		//$this->form_idplh ='';
		$this->form_fmST = 0;
		$dt['tgl'] = date("Y-m-d"); //set waktu sekarang
		$fm = $this->setForm($dt);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}*/
	
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
		$cek ='';
		
		foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}
		$this->form_fmST = 1;
		
		$fm = $this->setForm($pengguna_aplikasi_cb[0]);
		
		return	array ('cek'=>$cek.$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}	
	
	function setFormEditdata($dt){	
	 global $SensusTmp ,$Main;
	 
	 $cek = ''; $err=''; $content=''; 
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';				
	 $this->form_width = 490;
	 $this->form_height = 150;
	  if ($this->form_fmST==1) {
		$this->form_caption = 'FORM EDIT KODE pengguna_aplikasi';
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
		
		
		
		$queryKAedit=mysql_fetch_array(mysql_query("SELECT k, nm_pengguna_aplikasi FROM pengguna_aplikasi WHERE k='$k' and l = '0' and m='0' and n='00' and o='00'")) ;
		$cek.=$queryKAedit;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT l, nm_pengguna_aplikasi FROM pengguna_aplikasi WHERE k='$k' and l='$l' and m= '0' and n='00' and o='00'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT m, nm_pengguna_aplikasi FROM pengguna_aplikasi WHERE k='$k' and l='$l' and m='$m' and n='00' and o='00'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT n, nm_pengguna_aplikasi FROM pengguna_aplikasi WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='00'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT o, nm_pengguna_aplikasi FROM pengguna_aplikasi WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='$o'")) ;
	//	$cek.="SELECT ke, nm_account FROM ref_jurnal WHERE ka='$data_ka' and kb='$data_kb' and kc='$data_kc' and kd='$data_kd' and ke='$data_ke' and kf='0'";
					
	
		$datka=$queryKAedit['k'].".  ".$queryKAedit['nm_pengguna_aplikasi'];
		$datkb=$queryKBedit['l'].". ".$queryKBedit['nm_pengguna_aplikasi'];
		$datkc=$queryKCedit['m']." .  ".$queryKCedit['nm_pengguna_aplikasi'];
		$datkd=$queryKDedit['n'].". ".$queryKDedit['nm_pengguna_aplikasi'];
		$datke=$queryKEedit['o'];
	//	$datke=sprintf("%02s",$queryKEedit['ke'])." .  ".$queryKEedit['nm_account'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'kode_Akun' => array( 
						'label'=>'kode pengguna_aplikasi',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ek' id='ek' value='".$datka."' style='width:270px;' readonly>
						<input type ='hidden' name='k' id='k' value='".$queryKAedit['k']."'>
						</div>", 
						 ),
			'kode_kelompok' => array( 
						'label'=>'Kode Kelompok',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='el' id='el' value='".$datkb."' style='width:270px;' readonly>
						<input type ='hidden' name='l' id='l' value='".$queryKBedit['l']."'>
						</div>", 
						 ),
			'kode_Jenis' => array( 
						'label'=>'kode Jenis',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='em' id='em' value='".$datkc."' style='width:270px;' readonly>
						<input type ='hidden' name='m' id='m' value='".$queryKCedit['m']."'>
						</div>", 
						 ),
			'kode_Objek' => array( 
						'label'=>'kode Objek',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='en' id='en' value='".$datkd."' style='width:270px;' readonly>
						<input type ='hidden' name='n' id='n' value='".$queryKDedit['n']."'>
						</div>", 
						 ),
			'Kode_Rincian_Objek' => array( 
						'label'=>'Kode Rincian Objek',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='eo' id='eo' value='".$datke."' style='width:20px;' readonly>
						<input type ='hidden' name='o' id='o' value='".$queryKEedit['o']."'>
						<input type='text' name='nm_pengguna_aplikasi' id='nm_pengguna_aplikasi' value='".$dt['nm_pengguna_aplikasi']."' size='36px'>
						</div>", 
						 ),			 			 			 
						 			 
		 
			
			/*'Nama' => array( 
						'label'=>'Nama',
						//'id'=>'cont_object',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'><input type='text' name='nm_account' id='nm_account' value='".$dt['nm_account']."' size='40px'>
						</div>", 
						 ),		*/				 
			);
		//tombol
		$this->form_menubawah =	
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SimpanEdit()' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
			"<input type='hidden' name='ka' id='ka' value='".$dt['ka']."'>".
			"<input type='hidden' name='kb' id='kb' value='".$dt['kb']."'>".
			"<input type='hidden' name='kc' id='kc' value='".$dt['kc']."'>".
			"<input type='hidden' name='kd' id='kd' value='".$dt['kd']."'>".
			"<input type='hidden' name='ke' id='ke' value='".$dt['ke']."'>".
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
		
	function setForm($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	$this->form_width = 690;
	 $this->form_height = 260;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		
	//	$nip	 = '';
	  }else{
		$this->form_caption = 'Edit';			
		$readonly='readonly';
		$get = mysql_fetch_array(mysql_query("select * from pengguna_aplikasi where id ='$dt'"));
		foreach ($get as $key => $value) { 
			  $$key = $value; 
			}	
		$tanggal_update = explode("-",$tanggal_update);
		$tanggal_update = $tanggal_update[2]."-".$tanggal_update[1]."-".$tanggal_update[0];			
	  }
	    //ambil data trefditeruskan
		$arrayLokasi = array(
						array('PEMDA' , 'PEMDA'),
						array('LINTAS ARTHA' , 'LINTAS ARTHA'),
						
						);
	  $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota !='0'",'style="width:500;"','-- Pilih Pemda --');
	  $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul = '0'",'style="width:500;"','-- Pilih Aplikasi --');
		if($lokasi_server == ''){
			$lokasi_server = "LINTAS ARTHA";
		}
		$cmbLokasiServer = cmbArray('cmbLokasi',$lokasi_server,$arrayLokasi,'-- LOKASI SERVER --','style="width:400;"');			

	 //items ----------------------
	  $this->form_fields = array(
			
			'nama_pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>120, 
						'value'=> $cmbPemda
						 ),	
						 	
			
			'nama_aplikasi' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi
						 ),	
						 	
			'url' => array( 
						'label'=>'URL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='url' id='url' value='".$url."' placeholder='URL' style='width:500px;'>
						</div>", 
						 ),		
			'tgl_update' => array( 
						'label'=>'TANGGAL UPDATE',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggal_update' class='datepicker' id='tanggal_update' value='".$tanggal_update."' placeholder='TANGGAL UPDATE' style='width:150px;'>
						</div>", 
						 ),
			'kontak_person_admin' => array( 
						'label'=>'KONTAK ADMIN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='kontak_person_admin' id='kontak_person_admin' value='".$kontak_person_admin."' placeholder='KONTAK PERSON ADMIN' style='width:240;'> &nbsp&nbsp TELP : &nbsp <input type='text' name='telepon_admin' id='telepon_admin' value='".$telepon_admin."' placeholder='TELEPON ADMIN' style='width:200px;'>
						</div>", 
						 ),	
			'kontak_person_teknis' => array( 
						'label'=>'KONTAK TEKNIS',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='kontak_person_teknis' id='kontak_person_teknis' value='".$kontak_person_teknis."' placeholder='KONTAK PERSON TEKNIS' style='width:240;'> &nbsp&nbsp TELP : &nbsp <input type='text' name='telepon_teknis' id='telepon_teknis' value='".$telepon_teknis."' placeholder='TELEPON TEKNIS' style='width:200px;'>
						</div>", 
						 ),	
			'telepon' => array( 
						'label'=>'TELEPON',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='telepon' id='telepon' value='".$telepon."' placeholder='TELEPON' style='width:500px;'>
						</div>", 
						 ),	
			'lokasi_server' => array( 
						'label'=>'LOKASI SERVER',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						$cmbLokasiServer
						</div>", 
						 ),	
			'ip_publik' => array( 
						'label'=>'IP PUBLIK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='ip_publik' id='ip_publik' value='".$ip_publik."' placeholder='IP PUBLIK' style='width:500px;'>
						</div>", 
						 ),	
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='keterangan' id='keterangan' value='".$keterangan."' placeholder='KETERANGAN' style='width:500px;'>
						</div>", 
						 ),	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Simpan($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	
	/*function setPage_HeaderOther(){
	return 
			"<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='margin:0 0 0 0'>
	<tr><td class=\"menudottedline\" width=\"40%\" height=\"20\" style='text-align:right'><B>
	<A href=\"pages.php?Pg=ref_skpd\" title='Skpd'  >Skpd</a> |	
	<A href=\"pages.php?Pg=pengguna_aplikasi\" title='pengguna_aplikasi' style='color:blue'  >pengguna_aplikasi</a> |
	<A href=\"pages.php?Pg=ref_satuan\" title='Satuan'  >Satuan</a> |
	<A href=\"pages.php?Pg=ref_kepala_skpd\" title='Kepala Skpd'  >Kepala Skpd</a> |
	<A href=\"pages.php?Pg=ref_pengesahan\" title='Pengesahan'   >Pengesahan</a> |
	<A href=\"pages.php?Pg=ref_tapd\" title='Tapd'   >Tapd</a> |
	<A href=\"pages.php?Pg=ref_program\" title='Program & Kegiatan'   >Program & Kegiatan</a> |
	<A href=\"pages.php?Pg=ref_sumber_dana\" title='Sumber Dana'   >Sumber Dana</a> |
	
	</td></tr></table>";
	"<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='margin:0 0 0 0'>";
	
	}*/
		
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' rowspan = '2' >No.</th>
  	   $Checkbox		
	   <th class='th01' width='200' rowspan = '2' >NAMA PEMDA</th>
	   <th class='th01' width='500' rowspan = '2' align='center'>NAMA APLIKASI</th>
	   <th class='th01' width='100' rowspan = '2' align='center'>URL</th>
	   <th class='th01' width='100' rowspan = '2' align='center'>TGL UPDATE</th>
	   <th class='th02' width='100' rowspan = '1' colspan ='2' align='center'>KONTAK PERSON</th>
	   <th class='th01' width='100' rowspan = '2' align='center'>TELPON</th>
	   <th class='th01' width='100' rowspan = '2' align='center'>LOKASI SERVER</th>
	   <th class='th01' width='100' rowspan = '2' align='center'>IP PUBLIK</th>
	   <th class='th01' width='100' rowspan = '2' align='center'>KETERANGAN</th>
	  </tr>
	  <tr>
	  	<th class='th01' width='100' align='center'>ADMIN</th>
	  	<th class='th01' width='100' align='center'>TEKINIS</th>
	  </tr>
	   
	   </thead>";
	 
		return $headerTable;
	}	
	
	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 foreach ($isi as $key => $value) { 
			  $$key = $value; 
			}
	 
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	  if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 $nama_pemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$id_pemda'"));
	 $nama_aplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '0'"));
	 $Koloms[] = array('align="left"',$nama_pemda['nama_pemda']);
	 $Koloms[] = array('align="left"',$nama_aplikasi['nama_aplikasi']." ".$nama_pemda['nama_pemda']);
	 $Koloms[] = array('align="left"',"<a href='$url' target='_blank' style='cursor:pointer;' >$url</a>");
	 $Koloms[] = array('align="left"',$tanggal_update);
	 $Koloms[] = array('align="left"',$kontak_person_admin."<br>".$telepon_admin);
	 $Koloms[] = array('align="left"',$kontak_person_teknis."<br>".$telepon_teknis);
	 $Koloms[] = array('align="left"',$telepon);
	 $Koloms[] = array('align="left"',$lokasi_server);
	 $Koloms[] = array('align="left"',$ip_publik);
	 $Koloms[] = array('align="left"',$keterangan);
	 
	 
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	 global $Ref, $Main;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
		
	
				
	$TampilOpt = 
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td>CARI </td>
			<td>:</td>
			<td style='width:90%;'> 
			<input type = 'text' name ='cariPemda' id ='cariPemda' value ='$cariPemda'> <input type='button' value ='Cari' onclick =$this->Prefix.refreshList(true);>
			</td>
			</tr>
			<tr>

			
			
			
			
			
			</table>".
			"</div>";
		return array('TampilOpt'=>$TampilOpt);
	}	
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		//kondisi -----------------------------------
		$arrKondisi = array();	
		
		
		$cariPemda = $_REQUEST['cariPemda'];
		if(!empty($cariPemda)){
			$exc = mysql_query("select id from ref_pemda where nama_pemda like '%$cariPemda%'");
			$connn = array();
			while($rows = mysql_fetch_array($exc)){
				$connn[] = " id_pemda = '$rows[0]'";
			}
			
			if(sizeof($jsjs) != 1){
				$jsjs = join(' or ',$connn);
				$arrKondisi[] = "( $jsjs )";
			}else{
				$arrKondisi[] = $connn[0];
			}
			
			
			
		}

		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();

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
}
$pengguna_aplikasi = new pengguna_aplikasiObj();
$pengguna_aplikasi->username = $_COOKIE['coID'];
?>