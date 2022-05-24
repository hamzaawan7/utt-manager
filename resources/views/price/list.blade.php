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
                        <li class="breadcrumb-item"><h4><a href="#">Price List</a></h4></li>
                    </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Price List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="{{route('price-season-create')}}">
                <button type="submit" class="btn btn-success">Add Price</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="data-table table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Property Name</th>
                    <th>Category Name</th>
                    <th>Season Name</th>
                    <th>Range</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">
                    <tr>
                        <td> 1 </td>
                        <td>Plaza</td>
                        <td>Category A</td>
                        <td>Winter</td>
                        <td>Monday To Friday</td>
                        <td>2000</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item"
                                       href="#">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item"
                                       href="#"
                                       onclick="return confirm('Are you sure?')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
