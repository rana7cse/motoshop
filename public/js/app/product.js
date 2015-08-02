function _validImage(file){
    switch(file.type){
        case "image/png" : return true;
        case "image/jpeg" : return true;
        case "image/gif" : return true;
        default : return false;
    }
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

/**
 * Edit Data Table Data Product,
 */

function productEdit(evt){
    var id = $(evt).attr('data-product-id');
    $.get('/product/'+id,function(e){
        $('#EditProductDialog').openModal();
        $('#EditProductDialog').find('#editProName').val(e.product_name);
        $('#EditProductDialog').find('#editVisiblility').val(e.product_visibility);
        $('#EditProductDialog').find('#editProductId').val(e.id);
    });
}

$('#ProductEditFrom').submit(function(){
    var data = $(this).serializeObject();
    $.post('/product/update',data,function(e){
        var status = JSON.parse(e);
        if(status.error == 0 && status.success == 1){
            //console.log('ye Updated');
            $('#EditProductDialog').closeModal()
            Materialize.toast("Successfully Product Updated",4000);
            $('#proTable').dataTable({
                "ajax": '/product',
                "bDestroy": true,
                "fnRowCallback" : function(e,m,j){
                    var activ = (m[2] == '1')? "Active" : "Inactive";
                    $('td:eq(4)',e).html(
                        "<a href='javascript:void(0)' class='data_pro_edit' onclick='productEdit(this)' data-product-id='"+m[0]+"'>Edit</a>" +
                        "<a href='javascript:void(0)' class='data_pro_del' onclick='productDel(this)' data-product-id='"+m[0]+"'>delete</a>"
                    );
                    $('td:eq(2)',e).html("<span class='col_activity'>"+activ+"</span>");
                },
                "columnDefs": [
                    { "width": "25px", "targets": 0 },
                    { "width": "75px", "targets": 2 },
                    { "width": "75px", "targets": 4 }
                ],
                "iDisplayLength": 100,
                "order": [[ 0, "desc" ]]
            });
        } else {
            Materialize.toast("Hey Please check again and submit later For Update",4000);
        }
    });
})

/**
 * Delete Data Table Data Product,
 */

function productDel(evt){
    var id = $(evt).attr('data-product-id');
    Materialize.toast(
        "Are Your For Delete the Product? <a href='javascript:void(0)' class='is_delete' onclick='delConfirm("+id+")'>Yes</a>",
        2000);
}

function delConfirm(id){
    $.get("/product/delete/"+id,function(e){
       Materialize.toast(e,1000);
        $('#proTable').dataTable({
            "ajax": '/product',
            "bDestroy": true,
            "fnRowCallback" : function(e,m,j){
                var activ = (m[2] == '1')? "Active" : "Inactive";
                $('td:eq(4)',e).html(
                    "<a href='javascript:void(0)' class='data_pro_edit' onclick='productEdit(this)' data-product-id='"+m[0]+"'>Edit</a>" +
                    "<a href='javascript:void(0)' class='data_pro_del' onclick='productDel(this)' data-product-id='"+m[0]+"'>delete</a>"
                );
                $('td:eq(2)',e).html("<span class='col_activity'>"+activ+"</span>");
            },
            "columnDefs": [
                { "width": "25px", "targets": 0 },
                { "width": "75px", "targets": 2 },
                { "width": "75px", "targets": 4 }
            ],
            "iDisplayLength": 100,
            "order": [[ 0, "desc" ]]
        });
    });
}

$(function(){
    //Product ENtry
    //Product Create
    $('#doImageUpload').click(function(){
        var file = $('#product_image')[0].files[0];
        if(_validImage(file) && file.size < 512000){
            var myData = new FormData();
            myData.append('my_image',file);

            $.ajax({
                url: 'http://localhost/eshop/public/product/image_upload',
                data: myData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(e){
                   var data = JSON.parse(e);
                    $('#image_name').val(data['name']);
                }
            });
        }else{
            alert('PLease select a valid file');
            return 0;
        }
    });

    $('#product_image').change(function(){
        $('#image_progress').css('width','0%');
        if(_validImage($('#product_image')[0].files[0])){
            var fileRead = new FileReader();
            fileRead.onload = function(e){
                $('#show_image_upload').attr('src',e.target.result);
            };
            fileRead.readAsDataURL($('#product_image')[0].files[0]);
        }else{
            alert("Please Check Your File Format (jpg,jpeg,png,gif)");
            $('#product_image').val('');
            $('#show_image_upload').attr('src','#');
        }
    });

    //Product Inserted;
    //
    // Product Insert In The Database;
    $('#newProductAdd').submit(function(){
        var data = $('#newProductAdd').serializeObject();
        $.post('http://localhost:8000/product/create',data,function(e,f,g){
            var status = JSON.parse(e);
            if(status.error == 0 && status.success == 1){
                $('#newProductAdd input').val('');
                Materialize.toast("Successfully Product Inserted",4000);
                $('#proTable').dataTable({
                    "ajax": '/product',
                    "bDestroy": true,
                    "fnRowCallback" : function(e,m,j){
                        var activ = (m[2] == '1')? "Active" : "Inactive";
                        $('td:eq(4)',e).html(
                            "<a href='javascript:void(0)' class='data_pro_edit' onclick='productEdit(this)' data-product-id='"+m[0]+"'>Edit</a>" +
                            "<a href='javascript:void(0)' class='data_pro_del' onclick='productDel(this)' data-product-id='"+m[0]+"'>delete</a>"
                        );
                        $('td:eq(2)',e).html("<span class='col_activity'>"+activ+"</span>");
                    },
                    "columnDefs": [
                        { "width": "25px", "targets": 0 },
                        { "width": "75px", "targets": 2 },
                        { "width": "75px", "targets": 4 }
                    ],
                    "iDisplayLength": 100,
                    "order": [[ 0, "desc" ]]
                });
            } else {
                Materialize.toast("Hey Please check again and submit later",4000);
            }
        });
    });
    $('#submitProductCrt').click(function(){
        $('#newProductAdd').submit();
    });


    /*
    * Product Select and Edition;
    * */

    $('#proTable').dataTable({
        "ajax": '/product',
        "bDestroy": true,
        "fnRowCallback" : function(e,m,j){
            var activ = (m[2] == '1')? "Active" : "Inactive";
            $('td:eq(4)',e).html(
                "<a href='javascript:void(0)' class='data_pro_edit' onclick='productEdit(this)' data-product-id='"+m[0]+"'>Edit</a>" +
                "<a href='javascript:void(0)' class='data_pro_del' onclick='productDel(this)' data-product-id='"+m[0]+"'>delete</a>"
            );
            $('td:eq(2)',e).html("<span class='col_activity'>"+activ+"</span>");
        },
        "columnDefs": [
            { "width": "25px", "targets": 0 },
            { "width": "75px", "targets": 2 },
            { "width": "75px", "targets": 4 }
        ],
        "iDisplayLength": 100
    });

});
