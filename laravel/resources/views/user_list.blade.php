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
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <a href="#" class="btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                        <buttonb class="btn btn-info">Add User</buttonb>
                        </a>
                    </div>

            <div class="col-md-4 col-sm-4>
             <nav aria-label=" breadcrumb" role="navigation">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage User</li>
            </ol>
            </nav>
        </div>
</div>
    </div>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <h3 class="text-black h3">User List</h3>
    </div>
    <div class="pb-20">
        <table id="" class="data-table table stripe hover nowrap">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="">
            <tr>
                <td>1</td>
                <td>sheri</td>
                <td>boss</td>
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
                            <a class="dropdown-item" href="#"
                               onclick="return confirm('Are you sure?')" class="delete">
                                <i class="dw dw-delete-3"> Delete</i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


<div class="pd-20 card-box height-100-p">
    <h5 class="h4">Add User Role</h5>
    <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{route('user-role-save')}}" method="post">
                @csrf
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>password</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="text" class="form-control" name="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Roles</label>
                                <select class="form-control" name="role">
                                <option> Select Role </option>
                                    @foreach($roles as $role)
                                    <option value=" {{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Permissions</label>
                                <select class="form-control" name="permission">
                                <option>Select Permission</option>
                                    @foreach($permissions as $permission)
                                    <option value=" {{ $role->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


</div>
@endsection
