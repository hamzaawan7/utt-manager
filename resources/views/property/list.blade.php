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
                        <li class="breadcrumb-item"><h4><a href="#">Property List</a></h4></li>
                    </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb
                " role="navigation">
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
            <a href="" data-toggle="modal" data-target="#property-modal" class="reset_form">
                <button type="button" class="btn btn-success" id="proprty-button">Add Property</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="get_property table stripe hover nowrap">
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

                </tbody>
            </table>
        </div>
    </div>

    @include('property.property_modal')
@endsection
