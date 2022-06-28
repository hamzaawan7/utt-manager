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
@endsection