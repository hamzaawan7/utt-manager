@extends('layouts.main')

@section('title')
    {{'Availability List'}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><h4><a href="#">Availability List</a></h4></li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Availability List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class="row justify-content-center">
                        @for($i = 2; $i<=14; $i++)
                            <input type="hidden" class="selected-range-of-days-input" value="{{$i}}">
                            <button type="button" id="multiple-hover" range="{{$i}}" value="{{$i}}"
                                    class="btn btn- multiple-hover selected-range-of-days"
                                    style="width: 50px; margin: 2px;">
                                {{$i}}
                            </button>
                        @endfor
                    </div>
                </div>
                <div class="pb-20">
                    <table id="" class="data-table table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th>Property Name</th>
                            <th>Image</th>
                            {{--<th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach ($availabilityList as $property)
                            <tr class="main-img">
                                <td>{{$property->name}}</td>
                                <td><img src="{{asset('images/main/'.$property->main_image)}}" width="100" height="200">
                                </td>
                                <td>
                                    {{--<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                           href="#"
                                           role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item"
                                               href="{{ url('/availability/individual/calendar', ['id' => $property->id]) }}">
                                                <i class="fa fa-eye"></i> Property Calendar
                                            </a>
                                        </div>
                                    </div>--}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="rescalendar_{{$property->id}} rescalendar" id="my_calendar"
                                         property="{{$property->id}}"></div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('booking.availability_modal')
@endsection

@section('scripts')
    <script src="{{asset('src/js/rescalendar.js')}}"></script>
    <script>
		$(document).ready(function () {
			let selectedPropertyId = 0;
			let totalPrice = 0;
			let price = 0;
			let range = 2;
			let fromDate = 0;
			let fromDay = 0;
			let toDate = 0;
			let toDay = 0;
			let disableAllDates = [];
			const disabledDates = '{!! json_encode($availabilityList) !!}';

			$.each(JSON.parse(disabledDates), function (index, value) {
				$('.rescalendar_' + value.id).rescalendar({
					id: 'my_calendar',
					format: 'YYYY-MM-DD',
					dataKeyField: 'name',
					dataKeyValues: [''],
					jumpSize: 2,
					disabledDays: value.dates,
				});
			});

			$(document).on("mouseenter", ".rescalendar", function () {
				if ($(this).attr('property') !== undefined) {
					selectedPropertyId = $(this).attr('property');
					$.each(JSON.parse(disabledDates), function (index, value) {
						if (value.id == selectedPropertyId) {
							disableAllDates = value.dates
						}
					})
				}
			});

			$(".multiple-hover").click(function () {
				range = $(this).val();
				$('.selected-range-of-days').removeClass('selected-day-rang')
				$(this).addClass('selected-day-rang');
			});
			$(document).on("mouseenter", ".rescalendar_day_cells .day_cell", function (e) {
				$("#customer_booking")[0].reset();
				fromDay = '';
				toDay = '';
				const startDateCheck = $(this).attr('data-celldate');
				$('.multiple-hover')
				$(".rescalendar_day_cells .day_cell").removeClass('selected rescalendar_day_cells_hover startDate end_date');
				$(this).addClass('selected  startDate');
				$(this).attr("data-property", selectedPropertyId);
				const nextAll = $(this).nextAll();
				for (let i = 0; i < range; i++) {
					if (i === range - 1) {
						$(nextAll[i]).addClass("selected end_date");
					} else {
						$(nextAll[i]).addClass("selected rescalendar_day_cells_hover");
					}
				}
				for (let i = 0; i < range; i++) {
					if (disableAllDates.includes($(this).attr('data-celldate'))
						|| disableAllDates.includes($(nextAll[i]).attr('data-celldate'))) {
						const dNextAll = $(this).nextAll();
						$(this).removeClass("selected end_date startDate rescalendar_day_cells_hover");
						$(this).addClass("disabledDay");
						for (let j = 0; j < range; j++) {
							$(dNextAll[j]).removeClass("selected end_date rescalendar_day_cells_hover");
							$(dNextAll[j]).addClass("disabledDay");
							$(dNextAll[j]).attr("data-property", selectedPropertyId);
						}
					}
				}

				var url = '/property/price/get/' + selectedPropertyId + '';
				$.ajax({
					url: url,
					method: 'get',
					success: function (response) {
						var categoryName = response.categoryName;
						if (categoryName === 'Standard') {
							$('#property_id').val(selectedPropertyId);
							$('#owner_property_id').val(selectedPropertyId);
							fromDate = startDateCheck;
							fromDay = getDayName(new Date(fromDate))
							var date = new Date(Date.parse(startDateCheck));
							date.setDate(date.getDate() + parseInt(range));
							var d = date;
							var date = d.getDate();
							var month = d.getMonth() + 1;
							var year = d.getFullYear();
							toDate = year + "-" + month + "-" + date;
							toDay = getDayName(new Date(toDate));
							/*responseFromDate = fromDate;
							responseToDate = toDate;
							PriceSevenNights = response.price_seven_night;
							PriceFridayToMonday = response.price_friday_to_monday;
							PriceModayToFriday = response.price_monday_to_friday;*/
							if (fromDay == 'Friday' && toDay == 'Monday' && range == 3) {
								totalPrice = response.price_friday_to_monday;
								price = response.price_friday_to_monday;
							}
							if (fromDay == 'Monday' && toDay == 'Saturday' && range == 5) {
								totalPrice = response.price_monday_to_friday;
								price = response.price_monday_to_friday;
							}

							if (fromDay == 'Monday' && toDay == 'Monday' && range == 7) {
								totalPrice = response.price_seven_night;
								price = response.price_seven_night;
							}
							/*else {
								toastr.warning('This Property is Standard Please Select Range Between 3 and 5 and 7', 'warning');
							}*/
						} else {
							toastr.warning('This Property is not Standard', 'warning');
						}
					}
				});
			});

			$(document).on("click", ".day_cell", function () {
				if ((fromDay == 'Friday' && toDay == 'Monday' && range == 3)
					|| (fromDay == 'Monday' && toDay == 'Saturday' && range == 5)
					|| (fromDay == 'Monday' && toDay == 'Saturday' && range == 5)) {
					$('#availability-modal').modal('show');

					$('#total_price').attr('value', totalPrice);
					$('#price').attr('value', totalPrice);
					$('#from_date').val(fromDate);
					$('#to_date').val(toDate);
					$('#owner_from_date').val(fromDate);
					$('#owner_to_date').val(toDate);
				}

				$(this).attr('data-celldate', '');
				if ($(this).attr('class') === 'day_cell middleDay disabledDay' || $(this).attr('class') === 'day_cell disabledDay') {
					toastr.warning("Dates Not Available", 'warning');
					return;
				}
			});

			function getDayName(date = new Date(), locale = 'en-US') {
				return date.toLocaleDateString(locale, {weekday: 'long'});
			}

			$(document).on("mouseleave", ".rescalendar_day_cells .day_cell", function (e) {
				$(".rescalendar_day_cells .day_cell").removeClass('selected rescalendar_day_cells_hover  startDate end_date');
				$('.day_cell').each(function (index, day_cell) {
					if (($(this).attr('data-property') === selectedPropertyId) && (!disableAllDates.includes($(this).attr('data-celldate')))) {
						$(this).removeClass("disabledDay");
					}
				});
			});

			function getPrice() {
				var price = $("input[name='standrad_price']:checked").val();
				$('#price').val(price);
				var discount = $('#discount_value').val();
				var selectedPrice = $('#price').val();
				var originalPrice = selectedPrice - discount;
				$('#total_price').val(originalPrice);
				$('#remaing_price').val(0);
			}

			$("#total_price").keyup(function () {

					var price = $('#price').val();
					var payAmount = parseInt($(this).val());
					var totalPrice = parseInt(price);
					var changePrice = parseInt($(this).val());
					if (!isNaN(payAmount)) {
						if (payAmount <= totalPrice) {
							var remainingPrice = totalPrice - changePrice;
							$('#remaing_price').val(remainingPrice);
						} else {
							$(this).val(0);
							$('#remaing_price').val(totalPrice);
						}
					} else {
						$('#remaing_price').val(totalPrice);
					}
				}
			);
		});
    </script>
@endsection
