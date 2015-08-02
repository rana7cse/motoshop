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
                                                <label for="first_name">Product Name</label>
                                            </div>
                                            <div class="input-field">
                                                <input name="pro_visible" class="with-gap" value="1" type="radio" id="test1" checked/>
                                                <label for="test1">Active</label>
                                                <input name="pro_visible" class="with-gap" value="0" type="radio" id="test2" />
                                                <label for="test2">Inactive</label>
                                            </div>
                                        </div>
                                        <div class=" col s6">
                                            <div class="product_image_section">
                                                <div class="product_image_box">
                                                    <div class="product_image_title">
                                                        Upload Product Image
                                                    </div>
                                                    <div class="product_image">
                                                        <img src="{{asset('bower_components/rocket3-256/index.png')}}" alt="" id="show_image_upload">
                                                        <input type="file" name="product_image" id="product_image">
                                                        <input type="hidden" name="pro_img" id="image_name">
                                                    </div>
                                                    <div class="progress">
                                                        <div class="determinate" style="width: 40%" id="image_progress"></div>
                                                    </div>
                                                    <a class="btn btn-block product_image_upload" id="doImageUpload">Upload Image</a>
                                                </div>
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
                                        <th data-field="price">Visibility</th>
                                        <th>img</th>
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
                                                        <label>Product Visibility</label>
                                                        <select class="browser-default" name="editVisiblility" id="editVisiblility">
                                                            <option value="">Product Activity</option>
                                                            <option value="0">Inactive</option>
                                                            <option value="1">Active</option>
                                                        </select>
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