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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach ($availabilityList as $property)
                            <tr class="main-img">
                                <td>{{$property->name}}</td>
                                <td><img src="{{asset('images/main/'.$property->main_image)}}" width="100" height="200">
                                </td>
                                <td>
                                    <div class="dropdown">
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
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="rescalendar" id="my_calendar" property="{{$property->id}}"></div>
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
        let selectedPropertyId = 0;
        const betweenDate = '{!! json_encode($availabilityList[0]->dates) !!}';

        console.log(betweenDate);

        $('.rescalendar').rescalendar({
            id: 'my_calendar',
            format: 'YYYY-MM-DD',
            dataKeyField: 'name',
            dataKeyValues: [''],
            disabledDays: betweenDate,
        });

        $(document).ready(function () {
            let range = 2;

            $(".multiple-hover").click(function () {
                range = $(this).val();
                $('.selected-range-of-days').removeClass('selected-day-rang')
                $(this).addClass('selected-day-rang');
            });

            $(document).on("mouseenter", ".rescalendar_day_cells .day_cell", function (e) {
                $('.multiple-hover')
                const from_date = $(this).attr('data-celldate');
                $(".rescalendar_day_cells .day_cell").removeClass('selected rescalendar_day_cells_hover startDate end_date');
                $(this).addClass('selected  startDate');
                const netAll = $(this).nextAll();

                for (let i = 0; i < range; i++) {
                    if (i === range - 1) {
                        netAll[i].classList.add("selected");
                        netAll[i].classList.add("end_date");
                    } else {
                        netAll[i].classList.add("selected");
                        netAll[i].classList.add("rescalendar_day_cells_hover");
                    }
                }
            });

            $(document).on("mouseleave", ".rescalendar_day_cells .day_cell", function (e) {
                $(".rescalendar_day_cells .day_cell").removeClass('selected rescalendar_day_cells_hover startDate end_date');
            });

            $(document).on("mouseenter", ".rescalendar", function () {
                if ($(this).attr('property') !== undefined) {
                    selectedPropertyId = $(this).attr('property');
                }
            });

            $(document).on("click", ".day_cell", function () {
                if (selectedPropertyId) {
                    const from_date = $(this).attr('data-celldate');
                    var days = parseInt(range);

                    $('#property_id').val(selectedPropertyId);
                    $('#from_date').val(from_date);
                    $('#owner_from_date').val(from_date);
                    var date = new Date(Date.parse(from_date));
                    date.setDate(date.getDate() + parseInt(range));
                    var d = date;
                    var date = d.getDate();
                    var month = d.getMonth() + 1;
                    var year = d.getFullYear();
                    var dateStr = year + "-" + month + "-" + date;
                    $('#to_date').val(dateStr);
                    $('#owner_to_date').val(dateStr);
                    var id = $("#property_id").val();
                    var url = '/property/price/get/' + id + '';
                    $.ajax({
                        url: url,
                        method: 'get',
                        success: function (response) {
                            console.log(response)
                            if (response.discounts[0].code_type === 'One off - Fixed amount') {
                                var discount = response.discounts[0].value;
                                $('#discount_value').val(discount);
                            }
                            $('.discount').html('');
                            if(response.discounts) {
                                var discount = '';
                                discount += '<h5>Discount : '+response.discounts[0].value+'</h5>';
                            }
                            $('.discount').append(discount);
                            $('.price_main_div').html('');
                            if (response.categoryName === 'Standard') {
                                var standrad_price = '';
                                standrad_price += ' <div class="row">\n' +
                                    ' <input type="hidden" name="standrad" value="' + response.categoryName + '">\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <div><label for="Mon To Fri">Monday to Friday</label></div>\n' +
                                    ' <input type="radio" id="monday_to_fridar" name="standrad_price" value="' + response.price_monday_to_friday + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_monday_to_friday + '">' + response.price_monday_to_friday + '</label>\n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <div><label for="Mon To Fri">Friday to Monday</label></div>\n' +
                                    ' <input type="radio" id="friday_to_monday" name="standrad_price" value="' + response.price_friday_to_monday + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_friday_to_monday + '">' + response.price_friday_to_monday + '</label>\n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div><label for="Mon To Fri">Seven Nihgts</label></div>\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <input type="radio" id="s_seven_nights" name="standrad_price" value="' + response.price_seven_night + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_seven_night + '">' + response.price_seven_night + '</label>\n' +
                                    ' \n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' </div>';
                                $('.price_main_div').append(standrad_price);

                            }
                            if (response.categoryName === 'Flexible') {
                                var flexible_price = '';
                                flexible_price += ' <div class="row">\n' +
                                    ' <input type="hidden" name="flexible" value="' + response.categoryName + '">\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <div><label for="Fri To Sat">Friday to Saturday</label></div>\n' +
                                    ' <input type="radio" id="monday_to_fridar" dateSelect="1" name="standrad_price" value="' + response.price_friday_to_saturday + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_friday_to_saturday + '">' + response.price_friday_to_saturday + '</label>\n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <div><label for="Standing Charge">Standing Charge</label></div>\n' +
                                    ' <input type="radio" id="standing_charge" dateSelect="1" name="standrad_price" value="' + response.price_standing_charge + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_standing_charge + '">' + response.price_standing_charge + '</label>\n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <div><label for="Sunday To Thursday">Sunday to Thursday</label></div>\n' +
                                    ' <input type="radio" id="standing_charge" dateSelect="4" name="standrad_price" value="' + response.price_sunday_to_thursday + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_sunday_to_thursday + '">' + response.price_sunday_to_thursday + '</label>\n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <div><label for="Friday to Monday">Friday to Monday</label></div>\n' +
                                    ' <input type="radio" id="standing_charge" dateSelect="3" name="standrad_price" value="' + response.weekend_friday_to_monday + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.weekend_friday_to_monday + '">' + response.weekend_friday_to_monday + '</label>\n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' <div class="col-lg-4">\n' +
                                    ' <div><label for="Mon To Fri">Seven Nihgts</label></div>\n' +
                                    ' <div class="custom-control custom-radio">\n' +
                                    ' <input type="radio" id="s_seven_nights" dateSelect="7" name="standrad_price" value="' + response.price_seven_night + '" onclick="getPrice();">\n' +
                                    ' <label for="' + response.price_seven_night + '">' + response.price_seven_night + '</label>\n' +
                                    ' \n' +
                                    ' </div>\n' +
                                    ' </div>\n' +
                                    ' </div>';
                                $('.price_main_div').append(flexible_price);
                            }
                        }
                    });

                    $('#availability-modal').modal('show');
                }
            });
        });

        function getPrice() {
            var price = $("input[name='standrad_price']:checked").val();
            $('#price').val(price);
            var discount = $('#discount_value').val();
            var selectedPrice =  $('#price').val();
            var originalPrice = selectedPrice - discount;
            $('#total_price').val(originalPrice);
            $('#remaing_price').val(0);
            $("#total_price").keyup(function(){
                var totalPrice     = originalPrice;
                var changePrice    = $(this).val();
                var remainingPrice = totalPrice - changePrice;
                $('#remaing_price').val(remainingPrice);
            });
        }
    </script>
@endsection
