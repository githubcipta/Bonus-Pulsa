var ref_barang_lama = new DaftarObj2({
	prefix : 'ref_barang_lama',
	url : 'pages.php?Pg=ref_barang_lama', 
	formName : 'ref_barang_lamaForm',
	
	loading:function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();
	},
	
	daftarRender:function(){
		var me =this; //render daftar 
		addCoverPage2(
			'daftar_cover',	1, 	true, true,	{renderTo: this.prefix+'_cont_daftar',
			imgsrc: 'images/wait.gif',
			style: {position:'absolute', top:'5', left:'5'}
			}
		);
		$.ajax({
		  	url: this.url+'&tipe=daftar',
		 	type:'POST', 
			data:$('#'+this.formName).serialize(), 
		  	success: function(data) {		
				var resp = eval('(' + data + ')');
				document.getElementById(me.prefix+'_cont_daftar').innerHTML = resp.content;
				me.sumHalRender();
		  	}
		});
	},
	
	pilihBidang : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_barang_lama&tipe=pilihBidang',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_kelompok').innerHTML = resp.content.unit;
			ref_barang_lama.daftarRender();
		  }
		});
		
	},
	
	
	daftarRender:function(){
		var me =this; //render daftar 
		addCoverPage2(
			'daftar_cover',	1, 	true, true,	{renderTo: this.prefix+'_cont_daftar',
			imgsrc: 'images/wait.gif',
			style: {position:'absolute', top:'5', left:'5'}
			}
		);
		$.ajax({
		  	url: this.url+'&tipe=daftar',
		 	type:'POST', 
			data:$('#'+this.formName).serialize(), 
		  	success: function(data) {		
				var resp = eval('(' + data + ')');
				document.getElementById(me.prefix+'_cont_daftar').innerHTML = resp.content;
				me.sumHalRender();
		  	}
		});
	},
	
	/*pilihKelompok : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=barang&tipe=pilihKelompok',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_object').innerHTML = resp.content.unit;
			barang.daftarRender();
		  }
		});
		
	},
	
	
	
	pilihObjek : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=barang&tipe=pilihObjek',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_jenis').innerHTML = resp.content.jenis;
			barang.daftarRender();
		  }
		});
	},
	
	
	
	pilihJenis : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=barang&tipe=pilihJenis',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_NmBrg').innerHTML = resp.content.unit;
			barang.daftarRender();
		  }
		});
	},
	
	pilihNmBrg: function(){
	var me = this; 
		barang.daftarRender();
	},
	*/
	
	
	/*pilihbidang : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_barang_lama&tipe=pilihbidang',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_kelompok').innerHTML = resp.content.unit;
			ref_barang_lama.daftarRender();
		  }
		});
		
	},*/
	
	Close1:function(){//alert(this.elCover);
		var cover = this.prefix+'_formcoverKA';
		if(document.getElementById(cover)) delElem(cover);			
		if(tipe==null){
			document.body.style.overflow='auto';						
		}
	},
	
	Close2:function(){//alert(this.elCover);
		var cover = this.prefix+'_formcoverKB';
		if(document.getElementById(cover)) delElem(cover);			
		if(tipe==null){
			document.body.style.overflow='auto';						
		}
	},
	
	Close3:function(){//alert(this.elCover);
		var cover = this.prefix+'_formcoverKC';
		if(document.getElementById(cover)) delElem(cover);			
		if(tipe==null){
			document.body.style.overflow='auto';						
		}
	},
	
	Close4:function(){//alert(this.elCover);
		var cover = this.prefix+'_formcoverKD';
		if(document.getElementById(cover)) delElem(cover);			
		if(tipe==null){
			document.body.style.overflow='auto';						
		}
	},
	
	Close5:function(){//alert(this.elCover);
		var cover = this.prefix+'_formcoverKE';
		if(document.getElementById(cover)) delElem(cover);			
		if(tipe==null){
			document.body.style.overflow='auto';						
		}
	},
	
	/*SimpanEdit: function(){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		/*this.sendReq(
			this.url,
			{ idprs: 0, daftarProses: new Array('simpan')},
		///	this.formDialog);
		$.ajax({
			type:'POST', 
			data:$('#ref_barang_lama_form').serialize(),
			url: this.url+'&tipe=simpanEdit',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					alert('Data berhasil disimpan');
					me.Close();
					me.refreshList(true);
					me.AfterSimpan();	
				}
				else{
					alert(resp.err);
				}
		  	}
		});
	},*/
	SimpanEdit2: function(){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		/*this.sendReq(
			this.url,
			{ idprs: 0, daftarProses: new Array('simpan')},
			this.formDialog);*/
		$.ajax({
			type:'POST', 
			data:$('#ref_barang_lama_form').serialize(),
			url: this.url+'&tipe=simpanEdit2',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					alert('Data berhasil disimpan');
					me.Close();
					me.refreshList(true);
					me.AfterSimpan();	
				}
				else{
					alert(resp.err);
				}
		  	}
		});
	},
	SimpanEdit3: function(){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		/*this.sendReq(
			this.url,
			{ idprs: 0, daftarProses: new Array('simpan')},
			this.formDialog);*/
		$.ajax({
			type:'POST', 
			data:$('#ref_barang_lama_form').serialize(),
			url: this.url+'&tipe=simpanEdit3',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					alert('Data berhasil disimpan');
					me.Close();
					me.refreshList(true);
					me.AfterSimpan();	
				}
				else{
					alert(resp.err);
				}
		  	}
		});
	},
	
	SimpanEdit4: function(){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		/*this.sendReq(
			this.url,
			{ idprs: 0, daftarProses: new Array('simpan')},
			this.formDialog);*/
		$.ajax({
			type:'POST', 
			data:$('#ref_barang_lama_form').serialize(),
			url: this.url+'&tipe=simpanEdit4',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					alert('Data berhasil disimpan');
					me.Close();
					me.refreshList(true);
					me.AfterSimpan();	
				}
				else{
					alert(resp.err);
				}
		  	}
		});
	},
	
		
	
	
	
				
	
	
	
	Baru: function(){	
		
		var me = this;
		var err='';
		
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;
					document.getElementById('kode1').focus();			
					me.AfterFormBaru();
			  	}
			});
		
		}else{
		 	alert(err);
		}
	},
	
	Edit:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,999,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=formEdit',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						document.getElementById('kode1').focus();	
						me.AfterFormEdit(resp);
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}
			  	}
			});
		}else{
			alert(errmsg);
		}
		
	},	
	
	UrusanAfter: function(){
		var me = this;
		
		//this.formName = 'adminForm';
		$.ajax({
		  url: this.url+'&tipe=UrusanAfter',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {
			var resp = eval('(' + data + ')');	//console.info(me);	//console.info('id='+me.prefix+'CbxBagian');
				
				//me.refreshList(true);
				document.getElementById('fmSKPDBidang2').innerHTML=resp.content;
				me.BidangAfter2();
				
		  }
		});
	},
	BidangAfter2: function(){
		var me = this;
		
		//this.formName = 'adminForm';
		$.ajax({
		  url: this.url+'&tipe=BidangAfter2',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {
			var resp = eval('(' + data + ')');	//console.info(me);	//console.info('id='+me.prefix+'CbxBagian');
				
				//.refreshList(true);
				document.getElementById('fmSKPDskpd2').innerHTML=resp.content;
				me.SKPDAfter2();
				
		  }
		});
	},
	SKPDAfter2: function(){
		var me = this;
		
		//this.formName = 'adminForm';
		$.ajax({
		  url: this.url+'&tipe=SKPDAfter2',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {
			var resp = eval('(' + data + ')');	//console.info(me);	//console.info('id='+me.prefix+'CbxBagian');
				
				//me.refreshList(true);
				document.getElementById('fmSKPDUnit2').innerHTML=resp.content;
				me.UnitAfter2();
				
		  }
		});
	},
	UnitAfter2: function(){
		var me = this;
		
		//this.formName = 'adminForm';
		$.ajax({
		  url: this.url+'&tipe=UnitAfter2',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {
			var resp = eval('(' + data + ')');	//console.info(me);	//console.info('id='+me.prefix+'CbxBagian');
				
				//me.refreshList(true);
				document.getElementById('fmSKPDSubUnit2').innerHTML=resp.content;
				
		  }
		});
	},
	
	sotkbaru: function(){
	var me =this;
		if(document.getElementById(this.prefix+'_jmlcek')){
			var jmlcek = document.getElementById(this.prefix+'_jmlcek').value ;	
		}else{
			var jmlcek = '';
		}
		
		if(jmlcek ==0){
			alert('Data Belum Dipilih!');
		}else{
			if(confirm('Mutasi '+jmlcek+' Data ?')){
				//errmsg = this.CekCheckbox();
				errmsg = '';
	
				c = document.getElementById('SOTKBaruSkpdfmSKPD');
				d = document.getElementById('SOTKBaruSkpdfmUNIT');
				e = document.getElementById('SOTKBaruSkpdfmSUBUNIT');
				e1 = document.getElementById('SOTKBaruSkpdfmSEKSI');
				
				if(errmsg == '' && c.value == '00')errmsg = "BIDANG SOTK LAMA Belum Diisi ! ";
				if(errmsg == '' && d.value == '00')errmsg = "SKPD SOTK LAMA Belum Diisi ! ";
				if(errmsg == '' && e.value == '00')errmsg = "UNIT SOTK LAMA Belum Diisi ! ";
				if(errmsg == '' && e1.value == '00')errmsg = "SUB SOTK LAMA UNIT Belum Diisi ! ";

				
				if(errmsg ==''){ 
					//var box = this.GetCbxChecked();
					
					//alert(box.value);
							
					var aForm = document.getElementById(this.formName);		
					aForm.action= this.url+'_ins&baru=1';//'?Op='+op+'&Pg=2&idprs=cetak_hal';		
					aForm.target='_blank';
					aForm.submit();	
					aForm.target='';
				}else{
						alert(errmsg);
				}	
			}
		}
		
	},
	
	
	
	
	
	
	
		
	
	
});
