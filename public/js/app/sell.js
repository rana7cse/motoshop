var sellX = {
    customar : 0,
    product : 0,
    isDue : false,
    payment_info : 0,

    setCustomar : function(input){
        this.customar = input;
    },
    setProduct : function(input){
      this.product = input;
    },
    getCustomar : function(){
        return this.customar;
    },
    getProduct : function(){
        return this.product;
    }
};

$(function(){
    //------ Load Customer List --------
    $.get('/customar_all',function(e){
        var lists = JSON.parse(e).data;
        lists.map(function(k){
            $('#searchCustomar').append("" +
                "<option value='"+k[0]+"'>" +
                k[1] + " ( " +k[2]+" ) "+
                "</option>");
        });
        $('#searchCustomar').chosen();
    });

    //------ Load Product list --------
    $.get('/product',function(e){
        var op = JSON.parse(e).data;
        op.map(function(k){
            $('#search_product_name').append("" +
                "<option value='"+k[0]+"'>" + k[1] +
                "</option>");
        });
        $('#search_product_name').chosen();
    });

    //---Search Product By Name----
    $('#search_product_name').change(function(){
       var id = $(this).val();
        if(id == ""){
            id = 0;
        }

        $('#table_product_avail').dataTable({
            "ajax": '/inventory/prosearch/'+id,
            "bDestroy": true,
            "bPaginate": false,
            "iDisplayLength": 200,
            "fnRowCallback": function(e,m,j){
                $('td:eq(5)',e).html(
                    "<a href='javascript:void(0)' class='data_pro_del' onclick='productAdd("+m[0]+")'>Select</a>"
                );
            }
        });
    });

    //-------Select Customar---------
    $('#searchCustomar').change(function(){
        var id = $(this).val();
        if(id != ""){
            $.get('/customer/'+id,function(e){
                sellX.setCustomar(e);
                $('#cus_name').html(e.first_name +" "+ e.last_name);
                $('#cus_email').html(e.email);
                $('#cus_phone').html(e.phone);
            });
        } else {
            $('#cus_name').html("NA");
            $('#cus_email').html("NA");
            $('#cus_phone').html("NA");
            $('#searchCustomar').val('');
            sellX.setCustomar(0);
        }
    });

    // --- Select Product -----------

    //----- Clear Customar And Product -------
    $('#clearCustomer').click(function(){
        $('#cus_name').html("NA");
        $('#cus_email').html("NA");
        $('#cus_phone').html("NA");
        $('#searchCustomar').val('');
        sellX.setCustomar(0);
    });

    $('#clearProduct').click(function(){
        $('#pro_name').html("NA");
        $('#pro_eng').html("NA");
        $('#pro_chs').html("NA");
        $('#pro_rate').html('00.00');
        $('#payAblePrice').html('00.00');
        sellX.setProduct(0);
    });

    //---- Make Payment ---------
    $('#sell_payment').click(function(){
        if(sellX.payment_info == 0){
            if(sellX.getCustomar() == 0){
                Materialize.toast('Please Select Customar',2000);
            } else if(sellX.getProduct() == 0){
                Materialize.toast('Please Select Product',2000);
            } else {
                $('#modal_product_sell').openModal();
                var customar = sellX.getCustomar();
                var product = sellX.getProduct();
                $('#payCusName').html(customar.first_name+" "+customar.last_name);
                $('#payCusPhone').html(customar.phone);
                $('#payCusId').html(customar.id);
                $('#payCusEmail').html(customar.email);

                $('#payProName').html(product.product_name);
                $('#payProEngNo').html(product.eng_no);
                $('#payProChsNo').html(product.chs_no);
                $('#payProRate').html(product.sell_rate + "tk");
                $('#frm_payable').val(product.sell_rate);
                $('#frm_ammount,#frm_due,#frm_due,#frm_inst_rate,#frm_payVat,#frm_payInt').val(0);
                $('#frm_inst_no').val(1);
                $('#totalBilled').html(product.sell_rate);
            }
        } else {
            Materialize.toast('You already Paid Out !',3000);
        }
    });

    $('#frm_payVat').keyup(function(){
        $('#totalBilled').html(parseInt($('#frm_payable').val())+parseInt($('#frm_payInt').val())+parseInt($(this).val()))
    });
    $('#frm_payInt').keyup(function(){
        $('#totalBilled').html(parseInt($('#frm_payable').val())+parseInt($('#frm_payVat').val())+parseInt($(this).val()))
    });

    $('#frm_ammount').keyup(function(){
        $('#frm_due').val(parseInt($('#totalBilled').html())-parseInt($(this).val()));
    });

    $('#frm_inst_no').keyup(function(){
        $('#frm_inst_rate').val(parseInt(parseInt($('#frm_due').val())/parseInt($(this).val())));
    });

    $('#install_ment_count').hide();
    $('#payment_status').change(function(){
        if($(this).val() == 'due'){
            $('#install_ment_count').show();
            sellX.isDue = true;
        } else {
            $('#install_ment_count').hide();
            $('#install_ment_count input[type=text]').val('');
            sellX.isDue = false;
        }
    });

    //--------- Submit Payment ----------
    $('#form_sell_payment').validate({
        rules : {
            payment_status : {
                required : true
            },
            frm_ammount : {
                required : true,
                number : true,
                minlength: 3
            },
            frm_inst_no : {
                number : true,
                maxlength: 3
            }
        }
    });

    $('#btn_payment_send').click(function(){
        if($('#form_sell_payment').valid()){
            var data = $('#form_sell_payment').serializeObject();
            data['total_bill'] = $('#totalBilled').html();
            data['cus_id'] = sellX.customar.id;
            data['inv_id'] = sellX.product.id;
            data['is_due'] = sellX.isDue;
            $.post('/sell/make',data,function(e){
                if(e.data == 0 && e.status == 0){
                    Materialize.toast(e.massage,2000);
                } else if(e.data != 0 && e.status == 1){
                    $('#modal_product_sell').closeModal();
                    Materialize.toast(e.massage,2000);
                    sellX.payment_info = e.data;
                    $('#table_product_avail').dataTable({
                        "ajax": '/inventory/prosearch/'+$('#search_product_name').val(),
                        "bDestroy": true,
                        "bPaginate": false,
                        "iDisplayLength": 200,
                        "fnRowCallback": function(e,m,j){
                            $('td:eq(5)',e).html(
                                "<a href='javascript:void(0)' class='data_pro_del' onclick='productAdd("+m[0]+")'>Select</a>"
                            );
                        }
                    });
                } else {
                    Materialize.toast('Something Wrong Please Contact Web Master',3000);
                }
            });
        } else {
            Materialize.toast('You Already Paid Out',2000);
        }
    });

    //------ Print Sell Report----------

    $('#print_report').click(function(){
        if(sellX.payment_info != 0){
            var customar = sellX.customar;
            var product = sellX.product;
            var info = sellX.payment_info;
            var soldInfo = info.sold_info;
            $('#rp_sold_date').html(soldInfo.sold_date);
            //---------| Show Customer Information |-------
            $('#rp_cus_id').html(customar.id);
            $('#rp_cus_name').html(customar.first_name+" "+customar.last_name);
            $('#rp_cus_add').html(customar.address);
            $('#rp_cus_f_name').html(customar.fat_name);
            $('#rp_cus_phone').html(customar.phone+", "+customar.phone2);
            //---------| Product information block |--------
            $('#rp_pro_name').html(product.product_name);
            $('#rp_pro_cc').html(product.bike_cc);
            $('#rp_pro_model').html(product.model);
            $('#rp_pro_eng_no').html(product.eng_no);
            $('#rp_pro_chs_no').html(product.chs_no);
            //------------| Billed Info |---------------
            $('#rp_bill_price').html(soldInfo.moto_price);
            $('#rp_bill_vat').html(soldInfo.vat);
            $('#rp_bill_Bcharge').html(soldInfo.bank_int);
            $('#rp_bill_total').html(soldInfo.total_billed);
            $('#rp_bill_paid').html(soldInfo.paid);
            $('#rp_bill_due,#dec_due').html(soldInfo.due);
            //-----------| Installment Table |----------
            if(sellX.isDue){
                var instNo = soldInfo.total_inst;
                var instRate = soldInfo.rate;
                var startDate = soldInfo.sold_date;
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
            //------------|-----|-----|-----------------
            $('body').html($('#cashReport').html());
            window.print();
        }else{
            Materialize.toast('Please Pay First',2000);
        }
    });
    window.onafterprint = function(){
        window.location.reload(true);
    }

    //----------------- Customar Addition -------------
    $('#show_customar_modal').click(function(){
        $('#modal_addCustomar').openModal();
    });

    $('#btn_addCustomar').click(function(){
        $('#form_addCustomar').submit();
    });

    $('#form_addCustomar').validate({
        rules : {
            cusFirstName : {
                required: true,
                minlength: 2
            },
            cusLastName : {
                required: true,
                minlength: 2,
            },
            cusAddress : {
                required: true,
                minlength: 5
            },
            cusEmail : {
                email: true
            },
            cusPhone : {
                required: true,
                minlength: 11,
                maxlength: 13
            },
            cusFatName : {
                required: true,
                minlength: 2
            }
        }
    });

    $('#form_addCustomar').submit(function(){
        if($(this).valid()) {
            $.post('/customar_add', $(this).serializeObject(), function (e) {
                var status = JSON.parse(e);
                if (status.error == 0 && status.success == 1) {
                    $('#form_addCustomar input,#form_addCustomar textarea').val('');
                    Materialize.toast("Successfully Customar Added", 2000);
                    $.get('/customer/'+status.id,function(e){
                        sellX.setCustomar(e);
                        $('#cus_name').html(e.first_name +" "+ e.last_name);
                        $('#cus_email').html(e.fat_name);
                        $('#cus_phone').html(e.phone);
                    });
                } else {
                    Materialize.toast("Sorry Submit Again Please", 2000);
                }
            });
        }
    });


});

//product added from product list;
function productAdd(id){
    $.get('/inventory/prosel/'+id,function(e){
        var pro = e[0];
        $('#pro_name').html(pro.product_name);
        $('#pro_eng').html(pro.eng_no);
        $('#pro_chs').html(pro.chs_no);
        $('#pro_rate').html(pro.sell_rate);
        $('#payAblePrice').html(pro.sell_rate);
        sellX.setProduct(pro);
    });
}

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

//-------------- Add month for Installment -----------------

function addDate(dstr,of){
    var date = new Date(dstr);
    var nexDate = new Date(date);
    nexDate.setMonth(nexDate.getMonth()+of)
    var newDate = new Date(nexDate);
    return newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate();
}

