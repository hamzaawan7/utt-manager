@extends('layouts.main')
@section('content')

    @section('title') {{'Discount List'}} @endsection
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><h4><a href="#">Discount List</a></h4></li>
                        </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Discount List</li>
                        </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <a href="" data-toggle="modal" data-target="#discount-modal" class="reset_discount">
                        <button type="button" class="btn btn-success">Add Discount</button>
                    </a>
                </div>
                <div class="pb-20">
                    <table id="" class="get_discount table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Code</th>
                            <th>Active</th>
                            <th>Value</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="">

                        </tbody>
                    </table>
                </div>
            </div>

    @include('discount.discount_modal')
@endsection
