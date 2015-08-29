@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Select And Sell Your Product</h2>
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
                                            <label>Email</label><span id="cus_email">NA</span>
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
                                    <span id="payAblePrice">00.00</span> tk
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
                                                <div class="input-field col s6">
                                                <input placeholder="Placeholder" id="frm_payable" name="frm_payable" type="text" readonly>
                                                <label>Total Payable (tk)</label>
                                            </div>
                                                <div class="input-field col s6">
                                                <select class="browser-default" id="payment_status" name="payment_status">
                                                    <option value="">Choose your pay way</option>
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="due">Installment</option>
                                                </select>
                                                <label style="top: -20px; font-size: 12px;">Payment Status</label>
                                            </div>
                                                <div class="clearfix"></div>
                                                <div class="input-field col s6">
                                                <input placeholder="Paid amount" id="frm_ammount" type="text" name="frm_ammount">
                                                <label>Paid (tk)</label>
                                            </div>
                                                <div class="input-field col s6">
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
                    <div class="btn btn-flat reset">Reset</div>
                    <div class="btn btn-flat submit" id="btn_payment_send">Submit</div>
                </div>
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
                            <div class="ta_right">DATE : ...........................</div>
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
                                    <label>Father Name</label><span id="rp_cus_f_name">______________________________________</span>
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
                        <div class="title">Product information</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <label>Product Name </label><span>_______________________ </span>
                                    <label style="width: 30px">CC</label><span>__________</span>
                                </li>
                                <li>
                                    <label>Engine No</label><span id="rp_pro_eng_no"></span>
                                </li>
                                <li>
                                    <label>Chases No</label><span id="rp_pro_chs_no"></span>
                                </li>
                                <li>
                                    <label>Model </label><span>________________________________</span>
                                </li>
                                <li>
                                    <label style="width: 60px">Year </label><span>____________ </span>
                                    <label style="width: 80px">Made By: </label><span>___________________</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear_fix"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/sell.js')}}"></script>
@stop