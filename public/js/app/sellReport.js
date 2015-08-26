$(function(){
    var now = new Date();
    var nowSec = new Date(now.getTime()-(7 * 24 * 60 * 60 * 1000));
    var today = now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate();
    var dayminus7 = nowSec.getFullYear()+"-"+(nowSec.getMonth()+1)+"-"+nowSec.getDate();

    $('#sellFilterFormdate,#sellFilterTOdate').pickadate({
        selectMonths: true,
        selectYears: 15,
        format: 'yyyy-mm-dd',
        max : 1
    });

    $('#filter_date_to').html(dayminus7+" from "+today);
        $('#sellReportTable').dataTable({
            'ajax' : '/sell/'+dayminus7+'/'+today,
            "bDestroy": true,
            "iDisplayLength": 100
        });

    $('#sellFilterBtn').click(function(){
        var todate = $('#sellFilterTOdate').val();
        var formDate = $('#sellFilterFormdate').val();
        $('#sellReportTable').dataTable({
            'ajax' : '/sell/'+todate+'/'+formDate,
            "bDestroy": true,
            "iDisplayLength": 100
        })
        $('#filter_date_to').html(todate+" from "+formDate);
    });
});
