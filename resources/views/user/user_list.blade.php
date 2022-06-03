@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="page-header">
            <div class="row">
                <div class="col-md-4 col-sm-4>
                    <nav aria-label=" breadcrumb
                " role="navigation">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><h4><a href="#">Manage User</a></h4></li>
                </ol>
                </nav>
            </div>
            <div class="col-md-4 col-sm-4>
                    <div class=" modal-dialog modal-dialog-centered modal-dialog-scrollable
            ">
        </div>

        <div class="col-md-4 col-sm-4>
             <nav aria-label=" breadcrumb
        " role="navigation">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
        </ol>
        </nav>
    </div>
</div>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <a href="#" data-toggle="modal" data-target="#user-modal" class="reset_user">
            <button class="btn btn-info">Add User</button>
        </a>
    </div>
    <div class="pb-20">
        <table id="" class="data-table table stripe hover nowrap">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="">
            @foreach ($users as $key => $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                           role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#" onclick="findUser('{{$user->id}}')">
                                <i class="dw dw-edit2"></i> Edit
                            </a>
                            <a class="dropdown-item" href="#"
                               onclick="deleteUser('{{$user->id}}')">
                                <i class="dw dw-delete-3"> Delete</i>
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

@include('user.user_modal')
</div>


</div>
@endsection
