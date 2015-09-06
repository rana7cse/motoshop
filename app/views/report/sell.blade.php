@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">All Selling Report</h2>
            <button id="print_buy_report" class="btn btn-update pull-right">Print</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div id="listProduct" class="tab_panel">
                <div class="title">List Of All Selling Info <b>{{$kopa['to']}}</b> to <b>{{$kopa['form']}}</b></div>
                <div class="reportTableWrapper" id="reportTableWrapper">
                    <h3 class="title" style="display: none">All Selling Product <b>{{$kopa['to']}}</b> to <b>{{$kopa['form']}}</b></h3>
                    <a class="print_hide btn btn-add" style="display: none" href="{{url('/report/sell')}}">Back</a>
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
                                <th>CUSTOMER</th>
                                <th>PRODUCT</th>
                                <th>ENG NO</th>
                                <th>CHS NO</th>
                                <th>PAY</th>
                                <th>PRICE</th>
                                <th>PAID</th>
                                <th>DUE</th>
                                <th>DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kopa['data'] as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->first_name}} {{$data->last_name}}</td>
                                    <td>{{$data->product_name}}</td>
                                    <td>{{$data->eng_no}}</td>
                                    <td>{{$data->chs_no}}</td>
                                    <td>on {{$data->payment_status}}</td>
                                    <td>{{$data->price}}</td>
                                    <td>{{$data->paid}}</td>
                                    <td>{{$data->due}}</td>
                                    <td>{{$data->sold_date}}</td>
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