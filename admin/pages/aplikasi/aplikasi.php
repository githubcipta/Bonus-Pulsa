<?php

class aplikasiObj  extends DaftarObj2{	
	var $Prefix = 'aplikasi';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'aplikasi'; //bonus
	var $TblName_Hapus = 'aplikasi';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'R/D';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='aplikasi.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'pengguna_aplikasi';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'aplikasiForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	var $username = "";
	
	function setTitle(){
		return 'R/D';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if( $produksi !='2'){
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Progres()","sections.png","Progres", 'Progres')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Check()","sections.png","Check", 'Check')."</td>".
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
		
	$aqry = "UPDATE aplikasi set k='$dk',l='$dl',m='$dm',n='$dn',o='$do',nm_pengguna_aplikasi='$nama' where concat (k,' ',l,' ',m,' ',n,' ',o)='".$idplh."'";$cek .= $aqry;
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
		
		if(empty($cmbPemda)){
			$err = "Pilih Pemda";
		}elseif(empty($cmbAplikasi)){
			$err = "Pilih Aplikasi";
		}elseif(empty($cmbModul)){
			$err = "Pilih Modul";
		}elseif(empty($cmbSubModul)){
			$err = "Pilih Sub Modul";
		}elseif(empty($pekerjaan)){
			$err = "Isi Pekerjaan";
		}elseif(empty($uraian)){
			$err = "Isi Uraian";
		}elseif(empty($cmbValidasi)){
			$err = "Pilih Status Validasi";
		}

			if($fmST == 0){
				if($err == ''){
					
					if(mysql_num_rows(mysql_query("select * from aplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '0' and id_modul ='0' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => '0',
										'id_modul' => '0',
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('aplikasi',$data));					
					}
					
					if(mysql_num_rows(mysql_query("select * from aplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('aplikasi',$data));					
					}
					
					/*if(mysql_num_rows(mysql_query("select * from aplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul'  and id_sub_modul = '$cmbSubModul' ")) != 0){
						$err = "Data Sub Modul Sudah Ada";
					}else{*/
						$data = array(
									 	'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => $cmbSubModul,
										'uraian' => $uraian,
										'pekerjaan' => $pekerjaan,
										'validasi' => $cmbValidasi,
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username,
										'tgl_create' => date('Y-m-d H:i:s'),
										);
						mysql_query(VulnWalkerInsert('aplikasi',$data));	
					//}

					
				}
			}else{	
			
					if(mysql_num_rows(mysql_query("select * from aplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '0' and id_modul ='0' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => '0',
										'id_modul' => '0',
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('aplikasi',$data));					
					}
					
					if(mysql_num_rows(mysql_query("select * from aplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('aplikasi',$data));					
					}
					
					/*if(mysql_num_rows(mysql_query("select * from aplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul'  and id_sub_modul = '$cmbSubModul' ")) != 0){
						$err = "Data Sub Modul Sudah Ada";
					}else{*/
						$data = array(
									 	'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => $cmbSubModul,
										'uraian' => $uraian,
										'pekerjaan' => $pekerjaan,
										'validasi' => $cmbValidasi,
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username,
										'tgl_update' => date('Y-m-d H:i:s'),
										);
						mysql_query(VulnWalkerUpdate('aplikasi',$data, "id = '$hubla'"));
						$cek = VulnWalkerUpdate('aplikasi',$data, "id = '$hubla'");	
					//}
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
				$get = mysql_fetch_array( mysql_query("select *, concat(k,'.',l,'.',m,'.',n,'.',o) as kodepengguna_aplikasi  from aplikasi where k='$k' AND l='$l' AND m='$m' AND n='$n' AND o='$o'"));
			
				
				$content = array('kode_pengguna_aplikasi' => $get['kodepengguna_aplikasi'], 'nm_pengguna_aplikasi' => $get['nm_pengguna_aplikasi']);
					
				
		break;
	    }
		
		
		case 'saveProgres':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				if(empty($progres)){
					$err = "Isi Progres";
				}elseif(empty($url)){
					$err = "Isi URL";
				}elseif(empty($cmbPegawai)){
					$err = "Pilih Pegawai";
				}/*elseif(empty($cmbInstall)){
					$err = "Pilih Status Install";
				}*/
				else{
					$data = array('progres' => $progres,
								  'url' => $url,
								  'programer' => $cmbPegawai,/*
								  'install' => $cmbInstall,*/
								  'username' => $this->username,
								  'tanggal_update' => date('Y-m-d'),
								  'tgl_progress' => date('Y-m-d H:i:s'),
								  'uid_progress' => $this->username,
								 
								 );
					mysql_query(VulnWalkerUpdate("aplikasi",$data, "id = '$hubla'"));
					
				}
				
					
				
		break;
	    }
		
		
		case 'saveCheck':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				if(empty($cmbCheck)){
					$err = "Pilih Status Check";
				}elseif(empty($cmbChecker)){
					$err = "Pilih Checker";
				}elseif(empty($cmbInstall)){
					$err = "Pilih Status Install";
				}elseif(empty($cmbInstaller)){
					$err = "Pilih Installer";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}
				else{
					$data = array('cek' =>$cmbCheck,
								  'checker' => $cmbChecker,
								  'install' => $cmbInstall,
								  'installer' => $cmbInstaller,
								  'keterangan' => $keterangan,
								  'username' => $this->username,
								  'tanggal_update' => date('Y-m-d'),
								  'tgl_cek' => date('Y-m-d H:i:s'),
								  'uid_cek' => $this->username,
								 
								 );
					mysql_query(VulnWalkerUpdate("aplikasi",$data, "id = '$hubla'"));
					$cek = VulnWalkerUpdate("aplikasi",$data, "id = '$hubla'");
				}
				
					
				
		break;
	    }
		
		case 'pemdaChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$queryCmbAplikasi = "select pengguna_aplikasi.id_aplikasi,ref_aplikasi.nama_aplikasi from pengguna_aplikasi 
inner join ref_aplikasi on pengguna_aplikasi.id_aplikasi = ref_aplikasi.kode_aplikasi where pengguna_aplikasi.id_pemda = '$idPemda' and ref_aplikasi.kode_modul = '0'";
					$cmbAplikasi = cmbQuery('cmbAplikasi','',$queryCmbAplikasi,"style='width:500;' onclick =$this->Prefix.aplikasiChanged(); ",'-- Pilih Aplikasi --');
					
				
				$content = array(
								  'cmbAplikasi' => $cmbAplikasi,
								  'cmbModul' => cmbQuery('cmbModul',$id_modul,$queryCmbModul,"style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --'), 
								  'cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --'), 
								 );
	
		break;
		}
		case 'aplikasiChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
				$content = array('cmbModul' => cmbQuery('cmbModul',$id_modul,$queryCmbModul,"style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --'),
								 'cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --')
								
								 );
	
		break;
		}
		
		case 'modulChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$queryCmbSubModul = "select kode_sub_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul  = '$cmbModul' and kode_sub_modul !='0'";
				$content = array('cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --')
								
								 );
	
		break;
		}
		

		case 'simpanModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_modul where nama_modul = '$namaModul' and parent ='0' and id_aplikasi = '$cmbAplikasi'")) > 0){
					$err = "Modul Sudah Ada";
				}else{
					$data = array('nama_modul' => $namaModul,
								  'parent' => '0',
								  'id_aplikasi' => $cmbAplikasi
								  );
					mysql_query(VulnWalkerInsert('ref_modul',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaModul' and parent = '0' and id_aplikasi = '$cmbAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='0' and id_aplikasi = '$cmbAplikasi'",'style="width:500;" onchange=$this->Prefix.modulChanged();','-- Pilih Modul --'),
									 'cmbSubModul' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='".$idnya['id']."' and id_aplikasi = '$cmbAplikasi'",'style="width:500;" ','-- Pilih Sub Modul --')
					 );
				}
		break;
		}
		
		
		case 'simpanSubModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_modul where nama_modul = '$namaSubModul' and parent ='$cmbModul' and id_aplikasi = '$cmbAplikasi'")) > 0){
					$err = "Sub Modul Sudah Ada";
				}else{
					$data = array('nama_modul' => $namaSubModul,
								  'parent' => $cmbModul,
								  'id_aplikasi' => $cmbAplikasi
								  );
					mysql_query(VulnWalkerInsert('ref_modul',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaSubModul' and parent = '$cmbModul' and id_aplikasi = '$cmbAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='$cmbModul' and id_aplikasi = '$cmbAplikasi'",'style="width:500;" ','-- Pilih Sub Modul --') );
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
		
		case 'editModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_modul' => $namaModul);
				mysql_query(VulnWalkerUpdate("ref_modul",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaModul' and parent = '0' and id_aplikasi = '$cmbAplikasi' "));
				$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='0' and id_aplikasi = '$cmbAplikasi'","style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --') );
		break;
		}
		
		case 'editSubModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_modul' => $namaSubModul);
				mysql_query(VulnWalkerUpdate("ref_modul",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_modul where nama_modul = '$namaSubModul' and parent = '$cmbModul' and id_aplikasi = '$cmbAplikasi' "));
				$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='$cmbModul' and id_aplikasi = '$cmbAplikasi'",'style="width:500;"','-- Pilih Sub Modul --') );
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
		
		case 'formProgres':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			$dt = $aplikasi_cb[0];		
			$fm = $this->Progres($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		
		case 'formCheck':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			$dt = $aplikasi_cb[0];		
			$fm = $this->Check($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		

		
		case 'formBaruModul':{			
				$idModul = $_REQUEST['idModul'];
				$fm = $this->setFormBaruModul($idModul);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		
		case 'formBaruSubModul':{			
				$idSubModul = $_REQUEST['idSubModul'];
				$fm = $this->setFormBaruSubModul($idSubModul);				
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
   


	
	 function setFormBaruModul($idModul){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruModul($idModul);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBaruSubModul($idSubModul){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruSubModul($idSubModul);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBaruAplikasi($idAplikasi){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruAplikasi($idAplikasi);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	

	
	
	function BaruModul($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Modul';
		$kemana = "EditModul($dt)";
		$namaModul = mysql_fetch_array(mysql_query("select * from ref_modul where id='$dt'"));
		$namaModul = $namaModul['nama_modul'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Modul';


		$kemana = 'SimpanModul()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama Modul',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaModul' id='namaModul' value='$namaModul' style='width:255px;' >

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
	
	
	function BaruSubModul($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Sub Modul';
		$kemana = "EditSubModul($dt)";
		$namaSubModul = mysql_fetch_array(mysql_query("select * from ref_modul where id='$dt'"));
		$namaSubModul = $namaSubModul['nama_modul'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Sub Modul';


		$kemana = 'SimpanSubModul()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama Sub Modul',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaSubModul' id='namaSubModul' value='$namaSubModul' style='width:255px;' >

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
			 <script type='text/javascript' src='js/aplikasi/aplikasi.js' language='JavaScript' ></script>
			 
			 ".'<pengguna_aplikasi rel="stylesheet" href="datepicker/jquery-ui.css">
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
		
		$fm = $this->setForm($aplikasi_cb[0]);
		
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
		
		
		
		$queryKAedit=mysql_fetch_array(mysql_query("SELECT k, nm_pengguna_aplikasi FROM aplikasi WHERE k='$k' and l = '0' and m='0' and n='00' and o='00'")) ;
		$cek.=$queryKAedit;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT l, nm_pengguna_aplikasi FROM aplikasi WHERE k='$k' and l='$l' and m= '0' and n='00' and o='00'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT m, nm_pengguna_aplikasi FROM aplikasi WHERE k='$k' and l='$l' and m='$m' and n='00' and o='00'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT n, nm_pengguna_aplikasi FROM aplikasi WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='00'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT o, nm_pengguna_aplikasi FROM aplikasi WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='$o'")) ;
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
	 			
	$this->form_width = 730;
	 $this->form_height = 210;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		
	//	$nip	 = '';
	  }else{
		$this->form_caption = 'Edit';			
		$readonly='readonly';
		$get = mysql_fetch_array(mysql_query("select * from aplikasi where id ='$dt'"));
		foreach ($get as $key => $value) { 
			  $$key = $value; 
			}	
			
		
			
	  }
	    //ambil data trefditeruskan
		$arrayValidasi = array(
						array('YA' , 'YA'),
						array('TIDAK' , 'TIDAK'),
						
						);
	  $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota!='0'","style='width:500;' onchange=$this->Prefix.pemdaChangeddisabeld();",'-- Pilih Pemda --');
	  $queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
	  $cmbModul = cmbQuery('cmbModul',$id_modul,$queryCmbModul,"style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --');
	  
	  $queryCmbSubModul = "select kode_sub_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul  = '$id_modul' and kode_sub_modul !='0'";
	  $cmbSubModul = cmbQuery('cmbSubModul',$id_sub_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --');
	  
	  /*$queryCmbAplikasi = "select pengguna_aplikasi.id_aplikasi,ref_aplikasi.nama_aplikasi from pengguna_aplikasi 
inner join ref_aplikasi on pengguna_aplikasi.id_aplikasi = ref_aplikasi.kode_aplikasi where pengguna_aplikasi.id_pemda = '$id_pemda' and ref_aplikasi.kode_modul = '0'";*/
	  $queryCmbAplikasi = "select kode_aplikasi, nama_aplikasi from ref_aplikasi where kode_modul = '0'";
					$cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,$queryCmbAplikasi,"style='width:500;' onchange =$this->Prefix.aplikasiChanged(); ",'-- Pilih Aplikasi --');
	  $cmbValidasi = cmbArray('cmbValidasi',$validasi,$arrayValidasi,'-- VALIDASI --','style="width:500;"');			

	 //items ----------------------
	  $this->form_fields = array(
			
			'nama_pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>150, 
						'value'=> $cmbPemda 
						 ),	
						 	
			
			'nama_aplikasi' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi 
						 ),	
						 	
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>100, 
						'value'=> $cmbModul, 
						 ),
			'sub_modul' => array( 
						'label'=>'SUB MODUL',
						'labelWidth'=>100, 
						'value'=> $cmbSubModul , 
						 ),	
			'pekerjaan' => array( 
						'label'=>'PEKERJAAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='pekerjaan' id='pekerjaan' value='".$pekerjaan."' placeholder='pekerjaan' style='width:500px;'>
						</div>", 
						 ),	

			'uraian' => array( 
						'label'=>'SPESIFIKASI PEKERJAAN',
						'labelWidth'=>100, 
						'value'=>"<textarea style='width:500px;height:50px;' name='uraian' id='uraian'>$uraian</textarea>",
						
						 ),
			'validasi' => array( 
						'label'=>'VALIDASI',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						$cmbValidasi
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
	
function Progres($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 120;
	 $this->form_caption = 'Progres';	
	 $got = mysql_fetch_array(mysql_query("select * from aplikasi where id='$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $arrayInstall = array(
						array('YA' , 'YA'),
						array('TIDAK' , 'TIDAK'),
						
						);	
	 $cmbInstall = cmbArray('cmbInstall',$install,$arrayInstall,'-- STATUS INSTALL --','style="width:200;"');	
	 $cmbPegawai = cmbQuery('cmbPegawai',$programer,"select Id,nama from ref_pegawai","style='width:200;'",'-- Pilih Pegawai --');
	 //items ----------------------
	  $this->form_fields = array(
			'progres' => array( 
						'label'=>'PROGRES',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='progres' id='progress' value='".$progres."' placeholder='PROGRES' style='width:70; text-align:right;'> %
						</div>", 
						 ),
			
			'url' => array( 
						'label'=>'URL',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='url' id='url' value='".$url."' placeholder='URL' style='width:250; text-align:left;'> 
						</div>", 
						 ),
			/*'status_install' => array( 
						'label'=>'STATUS INSTALL',
						'labelWidth'=>120, 
						'value'=> $cmbInstall 
						 ),	*/
			'pr' => array( 
						'label'=>'PROGRAMER',
						'labelWidth'=>120, 
						'value'=> $cmbPegawai 
						 ),	
						 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveProgres($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
		

function Check($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 140;
	 $this->form_caption = 'Check';	
	 $got = mysql_fetch_array(mysql_query("select * from aplikasi where id='$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $arrayInstall = array(
						array('YA' , 'YA'),
						array('TIDAK' , 'TIDAK'),
						
						);	
	 $cmbInstall = cmbArray('cmbInstall',$install,$arrayInstall,'-- STATUS INSTALL --','style="width:200;"');	
	 $cmbCheck = cmbArray('cmbCheck',$cek,$arrayInstall,'-- STATUS CHECK --','style="width:200;"');	
	 $cmbChecker = cmbQuery('cmbChecker',$checker,"select Id,nama from ref_pegawai","style='width:200;'",'-- Pilih Pegawai --');
	 $cmbInstaller = cmbQuery('cmbInstaller',$installer,"select Id,nama from ref_pegawai","style='width:200;'",'-- Pilih Pegawai --');
	 //items ----------------------
	  $this->form_fields = array(

			
			'status_check' => array( 
						'label'=>'STATUS CHECK',
						'labelWidth'=>120, 
						'value'=> $cmbCheck 
						 ),	
			'ck' => array( 
						'label'=>'CHECKER',
						'labelWidth'=>120, 
						'value'=> $cmbChecker 
						 ),	
			'status_install' => array( 
						'label'=>'STATUS INSTALL',
						'labelWidth'=>120, 
						'value'=> $cmbInstall 
						 ),	
			'pr' => array( 
						'label'=>'INSTALLER',
						'labelWidth'=>120, 
						'value'=> $cmbInstaller 
						 ),	
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='keterangan' id='keterangan' value='".$keterangan."' placeholder='KETERANGAN' style='width:200; text-align:left;'> 
						</div>", 
						 ),			 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveCheck($dt)' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
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
  	   <th class='th01' rowspan='2' width='5' >No.</th>
  	   $Checkbox		
		   <th class='th01' width='200' rowspan='2' >NAMA PEMDA / APLIKASI</th>
		   <th class='th01' width='300' rowspan='2' align='center'>MODUL / SUBMODUL</th>
		   <th class='th01' width='300' rowspan='2' align='center'>PEKERJAAN</th>
		   <th class='th01' width='300' rowspan='2' align='center'>SPESIFIKASI PEKERJAAN</th>
		   <th class='th01' width='200' rowspan='2' align='center'>PROGRES PENGEMBANGAN</th>
		   <th class='th02' width='100' rowspan='1' align='center' colspan = '2'>STATUS</th>
		   <th class='th01' width='100' rowspan='2' align='center'>KETERANGAN</th>
	   </tr>
	   <tr>
	   	<th class='th01' width='50' align='center'>CHECK</th>
	   	<th class='th01' width='50' align='center'>INSTALL</th>
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
	  
	 $nama_pemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$id_pemda'"));
	 $nama_aplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '0'"));
	 $nama_modul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul ='0'"));
	 $nama_sub_modul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul ='$id_sub_modul'"));
	 
	 if($id_aplikasi == '0'){
	 

			$namaPemda = "<b>".$nama_pemda['nama_pemda']."</b>";

		
		$TampilCheckBox = "";
	 }elseif($id_sub_modul == '0'){
	 
	 	$grabMinId2  = mysql_fetch_array(mysql_query("select min(concat(id_aplikasi,'.',id_modul,'.',id_sub_modul)) as urut from aplikasi where id_pemda = '$id_pemda' and id_aplikasi ='$id_aplikasi' "));
	    $minId2 = $grabMinId2['urut'];
		$concat2 = $id_aplikasi.".".$id_modul.".".$id_sub_modul;
		$ccas = $id_pemda.".".$id_aplikasi;
		if($ccas == $this->concatID ){
			
			
			
		}else{
			$namaAplikasi = $nama_aplikasi['nama_aplikasi'];
		}
		$namaPemda = "<span style ='margin-left:10px;'>- $namaAplikasi</span> ";
		$this->concatID = $id_pemda.".".$id_aplikasi;
		
		$namaModul = $nama_modul['nama_aplikasi'];
		$TampilCheckBox = "";
	 }else{
	 	$namaPemda = "";
		$namaAplikasi  = "";
		$namaModul ="<span style='margin-left:5px;'>- ".$nama_sub_modul['nama_aplikasi'];
		
		if($progres != '' || $progres != 0 ){
			$proses = $progres." %";
			$rowURL = "<br><a href='$url' target='_blank'>".$url."</a>";
		}
		$concatSubmodul = $id_pemda.".".$id_aplikasi.".".$id_modul.".".$id_sub_modul;
		if($this->concatSubmodul == $concatSubmodul  ){
			$namaModul = "";
		}
		$this->concatSubmodul = $id_pemda.".".$id_aplikasi.".".$id_modul.".".$id_sub_modul;
		
		$getProgramer = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$programer'"));
		$namaProgramer= $getProgramer['nama'];
		$rowProgramer = "<br>".$namaProgramer;
		
		
		$getChecker = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$checker'"));
		$namaChecker= $getChecker['nama'];
		$rowChecker = "<br>".$namaChecker;
		$getInstaller = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$installer'"));
		$namaInstaller= $getInstaller['nama'];
		$rowInstaller = "<br>".$namaInstaller;
	 }
	 
	 
	 if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 
	 $Koloms[] = array('align="left"',$namaPemda);
	 $Koloms[] = array('align="left"',$namaModul);
	 $Koloms[] = array('align="left"',$pekerjaan);
	 $Koloms[] = array('align="left"',str_replace("\n","<br>",$uraian));
	 $Koloms[] = array('align="left"',$proses.$rowURL.$rowProgramer);
	 $Koloms[] = array('align="center"',$cek.$rowChecker);
	 $Koloms[] = array('align="center"',$install.$rowInstaller);
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
			<td><input type='button' value ='Tampilkan' onclick =$this->Prefix.refreshList(true);> </td>
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
		
		
		/*$cariPemda = $_REQUEST['cariPemda'];
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
			
			
			
		}*/
		
		
		$grabAllParent = mysql_query("select * from aplikasi where id_aplikasi = '0' ");
		while($rows = mysql_fetch_array($grabAllParent)){
			foreach ($rows as $key => $value) { 
			  $$key = $value; 
			}
			
			if(mysql_num_rows(mysql_query("select * from aplikasi where  id_sub_modul !='0' and id_pemda = '$id_pemda'  ")) == 0){
				$concat = $id_pemda;
				$arrKondisi[] = "id_pemda != '$concat'";
			}else{
				$grabAllAplikasi = mysql_query("select * from aplikasi where id_aplikasi !='0' and id_pemda = '$id_pemda' and id_sub_modul = '0' ");
				while($rows2 = mysql_fetch_array($grabAllAplikasi)){
					foreach ($rows2 as $key => $value) { 
					  $$key = $value; 
					}
					if(mysql_num_rows(mysql_query("select * from aplikasi where id_modul = '$id_modul' and id_sub_modul !='0' and id_pemda = '$id_pemda' and id_aplikasi ='$id_aplikasi' ")) == 0){
						$concat = $id_pemda.".".$id_aplikasi.".".$id_modul;
						$arrKondisi[] = "concat(id_pemda,'.',id_aplikasi,'.',id_modul) != '$concat'";
					}
				}
				
			}
			
			
		}

		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		$arrOrders[] = "id_pemda,id_aplikasi,id_modul,id_sub_modul";

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
		/*$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		//$Limit = " limit ".(($HalDefault	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal; //$LimitHal = '';
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		//noawal ------------------------------------
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;	*/
		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
	}
}
$aplikasi = new aplikasiObj();
$aplikasi->username = $_COOKIE['coID'];
?>