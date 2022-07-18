@extends('layouts.main')
@section('content')
    @if($owners->ownerProperties)
    @foreach($owners->ownerProperties as $ownerProperty)
        @if($ownerProperty->property->booking)
            @foreach($ownerProperty->property->booking as $ownerBooking)
    <div class="col-sm-12 col-md-12 mb-30">
        <div class="card card-box">
            <h5 class="card-header weight-500">{{$ownerProperty->name}}</h5>
            <div class="card-body">
                <h5 class="card-title">{{$ownerBooking->id}}</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </div>
            @endforeach
        @endif
    @endforeach
    @endif
@endsection