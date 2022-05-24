<div class="modal fade bs-example-modal-lg" id="category" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Price Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="general-form" method="post" action="{{route('price-season-save')}}">
                <input type="hidden" name="season_id" id="season_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Season Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Season Type</label>
                                <input type="text" name="type" id="type" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="text" name="from_date" id="from_date" class="form-control datepicker">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="text" name="to_date" id="to_date" class="form-control datepicker">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addData()">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>