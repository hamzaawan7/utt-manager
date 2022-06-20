<div class="modal fade bs-example-modal-lg" id="type-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Price</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <table>
                <form id="type_form" method="post" action="{{route('price-save')}}"
                      enctype="multipart/form-data">
                    <input type="hidden" name="price_id" id="price_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="custom-select2 form-control" name="price_category_id"
                                            id="price_category_id" style="width: 100%; height: 38px;">
                                        @foreach($category as $item)
                                            <optgroup>
                                                <option value="{{$item->id.'_'.$item->category_name}}">{{$item->category_name}}</option>
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="main-standard">
                            @foreach($types as $key => $item)
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" name="types_{{$key}}"
                                                   value="{{$item->type.'_'.$item->id}}" class="form-control" readonly>
                                            <div class="text-danger clear-error" id="type_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <label for="year">Year</label>
                                            <input type="text" name="years_{{$key}}"
                                                   id="year" class="form-control year">
                                            <div class="text-danger clear-error" id="year_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Price Seven Nights</label>
                                            <input type="number" name="priceSevenNights_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="priceSevenNights_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Price Monday To Friday</label>
                                            <input type="number" name="mondayToFriday_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="mondayToFriday_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Price Friday To Monday</label>
                                            <input type="number" name="fridayToMonday_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="fridayToMonday_error"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="main-flexible hide">
                            @foreach($types as $key => $item)
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" name="type_{{$key}}" id="type"
                                                   value="{{$item->type.'_'.$item->id}}" class="form-control" readonly>
                                            <div class="text-danger clear-error" id="type_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" name="yearf_{{$key}}"
                                                   id="year" class="form-control year">
                                            <div class="text-danger clear-error" id="year_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Standing Charge</label>
                                            <input type="number" name="standingCharge_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="standingCharge_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Sunday-to-Thursday</label>
                                            <input type="number" name="sundayToThursday_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="sundayToThursday_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Friday-to-Saturday</label>
                                            <input type="number" name="fridayToSaturday_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="fridayToSaturday_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Price-Seven-Nights</label>
                                            <input type="number" name="sevenNightsPrice_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="sevenNightsPrice_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Weekend-Price</label>
                                            <input type="number" name="weekendPrice_{{$key}}"
                                                   id="utt_star_rating" class="form-control">
                                            <div class="text-danger clear-error" id="weekendPrice_error"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="addPrice()">Save</button>
                        </div>
                    </div>
                </form>
            </table>
        </div>
    </div>
</div>