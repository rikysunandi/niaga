$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    $('#tbl_saldo_up3').DataTable( {
        ajax: '../controller/getDataSaldoUP3.php?unitupi=53',
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv'
        ],
        "scrollY": 400,
        "scrollX": true,
        // initComplete: function () {
        //     this.api().columns().every( function () {
        //         var column = this;
        //         var select = $('<select><option value=""></option></select>')
        //             .appendTo( $(column.footer()).empty() )
        //             .on( 'change', function () {
        //                 var val = $.fn.dataTable.util.escapeRegex(
        //                     $(this).val()
        //                 );
 
        //                 column
        //                     .search( val ? '^'+val+'$' : '', true, false )
        //                     .draw();
        //             } );
 
        //         column.data().unique().sort().each( function ( d, j ) {
        //             select.append( '<option value="'+d+'">'+d+'</option>' )
        //         } );
        //     } );
        // }
    });

});