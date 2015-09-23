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
            "iDisplayLength": 100,
            "fnRowCallback": function(e,m,j){
                $('td:eq(10)',e).html(
                    "<a href='javascript:void(0)' class='data_pro_edit' onclick='printInvoice("+m[0]+")'>Print</a>"
                )
            }
        })
        $('#filter_date_to').html(todate+" from "+formDate);
    });
});


function printInvoice(id){
    $.get('/invoice/'+id,function(e){
        //-------------- Info Set Customar ----------
        $('#rp_sold_date').html(e.sold_info.sold_date);
        $('#rp_cus_name').html(e.customar_info.first_name+" "+ e.customar_info.last_name);
        $('#rp_cus_f_name').html(e.customar_info.fat_name);
        $('#rp_cus_id').html(e.customar_info.id);
        $('#rp_cus_add').html(e.customar_info.address);
        $('#rp_cus_phone').html(e.customar_info.phone);
        //------------ Product Quad -------
        $('#rp_pro_name').html(e.product.product_name);
        $('#rp_pro_cc').html(e.product.bike_cc);
        $('#rp_pro_eng_no').html(e.product.eng_no);
        $('#rp_pro_chs_no').html(e.product.chs_no);
        $('#rp_pro_model').html(e.product.model);
        //------------- Price Info -------
        $('#rp_bill_price').html(e.sold_info.price);
        $('#rp_bill_vat').html(e.sold_info.vat);
        $('#rp_bill_Bcharge').html(e.sold_info.bank_int);
        $('#rp_bill_total').html(e.sold_info.total_billed);
        $('#rp_bill_paid').html(e.sold_info.paid);
        $('#rp_bill_due').html(e.sold_info.due);
        //---------------------- Due Print -----------
        var is_due = (e.sold_info.payment_status == 'cash') ? false : true ;
        if(is_due){
            var instNo = e.sold_info.installments;
            var instRate = e.loan_info.rate;
            var startDate = e.sold_info.sold_date;
            var markup = "";
            for( i=0 ; i<Math.ceil(instNo/4) ; i++ ){
                markup += "<table>" +
                    "<tr>" +
                    "<th>SN</th>" +
                    "<th>Date</th>" +
                    "<th>rate</th>" +
                    "</tr>";
                for( j=(i*4) ; j<Math.min(((i*4)+4),instNo) ; j++ ){
                    var instDate = addDate(startDate,(j+1));
                    markup += "<tr>" +
                        "<td>"+(j+1)+"</td>" +
                        "<td>"+instDate+"</td>" +
                        "<td>"+instRate+"</td>" +
                        "</tr>";
                }
                markup += "</table>";
            }
            //End For Table
            $('#rp_installment_set').html(markup);
        }else{
            $('#rp_installment_set').html("No Interest Set");
        }
        $('body').html($('#cashReport').html());
        window.print();
    });
}

function addDate(dstr,of){
    var date = new Date(dstr);
    var nexDate = new Date(date);
    nexDate.setMonth(nexDate.getMonth()+of)
    var newDate = new Date(nexDate);
    return newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate();
}