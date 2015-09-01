/**
 * Created by rana7cse on 9/1/2015.
 */
$(function(){
    $('#inst_Paydate').pickadate({
        min: new Date(),
        closeOnSelect: true,
        format: 'yyyy-mm-dd'
    });
    $('#table_installment_list').dataTable({
        "ajax": '/getInstllments',
        "bDestroy": true,
        "iDisplayLength": 100,
        "fnRowCallback": function(e,m,j){
            $('td:eq(8)',e).html(
                "<a href='javascript:void(0)' class='data_pro_del' onclick='payInst("+m[0]+")'>Pay</a>"
            );
        }
    });

    //------------ Make Payment --------------
    $('#form_payInst').validate({
        rules : {
            inst_Paydate : {
                required : true
            }
        }
    });

    $('#btn_payInstalment').click(function(){
        if($('#form_payInst').valid()){
            var data = $('#form_payInst').serializeObject();
            $.post('/makeInstalment',data,function(e){
                if(e.success == 1, e.error == 0){
                    $('#table_installment_list').dataTable({
                        "ajax": '/getInstllments',
                        "bDestroy": true,
                        "iDisplayLength": 100,
                        "fnRowCallback": function(e,m,j){
                            $('td:eq(8)',e).html(
                                "<a href='javascript:void(0)' class='data_pro_del' onclick='payInst("+m[0]+")'>Pay</a>"
                            );
                        }
                    });

                    Materialize.toast('Successfully Installment Paid',200);
                    $('#modal_payInstallment').closeModal();
                } else {
                    Materialize.toast('SomeThing Wrong Please Check',200);
                }
            })
        }
    })
});

function payInst(id){
    $('#modal_payInstallment').openModal();
    $.get('getLoanInfo/'+id,function(e){
        $('#loan_id_hd').val(e.id);
        $('#inst_date').val(e.next_pay_date);
        $('#inst_dueDay').val(0);
        $('#inst_payAmount').val(e.rate);
        $('#inst_payCharge').val(0);
        $('#inst_payTotal').val(e.rate);
        $('#inst_Paydate').val('');
    });
}

$('#inst_Paydate').change(function(){
    $('#inst_dueDay').val(daysBetween($('#inst_date').val(),$(this).val()));
});

$('#inst_payCharge').keyup(function(){
   $('#inst_payTotal').val(parseInt($('#inst_payAmount').val())+(parseInt($('#inst_dueDay').val())*parseInt($(this).val())));
});

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function daysBetween( firstDate, secDate ) {
    //Get 1 day in milliseconds
    var date1 = new Date(firstDate);
    var date2 = new Date(secDate);
    var one_day=1000*60*60*24;

    // Convert both dates to milliseconds
    var date1_ms = date1.getTime();
    var date2_ms = date2.getTime();

    // Calculate the difference in milliseconds
    var difference_ms = date2_ms - date1_ms;

    // Convert back to days and return
    return Math.round(difference_ms/one_day);
}