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
                    <div class="rescalendar"></div>
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
                            <tr>
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
                                    <div class="calendar" id="calendar{{ $item->id }}"></div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
    <script>
        var ids = $(".calendar").map(function () {
            return this.id;
        }).get();

        $.each(ids, function (index, id) {
            new Calendar('#' + id, {
                style: 'background',
                minDate: new Date(),
            });
        })
    </script>
@endsection