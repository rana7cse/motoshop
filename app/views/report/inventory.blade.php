@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Inventory Report</h2>
            <button id="print_inv_report" class="btn btn-update pull-right">Print</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div id="listProduct" class="tab_panel">
                <div class="title">List of available product</div>
                <div class="reportTableWrapper" id="reportTableWrapper">
                    <h3 class="title" style="display: none">Available product on your store</h3>
                    <a class="print_hide btn btn-add" style="display: none" href="{{url('/report/inventory')}}">Back</a>
                    @if(count($report)>0)
                    <table class="bordered striped" id="inventory_report">
                        <thead>
                            <tr>
                                <th width="50px" style="text-align: center">SN</th>
                                <th>Name</th>
                                <th width="100px" style="text-align: right">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=0 ?>
                            @foreach($report as $list)
                                <tr>
                                    <td style="text-align: center">{{$i+1}}</td>
                                    <td><b>{{$list->product}}</b></td>
                                    <td style="text-align: right">{{$list->total}}</td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h2 style="text-align: center;">No Item exist on your stock</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('page_script')
    <script src="{{asset('js/app/allReports.js')}}"></script>
@stop