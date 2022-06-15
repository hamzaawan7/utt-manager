@extends('layouts.main')
@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <a type="submit" class="btn btn-primary" href="{{route('property-list')}}">Back</a>
        </div>

        <div class="wizard-content">
            <form class="tab-wizard wizard-circle wizard vertical"
                  method="post" action="{{route('property-save')}}" id="property_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="property_id" value="{{$property->id}}">
                <h5>General Information</h5>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Property Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{$property->name}}">
                                <div class="text-danger clear-error" id="name_error"></div>
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
                                            <option value="{{$item->id}}" {{ in_array($item->id, $property->nearbyProperties) ? 'selected="selected"' : '' }}>{{$item->name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-danger clear-error" id="nearby_property_error"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Owner</label>
                                <select class="custom-select" name="owner_name" id="owner_id">
                                    <option selected="">Select Owner</option>
                                    @foreach($owners as $item)
                                        <option value="{{$item->id}}" {{ $property->owner_id == $item->id ? 'selected' : '' }}>{{$item->owner_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-danger clear-error" id="owner_name_error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Short Code</label>
                                <input type="text" name="short_code" id="short_code" class="form-control"
                                       value="{{$property->short_code}}">
                                <div class="text-danger clear-error" id="short_code_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select class="custom-select2 form-control" id="category_names" name="category_name[]"
                                        multiple="multiple" style="width: 100%;">
                                    @foreach($category as $item)

                                        <optgroup>
                                            <option value="{{$item->id}}" {{ in_array($item->id, $property->categories) ? 'selected="selected"' : '' }}> {{$item->category_name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="text-danger clear-error" id="category_name_error"></div>
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
                                            <option value="{{$item->id}}" {{ in_array($item->id, $property->features) ? 'selected="selected"' : '' }}>{{$item->feature_name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="text-danger clear-error" id="feature_name_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                       value="{{$property->phone}}">
                                <div class="text-danger clear-error" id="phone_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                       value="{{$property->address}}">
                                <div class="text-danger clear-error" id="address_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Post Code</label>
                                <input type="text" name="post_code" id="post_code" class="form-control"
                                       value="{{$property->post_code}}">
                                <div class="text-danger" id="post_code_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Special Category</label>
                                <input type="text" name="special_category" id="special_category" class="form-control"
                                       value="{{$property->special_category}}">
                                <div class="text-danger clear-error" id="special_category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="is_visible"
                                       name="is_visible" {{  ($property->is_visible == 1 ? ' checked' : '') }}>
                                <label class="form-check-label" for="is_visible"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Is Visible</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Select Main Image</label>
                                <input class="form-control-file form-control height-auto img-tag" type="file"
                                       id="main_image"
                                       name="main_image">
                            </div>
                            <div class="main-images">
                                <div class="image_div col-lg-4" id="{{$property->id}}">
                                    <img src="{{asset('images/main/'.$property->main_image)}}" width="200px">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Select Multiple Image</label>
                                <input class="form-control-file form-control height-auto img-tag" id="images"
                                       name="images[]"
                                       type="file" multiple>
                            </div>
                            <div class="multi_images_main row">
                                @foreach($property->images as $image)
                                    <div class="image_div col-lg-2" id="{{$image->id}}">
                                        <img src="{{asset('images/multiple/'.$image->images)}}" width="150px">
                                        <span class="close_icon delete-images"><i class="icon-copy fa fa-trash fa-2x"
                                                                                  aria-hidden="true"></i></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h5>Accomodation</h5>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Standard Guest</label>
                                <input type="text" name="standard_guests" id="standard_guests" class="form-control"
                                       value="{{$property->standard_guests}}">
                                <div class="text-danger clear-error" id="standard_guests_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Minimum Guest</label>
                                <input type="number" name="minimum_guest" id="minimum_guest" class="form-control"
                                       value="{{$property->minimum_guest}}">
                                <div class="text-danger clear-error" id="minimum_guest_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Room Layout</label>
                                <select class="form-control" id="room_layouts" name="room_layouts">
                                    <option>Select</option>
                                    <option value="single_bed" {{ $property->room_layouts == 'single_bed' ? 'selected' : '' }}>
                                        Single Bed
                                    </option>
                                    <option value="double_bed" {{ $property->room_layouts == 'double_bed' ? 'selected' : '' }}>
                                        Double Bed
                                    </option>
                                </select>
                                <div class="text-danger clear-error" id="room_layouts_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Check In Time</label>
                                <input type="text" name="check_in_time" id="checkInTime"
                                       class="form-control datetimepicker"
                                       value="{{$property->check_in_time}}">
                                <div class="text-danger clear-error" id="check_in_time_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Check Out Time</label>
                                <input type="text" name="check_out_time" id="checkOutTime"
                                       class="form-control datetimepicker"
                                       value="{{$property->check_out_time}}">
                                <div class="text-danger clear-error" id="check_out_time_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Minimum Nights</label>
                                <input type="number" name="minimum_nights" id="minimum_nights" class="form-control"
                                       value="{{$property->minimum_nights}}">
                                <div class="text-danger clear-error" id="minimum_nights_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Childs</label>
                                <input type="number" name="childs" id="childs" class="form-control"
                                       value="{{$property->childs}}">
                                <div class="text-danger clear-error" id="childs_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Infants</label>
                                <input type="number" name="infants" id="infants" class="form-control"
                                       value="{{$property->infants}}">
                                <div class="text-danger clear-error" id="infants_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pets</label>
                                <input type="number" name="pets" id="pets" class="form-control"
                                       value="{{$property->pets}}">
                                <div class="text-danger clear-error" id="pets_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Owner</label>
                                <select class="custom-select" name="season_id" id="season_id">
                                    <option selected="">Select Season</option>
                                    @foreach($seasonList as $item)
                                        <option value="{{$item->id}}" {{ $property->season_id == $item->id ? 'selected' : '' }}>{{$item->season_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Special Start Days</label>
                                <input type="text" name="special_start_days" id="special_start_days"
                                       class="form-control datetimepicker"
                                       value="{{$property->special_start_days}}">
                                <div class="text-danger clear-error" id="check_in_time_error"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="min_seven_night_stay"
                                       name="min_seven_night_stay" {{  ($property->min_seven_night_stay == 1 ? ' checked' : '') }}>
                                <label class="form-check-label" for="min_seven_night_stay"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Minimum Seven Night
                                    Stay</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price Category</label>
                                <select class="form-control" id="price_category_id" name="price_category_id">
                                    <option>Select Price Category</option>
                                    @foreach($priceCategory as $item)
                                        <option value="{{$item->id}}" {{ $property->price_category_id == $item->id ? 'selected' : '' }}>{{$item->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <h5>Utt Star Rating</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Luxury</label>
                                <select class="form-control" name="star_rating_luxury">
                                    <option>Select Rating</option>
                                    <option value="1" {{ $property->starRatings[0]->star_rating_luxury == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option value="2" {{ $property->starRatings[0]->star_rating_luxury == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option value="3" {{ $property->starRatings[0]->star_rating_luxury == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option value="4" {{ $property->starRatings[0]->star_rating_luxury == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option value="5" {{ $property->starRatings[0]->star_rating_luxury == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Heritage</label>
                                <select class="form-control" name="star_rating_heritage">
                                    <option>Select Rating</option>
                                    <option value="1" {{ $property->starRatings[0]->star_rating_heritage == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option value="2" {{ $property->starRatings[0]->star_rating_heritage == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option value="3" {{ $property->starRatings[0]->star_rating_heritage == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option value="4" {{ $property->starRatings[0]->star_rating_heritage == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option value="5" {{ $property->starRatings[0]->star_rating_heritage == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Unique</label>
                                <select class="form-control" name="star_rating_unique">
                                    <option>Select Rating</option>
                                    <option value="1" {{ $property->starRatings[0]->star_rating_unique == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option value="2" {{ $property->starRatings[0]->star_rating_unique == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option value="3" {{ $property->starRatings[0]->star_rating_unique == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option value="4" {{ $property->starRatings[0]->star_rating_unique == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option value="5" {{ $property->starRatings[0]->star_rating_unique == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Green</label>
                                <select class="form-control" name="star_rating_green">
                                    <option>Select Rating</option>
                                    <option value="1" {{ $property->starRatings[0]->star_rating_green == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option value="2" {{ $property->starRatings[0]->star_rating_green == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option value="3" {{ $property->starRatings[0]->star_rating_green == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option value="4" {{ $property->starRatings[0]->star_rating_green == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option value="5" {{ $property->starRatings[0]->star_rating_green == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Price</label>
                                <select class="form-control" name="star_rating_price">
                                    <option>Select Rating</option>
                                    <option value="1" {{ $property->starRatings[0]->star_rating_price == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option value="2" {{ $property->starRatings[0]->star_rating_price == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option value="3" {{ $property->starRatings[0]->star_rating_price == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option value="4" {{ $property->starRatings[0]->star_rating_price == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option value="5" {{ $property->starRatings[0]->star_rating_price == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <h5>Property Setting</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Commission Rate %</label>
                                <input type="number" name="commission_rate" id="commission_rate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Booking Fee</label>
                                <input type="number" name="booking_fee" id="booking_fee" class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection
