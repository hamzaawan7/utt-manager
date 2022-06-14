<div class="modal fade bs-example-modal-lg" id="price-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Price</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="price" method="post" action="{{route('price-save')}}">
                <input type="hidden" name="price_id" id="price_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select class="custom-select2 form-control" name="price_category_id"
                                        id="price_category_id" style="width: 100%; height: 38px;">
                                    @foreach($category as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        </optgroup>
                                        <div class="text-danger clear-error" id="price_category_id_error"></div>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Price</label>
                                <select class="custom-select2 form-control" name="type_id"
                                       id="type_id" style="width: 100%; height: 38px;">
                                    @foreach($type as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->type}}</option>
                                        </optgroup>
                                        <div class="text-danger clear-error" id="type_id_error"></div>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>price 7 nights</label>
                                <input type="number" name="price_seven_night" id="price_seven_night" class="form-control">
                                <div class="text-danger clear-error" id="price_seven_night_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>price monday-friday</label>
                                <input type="number" name="price_monday_to_friday" id="price_monday_to_friday" class="form-control">
                                <div class="text-danger clear-error" id="price_monday_to_friday_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>price friday-monday</label>
                                <input type="number" name="price_friday_to_monday" id="price_friday_to_monday" class="form-control">
                                <div class="text-danger clear-error" id="price_friday_to_monday_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addPrice()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>