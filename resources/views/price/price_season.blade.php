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
                        <li class="breadcrumb-item"><h4><a href="#">Price Season List</a></h4></li>
                    </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Price Season List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="{{route('price-season-create')}}">
                <button type="submit" class="btn btn-success">Add Price Season</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="data-table table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($seasons as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->from_date}}</td>
                        <td>{{$item->to_date}}</td>
                        <td>{{$item->type}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item"
                                       href="{{ url('price/season/edit', ['id' => $item->id]) }}">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item"
                                       href="{{ url('/price/season/delete', ['id' => $item->id]) }}"
                                       onclick="return confirm('Are you sure?')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
