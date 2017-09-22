var SOTKBaru_insSkpd = new SkpdCls({
	prefix : 'SOTKBaru_insSkpd', formName:'SOTKBaru_insForm'
});


var SOTKBaru_ins = new DaftarObj2({
	prefix : 'SOTKBaru_ins',
	url : 'pages.php?Pg=sotkbaru_ins', 
	formName : 'SOTKBaru_insForm',
	
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
				
				//me.refreshList(true);
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
	
	BaruBAST : function(){
		var me = this;
		var cover = this.prefix+'_formcover';
		document.body.style.overflow='hidden';
		addCoverPage2(cover,999,true,false);	
		$.ajax({
			type:'POST', 
			data:$('#'+this.formName).serialize(),
		  	url: this.url+'&tipe=formBaruBAST',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');
				if (resp.err ==''){
					document.getElementById(cover).innerHTML = resp.content;			
					me.AfterFormBaru(resp);	
				}else{
					alert(resp.err);
					delElem(cover);
				}			
				
		  	}
		});
	},
	
	SimpanBAST : function(){
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
			url: this.url+'&tipe=simpanBAST',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					alert("Data sudah disimpan !");
					me.Close();
					document.getElementById('no_bast').innerHTML = resp.content.bast;
					//me.AfterSimpan();
				}else{
					alert(resp.err);
				}
		  	}
		});
	},	
	
	EditBAST : function(){
		var me = this;
		var errmsg='';
		no_ba = document.getElementById('no_bast').value;
		if(errmsg == '' && no_ba == '')errmsg = "NOMOR BAST Belum Diisi ! ";
		//errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			//var box = this.GetCbxChecked();
			
			// this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=formEditBAST',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
					}else{
						alert(resp.err);
						delElem(cover);
						//document.body.style.overflow='auto';
					}
			  	}
			});
		}else{
			alert(errmsg);
		}
		
	},
	
	Simpan: function(){
		c1 = document.getElementById('fmSKPDUrusan').value;
		c2 = document.getElementById('fmSKPDBidang2').value;
		d2 = document.getElementById('fmSKPDskpd2').value;
		e2 = document.getElementById('fmSKPDUnit2').value;
		e12 = document.getElementById('fmSKPDSubUnit2').value;
		noba = document.getElementById('no_bast').value;
		tglba = document.getElementById('tgl_bast').value;
		idubah = document.getElementById('idubah').value;
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
	
	ambilTglBA: function(){
		var me = this;
		var no_ba = document.getElementById('no_bast').value;
		$.ajax({
			type:'POST', 
			data:$('#'+this.formName).serialize(),
			url: this.url+'&tipe=ambilTglBA&noba='+no_ba,
			success: function(data) {	
				var resp = eval('(' + data + ')');			
				if(resp.err==''){
						document.getElementById('tgl_bast').value = resp.content;
						//document.getElementById('tgl_dok').value = '';
				}else{
					alert(resp.err);
				}
			}
		});	
	},
	
});
