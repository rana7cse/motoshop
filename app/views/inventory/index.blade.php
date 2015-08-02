@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Your Store Inventory Management</h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="btn_stock_in">Stock In</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="inventory_body">
                        <div class="title">Lists all buying products
                            <a href="javascript:void(0)" class="pull-right fa fa-refresh tableRefreach" id="tableRefreach">Refreash</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="enventory_table_wrapper">
                            <table class="striped" id="inventTable">
                                <thead>
                                <tr>
                                    <th data-field="id" width="50px">SN</th>
                                    <th data-field="name">ENG NO</th>
                                    <th data-field="price">CHE NO</th>
                                    <th>ITEM</th>
                                    <th>COLOR</th>
                                    <th>PRICE</th>
                                    <th>Date</th>
                                    <th>Status</th>
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
    {{--Edit Product Stock Here--}}
    <div id="inventoryModalEdit" class="modal bottom-sheet">
        <div class="modal-content" style="padding: 10px 24px 0 10px">
            <div class="model_title">Update Your Product Info.</div>
            <div class="modal_bodu">
                <div class="row">
                    <form action="javascript:void(0)" id="InventoryEditFrom">
                        <input type="hidden" name="rowId" id="editRowId">
                        <div class="input-field col s3">
                            <input placeholder="Enter Engine No" id="editEngineNo" type="text" name="editEngineNo">
                            <label for="editEngineNo">Engine No</label>
                        </div>
                        <div class="input-field col s3">
                            <input placeholder="Enter Chases No" id="edit_chs_no" type="text" name="edit_chs_no">
                            <label for="edit_chs_no">Chases No</label>
                        </div>
                        <div class="input-field col s3" style="margin-top: 0;">
                            <span style="font-size: 12px; margin-bottom: 11px; display: block;">Product Name</span>
                            <select class="browser-default" id="edit_pro_name" name="edit_pro_name">
                                <option value="">Select Your Product</option>
                                <?php
                                $product = DB::table('product')->select('*')->get();
                                ?>
                                @foreach($product as $list)
                                    <option value="{{$list->id}}">{{$list->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field col s3" style="margin-top: 0;">
                            <span style="font-size: 12px; margin-bottom: 11px; display: block;">Product Color</span>
                            <select class="browser-default" id="edit_pro_color" name="edit_pro_color">
                                <option value="">Select Your Color</option>
                                <option value="red">Red</option>
                                <option value="green">Green</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="input-field col s3">
                            <input placeholder="Buy Rate" id="edit_pro_buy_rate" type="text" name="edit_pro_buy_rate">
                            <label for="edit_pro_buy_rate">Buy rate</label>
                        </div>
                        <div class="input-field col s3">
                            <input placeholder="Sell Rate" id="edit_pro_sell_rate" type="text" name="edit_pro_sell_rate">
                            <label for="edit_pro_sell_rate">Sell Rate</label>
                        </div>
                        <div class="input-field col s3">
                            <input placeholder="Placeholder" id="edit_pro_supplier" type="text" name="edit_pro_supplier" disabled value="NA">
                            <label for="pro_supplier">Product Supplier</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="btn waves-effect waves-green btn-flat btn-update" id="updateInventoryBtn">Update</a>
            <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat" style="margin-right: 10px">Close</a>
        </div>
    </div>
    {{--Edit Product Stock ENDS--}}

    {{--Stock In Modal Here--}}
    <div id="modal_stock_in" class="modal modal_insertion">
        <div class="modal_header">
            <h3 class="modal_title pull-left">Please add buying information here</h3>
            <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="modal_body">
            <div class="insert_form row">
                <form action="javascript:void(0)" id="stock_insert_form">
                    <div class="input-field col s6">
                        <input placeholder="Enter Engine No" id="eng_no" type="text" name="eng_no">
                        <label for="eng_no">Engine No</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Chases No" id="chs_no" type="text" name="chs_no">
                        <label for="chs_no">Chases No</label>
                    </div>
                    <div class="input-field col s6" style="margin-top: 0;">
                        <span style="font-size: 12px; margin-bottom: 11px; display: block;">Product Name</span>
                        <select class="browser-default" id="pro_name" name="pro_name">
                            <option value="">Select Your Product</option>
                            <?php
                                $product = DB::table('product')->select('*')->get();
                            ?>
                            @foreach($product as $list)
                                <option value="{{$list->id}}">{{$list->product_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s6" style="margin-top: 0;">
                        <span style="font-size: 12px; margin-bottom: 11px; display: block;">Product Color</span>
                        <select class="browser-default" id="pro_color" name="pro_color" style="height: 30px; margin-bottom: 5px;">
                            <option value="">Select Your Color</option>
                            <option value="red">Red</option>
                            <option value="green">Green</option>
                        </select>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Buy Rate" id="pro_buy_rate" type="text" name="pro_buy_rate">
                        <label for="pro_buy_rate">Buy rate</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Sell Rate" id="pro_sell_rate" type="text" name="pro_sell_rate">
                        <label for="pro_sell_rate">Sell Rate</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Placeholder" id="pro_quantity" type="text" name="pro_quantity" value="1" disabled>
                        <label for="pro_quantity">Product Quantity</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Placeholder" id="pro_supplier" type="text" name="pro_supplier" disabled value="NA">
                        <label for="pro_supplier">Product Supplier</label>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal_footer">
            <div class="btn btn-flat reset">Reset</div>
            <div class="btn btn-flat submit" id="submit_stock_in_form">Submit</div>
        </div>
    </div>
    {{--Stock IN MOdal ENds--}}
@stop

@section('page_script')
    <script src="{{asset('js/app/inventory.js')}}"></script>
@stop