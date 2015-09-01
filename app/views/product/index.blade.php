@extends('common.index')
@section('page_body')
    <div class="main-page__body">
            <div class="title">
                <h2>Manage Your Product</h2>
            </div>
            <div class="sectionX product_start">
                <div class="row">
                    <div class="col s12">
                        <div class="sec-product" ng-controller="CatagoryController">
                            <ul class="tabs">
                                <li class="tab">
                                    <a class="active" href="#addProduct">New Product</a>
                                </li>
                                <li class="tab">
                                    <a href="#listProduct">All Product</a>
                                </li>
                            </ul>
                            <div id="addProduct" class="tab_panel">
                                <div class="title">Please Add New Product</div>
                                <div class="form-area row">
                                    <form action="javascript:void(0)" method="post" id="newProductAdd">
                                        <div class="col s6">
                                            <div class="input-field">
                                                <input id="pro_name" name="pro_name" type="text" class="validate">
                                                <label for="first_name">Motorcycle Name</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="pro_cc" name="pro_cc" type="text" class="validate">
                                                <label for="first_name">CC/Range</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="pro_model" name="pro_model" type="text" class="validate">
                                                <label for="first_name">Model/Year</label>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="input_field_button">
                                            <a class="btn green" id="submitProductCrt">Add Product</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="listProduct" class="tab_panel">
                                <div class="title">Lists of all products here</div>
                                <table class="bordered striped" id="proTable">
                                    <thead>
                                    <tr>
                                        <th data-field="id" width="50px">ID</th>
                                        <th data-field="name">Name</th>
                                        <th data-field="price">CC/Range</th>
                                        <th>Model</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>

                                <div id="EditProductDialog" class="modal bottom-sheet">
                                    <div class="modal-content">
                                        <div class="model_title">Update Your Product Info.</div>
                                        <div class="modal_bodu">
                                            <div class="row">
                                                <form action="javascript:void(0)" id="ProductEditFrom">
                                                    <div class="col s4">
                                                        <label for="editProName">Product Name</label>
                                                        <input id="editProName" name="editProName" type="text" class="validate">
                                                    </div>
                                                    <div class="col s4">
                                                        <label for="editProName">Product CC</label>
                                                        <input id="editProcc" name="editProcc" type="text" class="validate">
                                                    </div>
                                                    <div class="col s4">
                                                        <label for="editProName">Product Model</label>
                                                        <input id="editProModel" name="editProModel" type="text" class="validate">
                                                    </div>
                                                    <input type="hidden" name="editProductId" id="editProductId">
                                                    <div class="col s4">
                                                        <button type="submit" id="editProductSubmit" class="btn btn-flat" style="margin-top: 25px;">Update Product</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
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
    <script src="{{asset('js/app/product.js')}}"></script>
@stop