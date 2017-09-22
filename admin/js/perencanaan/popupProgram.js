var popupProgram = new DaftarObj2({
	prefix : 'popupProgram',
	url : 'pages.php?Pg=popupProgram', 
	formName : 'popupProgramForm',
	kodeProgram : 'program',
	namaProgram : 'cmbKegiatan',
	popupProgram_form : '0',//default js popupProgram
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
			$("#sisaPlafon").val($("#plafon").val() - $("#paguIndikatif").val() - $("#sisaPlafonDariDB").val());
		}else{
			$("#sisaPlafon").val($("#plafon").val() - $("#paguIndikatif").val() - $("#sisaPlafonDariDB").val() - $("#plus").val() - $("#minus").val());
		}
		
		return (((sign)?'':'-') + '' + num + ',' + cents);
	},

	windowShow: function(){
		var me = this;
		var cover = this.prefix+'_cover';
		document.body.style.overflow='hidden';
		addCoverPage2(cover,4,true,false);	
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
	windowSave: function(id){
		var me= this;
		//alert('save');
		/*var errmsg = this.CekCheckbox();*/

			
			
			var cover = 'refprogram_getdata';
			addCoverPage2(cover,1,true,false);				
			$.ajax({
				url: 'pages.php?Pg=popupProgram&tipe=getdata&id='+id,
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					delElem(cover);
					if(resp.err==''){
						if(document.getElementById(me.kodeProgram)) document.getElementById(me.kodeProgram).value= resp.content.nama_program_kegiatan;
						if(document.getElementById(me.namaProgram)) document.getElementById(me.namaProgram).innerHTML= resp.content.cmbLucknut;
						
						$("#p").val(resp.content.p);
						me.windowClose();
						me.windowSaveAfter();
					}else{
						alert(resp.err)	
					}
			  	}
			});		
		
	}	
});