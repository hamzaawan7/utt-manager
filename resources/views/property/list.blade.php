@extends('layouts.main')
@section('content')

    @section('title') {{'Property List'}} @endsection
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb role="navigation">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><h4><a href="#">Property List</a></h4></li>
                    </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Property List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="{{route("add-property")}}">
                <button type="button" class="btn btn-success" id="proprty-button">Add Property</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="data-table table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Property Name</th>
                    <th>Short Code</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Post Code</th>
                    <th>Special Category</th>
                    <th>Utt Star Rating</th>
                    <th>Is Visible</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">

                @if(!empty($propertyList))
                    <?php $v = 1; ?>
                    @foreach ($propertyList as $key => $item)

                        <tr>
                            <td>{{ $v }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->short_code }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->post_code }}</td>
                            <td>{{ $item->special_category }}</td>
                            <td>{{ $item->utt_star_rating }}</td>
                            <td>{{ $item->is_visible }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                       href="#"
                                       role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a href="{{ url('property/find', ['id' => $item->id]) }}" class="dropdown-item">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <a class="dropdown-item"
                                           href="{{ url('property/delete', ['id' => $item->id]) }}"
                                           onclick="return confirm('Are you sure?')">
                                            <i class="dw dw-delete-3"> Delete</i>
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <?php $v++; ?>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
