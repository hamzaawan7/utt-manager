@extends('layouts.main')

@section('title')
    {{'Availability List'}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><h4><a href="#">Availability List</a></h4></li>
                        </ol>
                    </div>

                    <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Availability List</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class='row'>
                        @for($i = 2; $i<=14; $i++)
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" class="selected-range-of-days-input" value="{{$i}}">
                                    <button type="button" id="multiple-hover" range="{{$i}}" value="{{$i}}"
                                            class="btn-danger multiple-hover selected-range-of-days"
                                            style="width: 50px; margin: 2px;">
                                        {{$i}}
                                    </button>
                                </div>
                            </div>
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
                        @foreach ($availabilityList as $item)
                            <tr class="main-img">
                                <td>{{$item->name}}</td>
                                <td><img src="{{asset('images/main/'.$item->main_image)}}" width="100" height="200">
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
                                               href="{{ url('/availability/individual/calendar', ['id' => $item->id]) }}">
                                                <i class="fa fa-eye"></i> Property Calendar
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="rescalendar" id="my_calendar"></div>
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
        const betweenDate = {!! json_encode($availabilityList[0]->dates, JSON_HEX_TAG) !!};
        console.log(betweenDate)
        $('.rescalendar').rescalendar({
            id: 'my_calendar',
            format: 'YYYY-MM-DD',
            dataKeyField: 'name',
            dataKeyValues: [''],
            disabledDays: betweenDate,
        });

        $(document).on("click", ".day_cell", function(e) {
            var from_date = $(this).attr('data-celldate');
            $('#availability-modal').modal('show');
        });

        $(document).ready(function () {
            let range = 2;
            $(".multiple-hover").click(function () {
                const getNoofDay = $(this).val();
                range = getNoofDay;
                $('.selected-range-of-days').removeClass('selected-day-rang')
                $(this).addClass('selected-day-rang');
            });

            $(document).on("mouseenter", ".rescalendar_day_cells .day_cell", function(e) {
                $('.multiple-hover')
                const from_date = $(this).attr('data-celldate');
                $(".rescalendar_day_cells .day_cell").removeClass('selected-from-date');
                $(this).addClass('selected startDate');
                const netAll = $(this).nextAll();
                for (let i = 0; i < range; i++) {
                    if(i === range.length) {
                        netAll[i].classList.add("end_date");
                        netAll[i].classList.remove("rescalendar_day_cells_hover");
                    } else {
                        netAll[i].classList.add("rescalendar_day_cells_hover");
                    }
                }
            });
            $(document).on("mouseleave", ".rescalendar_day_cells .day_cell", function(e) {
                $(".rescalendar_day_cells .day_cell").removeClass('rescalendar_day_cells_hover');
                $('.rescalendar_day_cells .day_cell').removeClass('startDate');
                $('.rescalendar_day_cells .day_cell').removeClass('end_date');
            });
        });

    </script>
@endsection