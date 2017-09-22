

var po = new DaftarObj2({
	prefix : 'po',
	url : 'pages.php?Pg=po', 
	//formName : 'po_form',
	formName : 'poForm',
	//po_form
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
				data:$('#po_form').serialize(),
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
			err = "Pilih po";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#po_form').serialize(),
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
			err = "Pilih po";
		}else if($("#cmbModul").val() == ''){
			err = "Pilih Modul";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#po_form').serialize(),
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
	
	poBaru: function(){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#po_form').serialize(),
			  	url: this.url+'&tipe=formBarupo',
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
				data:$('#po_form').serialize()+"&idModul="+$("#cmbModul").val(),
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
				data:$('#po_form').serialize()+"&idModul="+$("#cmbModul").val()+"&idSubModul="+$("#cmbSubModul").val(),
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

    
	
poEdit: function(){	
		
		var me = this;
		var err='';
		if($("#cmbAplikasi").val() == ''){
			err = "Pilih po";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#po_form').serialize()+"&idpo="+$("#cmbAplikasi").val(),
			  	url: this.url+'&tipe=formBarupo',
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
				data:$('#poForm').serialize(),
				url: this.url+'&tipe=formEditPO',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$("#jenis").val('1');
						$('#tanggalPO').datepicker({
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
					$("#tanggalPO").datepicker({ dateFormat: "dd-mm-yy" });
						$('#target_selesai').datepicker({
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
					$("#target_selesai").datepicker({ dateFormat: "dd-mm-yy" });
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
				data:$('#poForm').serialize(),
				url: this.url+'&tipe=formOrder',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$('#tanggalPO').datepicker({
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
					$("#tanggalPO").datepicker({ dateFormat: "dd-mm-yy" });
						$('#target_selesai').datepicker({
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
					$("#target_selesai").datepicker({ dateFormat: "dd-mm-yy" });
					me.GenerateNomorPO();
					document.getElementById('rincianPekerjaan').innerHTML = 
					"<div id='rincianPekerjaan_cont_title' style='position:relative'>  </div>"+
					"<div id='rincianPekerjaan_cont_opsi' style='position:relative'>"+
					"</div>"+
					"<div id='rincianPekerjaan_cont_daftar' style='position:relative'></div>"+
					"<div id='rincianPekerjaan_cont_hal' style='position:relative'></div>"
					
					;
					rincianPekerjaan.loading();
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
				data:$('#poForm').serialize(),
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
	
	kategoriChanged:function(){
				$.ajax({
					type:'POST', 
					data:{	
							kategori : $("#cmbKategori").val(),
							idPemda :  $("#cmbPemda").val()	
					},
					url: this.url+'&tipe=kategoriChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){							

							 if($("#cmbKategori").val() == '5'){
							 	$("#tergantung").text('TANGGAL SEMINAR');
							 }else{
							 	$("#tergantung").text('TARGET SELESAI');
							 }					
						}else{
							
						}							
						
				  	}
				});
	},
	
	pemdaChanged:function(){
				/*$.ajax({
					type:'POST', 
					data:{	
							idPemda :  $("#cmbPemda").val()	
					},
					url: this.url+'&tipe=pemdaChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){							
							 document.getElementById('cmbAplikasi').innerHTML = resp.content.cmbAplikasi;

									
						}else{
							
						}							
						
				  	}
				});*/
	},
	nilaiChanged:function(){
		var angka =  this.formatCurrency($("#nilai").val());
		$("#bantuNilai").text("Rp. "+angka);
	},
	formatCurrency:function(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	},
	aplikasiChanged:function(){
		/*$.ajax({
					type:'POST', 
					data:{
							idAplikasi : $("#cmbAplikasi").val(),
							idPemda : $("#cmbPemda").val(),
					},
					url: this.url+'&tipe=aplikasiChanged',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');				
						if(resp.err==''){							
							 $("#kontak_teknis").val(resp.content.kontak);	
							 $("#telepon_teknis").val(resp.content.telepon);	
						}else{
							alert(resp.err);
						}							
						
				  	}
				});	*/
		
	},
	
	modulChanged2:function(){
		

				$.ajax({
					type:'POST', 
					data:{
							idpo : $("#cmbAplikasi").val(),
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
	
	
	
	Simpanpo: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpanpo',
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
	
	Editpo: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id,
			url: this.url+'&tipe=editpo',
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
			data:$('#po_form').serialize(),
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
			data:{ 
					id_po : $("#id_po").val(),
					nomor_po : $("#nomor_po").val(),
					tanggalPO : $("#tanggalPO").val(),
					idPemda : $("#cmbPemda").val(),
					idAplikasi : $("#cmbAplikasi").val(),
					idKategori : $("#cmbKategori").val(),
					namaKegiatan : $("#kegiatan").val(),
					nilai : $("#nilai").val(),
					targetSelesai : $("#target_selesai").val(),
					kontakTeknis : $("#kontak_teknis").val(),
					teleponTeknis : $("#telepon_teknis").val(),
					keterangan : $("#keterangan").val(),
					
					},
			url: this.url+'&tipe=saveOrder',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
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
	SaveEditOrder: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:{ 
					id_po : $("#id_po").val(),
					nomor_po : $("#nomor_po").val(),
					tanggalPO : $("#tanggalPO").val(),
					idPemda : $("#cmbPemda").val(),
					idAplikasi : $("#cmbAplikasi").val(),
					idKategori : $("#cmbKategori").val(),
					namaKegiatan : $("#kegiatan").val(),
					nilai : $("#nilai").val(),
					targetSelesai : $("#target_selesai").val(),
					kontakTeknis : $("#kontak_teknis").val(),
					teleponTeknis : $("#telepon_teknis").val(),
					keterangan : $("#keterangan").val(),
					
					},
			url: this.url+'&tipe=saveEditOrder',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
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
				data:$('#po_form').serialize(),
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
				data:$('#po_form').serialize()+"&idCek="+id,
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
				data:$('#po_form').serialize()+"&idCek="+id,
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
	newrincian_pekerjaan: function(){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:{
						cmbKategori : $("#cmbKategori").val(),
						id_po : $("#id_po").val(),
						cmbAplikasi : $("#cmbAplikasi").val(),		
					 },
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
						cmbKategori : $("#cmbKategori").val(),
						id_po : $("#id_po").val(),
						cmbAplikasi : $("#cmbAplikasi").val(),
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
	
	PemdaBaru: function(){	
		
		var me = this;
		var err='';

		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#'+this.prefix+'_form').serialize(),
			  	url: this.url+'&tipe=formBaruPemda',
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
					id_po : $("#id_po").val(),
					id_aplikasi : $("#cmbAplikasi").val(),
					id_modul : $("#cmbModul").val(),
					rincian_pekerjaan : $("#rincian_pekerjaan").val(),
					keterangan : $("#ket").val(),
					
					},
			url: this.url+'&tipe=Saverincian_pekerjaan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
				//	$("#cmbPemda").attr('disabled',true);
					$("#NP").attr('disabled',true);
					$("#EP").attr('disabled',true);
					$("#cmbAplikasi").attr('disabled',true);
					me.reloadTabel();
					me.Close2();
					
				}else{
					alert(resp.err);
				}
		  	}
		});
		
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
					rincian_pekerjaan : $("#rincian_pekerjaan").val(),
					id_modul : $("#cmbModul").val(),
					keterangan : $("#ket").val(),
					
					},
			url: this.url+'&tipe=Editrincian_pekerjaan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
				//	$("#cmbPemda").attr('disabled',true);
					$("#NP").attr('disabled',true);
					$("#EP").attr('disabled',true);
					$("#cmbAplikasi").attr('disabled',true);
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
			data:{
					id_po : $("#id_po").val(),
					id_modul : $("#cmbModul").val(),
					id_aplikasi : $("#cmbAplikasi").val(),
					rincian_pekerjaan : $("#rincian_pekerjaan").val(),
					keterangan : $("#ket").val(),
					
					},
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
	SimpanPemda: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpanPemda',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbPemda').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},	
	EditPemda: function(id){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id,
			url: this.url+'&tipe=editPemda',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					document.getElementById('cmbPemda').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
		
	},
	PemdaEdit: function(){	
		
		var me = this;
		var err='';
		if($("#cmbPemda").val() == ''){
			err = "Pilih Pemda";
		}
		
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#linker_form').serialize()+"&idPemda="+$("#cmbPemda").val(),
			  	url: this.url+'&tipe=formBaruPemda',
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
	
	GenerateNomorPO: function(id){	
			var me= this;
			$.ajax({
				type:'POST', 
			  	url: this.url+'&tipe=GenerateNomorPO',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					$("#nomor_po").val(resp.content.nomorPO);
			  	}
			});

		
	},
	
	infoSpesifikasi:function(){
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
				url: this.url+'&tipe=infoSpesifikasi',
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
	
	Laporan:function(){
			
			var url2 = this.url;
			/*$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
			  	url: this.url+'&tipe=Report',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');
					if(resp.err == ''){*/
					window.open(url2+'&tipe=Laporan','_blank');
						
			/*		}else{
						alert(resp.err);
					}			
			
			  	}
			});*/
		
		
	},
	
	cetakDetail:function(id){
			
			var url2 = this.url;
			/*$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
			  	url: this.url+'&tipe=postCetak',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');
					if(resp.err == ''){*/
						window.open(url2+'&tipe=cetakDetail&id='+id,'_blank');
						
			/*		}else{
						alert(resp.err);
					}			
			
			  	}
			});*/
		
		
	},
});
