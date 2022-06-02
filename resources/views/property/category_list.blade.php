@extends('layouts.main')
@section('content')

    @section('title') {{'Category List'}} @endsection
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb
                    " role="navigation">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><h4><a href="#">Property Category List</a></h4></li>
                    </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category List</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="" data-toggle="modal" data-target="#category" class="reset_category">
                <button type="button" class="btn btn-success">Add Property Category</button>
            </a>
        </div>
        <div class="pb-20">
            <table id="" class="get_category table stripe hover nowrap">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Standard Guest</th>
                    <th>Minimum Guest</th>
                    <th>Room Layout</th>
                    <th>Childs</th>
                    <th>Infants</th>
                    <th>Pets</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="">

                </tbody>
            </table>
        </div>
    </div>

    @include('property.category_modal')
@endsection
