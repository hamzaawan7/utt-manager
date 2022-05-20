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
                    <li class="breadcrumb-item"><h4><a href="#">Category List</a></h4></li>
                </ol>
                </nav>
            </div>
            <div class="col-md-4 col-sm-4>
                    <div class=" modal-dialog modal-dialog-centered modal-dialog-scrollable
            ">
            <a href="#" class="btn-block" data-toggle="modal" data-target="#category" type="button">
                <buttonb class="btn btn-info">Add Category</buttonb>
            </a>
        </div>

        <div class="col-md-4 col-sm-4>
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
        <h3 class="text-black h3">Category List</h3>
    </div>
    <div class="pb-20">
        <table id="" class="data-table table stripe hover nowrap">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="">
            @foreach($categoryList as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->category_name}}</td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                           role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#" onclick="editData('{{$item->id}}')">
                                <i class="dw dw-edit2"></i> Edit
                            </a>
                            <a class="dropdown-item" href="#" onclick="deleteData('{{$item->id}}')">
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

    <div class="modal fade bs-example-modal-lg" id="category" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="general-form" method="post" action="{{route('category-save')}}">
                    <input type="hidden" name="cat_id" id="cat_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control"
                                           name="name">
                                        <div class="text-danger" id="category_error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addData()">Save</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
