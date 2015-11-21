$(function(){
    //-------- Print Inventory Report -------------
    $('#print_inv_report').click(function(){
        $('#reportTableWrapper')
            .find('.title').show();
        $('#reportTableWrapper')
            .find('.print_hide').show();
        $('body').html($('#reportTableWrapper').html());
        window.print();
    });

    window.onafterprint = function(){
        window.location.reload(true);
    }

    //------------ Print Buy Report -----------
    $('#sellFilterTOdate,#sellFilterFormdate').pickadate({
        selectMonths: true,
        selectYears: 15,
        format: 'yyyy-mm-dd',
        max : 1
    });

    $('#print_buy_report').click(function(){
        $('#reportTableWrapper')
            .find('.title').show();
        $('#reportTableWrapper')
            .find('.print_hide').show();
        $('body').html($('#reportTableWrapper').html());
        window.print();
    });
    $('#inventory_report').dataTable({

    });
});
