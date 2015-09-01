@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Select And Sell Your Product</h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_customar_modal">Add Customar</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row sell-section">
                <div class="col s5">
                    <div class="sell-section_panel">
                        <div class="title">Selling Panel</div>
                        <div class="body">
                                <div class="search">
                                    <div class="label">
                                        Search Customer :
                                    </div>
                                    <select name="searchCustomar" id="searchCustomar" class="browser-default">
                                        <option value="">Select Customer</option>
                                    </select>
                                </div>
                            <div class="search">
                                <div class="label">
                                    Customar Info :
                                    <button class="clear_panel pull-right" id="clearCustomer">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="info">
                                    <ul>
                                        <li>
                                            <label>Name</label><span id="cus_name">NA</span>
                                        </li>
                                        <li>
                                            <label>Fat Name</label><span id="cus_email">NA</span>
                                        </li>
                                        <li>
                                            <label>Phone</label><span id="cus_phone">NA</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="search" style="background: #FDFFEC;">
                                <div class="label">Product Info. :
                                    <button class="clear_panel pull-right" id="clearProduct">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="info product_info">
                                    <ul>
                                        <li>
                                            <label>Name</label><span id="pro_name"></span>
                                        </li>
                                        <li>
                                            <label>Eng No.</label><span id="pro_eng"></span>
                                        </li>
                                        <li>
                                            <label>Chs No.</label><span id="pro_chs"></span>
                                        </li>
                                        <li>
                                            <label><b>Price</b></label><span id="pro_rate"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="statusX">
                                <div class="pull-left hd">Total Payable :</div>
                                <div class="pull-right">
                                    <span id="payAblePrice">00.00</span> tk + VAT + Bank Interest
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="avtionXX">
                                <button class="btn_sell pull-left bill" id="print_report"><i class="fa fa-print"></i>Print Bill & Finish</button>
                                <button class="btn_sell pull-left pay" id="sell_payment"><i class="fa fa-money"></i>Payment</button>
                                {{--<button class="btn_sell pull-right done"><i class="fa fa-paper-plane-o"></i> Done</button>--}}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s7">
                    <div class="sell-section_table">
                        <div class="title">Available Motorcycle here.</div>
                        <div class="sell_product_area">
                            <div class="sell_product_section">
                                <div class="row">
                                    <div class="col s6 box">
                                        <div class="box_title">Search by Name</div>
                                        <select name="search_product_name" id="search_product_name" class="browser-default">
                                            <option value="">Select Product Name</option>
                                        </select>
                                    </div>
                                    <div class="col s6 box bykeNoSearch">
                                        <div class="box_title">Search by Bike No</div>
                                        <input type="text" placeholder="Enter Engine No" name="search_engine_no" id="search_engine_no" class="browser-default">
                                        <button id="btn_search_eng_no"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="sell_product_table">
                                <table class="striped" id="table_product_avail">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ENG NO</th>
                                            <th>CHS NO</th>
                                            <th>NAME</th>
                                            <th>PRICE</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="externals">
        <div id="modal_product_sell" class="modal">
                <div class="modal_header">
                    <h3 class="modal_title pull-left">Please Pay Your Bill. </h3>
                    <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                    <div class="clearfix"></div>
                </div>
                <div class="modal_body">
                    <div class="payment_send">

                            <div class="row">
                                <div class="col s6">
                                    <div class="section_pay">
                                        <div class="label">Customer Info (Billed For)</div>
                                        <ul>
                                            <li><label>ID</label><span id="payCusId"></span></li>
                                            <li><label>Name</label><span id="payCusName"></span></li>
                                            <li><label>Email</label><span id="payCusEmail"></span></li>
                                            <li><label>Phone</label><span id="payCusPhone"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col s6">
                                    <div class="section_pay">
                                        <div class="label">Product Info (Billed On)</div>
                                        <ul>
                                            <li><label>Name</label><span id="payProName"></span></li>
                                            <li><label>Engine No</label><span id="payProEngNo"></span></li>
                                            <li><label>Chases No</label><span id="payProChsNo"></span></li>
                                            <li><label>Rate</label><span id="payProRate"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="section_pay">
                                        <div class="label">Payment Info</div>
                                        <div class="row">
                                            <form action="javascript:void(0)" id="form_sell_payment">
                                                <div class="input-field col s4">
                                                    <input placeholder="Placeholder" id="frm_payable" name="frm_payable" type="text" readonly>
                                                    <label>Motorcycle Price (tk)</label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <input placeholder="Payable Vat" id="frm_payVat" name="frm_payVat" type="text">
                                                    <label>Vat (tk)</label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <input placeholder="Bank Interest" id="frm_payInt" name="frm_payInt" type="text">
                                                    <label>Bank Interest (tk)</label>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="input-field col s4">
                                                    <select class="browser-default" id="payment_status" name="payment_status">
                                                        <option value="">Choose your pay way</option>
                                                        <option value="cash" selected>Cash</option>
                                                        <option value="due">Installment</option>
                                                    </select>
                                                    <label style="top: -20px; font-size: 12px;">Payment Way</label>
                                                </div>

                                                <div class="input-field col s4">
                                                <input placeholder="Paid amount" id="frm_ammount" type="text" name="frm_ammount">
                                                <label>Paid (tk)</label>
                                            </div>
                                                <div class="input-field col s4">
                                                <input placeholder="Due" id="frm_due" type="text" name="frm_due" readonly>
                                                <label>Due (tk)</label>
                                            </div>
                                                <div id="install_ment_count">
                                                <div class="input-field col s6">
                                                    <input placeholder="" id="frm_inst_no" type="text" name="frm_inst_no">
                                                    <label>No of Installment</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input placeholder="" id="frm_inst_rate" type="text" name="frm_inst_rate" readonly>
                                                    <label>Pay Per Installment (tk)</label>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal_footer">
                    <div class="payableBill pull-left">Total Billed: <label id="totalBilled">00000000 </label> tk</div>
                    <div class="btn btn-flat submit" id="btn_payment_send">Submit</div>
                </div>
        </div>
    </div>

    <div id="modal_addCustomar" class="modal modal_insertion">
        <div class="modal_header">
            <h3 class="modal_title pull-left">Add a new customer</h3>
            <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="modal_body">
            <div class="insert_form row">
                <form action="javascript:void(0)" id="form_addCustomar">
                    <div class="input-field col s6">
                        <input placeholder="Enter first name" id="cusFirstName" type="text" name="cusFirstName">
                        <label for="cusFirstName">First Name :</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter first name" id="cusLastName" type="text" name="cusLastName">
                        <label for="cusLastName">Last Name :</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea placeholder="Enter address" id="cusAddress" name="cusAddress" class="materialize-textarea"></textarea>
                        <label for="eng_no">Address :</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter father Name" id="cusFatName" type="text" name="cusFatName">
                        <label for="cusLastName">Father Name :</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Email ID" id="cusEmail" type="text" name="cusEmail">
                        <label for="eng_no">Email Address :</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Phone/Mobile No" id="cusPhone" type="text" name="cusPhone">
                        <label for="eng_no">Phone/Mobile No :</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Phone/Mobile No" id="cusPhone2" type="text" name="cusPhone2">
                        <label for="eng_no">Phone2/Mobile2 No :</label>
                    </div>
                    <div class="input-field col s6" style="display: none">
                        <input placeholder="National ID" id="cusNid" type="text" name="cusNid" value="111">
                        <label for="eng_no">National ID :</label>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal_footer">
            <div class="btn btn-flat reset">Reset</div>
            <div class="btn btn-flat submit" id="btn_addCustomar">Submit</div>
        </div>
    </div>

    <div id="cashReport">
        <a href="{{url('/sell')}}" class="btn btn-large" id="button_back"> Complete </a>
        <div class="mr_report">
            <header class="report_header">
                <div class="name">ELIN MOTORS</div>
                <div class="heading">All kinds of motorcycle seller</div>
                <div class="motors">Serve: HONDA, HIRO HONDA, BAJAJ, ETC</div>
                <div class="address">NIMTOLA, DINAJPUR</div>
                <div class="contact">Phone: 0531-64436, Mobile: 01616652659, 01718185064</div>
            </header>
            <div class="section">
                <div class="tags">
                    <ul>
                        <li>INV NO : ......................</li>
                        <li class="ta_center"><b>INVOICE</b></li>
                        <li>
                            <div class="ta_right">DATE : <span id="rp_sold_date"></span></div>
                        </li>
                    </ul>
                </div>
                <div class="information">
                    <div class="box_50 pull_left">
                        <div class="title">Customer information</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <label>Customer ID </label><span id="rp_cus_id"></span>
                                </li>
                                <li>
                                    <label>Name</label><span id="rp_cus_name"></span>
                                </li>
                                <li>
                                    <label>Father Name</label><span id="rp_cus_f_name"></span>
                                </li>
                                <li>
                                    <label>Address </label><span id="rp_cus_add"></span>
                                </li>
                                <li>
                                    <label>Phone </label><span id="rp_cus_phone"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box_50 pull_right">
                        <div class="title">Referance :</div>
                        <div class="info">

                        </div>
                    </div>
                    <div class="clear_fix"></div>

                    <div class="rp_bill_area">
                        <div class="box_50 pull_left">
                            <div class="title">Product information</div>
                            <div class="info">
                                <ul>
                                    <li>
                                        <label>Product Name </label><span id="rp_pro_name"></span>
                                        <label style="width: 30px">CC</label><span id="rp_pro_cc"></span>
                                    </li>
                                    <li>
                                        <label>Engine No</label><span id="rp_pro_eng_no"></span>
                                    </li>
                                    <li>
                                        <label>Chases No</label><span id="rp_pro_chs_no"></span>
                                    </li>
                                    <li>
                                        <label>Model </label><span id="rp_pro_model"></span>
                                    </li>
                                    <li>
                                        <label style="width: 60px">Year </label><span>____________ </span>
                                        <label style="width: 80px">Made By: </label><span>___________________</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box_50 pull_right">
                            <div class="title">Bill information</div>
                            <div class="info billed">
                                <ul>
                                    <li>
                                        <label>Motorcycle Price </label><span id="rp_bill_price"></span>tk
                                    </li>
                                    <li>
                                        <label>VAT</label><span id="rp_bill_vat"></span>tk
                                    </li>
                                    <li>
                                        <label>Bank Charge</label><span id="rp_bill_Bcharge"></span>tk
                                    </li>
                                    <li>
                                        <label>Total Billed </label><span id="rp_bill_total"></span>tk
                                    </li>
                                    <li>
                                        <label>Paid </label><span id="rp_bill_paid"></span>tk
                                    </li>
                                    <li>
                                        <label>Due </label><span id="rp_bill_due"></span>tk
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clear_fix"></div>
                </div>
                <div class="declearation">
                    <P>I am the customer of the motorcycle and I also declare that,
                        The due of the motorcycle is <span id="dec_due"></span>tk.. .
                        And I will take the document of this motorcycle after paying the due.
                    </P>
                    <div class="installment_pay">
                        <div class="heading">Date of installments :</div>
                        <div class="installment_table_report" id="rp_installment_set">

                        </div>
                        <div class="clear_fix"></div>
                    </div>
                    <p>If I will fail to pay my installment in the following time then the provider can charge me ---tk per day as their rule.
                    Otherwise the provider can be return this (following eng no, chases no) motorcycle if
                    I'll fail to pay my due in these following time.
                    Recognize that by affixing my signature here to I am accepting all the terms and
                    conditions which this declaration shall form a part.
                    </p>
                </div>
                <div class="footer_sign">
                    <div class="sign pull_left">
                        <p>-------------------------------</p>
                        <p>Customer Sign & Date</p>
                    </div>
                    <div class="sign pull_right">
                        <p>--------------------------------</p>
                        <p>Provider Sign & Date</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/sell.js')}}"></script>
@stop