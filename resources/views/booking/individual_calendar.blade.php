@extends('layouts.main')
@section('content')

    @section('title')
        {{'Individual Calendar'}}
    @endsection

    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><h4><a href="#">{{$property->name}}</a></h4></li>
                        </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Availability List</li>
                        </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="calendar"></div>
            <input type="hidden" name="id" id="{{$property->id}}" class="property-id">
        </div>
    </div>
    @include('booking.availability_modal')
    <script src="{{asset('admin-dashboard-layout/scripts/core.js')}}"></script>
    <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
    <script>
        var finalDates = [];
        var betweenDate = {!! json_encode($finalDate, JSON_HEX_TAG) !!};
        $.each(betweenDate, function (index, value) {
            finalDates.push(new Date(value));
        });

        //Year Calendar
         new Calendar('#calendar', {
            style: 'background',
            minDate: new Date(),
            disabledDays: finalDates,
            clickDay: function (e) {
                $('#to_date').val('');
                $('#owner_to_date').val('');
                var d = e.date;
                var date = d.getDate();
                var month = d.getMonth() + 1;
                var year = d.getFullYear();
                var dateStr = year + "-" + month + "-" + date;
                $('#from_date').val(dateStr);
                $('#owner_from_date').val(dateStr);
                $('#availability-modal').modal('show');
                var id = $(".property-id").attr("id");
                var url = '/property/price/get/' + id + '';
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (response) {
                        $('.price_main_div').html('');
                        if (response.categoryName === 'Standard') {
                            var standrad_price = '';
                            standrad_price += ' <div class="row">\n' +
                                ' <input type="hidden" name="standrad" value="' + response.categoryName + '">\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <div><label for="Mon To Fri">Monday to Friday</label></div>\n' +
                                ' <input type="radio" id="monday_to_fridar" dateSelect="4" name="standrad_price" value="' + response.price_monday_to_friday + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.price_monday_to_friday + '">' + response.price_monday_to_friday + '</label>\n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <div><label for="Mon To Fri">Friday to Monday</label></div>\n' +
                                ' <input type="radio" id="friday_to_monday" dateSelect="4" name="standrad_price" value="' + response.price_friday_to_monday + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.price_friday_to_monday + '">' + response.price_friday_to_monday + '</label>\n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div><label for="Mon To Fri">Seven Nihgts</label></div>\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <input type="radio" id="s_seven_nights" dateSelect="7" name="standrad_price" value="' + response.price_seven_night + '" onclick="setPrice();">\n' +
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
                                ' <input type="radio" id="monday_to_fridar" dateSelect="1" name="standrad_price" value="' + response.price_friday_to_saturday + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.price_friday_to_saturday + '">' + response.price_friday_to_saturday + '</label>\n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <div><label for="Standing Charge">Standing Charge</label></div>\n' +
                                ' <input type="radio" id="standing_charge" dateSelect="1" name="standrad_price" value="' + response.price_standing_charge + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.price_standing_charge + '">' + response.price_standing_charge + '</label>\n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <div><label for="Sunday To Thursday">Sunday to Thursday</label></div>\n' +
                                ' <input type="radio" id="standing_charge" dateSelect="4" name="standrad_price" value="' + response.price_sunday_to_thursday + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.price_sunday_to_thursday + '">' + response.price_sunday_to_thursday + '</label>\n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <div><label for="Friday to Monday">Friday to Monday</label></div>\n' +
                                ' <input type="radio" id="standing_charge" dateSelect="3" name="standrad_price" value="' + response.weekend_friday_to_monday + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.weekend_friday_to_monday + '">' + response.weekend_friday_to_monday + '</label>\n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' <div class="col-lg-4">\n' +
                                ' <div><label for="Mon To Fri">Seven Nihgts</label></div>\n' +
                                ' <div class="custom-control custom-radio">\n' +
                                ' <input type="radio" id="s_seven_nights" dateSelect="7" name="standrad_price" value="' + response.price_seven_night + '" onclick="setPrice();">\n' +
                                ' <label for="' + response.price_seven_night + '">' + response.price_seven_night + '</label>\n' +
                                ' \n' +
                                ' </div>\n' +
                                ' </div>\n' +
                                ' </div>';
                            $('.price_main_div').append(flexible_price);
                        }
                    }
                });
            }
        });

        function setPrice() {
            var days = $("input[name='standrad_price']:checked").attr("dateSelect");
            var fromDate = $('#from_date').val();
            var date = new Date(Date.parse(fromDate));
            date.setDate(date.getDate() + parseInt(days));
            var d = date;
            var date = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            var dateStr = year + "-" + month + "-" + date;
            $('#to_date').val(dateStr);
        }
    </script>
@endsection
