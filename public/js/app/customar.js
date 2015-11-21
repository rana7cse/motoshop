$(function(){

      /*
      * INIT CUSTOMAR TABLE
      * */
    loadCustomers();


    /*
    * Add Customar Starts
    * */

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
            cusAddThana : "required",
            cusAddZilla : "required",
            cusAddDivision : "required"
        }
    });

    $('#form_addCustomar').submit(function(){
        if($(this).valid()) {
            $.post('/customar_add', $(this).serializeObject(), function (e) {
                var status = JSON.parse(e);
                //console.log(e);
                if (status.error == 0 && status.success == 1) {
                    $('#form_addCustomar input,#form_addCustomar textarea').val('');
                    Materialize.toast("Successfully Customar Added", 3000);
                    loadCustomers();
                } else {
                    Materialize.toast("Sorry Submit Again Please", 3000);
                }
            });
        }
    });

    /*
     * Add Customar Ends
     * */

    /*
    * Update Customar Starts
    * */

    $('#form_updateCustomer').validate({
        rules : {
            edit_cusFirstName : {
                required: true,
                minlength: 2
            },
            edit_cusLastName : {
                required: true,
                minlength: 2,
            },
            edit_cusAddress : {
                required: true,
                minlength: 5
            },
            edit_cusEmail : {
                email: true
            },
            edit_cusPhone : {
                required: true,
                minlength: 11,
                maxlength: 13
            },
            edit_cusAddThana : "required",
            edit_cusAddZilla : "required",
            edit_cusAddDivision : "required"
        }
    });

    $('#btn_updateCustomer').click(function(){
        $('#form_updateCustomer').submit();
    });

    $('#form_updateCustomer').submit(function(){
        if($(this).valid()) {
            $.post('/customar/update',$(this).serializeObject(),function(e){
                var status = JSON.parse(e);
                //console.log(e);
                if (status.error == 0 && status.success == 1) {
                    $('#form_addCustomar input,#form_addCustomar textarea').val('');
                    Materialize.toast("Successfully Customer Updated", 4000);
                    $('#modal_editCustomer').closeModal();
                    loadCustomers();
                } else {
                    Materialize.toast("Check and Submit Again Please", 4000);
                }
            })
        }
    });


    /*
    * Update Customar Ends
    * */
});

function editCustomar(id){
    $.get('/customer/'+id,function(e){
        $('#modal_editCustomer').openModal();
        $('#ceditRowId').val(e.id);
        $('#edit_cusFirstName').val(e.first_name);
        $('#edit_cusFatName').val(e.fat_name);
        $('#edit_cusAddress').val(e.address);
        $('#edit_cusAddThana').val(e.thana);
        $('#edit_cusAddZilla').val(e.zilla);
        $('#edit_cusAddDivision').val(e.division);
        $('#edit_cusEmail').val(e.email);
        $('#edit_cusPhone').val(e.phone);
        $('#edit_cusPhone2').val(e.phone2);
    });
}

function delCustomar(id){
    Materialize.toast(
        "Do you wanted to delete ? <a href='javascript:void(0)' class='is_delete' onclick='customarDel("+id+")'>Yes</a>",
        2000);
}

function customarDel(id){
    $.get('/customer/del/'+id,function(e){
        Materialize.toast(e,2000);
        loadCustomers();
    });
}

function loadCustomers(){
    $('#customarTable').dataTable({
        "ajax": '/customar_all',
        "bDestroy": true,
        "fnRowCallback": function(e,m,j){
            $('td:eq(6)',e).html(
                "<a href='javascript:void(0)' class='data_pro_edit' onclick='editCustomar("+m[0]+")'>Edit</a>" +
                "<a href='javascript:void(0)' class='data_pro_del' onclick='delCustomar("+m[0]+")'>Delete</a>"
            );
        }
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
