<div class="modal fade bs-example-modal-lg" id="discount-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Discount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="discount_form" method="post" action="{{route('discount-save')}}">
                <input type="hidden" name="discount_id" id="discount_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" id="reference_code" class="form-control">
                                <div class="text-danger clear-error" id="code_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code Type</label>
                                <select class="form-control" name="code_type" id="code_type">
                                    <option value="">Select Code Type</option>
                                    <option value="One off - Percentage">One off - Percentage</option>
                                    <option value="One off - Fixed amount">One off - Fixed amount</option>
                                    <option value="Persistent - Percentage">Persistent - Percentage</option>
                                    <option value="Persistent - Fixed amount">Persistent - Fixed amount</option>
                                    <option value="Payment Voucher">Payment Voucher</option>
                                </select>
                                <div class="text-danger clear-error" id="code_type_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Value</label>
                                <input type="text" name="value" id="value" class="form-control">
                                <div class="text-danger clear-error" id="value_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" name="expiry_date" id="expiry_date"
                                       class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="expiry_date_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Property</label>
                                <select class="custom-select2 form-control" id="property_id"
                                        name="property_id[]"
                                        multiple="multiple" style="width: 100%;">
                                    @foreach($property as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="text-danger clear-error" id="property_id_error"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox1"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="all_property"
                                       name="all_property">
                                <label class="form-check-label" for="all_property"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">All Estate</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email"
                                       class="form-control">
                                <div class="text-danger clear-error" id="email_error"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox1"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="is_active"
                                       name="is_active">
                                <label class="form-check-label" for="is_active"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Is Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Holiday Start After</label>
                                <input type="text" name="holiday_start_after" id="holiday_must_start_after"
                                       class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="holiday_start_after_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Holiday Must Start By</label>
                                <input type="text" name="holiday_must_start_by" id="holiday_must_start_by"
                                       class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="holiday_must_start_by_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reason</label>
                                <input type="text" name="reason" id="reason"
                                       class="form-control">
                                <div class="text-danger clear-error" id="reason_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addDiscount()">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>