@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">All Buying Report</h2>
            <button id="print_inv_report" class="btn btn-update pull-right">Print</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div id="listProduct" class="tab_panel">
                <div class="title">List Of All Buying Info</div>
                <div class="reportTableWrapper" id="reportTableWrapper">
                    <h3 class="title" style="display: none">Available product on your store</h3>
                    <a class="print_hide btn btn-add" style="display: none" href="{{url('/report/buy')}}">Back</a>

                </div>
            </div>
        </div>
    </div>
@stop
@section('page_script')
    <script src="{{asset('js/app/allReports.js')}}"></script>
@stop