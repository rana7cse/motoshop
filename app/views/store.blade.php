@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2>Manage Your Product</h2>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="inventory_body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/product.js')}}"></script>
@stop