@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Select And Sell Your Product</h2>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="sell_report">
                <div class="title">Sell Report of the ( <span id="filter_date_to"></span> )</div>
                <div class="header_filer">
                    <div class="row">
                        <div class="col s4 input-field">
                            <input placeholder="Form Date" id="sellFilterTOdate" type="text" class="validate">
                            <label for="first_name">Form Date :</label>
                        </div>
                        <div class="col s4 input-field">
                            <input placeholder="To Date" id="sellFilterFormdate" type="text" class="validate">
                            <label for="sellFilterFormdate">Form Date :</label>
                        </div>
                        <div class="col s4 input-field">
                            <button class="btn" id="sellFilterBtn">Search</button>
                        </div>
                    </div>
                </div>
                <div class="sell_report_table">
                    <table class="striped" id="sellReportTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>CUSTOMER</th>
                            <th>PRODUCT</th>
                            <th>PAY</th>
                            <th>PRICE</th>
                            <th>PAID</th>
                            <th>DUE</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/sellReport.js')}}"></script>
@stop