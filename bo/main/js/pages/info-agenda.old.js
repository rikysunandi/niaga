(function($) {
    "use strict"


    var params_url = location.search.replace('?', '').split('=')

	$('input').val('');
	$('textarea').val('');

  var kategori_opt = { 
              "PERSIL": "PERSIL", 
              "PERLUASAN": "PERLUASAN"
            };
	var jenis_opt = { 
						"MDU": "MATERIAL MDU", 
						"NON-MDU": "MATERIAL NON MDU", 
						"JASA": "JASA DAN AKSESORIS"
					};

	var table_material = $('#tbl_mon_material_agenda').DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0, // here
        "ajax": {
            "url": '#',
            "type": "POST",
            "timeout": 200000
        },
        columns: [
          {
            data: "NOAGENDA_INDIVIDU",
            visible: false,
            type: 'hidden',
            readonly: true,
          },
          {
            data: "KATEGORI",
            readonly: false,
            type : "select",
            options : kategori_opt,
            select2 : { width: "100%"},
          },
          {
            data: "JENIS",
            readonly: false,
            type : "select",
            options : jenis_opt,
            select2 : { width: "100%"},
            editorOnChange : function(event, altEditor) {
                console.log(event, altEditor);
                var jenis = $(event.currentTarget).val();
                var ket_transaksi = $('#ket_transaksi').val();

                $(altEditor.modal_selector).find("#alteditor-row-KEBUTUHAN").show();
                $.ajax({
                    url: '../controller/referensi/getKebutuhan.php?jenis='+jenis+'&ket_transaksi='+ket_transaksi,
                    type: 'GET',
                    success: function(options) {
                        console.log(options);
                        var kebutuhan = $(altEditor.modal_selector).find('#KEBUTUHAN');
                        altEditor.reloadOptions(kebutuhan, options);
                    }
                });
            }
            width: 200,
          },
          {
            data: "ID_KEBUTUHAN",
            type: 'hidden',
            visible: false,
          },
          {
            data: "KEBUTUHAN",
            readonly: true,
            width: 200,
          },
          {
            data: "HARGA_SATUAN",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "VOLUME",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "TOTAL_HARGA",
            type: 'hidden',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        select: 'single',
        altEditor: true,    
        buttons: [
	        { text: '<i class="fa fa-plus"></i>&nbsp;Tambah', name: 'add' },
        	{ extend: 'selected', text: '<i class="fa fa-edit"></i>&nbsp;Ubah', name: 'edit' },
        	{ extend: 'selected', text: '<i class="fa fa-trash"></i>&nbsp;Hapus', name: 'delete' },
            // { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;Copy', footer: true },
        ],
        "scrollY": 280,
        "scrollX": true,
        "paging": false,
        "order": [[1, 'desc'],[2, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 7;
          while(j < nb_cols){
            var pageTotal = api
                  .column( j, { page: 'current'} )
                  .data()
                  .reduce( function (a, b) {
                      return Number(a) + Number(b);
                  }, 0 );
            // Update footer
            $( api.column( j ).footer() ).html( $.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));
            j++;
          } 
        },
        onAddRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be / with type='PUT'
                url: "../controller/simpanKebutuhanAgenda.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onDeleteRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='DELETE'
                url: "../controller/hapusKebutuhanAgenda.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onEditRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='POST'
                url: "../controller/simpanKebutuhanAgenda.php",
                type: 'GET',
                data: rowdata,
                success: function(data,b,c,d,e){ 
                		console.log(datatable); 
                		datatable._editRowCallback(data,b,c,d,e); 
                		$('#btn_noagenda_cari').trigger('click');
                	},
                error: error
            });
        }
    });


    $('#btn_noagenda_cari').click(function(){

    	var noagenda = $('#noagenda_cari').val();
    	$('input').val('');
    	$('textarea').val('');
    	$('#noagenda_cari').val(noagenda);

    	$('div.content-body').block({ message: 'Mencari data...' });
    	$.getJSON('../controller/getInfoAgenda.php?noagenda='+noagenda, function(data){
	        $('#unitap').val(data.unitap);
          $('#noagenda_individu').val(data.noagenda_individu);
	        $('#noagenda_kolektif').val(data.noagenda_kolektif);
	        $('#jenislap').val(data.jenislap);
	        $('#tglmohon').val(data.tglmohon);
	        $('#jenis_transaksi').val(data.jenis_transaksi);
	        $('#ket_transaksi').val(data.ket_transaksi);
	        $('#jenis_mk').val(data.jenis_mk);
	        $('#idpel').val(data.idpel);
	        $('#nama').val(data.nama);
	        $('#tarif_daya_lama').val(data.tarif_daya_lama);
	        $('#tarif_daya_baru').val(data.tarif_daya_baru);
	        $('#segmen_tegangan').val(data.segmen_tegangan);
	        $('#keterangan_gol_tarif').val(data.keterangan_gol_tarif);
	        $('#rp_bp').val(data.rp_bp);
	        $('#rp_ujl').val(data.rp_ujl);
	        $('#status_permohonan').val(data.status_permohonan);
	        $('#alasan_kriteria_tmp').val(data.alasan_kriteria_tmp);
	        $('#rp_rab').val(data.rp_rab);
	        $('#rab_material').val(data.rab_material);
	        $('#rab_jasa').val(data.rab_jasa);
	        $('#status_tmp').val(data.status_tmp);
	        $('#klasifikasi_rab').val(data.klasifikasi_rab);
	        //$('#keterangan_rab').val(data.keterangan_rab);

	        $('div.content-body').unblock();
	    });


        table_material.ajax.url( '../controller/getMaterialAgenda.php?noagenda='+noagenda ).load();

        var SUMCOL = function(instance, columnId) {
            console.log(instance, columnId);
            var total = 0;
            for (var j = 0; j < instance.options.data.length; j++) {
                if (Number(instance.records[j][columnId-1].innerHTML)) {
                    total += Number(instance.records[j][columnId-1].innerHTML);
                }
            }
            return total;
        }

        var table = jspreadsheet(document.getElementById('spreadsheet'), {
            url:'../controller/getMaterialAgenda.php?noagenda='+noagenda,
            search:true,
            pagination:false,
            footers: [['Total','','','','=SUMCOL(TABLE(), COLUMN())']],
            columns: [
                { type:'text', name:'JENIS', title:'JENIS',  width:200 },
                { type:'text', name:'KEBUTUHAN', title:'KEBUTUHAN', width:200 },
                { type:'numeric', name:'HARGA_SATUAN', title:'HARGA_SATUAN', mask:'Rp #.##,00', align:'right', width:200 },
                { type:'numeric', name:'VOLUME', title:'VOLUME', align:'right', width:200 },
                { type:'numeric', name:'TOTAL_HARGA', title:'TOTAL_HARGA', mask:'Rp #.##,00', align:'right', width:200 },
                //{ type:'dropdown', width:100, source:[{ id:1, name:'Male'}, { id:2, name:'Female'}] },
             ],
            // persistance: '/jspreadsheet/v4/save',
            // updateTable: function(instance, cell, col, row, val, label, cellName) {
            //      if (col == 1) {
            //          if (! val) {
            //              cell.innerHTML = '<img src="https://images-na.ssl-images-amazon.com/images/I/21%2Bwfxx2lyL._SX319_BO1,204,203,200_.jpg" style="width:30px;">';
            //          } else {
            //              cell.innerHTML = '<img src="' + val + '" style="width:30px;">';
            //          }
            //      }
         
            //      cell.style.overflow = 'hidden';
            // },
            // onevent:function() {
            //      console.log(arguments);
            //  }
        });
    


    });


	if(params_url[1].length>0){
		$('#noagenda_cari').val(params_url[1]);
		$('#btn_noagenda_cari').trigger('click');
	}



})(jQuery);