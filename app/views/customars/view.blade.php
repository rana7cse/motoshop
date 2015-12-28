@extends('common.index')
@section('page_body')
    <div class="main-page__body">
        <div class="title">
            <h2 class="pull-left">{{$cus->first_name}}</h2>
            <button class="btn btn-add pull-right waves-effect waves-light" id="Privious_Due">Add due</button>
            <div class="clearfix"></div>

            <div id="add_privious_due" class="modal">
                <div class="modal-content">
                    <h4 style="color: #000">Add Privious Due</h4>
                    <div>
                        <div class="input-field col s6">
                            <input style="color: black" placeholder="Placeholder" id="input_due" name="input_due" type="number" required class="validate">
                            <label for="first_name">Privious Due</label>
                        </div>
                        <div>
                            <a href="javascript:void(0)" id="add_due_btn" style="color: #000; background: #538799;" class=" modal-action modal-close waves-effect waves-green btn-flat pull-left">ADD DUE</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat pull-left">Close</a>
                </div>
            </div>
            <script>
                $(function(){
                   $('#Privious_Due').click(function(){
                        $('#add_privious_due').openModal();
                   });
                    $('#add_due_btn').click(function(){
                        if($('#input_due').val() != ''){
                            $.post('/add_due',{ due: $('#input_due').val(),id:{{$cus->id}}},function(e){
                               if(e){
                                   Materialize.toast('Success',2000);
                                   $('#input_due').val('');
                               }
                            });
                        }
                    });
                });
            </script>
        </div>
        <?php
            $buy = 0;
            $due_before = DB::table('privious_due')->where('cus_id',$cus->id)->sum('rate');
            $due_before_paid = DB::table('privious_due_paid')->where('cus_id',$cus->id)->sum('paid');
            $privious_due = DB::table('moto_sold')
                ->join('inventory','inventory.id','=','moto_sold.inv_id')
                ->join('product','product.id','=','inventory.product_id')
                ->join('car_loan','moto_sold.id','=','car_loan.sold_id')
                ->where('moto_sold.cus_id',$cus->id)
                ->where('moto_sold.payment_status','due')
                ->select('product.product_name','product.bike_cc','product.model','car_loan.current_due','car_loan.next_pay_date',
                        'car_loan.rate','car_loan.total_inst','car_loan.current_inst','car_loan.current_paid','car_loan.id'
                )
                ->get();
            $buy = DB::table('moto_sold')
                    ->join('inventory','inventory.id','=','moto_sold.inv_id')
                    ->join('product','product.id','=','inventory.product_id')
                    ->where('moto_sold.cus_id',$cus->id)
                    ->select('product.product_name','product.bike_cc','product.model',
                            'moto_sold.price','moto_sold.vat','moto_sold.bank_int','moto_sold.sold_date','moto_sold.total_billed','moto_sold.paid'
                    )
                    ->get();
        ?>
        <div class="sectionX product_start">
            <div class="row">
                <div class="col s6">
                    @if($buy)
                        <h6>Buy information</h6>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>product name</th>
                                    <th>cc</th>
                                    <th>model</th>
                                    <th>price</th>
                                    <th>vat</th>
                                    <th>bank</th>
                                    <th>sold date</th>
                                    <th>bill</th>
                                    <th>paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buy as $boi)
                                    <td>{{$boi->product_name}}</td>
                                    <td>{{$boi->bike_cc}}</td>
                                    <td>{{$boi->model}}</td>
                                    <td>{{$boi->price}}</td>
                                    <td>{{$boi->vat}}</td>
                                    <td>{{$boi->bank_int}}</td>
                                    <td>{{$boi->sold_date}}</td>
                                    <td>{{$boi->total_billed}}</td>
                                    <td>{{$boi->paid}}</td>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="col s6">
                    @if($privious_due)
                        <h6>Installment Info</h6>
                        <hr>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>total_inst</th>
                                <th>current_inst</th>
                                <th>Current Due</th>
                                <th>Curretn Paid</th>
                                <th>next date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($privious_due as $boi)
                                <tr>
                                    <td>{{$boi->product_name}}</td>
                                    <td>{{$boi->rate}}</td>
                                    <td>{{$boi->total_inst}}</td>
                                    <td>{{$boi->current_inst}}</td>
                                    <td>{{$boi->current_due}}</td>
                                    <td>{{$boi->current_paid}}</td>
                                    <td><a href="javascript:void(0)" onclick="change_date(this)" data-id="{{$boi->id}}" data-date="{{$boi->next_pay_date}}">{{$boi->next_pay_date}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div id="moedal_change_date" class="modal modal_insertion">
                            <div class="modal_header">
                                <h3 class="modal_title pull-left">Change Date</h3>
                                <a href="javascript:void(0)" class=" modal-action modal-close pull-right"><i class="fa fa-times"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="modal_body">
                                <div class="insert_form row">
                                    <form action="javascript:void(0)" id="form_change_date">
                                        <div class="input-field col s6">
                                            <input type="date" class="datepicker" id="changeDate" name="changeDate">
                                            <input type="hidden" id="loan_id" value="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal_footer">
                                <div class="btn btn-flat reset">Reset</div>
                                <div class="btn btn-flat submit" id="button_submit_change">Submit</div>
                            </div>
                        </div>
                        <script>
                            function change_date(evt){
                                var date = $(evt).data('date');
                                var id = $(evt).data('id');
                                $('#moedal_change_date').openModal();
                                $('#changeDate').val(date);
                                $('#loan_id').val(id);
                            }

                            $('.datepicker').pickadate({
                                selectMonths: true, // Creates a dropdown to control month
                                selectYears: 15, // Creates a dropdown of 15 years to control year
                                format: 'yyyy-mm-dd'
                            });
                            $('#button_submit_change').click(function(){
                                    if($('#changeDate').val() != ''){
                                        $('#moedal_change_date').closeModal();
                                        $.post('/changeDate',{date:$('#changeDate').val(),id:$('#loan_id').val()},function(e){
                                            if(e){
                                                Materialize.toast('Success to change date',2000);
                                            }
                                        });
                                    }
                            });
                        </script>
                    @endif
                </div>
                <div class="col s6">
                    @if($due_before)
                        <h6>Privious Due</h6>
                        <hr>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$due_before}}</td>
                                    <td>{{$due_before_paid}}</td>
                                    <td>{{$due_before-$due_before_paid}}</td>
                                    <td><button id="due_paid_cus">Pay</button></td>
                                </tr>
                            </tbody>
                        </table>

                        <div id="add_privious_due_paid" class="modal">
                            <div class="modal-content">
                                <h4 style="color: #000">Add Privious Due</h4>
                                <div>
                                    <div class="input-field col s6">
                                        <input style="color: black" placeholder="Paid Ammount" id="input_due_paid" name="input_due_paid" type="number" required class="validate">
                                        <label for="first_name">Privious Due</label>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" onclick="payDue()" id="add_paid_due" style="color: #000; background: #538799;" class=" modal-action modal-close waves-effect waves-green btn-flat pull-left">ADD DUE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat pull-left">Close</a>
                            </div>
                        </div>
                        <script>
                            $(function(){
                                $('#due_paid_cus').click(function(){
                                    $('#add_privious_due_paid').openModal();
                                });
                                $('#add_paid_due').click(function(){
                                    if($('#input_due_paid').val() != ''){
                                        $.post('/add_due_paid',{ due: $('#input_due_paid').val(),id:{{$cus->id}}},function(e){
                                            if(e){
                                             Materialize.toast('Success',2000);
                                             $('#input_due_paid').val('');
                                             }
                                        });
                                    }
                                });
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_script')
    <script src="{{asset('js/app/customar.js')}}"></script>
@stop