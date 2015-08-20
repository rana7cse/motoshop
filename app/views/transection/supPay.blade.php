@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left"> Manage your all transactions what's you already paid. </h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_modal_Order">Make A Payment</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="page-section">
                        <div class="page-section_header">
                            <div class="title">Customize or Search Your Payments</div>
                        </div>
                        <div class="page-section_body">
                            <table class="striped" id="table_listPayment">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Supplier Name</th>
                                        <th>Order Id</th>
                                        <th>Paid</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="page-section_footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/transection/payment.js')}}"></script>
@stop