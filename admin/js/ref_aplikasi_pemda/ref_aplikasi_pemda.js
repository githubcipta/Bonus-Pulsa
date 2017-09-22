var ref_aplikasi_pemda = new DaftarObj2({
	prefix : 'ref_aplikasi_pemda',
	url : 'pages.php?Pg=ref_aplikasi_pemda', 
	formName : 'ref_aplikasi_pemdaForm',
	ref_aplikasi_pemda_form : '0',
	loading: function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();
	
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
						ref_aplikasi_pemda.refreshList(true);
	},
	BidangAfterform: function(){
		var me = this;
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
	
	aplikasiChanged: function(){
		
		$("#pilih").attr('onclick','ref_aplikasi_pemda.showOptions('+$("#cmbAplikasi").val()+')');
		$("#lock").val("0");

	},
	
	showOptions: function(id){
	
		if($("#cmbPemda").val() ==''){
			alert("Pilih Pemda");
		}else if($("#cmbAplikasi").val() == ''){
			alert("Pilih Aplikasi");
		}else{
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize()+"&idAplikasi="+id,
			  	url: this.url+'&tipe=showOptions',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					popupOption.windowShow(id);
			  	}
			});
		}
			
		

	},
	pilihBidang: function(){
				ref_aplikasi_pemda.refreshList(true);

	},
	comboSKPDChanged: function(){
				ref_aplikasi_pemda.refreshList(true);
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
		
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			if(me.ref_aplikasi_pemda_form==0){//baru dari ref_aplikasi_pemda
				addCoverPage2(cover,1,true,false);	
			}else{//baru dari barang
				addCoverPage2(cover,999,true,false);	
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
	checkref_aplikasi_pemda:function(){
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
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=checkref_aplikasi_pemda',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$('#tanggal_cek').datepicker({
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
					$("#tanggal_cek").datepicker({ dateFormat: "dd-mm-yy" });
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
	
	showKoreksiref_aplikasi_pemda:function(id){
		var me = this;

			
		
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,999,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:{id:id},
				url: this.url+'&tipe=showKoreksiref_aplikasi_pemda',
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
		
	saveCheck: function(id){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+'&idSpek='+id,
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
			data:$('#'+this.prefix+'_form').serialize()+"&username="+id,
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
			data:$('#'+this.prefix+'_form').serialize(),
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
		
});