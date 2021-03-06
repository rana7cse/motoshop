<div class="static_nav">
    <div class="logo">
        <a href="{{url('/')}}">
            <img src="{{url('img/logo/logo.png')}}" alt="LOGO"/>
        </a>
    </div>
    <div class="main_nav">
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-qrcode"></i> Store</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/sell')}}" class="collection-item">Sell</a>
                        <a href="{{url('/inventory')}}" class="collection-item">Buy</a>
                        <a href="{{url('/sell/report')}}" class="collection-item">Sell Report</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-shopping-cart"></i> Inventory</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/product/manage')}}" class="collection-item">Manage Product
                            <span class="badge new"><i class="fa fa-pencil-square-o"></i></span>
                        </a>
                        <a href="{{url('/inventory/report/all')}}" class="collection-item">Report
                            <span class="badge new"><i class="fa fa-pencil-square-o"></i></span>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-suitcase"></i> Transection</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/order')}}" class="collection-item">Make Order</a>
                        <a href="{{url('/payment')}}" class="collection-item">View Payments</a>
                        <a href="{{url('/loan')}}" class="collection-item">Manage Installment</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-area-chart"></i>Daily Report</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <?php
                        $today = \Carbon\Carbon::now();
                        $today = $today->year.'-'.$today->month.'-'.$today->day;
                        ?>
                        <a href="{{url('/daily/payment/'.$today)}}" class="collection-item">Payment Received<span class="badge"></span></a>
                        <a href="#" class="collection-item">Cost Report<span class="badge"></span></a>
                        <a href="{{url('/daily/sell/'.$today)}}" class="collection-item">Sell Report<span class="badge"></span></a>
                        <a href="{{url('/daily/buy/'.$today)}}" class="collection-item">Buy Report<span class="badge"></span></a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-area-chart"></i> Reports</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/inventory/report/all')}}" class="collection-item">Invenroty Report
                            <span class="badge new"><i class="fa fa-pencil-square-o"></i></span>
                        </a>
                        <a href="{{url('/report/received')}}" class="collection-item">Payment Received<span class="badge"></span></a>
                        <a href="{{url('/report/sell')}}" class="collection-item">Sell Report<span class="badge"></span></a>
                        <a href="{{url('/report/buy')}}" class="collection-item">Buy Report<span class="badge"></span></a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-user-secret"></i> People</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/customars')}}" class="collection-item">Manage Customer<span class="new badge">+</span></a>
                        <a href="{{url('/suppliers')}}" class="collection-item">Manage Suppliers<span class="new badge">+</span></a>
                        <hr>
                        <a href="{{url('/customar/search')}}" class="collection-item">Search Customer</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-cog"></i> Setting</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="#!" class="collection-item">Account Setup<span class="badge">1</span></a>
                        <a href="#!" class="collection-item">Cnange Background<span class="badge">1</span></a>
                        <a href="#!" class="collection-item">Payment Setup<span class="badge">1</span></a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>