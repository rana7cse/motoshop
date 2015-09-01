@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left"> Manage Installments. </h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_modal_Order">New Order</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="page-section">
                        <div class="page-section_header">
                            <div class="title">Manage your payment receive from customers</div>
                        </div>
                        <div class="page-section_body">
                            <table class="striped" id="table_installment_list">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer ( ID )</th>
                                    <th>Product</th>
                                    <th>Current Due</th>
                                    <th>Next Payment</th>
                                    <th>Next Pay Date</th>
                                    <th>Inst No</th>
                                    <th>Buy Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="page-section_footer">
                            <div id="modal_payInstallment" class="modal modal_insertion">
                                <div class="modal_header">
                                    <h3 class="modal_title pull-left">Pay Installment. </h3>
                                    <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal_body">
                                    <div class="insert_form row">
                                        <form action="javascript:void(0)" id="form_payInst">
                                            <input type="hidden" name="loan_id_hd" id="loan_id_hd">
                                            <div class="input-field col s4">
                                                <input placeholder="Select Date" id="inst_date" type="text" name="inst_date" readonly>
                                                <label for="cusFirstName">Installment Date : </label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Select Date" id="inst_Paydate" type="text" name="inst_Paydate">
                                                <label for="cusFirstName">Pay Date : </label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="" value="0" id="inst_dueDay" type="text" name="inst_dueDay" readonly>
                                                <label for="eng_no">Due Day</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Payment" id="inst_payAmount" type="text" name="inst_payAmount" readonly>
                                                <label for="eng_no">Pay Amount</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Due" id="inst_payCharge" type="text" name="inst_payCharge">
                                                <label for="eng_no">Cherge/day :</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Due" id="inst_payTotal" type="text" name="inst_payTotal" readonly>
                                                <label for="eng_no">Total Payable :</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal_footer">
                                    <div class="btn btn-flat submit" id="btn_payInstalment">Make Payment</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/transection/installment.js')}}"></script>
@stop