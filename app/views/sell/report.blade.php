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
                            <th>ENG NO</th>
                            <th>CHS NO</th>
                            <th>PAY</th>
                            <th>PRICE</th>
                            <th>PAID</th>
                            <th>DUE</th>
                            <th>DATE</th>
                            <th>Invoice</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('hidden_sect')
    <div id="cashReport">
        <a href="{{url('/sell/report')}}" class="btn btn-large" id="button_back"> Complete </a>
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
    <script src="{{asset('js/app/sellReport.js')}}"></script>
@stop