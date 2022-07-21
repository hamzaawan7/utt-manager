@extends('layouts.main')

@section('content')
    @if(@$owners->ownerProperties)
        <div class="container-fluid print-btn">
            <a href="{{url('/owner/statement/print',['id' => $owners->id])}}" target="_blank"><i
                        class="micon fa fa-print fa-2x" aria-hidden="true"></i></a>
        </div>
        @foreach($owners->ownerProperties as $ownerProperty)
            @if($ownerProperty->property->bookings)
                <div class="col-sm-12 col-md-12 mb-30">
                    <div class="card card-box">
                        <h5 class="card-header weight-500">{{$ownerProperty->property->name}}</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guest Name</th>
                                <th>Start Date</th>
                                <th>Income</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_income=0;
                            @endphp
                            @foreach($ownerProperty->property->bookings as $ownerBooking)
                                @php
                                    $total_income+=$ownerBooking->total_price;
                                @endphp
                                <tr>
                                    <td>{{$ownerBooking->id}}</td>
                                    <td>{{$ownerBooking->first_name . $ownerBooking->last_name}}</td>
                                    <td>{{$ownerBooking->from_date}}</td>
                                    <td>{{$ownerBooking->total_price}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="total-income">{{$total_income}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h4 style="text-align: center; margin-top: 20px;">No Record Found</h4>
            @endif
        @endforeach
    @else
        <h4 style="text-align: center; margin-top: 20px;">No Record Found</h4>
    @endif
@endsection
