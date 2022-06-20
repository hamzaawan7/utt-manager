<div class="modal fade bs-example-modal-lg" id="availability-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="customer-form" method="post" action="{{route('availability-save')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Availability</label>
                                <select class="form-control" name="availability" id="availability">
                                    <option value="">Select Availability</option>
                                    <option value="standard">Standard</option>
                                    <option value="flexible">Flexible</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="standard-availability hide">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Standard</label>
                                    <select class="form-control" name="standard" id="standardselect">
                                        <option value="">Select Availability</option>
                                        <option value="Seven Night">Seven Night</option>
                                        <option value="flexible">Monday Friday</option>
                                        <option value="flexible">Friday Monday</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flexible-availability hide">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="text" name="from_date" id="from_date" class="form-control datesevennight">
                                    <div class="text-danger clear-error" id="from_date_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="seven-night hide">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Seven Night Date</label>
                                        <input type="text" name="from_date" id="from_date" class="form-control">
                                        <div class="text-danger clear-error" id="from_date_error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addCustomer()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>