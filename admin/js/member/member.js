

var member = new DaftarObj2({
	prefix : 'member',
	url : 'pages.php?Pg=member',
	//formName : 'member_form',
	formName : 'memberForm',
	//member_form
	loading: function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();

	},

	find: function(){
		var me = this;
		me.refreshList(true);
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

	Baru: function(){

		var me = this;
		var err='';

		if (err =='' ){
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);
			$.ajax({
				type:'POST',
				data:$('#member_form').serialize(),
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					document.getElementById(cover).innerHTML = resp.content;
					//document.getElementById('kode1').focus();
					me.AfterFormBaru();
					$('#tanggal_update').datepicker({
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
					$("#tanggal_update").datepicker({ dateFormat: "dd-mm-yy" });
			  	}
			});

		}else{
		 	alert(err);
		}
	},
	PemdaBaru: function(){

		var me = this;
		var err='';



		if (err =='' ){
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);
			$.ajax({
				type:'POST',
				data:$('#member_form').serialize(),
			  	url: this.url+'&tipe=formBaruPemda',
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

	AplikasiBaru: function(){

		var me = this;
		var err='';



		if (err =='' ){
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);
			$.ajax({
				type:'POST',
				data:$('#member_form').serialize(),
			  	url: this.url+'&tipe=formBaruAplikasi',
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

PemdaEdit: function(){

		var me = this;
		var err='';
		if($("#cmbPemda").val() == ''){
			err = "Pilih Pemda";
		}


		if (err =='' ){
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);
			$.ajax({
				type:'POST',
				data:$('#member_form').serialize()+"&idPemda="+$("#cmbPemda").val(),
			  	url: this.url+'&tipe=formBaruPemda',
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


AplikasiEdit: function(){

		var me = this;
		var err='';
		if($("#cmbAplikasi").val() == ''){
			err = "Pilih Aplikasi";
		}


		if (err =='' ){
			var cover = this.prefix+'_formcoverKB';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);
			$.ajax({
				type:'POST',
				data:$('#member_form').serialize()+"&idAplikasi="+$("#cmbAplikasi").val(),
			  	url: this.url+'&tipe=formBaruAplikasi',
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


	Edit:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){
			var box = this.GetCbxChecked();
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST',
				data:$('#memberForm').serialize(),
				url: this.url+'&tipe=formEdit',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
						document.getElementById(cover).innerHTML = resp.content;
						me.AfterFormEdit(resp);
						$('#tanggal_update').datepicker({
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
					$("#tanggal_update").datepicker({ dateFormat: "dd-mm-yy" });
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


	Suspend:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){
			var box = this.GetCbxChecked();
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,1,true,false);
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST',
				data:$('#memberForm').serialize(),
				url: this.url+'&tipe=formSuspend',
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


	Modul:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){
			var box = this.GetCbxChecked();
			$.ajax({
				type:'POST',
				data:$('#memberForm').serialize(),
				url: this.url+'&tipe=modul',
			  	success: function(data) {
					var resp = eval('(' + data + ')');

					popupOption.windowShow(resp.content.idAplikasi);

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



	SimpanPemda: function(){
		var me= this;
		var err='';

		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);

		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpanPemda',
		  	success: function(data) {
				var resp = eval('(' + data + ')');
				delElem(cover);

				if(resp.err==''){
					document.getElementById('cmbPemda').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});

	},



	SimpanAplikasi: function(){
		var me= this;
		var err='';

		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);

		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_KBform').serialize(),
			url: this.url+'&tipe=simpanAplikasi',
		  	success: function(data) {
				var resp = eval('(' + data + ')');
				delElem(cover);

				if(resp.err==''){
					document.getElementById('cmbAplikasi').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});

	},
	EditPemda: function(id){
		var me= this;
		var err='';

		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);

		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id,
			url: this.url+'&tipe=editPemda',
		  	success: function(data) {
				var resp = eval('(' + data + ')');
				delElem(cover);

				if(resp.err==''){
					document.getElementById('cmbPemda').innerHTML = resp.content.replacer;
					me.Close2();
				}else{
					alert(resp.err);
				}
		  	}
		});

	},

	EditAplikasi: function(id){
		var me= this;
		var err='';

		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpanKB';
		addCoverPage2(cover,1,true,false);

		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_KBform').serialize()+'&id='+id,
			url: this.url+'&tipe=editAplikasi',
		  	success: function(data) {
				var resp = eval('(' + data + ')');
				delElem(cover);

				if(resp.err==''){
					document.getElementById('cmbAplikasi').innerHTML = resp.content.replacer;
					me.Close2();
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
			data:$('#member_form').serialize(),
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

	Simpan: function(id){
		var me= this;
		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);
		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_form').serialize()+'&hubla='+id,
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

	saveSuspend: function(){
		var me= this;
		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);
		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_form').serialize(),
			url: this.url+'&tipe=saveSuspend',
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
