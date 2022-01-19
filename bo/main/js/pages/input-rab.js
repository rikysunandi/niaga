(function($) {
    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    $('input').val('');
    $('textarea').val('');

    var table = $('#tbl_kebutuhan').DataTable( {
        "processing": true,
        "serverSide": false,
        columns: [
          {
             'searchable': false,
             'orderable': false,
             'className': 'dt-body-center',
             'render': function (data, type, full, meta){
                 return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
             }
          },
          {
            data: "JENIS",
            visible: true,
            width: "25%"
          },
          {
            data: "ID_KEBUTUHAN",
            visible: false
          },
          {
            data: "KEBUTUHAN",
            visible: true,
            width: "30%"
          },
          {
            data: "HARGA_SATUAN",
            type: 'number',
            "sClass" : "text-right" ,
            render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "VOLUME",
            type: 'number',
            width: "10%",
            "sClass" : "text-right" , 
            render: function ( data, type, row, meta ) {
                // console.log('row',row);
                // console.log('type',type);
                // console.log('meta',meta);
                return '<input type="text" maxlength="4" size="4" class="volume text-right" data-idx="'+meta.row+'" id="volume-'+meta.row+'" name="volume-'+meta.row+'" value="'+data+'"></td>';
            }
          },
          {
            data: "TOTAL_HARGA",
            type: 'number',
            "sClass" : "text-right" , 
            render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-12 mb-2'B>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-7'p>>",
        buttons: [
            { 
              text: '<span><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Tambah</span>',
              titleAttr: 'Tambah Kebutuhan',
              action: function ( e, dt, node, config ) {
                $('#tambah_kebutuhan_modal form')[0].reset();
                $('#sel_jenis').selectpicker('refresh');
                $('#sel_kebutuhan').empty().selectpicker('refresh');
                $('#tambah_kebutuhan_modal').modal('show');

                $('#sel_jenis').change(function(){

                    $('#sel_kebutuhan').empty();

                    $.getJSON('../controller/referensi/getKebutuhan.php?jenis='+$('#sel_jenis').val()+'&ket_transaksi='+$('#ket_transaksi').val()+'&daya_baru='+$('#daya_baru').val()+'&alasan_kriteria_tmp='+$('#alasan_kriteria_tmp').val(), function(data){
                        $.each(data.rows,function(i,v){
                            $('#sel_kebutuhan').append('<option data-harga-satuan="'+v.harga_satuan+'" value="'+v.kode+'">'+v.nama+'</option>');
                        });
                        $('#sel_kebutuhan').selectpicker('refresh');
                        
                    });

                });

                $('#sel_kebutuhan').change(function(){
                    console.log($(this));
                    $('#harga_satuan').val($(this).find(":selected").data('harga-satuan'));
                });

              }
            },
            { 
              text: '<span><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</span>',
              titleAttr: 'Hapus Kebutuhan',
              enabled: false,
              action: function ( e, dt, node, config ) {

              }
            },
        ],
        "scrollY": 520,
        "scrollX": false,
        "paging": false,
        //lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 50,
        "order": [[1, 'desc'],[2, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
            updateFooter();
        }
    });

    function updateFooter(){
        var api = $('#tbl_kebutuhan').dataTable().api();
        var nb_cols = api.columns().nodes().length;
        var j = 6;
        while(j < nb_cols){
            var pageTotal = api
                  .column( j, { page: 'current'} )
                  .data()
                  .reduce( function (a, b) {
                      return Number(a) + Number(b);
                  }, 0 );
            // Update footer
            $( api.column( j ).footer() ).html(
                $.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));

            $('tr:eq(1) th:eq(1)', api.table().footer()).html(
                $.fn.dataTable.render.number('.', ',', 0, '').display( 1.1*pageTotal ));

            $('tr:eq(2) th:eq(1)', api.table().footer()).html(
            $.fn.dataTable.render.number('.', ',', 0, '').display( $('#rp_bp').val().replace(/,/g, '') ));

            if(parseFloat($("#rp_bp").val().replace(/,/g, '')) >= parseFloat(( 1.1*pageTotal ))){
                $('tr:eq(3) th:eq(1)', api.table().footer()).html('<span class="label label-pill label-success">BP >= RAB</span>');
            }else{
                $('tr:eq(3) th:eq(1)', api.table().footer()).html('<span class="label label-pill label-warning">BP < RAB</span>');
            }

            j++;
        } 

        
    }

    // Handle click on "Select all" control
   $('#select_all').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
      table.button( 1 ).enable( $('#tbl_kebutuhan input:checkbox:checked').length > 0 );
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#tbl_kebutuhan tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#select_all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }

      table.button( 1 ).enable( $('#tbl_kebutuhan input:checkbox:checked').length > 0 );
   });

    $(document).on("blur", ".volume", function() {
        var sum = 0;
        var idx = $(this).data('idx');
        var temp = table.row(idx).data();
        console.log(temp);
        temp.VOLUME = $(this).val();
        temp.TOTAL_HARGA = $(this).val()*temp.HARGA_SATUAN;
        // console.log(idx);
        // console.log($(this).val());
        // console.log(temp.HARGA_SATUAN);
        $('#tbl_kebutuhan').dataTable().fnUpdate(temp,idx,undefined,false);
        updateFooter();
        $(this).focus();
    });

    $(document).on("keyup", "#volume", function() {
        var harga_satuan = $('#harga_satuan').val().replace(/,/g, '');
        var volume = $(this).val();
        $('#harga_total').val(harga_satuan*volume);
    });

    $('#btn_tambah').click(function(btn){

        table.row.add({
            JENIS: $('#sel_jenis').val(),
            ID_KEBUTUHAN: $('#sel_kebutuhan').val(),
            KEBUTUHAN: $('#sel_kebutuhan option:selected').text(),
            HARGA_SATUAN: $('#harga_satuan').val(),
            VOLUME: $('#volume').val(),
            TOTAL_HARGA: $('#harga_total').val(),
        }).draw();
        
        updateFooter();

        $('#tambah_kebutuhan_modal').modal('hide');
    });

    $('#btn_noagenda_cari').click(function(){

        var noagenda = $('#noagenda_cari').val();
        $('input').val('');
        $('textarea').val('');
        $('#noagenda_cari').val(noagenda);
        $('#status_tmp').removeClass().addClass('form-control');
        $('#status_proses').removeClass().addClass('form-control');
        table.clear().draw();

        if(noagenda.length>0){

            $('div.content-body').block({ message: 'Mencari data...' });
            $.getJSON('../controller/pemasaran/getInfoMaterialAgenda.php?noagenda='+noagenda, function(data){
                if(data.success){
                    $('#unitap').val(data.unitap);
                    $('#noagenda_individu').val(data.noagenda_individu);
                    $('#noagenda').val(data.noagenda_individu);
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
                    $('#daya_baru').val(data.daya_baru);
                    $('#segmen_tegangan').val(data.segmen_tegangan);
                    $('#keterangan_gol_tarif').val(data.keterangan_gol_tarif);
                    $('#rp_bp').val(data.rp_bp);
                    $('#rp_ujl').val(data.rp_ujl);
                    $('#status_permohonan').val(data.status_permohonan);
                    $('#alasan_kriteria_tmp').val(data.alasan_kriteria_tmp);
                    $('#keterangan_alasan_kriteria_tmp').val(data.keterangan_alasan_kriteria_tmp);
                    // $('#rp_rab').val(data.rp_rab);
                    // $('#rab_material').val(data.rab_material);
                    // $('#rab_jasa').val(data.rab_jasa);
                    $('#rp_rab_std').val(data.rp_rab_std);
                    $('#rab_material_std').val(data.rab_material_std);
                    $('#rab_jasa_std').val(data.rab_jasa_std);
                    $('#rp_rab_perluasan').val(data.rp_rab_perluasan);
                    $('#rab_material_perluasan').val(data.rab_material_perluasan);
                    $('#rab_jasa_perluasan').val(data.rab_jasa_perluasan);
                    $('#status_tmp').val(data.status_tmp);
                    if(data.status_tmp=='DALAM TMP'){
                        $('#status_tmp').addClass('text-success');
                    }else if(data.status_tmp=='MENDEKATI TMP'){
                        $('#status_tmp').addClass('text-warning');
                    }else{
                        $('#status_tmp').addClass('text-danger');
                    }

                    $('#status_proses').val(data.status_proses).addClass((data.status_proses=='BP >= RAB')?'text-success':'text-warning');

                    // if(parseFloat($("#rp_bp").val().replace(/,/g, '')) >= parseFloat($("#rp_rab").val().replace(/,/g, ''))){
                    //     $('#status_rab').html('<span class="label label-pill label-success">BP >= RAB</span>');
                    // }else{
                    //     $('#status_rab').html('<span class="label label-pill label-warning">BP < RAB</span>');
                    // }
                    table.rows.add(data.kebutuhan).draw();
                    //table.ajax.url( '../controller/pemasaran/getKebutuhan.php?noagenda='+noagenda ).load();
                }else{
                    showMsg(data.msg, 'warning');
                }

                $('div.content-body').unblock();
            });
        }else{
            showMsg('Silahkan masukan No Agenda yang akan dicari', 'warning');
        }


    });


    if(urlParams.has('noagenda')){
        $('#noagenda_cari').val(urlParams.get('noagenda'));
        $('#btn_noagenda_cari').trigger('click');
    }
    
    $(document).on("keyup", ".rab", function() {
        var sum = 0;
        $(".rab").each(function(){
            sum += +$(this).val().replace(/,/g, '');
        });
        $("#rp_rab").val(parseFloat(sum).toLocaleString('en'));

        console.log('BP', $("#rp_bp").val().replace(/,/g, ''));
        console.log('RAB', $("#rp_rab").val().replace(/,/g, ''));

        if(parseFloat($("#rp_bp").val().replace(/,/g, '')) >= parseFloat($("#rp_rab").val().replace(/,/g, ''))){
            $('#status_rab').html('<span class="label label-pill label-success">BP > RAB</span>');
        }else{
            $('#status_rab').html('<span class="label label-pill label-warning">BP < RAB</span>');
        }
    });


    $('#btn_simpan').click(function(){
        console.log($('#input_rab').serialize());
        $('div.content-body').block({ message: 'Menyimpan data...' });
        $.post('../controller/pemasaran/simpanRAB.php', $('#input_rab').serialize(), function(data){
            console.log(data);

            $.notify({
            // options
                message: data.msg 
            },{
                type: (data.success)?'success':'warning', 
                offset: {
                    y: 20, 
                    x: 320
                },
                spacing: 5,
                z_index: 1031,
                delay: 4000,
                timer: 1000,
                placement: {
                    from: 'top', 
                    align: 'right'
                },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });

            $('div.content-body').unblock();
        }, 'json' );

    });




})(jQuery);