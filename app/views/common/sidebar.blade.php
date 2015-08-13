<div class="static_nav">
    <div class="logo">
        <img src="{{url('img/logo/logo.png')}}" alt="LOGO"/>
    </div>
    <div class="main_nav">
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-home"></i>  Home</div>
            </li>
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
                <div class="collapsible-header waves-effect"><i class="fa fa-shopping-cart"></i> Product</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="{{url('/product/manage')}}" class="collection-item">Manage Product
                            <span class="badge new"><i class="fa fa-pencil-square-o"></i></span>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect"><i class="fa fa-line-chart"></i> Report</div>
                <div class="collapsible-body">
                    <div class="collection">
                        <a href="#!" class="collection-item">Report Stock<span class="badge">1</span></a>
                        <a href="#!" class="collection-item">Report Buy<span class="new badge">4</span></a>
                        <a href="#!" class="collection-item">Report Sell</a>
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