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
                        <a href="#!" class="collection-item">Sell</a>
                        <a href="{{url('/inventory')}}" class="collection-item">Buy</a>
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
                        <a href="{{url('/product/manage')}}" class="collection-item">Report
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
                        <a href="#!" class="collection-item">Receive</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-user-secret"></i> People</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/customars')}}" class="collection-item">Manage Customer<span class="new badge">+</span></a>
                        <a href="{{url('/suppliers')}}" class="collection-item">Manage Suppliers<span class="new badge">+</span></a>
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