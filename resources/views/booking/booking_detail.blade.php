@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-4 col-sm-4>
                    <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><h4><a href="#">Booking Detail</a></h4></li>
                        </ol>
                        </nav>
                    </div>
                    <div class="col-md-4 col-sm-4>
                    <div class=" modal-dialog modal-dialog-centered modal-dialog-scrollable
                    ">
                </div>

                <div class="col-md-4 col-sm-4>
             <nav aria-label=" breadcrumb role="navigation">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking Detail</li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h5>Booking Detail</h5>
            </div>
            <div class="pb-20">
                <table id="" class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Property</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Customer Name</th>
                        <th>No of Guest</th>
                        <th>No of Night</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($bookings as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->from_date}}</td>
                            <td>{{$item->to_date}}</td>
                            <td>{{$item->first_name . ' '. $item->last_name}}</td>
                            <td>{{$item->guest}}</td>
                            <td>{{$item->minimum_nights}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                       role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#">
                                            <i class="icon-copy dw dw-book"></i> Booking Page
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

        <div class="card-box mb-30">
            <div class="pd-20">
                <h5>Holiday Details</h5>
            </div>
            <div class="pb-20">
                <table id="" class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>Property</th>
                        <th>Arrival date</th>
                        <th>Depart date</th>
                        <th>Customer Name</th>
                        <th>No of Nights</th>
                        <th>No of Adults</th>
                        <th>No of Children</th>
                        <th>No of Pets</th>
                        <th>No of Infants</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    <tr>
                        <td>Ajmal Town</td>
                        <td>1-6-2022</td>
                        <td>3-6-2022</td>
                        <td>Talha</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#">
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

        <div class="card-box mb-30">
            <div class="pd-20">
                <h5>Booking Details</h5>
            </div>
            <div class="pb-20">
                <table id="" class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>Booking Id</th>
                        <th>Booking Pin</th>
                        <th>Status</th>
                        <th>Booking</th>
                        <th>Reason</th>
                        <th>Other Booking</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    <tr>
                        <td>1</td>
                        <td>122233</td>
                        <td>Paid</td>
                        <td>25-6-2022</td>
                        <td>Owner Booking</td>
                        <td><a href="">other booking link</a></td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#">
                                        <i class="icon-copy fi-x"> Cancle Booking</i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h5>Customer Details</h5>
            </div>
            <div class="pb-20">
                <table id="" class="get_customer table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Post Code</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h5>Payment Details</h5>
            </div>
            <div class="pb-20">
                <table id="" class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>Total Price</th>
                        <th>Price Breakdown</th>
                        <th>Voucher Value</th>
                        <th>Discounts Used</th>
                        <th>Total Paid by customer</th>
                        <th>Deposit Amount</th>
                        <th>Total Balance Paid</th>
                        <th>Remaining Balance Paid</th>
                        <th>Balance Due Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    <tr>
                        <td>1200</td>
                        <td>Booking</td>
                        <td>Voucher amount</td>
                        <td>0033</td>
                        <td>1500</td>
                        <td>1200</td>
                        <td>1200</td>
                        <td>300</td>
                        <td>30-05-2022</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @include('customer.costomer_modal')
    </div>
@endsection
