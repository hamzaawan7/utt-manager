@extends('layouts.main')
@section('content')
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <h4 class="text-blue h4">Step wizard vertical</h4>
                <p class="mb-30">jQuery Step wizard</p>
            </div>

            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard vertical"
                      method="post" action="{{route('property-save')}}" id="property_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="property_form">
                    <h5>General Information</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Property Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
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
                                                <option value="{{$item->id}}">{{$item->name}}</option>
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
                                            <option value="{{$item->id}}">{{$item->owner_name}} </option>
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
                                    <input type="text" name="short_code" id="short_code" class="form-control">
                                    <div class="text-danger clear-error" id="short_code_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="custom-select2 form-control" id="category_names"
                                            name="category_name[]"
                                            multiple="multiple" style="width: 100%;">
                                        @foreach($category as $item)
                                            <optgroup>
                                                <option value="{{$item->id}}">{{$item->category_name}}</option>
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
                                                <option value="{{$item->id}}">{{$item->feature_name}}</option>
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
                                    <input type="text" name="phone" id="phone" class="form-control">
                                    <div class="text-danger clear-error" id="phone_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                    <div class="text-danger clear-error" id="address_error"></div>
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
                                    <input type="text" name="special_category" id="special_category"
                                           class="form-control">
                                    <div class="text-danger clear-error" id="special_category_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Utt Star Rating</label>
                                    <input type="number" name="utt_star_rating" id="utt_star_rating"
                                           class="form-control">
                                    <div class="text-danger clear-error" id="utt_star_rating_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                           style="width: 20px; height: 20px; margin-top: 39px;" id="is_visible"
                                           name="is_visible">
                                    <label class="form-check-label" for="is_visible"
                                           style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Is
                                        Visible</label>
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
                                    <input type="text" name="standard_guests" id="standard_guests" class="form-control">
                                    <div class="text-danger clear-error" id="standard_guests_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Minimum Guest</label>
                                    <input type="number" name="minimum_guest" id="minimum_guest" class="form-control">
                                    <div class="text-danger clear-error" id="minimum_guest_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Room Layout</label>
                                    <select class="form-control" id="room_layouts" name="room_layouts">
                                        <option>Select</option>
                                        <option value="single_bed">Single Bed</option>
                                        <option value="double_bed">Double Bed</option>
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
                                           class="form-control datetimepicker">
                                    <div class="text-danger clear-error" id="check_in_time_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Check Out Time</label>
                                    <input type="text" name="check_out_time" id="checkOutTime"
                                           class="form-control datetimepicker">
                                    <div class="text-danger clear-error" id="check_out_time_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Minimum Nights</label>
                                    <input type="number" name="minimum_nights" id="minimum_nights" class="form-control">
                                    <div class="text-danger clear-error" id="minimum_nights_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Childs</label>
                                    <input type="number" name="childs" id="childs" class="form-control">
                                    <div class="text-danger clear-error" id="childs_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Infants</label>
                                    <input type="number" name="infants" id="infants" class="form-control">
                                    <div class="text-danger clear-error" id="infants_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pets</label>
                                    <input type="number" name="pets" id="pets" class="form-control">
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
                                            <option value="{{$item->id}}">{{$item->season_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Special Start Days</label>
                                    <input type="text" name="special_start_days" id="special_start_days"
                                           class="form-control datetimepicker">
                                    <div class="text-danger clear-error" id="check_in_time_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                           style="width: 20px; height: 20px; margin-top: 39px;"
                                           id="min_seven_night_stay"
                                           name="min_seven_night_stay">
                                    <label class="form-check-label" for="min_seven_night_stay"
                                           style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Minimum Seven
                                        Night Stay</label>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>

@endsection
