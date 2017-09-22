var ref_sotk_baruSkpd = new SkpdCls({
	prefix : 'ref_sotk_baruSkpd', formName:'ref_sotk_baruForm'
});


var ref_sotk_baru = new DaftarObj2({
	prefix : 'ref_sotk_baru',
	url : 'pages.php?Pg=ref_sotk_baru', 
	formName : 'ref_sotk_baruForm',
	
	loading:function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();
	},
	
	pilihUrusan : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=pilihUrusan',
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_c').innerHTML = resp.content.unit;
		  }
		});
	},
	
	pilihBidang : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=pilihBidang',
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_d').innerHTML = resp.content.unit;
		  }
		});
	},
	
	pilihSKPD : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=pilihSKPD',
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_e').innerHTML = resp.content.unit;
		  }
		});
	},
	
	pilihUnit : function(){
	var me = this; 
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=pilihUnit',
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('e1').value = resp.content.e1;
			//document.getElementById('cont_ke').innerHTML = resp.content.unit;
			//document.getElementById('j').value = resp.content.j;
		  }
		});
	},
	
	refreshUrusan : function(id_UrusanBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=refreshUrusan&id_UrusanBaru='+id_UrusanBaru,
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		//  data:$('#ref_skpd_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_c1').innerHTML = resp.content.unit;
		  }
		});
	},
	
	refreshBidang : function(id_BidangBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=refreshBidang&id_BidangBaru='+id_BidangBaru,
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_c').innerHTML = resp.content.unit;
		  }
		});
	},
	
	refreshSKPD : function(id_SKPDBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=refreshSKPD&id_SKPDBaru='+id_SKPDBaru,
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('cont_d').innerHTML = resp.content.unit;
		  }
		});
	},
	
	refreshUnit : function(id_UnitBaru){
	var me = this; //alert('tes');	//alert(this.prefix);
		$.ajax({
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=refreshUnit&id_UnitBaru='+id_UnitBaru,
		  type : 'POST',
		  data:$('#ref_sotk_baru_form').serialize(),
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
		  url: 'pages.php?Pg=ref_sotk_baru&tipe=getKode_e1',
		  type : 'POST',
		  //data:$('#adminForm').serialize(),
		  data:$('#ref_sotk_baru_form').serialize(),
		  success: function(data) {		
			var resp = eval('(' + data + ')');			
			document.getElementById('e1').value = resp.content.e1;
		  }
		});
	
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
			data:$('#ref_sotk_baru_form').serialize(),
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
	
	SimpanUrusan: function(){
		var me= this;
		var err='';
		
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKA';
		addCoverPage2(cover,1,true,false);	
		
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_KAform').serialize(),
			url: this.url+'&tipe=simpanUrusan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				
				if(resp.err==''){
					me.refreshUrusan(resp.content);
					me.Close1();
				}else{
					alert(resp.err);
				}
		  	}
		});
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
					//data:$('#'+this.formName).serialize(),
					data:$('#ref_sotk_baru_form').serialize(),
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
			data:$('#ref_sotk_baru_form').serialize(),
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
	
	BaruUrusan: function(){	
		var me = this;
		var err='';
	//	var kda =document.getElementById('fmc1').value;
		
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKA';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_baru_form').serialize(),
			  	url: this.url+'&tipe=BaruUrusan',
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
	BaruBidang: function(){	
		var me = this;
		var err='';
		var kda =document.getElementById('fmc1').value;
		if (kda==''){
			alert('kode Urusan belum terpilih !!');
		}else{
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_baru_form').serialize(),
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
		}
	},		
	
	BaruSKPD: function(){	
		var me = this;
		var err='';
		var kda =document.getElementById('fmc1').value;
		var kdc =document.getElementById('fmc').value;
		if (kda=='' | fmc==''){
			alert('kode Urusan / Kode Bidang belum terpilih !!');
		}else{
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKC';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_baru_form').serialize(),
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
		var kda =document.getElementById('fmc1').value;
		var kdb =document.getElementById('fmc').value;
		var kdc =document.getElementById('fmd').value;
		
		if (kda==''|| kdb==''|| kdc==''){
			alert('kode URUSAN / Kode BIDANG / Kode SKPD belum terpilih !!');
		}else{
		if (err =='' ){		
			var cover = this.prefix+'_formcoverKD';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);	
			$.ajax({
				type:'POST', 
				data:$('#ref_sotk_baru_form').serialize(),
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
	
	Batal : function(){
		var me =this;
		if(document.getElementById(this.prefix+'_jmlcek')){
			var jmlcek = document.getElementById(this.prefix+'_jmlcek').value ;	
		}else{
			var jmlcek = '';
		}
		
		if(jmlcek ==0){
			alert('Data Belum Dipilih!');
		}else{
			if(confirm('Batalkan '+jmlcek+' Data ?')){
				//document.body.style.overflow='hidden'; 
				var cover = this.prefix+'_hapuscover';
				addCoverPage2(cover,1,true,false);
				$.ajax({
					type:'POST', 
					data:$('#'+this.formName).serialize(),
					url: this.url+'&tipe=batal',
				  	success: function(data) {		
						var resp = eval('(' + data + ')');		
						delElem(cover);		
						if(resp.err==''){							
							alert('Data berhasil dibatalkan');
							//me.AfterHapus();	
						}else{
							alert(resp.err);
						}							
						
				  	}
				});
				
			}	
		}
	},
	
	Report : function(uid){
		var me = this;
		if(document.getElementById(this.formName)) formName = this.formName;
		if(document.getElementById('adminForm')) formName = 'adminForm';
		me.setCetakReport(uid);
/*		
		$.ajax({
			type:'POST', 
			data:$('#'+formName).serialize(),
		  	url: this.url+'&tipe=getjmlcetakkkerja&kib='+tipe,
		  	success: function(data) {		
				var resp = eval('(' + data + ')');
				if (resp.err ==''){
					//document.getElementById(cover).innerHTML = resp.content;			
					//me.AfterFormBaru(resp);	
					//alert(resp.content.jmldata);
					me.setFormCetakKK(tipe, resp.content.jmldata, resp.content.vjmldata);
				}else{
					alert(resp.err);
					//delElem(cover);
					//document.body.style.overflow='auto';
				}			
				
		  	}
		});
*/		
	},
	setCetakReport: function(uid){
		
		var form_judul = 'CETAK REPORT';
		var form_width = '500';
		var form_height = '220';
		var cover ='SOTKBaru_formCetakCover';
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
			if(mm<10){
				mm = '0'+mm;
			}else{
				mm = mm;
			}
		var yyyy = today.getFullYear();

		//var jmldata = 10;
		//document.body.style.overflow='hidden';
		addCoverPage2(cover,999,true,false);
		
		var form_menu =
			"<div style='padding: 0 8 9 8;height:22; '>"+
			"<div style='float:right;'>"+
				"<input type='button' value='Cetak' onclick='SOTKBaru.cetakReport()'>"+
				"<input type='button' value='Batal' onclick='SOTKBaru.formCetakClose()'>"+
				"<input type='hidden' id='Sensus_idplh' name='Sensus_idplh' value='109'><input type='hidden' id='Sensus_fmST' name='Sensus_fmST' value='1'>"+
				"<input type='hidden' id='sesi' name='sesi' value=''>"+
			"</div>"+
			"</div>";
		
		var content = 
			"<div id='SOTKBaru_form_div' style='margin:9 8 8 8; overflow:auto; border:1px solid #E5E5E5;width:"+(form_width-20)+";height:"+(form_height-80)+";'>"+
				"<table style='width:100%' class='tblform'><tr><td style='padding:4'>"+
					"<table style='width:100%:height:100%'>"+
						"<tr>"+
							"<td style='width:100'>PILIH REPORT </td>"+
							"<td style='width:10'>:</td>"+
							"<td style='' colspan='3' >"+
								"<select name='cmbPilihReport' id='cmbPilihReport' style='width:200;' onchange='SOTKBaru.pilihreport()'>"+
								"<option value=''>--PILIH REPORT--</option>"+
									"<option value='1'>BAST</option>"+
									"<option value='2'>LAMPIRAN MUTASI BARANG</option>"+
									"<option value='3'>REKAPITULASI MUTASI</option>"+
								"</select>"+
							"</td>"+														
						"</tr>"+
						"<tr>"+
							"<td style='width:80'>NOMOR BAST </td>"+
							"<td style='width:10'>:</td>"+
							"<td style='' colspan='3' >"+
								"<select name='cmbPilihBast' id='cmbPilihBast' style='width:200;' disabled>"+
									"<option value=''>--NOMOR BAST--</option>"+
								"</select>"+	
							"</td>"+													
						"</tr>"+
						"<tr>"+
							"<td style='width:80'>TANGGAL CETAK</td>"+
							"<td style='width:10'>:</td>"+
							"<td>"+
								"<select name='cmbTglCetak' id='cmbTglCetak' disabled>"+
									"<option value="+dd+">"+dd+"</option>"+
								"</select>"+
								"&nbsp;"+
								"<select name='cmbBlnCetak' id='cmbBlnCetak' disabled>"+
									"<option value="+mm+">"+mm+"</option>"+
								"</select>"+
								"&nbsp;"+
								"<select name='cmbThnCetak' id='cmbThnCetak' disabled>"+
									"<option value="+yyyy+">"+yyyy+"</option>"+
								"</select>"+
							"</td>"+
						"</tr>"+						
						"<tr>"+
							"<td style='width:80'>USERNAME</td>"+
							"<td style='width:10'>:</td>"+
							"<td>"+
								"<input type='text' id='uid' name='uid' value="+uid+" style='width:200;' readonly>"+
							"</td>"+
						"</tr>"+
					"</table>"+
				"</td></tr></table>"+
			"</div>";
		
		
		document.getElementById(cover).innerHTML= 
			"<table width='100%' height='100%'><tbody><tr><td align='center'>"+
			//"rtera"+
			"<div id='div_border' style='width:"+form_width+";height:"+form_height+"; background-color:white; border-color: rgba(0, 0, 0, 0.3);   border-style: solid;  border-width:1; box-shadow: 6px 6px 5px rgba(0, 0, 0, 0.3);'>"+
			"<table class='' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody><tr><td style='padding:0'>"+
				"<div class='menuBar2' style='height:20'>"+			
				"<span style='cursor:default;position:relative;left:6;top:2;color:White;font-size:12;font-weight:bold'>"+form_judul+"</span>"+
				"</div>"+
			"</td></tr></tbody></table>"+			
			content+
			form_menu+		
			"</div>"+
				
			"</td></tr>"+
			"</table>";
		
			
	},
	
	formCetakClose : function(){
		delElem('SOTKBaru_formCetakCover');	
	},
	
	pilihreport: function(){
		var me = this;
		
		//this.formName = 'adminForm';
		$.ajax({
		  url: this.url+'&tipe=pilihreport',
		  type : 'POST',
		  data:$('#'+this.formName).serialize(),
		  success: function(data) {
			var resp = eval('(' + data + ')');	//console.info(me);	//console.info('id='+me.prefix+'CbxBagian');
				
				if(document.getElementById('cmbPilihReport').value != 3){
					//me.refreshList(true);
					document.getElementById('cmbPilihBast').disabled=false;
					document.getElementById('cmbPilihBast').innerHTML=resp.content;
				}else{
					document.getElementById('cmbPilihBast').value='';
					document.getElementById('cmbPilihBast').disabled=true;
				}
				
				
		  }
		});
	},
	
	cetakReport : function(){
		var cmbReport = document.getElementById('cmbPilihReport').value;
		var cmbBast = document.getElementById('cmbPilihBast').value;
		var cmbTgl = document.getElementById('cmbTglCetak').value;
		var cmbBln = document.getElementById('cmbBlnCetak').value;
		var cmbThn = document.getElementById('cmbThnCetak').value;
		var aForm = document.getElementById(this.formName);		
		var err='';
		if(err == '' && cmbReport == '')err = "PILIH REPORT YANG AKAN DI CETAK!";
		if(err == '' && cmbReport == '1' && cmbBast=='')err = "NOMOR BAST BELUM DIPILIH!";
		if(err == '' && cmbReport == '2' && cmbBast=='')err = "NOMOR BAST BELUM DIPILIH!";
		if(err==''){
			aForm.action= this.url+'&tipe=cetakReport&jnsReport='+cmbReport+'&bast='+cmbBast+'&tgl='+cmbTgl+'&bln='+cmbBln+'&thn='+cmbThn;//'?Op='+op+'&Pg=2&idprs=cetak_hal';		
			aForm.target='_blank';
			aForm.submit();	
			aForm.target='';
		}else{
			alert(err);
		}			
	},
	
});
