@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Manage Your Customars</h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_customar_modal">Add Customar</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="page-section">
                        <div class="page-section_header">
                            <div class="title">View, Edit and Delete Customar</div>
                        </div>
                        <div class="page-section_body">
                                <table class="striped" id="customarTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Father</th>
                                        <th>Thana</th>
                                        <th>Zilla</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                        </div>
                        <div class="page-section_footer">
                            {{--Customar Edit Modal--}}
                            <div id="modal_editCustomer" class="modal bottom-sheet">
                                <div class="modal-content" style="padding: 10px 24px 0 10px">
                                    <div class="model_title">Update Your Customar Info.</div>
                                    <div class="modal_bodu">
                                        <div class="row">
                                            <form action="javascript:void(0)" id="form_updateCustomer">
                                                <input type="hidden" name="rowId" id="ceditRowId">
                                                <div class="input-field col s3">
                                                    <input placeholder="Customar Name" id="edit_cusFirstName" type="text" name="edit_cusFirstName">
                                                    <label for="cusFirstName">Customar Name</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input placeholder="Father Name" id="edit_cusFatName" type="text" name="edit_cusFatName">
                                                    <label for="cusLastName">Father Name :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input placeholder="Road,Village,Post" type="text" id="edit_cusAddress" name="edit_cusAddress" />
                                                    <label for="eng_no">Village/Post :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input placeholder="Thana/Upzilla" type="text" id="edit_cusAddThana" name="edit_cusAddThana" />
                                                    <label for="eng_no">Thana/Upzilla</label>
                                                </div>
                                                <div class="input-field col s2">
                                                    <input placeholder="Zilla Name" type="text" id="edit_cusAddZilla" name="edit_cusAddZilla" />
                                                    <label for="eng_no">Zilla :</label>
                                                </div>
                                                <div class="input-field col s2">
                                                    <input placeholder="Division Name" id="edit_cusAddDivision" type="text" name="edit_cusAddDivision">
                                                    <label for="cusLastName">Division</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input placeholder="Enter Email ID" id="edit_cusEmail" type="text" name="edit_cusEmail">
                                                    <label for="eng_no">Email Address :</label>
                                                </div>
                                                <div class="input-field col s2">
                                                    <input placeholder="Phone/Mobile No" id="edit_cusPhone" type="text" name="edit_cusPhone">
                                                    <label for="eng_no">Phone/Mobile No :</label>
                                                </div>
                                                <div class="input-field col s3">
                                                    <input placeholder="Phone/Mobile No" id="edit_cusPhone2" type="text" name="edit_cusPhone2">
                                                    <label for="eng_no">Phone2/Mobile2 No :</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" class="btn waves-effect waves-green btn-flat btn-update" id="btn_updateCustomer">Update</a>
                                    <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat" style="margin-right: 10px">Close</a>
                                </div>
                            </div>
                            {{-- ENDS--}}

                            {{--Customar ADD Modal Here--}}
                            <div id="modal_addCustomar" class="modal modal_insertion">
                                <div class="modal_header">
                                    <h3 class="modal_title pull-left">Add a new customer</h3>
                                    <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal_body">
                                    <div class="insert_form row">
                                        <form action="javascript:void(0)" id="form_addCustomar">
                                            <div class="input-field col s6">
                                                <input placeholder="Customar Name" id="cusFirstName" type="text" name="cusFirstName">
                                                <label for="cusFirstName">Customar Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Father Name" id="cusFatName" type="text" name="cusFatName">
                                                <label for="cusLastName">Father Name :</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Road,Village,Post" type="text" id="cusAddress" name="cusAddress" />
                                                <label for="eng_no">Village/Post :</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Thana/Upzilla" type="text" id="cusAddThana" name="cusAddThana" />
                                                <label for="eng_no">Thana/Upzilla</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input placeholder="Zilla Name" type="text" id="cusAddZilla" name="cusAddZilla" />
                                                <label for="eng_no">Zilla :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Division Name" id="cusAddDivision" type="text" name="cusAddDivision">
                                                <label for="cusLastName">Division</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Enter Email ID" id="cusEmail" type="text" name="cusEmail">
                                                <label for="eng_no">Email Address :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Phone/Mobile No" id="cusPhone" type="text" name="cusPhone">
                                                <label for="eng_no">Phone/Mobile No :</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="Phone/Mobile No" id="cusPhone2" type="text" name="cusPhone2">
                                                <label for="eng_no">Phone2/Mobile2 No :</label>
                                            </div>
                                            <div class="input-field col s6" style="display: none">
                                                <input placeholder="National ID" id="cusNid" type="text" name="cusNid" value="111">
                                                <label for="eng_no">National ID :</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal_footer">
                                    <div class="btn btn-flat reset">Reset</div>
                                    <div class="btn btn-flat submit" id="btn_addCustomar">Submit</div>
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
    <script src="{{asset('js/app/customar.js')}}"></script>
@stop