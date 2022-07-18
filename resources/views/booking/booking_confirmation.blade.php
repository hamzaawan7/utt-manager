@extends('layouts.main')

@section('title')
    {{'Booking Confirmation'}}
@endsection

@section('content')

    <div class="card-box mb-30">
           <div class="pd-20">
               <h5>Booking Confirmation</h5>
           </div>
           <div class="pb-20">
               <table id="" class="data-table table stripe hover nowrap">
                   <thead>
                   <tr>
                       <th>id</th>
                       <th>First Name</th>
                       <th>Last Name</th>
                       <th>Total Paid Amount</th>
                       <th>Status</th>
                   </tr>
                   </thead>
                   <tbody id="">
                   @foreach($bookingConsirmation as $item)
                   <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->first_name}}</td>
                       <td>{{$item->last_name}}</td>
                       <td>{{$item->total_price}}</td>
                       <td>{{$item->status}}</td>
                       {{--<td>
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
                       </td>--}}
                   </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       </div>

@endsection