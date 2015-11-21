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
                <div class="title">List Of All Sell at : {{$info['date']}} [<b> Total Billed: {{$info['total']->billed}}</b> - <b>Total Paid: {{$info['total']->paid}}</b> - <b>Total Due: {{$info['total']->due}}</b> ]</div>
                <div class="reportTableWrapper" id="reportTableWrapper">
                    <div class="header_filer print_hide">
                        <form action="#" method="get" class="row">
                            <div class="col s4 input-field">
                                <input placeholder="Form Date" id="sellFilterTOdate" value="{{$info['date']}}" name="form" type="text" class="validate">
                                <label for="first_name">Date :</label>
                            </div>
                            <div class="col s4 input-field">
                                <a href="#" class="btn" id="btn_show_report">Show Report</a>
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
                                <th>price</th>
                                <th>bank</th>
                                <th>vat</th>
                                <th>Bill</th>
                                <th>By</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($info['table_info']))
                                @foreach($info['table_info'] as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->first_name}}</td>
                                        <td>{{$data->product_name}}</td>
                                        <td>{{$data->eng_no}}</td>
                                        <td>{{$data->chs_no}}</td>
                                        <td>{{$data->price}}</td>
                                        <td>{{$data->bank_int}}</td>
                                        <td>{{$data->vat}}</td>
                                        <td>{{$data->total_billed}}</td>
                                        <td>{{$data->payment_status}}</td>
                                        <td>{{$data->paid}}</td>
                                        <td>{{$data->due}}</td>
                                        <td>{{$data->sold_date}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var RootUrl = '{{url('/')}}';
        $(function(){
            $('#sellFilterTOdate').change(function(){
                var urlX = RootUrl+"/daily/sell/"+$(this).val();
                $('#btn_show_report').attr('href',urlX);
                $('#sellFilterTOdate_root').close();
            })
        })
    </script>
@stop
@section('page_script')
    <script src="{{asset('js/app/allReports.js')}}"></script>
@stop