

var cek_aplikasi = new DaftarObj2({
	prefix : 'cek_aplikasi',
	url : 'pages.php?Pg=cek_aplikasi', 
	//formName : 'cek_aplikasi_form',
	formName : 'cek_aplikasiForm',
	//cek_aplikasi_form
	loading: function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		//this.sumHalRender();
	
	},
	
	find: function(){
		var me = this;
		me.refreshList(true);	
	},
	detail: function(){
		//alert('detail');
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();			
			//UserAktivitasDet.genDetail();			
			
		}else{
			alert(errmsg);
		}
		
	},

	Baru: function(){	
		
		var me = this;
		var err='';
		if($("#cmbAplikasi").val() == ''){
			err = "Pilih Aplikasi";
		}/*else if($("#cmbModul").val() == ''){
			err = "Pilih Modul";
		}*/
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:{
						cmbAplikasi : $("#cmbAplikasi").val(),
					    id_modul : $("#cmbModul").val(),
					    id_kategori : $("#kategoriFilter").val(),
					  },
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;
					me.AfterFormBaru();
					$('#tanggal_update').datepicker({
						    dateFormat: 'dd-mm-yy',
							showAnim: 'slideDown',
						    inline: true,
							showOn: "button",
     						buttonImage: "images/calendar.gif",
      						buttonImageOnly: true,
							changeMonth: true,
      						changeYear: true,
							buttonText : '',
							defaultDate: +0
					});	
					$("#tanggal_update").datepicker({ dateFormat: "dd-mm-yy" });
			  	}
			});
		
		}else{
		 	alert(err);
		}
	},
	
	
	
	ModulBaru: function(){	
		
		var me = this;
		var err='';
		if($("#cmbPemda").val() == ''){
			err = "Pilih Pemda";
		}else if($("#cmbcek_aplikasi").val() == ''){
			err = "Pilih cek_aplikasi";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasi_form').serialize(),
			  	url: this.url+'&tipe=formBaruModul',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},
	
	SubModulBaru: function(){	
		
		var me = this;
		var err='';
		/*if($("#cmbPemda").val() == ''){
			err = "Pilih Pemda";
		}else if($("#cmbcek_aplikasi").val() == ''){
			err = "Pilih cek_aplikasi";
		}else if($("#cmbModul").val() == ''){
			err = "Pilih Modul";
		}*/
		if($("#cmbModulForm").val() == ''){
			err = "Pilih Modul";
		}
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
			  	url: this.url+'&tipe=formBaruSubModul',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},
	
	cek_aplikasiBaru: function(){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasi_form').serialize(),
			  	url: this.url+'&tipe=formBarucek_aplikasi',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},

ModulEdit: function(){	
		
		var me = this;
		var err='';
		if($("#cmbModul").val() == ''){
			err = "Pilih Modul";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasi_form').serialize()+"&idModul="+$("#cmbModul").val(),
			  	url: this.url+'&tipe=formBaruModul',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},

SubModulEdit: function(){	
		
		var me = this;
		var err='';
		if($("#cmbSubModul").val() == ''){
			err = "Pilih Sub Modul";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasi_form').serialize(),
			  	url: this.url+'&tipe=formBaruSubModul',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},

    
	
cek_aplikasiEdit: function(){	
		
		var me = this;
		var err='';
		if($("#cmbcek_aplikasi").val() == ''){
			err = "Pilih cek_aplikasi";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasi_form').serialize()+"&idcek_aplikasi="+$("#cmbcek_aplikasi").val(),
			  	url: this.url+'&tipe=formBarucek_aplikasi',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},
    	
	
	Edit:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if($("#cmbAplikasi").val() == ""){
			errmsg = "Pilih Aplikasi";
		} 
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasiForm').serialize(),
				url: this.url+'&tipe=formEdit',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						me.reloadTabel();
						
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
	
	
	Progres:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasiForm').serialize(),
				url: this.url+'&tipe=formProgres',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
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
	
	
	Check:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasiForm').serialize(),
				url: this.url+'&tipe=formCheck',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
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
	Hapus:function(){
		
		var me =this;
		if(document.getElementById(this.prefix+'_jmlcek')){
			var jmlcek = document.getElementById(this.prefix+'_jmlcek').value ;	
		}else{
			var jmlcek = '';
		}
		
		if(jmlcek ==0){
			alert('Data Belum Dipilih!');
		}else{
			if(confirm('Hapus '+jmlcek+' Data ?')){
				//document.body.style.overflow='hidden'; 
				var cover = this.prefix+'_hapuscover';
				addCoverPage2(cover,1,true,false);
				$.ajax({
					type:'POST', 
					data:$('#'+this.formName).serialize(),
					url: this.url+'&tipe=hapus',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');		
						delElem(cover);		
						if(resp.err==''){							
							me.Close();
							me.refreshList(true)
						}else{
							alert(resp.err);
						}							
						
				  	}
				});
				
			}	
		}
	},
	
	
	
	pemdaChanged:function(){
		

				$.ajax({
					type:'POST', 
					data:{
							idPemda : $("#cmbPemda").val()	
					},
					url: this.url+'&tipe=pemdaChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){							
							 document.getElementById('cmbcek_aplikasi').innerHTML = resp.content.cmbcek_aplikasi;			
							 document.getElementById('cmbModul').innerHTML = resp.content.cmbModul;	
							 document.getElementById('cmbSubModul').innerHTML = resp.content.cmbSubModul;			
						}else{
							alert(resp.err);
						}							
						
				  	}
				});
				
		
	},
	
	
	cek_aplikasiChanged:function(){
		

				$.ajax({
					type:'POST', 
					data:{
							idcek_aplikasi : $("#cmbcek_aplikasi").val(),
							cmbcek_aplikasi : $("#cmbcek_aplikasi").val()	
					},
					url: this.url+'&tipe=cek_aplikasiChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){							
							 document.getElementById('cmbModul').innerHTML = resp.content.cmbModul;			
							 document.getElementById('cmbSubModul').innerHTML = resp.content.cmbSubModul;			
						}else{
							alert(resp.err);
						}							
						
				  	}
				});
				
		
	},
	
	modulChanged:function(){
		

				$.ajax({
					type:'POST', 
					data:{
							id_aplikasi : $("#cmbAplikasi").val(),
							id_modul : $("#cmbModulForm").val(),
					},
					url: this.url+'&tipe=modulChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){								
							 document.getElementById('cmbKategori').innerHTML = resp.content.cmbKategori;			
						}else{
							alert(resp.err);
						}							
						
				  	}
				});
				
		
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
	
	
	
	SimpanModul: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+"&cmbcek_aplikasi="+$("#cmbcek_aplikasi").val(),
			url: this.url+'&tipe=simpanModul',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				if(resp.err==''){
					document.getElementById('cmbModul').innerHTML = resp.content.replacer;
					document.getElementById('cmbSubModul').innerHTML = resp.content.cmbSubModul;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	
	SimpanSubModul: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+"&id_aplikasi="+$("#cmbAplikasi").val()+"&id_modul="+$("#cmbModulForm").val(),
			url: this.url+'&tipe=simpanSubModul',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				if(resp.err==''){
					document.getElementById('cmbKategori').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	
	
	Simpancek_aplikasi: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpancek_aplikasi',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbcek_aplikasi').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	EditModul: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id+"&cmbcek_aplikasi="+$("#cmbcek_aplikasi").val(),
			url: this.url+'&tipe=editModul',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbModul').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	
	EditSubModul: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+"&id_aplikasi="+$("#cmbAplikasi").val()+"&id_modul="+$("#cmbModulForm").val()+'&id='+id,
			url: this.url+'&tipe=editSubModul',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbKategori').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	Editcek_aplikasi: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id,
			url: this.url+'&tipe=editcek_aplikasi',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbcek_aplikasi').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	
	SimpanEdit: function(){
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
			data:$('#cek_aplikasi_form').serialize(),
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
	},
	
	Simpan: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&hubla='+id+"&id_aplikasi="+$("#cmbAplikasi").val(),
			url: this.url+'&tipe=simpan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					me.Close();
					me.AfterSimpan();
					me.refreshList(true);
				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	
	SaveProgres: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&hubla='+id,
			url: this.url+'&tipe=saveProgres',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					me.Close();
					me.AfterSimpan();
				}else{
					alert(resp.err);
				}
		  	}
		});
	}
	
	,
	
	SaveCheck: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&hubla='+id,
			url: this.url+'&tipe=saveCheck',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					me.Close();
					me.AfterSimpan();
				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	newrincian_pekerjaan: function(){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#'+this.prefix+'_form').serialize()+'&cmbAplikasi='+$("#cmbAplikasi").val(),
			  	url: this.url+'&tipe=newrincian_pekerjaan',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},
	
	Saverincian_pekerjaan: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:{
					itemCheck : $("#itemCheck").val(),
				  	ket : $("#ket").val()
				  },
			url: this.url+'&tipe=Saverincian_pekerjaan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					
					me.reloadTabel();
					me.Close2();
					
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	reloadTabel: function(){
		var me= this;
		var err='';
		
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&cmbAplikasi='+$("#cmbAplikasi").val(),
			url: this.url+'&tipe=getTabel',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				if(resp.err==''){
					document.getElementById("tabelRincianPekerjaan").innerHTML = resp.content.tabel;
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	hapusRincian: function(id){	
			var me= this;
			$.ajax({
				type:'POST', 
				data:{
						id : id	
					  },
			  	url: this.url+'&tipe=hapusRincian',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if(resp.err == ''){
						me.reloadTabel();	
					}else{
						alert(resp.err);
					}		
					
			  	}
			});

		
	},	
	editRincian: function(id){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:{
						idTemp : id	
					 },
			  	url: this.url+'&tipe=editrincian_pekerjaan',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},
	Editrincian_pekerjaan: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:{
					id : id,
					itemCheck : $("#itemCheck").val(),
				  	ket : $("#ket").val()
					
					},
			url: this.url+'&tipe=Editrincian_pekerjaan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){

					me.reloadTabel();
					me.Close2();
					
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},	
	
	CekOK: function(id){	
			var me= this;
			$.ajax({
				type:'POST', 
				data:{
						id : id	
					  },
			  	url: this.url+'&tipe=cekOK',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if(resp.err == ''){
						me.refreshList(true);	
					}else{
						alert(resp.err);
					}		
					
			  	}
			});

		
	},
	
	CekNo: function(id){	
			var me= this;
			$.ajax({
				type:'POST', 
				data:{
						id : id	
					  },
			  	url: this.url+'&tipe=cekNo',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if(resp.err == ''){
						me.refreshList(true);	
					}else{
						alert(resp.err);
					}		
					
			  	}
			});

		
	},
	
	showHistori: function(id){	
		
		var me = this;

		var err = "";
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:{	id : id
					  },
			  	url: this.url+'&tipe=showHistori',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;

					
			  	}
			});
		
		}else{
		 	alert(err);
		}
	},
	
	
	formCheck:function(id){
		var me = this;
	
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#cek_aplikasiForm').serialize()+"&idCheck="+id,
				url: this.url+'&tipe=formCheck',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}
			  	}
			});

		
	},
		
});
