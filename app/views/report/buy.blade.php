@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">All Buying Report</h2>
            <button id="print_buy_report" class="btn btn-update pull-right">Print</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div id="listProduct" class="tab_panel">
                <div class="title">List Of All Buying Info <b>{{$kopa['to']}}</b> to <b>{{$kopa['form']}}</b></div>
                <div class="reportTableWrapper" id="reportTableWrapper">
                    <h3 class="title" style="display: none">All Buying Product <b>{{$kopa['to']}}</b> to <b>{{$kopa['form']}}</b></h3>
                    <a class="print_hide btn btn-add" style="display: none" href="{{url('/report/buy')}}">Back</a>
                    <div class="header_filer print_hide">
                        <form action="{{url('/report/buy')}}" method="post" class="row">
                            <div class="col s4 input-field">
                                <input placeholder="Form Date" id="sellFilterTOdate" name="form" type="text" class="validate">
                                <label for="first_name">Form Date :</label>
                            </div>
                            <div class="col s4 input-field">
                                <input placeholder="To Date" name="to" id="sellFilterFormdate" type="text" class="validate">
                                <label for="sellFilterFormdate">To Date :</label>
                            </div>
                            <div class="col s4 input-field">
                                <button class="btn" type="submit" id="sellFilterBtn">Search</button>
                            </div>
                        </form>
                    </div>
                    <table class="bordered striped" id="inventory_report">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Engine No</th>
                                <th>Chases No</th>
                                <th>Sell Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kopa['data'] as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->product_name}}</td>
                                    <td>{{$data->model}}</td>
                                    <td>{{$data->color}}</td>
                                    <td>{{$data->eng_no}}</td>
                                    <td>{{$data->chs_no}}</td>
                                    <td>{{$data->sell_rate}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page_script')
    <script src="{{asset('js/app/allReports.js')}}"></script>
@stop