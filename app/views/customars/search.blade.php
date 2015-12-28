@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">Search Your Customars</h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="show_customar_modal">Add Customar</button>
            <div class="clearfix"></div>
        </div>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s12">
                    <div class="page-section">
                        <div class="page-section_header">
                            <div class="title">Search Your Customar</div>
                        </div>
                        <div id="search_Section" style="margin-top: 5px; border: 1px solid #f8f8f8">
                            <form action="javascript:void(0)" id="search_customar">
                                <div class="row">
                                    <div class="col s3">
                                        <label for="customar_name">Search By</label>
                                        <select name="searchBy" id="searchBy" class="browser-default">
                                            <option value="0">Search By</option>
                                            <option value="1">Customar Name</option>
                                            <option value="2">Customar Phone</option>
                                            <option value="3">Customar Thana</option>
                                            <option value="4">Referance Name</option>
                                            <option value="5">Referance Phone</option>
                                        </select>
                                    </div>
                                    <div class="col s5">
                                        <label for="customar_name">Search Text</label>
                                        <input id="search_text" placeholder="Search Text" readonly required type="text" class="validate">
                                    </div>
                                    <div class="col s3">
                                        <button class="btn btn-flat btn-update" style="margin-top: 10px;" id="do_search">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="page-section_body">
                            <table class="striped" id="customarSearchTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Father</th>
                                    <th>Address</th>
                                    <th>Thana</th>
                                    <th>Zilla</th>
                                    <th>Phone</th>
                                </tr>
                                </thead>
                                <tbody id="customar_search_data">

                                </tbody>
                            </table>
                        </div>
                        <script>
                            $(function(){
                                $('#searchBy').change(function(){
                                    if($(this).val() != 0){
                                        $('#search_text').attr("readonly",false);
                                    } else {
                                        $('#search_text').val("");
                                        $('#search_text').attr("readonly",true);
                                    }
                                });
                                $('#do_search').click(function(){
                                    if( $("#searchBy").val() != 0 ){
                                        if($('#search_text').val() != ""){
                                            var rootCus = '{{url('/view/details/')}}';
                                            var url = "{{url("/customar/doSearch")}}";
                                            $.post(url,{ "by" : $("#searchBy").val(), "text" : $('#search_text').val()},function(e){
                                                console.log(e);
                                                if(e.data){
                                                    $('#customar_search_data').html("");
                                                    e.data.map(function(e){
                                                        $('#customar_search_data').append("" +
                                                                "<tr>" +
                                                                "<td>"+ e.id +"</td>" +
                                                                "<td><a href='"+rootCus+"/"+e.id +"'>"+ e.first_name +"</a></td>" +
                                                                "<td>"+ e.fat_name +"</td>" +
                                                                "<td>"+ e.address +"</td>" +
                                                                "<td>"+ e.thana +"</td>" +
                                                                "<td>"+ e.zilla +"</td>" +
                                                                "<td>"+ e.phone +"</td>" +
                                                                "</tr>" +
                                                        "");
                                                    });
                                                    $('#customarSearchTable').dataTable({
                                                        "bDestroy": true,
                                                        "iDisplayLength": 100
                                                    });
                                                }else {
                                                    Materialize.toast("No data found",2000);
                                                }
                                            })
                                        } else {
                                            Materialize.toast("you didn't put any text",1500)
                                        }
                                    } else {
                                        Materialize.toast("Please search by not set",1500);
                                    }
                                });
                            });
                        </script>
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