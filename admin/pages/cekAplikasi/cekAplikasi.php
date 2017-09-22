<?php

class cekAplikasiObj  extends DaftarObj2{	
	var $Prefix = 'cekAplikasi';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'cek_aplikasi'; //bonus
	var $TblName_Hapus = 'cek_aplikasi';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'MAINTENANCE';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='cekAplikasi.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'LINK';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'cekAplikasiForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	var $username = "";
	
	function setTitle(){
		return 'MAINTENANCE';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if( $produksi !='2'){
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Order()","sections.png","Order", 'Order')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Check()","sections.png","Check", 'Check')."</td>".
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
	$nama= $_REQUEST['nm_LINK'];
	

	//$ke = substr($ke,1,1);
	
								
	if($err==''){						
		
	$aqry = "UPDATE cekAplikasi set k='$dk',l='$dl',m='$dm',n='$dn',o='$do',nm_LINK='$nama' where concat (k,' ',l,' ',m,' ',n,' ',o)='".$idplh."'";$cek .= $aqry;
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
			$err = "Pilih cekAplikasi";
		}elseif(empty($cmbModul)){
			$err = "Pilih Modul";
		}elseif(empty($cmbSubModul)){
			$err = "Pilih Sub Modul";
		}elseif(empty($uraian)){
			$err = "Isi Uraian";
		}elseif(empty($cmbValidasi)){
			$err = "Pilih Status Validasi";
		}

			if($fmST == 0){
				if($err == ''){
				
					if(mysql_num_rows(mysql_query("select * from cekAplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('cekAplikasi',$data));					
					}
					
					if(mysql_num_rows(mysql_query("select * from cekAplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul'  and id_sub_modul = '$cmbSubModul' ")) != 0){
						$err = "Data Sub Modul Sudah Ada";
					}else{
						$data = array(
									 	'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => $cmbSubModul,
										'uraian' => $uraian,
										'validasi' => $cmbValidasi,
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
										);
						mysql_query(VulnWalkerInsert('cekAplikasi',$data));	
					}

					
				}
			}else{	
					if(mysql_num_rows(mysql_query("select * from cekAplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul' and id_sub_modul = '0' ")) == 0){
						$data = array(
										'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => '0',
										'uraian' => '',
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
									 
									 );
						mysql_query(VulnWalkerInsert('cekAplikasi',$data));					
					}
					
					/*if(mysql_num_rows(mysql_query("select * from cekAplikasi where id_pemda = '$cmbPemda' and id_aplikasi = '$cmbAplikasi' and id_modul ='$cmbModul'  and id_sub_modul = '$cmbSubModul' ")) != 0){
						$err = "Data Sub Modul Sudah Ada";
					}else{*/
						$data = array(
									 	'id_pemda' => $cmbPemda,
										'id_aplikasi' => $cmbAplikasi,
										'id_modul' => $cmbModul,
										'id_sub_modul' => $cmbSubModul,
										'uraian' => $uraian,
										'validasi' => $cmbValidasi,
										'tanggal_update' => date('Y-m-d'),
										'username' => $this->username
										);
						mysql_query(VulnWalkerUpdate('cekAplikasi',$data, "id = '$hubla'"));
						$cek = VulnWalkerUpdate('cekAplikasi',$data, "id = '$hubla'");	
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
				$get = mysql_fetch_array( mysql_query("select *, concat(k,'.',l,'.',m,'.',n,'.',o) as kodeLINK  from cekAplikasi where k='$k' AND l='$l' AND m='$m' AND n='$n' AND o='$o'"));
			
				
				$content = array('kode_LINK' => $get['kodeLINK'], 'nm_LINK' => $get['nm_LINK']);
					
				
		break;
	    }
		
		
		case 'saveOrder':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($cmbAplikasi)){
					$err = "Pilih Aplikasi";
				}elseif(empty($cmbModul)){
					$err = "Pilih Aplikasi";
				}elseif(empty($tanggal_order)){
					$err = "Isi Tanggal Order";
				}elseif(empty($dari)){
					$err = "Pilih Pemda";
				}elseif(empty($keterangan)){
					$err = "Isi Keterangan";
				}else{
					$tanggal_order = explode("-",$tanggal_order);
					$tanggal_order = $tanggal_order[2]."-".$tanggal_order[1]."-".$tanggal_order[0];
					$data = array(
									'tanggal' => $tanggal_order,
									'id_aplikasi' => $cmbAplikasi,
									'id_modul' => $cmbModul,
									'dari' => $dari,
									'keterangan' => $keterangan,
									'status' => "BELUM",
									'tanggal_update' => date('Y-m-d'),
									'username' => $this->username,
									
									);
					if(empty($jenis)){
						$query = VulnWalkerInsert('cek_aplikasi', $data);
						mysql_query($query);
						$cek = $query;
					}else{
						$query = VulnWalkerUpdate('cek_aplikasi', $data,"id = '$hubla'");
						mysql_query($query);
						$cek = $query;
					}
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
								  'tanggal_update' => date('Y-m-d')
								 
								 );
					mysql_query(VulnWalkerUpdate("cekAplikasi",$data, "id = '$hubla'"));
					$cek = VulnWalkerUpdate("cekAplikasi",$data, "id = '$hubla'");
				}
				
					
				
		break;
	    }
		
