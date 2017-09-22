

var cekAplikasi = new DaftarObj2({
	prefix : 'cekAplikasi',
	url : 'pages.php?Pg=cekAplikasi', 
	//formName : 'cekAplikasi_form',
	formName : 'cekAplikasiForm',
	//cekAplikasi_form
	loading: function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();
	
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
		
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize(),
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;
					//document.getElementById('kode1').focus();			
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
		}else if($("#cmbAplikasi").val() == ''){
			err = "Pilih cekAplikasi";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize(),
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
		if($("#cmbPemda").val() == ''){
			err = "Pilih Pemda";
		}else if($("#cmbAplikasi").val() == ''){
			err = "Pilih cekAplikasi";
		}else if($("#cmbModul").val() == ''){
			err = "Pilih Modul";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize(),
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
	
	cekAplikasiBaru: function(){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize(),
			  	url: this.url+'&tipe=formBarucekAplikasi',
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
				data:$('#cekAplikasi_form').serialize()+"&idModul="+$("#cmbModul").val(),
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
				data:$('#cekAplikasi_form').serialize()+"&idModul="+$("#cmbModul").val()+"&idSubModul="+$("#cmbSubModul").val(),
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

    
	
cekAplikasiEdit: function(){	
		
		var me = this;
		var err='';
		if($("#cmbAplikasi").val() == ''){
			err = "Pilih cekAplikasi";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize()+"&idcekAplikasi="+$("#cmbAplikasi").val(),
			  	url: this.url+'&tipe=formBarucekAplikasi',
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
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasiForm').serialize()+"&hubla=",
				url: this.url+'&tipe=formOrder',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$("#jenis").val('1');
						$('#tanggal_order').datepicker({
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
					$("#tanggal_order").datepicker({ dateFormat: "dd-mm-yy" });
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
	
	
	Order:function(){
		var me = this;
		/*errmsg = this.CekCheckbox();
		if(errmsg ==''){ */
			/*var box = this.GetCbxChecked();*/
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasiForm').serialize(),
				url: this.url+'&tipe=formOrder',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$('#tanggal_order').datepicker({
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
					$("#tanggal_order").datepicker({ dateFormat: "dd-mm-yy" });
						
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}
			  	}
			});
		/*}else{
			alert(errmsg);
		}*/
		
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
				data:$('#cekAplikasiForm').serialize(),
				url: this.url+'&tipe=formCheck',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						document.getElementById('rincianCek').innerHTML = 
			"<div id='rincianCek_cont_title' style='position:relative'>  </div>"+
			"<div id='rincianCek_cont_opsi' style='position:relative'>"+
			"</div>"+
			"<div id='rincianCek_cont_daftar' style='position:relative'></div>"+
			"<div id='rincianCek_cont_hal' style='position:relative'></div>"
			
			;
					rincianCek.loading();
						
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
							 document.getElementById('cmbAplikasi').innerHTML = resp.content.cmbAplikasi;			
							 document.getElementById('cmbModul').innerHTML = resp.content.cmbModul;	
							 document.getElementById('cmbSubModul').innerHTML = resp.content.cmbSubModul;			
						}else{
							alert(resp.err);
						}							
						
				  	}
				});
				
		
	},
	
	
	AplikasiChanged:function(){
		

				$.ajax({
					type:'POST', 
					data:{
							idcekAplikasi : $("#cmbAplikasi").val(),
							cmbAplikasi : $("#cmbAplikasi").val()	
					},
					url: this.url+'&tipe=AplikasiChanged',
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
	
	modulChanged2:function(){
		

				$.ajax({
					type:'POST', 
					data:{
							idcekAplikasi : $("#cmbAplikasi").val(),
							cmbAplikasi : $("#cmbAplikasi").val(),
							cmbModul : $("#cmbModul").val()	
					},
					url: this.url+'&tipe=modulChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){								
							 document.getElementById('cmbSubModul').innerHTML = resp.content.cmbSubModul;			
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
			data:$('#'+this.prefix+'_KBform').serialize()+"&cmbAplikasi="+$("#cmbAplikasi").val(),
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
	
	
	SimpanItem: function(){
		var me= this;
		var err='';
		var plok = rincianCek;
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpanItem',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				if(resp.err==''){
					rincianCek.refreshList(true);
					me.Close2();
					
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	
	EditItem: function(id){
		var me= this;
		var err='';
		var plok = rincianCek;
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+"&id="+id,
			url: this.url+'&tipe=editItem',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				if(resp.err==''){
					rincianCek.refreshList(true);
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
			data:$('#'+this.prefix+'_KBform').serialize()+"&cmbAplikasi="+$("#cmbAplikasi").val()+"&cmbModul="+$("#cmbModul").val(),
			url: this.url+'&tipe=simpanSubModul',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				if(resp.err==''){
					document.getElementById('cmbSubModul').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	
	
	SimpancekAplikasi: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpancekAplikasi',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbAplikasi').innerHTML = resp.content.replacer;
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
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id+"&cmbAplikasi="+$("#cmbAplikasi").val(),
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
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id+"&cmbAplikasi="+$("#cmbAplikasi").val()+"&cmbModul="+$("#cmbModul").val(),
			url: this.url+'&tipe=editSubModul',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbSubModul').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	
	EditcekAplikasi: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id,
			url: this.url+'&tipe=editcekAplikasi',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbAplikasi').innerHTML = resp.content.replacer;
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
			data:$('#cekAplikasi_form').serialize(),
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
			data:$('#'+this.prefix+'_form').serialize()+'&hubla='+id,
			url: this.url+'&tipe=simpan',
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
	
	SaveOrder: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&hubla='+id,
			url: this.url+'&tipe=saveOrder',
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
	
	Tutup: function(){
		var me= this;	

					me.Close();
					me.AfterSimpan();
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
	
	addNew: function(){
		var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize(),
			  	url: this.url+'&tipe=formAddNew',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;	
					$('#tanggal_check').datepicker({
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
					$("#tanggal_check").datepicker({ dateFormat: "dd-mm-yy" });	
			  	}
			});
		
	},
	
	edit: function(id){
		/*var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize()+"&idCek="+id,
			  	url: this.url+'&tipe=formAddNew',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;
					$('#jenis').val(id);
					$('#tanggal_check').datepicker({
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
					$("#tanggal_check").datepicker({ dateFormat: "dd-mm-yy" });	
			  	}
			});*/
		
		
		$.ajax({
				type:'POST', 
				data:$('#cekAplikasi_form').serialize()+"&idCek="+id,
			  	url: this.url+'&tipe=changeRow',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					
					document.getElementById('spanItem'+id).innerHTML = resp.content.spanItem;
					document.getElementById('spanHasil'+id).innerHTML = resp.content.spanHasil;
					document.getElementById('spanTanggal'+id).innerHTML = resp.content.spanTanggal;
					document.getElementById('spanStatus'+id).innerHTML = resp.content.spanStatus;
					document.getElementById('spanAction'+id).innerHTML = resp.content.spanAction;
					
					
					$('#tanggal'+id).datepicker({
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
					$('#tanggal'+id).datepicker({ dateFormat: "dd-mm-yy" });	
			  	}
			});
		
		
		
	},
	
		
});
