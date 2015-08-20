/**
 * Created by rana7cse on 8/18/2015.
 */
$(function(){
    // Initialize the utility functions or plugin.
    $('#newOrdDate,#payOrderDate').pickadate({
        max: new Date(),
        closeOnSelect: true,
        format: 'yyyy-mm-dd'
    });

    $('#show_modal_Order').click(function(){
        $('#modal_newOrder').openModal();
        $('#newOrderSupp').chosen();
    });

    //------------ All Order List Datatable -------------
    $('#table_listOrders').dataTable({
        "ajax": '/order/all',
        "bDestroy": true,
        "fnRowCallback": function(e,m){
            $('td:eq(5)',e).html(
                "<a href='javascript:void(0)' class='data_pro_edit' onclick='orderView("+m[0]+")'>View</a>" +
                "<a href='javascript:void(0)' class='data_pro_edit' onclick='orderPay("+m[0]+")'>Pay</a>" +
                "<a href='javascript:void(0)' class='data_pro_del' onclick='orderDel("+m[0]+")'>Delete</a>"
            );
        }
    });

    //----------Make a order-----------
    $('#newOrderPayment').keyup(function(){
        var ammount = $('#newOrderAmmount').val();
        var payment = $(this).val();
        $('#newOrderDue').val(parseInt(ammount)-parseInt(payment));
    });

    $('#form_newOrder').validate({
        rules : {
            newOrdDate : {
                required : true,
                date : true
            },
            newOrderSupp : {
                required : true
            },
            newOrderComment : {
                required : true
            },
            newOrderAmmount : {
                required : true,
                number : true
            },
            newOrderPayment : {
                required : true,
                number : true
            },
            newOrderDue : {
                number : true
            }
        }
    });
    $('#btn_newOrder').click(function(){
        $('#form_newOrder').submit();
    });
    $('#form_newOrder').submit(function(){
        if($(this).valid()){
            //console.log($(this).serializeObject());
            $.post('/order/make',$(this).serializeObject(),function(e){
               var res = JSON.parse(e);
                if(res.order === 1 && res.payment === 1){
                    Materialize.toast("Order #ID("+res.id+") & Payment Created",2000);
                    $('#form_newOrder input, #form_newOrder select, #form_newOrder textarea').val('');
                } else if(res.order === 1 && res.payment === 0){
                    Materialize.toast("Order #ID("+res.id+") Created");
                    $('#form_newOrder input, #form_newOrder select, #form_newOrder textarea').val('');
                } else {
                    Materialize.toast("Some Thing Wrong Please Submit Again");
                }
            });
        }
    });
});


//---- View Order ---------
function orderView(id){
    $('#modal_viewOrder').openModal();
    $('#form_viewOrder input').attr('readonly',true);
    $.get('/order/'+id,function(e){
        $('#viewOrderId').html(e.id);
        $('#viewOrdDate').val(e.date);
        $('#viewOrderSupp').val(e.supplier_id);
        $('#viewOrderCmnt').val(e.comment);
        $('#viewOrderAmnt').val(e.ammount);
        $('#viewOrderPay').val(e.pay);
        $('#viewOrderDue').val(e.due);
    });
}

//---- Delete Order ---------
function orderDel(id){
    Materialize.toast(
        "Do you wanted to delete ? <a href='javascript:void(0)' class='is_delete' onclick='confOrderDel("+id+")'>Yes</a>",
        2000);
}

function confOrderDel(id){
    $.get('/order/del/'+id,function(e){
        Materialize.toast(e,2000);
        $('#table_listOrders').dataTable({
            "ajax": '/order/all',
            "bDestroy": true,
            "fnRowCallback": function(e,m){
                $('td:eq(5)',e).html(
                    "<a href='javascript:void(0)' class='data_pro_edit' onclick='orderView("+m[0]+")'>View</a>" +
                    "<a href='javascript:void(0)' class='data_pro_edit' onclick='orderPay("+m[0]+")'>Pay</a>" +
                    "<a href='javascript:void(0)' class='data_pro_del' onclick='orderDel("+m[0]+")'>Delete</a>"
                );
            }
        });
    });
}

//-------- Make Payment To Order ---------
function orderPay(id){
    $('#panel_orderPayment').css('display','block');
    setTimeout(function(){
        $('#panel_orderPayment').addClass('on');
    },200);
    $.get('/order/'+id,function(e){
        $('#order_pay_billed').html(e.ammount+' tk');
        $('#order_X_date').html(e.date);
        $('#payOrderSuppid').val(e.supplier_id);
        $('#payOrderId').val(e.id);
        $.get('/supplier/'+ e.supplier_id,function(k){
           $('#order_pay_to').html(k.supp_name);
        });

        $('#payOrderPay').val(0)
            .attr('data-pay', e.pay);

        $('#payOrderDue').val(e.due)
            .attr('readonly',true);

        $('#payOrderPrvDue').val(e.due)
            .attr('readonly',true);
    });
};

$('#payOrderPay').keyup(function(){
    var curDue = $('#payOrderPrvDue').val();
    var pay = $(this).val();
    var prvPay = $('#payOrderPay').attr('data-pay');
    $('#payOrderDue').val(parseInt(curDue)-parseInt(pay));
    $('#payOrderCurPay').val(parseInt(prvPay)+parseInt(pay));
});

$('#p_oP_close').click(function(){
    $('#panel_orderPayment').css('display','none')
        .removeClass('on');
});

//-----Submit Pay Order -------
$('#form_payMent_Order').validate({
    rules : {
        payOrderDate : {
            required : true
        },
        payOrderPay : {
            required : true,
            number : true
        },
        payOrderDue : {
            number : true
        }
    }
})

$('#p_oP_submit').click(function(){
    $('#form_payMent_Order').submit();
});

$('#form_payMent_Order').submit(function(){
    if($(this).valid()){
        $.post('/order/pay',$(this).serializeObject(),function(e){
            var res = JSON.parse(e);
            if(res.pay === 1 && res.order === 1){
                Materialize.toast('Payment Successful and due updated',2000);
            } else if(res.pay === 1 && res.order === 0){
                Materialize.toast('Payment Successful',2000);
            } else{
                Materialize.toast('Something Wrong ! Try again. ',2000);
            }
            $('#panel_orderPayment').css('display','none')
                .removeClass('on');
        });
    }
});

//--------- Utility Functions ---------

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
