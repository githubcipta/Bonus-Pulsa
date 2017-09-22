<?php

class cek_aplikasi_pemdaObj  extends DaftarObj2{	
	var $Prefix = 'cek_aplikasi_pemda';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'tabel_cek_aplikasi_pemda'; //bonus
	var $TblName_Hapus = 'tabel_cek_aplikasi_pemda';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);	
	var $checkbox_rowspan = 2;
	var $PageTitle = 'CEK APLIKASI PEMDA';
	var $PageIcon = 'images/masterdata_ico.gif';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='cek_aplikasi_pemda.xls';
	var $namaModulCetak='MASTER DATA';
	var $Cetak_Judul = 'pengguna_aplikasi';	
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'cek_aplikasi_pemdaForm';
	var $noModul=9; 
	var $TampilFilterColapse = 0; //0
	var $username = "";
	
	function setTitle(){
		return 'CEK APLIKASI PEMDA';
	}
	
	function setMenuEdit(){
		$getUserInfo = mysql_fetch_array(mysql_query("select * from admin where uid ='$this->username'"));
		foreach ($getUserInfo as $key => $value) { 
			  $$key = $value; 
			}	
		if( $produksi !='2'){
		return
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Sync()","sections.png","Sync", 'Sync')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Baru()","sections.png","Baru", 'Baru')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Edit()","edit_f2.png","Edit", 'Edit')."</td>".
			"<td>".genPanelIcon("javascript:".$this->Prefix.".Hapus()","delete_f2.png","Hapus", 'Hapus')."</td>";	
		}	
		/*"<td>".genPanelIcon("javascript:".$this->Prefix.".Check()","sections.png","Check", 'Check')."</td>".*/
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
		
	$aqry = "UPDATE cek_aplikasi_pemda set k='$dk',l='$dl',m='$dm',n='$dn',o='$do',nm_pengguna_aplikasi='$nama' where concat (k,' ',l,' ',m,' ',n,' ',o)='".$idplh."'";$cek .= $aqry;
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
		
		if(empty($cmbModulForm)){
			$err = "Pilih Modul";
		}elseif(empty($cmbKategori)){
			$err = "Pilih Kategori";
		}/*elseif(mysql_num_rows(mysql_query("select * from temp_cek_item where username ='$this->username' and status_delete !='delete'"))== 0){
			$err = "Isi Item Check";
		}*/

			if($fmST == 0){
				if($err == ''){
						
							$data = array( 'id_pemda' => $id_pemda,
										   'id_aplikasi' => $id_aplikasi,
										   'id_modul' => $cmbModulForm,
										   'id_kategori' => $cmbKategori,
										   'item_cek' => $itemCheck,
										   'keterangan' => $ket,
										   'username' => $username
										  
										  );
							mysql_query(VulnWalkerInsert("tabel_cek_aplikasi_pemda",$data));
						
				}
			}else{		

							$data = array( 

										   'id_modul' => $cmbModulForm,
										   'id_kategori' => $cmbKategori,
										   'item_cek' => $itemCheck,
										   'keterangan' => $ket,
										   'username' => $username
									  );
							
									mysql_query(VulnWalkerUpdate('tabel_cek_aplikasi_pemda',$data,"id = '$hubla'"));


			} 
					
			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);	
    }	
	
	function set_selector_other2($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;
		
	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}
	function tabelItem(){
			/*$datanya = "
				<tr class='row0'>
					<td align='center'>1.</td>
					<td><textarea name='CPTK' id='CPTK' style='width:100%; '>$CPTK</textarea></td>
					<td><textarea name='CPTU' id='CPTU' style='width:100%; '>$CPTU</textarea></td>
					<td><textarea name='CPTK' id='CPTK' style='width:100%; '>$CPTK</textarea></td>
			   </tr>
			   
			  
			";*/
			
		$aksi = '<a href="javascript:cek_aplikasi_pemda.newrincian_pekerjaan()" id="pengguna_aplikasiAtasButton"><img id="gambarAtasButton" src="datepicker/add-256.png" style="width:20px;height:20px;"></a>';
	
		$content2 = 
					"

					<table class='koptable' style='width:100%;' border='1' id='tabelRincianPekerjaan'>
						<tr>
								<th class='th01'>NO</th>

								<th class='th01'>ITEM CHECK</th>
								<th class='th01'>KETERANGAN</th>
								<th class='th01'>$aksi</th>	
							
						</tr>
						$datanya
					</table>
					"
				
				;
		return $content2;
	}
	
	
	function tabelHistori($id){
		
		        $query = mysql_query("select * from histori_cek_aplikasi_pemda where id_cek = '$id' order by id");
				$no = 1 ;
				while($rows = mysql_fetch_array($query)){
					foreach ($rows as $key => $value) { 
					  $$key = $value; 
					}
					if($no % 2 != 0){
						$tergantung = "row1";
					}else{
						$tergantung = "row0";
					}
					/*$getNamaModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul = '0'"));
					$namaModul = $getNamaModul['nama_aplikasi'];
					if($id_modul == '0'){
						$namaModul = "NON MODUL";
					}
					if($lastIDModul == $id_modul){
						$namaModul = "";
					}
					$action  = "<img src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";
					
					if($keterangan == ''){
						$action = "";
					}*/
					
					$isi =  "	
							<tr class='$tergantung'>
								<td align='center'>$no.</td>
								<td>".VulnWalkerTitiMangsa($tanggal_cek)."</td>
								<td>$username</td>
								<td>$keterangan</td>
								<td align='center'>$status_cek</td>
			   				</tr>
				
					";
					$lastIDModul = $id_modul;					
					$data .= $isi;
					$no += 1;
				}
				
		 	
		$content2 = 
					"

					<table class='koptable' style='width:100%;' border='1' >
						<tr>
								<th class='th01' width='20'>NO</th>
								<th class='th01' width='150'>TANGGAL CEK</th>
								<th class='th01' width='100'>USERNAME</th>
								<th class='th01'>KETERANGAN</th>
								<th class='th01' width='50'>STATUS</th>	
							
						</tr>
						$data
					</table>
					"
				
				;
		return $content2;
	}
	function set_selector_other($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	  
	  switch($tipe){
	  			case 'newrincian_pekerjaan':{			
				$fm = $this->newrincian_pekerjaan();				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		case 'copyData':{			
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				mysql_query("delete from tabel_cek_aplikasi_pemda where id_pemda = '$id_pemda' and id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul'");
				$grabDataCekAplikasi = mysql_query("select * from tabel_cek_aplikasi where id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul' order by concat(right((100 +id_aplikasi),2),'.',right((100 +id_modul),2),'.',right((100 +id_kategori),2),'.',right((100000 +id),5))");
				while($rows = mysql_fetch_array($grabDataCekAplikasi)){
					foreach ($rows as $key => $value) { 
					  $$key = $value; 
					}
					$data = array(
								  'id_pemda' => $id_pemda,
								  'id_aplikasi' => $id_aplikasi,
								  'id_modul' => $id_modul,
								  'id_kategori' => $id_kategori,
								  'item_cek' => $item_cek,
								  'keterangan' => $keterangan,
								  	
									);
					mysql_query(VulnWalkerInsert("tabel_cek_aplikasi_pemda",$data));
				}											
			break;
		}
		case 'cekOK':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				

					$data = array(
								 'status_cek' => "OK",
								 'tanggal_cek' => date("Y-m-d"),
								 'username' => $this->username
						);	
					mysql_query(VulnWalkerUpdate('tabel_cek_aplikasi_pemda',$data,"id = '$id'"));
					$dataHistory = array(
								 'status_cek' => "OK",
								 'tanggal_cek' => date("Y-m-d"),
								 'id_cek' => $id,
								 'username' => $this->username
						);	
					mysql_query(VulnWalkerInsert("histori_cek_aplikasi_pemda",$dataHistory));

		break;
	    }
		case 'cekNo':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				

					$data = array(
								 'status_cek' => "TIDAK",
								 'tanggal_cek' => date("Y-m-d"),
								 'username' => $this->username
						);	
					mysql_query(VulnWalkerUpdate('tabel_cek_aplikasi_pemda',$data,"id = '$id'"));
					$dataHistory = array(
								 'status_cek' => "TIDAK",
								 'tanggal_cek' => date("Y-m-d"),
								 'id_cek' => $id,
								 'username' => $this->username
						);	
					mysql_query(VulnWalkerInsert("histori_cek_aplikasi_pemda",$dataHistory));

		break;
	    }
		
		case 'Editrincian_pekerjaan':{
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
				}
				
				if(empty($itemCheck)){
					$err = "Isi Item Cek";
				}else{
				
					
					
					$data = array(
								'item_cek' => $itemCheck,
								 'keterangan' => $ket,
						);	
					mysql_query(VulnWalkerUpdate('temp_cek_item',$data,"id = '$id'"));
				}
				
				
				
		break;
	    }
		case 'editrincian_pekerjaan':{	
						
				$fm = $this->editrincian_pekerjaan($_REQUEST['idTemp']);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		case 'hapusRincian':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$getIDawal = mysql_fetch_array(mysql_query("select * from temp_cek_item where id = '$id'"));
				$idAwal = $getIDawal['id_awal'];
				
					$getIdParent = mysql_fetch_array(mysql_query("select * from temp_cek_item where id ='$id'"));
					$id_awal = $getIdParent['id_awal'];
					$data = array('status_delete' => 'delete',
								  'username' => $this->username
								  );
					mysql_query(VulnWalkerUpdate('temp_cek_item',$data,"id = '$id'"));
				
				
				
		break;
		}
		case 'Saverincian_pekerjaan':{			
				foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}
				if(empty($itemCheck))$err = "Isi Item Cek";										
				if(empty($err)){
					$data = array('item_cek' => $itemCheck,
								  'keterangan' => $ket,
								  'username' => $this->username
								);
					mysql_query(VulnWalkerInsert("temp_cek_item",$data));			
				}								
			break;
		}
			case 'getTabel':{
			foreach ($_REQUEST as $key => $value) { 
					  $$key = $value; 
					}
			$aksi = '<a href="javascript:cek_aplikasi_pemda.newrincian_pekerjaan()" id="pengguna_aplikasiAtasButton"><img id="gambarAtasButton" src="datepicker/add-256.png" style="width:20px;height:20px;"></a>';
			$header = "<tr>
								<th class='th01' width='20'>NO</th>

								<th class='th01' width='800'>ITEM CHECK</th>
								<th class='th01' width='400'>KETERANGAN</th>
								<th class='th01' width='50'>$aksi</th>	
							
						</tr>";
						
						

				//getDaftar
				$query = mysql_query("select * from temp_cek_item where username ='$this->username' and status_delete != 'delete'");
				$no = 1 ;
				while($rows = mysql_fetch_array($query)){
					foreach ($rows as $key => $value) { 
					  $$key = $value; 
					}
					if($no % 2 != 0){
						$tergantung = "row1";
					}else{
						$tergantung = "row0";
					}
					$getNamaModul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul = '0'"));
					$namaModul = $getNamaModul['nama_aplikasi'];
					if($id_modul == '0'){
						$namaModul = "NON MODUL";
					}
					if($lastIDModul == $id_modul){
						$namaModul = "";
					}
					$action  = "<img src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editRincian('$id');></img> &nbsp &nbsp <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusRincian('$id');></img>";
					
					if($keterangan == ''){
						$action = "";
					}
					
					$isi =  "	
							<tr class='$tergantung'>
								<td align='center'>$no.</td>
								<td>$item_cek</td>
								<td>$keterangan</td>
								<td align='center'><span id='spanAction$id'>$action</span></td>
			   				</tr>
				
					";
					$lastIDModul = $id_modul;					
					$data .= $isi;
					$no += 1;
				}
			
			$content = array('tabel' => $header.$data);
			
		break;
	    }
		
		case 'getdata':{
				$Id = $_REQUEST['id'];
				$k = substr($Id, 0,1);
				$l = substr($Id, 2,1);
				$m = substr($Id, 4,1);
				$n = substr($Id, 6,2);
				$o = substr($Id, 9,2);
				$get = mysql_fetch_array( mysql_query("select *, concat(k,'.',l,'.',m,'.',n,'.',o) as kodepengguna_aplikasi  from cek_aplikasi_pemda where k='$k' AND l='$l' AND m='$m' AND n='$n' AND o='$o'"));
			
				
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
					mysql_query(VulnWalkerUpdate("cek_aplikasi_pemda",$data, "id = '$hubla'"));
					
				}
				
					
				
		break;
	    }
		
		
		case 'saveCheck':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				if(empty($cmbCheck)){
					$err = "Pilih Status Check";
				}
				else{
					$data = array(
								 'status_cek' => $cmbCheck,
								 'tanggal_cek' => date("Y-m-d"),
								 'username' => $this->username
						);	
					mysql_query(VulnWalkerUpdate('tabel_cek_aplikasi_pemda',$data,"id = '$hubla'"));
					$dataHistory = array(
								 'status_cek' => $cmbCheck,
								 'tanggal_cek' => date("Y-m-d"),
								 'keterangan' => $keterangan,
								 'id_cek' => $hubla,
								 'username' => $this->username
						);	
					mysql_query(VulnWalkerInsert("histori_cek_aplikasi_pemda",$dataHistory));
				}
				
					
				
		break;
	    }
		
		case 'pemdaChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$querycmbAplikasi = "select pengguna_aplikasi.id_aplikasi,ref_aplikasi.nama_aplikasi from pengguna_aplikasi 
