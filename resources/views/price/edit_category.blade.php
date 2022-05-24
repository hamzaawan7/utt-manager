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
                        <li class="breadcrumb-item"><h4><a href="#">Edit Price Category</a></h4></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>
    </div>

    <div class="pd-10  col-md-6 card-box mb-10 " style="padding: 25px; margin: auto;">
        <form method="post" action="{{route('price-category-update')}}">
            @csrf
            <input type="hidden" value="{{$category->id}}" name="category_id">
            <div class="form-group">
                <div class="col-sm-4 col-md-12">
                    <label class="col-form-label">Price Category</label>
                    <input class="form-control" name="category_name" type="text" placeholder="Enter Price Category"
                           value="{{$category->category}}">
                    @error('category_name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-md-12">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection