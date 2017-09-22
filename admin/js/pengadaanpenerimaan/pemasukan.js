var pemasukanSKPD = new SkpdCls({
	prefix : 'pemasukanSKPD', formName:'pemasukanForm', kolomWidth:120,
	
	pilihBidangAfter : function(){pemasukan.refreshList(true);},
	pilihUnitAfter : function(){pemasukan.refreshList(true);},
	pilihSubUnitAfter : function(){pemasukan.refreshList(true);},
	pilihSeksiAfter : function(){pemasukan.refreshList(true);}
});

var pemasukan = new DaftarObj2({
	prefix : 'pemasukan',
	url : 'pages.php?Pg=pemasukan', 
	formName : 'pemasukanForm',
	satuan_form : '0',//default js satuan
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
	
	InputBaru: function(){
	var me = this;
		//errmsg = this.CekCheckbox();
		errmsg = '';
		c1n = document.getElementById('pemasukanSKPDfmUrusan');
		cn = document.getElementById('pemasukanSKPDfmSKPD');
		dn = document.getElementById('pemasukanSKPDfmUNIT');
		en = document.getElementById('pemasukanSKPDfmSUBUNIT');
		e1n = document.getElementById('pemasukanSKPDfmSEKSI');
		
		
		if(errmsg == '' && c1n.value == '00')errmsg = "URUSAN Belum Diisi ! ";
		if(errmsg == '' && cn.value == '00')errmsg = "BIDANG Belum Diisi ! ";
		if(errmsg == '' && dn.value == '00')errmsg = "SKPD Belum Diisi ! ";
		if(errmsg == '' && en.value == '00')errmsg = "UNIT Belum Diisi ! ";
		if(errmsg == '' && e1n.value == '000')errmsg = "SUB UNIT Belum Diisi ! ";
		
		if(errmsg ==''){ 
			//var box = this.GetCbxChecked();
			
			//alert(box.value);
					
			var aForm = document.getElementById(this.formName);		
			aForm.action= this.url+'_ins&YN=1';//'?Op='+op+'&Pg=2&idprs=cetak_hal';		
			aForm.target='_blank';
			aForm.submit();	
			aForm.target='';
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
	Baru: function(){	
		
		var me = this;
		var err='';
		
		if (err =='' ){		
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			if(me.satuan_form==0){//baru dari satuan
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
	Edit:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			var aForm = document.getElementById(this.formName);		
			aForm.action= this.url+'_ins&YN=2';//'?Op='+op+'&Pg=2&idprs=cetak_hal';		
			aForm.target='_blank';
			aForm.submit();	
			aForm.target='';
		}else{
			alert(errmsg);
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
					if(me.satuan_form==0){
						me.Close();
						me.AfterSimpan();						
					}else{
						me.Close();
						barang.refreshComboSatuan();
					}

				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	
	CetakPermohonan: function(idnya){
	
					
			var aForm = document.getElementById('pemasukan_insForm');		
			aForm.action= this.url+'&tipe=CetakPermohonan&idnya='+idnya;//'?Op='+op+'&Pg=2&idprs=cetak_hal';		
			aForm.target='_blank';
			aForm.submit();	
			aForm.target='';
	},
		
});
