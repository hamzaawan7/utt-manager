<div class="modal fade bs-example-modal-lg" id="availability-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Make a Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="margin-bottom: -50px;">
                <div class="tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-blue" data-toggle="tab" href="#customer" role="tab"
                               aria-selected="true">Customer Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blue" data-toggle="tab" href="#owner" role="tab"
                               aria-selected="false">Owner Booking</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="customer" role="tabpanel">
                            <div class="pd-20">
                                <form method="post" action="{{route('booking-save')}}" id="customer_booking">
                                    {{--<input type="hidden" name="guest_booking" value="{{$property->id}}">--}}
                                    <input type="hidden" name="hidden_from_date" id="hidden_from_date">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="text" class="form-control" name="from_date" id="from_date">
                                                <div class="text-danger clear-error" id="from_date_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="text" id="to_date" name="to_date" class="form-control">
                                                <div class="text-danger clear-error" id="to_date_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" id="first_name"
                                                       class="form-control">
                                                <div class="text-danger clear-error" id="first_name_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control">
                                                <div class="text-danger clear-error" id="last_name_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" id="email" class="form-control">
                                                <div class="text-danger clear-error" id="email_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Guests</label>
                                                <input type="number" name="guest" id="guest" class="form-control">
                                                <div class="text-danger clear-error" id="guest_error"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="price_main_div">

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <button type="button" class="btn btn-primary" onclick="addGuest()">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="owner" role="tabpanel">
                            <div class="pd-20">
                                <form method="post" action="{{route('booking-owner-save')}}" id="owner_booking">
                                   {{-- <input type="hidden" name="owner_booking" value="{{$property->id}}">--}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="text" class="form-control" name="from_date" id="owner_from_date">
                                                <div class="text-danger clear-error" id="from_date_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="text" class="form-control" name="to_date" id="owner_to_date">
                                                <div class="text-danger clear-error" id="to_date_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12" style="padding-bottom: 20px;">
                                            <label>Reason</label>
                                            <input type="text" class="form-control" name="reason" id="reason">
                                            <div class="text-danger clear-error" id="reason_error"></div>
                                        </div>
                                        <br>
                                        <div class="col-lg-2">
                                            <div><label for="Two Day">Two Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="two_day" name="days"
                                                       value="2" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Three Day">Three Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="three_day" name="days"
                                                       value="3" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Four Day">Four Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="four_day" name="days"
                                                       value="4" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Five Day">Five Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="five_day" name="days"
                                                       value="5" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Six Day">Six Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Six_day" name="days"
                                                       value="6" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Seven Day">Seven Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Six_day" name="days"
                                                       value="7" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Eight Day">Eight Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="eight_day" name="days"
                                                       value="8" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Nine Day">Nine Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="nine_day" name="days"
                                                       value="9" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Ten Day">Ten Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="ten_day" name="days"
                                                       value="10" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Eleven Day">Eleven Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="eleven_day" name="days"
                                                       value="11" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Eleven Day">Twelve Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="twelve_day" name="days"
                                                       value="12" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div><label for="Thirteen Day">Thirteen Day</label></div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="thirteen_day" name="days"
                                                       value="13" onclick="setDate();">
                                                <label for=""></label>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <button type="button" class="btn btn-primary" onclick="addOwnerBooking()">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
