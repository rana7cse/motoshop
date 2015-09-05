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

    //------------ Print Sell Product -----------
});
