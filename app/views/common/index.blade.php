<!DOCTYPE html>
<html>
@include('common.header')
<body>
<div id="main_wrapper">
    <div class="page_wrapper">
        @include('common.sidebar')

        <div class="main-page">
            <div class="main-page__header">
                <div class="sectionX">
                    <div class="logo pull-left">
                        <h2>Manage your shop easily</h2>
                    </div>
                    <div class="nav_user pull-right">
                        <div class="dropdown_box">
                            <a href="Javascript:void(0)" id="user_menu" class="waves-effect waves-light">
                                <span>Administrator</span></i>
                            </a>
                            <ul class="user_menu_drop">
                                <li>
                                    <img src="" alt=""/>
                                    <span class="name">Administrator</span>
                                </li>
                                <li><a href="#">Setting</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            @yield('page_body')
        </div>

    </div>
</div>
<script src="{{asset('js/script.js')}}"></script>
@yield('page_script')
</body>
</html>