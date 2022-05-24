@extends('layouts.main')

@section('content')

    <div class="content-wrapper">

        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb
                    " role="navigation">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><h4><a href="#">Add Price Season</a></h4></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Season</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>
    </div>

    <div class="pd-10  col-md-8 card-box mb-8 " style="padding: 25px; margin: auto;">
        <form method="post" action="{{route('price-season-save')}}">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Season Name</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                               {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Season Type</label>
                            <input type="text" name="type" class="form-control">
                            @error('type')
                               {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="text" name="from_date" class="form-control datepicker">
                            @error('from_date')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="text" name="to_date" class="form-control datepicker">
                            @error('to_date')
                               {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-md-12">
                    <input type="submit" class="btn btn-success" value="Save">
                </div>
            </div>
        </form>
    </div>
@endsection