<div class="modal fade bs-example-modal-lg" id="season-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Season</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="price_season" method="post" action="{{route('price-season-save')}}">
                <input type="hidden" name="season_id" id="season_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Season Name</label>
                                <input type="text" name="season_name" id="season_name" class="form-control">
                                <div class="text-danger clear-error" id="season_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select type</label>
                                <select class="custom-select" name="type_id" id="type_id">
                                    <option selected="">Select Type</option>
                                    @foreach($type as $item)
                                        <option value="{{$item->id}}">{{$item->type}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="text" name="from_date" id="from_date" class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="from_date_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="text" name="to_date" id="to_date" class="form-control datetimepicker">
                                <div class="text-danger clear-error" id="to_date_error"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addSeason()">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>