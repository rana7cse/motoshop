@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">All Account Receive Report</h2>
            <button id="print_buy_report" class="btn btn-update pull-right">Print</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div id="listProduct" class="tab_panel">
                <div class="title">List Received ammount at : {{$data['date']}} [<b> Total Received: {{$data['total']}} ]</b> </div>
                <div class="reportTableWrapper" id="reportTableWrapper">
                    <div class="header_filer print_hide">
                        <form action="#" method="get" class="row">
                            <div class="col s4 input-field">
                                <input placeholder="Form Date" id="sellFilterTOdate" value="{{$data['date']}}" name="form" type="text" class="validate">
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
                            <th>SN</th>
                            <th>Supp Name</th>
                            <th>Order ID</th>
                            <th>Paid</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data['all']))
                            <?php $sn = 0 ?>
                            @foreach($data['all'] as $buy)
                                <tr>
                                    <td>{{++$sn}}</td>
                                    <td>{{$buy->supp_name}}</td>
                                    <td>{{$buy->order_id}}</td>
                                    <td>{{$buy->ammount}}</td>
                                    <td>{{$buy->date}}</td>
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
                var urlX = RootUrl+"/daily/buy/"+$(this).val();
                $('#btn_show_report').attr('href',urlX);
                $('#sellFilterTOdate_root').close();
            })
        })
    </script>
@stop
@section('page_script')
    <script src="{{asset('js/app/allReports.js')}}"></script>
@stop