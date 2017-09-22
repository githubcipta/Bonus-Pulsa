var popupOption = new DaftarObj2({
	prefix : 'popupOption',
	url : 'pages.php?Pg=popupOption', 
	formName : 'popupOptionForm',
	kodeProgram : 'p',
	namaProgram : 'program',
	filterAkun : '',
	
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
		var cover = this.prefix+'_formcover';
		document.body.style.overflow='hidden';
		addCoverPage2(cover,1,true,false);	
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
	},
	
	
	thisChecked:function(idSubModul,idCheckBox){
		
		var status ="";
		if(document.getElementById(idCheckBox).checked ){
			status = "checked";
		}else{
			status = "";
		}
		$.ajax({
			type:'POST', 
			data:{
					id : idSubModul,
					jenis : status	
				 },
		  	url: this.url+'&tipe=checkboxChanged',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');
				
		  	}
		});
	},
	
	windowShow: function(id){
		var me = this;
		var cover = this.prefix+'_cover';
		document.body.style.overflow='hidden';
		addCoverPage2(cover,1,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.formName).serialize()+"&idAplikasi="+id,
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
		if($("#cmbPemda").attr('disabled')){
			
		}else{
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=clear',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					
			  	}
			});
		}
		
		document.body.style.overflow='auto';
		delElem(this.prefix+'_cover');
	},
	
	windowSave: function(){
		var me = this;
		$.ajax({
			type:'POST', 
			data:$('#'+this.formName).serialize(),
			url: this.url+'&tipe=getData',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				if(resp.err == ''){
					pengguna_aplikasi.refreshList(true);
					me.windowClose();
					
				}else{
					alert(resp.err);
				}
				 
		  	}
		});
		
					  
		
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
		if($("#jenisKegiatan").val() == 'baru' ){
		var sisanya = $("#plafon").val() - $("#paguIndikatif").val() - $("#sisaPlafonDariDB").val();
			$("#sisaPlafon").val("Rp. " + popupOption.uang(sisanya));
		}else{
		var sisanya = $("#plafon").val() - $("#paguIndikatif").val() - $("#sisaPlafonDariDB").val() - $("#plus").val() - $("#minus").val();
			$("#sisaPlafon").val("Rp. " + popupOption.uang(sisanya));
		}
		
		return (((sign)?'':'-') + '' + num + ',' + cents);
	},
	uang:function(num) {
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
