@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2>Available Product Status</h2>
        </div>
        <div class="sectionX product_start">
            <div id="listProduct" class="tab_panel">
                <div class="title">Lists of all products here</div>
                <div class="report_table_inventory">
                    <table class="bordered striped" id="proTable">
                        <thead>
                        <tr>
                            <th width="50px">ID</th>
                            <th>Name</th>
                            <th width="100px">Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($report)>0)
                            @foreach($report as $list)
                                <tr>
                                    <td>$</td>
                                    <td><a href="javascript:void(0)" onclick="viewList({{$list->product_id}})">{{$list->product}}</a></td>
                                    <td><b>{{$list->total}}</b></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function(){
                   $('#proTable').dataTable();
                });
                function viewList(id){
                    $('#modal_show_item').openModal();
                    $.get('/inventory/available/'+id,function(e){
                        //console.log(e);
                        var outX = "";
                        var count = 0;
                        e.map(function(k){
                            outX += '<tr>';
                            outX += '<td>'+ (count+1) + '</td>';
                            outX += '<td>'+ k.product_name + '</td>';
                            outX += '<td>'+ k.chs_no+'</td>';
                            outX += '<td>'+ k.eng_no+'</td>';
                            outX += '<td>'+ k.model +'</td>';
                            outX += '<td>'+ k.color +'</td>';
                            outX += '<td>'+ k.created_at.split(" ")[0]+'</td>';
                            outX += '<td>'+ k.buy_rate +'</td>';
                            outX += '</tr>';
                            count++;
                        });
                        $('#report_table_body').html(outX);
                    });
                    $('#show_table').dataTable({
                        bDestroy : true,
                        "bPaginate": false,
                        "bFilter": true,
                        "bInfo": false,
                        "bSearchable":false,
                        "iDisplayLength": 500,
                        "bSort": false
                    });
                }
            </script>
            <style>
                .dataTables_filter, .dataTables_info { display: none; }
            </style>
            <div id="modal_show_item" class="modal modal_insertion">
                <div class="modal_header">
                    <h3 class="modal_title pull-left">Showing Available Product of <span id="pro_name"></span></h3>
                    <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                    <div class="clearfix"></div>
                </div>
                <div class="modal_body" style="padding: 10px">
                    <table id="show_table" class="bordered striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Engine No</th>
                                <th>Chases No</th>
                                <th>Model</th>
                                <th>color</th>
                                <th>buy Date</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody id="report_table_body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop