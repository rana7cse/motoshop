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

function callDataTable(){
    $('#inventTable').dataTable({
        "ajax": '/inventory/all',
        "bDestroy": true,
        "fnRowCallback": function(e,m,j){
            $('td:eq(8)',e).html(
                "<a href='javascript:void(0)' class='data_pro_edit' onclick='inventoryEdit(this)' data-product-id='"+m[0]+"'>Edit</a>" +
                "<a href='javascript:void(0)' class='data_pro_del' onclick='inventoryDel(this)' data-product-id='"+m[0]+"'>Delete</a>"
            );
        }
    });
}

/*
* Edit Product In Inventory Buy
* */

function inventoryEdit(id){
    var id = $(id).attr('data-product-id');
    $.get('/inventory/'+id,function(e){
        $('#inventoryModalEdit').openModal();
        $('#editEngineNo').val(e.eng_no);
        $('#edit_chs_no').val(e.chs_no);
        $('#edit_pro_color').val(e.color);
        $('#edit_pro_name').val(e.product_id);
        $('#edit_pro_buy_rate').val(e.buy_rate);
        $('#edit_pro_sell_rate').val(e.sell_rate);
        $('#edit_pro_supplier').val(e.supplyir_id);
        $('#editRowId').val(e.id);
    })
}

function inventoryDel(id){
    var id = $(id).attr('data-product-id');
    Materialize.toast(
        "Do you wanted to delete ? <a href='javascript:void(0)' class='is_delete' onclick='inventoryDeleteConfirm("+id+")'>Yes</a>",
        2000);
}

function inventoryDeleteConfirm(id){
    $.get('/inventory/delete/'+id,function(e){
        Materialize.toast(e,2000);
    });
}


$(function(){
    /* * Showing On all Tables*/
    callDataTable();
    $('#tableRefreach').click(function(){
        callDataTable();
        Materialize.toast('Table Reloaded ! Thanks :)',2000);
    });

    /*Add Product On Your Inventory*/
    $('#btn_stock_in').click(function(){
        $('#modal_stock_in').openModal();
        $('#pro_name').chosen();
    });

    /*Submit Form Onclick Submit Button*/
    $('#submit_stock_in_form').click(function(){
        $('#stock_insert_form').submit();
    });

    /*Form Validation On FOrm Submit*/
    $('#stock_insert_form').validate({
        rules : {
            eng_no : "required",
            chs_no : "required",
            pro_name : "required"
        }
    });

    $('#stock_insert_form').on('submit',function(){
        if($(this).valid()){
            var data = $(this).serializeObject();
            $.post('/inventory/create',data,function(e){
                var status = JSON.parse(e);
                if(status.error == 0 && status.success == 1) {
                    $('#stock_insert_form input').val('');
                    Materialize.toast("Successfully Inserted Your Product", 4000);
                } else {
                    Materialize.toast("Sorry Submit Again", 4000);
                }
            });
        }
    });

    /*Update Inventory Data*/

    $('#updateInventoryBtn').click(function(){
        $('#InventoryEditFrom').submit();
    });

    $('#InventoryEditFrom').validate({
       rules : {
           editEngineNo : "required",
           edit_chs_no : "required",
           edit_pro_name : "required"
       }
    });

    $('#InventoryEditFrom').submit(function(){
        if($(this).valid()){
            $.post('inventory/update',$(this).serializeObject(),function(e){
                var status = JSON.parse(e);
                if(status.error == 0 && status.success == 1) {
                    Materialize.toast("Successfully Entry Updated", 4000);
                } else {
                    Materialize.toast("Sorry Submit Again", 4000);
                }
            });
        }else{
            return 0;
        }
    })
});
