var MappingBarang_insSkpd = new SkpdCls({
	prefix : 'MappingBarang_insSkpd', formName:'MappingBarang_insForm'
});


var MappingBarang_ins = new DaftarObj2({
	prefix : 'MappingBarang_ins',
	url : 'pages.php?Pg=mappingbarang_ins', 
	formName : 'MappingBarang_insForm',
	kdbrg_lama:'',
	el_kdbrgbaru:'kodebarang',
	el_nmbrgbaru:'namabarang',
	
	loading:function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		//this.daftarRender();
		//this.sumHalRender();
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
					document.getElementById('fmSKPDBidang2').innerHTML=resp.content.c2;
					//me.BidangAfter2();
				
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
				
				//me.refreshList(true);
				document.getElementById('fmSKPDskpd2').innerHTML=resp.content;
				//me.SKPDAfter2();
				
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
				//me.UnitAfter2();
				
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
	
	
	Simpan: function(){
		/*c1 = document.getElementById('MappingBarangfmSKPDUrusan').value;
		c2 = document.getElementById('MappingBarangfmSKPDBidang2').value;
		d2 = document.getElementById('MappingBarangfmSKPDskpd2').value;
		e2 = document.getElementById('MappingBarangfmSKPDUnit2').value;
		e12 = document.getElementById('MappingBarangfmSKPDSubUnit2').value;
		idubah = document.getElementById('idubah').value;*/
		//alert(c1);
		
		$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=simpan',
				success: function(data) {	
					var resp = eval('(' + data + ')');			
					if(resp.err==''){
						alert("Data Berhasil Disimpan !");
						
						
							window.close();
							window.opener.location.reload();
						

												
					}else{
						alert(resp.err);
					}
				}
			});	
	},
	
	CariBrgBaru: function(){
		var me = this;	
		var err = '';
		var kdbaranglama = document.getElementById('fmIDBARANG_lama').value;
		if (err=='' && kdbaranglama =='') err= "Kode Barang Lama belum diisi!";

		if(err==''){
			cariBarangBaru.kdbrg_lama = document.getElementById('fmIDBARANG_lama').value;
			cariBarangBaru.el_kdbrgbaru= 'kodebarang';
			cariBarangBaru.el_nmbrgbaru= 'namabarang';
			//cariBarangBaru.windowSaveAfter= function(){};
			cariBarangBaru.windowShow();	
		}else{
			alert(err);
		}
	},
	
	
});
