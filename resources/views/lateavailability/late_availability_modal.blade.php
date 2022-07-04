<div class="modal fade bs-example-modal-lg" id="late-availability-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Discount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="late_availability_form" method="post" action="{{route('late-availability-save')}}">
                <input type="hidden" name="late_availability_id" id="late_availability_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No of Days</label>
                                <input type="number" name="days" id="days" class="form-control">
                                <div class="text-danger clear-error" id="days_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Value %</label>
                                <input type="number" name="value" id="value" class="form-control">
                                <div class="text-danger clear-error" id="value_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Start Date</label>
                                <input type="text" name="start_date" id="start_date"
                                       class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="start_date_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Expiry Date</label>
                                <input type="text" name="expiry_date" id="expiry_date"
                                       class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="expiry_date_error"></div>
                            </div>
                        </div>
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
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="addLateAvailability()">Save</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>