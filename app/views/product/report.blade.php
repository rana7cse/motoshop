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
                                    <td>{{$list->product}}</td>
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
            </script>
        </div>
    </div>
@stop