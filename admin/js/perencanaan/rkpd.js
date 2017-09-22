var rkpd = new DaftarObj2({
	prefix : 'rkpd',
	url : 'pages.php?Pg=rkpd', 
	formName : 'rkpdForm',
	rkpd_form : '0',
	loading: function(){
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
		rkpd.refreshList(true);
	},
	BidangAfterform: function(){
		var me = this;
		$.ajax({
		  url: this.url+'&tipe=BidangAfterForm',
		  type : 'POST',
		  data:{ fmSKPDBidang: $("#cmbBidangForm").val(),
		  		 fmSKPDUrusan: $("#cmbUrusanForm").val(),
		  		 fmSKPDskpd: $("#cmbSKPDForm").val(),
		  		 fmSKPDUnit: $("#cmbUnitForm").val(),
		  		 fmSKPDSubUnit: $("#cmbSubUnitForm").val() },
		  success: function(data) {
			var resp = eval('(' + data + ')');	
				document.getElementById('cmbBidangForm').innerHTML=resp.content.bidang;
				document.getElementById('cmbSKPDForm').innerHTML=resp.content.skpd;
				document.getElementById('cmbUnitForm').innerHTML=resp.content.unit;
				document.getElementById('cmbSubUnitForm').innerHTML=resp.content.subunit;
		  }
		});

	},
	jenisChanged: function(){
		var me = this;
		$.ajax({
		  url: this.url+'&tipe=jenisChanged',
		  type : 'POST',
		  data:{ jenisKegiatan: $("#jenisKegiatan").val()},
		  success: function(data) {
			var resp = eval('(' + data + ')');	
				document.getElementById('tempatPlus').innerHTML=resp.content.plus;
				document.getElementById('tempatMinus').innerHTML=resp.content.minus;
				document.getElementById('keyPP').textContent ="";
				document.getElementById('keyMM').textContent ="";
		  }
		});

	},
	pilihBidang: function(){
				rkpd.refreshList(true);

	},
	comboSKPDChanged: function(){
				rkpd.refreshList(true);
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
			if(me.rkpd_form==0){//baru dari rkpd
				addCoverPage2(cover,1,true,false);	
			}else{//baru dari barang
				addCoverPage2(cover,2,true,false);	
			}
			$.ajax({
				type:'POST', 
				data:$('#'+this.formName).serialize() ,
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');			
					document.getElementById(cover).innerHTML = resp.content;	
					me.AfterFormBaru();
					$("#tanggalMulai").datepicker({ dateFormat: 'dd-mm-yy' });
					$("#tanggalSelesai").datepicker({ dateFormat: 'dd-mm-yy' });
			  	}
			});
		
		}else{
		 	alert(err);
		}
	},
	
	detailRKPD: function(kode){	
		
		var me = this;
			var box = this.GetCbxChecked();
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,2,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data: $('#'+this.formName).serialize()+"&rkpd_cb%5B%5D=1.08.01.01.01" ,
				url: this.url+'&tipe=lihatRKPD',
			  	success: function(data) {		
					var resp = eval('(' + data + ')');	
					if (resp.err ==''){		
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$("#findProgram").attr("disabled",true);
						$("#plafon").attr("readonly",true);
						$("#keyPlafon").text("Rp. " + popupProgram.formatCurrency($("#plafon").val()));
						
						
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}
			  	}
			});
	},
	Edit:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){ 
			var box = this.GetCbxChecked();
			
			//this.Show ('formedit',{idplh:box.value}, false, true);			
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,2,true,false);	
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST', 
				data: $('#'+this.formName).serialize() ,
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
	
	CariProgramKegiatan : function(){
	popupProgram.windowShow();	
	},
		
	Simpan: function(){
		var me= this;	
		this.OnErrorClose = false	
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);	
		var tahunJamak = ( $("#tahunJamak").is(':checked') ) ? 1 : 0;
		if($("#tahunJamak").c){
			
		}
		$.ajax({
			type:'POST', 
			data:$('#'+this.prefix+'_form').serialize()+ "&tahunJamak="+tahunJamak,
			url: this.url+'&tipe=simpan',
		  	success: function(data) {		
				var resp = eval('(' + data + ')');	
				delElem(cover);		
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					if(me.rkpd_form==0){
						if (confirm('Input Lagi ?')) {
	    					$.ajax({
								type : 'POST',
								data : {c1 : $('#cmbUrusanForm').val(),
										c  : $('#cmbBidangForm').val(),
										d  : $('#cmbSKPDForm').val()
										 },
								url  : this.url+'&tipe=inputLagi',
								success : function(data){
									var resp = eval('(' + data + ')');	
									$('#plafon').attr('readonly', true);
									
									document.getElementById("cmbUrusanForm").innerHTML = resp.content.urusan;
									document.getElementById("cmbBidangForm").innerHTML = resp.content.bidang;
									document.getElementById("cmbSKPDForm").innerHTML = resp.content.skpd;
									
									
									
									$("#sisaPlafonDariDB").val(resp.content.sisaBuatKurang);
									$("#sisaPlafon").val($("#plafon").val() - $("#sisaPlafonDariDB").val());
									$("#cmbUnitForm").prop('selectedIndex', 0);
									$("#cmbSubUnitForm").prop('selectedIndex', 0);
									$("#lokasiKegiatan").val("");
									$("select#jenisKegiatan").prop('selectedIndex', 0);
									$("#tanggalMulai").val("");
									$("#tanggalSelesai").val("");
									$("#tanggalMulai").val("");
									$("#tahunJamak").prop('checked',false);
									$("#paguIndikatif").val("");
									$("#plus").val("");
									$("#min").val("");
									$("#cmbSumberDana").prop('selectedIndex', 0);
									
									document.getElementById("keyPagu").textContent = "Rp.";
									document.getElementById("keyPP").textContent = "Rp.";
									document.getElementById("keyMM").textContent = "Rp.";
									
									/*document.getElementById("CPTU").textContent = "";
									document.getElementById("CPTK").textContent = "";
									document.getElementById("HTU").textContent = "";
									document.getElementById("HTK").textContent = "";
									document.getElementById("KTU").textContent = "";
									document.getElementById("KTK").textContent = "";
									document.getElementById("MTU").textContent = "";
									document.getElementById("MTK").textContent = "";*/
									$('#CPTU').val(""); 
									$('#CPTK').val(""); 
									$('#HTU').val(""); 
									$('#HTK').val(""); 
									$('#KTU').val(""); 
									$('#KTK').val(""); 
									$('#MTU').val(""); 
									$('#MTK').val(""); 
									//lhoh keluar:  tapi kok aneh tadi pertama w coba kek gini gak ilang ikacang kacang
									//apa ? tar2 wa d panggil
									
									$("#sasaranKegiatan").val("");
									
									
								}
							});
						} else {
							me.Close()
							me.refreshList(true);
						}				
					}else{
						me.Close();
						me.refreshComborkpd();
					}

				}else{
					alert(resp.err);
				}
		  	}
		});
	}
		
});