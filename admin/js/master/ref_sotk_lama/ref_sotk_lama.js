var ref_skpdSkpd = new SkpdCls({
	prefix : 'ref_skpdSkpd', formName:'ref_sotk_lamaForm',
	
	pilihBidangAfter : function(){ref_sotk_lama.refreshList(true);},
	pilihUnitAfter : function(){ref_sotk_lama.refreshList(true);},
	pilihSubUnitAfter : function(){ref_sotk_lama.refreshList(true);},
	pilihSeksiAfter : function(){ref_sotk_lama.refreshList(true);}
});

var ref_sotk_lama = new DaftarObj2({
	prefix : 'ref_sotk_lama',
	url : 'pages.php?Pg=ref_sotk_lama&ajx=3', 
	formName : 'ref_sotk_lamaForm',
	
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
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=pilihBidang',
		  type : 'POST',
		  data:$('#ref_sotk_lama_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_d').innerHTML = resp.content.unit;
		  }
		});
	},
	
	pilihSKPD : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=pilihSKPD',
		  type : 'POST',
		  data:$('#ref_sotk_lama_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_e').innerHTML = resp.content.unit;
		  }
		});
	},
	
	pilihUnit : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=pilihUnit',
		  type : 'POST',
		  data:$('#ref_sotk_lama_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('e1').value = resp.content.e1;
			//document.getElementById('cont_ke').innerHTML = resp.content.unit;
			//document.getElementById('j').value = resp.content.j;
		  }
		});
	},
	
	BaruBidang: function(){	
		var me = this;
		var err='';
	//	var kda =document.getElementById('fmc1').value;
		/*if (kda==''){
			alert('kode Urusan belum terpilih !!');
		}else{*/
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_lama_form').serialize(),
			  	url: this.url+'&tipe=BaruBidang',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
	//	}
	},		
	
	BaruSKPD: function(){	
		var me = this;
		var err='';
	//	var kda =document.getElementById('fmc1').value;
		var kdc =document.getElementById('fmc').value;
		if (fmc==''){
			alert('Kode Bidang belum terpilih !!');
		}else{
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKC';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_lama_form').serialize(),
			  	url: this.url+'&tipe=BaruSKPD',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		}
	},
	
	BaruUnit: function(){	
		var me = this;
		var err='';
	//	var kda =document.getElementById('fmc1').value;
		var kdb =document.getElementById('fmc').value;
		var kdc =document.getElementById('fmd').value;
		
		if (kdb==''|| kdc==''){
			alert('Kode BIDANG / Kode SKPD belum terpilih !!');
		}else{
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKD';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_lama_form').serialize(),
			  	url: this.url+'&tipe=BaruUnit',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru();
			  	}
			});
		}else{
		 	alert(err);
		}	
		}
	},	
	
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
	
	SimpanBidang: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpanBidang',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					me.refreshBidang(resp.content);
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	
	SimpanSKPD: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKC';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KCform').serialize(),
			url: this.url+'&tipe=simpanSKPD',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					me.refreshSKPD(resp.content);
					me.Close3();
				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	
	SimpanUnit: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKD';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KDform').serialize(),
			url: this.url+'&tipe=simpanUnit',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					me.refreshUnit(resp.content);
					me.Close4();
				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	
	refreshBidang : function(id_BidangBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=refreshBidang&id_BidangBaru='+id_BidangBaru,
		  type : 'POST',
		  data:$('#ref_skpd_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_c').innerHTML = resp.content.unit;
		  }
		});
	},
	
	refreshSKPD : function(id_SKPDBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=refreshSKPD&id_SKPDBaru='+id_SKPDBaru,
		  type : 'POST',
		  data:$('#ref_sotk_lama_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_d').innerHTML = resp.content.unit;
		  }
		});
	},
	
	refreshUnit : function(id_UnitBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=refreshUnit&id_UnitBaru='+id_UnitBaru,
		  type : 'POST',
		  data:$('#ref_sotk_lama_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_e').innerHTML = resp.content.unit;
		me.getKode_e1();
		  }
		});
	},
	
	getKode_e1 : function(){
	var me = this; //alert('tes');	//alert(this.prefix);
		
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_lama&tipe=getKode_e1',
		  type : 'POST',
		  //data:$('#adminForm').serialize(),
		  data:$('#ref_sotk_lama_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('e1').value = resp.content.e1;
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
					me.Close();
					me.AfterSimpan();
				}else{
					alert(resp.err);
				}
		  	}
		});
	}
		
});
