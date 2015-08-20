@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Manage Your Suppliers</h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_newSupplier">New Suppliers</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="page-section">
                        <div class="page-section_header">
                            <div class="title">View, Edit and Delete Suppliers</div>
                        </div>
                        <div class="page-section_body">
                            <table class="striped" id="table_listSupplier">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>phone</th>
                                    <th>Email</th>
                                    <th>MGM</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="page-section_footer">
                            {{--Customar Edit Modal--}}
                            <div id="modal_editSupplier" class="modal bottom-sheet">
                                <div class="modal-content" style="padding: 10px 24px 0 10px">
                                    <div class="model_title">Update Your Customar Info.</div>
                                    <div class="modal_bodu">
                                        <div class="row">
                                            <form action="javascript:void(0)" id="form_updateSupplier">
                                                <input type="hidden" name="rowId" id="editSupRowId">
                                                <div class="input-field col s3">
                                                    <input id="editSupName" placeholder="" type="text" name="editSupName">
                                                    <label for="cusFirstName">Supplier Name :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="editSupType" placeholder="" type="text" name="editSupType">
                                                    <label for="cusLastName">Supplier Type</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="editSupAdd" name="editSupAdd" placeholder="" type="text"/>
                                                    <label for="eng_no">Address :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="editSupEmail" type="text" name="editSupEmail" placeholder="">
                                                    <label for="eng_no">Email Address :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="editSupPhone" type="text" name="editSupPhone" placeholder="">
                                                    <label for="eng_no">Phone/Mobile No :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="editSupPhone2" type="text" name="editSupPhone2" placeholder="">
                                                    <label for="eng_no">Phone2/Mobile2 No :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input id="editSupMgm" type="text" name="editSupMgm" placeholder="">
                                                    <label for="eng_no">Manager/Any :</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" class="btn waves-effect waves-green btn-flat btn-update" id="btn_updateSupplier">Update</a>
                                    <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat" style="margin-right: 10px">Close</a>
                                </div>
                            </div>
                            {{-- ENDS--}}

                            {{--Customar ADD Modal Here--}}
                            <div id="modal_newSupplier" class="modal modal_insertion">
                                <div class="modal_header">
                                    <h3 class="modal_title pull-left">Please add a new supplier here. </h3>
                                    <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal_body">
                                    <div class="insert_form row">
                                        <form action="javascript:void(0)" id="form_newSupplier">
                                            <div class="input-field col s6">
                                                <input placeholder="Enter supplier name" id="newSupName" type="text" name="newSupName">
                                                <label for="cusFirstName">Supplier Name :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Enter supplier type" id="newSupType" type="text" name="newSupType">
                                                <label for="cusLastName">Supplier Type</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <textarea placeholder="Enter supplier address" id="newSupAdd" name="newSupAdd" class="materialize-textarea"></textarea>
                                                <label for="eng_no">Address :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="supplier@email.com" id="newSupEmail" type="text" name="newSupEmail">
                                                <label for="eng_no">Email Address :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Phone/Mobile No" id="newSupPhone" type="text" name="newSupPhone">
                                                <label for="eng_no">Phone/Mobile No :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Phone/Mobile No" id="newSupPhone2" type="text" name="newSupPhone2">
                                                <label for="eng_no">Phone2/Mobile2 No :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Referance name" id="newSupMgm" type="text" name="newSupMgm">
                                                <label for="eng_no">Manager/Any :</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal_footer">
                                    <div class="btn btn-flat reset">Reset</div>
                                    <div class="btn btn-flat submit" id="btn_newSupplier">Submit</div>
                                </div>
                            </div>
                            {{--ENds--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/supplier.js')}}"></script>
@stop