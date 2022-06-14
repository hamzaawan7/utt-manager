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
                        <li class="breadcrumb-item"><h4><a href="#">Type List</a></h4></li>
                    </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Type List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="" data-toggle="modal" data-target="#type-modal" class="">
                <button type="button" class="btn btn-success" id="proprty-button">Add Type</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="get_type table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Type</th>
                    <th>Price Seven Nights</th>
                    <th>Monday-Friday</th>
                    <th>Friday-Monday</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">

                </tbody>
            </table>
        </div>
    </div>

    @include('type.type_modal')
@endsection
