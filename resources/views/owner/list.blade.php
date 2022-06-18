@extends('layouts.main')
@section('content')

    @section('title') {{'Owner List'}} @endsection
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb role="navigation">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><h4><a href="#">Owner List</a></h4></li>
                    </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Owner List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="" data-toggle="modal" data-target="#owner-modal" class="reset_owner">
                <button type="button" class="btn btn-success">Add Owner</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="get_owner table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">

                </tbody>
            </table>
        </div>
    </div>

    @include('owner.modal')
@endsection
