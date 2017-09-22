var rencana_pengembangan = new DaftarObj2({
	prefix : 'rencana_pengembangan',
	url : 'pages.php?Pg=rencana_pengembangan', 
	formName : 'rencana_pengembanganForm',
	rencana_pengembangan_form : '0',
	loading: function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();
		
	   
	},
	filterRenderAfter : function(){
		var me = this;
		$("#filterTarget").MonthPicker({
											  MinMonth: 0,
											  MonthFormat: 'mm-yy',
											  Button: "<img class='icon' src='images/calendar.gif'/>",
											  OnAfterChooseMonth: function() { 
											  	me.refreshList(true);
										      } 
				});
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

	BidangAfter2: function(){
						rencana_pengembangan.refreshList(true);
	},
	BidangAfterform: function(){
		var me = this;
		
		//this.formName = 'adminForm';
		$.ajax({
		  url: this.url+'&tipe=BidangAfterForm',
		  type : 'POST',
		  data:{fmSKPDBidang: $("#cmbBidangForm").val(),
		  		 fmSKPDUrusan: $("#cmbUrusanForm").val() },
		  success: function(data) {
			var resp = eval('(' + data + ')');	//console.info(me);	//console.info('id='+me.prefix+'CbxBagian');
				document.getElementById('cmbBidangForm').innerHTML=resp.content.bidang;
				document.getElementById('cmbSKPDForm').innerHTML=resp.content.skpd;
				

				
				
		  }
		});

	},
	pilihBidang: function(){
				rencana_pengembangan.refreshList(true);

	},
	comboSKPDChanged: function(){
				rencana_pengembangan.refreshList(true);
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
	Baru: function(){	
		
		var me = this;
		var err='';
		if($("#cmbAplikasi").val() == ""){
			err = "Pilih Aplikasi";
		}
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			if(me.rencana_pengembangan_form==0){//baru dari rencana_pengembangan
				addCoverPage2(cover,1,true,false);	
			}else{//baru dari barang
				addCoverPage2(cover,1,true,false);	
			}
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;	
					me.AfterFormBaru();
					
					
					
			  	}
			});
		
		}else{
		 	alert(err);
		}
	},
	updateStatus:function(idEdit){
		var me = this;


					
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,999,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize()+"&id="+idEdit,
				url: this.url+'&tipe=updateStatus',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$("#target").MonthPicker({
											  MinMonth: 0,
											  MonthFormat: 'mm-yy',
											  Button: '<img class="icon" src="images/calendar.gif" />'
											  });
						$('#mulai').datepicker({
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
					$("#mulai").datepicker({ dateFormat: "dd-mm-yy" });	
					   if($("#cmbCheck").val() == 'SUDAH'){
						   	 $('#tanggalSelesai').datepicker({
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
							$("#tanggalSelesai").datepicker({ dateFormat: "dd-mm-yy" });
							$("#tanggalSelesai").datepicker("enable");
							$("#tanggalSelesai").attr("readonly",false);
					   }else{
					   		$("#tanggalSelesai").attr("readonly",true);
					   		$("#tanggalSelesai").datepicker("disable");
							$("#tanggalSelesai").val('');
					   }		
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}
			  	}
			});

		
	},
	checkedChanged:function(){
		 if($("#cmbCheck").val() == 'SUDAH'){
						   	 $('#tanggalSelesai').datepicker({
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
							$("#tanggalSelesai").datepicker({ dateFormat: "dd-mm-yy" });
							$("#tanggalSelesai").datepicker("enable");
							$("#tanggalSelesai").attr("readonly",false);
					   }else{
					   		$("#tanggalSelesai").attr("readonly",true);
					   		$("#tanggalSelesai").datepicker("disable");
							$("#tanggalSelesai").val('');
					   }	
	},
	
	resetCheck:function(){
		$("#tanggalSelesai").attr("readonly",true);
		$("#tanggalSelesai").datepicker("disable");
		$("#tanggalSelesai").val('');
		$("#cmbCheck").val("BELUM");
		$("#mulai").val("");
		$("#lama").val("");
		$("#target").val("");
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
	
	showKoreksirencana_pengembangan:function(id){
		var me = this;

			
		
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,999,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:{id:id},
				url: this.url+'&tipe=showKoreksirencana_pengembangan',
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

		
	},
	
	showKoreksiPemda:function(id){
		var me = this;

			
		
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,999,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:{id:id},
				url: this.url+'&tipe=showKoreksiPemda',
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

		
	},
		
	saveCheck: function(idEdit){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&id='+idEdit,
			url: this.url+'&tipe=saveCheck',
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
	editAplikasi: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+"&idAwal="+id,
			url: this.url+'&tipe=editAplikasi',
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
	saveAplikasi: function(){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+"&cmbAplikasi="+$("#cmbAplikasi").val(),
			url: this.url+'&tipe=saveAplikasi',
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
	},
	Edit: function(){	
		
	var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();		
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=formEdit',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$("#target").MonthPicker({
											  MinMonth: 0,
											  MonthFormat: 'mm-yy',
											  Button: '<img class="icon" src="images/calendar.gif" />'
						 });
					$('#mulai').datepicker({
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
					$("#mulai").datepicker({ dateFormat: "dd-mm-yy" });
		
						
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
						cmbAplikasi : $("#cmbAplikasi").val(),		
					 },
			  	url: this.url+'&tipe=newrincian_pekerjaan',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;	
					$('#mulai').datepicker({
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
					$("#mulai").datepicker({ dateFormat: "dd-mm-yy" });	
					$('#selesai').datepicker({
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
					$("#selesai").datepicker({ dateFormat: "dd-mm-yy" });		
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		
	},
	
	Close2:function(){//alert(this.elCover);
		var cover = this.prefix+'_formcoverKB';
		if(document.getElementById(cover)) delElem(cover);			
		if(tipe==null){
			document.body.style.overflow='auto';						
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

					rencanaPengembangan : $("#rencanaPengembangan").val(),
					mulai : $("#mulai").val(),
					selesai : $("#selesai").val(),

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
					$('#mulai').datepicker({
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
					$("#mulai").datepicker({ dateFormat: "dd-mm-yy" });	
					$('#selesai').datepicker({
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
					$("#selesai").datepicker({ dateFormat: "dd-mm-yy" });			
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
					rencanaPengembangan : $("#rencanaPengembangan").val(),
					mulai : $("#mulai").val(),
					selesai : $("#selesai").val(),

					
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
});