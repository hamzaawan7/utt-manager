<div class="modal fade bs-example-modal-lg" id="property-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Property</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="general-form" base_path="{{url('/')}}" method="post" action="{{route('property-save')}}"
                  enctype="multipart/form-data">
                <input type="hidden" name="general_id" id="general_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Property Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <div class="text-danger" id="name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Nearby Property</label>
                                <select class="custom-select2 form-control" id="nearby_property"
                                        name="nearby_property[]"
                                        multiple="multiple" style="width: 100%;">
                                    @foreach($propertyList as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-danger" id="nearby_property_error"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Owner</label>
                                <select class="custom-select" name="owner_name" id="owner_id">
                                    <option selected="">Select Owner</option>
                                    @foreach($owners as $item)
                                        <option value="{{$item->id}}">{{$item->owner_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-danger" id="owner_name_error"></div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Short Code</label>
                                <input type="text" name="short_code" id="short_code" class="form-control">
                                <div class="text-danger" id="short_code_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select class="custom-select2 form-control" id="category_names" name="category_name[]"
                                        multiple="multiple" style="width: 100%;">
                                    @foreach($category as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="category_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Features</label>
                                <select class="custom-select2 form-control" id="feature_name" name="feature_name[]"
                                        multiple="multiple"
                                        style="width: 100%;">
                                    @foreach($features as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->feature_name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="feature_name_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                                <div class="text-danger" id="phone_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                                <div class="text-danger" id="address_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Post Code</label>
                                <input type="text" name="post_code" id="post_code" class="form-control">
                                <div class="text-danger" id="post_code_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Special Category</label>
                                <input type="text" name="special_category" id="special_category" class="form-control">
                                <div class="text-danger" id="special_category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Utt Star Rating</label>
                                <input type="text" name="utt_star_rating" id="utt_star_rating" class="form-control">
                                <div class="text-danger" id="utt_star_rating_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="is_visible"
                                       name="is_visible">
                                <label class="form-check-label" for="is_visible"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Is Visible</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Select Main Image</label>
                                <input class="form-control-file form-control height-auto" type="file" id="main_image"
                                       name="main_image">
                            </div>
                            <div class="main-images">

                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Select Multiple Image</label>
                                <input class="form-control-file form-control height-auto" id="images" name="images[]"
                                       type="file" multiple>
                            </div>
                            <div class="multi_images_main row">

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addProperty()">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>