var refprogram = new DaftarObj2({
	prefix : 'refprogram',
	url : 'pages.php?Pg=refprogram', 
	formName : 'refprogramForm',
	el_kode_program : '',
	el_nama_program: '',
	el_kode_kegiatan : '',
	el_nama_kegiatan : '',
	el_bk :'',
	el_ck :'',
	el_dk :'',
	el_p :'',
	el_q :'',
	
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
	
	Baru:function(){
		var me = this;
		var err='';
		var urusan = document.getElementById('fmURUSAN').value; 
		var bidang = document.getElementById('fmBIDANG').value;
		//var dinas = document.getElementById('fmDINAS').value;
		
		if(err=='' && (urusan=='' || urusan=='0') ) err='Urusan belum dipilih!';
		if(err=='' && (bidang=='' || bidang=='0') ) err='Bidang belum dipilih!';
		//if(err=='' && (dinas=='' || dinas=='0') ) err='Dinas belum dipilih!';
		
		var cover = this.prefix+'_formcover';
		if(err==''){
			document.body.style.overflow='hidden';
			addCoverPage2(cover,999,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
						document.getElementById(cover).innerHTML = resp.content;			
						me.AfterFormBaru(resp);	
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}			
					
			  	}
			});
		}else{
			alert(err);
		}
	},
	
	windowShow2: function(el_bk,el_ck,el_dk,el_p,el_q,
		el_kode_program, el_nama_program, el_kode_kegiatan,el_nama_kegiatan){
		this.el_bk = el_bk;
		this.el_ck = el_ck;
		this.el_dk = el_dk;
		this.el_p = el_p;
		this.el_q = el_q;
		this.el_kode_program = el_kode_program;
		this.el_nama_program = el_nama_program;
		this.el_kode_kegiatan = el_kode_kegiatan;
		this.el_nama_kegiatan = el_nama_kegiatan;
		
		this.windowShow();
	},
	windowShow: function(){
		var me = this;
		var cover = this.prefix+'_cover';
		document.body.style.overflow='hidden';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.formName).serialize(),
			url: this.url+'&tipe=windowshow',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				if(resp.err==''){
					document.getElementById(cover).innerHTML = resp.content;	
					me.loading();					
				}else{
					alert(resp.err);
					delElem(cover);
					document.body.style.overflow='auto';
				}
		  	}
		});
	},
		
	windowClose: function(){
		document.body.style.overflow='auto';
		delElem(this.prefix+'_cover');
	},
	
	windowSave: function(){
		var me= this;
		//alert('save');
		var errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			//alert(box.value);
			this.idpilih = box.value;
			
			
			var cover = 'refprogram_getdata';
			addCoverPage2(cover,1,true,false);				
			$.ajax({
				url: 'pages.php?Pg=refprogram&tipe=getdata&id='+this.idpilih,
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					delElem(cover);
					if(resp.err==''){
						if(document.getElementById(me.el_kode_program)) document.getElementById(me.el_kode_program).value= resp.content.kode_program;
						if(document.getElementById(me.el_nama_program)) document.getElementById(me.el_nama_program).value= resp.content.nama_program;
						if(document.getElementById(me.el_kode_kegiatan)) document.getElementById(me.el_kode_kegiatan).value= resp.content.kode_kegiatan;
						if(document.getElementById(me.el_nama_kegiatan)) document.getElementById(me.el_nama_kegiatan).value= resp.content.nama_kegiatan;
						
						if(document.getElementById(me.el_bk)) document.getElementById(me.el_bk).value= resp.content.bk;
						if(document.getElementById(me.el_ck)) document.getElementById(me.el_ck).value= resp.content.ck;
						if(document.getElementById(me.el_dk)) document.getElementById(me.el_dk).value= resp.content.dk;
						if(document.getElementById(me.el_p)) document.getElementById(me.el_p).value= resp.content.p;
						if(document.getElementById(me.el_q)) document.getElementById(me.el_q).value= resp.content.q;
						
						
						me.windowClose();
						me.windowSaveAfter();
					}else{
						alert(resp.err)	
					}
			  	}
			});
			
			
			
			
		}else{
			alert(errmsg);
		}
	},
	windowSaveAfter: function(){
		//alert('tes');
	},	
	
		
	AfterSimpan : function(){
		if(document.getElementById('Kunjungan_cont_daftar')){
		this.refreshList(true);}
	},
	
	Simpan: function(){
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
			data:$('#'+this.prefix+'_form').serialize(),
			url: this.url+'&tipe=simpan',
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
	}
});
