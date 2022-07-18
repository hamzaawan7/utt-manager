@extends('layouts.main')
@section('content')

    <div class="card-box mb-30">
        <div class="pd-20">
            <h5>Holiday Details</h5>
        </div>
        <div class="pb-20">
            <table id="" class="data-table table stripe hover nowrap">
                <thead>
                <tr>
                    <th>Owner Name</th>
                    <th>Owner Email</th>
                    <th>See Owner Statement</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($owners as $item)
                <tr>
                    <td>{{$item->owner_name}}</td>
                    <td>{{$item->email}}</td>
                    <td><a href="{{url('/owner/statement/detail',['id' => $item->id])}}" class="btn btn-info">See Details</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection