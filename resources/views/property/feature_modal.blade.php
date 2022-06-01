<div class="modal fade bs-example-modal-lg" id="feature-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Property Feature</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="property_feature" method="post" action="{{route('feature-save')}}">
                <input type="hidden" name="feature_id" id="feature_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Feature Name</label>
                                <input type="text" name="feature_name" id="feature_name" class="form-control">
                                <div class="text-danger" id="feature_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Minimum Nights</label>
                                <input type="number" name="minimum_nights" id="minimum_nights" class="form-control">
                                <div class="text-danger" id="minimum_nights_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Check In Time</label>
                                <input type="text" name="check_in_time" id="checkInTime" class="form-control datetimepicker">
                                <div class="text-danger" id="check_in_time_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Check Out Time</label>
                                <input type="text" name="check_out_time" id="checkOutTime" class="form-control datetimepicker">
                                <div class="text-danger" id="check_out_time_error"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addFeature()">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>