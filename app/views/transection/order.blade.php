@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left"> Manage your buy orders. </h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_modal_Order">New Order</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="page-section">
                        <div class="page-section_header">
                            <div class="title">Customize or Search Your Order</div>
                            <pre>{{print_r($status)}}</pre>
                        </div>
                        <div class="page-section_body">
                            <table class="striped" id="table_listOrders">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier Name</th>
                                    <th>Comment</th>
                                    <th>Bill Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="page-section_footer">
                            {{--Customar Edit Modal--}}
                            <div id="modal_viewOrder" class="modal bottom-sheet">
                                <div class="modal-content" style="padding: 10px 24px 0 10px">
                                    <div class="model_title">View Order Status. #ID(<span id="viewOrderId"></span>)</div>
                                    <div class="modal_bodu">
                                        <div class="row">
                                            <form action="javascript:void(0)" id="form_viewOrder">
                                                <div class="input-field col s3">
                                                    <input placeholder="Select Date" id="viewOrdDate" type="text" name="viewOrdDate">
                                                    <label for="cusFirstName">Order Date :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="viewOrderSupp" placeholder="" type="text" name="viewOrderSupp">
                                                    <label for="cusLastName">Supplier Name (id) :</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="viewOrderCmnt" name="viewOrderCmnt" placeholder="" type="text"/>
                                                    <label for="eng_no">Comment :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="viewOrderAmnt" type="text" name="viewOrderAmnt" placeholder="">
                                                    <label for="eng_no">Total Amount :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="viewOrderPay" type="text" name="viewOrderPay" placeholder="">
                                                    <label for="eng_no">Total Payment :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="viewOrderDue" type="text" name="viewOrderDue" placeholder="">
                                                    <label for="eng_no">Total Due :</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" class="btn waves-effect waves-green btn-flat btn-update" id="btn_makeOrderPay">Make Payment</a>
                                    <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat" style="margin-right: 10px">Close</a>
                                </div>
                            </div>
                            {{-- ENDS--}}

                            {{--Customar ADD Modal Here--}}
                            <div id="modal_newOrder" class="modal modal_insertion">
                                <div class="modal_header">
                                    <h3 class="modal_title pull-left">Please Make a new order. </h3>
                                    <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal_body">
                                    <div class="insert_form row">
                                        <form action="javascript:void(0)" id="form_newOrder">
                                            <div class="input-field col s6">
                                                <input placeholder="Select Date" id="newOrdDate" type="text" name="newOrdDate">
                                                <label for="cusFirstName">Date : </label>
                                            </div>
                                            <div class="input-field col s6">
                                                <select class="browser-default" id="newOrderSupp" name="newOrderSupp">
                                                    <option value="" selected>Select Supplier</option>
                                                    <?php
                                                        $dataX = Supplier::all();
                                                    ?>
                                                    @foreach($dataX as $dx)
                                                        <option value="{{$dx->id}}">{{$dx->supp_name}} - ( {{$dx->id}} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-field col s12">
                                                <textarea placeholder="Add Comment" id="newOrderComment" name="newOrderComment" class="materialize-textarea"></textarea>
                                                <label for="eng_no">Comment</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="0123456789" id="newOrderAmmount" type="text" name="newOrderAmmount">
                                                <label for="eng_no">Ammount</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Payment" id="newOrderPayment" type="text" name="newOrderPayment">
                                                <label for="eng_no">Payment :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Due" id="newOrderDue" type="text" name="newOrderDue">
                                                <label for="eng_no">Due :</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal_footer">
                                    <div class="btn btn-flat reset">Reset</div>
                                    <div class="btn btn-flat submit" id="btn_newOrder">Submit</div>
                                </div>
                            </div>
                            {{--ENds--}}

                            {{--Payment Side Panel Starts--}}
                            <div id="panel_orderPayment" class="epanel">
                                <div class="epanel_wrapper">
                                    <div class="epanel_header">
                                        <div class="title">Please Make Payment to
                                            <b id="order_pay_to">Mamk</b>
                                        </div>
                                    </div>
                                    <div class="epenel_body">
                                            <div class="heading">
                                                <div class="box_info pull-left">
                                                    <span>Billed : </span>
                                                    <b id="order_pay_billed">20000</b>
                                                </div>
                                                <div class="box_info pull-right">
                                                    <span>Order Date : </span>
                                                    <b id="order_X_date">201542</b>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <form action="javascript:void(0)" id="form_payMent_Order">
                                                <input type="hidden" id="payOrderId" name="payOrderId">
                                                <input type="hidden" id="payOrderSuppid" name="payOrderSuppId">
                                                <input type="hidden" id="payOrderCurPay" name="payOrderCurPay">
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input placeholder="Select Date" id="payOrderDate" type="text" name="payOrderDate">
                                                        <label>Date : </label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input placeholder="Select Date" id="payOrderPay" type="text" name="payOrderPay">
                                                        <label>Payment : </label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input placeholder="Select Date" id="payOrderPrvDue" type="text" name="payOrderPrvDue">
                                                        <label>Privious Due : </label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input placeholder="Select Date" id="payOrderDue" type="text" name="payOrderDue">
                                                        <label>Current Due : </label>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                    <div class="epanel_footer">
                                        <button class="btn btn-add bclose" id="p_oP_close">Close</button>
                                        <button class="btn btn-update badd" id="p_oP_submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                            {{--Payment Side Panel Ends--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/transection/order.js')}}"></script>
@stop