		case 'pemdaChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$querycmbAplikasi = "select link.id_aplikasi,ref_cekAplikasi.nama_cekAplikasi from link inner join ref_cekAplikasi on link.id_aplikasi = ref_cekAplikasi.id  where link.id_pemda = '$idPemda'";
				$content = array(
								  'cmbAplikasi' => cmbQuery('cmbAplikasi',$id_aplikasi,$querycmbAplikasi,"style='width:500;' onchange=$this->Prefix.AplikasiChanged();",'-- Pilih cekAplikasi --'),
								  'cmbModul' => cmbQuery('cmbModul',$id_modul,$queryCmbModul,"style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --'), 
								  'cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --'), 
								 );
	
		break;
		}
		case 'AplikasiChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul ='0'";
				$content = array('cmbModul' => cmbQuery('cmbModul',$id_modul,$queryCmbModul,"style='width:500;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --'),
								 'cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"style='width:500;' ",'-- Pilih Sub Modul --')
								
								 );
	
		break;
		}
		
		case 'modulChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$queryCmbSubModul = "select id, nama_modul from ref_modul where id_aplikasi = '$cmbAplikasi' and parent = '$cmbModul'";
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
		
		case 'changeRow':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$grabData = mysql_fetch_array(mysql_query("select * from ref_cek where id = '$idCek' "));
				foreach ($grabData as $key => $value) { 
				  $$key = $value; 
				}
				$tanggal_check = explode('-',$tanggal_check);
				$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
				$item = "<input type='text' name ='itemCheck$id' id='itemCheck$id' value='$item' style='width:400px;' >";
				$hasil = "<input type='text' name ='hasil$id' id='hasil$id' value='$hasil' style='width:600px;' >";
				$tanggal = "<input type='text' name ='tanggal$id' id='tanggal$id' style='width:80;' value='$tanggal_check' >";
				
				$aksi  = " <img src='images/administrator/images/save_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=rincianCek.saveEdit('$id');></img>&nbsp  &nbsp   <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=rincianCek.refreshList(true);></img>";
				$arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
				
				$status = cmbArray('cmbStatus'.$idCek,$status,$arrayStatus,'-- STATUS --','style="width:80;"');
				
				$content = array(
									'spanItem' => $item,
									'spanHasil' => $hasil,
									'spanTanggal' => $tanggal,
									'spanStatus' => $status,
									'spanAction' => $aksi
								 
								 );
		break;
		}
		
		
		case 'simpanItem':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($itemCek)){
					$err = "Isi item cek";
				}/*elseif(empty($tanggal_check)){
					$err = "Isi tanggal check";
				}elseif(empty($hasil)){
					$err = "Isi Hasil";
				}elseif(empty($cmbStatus)){
					$err = "Pilih Status";
				}*/else{
					$tanggal_check = explode('-',$tanggal_check);
					$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
					$data = array(
									'item' => $itemCek,
									'tanggal_check' => '',
									'hasil' => '',
									'status' => 'TIDAK',
									'id_parent' => $_COOKIE['coParentCek'],
									
								
								
								);
					$query = VulnWalkerInsert('ref_cek',$data);
					mysql_query($query);
					
				}
		break;
		}
		
		
		case 'editItem':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(empty($itemCek)){
					$err = "Isi item cek";
				}elseif(empty($tanggal_check)){
					$err = "Isi tanggal check";
				}elseif(empty($hasil)){
					$err = "Isi Hasil";
				}elseif(empty($cmbStatus)){
					$err = "Pilih Status";
				}else{
					$tanggal_check = explode('-',$tanggal_check);
					$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
					$data = array(
									'item' => $itemCek,
									'tanggal_check' => $tanggal_check,
									'hasil' => $hasil,
									'status' => $cmbStatus,
								
								);
					$query = VulnWalkerUpdate('ref_cek',$data,"id = '$id'");
					mysql_query($query);
					
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
		
		case 'simpancekAplikasi':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_cekAplikasi where nama_pemda = '$namacekAplikasi'")) > 0){
					$err = "cekAplikasi Sudah Ada";
				}else{
					$data = array('nama_cekAplikasi' => $namacekAplikasi);
					mysql_query(VulnWalkerInsert('ref_cekAplikasi',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_cekAplikasi where nama_cekAplikasi = '$namacekAplikasi'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_cekAplikasi from ref_cekAplikasi",'style="width:500;"','-- Pilih cekAplikasi --') );
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
		
		
		case 'editcekAplikasi':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_cekAplikasi' => $namacekAplikasi);
				mysql_query(VulnWalkerUpdate("ref_cekAplikasi",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_cekAplikasi where nama_cekAplikasi = '$namacekAplikasi'"));
				$content = array('replacer' => cmbQuery('cmbAplikasi',$idnya['id'],"select id,nama_cekAplikasi from ref_cekAplikasi",'style="width:500;"','-- Pilih cekAplikasi --') );
		break;
		}


			

		case 'formBaru':{				
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formOrder':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			
			$fm = $this->Order($cekAplikasi_cb[0]);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		
		case 'formCheck':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			$dt = $cekAplikasi_cb[0];		
			$fm = $this->Check($dt);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		

		
		case 'formAddNew':{			
				$idCek = $_REQUEST['idCek'];
				
				$fm = $this->setFormAddNew($idCek);				
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
		
		case 'formBarucekAplikasi':{			
				$idcekAplikasi = $_REQUEST['idcekAplikasi'];
				$fm = $this->setFormBarucekAplikasi($idcekAplikasi);				
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
   


	
	 function setFormAddNew($idCek){
		
		$this->form_fmST = 0;
		
		$fm = $this->AddNew($idCek);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBaruSubModul($idSubModul){
		
		$this->form_fmST = 0;
		
		$fm = $this->BaruSubModul($idSubModul);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	
	 function setFormBarucekAplikasi($idcekAplikasi){
		
		$this->form_fmST = 0;
		
		$fm = $this->BarucekAplikasi($idcekAplikasi);
		return	array ('cek'=>$fm['cek'], 'err'=>$fm['err'], 'content'=>$fm['content']);
	}
	

	
	
	function AddNew($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 70;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit Item';
		$kemana = "EditItem($dt)";
		$get = mysql_fetch_array(mysql_query("select * from ref_cek where id='$dt'"));
		foreach ($get as $key => $value) { 
				  $$key = $value; 
				}
		$tanggal_check = explode('-',$tanggal_check);
		$tanggal_check = $tanggal_check[2]."-".$tanggal_check[1]."-".$tanggal_check[0];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru Item';


		$kemana = 'SimpanItem()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
		$arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
	 				);
		$cmbStatus = cmbArray('cmbStatus',$status,$arrayStatus,'-- STATUS --','style="width:300;"');
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'ITEM CHECK',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='itemCek' id='itemCek' value='$item' style='width:255px;' >

						</div>", 
						 ),
			/*'tgl_update' => array( 
						'label'=>'TANGGAL CHECK',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggal_check' class='datepicker' id='tanggal_check' value='".$tanggal_check."' placeholder='TANGGAL CHECK' style='width:150px;'>
						</div>", 
						 ),
			'Keloasdasmpok' => array( 
						'label'=>'HASIL',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='hasil' id='hasil' value='$hasil' style='width:255px;' >

						</div>", 
						 ),
		    'Keloasdasmpok' => array( 
						'label'=>'HASIL',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='hasil' id='hasil' value='$hasil' style='width:255px;' >

						</div>", 
						 ),
			'status' => array( 
						'label'=>'STATUS',
						'labelWidth'=>120, 
						'value'=>"<div style='float:left;'>
						$cmbStatus
						<input type='hidden' id ='jenis' name='jenis' value=''>
						</div>", 
						 ),*/
									 			
				
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
	
	function BarucekAplikasi($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit cekAplikasi';
		$kemana = "EditcekAplikasi($dt)";
		$namacekAplikasi = mysql_fetch_array(mysql_query("select * from ref_cekAplikasi where id='$dt'"));
		$namacekAplikasi = $namacekAplikasi['nama_cekAplikasi'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru cekAplikasi';
		$nip	 = '';

			
		$kemana = 'SimpancekAplikasi()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama cekAplikasi',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namacekAplikasi' id='namacekAplikasi' value='$namacekAplikasi' style='width:255px;' >

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
			 <script type='text/javascript' src='js/cekAplikasi/cekAplikasi.js' language='JavaScript' ></script>
			 <script type='text/javascript' src='js/cekAplikasi/rincianCek.js' language='JavaScript' ></script>
			 
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
		
		$fm = $this->setForm($cekAplikasi_cb[0]);
		
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
		$this->form_caption = 'FORM EDIT KODE LINK';
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
		
		
		
		$queryKAedit=mysql_fetch_array(mysql_query("SELECT k, nm_LINK FROM cekAplikasi WHERE k='$k' and l = '0' and m='0' and n='00' and o='00'")) ;
		$cek.=$queryKAedit;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT l, nm_LINK FROM cekAplikasi WHERE k='$k' and l='$l' and m= '0' and n='00' and o='00'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT m, nm_LINK FROM cekAplikasi WHERE k='$k' and l='$l' and m='$m' and n='00' and o='00'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT n, nm_LINK FROM cekAplikasi WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='00'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT o, nm_LINK FROM cekAplikasi WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='$o'")) ;
	//	$cek.="SELECT ke, nm_account FROM ref_jurnal WHERE ka='$data_ka' and kb='$data_kb' and kc='$data_kc' and kd='$data_kd' and ke='$data_ke' and kf='0'";
					
	
		$datka=$queryKAedit['k'].".  ".$queryKAedit['nm_LINK'];
		$datkb=$queryKBedit['l'].". ".$queryKBedit['nm_LINK'];
		$datkc=$queryKCedit['m']." .  ".$queryKCedit['nm_LINK'];
		$datkd=$queryKDedit['n'].". ".$queryKDedit['nm_LINK'];
		$datke=$queryKEedit['o'];
	//	$datke=sprintf("%02s",$queryKEedit['ke'])." .  ".$queryKEedit['nm_account'];
		
       //items ----------------------
		  $this->form_fields = array(
		  
		  'kode_Akun' => array( 
						'label'=>'kode LINK',
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
						<input type='text' name='nm_LINK' id='nm_LINK' value='".$dt['nm_LINK']."' size='36px'>
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
	 			
	$this->form_width = 720;
	 $this->form_height = 180;
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		
	//	$nip	 = '';
	  }else{
		$this->form_caption = 'Edit';			
		$readonly='readonly';
		$get = mysql_fetch_array(mysql_query("select * from cekAplikasi where id ='$dt'"));
		foreach ($get as $key => $value) { 
			  $$key = $value; 
			}	
			
	  }
	    //ambil data trefditeruskan
		$arrayValidasi = array(
						array('YA' , 'YA'),
						array('TIDAK' , 'TIDAK'),
						
						);
	  $cmbPegawai = cmbQuery('cmbPegawai',$dari,"select id,nama_pemda from ref_pemda","style='width:500;' onchange=$this->Prefix.pemdaChanged();",'-- Pilih Pemda --');
	  $cmbModul = cmbQuery('cmbModul',$id_modul,"select id,nama_modul from ref_modul where parent = '0' and id_aplikasi = '$id_aplikasi'","style='width:400;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --');
	  $cmbSubModul = cmbQuery('cmbSubModul',$id_sub_modul,"select id,nama_modul from ref_modul where parent = '$id_modul' and id_aplikasi = '$id_aplikasi'","style='width:400;' ",'-- Pilih Sub Modul --');
	  
	  $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select link.id_aplikasi,ref_cekAplikasi.nama_cekAplikasi from link inner join ref_cekAplikasi on link.id_aplikasi = ref_cekAplikasi.id  where link.id_pemda = '$id_pemda'","style='width:500;' onchange=$this->Prefix.cekAplikasiChanged();",'-- Pilih cekAplikasi --');
	
	  $cmbValidasi = cmbArray('cmbValidasi',$validasi,$arrayValidasi,'-- VALIDASI --','style="width:500;"');			

	 //items ----------------------
	  $this->form_fields = array(
			
			'nama_pemda' => array( 
						'label'=>'NAMA PEMDA',
						'labelWidth'=>120, 
						'value'=> $cmbPemda 
						 ),	
						 	
			
			'nama_cekAplikasi' => array( 
						'label'=>'NAMA cekAplikasi',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi 
						 ),	
						 	
			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>100, 
						'value'=> $cmbModul."&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".ModulBaru()' title='Kode Kelompok' >" ."&nbsp&nbsp&nbsp"."<input type='button' value='Edit' onclick ='".$this->Prefix.".ModulEdit()' title='Kode Kelompok' >" , 
						 ),
			'sub_modul' => array( 
						'label'=>'SUB MODUL',
						'labelWidth'=>100, 
						'value'=> $cmbSubModul."&nbsp&nbsp&nbsp&nbsp"."<input type='button' value='Baru' onclick ='".$this->Prefix.".SubModulBaru()' title='Kode Kelompok' >" ."&nbsp&nbsp&nbsp"."<input type='button' value='Edit' onclick ='".$this->Prefix.".SubModulEdit()' title='Kode Kelompok' >" , 
						 ),		
			'uraian' => array( 
						'label'=>'URAIAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='uraian' id='uraian' value='".$uraian."' placeholder='URAIAN' style='width:500px;'>
						</div>", 
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

function genForm2($withForm=TRUE){	
		$form_name = $this->Prefix.'_form';	
				
		if($withForm){
			$params->tipe=1;
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >"
					,//$this->setForm_menubawah_content(),
					$this->form_menu_bawah_height,
					'',$params
					).
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
					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >"
					,//$this->setForm_menubawah_content(),
					$this->form_menu_bawah_height
				);
			
			
		}
		return $form;
	}	
	

function Order($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 140;
	 $this->form_caption = 'Order';	
	 $got = mysql_fetch_array(mysql_query("select * from cek_aplikasi where id='$dt'"));
	
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $tanggal = explode('-',$tanggal);
	 $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	 $arrayStatus = array(
						array('SUDAH' , 'SUDAH'),
						array('BELUM' , 'BELUM'),
						
	 				);
	   $cmbAplikasi = cmbQuery('cmbAplikasi',$id_aplikasi,"select kode_aplikasi, nama_aplikasi from ref_aplikasi where kode_modul = '0' ","style='width:300;' onchange=$this->Prefix.AplikasiChanged();",'-- Pilih Aplikasi --'); //items ----------------------
	  	$queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul != '0' and kode_sub_modul ='0'";
	   $cmbModul = cmbQuery('cmbModul',$id_modul,$queryCmbModul,"style='width:300;' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --');
		$cmbStatus = cmbArray('cmbStatus',$status,$arrayStatus,'-- STATUS --','style="width:300;"');
		$cmbPegawai = cmbQuery('dari',$dari,"select Id,nama from ref_pegawai","style='width:300;' ",'-- Pilih Pegawai --');
	 $this->form_fields = array(
	 
	 		'apklikasi' => array( 
						'label'=>'NAMA APLIKASI',
						'labelWidth'=>120, 
						'value'=> $cmbAplikasi 
						 ),	
			'Modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>120, 
						'value'=> $cmbModul 
						 ),	
			'tgl_update' => array( 
						'label'=>'TANGGAL ORDER',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='tanggal_order' class='datepicker' id='tanggal_order' value='".$tanggal."' placeholder='TANGGAL ORDER' style='width:150px;'>
						</div>", 
						 ),
			
			'pr' => array( 
						'label'=>'DARI',
						'labelWidth'=>120, 
						'value'=> $cmbPegawai 
						 ),	
			/*'status' => array( 
						'label'=>'STATUS',
						'labelWidth'=>120, 
						'value'=> $cmbStatus 
						 ),	*/
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='keterangan'  id='keterangan' value='".$keterangan."' placeholder='KETERANGAN' style='width:300px;'>
						<input type='hidden' id='jenis' name ='jenis'>
						</div>", 
						 ),
						 	
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveOrder($dt)' title='Simpan' > &nbsp".
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
	 setcookie('coParentCek', $dt);
	 $this->form_width = 400;
	 $this->form_height = 140;
	 $this->form_caption = 'RINCIAN ORDER';	
	 $this->form_fields = array(
			'rincianCek' => array( 
						'label'=>'',
						'value'=>"
						
						<div id='rincianCek' style='height:5px'></div>", 
						
						'type'=>'merge'
					 ),						
			
			);
		//tombol
		
		/*"<input type='button' value='Simpan' onclick ='".$this->Prefix.".SaveCheck($dt)' title='Simpan' > &nbsp".*/
		$this->form_menubawah =
			
			
			"<input type='button' value='Tutup' onclick ='".$this->Prefix.".Tutup()' >";
							
		$form = $this->genForm2();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$dt, 'err'=>$err, 'content'=>$content);
	}
		
	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' rowspan='2' width='5' >No.</th>
  	   $Checkbox		
		   <th class='th01' width='100'  >TANGGAL</th>
		   <th class='th01' width='500' align='center'>NAMA APLIKASI</th>
		   <th class='th01' width='200' align='center'>MODUL</th>
		   <th class='th01' width='200' align='center'>DARI</th>
		   <th class='th01' width='50' align='center'>STATUS</th>
		   <th class='th01' width='200' align='center'>KETERANGAN</th>
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
	  
	 $nama_pegawai = mysql_fetch_array(mysql_query("select * from ref_pegawai where Id = '$dari'"));
	 $namaAplikasi = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '0'"));
	 $nama_modul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul = '0'"));
	 $nama_sub_modul = mysql_fetch_array(mysql_query("select * from ref_modul where id = '$id_sub_modul'"));
	 
	 if($status == "OK"){
	 	$warna = "black";
	 }else{
	 	$warna = "red";
	 }
	 
	 
	 if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);

	 $Koloms[] = array('align="center"',VulnWalkerTitiMangsa($tanggal));
	 $Koloms[] = array('align="left"',$namaAplikasi['nama_aplikasi']);

	 $Koloms[] = array('align="left"',$nama_modul['nama_aplikasi']);
	 $Koloms[] = array('align="left"',$nama_pegawai['nama']);
	 $Koloms[] = array('align="center"',"<span style='color:$warna;'>".$status."</span>");
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
		
		
		/*$grabAllParent = mysql_query("select * from cekAplikasi where id_sub_modul = '0'");
		while($rows = mysql_fetch_array($grabAllParent)){
			foreach ($rows as $key => $value) { 
			  $$key = $value; 
			}
			if(mysql_num_rows(mysql_query("select * from cekAplikasi where id_modul = '$id_modul' and id_sub_modul !='0' and id_pemda = '$id_pemda' and id_aplikasi ='$id_aplikasi'")) == 0){
				$concat = $id_pemda.".".$id_aplikasi.".".$id_modul;
				$arrKondisi[] = "concat(id_pemda,'.',id_aplikasi,'.',id_modul) != '$concat'";
			}
		}*/
		
		
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
		

		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		/*$arrOrders[] = "id_pemda,id_aplikasi,id_modul,id_sub_modul";*/

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
$cekAplikasi = new cekAplikasiObj();
$cekAplikasi->username = $_COOKIE['coID'];
?>