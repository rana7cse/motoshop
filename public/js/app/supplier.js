$(function(){

    /*
     * INIT CUSTOMAR TABLE
     * */
    $('#table_listSupplier').dataTable({
        "ajax": '/supplier/all',
        "bDestroy": true,
        "fnRowCallback": function(e,m,j){
            $('td:eq(6)',e).html(
                "<a href='javascript:void(0)' class='data_pro_edit' onclick='editSupplier("+m[0]+")'>Edit</a>" +
                "<a href='javascript:void(0)' class='data_pro_del' onclick='delSupplier("+m[0]+")'>Delete</a>"
            );
        }
    });


    /*
     * Add Customar Starts
     * */

    $('#show_newSupplier').click(function(){
        $('#modal_newSupplier').openModal();
    });

    $('#btn_newSupplier').click(function(){
        $('#form_newSupplier').submit();
    });

    $('#form_newSupplier').validate({
        rules : {
            newSupName : {
                required: true,
                minlength: 2
            },
            newSupAdd : {
                required: true,
                minlength: 2,
            },
            newSupEmail : {
                email: true
            },
            newSupPhone : {
                required: true,
                minlength: 11,
                maxlength: 13
            },
            newSupPhone2 : {
                minlength: 11,
                maxlength: 13
            }
        }
    });

    $('#form_newSupplier').submit(function(){
        if($(this).valid()) {
            $.post('/supplier/add', $(this).serializeObject(), function (e) {
                var status = JSON.parse(e);
                if (status.error == 0 && status.success == 1) {
                    $('#form_newSupplier input,#form_newSupplier textarea').val('');
                    Materialize.toast("Successfully Supplier Added", 4000);
                } else {
                    Materialize.toast("Sorry Submit Again Please", 4000);
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

    $('#form_updateSupplier').validate({
        rules : {
            editSupName : {
                required: true,
                minlength: 2
            },
            editSupAdd : {
                required: true,
                minlength: 2,
            },
            editSupEmail : {
                email: true
            },
            editSupPhone : {
                required: true,
                minlength: 11,
                maxlength: 13
            },
            editSupPhone2 : {
                minlength: 11,
                maxlength: 13
            }
        }
    });

    $('#btn_updateSupplier').click(function(){
        $('#form_updateSupplier').submit();
    });

    $('#form_updateSupplier').submit(function(){
        if($(this).valid()) {
            $.post('/supplier/update',$(this).serializeObject(),function(e){
                var status = JSON.parse(e);
                if (status.error == 0 && status.success == 1) {
                    $('#form_addCustomar input,#form_addCustomar textarea').val('');
                    Materialize.toast("Successfully Customer Updated", 4000);
                } else {
                    Materialize.toast("Check and Submit Again Please", 4000);
                }
            });
        }
    });


    /*
     * Update Customar Ends
     * */
});

function editSupplier(id){
    $.get('/supplier/'+id,function(e){
        $('#modal_editSupplier').openModal();
        $('#editSupRowId').val(e.id);
        $('#editSupName').val(e.supp_name);
        $('#editSupType').val(e.supp_type);
        $('#editSupAdd').val(e.supp_add);
        $('#editSupEmail').val(e.email);
        $('#editSupPhone').val(e.contact_f);
        $('#editSupPhone2').val(e.contact_s);
        $('#editSupMgm').val(e.supp_mgm);
    });
}

function delSupplier(id){
    Materialize.toast(
        "Do you wanted to delete ? <a href='javascript:void(0)' class='is_delete' onclick='supplierDel("+id+")'>Yes</a>",
        2000);
}

function supplierDel(id){
    $.get('/supplier/del/'+id,function(e){
        Materialize.toast(e,2000);
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