inner join ref_aplikasi on pengguna_aplikasi.id_aplikasi = ref_aplikasi.kode_aplikasi where pengguna_aplikasi.id_pemda = '$idPemda' and ref_aplikasi.kode_modul = '0'";
					$cmbAplikasi = cmbQuery('cmbAplikasi','',$querycmbAplikasi,"' onclick =$this->Prefix.cek_aplikasi_pemdaChanged(); ",'-- Pilih cek_aplikasi_pemda --');
					
				
				$content = array(
								  'cmbAplikasi' => $cmbAplikasi,
								  'cmbModul' => cmbQuery('cmbModul',$id_modul,$queryCmbModul,"' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --'), 
								  'cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"' ",'-- Pilih Sub Modul --'), 
								 );
	
		break;
		}
		case 'cek_aplikasi_pemdaChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
				$content = array('cmbModul' => cmbQuery('cmbModul',$id_modul,$queryCmbModul,"' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --'),
								 'cmbSubModul' => cmbQuery('cmbSubModul',$id_modul,$queryCmbSubModul,"' ",'-- Pilih Sub Modul --')
								
								 );
	
		break;
		}
		
		case 'modulChanged':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				
				$comboKategori = cmbQuery('cmbKategori',$id_kategori,"select id, nama from tabel_kategori where  id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul'"," style = 'width:380;'",'-- Pilih Kategori --');
	  			$content = array('cmbKategori' =>$comboKategori
								
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
				if(mysql_num_rows(mysql_query("select * from tabel_kategori where nama = '$namaKategori' and id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul' ")) > 0){
					$err = "Sub Modul Sudah Ada";
				}else{
					$data = array('nama' => $namaKategori,
								  'id_aplikasi' => $id_aplikasi,
								  'id_modul' => $id_modul
								  );
					mysql_query(VulnWalkerInsert('tabel_kategori',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from tabel_kategori where nama = '$namaKategori' and id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul' "));
					$content = array('replacer' => cmbQuery('cmbKategori',$idnya['id'],"select id,nama from tabel_kategori where id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul'",'style="width:500;" ','-- Pilih Kategori --') );
				}
		break;
		}
		
		case 'simpancek_aplikasi_pemda':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				if(mysql_num_rows(mysql_query("select * from ref_aplikasi where nama_pemda = '$namacek_aplikasi_pemda'")) > 0){
					$err = "cek_aplikasi_pemda Sudah Ada";
				}else{
					$data = array('nama_aplikasi' => $namacek_aplikasi_pemda);
					mysql_query(VulnWalkerInsert('ref_aplikasi',$data));
					$idnya = mysql_fetch_array(mysql_query("select * from ref_aplikasi where nama_aplikasi = '$namacek_aplikasi_pemda'"));
					$content = array('replacer' => cmbQuery('cmbPemda',$idnya['id'],"select id,nama_aplikasi from ref_aplikasi",'style="width:500;"','-- Pilih cek_aplikasi_pemda --') );
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
				$content = array('replacer' => cmbQuery('cmbModul',$idnya['id'],"select id,nama_modul from ref_modul where parent ='0' and id_aplikasi = '$cmbAplikasi'","' onchange=$this->Prefix.modulChanged();",'-- Pilih Modul --') );
		break;
		}
		
		case 'editSubModul':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama' => $namaKategori);
				mysql_query(VulnWalkerUpdate("tabel_kategori",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from tabel_kategori where nama = '$namaKategori'  "));
				$content = array('replacer' => cmbQuery('cmbKategori',$idnya['id'],"select id,nama from tabel_kategori where id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul'",'','-- Pilih Kategori --') );
		break;
		}
		
		
		case 'editcek_aplikasi_pemda':{
				foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
				$data = array('nama_aplikasi' => $namacek_aplikasi_pemda);
				mysql_query(VulnWalkerUpdate("ref_aplikasi",$data,"id='$id'"));
				$idnya = mysql_fetch_array(mysql_query("select * from ref_aplikasi where nama_aplikasi = '$namacek_aplikasi_pemda'"));
				$content = array('replacer' => cmbQuery('cmbAplikasi',$idnya['id'],"select id,nama_aplikasi from ref_aplikasi",'style="width:500;"','-- Pilih cek_aplikasi_pemda --') );
		break;
		}


			

		case 'formBaru':{		
			mysql_query("delete from temp_cek_item where username ='$this->username'");		
			$fm = $this->setFormBaru();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formSync':{			
			$fm = $this->formSync();				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'showHistori':{		
				
			$fm = $this->showHistori($_REQUEST['id']);				
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];												
		break;
		}
		
		case 'formProgres':{	
			foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
			$dt = $cek_aplikasi_pemda_cb[0];		
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
			
			$fm = $this->Check($idCheck);				
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
				$idSubModul = $_REQUEST['cmbKategori'];
				$fm = $this->setFormBaruSubModul($idSubModul);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}
		
		case 'formBarucek_aplikasi_pemda':{			
				$idcek_aplikasi_pemda = $_REQUEST['idcek_aplikasi_pemda'];
				$fm = $this->setFormBarucek_aplikasi_pemda($idcek_aplikasi_pemda);				
				$cek = $fm['cek'];
				$err = $fm['err'];
				$content = $fm['content'];												
			break;
		}		
		

		case 'formEdit':{			
			mysql_query("delete from temp_cek_item where username ='$this->username'");			
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
	
	 function setFormBarucek_aplikasi_pemda($idcek_aplikasi_pemda){
		
		$this->form_fmST = 0;
		
		$fm = $this->Barucek_aplikasi_pemda($idcek_aplikasi_pemda);
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
	 	$this->form_caption = 'Edit Kategori';
		$kemana = "EditSubModul($dt)";
		$namaSubModul = mysql_fetch_array(mysql_query("select * from tabel_kategori where id='$dt'"));
		$namaSubModul = $namaSubModul['nama'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Kategori Baru';


		$kemana = 'SimpanSubModul()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama Kategori',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namaKategori' id='namaKategori' value='$namaSubModul' style='width:255px;' >

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
	
	function Barucek_aplikasi_pemda($dt){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 80;
	 
	 if(!empty($dt)){
	 	$this->form_caption = 'Edit cek_aplikasi_pemda';
		$kemana = "Editcek_aplikasi_pemda($dt)";
		$namacek_aplikasi_pemda = mysql_fetch_array(mysql_query("select * from ref_aplikasi where id='$dt'"));
		$namacek_aplikasi_pemda = $namacek_aplikasi_pemda['nama_aplikasi'];
	 }else{
	 	if ($this->form_fmST==0) {
		$this->form_caption = 'Baru cek_aplikasi_pemda';
		$nip	 = '';

			
		$kemana = 'Simpancek_aplikasi_pemda()';
		
	  }
	 }
	  
	    //ambil data trefditeruskan
	  	$query = "" ;$cek .=$query;
	  	$res = mysql_query($query);
		
		
	 //items ----------------------
	  $this->form_fields = array(
			
			'Kelompok' => array( 
						'label'=>'Nama cek_aplikasi_pemda',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<input type='text' name='namacek_aplikasi_pemda' id='namacek_aplikasi_pemda' value='$namacek_aplikasi_pemda' style='width:255px;' >

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
			 <script type='text/javascript' src='js/cek_aplikasi/cek_aplikasi_pemda.js' language='JavaScript' ></script>
			 
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
		
		$fm = $this->setForm($cek_aplikasi_pemda_cb[0]);
		
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
		
		
		
		$queryKAedit=mysql_fetch_array(mysql_query("SELECT k, nm_pengguna_aplikasi FROM cek_aplikasi_pemda WHERE k='$k' and l = '0' and m='0' and n='00' and o='00'")) ;
		$cek.=$queryKAedit;
		$queryKBedit=mysql_fetch_array(mysql_query("SELECT l, nm_pengguna_aplikasi FROM cek_aplikasi_pemda WHERE k='$k' and l='$l' and m= '0' and n='00' and o='00'")) ;
		$queryKCedit=mysql_fetch_array(mysql_query("SELECT m, nm_pengguna_aplikasi FROM cek_aplikasi_pemda WHERE k='$k' and l='$l' and m='$m' and n='00' and o='00'")) ;
		$queryKDedit=mysql_fetch_array(mysql_query("SELECT n, nm_pengguna_aplikasi FROM cek_aplikasi_pemda WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='00'")) ;
		$queryKEedit=mysql_fetch_array(mysql_query("SELECT o, nm_pengguna_aplikasi FROM cek_aplikasi_pemda WHERE k='$k' and l='$l' and m='$m' and n='$n' and o='$o'")) ;
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
	 			
	 $this->form_width = 600;
	 $this->form_height = 360;
	 foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}	
	  if ($this->form_fmST==0) {
		$this->form_caption = 'Baru';
		$id_aplikasi = $_REQUEST['cmbAplikasi'];
	  }else{
		$this->form_caption = 'Edit';			
		$readonly='readonly';
		$get = mysql_fetch_array(mysql_query("select * from tabel_cek_aplikasi_pemda where id ='$dt'"));
		foreach ($get as $key => $value) { 
			  $$key = $value; 
			}	
		
			
		
			
	  }
	    //ambil data trefditeruskan
		$arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
						);
	  $cmbPemda = cmbQuery('cmbPemda',$id_pemda,"select id,nama_pemda from ref_pemda where kota!='0' "," style = 'width:475;' onchange=$this->Prefix.pemdaChangeddisabeld();",'-- Pilih Pemda --');
	  $queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '".$id_aplikasi."' and kode_modul != '0' and kode_sub_modul = '0'";
	  $cmbModul = cmbQuery('cmbModulForm',$id_modul,$queryCmbModul,"' onchange=$this->Prefix.modulChanged();  style = 'width:475;'",'-- Pilih Modul --');
	  $comboKategori = cmbQuery('cmbKategori',$id_kategori,"select id, nama from tabel_kategori where id_aplikasi = '$id_aplikasi' and id_modul = '$id_modul'"," style = 'width:380;'",'-- Pilih Kategori --');
	  
	if(empty($status))$status = "TIDAK";
	  
	$cmbValidasi = cmbArray('cmbStatus',$status,$arrayStatus,'-- STATUS --','');			

	 //items ----------------------
	  $this->form_fields = array(
			
			
						 	

			'modul' => array( 
						'label'=>'MODUL',
						'labelWidth'=>80, 
						'value'=> $cmbModul, 
						 ),
						 
			'kategori' => array( 
						'label'=>'KATEGORI',
						'labelWidth'=>80, 
						'value'=> $comboKategori."&nbsp <input type='button' value='Baru' onclick = $this->Prefix.SubModulBaru();> &nbsp  <input type='button' value='Edit' onclick = $this->Prefix.SubModulEdit()>", 
						 ),
			'spek' => array( 
						'label'=>'ITEM CEK',
						'labelWidth'=>80, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'itemCheck' id = 'itemCheck' style='width:575px;height:150px;' >$item_cek</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'ket' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>80, 
						'value'=>"", 
						 ),	
			'keasdast' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>80, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'ket' id = 'ket' style='width:575px; height:100px;'>$keterangan</textarea>

						</div>", 
						'type' => 'merge'
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
	function formSync(){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 400;
	 $this->form_height = 80;
	 foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}	
	 
		$this->form_caption = 'Sync';


	  
	    //ambil data trefditeruskan
		$arrayStatus = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
						);
	  $cmbPemda = cmbQuery('formPemda',$cmbPemda,"select id,nama_pemda from ref_pemda where kota !='0' "," ",'-- Pilih Pemda --');
	  $cmbAplikasi = cmbQuery('formAplikasi',$cmbAplikasi,"select kode_aplikasi,nama_aplikasi from ref_aplikasi where kode_modul='0' "," ",'-- Pilih Aplikasi --');
	  $cmbModul = cmbQuery('formModul',$cmbModul,"select kode_modul,nama_aplikasi from ref_aplikasi where kode_modul!='0' and kode_sub_modul = '0' "," ",'-- Pilih Aplikasi --');
	  
	

	 //items ----------------------
	  $this->form_fields = array(
			
			
						 	

			'modul' => array( 
						'label'=>'PEMDA',
						'labelWidth'=>80, 
						'value'=> $cmbPemda, 
						 ),
						 
			'asd' => array( 
						'label'=>'APLIKASI',
						'labelWidth'=>80, 
						'value'=> $cmbAplikasi, 
						 ),
			'aasdsd' => array( 
						'label'=>'MODUL',
						'labelWidth'=>80, 
						'value'=> $cmbModul, 
						 ),


			
				
			
			);
		//tombol
		$this->form_menubawah =
			
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".copyData()' title='Simpan' > &nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm();		
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	function showHistori($dt){	
	 global $SensusTmp ,$Main;
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_form';
	 			
	 $this->form_width = 500;
	 $this->form_height = 210;
	 foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}	
	
		$this->form_caption = 'HISTORI';			
		
		
	

	 //items ----------------------
	  $this->form_fields = array(
			
			
						 	




			'item_cek2' => array( 
						'label'=>'ITEM CEK',
						'labelWidth'=>100, 
						'value'=> $this->tabelHistori($dt),
						'type' => "merge"
						
						 ),

			
				
			
			);
		//tombol
		$this->form_menubawah =

			"<input type='button' value='Tutup' onclick ='".$this->Prefix.".Close()' >";
							
		$form = $this->genForm2();		
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
	 $got = mysql_fetch_array(mysql_query("select * from cek_aplikasi_pemda where id='$dt'"));
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
	 $this->form_height = 100;
	 $this->form_caption = 'Check';	
	 $got = mysql_fetch_array(mysql_query("select * from tabel_cek_aplikasi_pemda where id='$dt'"));
	 foreach ($got as $key => $value) { 
			  $$key = $value; 
			}
	 $arrayInstall = array(
						array('OK' , 'OK'),
						array('TIDAK' , 'TIDAK'),
						
						);	
	if(empty($status_cek))$status_cek='TIDAK';
	 $cmbCheck = cmbArray('cmbCheck',$status_cek,$arrayInstall,'-- STATUS CHECK --','');	

	  $this->form_fields = array(

			
			'status_check' => array( 
						'label'=>'STATUS CHECK',
						'labelWidth'=>120, 
						'value'=> $cmbCheck 
						 ),	
			'keterangan' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>120, 
						'value'=> "<textarea  name='keterangan' id = 'keterangan' style='width:220;height:50;'> </textarea>" 
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
	 if(isset($_REQUEST['jumlahPerHal'])){
	 	$Main->PagePerHal =  $_REQUEST['jumlahPerHal'];
	 }else{
	 	$Main->PagePerHal =  25;
	 }
	
		$rowspan_cbx = $this->checkbox_rowspan >1 ? "rowspan='$this->checkbox_rowspan'":'';
		$Checkbox = $Mode==1? 
			"<th class='th01' width='10' $rowspan_cbx>
					<input type='checkbox' name='".$this->Prefix."_toggle' id='".$this->Prefix."_toggle' value='' ".
						//" onClick=\"checkAll4($Main->PagePerHal,'".$this->Prefix."_cb','".$this->Prefix."_toggle','".$this->Prefix."_jmlcek');\" /> ".
						" onClick=\"checkAll4($Main->PagePerHal,'".$this->Prefix."_cb','".$this->Prefix."_toggle','".$this->Prefix."_jmlcek');".
							"$this->Prefix.checkAll($Main->PagePerHal,'".$this->Prefix."_cb','".$this->Prefix."_toggle','".$this->Prefix."_jmlcek')\" /> ".
						
			" </th>" : '';	
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01' width='5' >No.</th>
  	   $Checkbox

		   <th class='th01' width='300' >PEMDA / MODUL /KATEGORI</th>
		   <th class='th01' width='950'  align='center'>ITEM CEK</th>
		   <th class='th01' width='50'  align='center'>STATUS</th>
		   <th class='th01' width='250'  align='center'>KETERANGAN</th>
		   <th class='th01' width='150'  align='center'>TANGGAL CHECK</th>
		   
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
	  
	 $nama_modul = mysql_fetch_array(mysql_query("select * from ref_aplikasi where kode_aplikasi = '$id_aplikasi' and kode_modul = '$id_modul' and kode_sub_modul ='0'"));
	 $getNamaPemda = mysql_fetch_array(mysql_query("select * from ref_pemda where id = '$id_pemda'"));
	 $getNamaKategori = mysql_fetch_array(mysql_query("select * from tabel_kategori where id = '$id_kategori'"));
	 if($id_modul == $this->concatModul){
		 $nama_modul = "";	
	 }
	 $concatPemda = $id_pemda;
	 if($concatPemda == $this->concatPemda){
		 $getNamaPemda = "";	
		 
	 }else{
	 	$namaPemda = "<b>".$getNamaPemda['nama_pemda']."</b><br>";
	 }
	 $this->concatPemda = $id_pemda;
	 $concatModulKategori = $id_modul.".".$id_kategori;
	 if($concatModulKategori == $this->concatModulKategori){
		 $nama_modul = "";	
		 $getNamaKategori = "";
	 }else{
	 	$namaModul = "<span style='margin-left:10px;font-weight:bold;'>".$nama_modul['nama_aplikasi']."</span><br>";
	 }
	 if ($Mode == 1) $Koloms[] = array(" align='center' ", $TampilCheckBox);
	 
/*	 $Koloms[] = array('align="left"',$getNamaPemda['nama_pemda']);
	 $Koloms[] = array('align="left"',$nama_modul['nama_aplikasi']);*/
	 $Koloms[] = array('align="left"',$namaPemda.$namaModul. "<span style='margin-left:20px;'>".$getNamaKategori['nama']."</span>");
	 $this->concatModul = $id_modul;
	 $this->concatModulKategori = $id_modul.".".$id_kategori;
	 $Koloms[] = array('align="left"',str_replace("\n","<br>",$item_cek));
	 if($status_cek != "OK"){
	 	//$status_cek = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.CekOK($id) ></img>";
	 	$status_cek = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.formCheck($id) ></img>";
	 }else{
	 	$status_cek = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.formCheck($id)></img>";
	 	//$status_cek = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.CekNo($id)></img>";
	 }
	 $grabKeteranganHistori = mysql_fetch_array(mysql_query("select max(id) from histori_cek_aplikasi_pemda where id_cek = '$id'"));
	 $getKeteranganHistori = mysql_fetch_array(mysql_query("select * from histori_cek_aplikasi_pemda where id = '".$grabKeteranganHistori['max(id)']."'"));
	 $keteranganHistori = $getKeteranganHistori['keterangan'];
	 $Koloms[] = array('align="center"',$status_cek);
	 $Koloms[] = array('align="left"',$keteranganHistori);
	 $Koloms[] = array('align="left"',"<span style='cursor:pointer;' onclick=$this->Prefix.showHistori($id)>".VulnWalkerTitiMangsa($tanggal_cek)."</span><br>$username");
	
	

	 
	 
	 return $Koloms;
	}
	
	function genDaftarOpsi(){
	 global $Ref, $Main;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	  
	  $queryCmbPemda = "select id, nama_pemda from ref_pemda where kota !='0'";
	  $comboPemda = cmbQuery('cmbPemda',$cmbPemda,$queryCmbPemda,"' onchange =$this->Prefix.refreshList(true); ",'-- Semua Pemda --');
	  $querycmbAplikasi = "select kode_aplikasi, nama_aplikasi from ref_aplikasi where kode_modul = '0'";
	  $comboApp = cmbQuery('cmbAplikasi',$cmbAplikasi,$querycmbAplikasi,"' onchange =$this->Prefix.refreshList(true); ",'-- Semua Aplikasi --');
	  $queryCmbModul = "select kode_modul, nama_aplikasi from ref_aplikasi where kode_aplikasi = '$cmbAplikasi' and kode_modul != '0' and kode_sub_modul = '0'";
	  $comboMod = cmbQuery('cmbModul',$cmbModul,$queryCmbModul,"' onchange=$this->Prefix.refreshList(true);",'-- Semua Modul --');
	  $queryKateogiri = "select id, nama from tabel_kategori where id_aplikasi = '$cmbAplikasi' and id_modul = '$cmbModul'";
	  $comboKategori = cmbQuery('kategoriFilter',$kategoriFilter,$queryKateogiri,"' onchange=$this->Prefix.refreshList(true);",'-- Semua Kategori --');
	  
		 $arr = array(	
			array('TIDAK','TIDAK'),		
			array('OK','OK'),		
			);
		$comboStatus = cmbArray('statusFilter',$statusFilter,$arr,'-- SEMUA STATUS --',"onchange= $this->Prefix.refreshList(true)");		
	if(empty($jumlahPerHal))$jumlahPerHal = "25";
	$TampilOpt = 
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<tr>
			<td>PEMDA </td>
			<td>: </td>
			<td style='width:90%;'>$comboPemda </td>
			</tr>
			<tr>
			<td>APLIKASI </td>
			<td>: </td>
			<td style='width:90%;'>$comboApp </td>
			</tr>
			<tr>
			<td>MODUL </td>
			<td>: </td>
			<td style='width:90%;'>$comboMod </td>
			</tr>
			<tr>
			<td>KATEGORI </td>
			<td>: </td>
			<td style='width:90%;'>$comboKategori </td>
			</tr>
			<tr>
			<td>STATUS </td>
			<td>: </td>
			<td style='width:90%;'>$comboStatus </td>
			</tr>
			
			
			
			
			
			</table>".
			"</div>".
			"<div class='FilterBar' style='margin-top:5px;'>".
			"<table style='width:100%'>
			<td>JUMLAH/HAL </td>
			<td>: </td>
			<td style='width:90%;'><input type= 'text' id='jumlahPerHal' name='jumlahPerHal' value='$jumlahPerHal' style='width:40px;'> <input type='button' value='Tampilkan' onclick=$this->Prefix.refreshList(true) </td>
			</tr>
		
			
			
			
			
			
			</table>".
			"</div>"
			;
		return array('TampilOpt'=>$TampilOpt);
	}	
	
	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID']; 
		foreach ($_REQUEST as $key => $value) { 
			  $$key = $value; 
			}	
		//kondisi -----------------------------------
		
		$this->pagePerHal = $jumlahPerHal;
		if(empty($cmbAplikasi)){
		  	$cmbModul = "";
			$kategoriFilter = "";
		  }	
		  if(empty($cmbModul)){
			$kategoriFilter = "";
		  }	
		$arrKondisi = array();	
		if(!empty($cmbPemda))$arrKondisi[] = "id_pemda = '$cmbPemda'";
		if(!empty($cmbAplikasi))$arrKondisi[] = "id_aplikasi = '$cmbAplikasi'";
		if(!empty($cmbModul))$arrKondisi[] = "id_modul = '$cmbModul'";
		if(!empty($kategoriFilter))$arrKondisi[] = "id_kategori = '$kategoriFilter'";
		if(!empty($statusFilter)){
			if($statusFilter == "OK"){
				$arrKondisi[] = "status_cek = 'OK'";
			}else{
				$arrKondisi[] = "status_cek != 'OK'";
			}
			
		}
		

		$Kondisi= join(' and ',$arrKondisi);		
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');			
		$Asc1 = $fmDESC1 ==''? '': 'desc';		
		$arrOrders = array();
		/*$arrOrders[] = "id_pemda,id_aplikasi,id_modul,id_sub_modul"; right((100 +id_aplikasi),2),right((100 +id_modul),2)*/
		$arrOrders[] = "concat(right((100 +id_pemda),2),'.',right((100 +id_aplikasi),2),'.',right((100 +id_modul),2),'.',right((100 +id_kategori),2),'.',right((100000 +id),5))";

		$Order= join(',',$arrOrders);	
		$OrderDefault = '';// Order By no_terima desc ';
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		//$Order ="";
		//limit --------------------------------------
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal; 
		$HalDefault=cekPOST($this->Prefix.'_hal',1);					
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal; //$LimitHal = '';
		$Limit = $Mode == 3 ? '': $Limit;
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);							
		$NoAwal = $Mode == 3 ? 0: $NoAwal;
		
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
		
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

function newrincian_pekerjaan($id){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 200;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	 	$this->form_caption = 'BARU';
		if(!empty($id)){
			$kemana = "Editrincian_pekerjaan($id)";
			$read = "disabled";
		}else{
			$kemana = "Saverincian_pekerjaan()";
		}
		


	 //items ----------------------
	  $this->form_fields = array(


			'spek' => array( 
						'label'=>'ITEM CEK',
						'labelWidth'=>150, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'itemCheck' id = 'itemCheck' style='width:475px;height:50px;' >$item_cek</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'ket' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"", 
						 ),	
			'keasdast' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'ket' id = 'ket' style='width:475px; height:50px;'>$keterangan</textarea>

						</div>", 
						'type' => 'merge'
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
	
	function editrincian_pekerjaan($id){	
	 global $SensusTmp, $Main;
	 
	 $cek = ''; $err=''; $content=''; 		
	 $json = TRUE;	//$ErrMsg = 'tes';	 	
	 $form_name = $this->Prefix.'_formKB';				
	 $this->form_width = 500;
	 $this->form_height = 200;
	 foreach ($_REQUEST as $key => $value) { 
				  $$key = $value; 
				}
	 
	 	$this->form_caption = 'EDIT';
		
		
		$getData = mysql_fetch_array(mysql_query("select * from temp_cek_item where id = '$idTemp'"));
		foreach ($getData as $key => $value) { 
				  $$key = $value; 
				}

		

		
	 //items ----------------------
	  $this->form_fields = array(
			'spek' => array( 
						'label'=>'ITEM CEK',
						'labelWidth'=>150, 
						'value'=>"", 
						 ),
			'sasdpek' => array( 
						'label'=>'RINCIAN PEKERJAAN',
						'labelWidth'=>150, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'itemCheck' id = 'itemCheck' style='width:475px;height:50px;' >$item_cek</textarea>
						</div>", 
						'type' => 'merge'
						 ),	
			'ket' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"", 
						 ),	
			'keasdast' => array( 
						'label'=>'KETERANGAN',
						'labelWidth'=>100, 
						'value'=>"<div style='float:left;'>
						<textarea name = 'ket' id = 'ket' style='width:475px; height:50px;'>$keterangan</textarea>

						</div>", 
						'type' => 'merge'
						 ),					 			
				
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' value='Simpan' onclick ='".$this->Prefix.".Editrincian_pekerjaan($idTemp)' title='Simpan' >"."&nbsp&nbsp".
			"<input type='button' value='Batal' onclick ='".$this->Prefix.".Close2()' >";
							
		$form = $this->genFormKB();		
		$content = $form;
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}	

}
$cek_aplikasi_pemda = new cek_aplikasi_pemdaObj();
$cek_aplikasi_pemda->username = $_COOKIE['coID'];
?>