@extends('layouts.main')
@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <a type="submit" class="btn btn-primary" href="{{route('property-list')}}">Back</a>
        </div> <br>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Owner</label>
                                <select class="custom-select2 form-control" id="owner_id"
                                        name="owner_name[]"
                                        multiple="multiple" style="width: 100%;">
                                    @foreach($owners as $item)
                                        <optgroup>
                                            <option value="{{$item->id}}">{{$item->owner_name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('owner_name')
                                <div class="text-danger"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Short Code</label>
                                <input type="text" name="short_code" id="short_code" class="form-control">
                                @error('short_code')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
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
                                @error('category_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
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
                                @error('feature_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                                @error('phone')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" onkeydown="return /[a-z]/i.test(event.key)" name="address" id="address" class="form-control">
                                @error('address')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Post Code</label>
                                <input type="number" name="post_code" id="post_code" class="form-control">
                                @error('post_code')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Special Category</label>
                                <input type="text" name="special_category" id="special_category"
                                       class="form-control">
                                @error('special_category')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
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
                                @error('main_image')<div class="text-danger">{{$message}}</div> @enderror
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
                                @error('images')<div class="text-danger">{{$message}}</div> @enderror
                            </div>
                            <div class="multi_images_main row">

                            </div>
                        </div>
                    </div>
                </section>
                <h5>Accommodation Section</h5>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Standard Guest</label>
                                <input type="number" name="standard_guests" id="standard_guests" class="form-control">
                                @error('standard_guests')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Minimum Guest</label>
                                <input type="number" name="minimum_guest" id="minimum_guest" class="form-control">
                                @error('minimum_guest')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Room Layout</label>
                                <select class="form-control" name="room_layouts">
                                    <option value="">Select</option>
                                    <option value="single_bed">Single Bed</option>
                                    <option value="double_bed">Double Bed</option>
                                </select>
                                @error('room_layouts')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Check In Time</label>
                                <input type="text" name="check_in_time" id="checkInTime"
                                       class="form-control datetimepicker" autocomplete="off">
                                @error('check_in_time')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Check Out Time</label>
                                <input type="text" name="check_out_time" id="checkOutTime"
                                       class="form-control datetimepicker" autocomplete="off">
                                @error('check_out_time')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Minimum Nights</label>
                                <input type="number" name="minimum_nights" id="minimum_nights" class="form-control">
                                @error('minimum_nights')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Childs</label>
                                <input type="number" name="childs" id="childs" class="form-control">
                                @error('childs')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Infants</label>
                                <input type="number" name="infants" id="infants" class="form-control">
                                @error('infants')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pets</label>
                                <input type="number" name="pets" id="pets" class="form-control">
                                @error('pets')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Season</label>
                                <select class="custom-select" name="season_id" id="season_id">
                                    <option value="">Select Season</option>
                                    @foreach($seasonList as $item)
                                        <option value="{{$item->id}}">{{$item->season_name}} </option>
                                    @endforeach
                                </select>
                                @error('season_id')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Special Start Days</label>
                                <input type="text" name="special_start_days" id="special_start_days"
                                       class="form-control datetimepicker" autocomplete="off">
                                @error('special_start_days')
                                 <div class="text-danger">{{$message}}</div>
                                @enderror
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
                            @error('min_seven_night_stay')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price Category</label>
                                <select class="form-control" id="price_category_id" name="price_category_id">
                                    <option value="">Select Price Category</option>
                                    @foreach($priceCategory as $item)
                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('price_category_id')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bank Account Number</label>
                                <input type="number" name="bank_account_number" class="form-control">
                                @error('bank_account_number')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
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
                                    <option value="">Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('star_rating_luxury')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Heritage</label>
                                <select class="form-control" name="star_rating_heritage">
                                    <option value="">Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('star_rating_heritage')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Unique</label>
                                <select class="form-control" name="star_rating_unique">
                                    <option value="">Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('star_rating_unique')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Green</label>
                                <select class="form-control" name="star_rating_green">
                                    <option value="">Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('star_rating_green')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating Price</label>
                                <select class="form-control" name="star_rating_price">
                                    <option value="">Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('star_rating_price')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
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
                                <input type="number" min="1" max="100" name="commission_rate" id="commission_rate"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Booking Fee %</label>
                                <input type="number" name="booking_fee" id="booking_fee" class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
                <h5>Contact Details</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Main Contact Name</label>
                                <input type="text" onkeydown="return /[a-z]/i.test(event.key)" name="main_contact_name" id="main_contact_name" class="form-control">
                                @error('main_contact_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Main Contact Number</label>
                                <input type="number" name="main_contact_number" id="main_contact_number"
                                       class="form-control">
                                @error('main_contact_number')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Secondary Contact Name</label>
                                <input type="text" onkeydown="return /[a-z]/i.test(event.key)" name="secondary_contact_name" id="secondary_contact_name"
                                       class="form-control">
                                @error('secondary_contact_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Secondary Contact Number</label>
                                <input type="number" name="secondary_contact_number" id="secondary_contact_number"
                                       class="form-control">
                                @error('secondary_contact_number')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Emergency Contact Name</label>
                                <input type="text" onkeydown="return /[a-z]/i.test(event.key)" name="emergency_contact_name" id="emergency_contact_name"
                                       class="form-control">
                                @error('emergency_contact_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Emergency Contact Number</label>
                                <input type="number" name="emergency_contact_number" id="emergency_contact_number"
                                       class="form-control">
                                @error('emergency_contact_number')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cleaning Rota Email</label>
                                <input type="text" name="cleaning_rota_receipts" id="cleaning_rota_receipts"
                                       class="form-control">
                                @error('cleaning_rota_receipts')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>
                <h5>Airbnb Sync</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>airbnb import - calendar url</label>
                                <input type="number" name="commission_rate" id="commission_rate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="is_visible"
                                       name="is_visible">
                                <label class="form-check-label" for="is_visible"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">airbnb
                                    export</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>airbnb export - password</label>
                                <input type="number" name="commission_rate" id="commission_rate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>airbnb export - url</label>
                                <input type="number" name="commission_rate" id="commission_rate" class="form-control"
                                       readonly>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

@endsection
