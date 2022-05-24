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
                        <li class="breadcrumb-item"><h4><a href="#">Property Feature List</a></h4></li>
                    </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Feature List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="" data-toggle="modal" data-target="#category">
                <button type="button" class="btn btn-success">Add Property Feature</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="data-table table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Feature Name</th>
                    <th>Check In Time</th>
                    <th>Check Out Time</th>
                    <th>Minimum Nights</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">
                <?php $v = 1; ?>
                @foreach($featureList as $item)
                    <tr>
                        <td>{{$v}}</td>
                        <td>{{$item->feature_name}}</td>
                        <td>{{$item->check_in_time}}</td>
                        <td>{{$item->check_out_time}}</td>
                        <td>{{$item->minimum_nights}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#" onclick="editPropertyCategory('{{$item->id}}')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" href="/property/feature/delete/{{$item->id}}">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $v++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('property.feature_modal')
@endsection
