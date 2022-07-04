@extends('layouts.main')
@section('content')

    @section('title')
        {{'Cleaning Rota List'}}
    @endsection
    <div class="content-wrapper">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6>
                    <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><h4><a href="#">Cleaning Rota List</a></h4></li>
                        </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-6>
             <nav aria-label=" breadcrumb role="navigation">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cleaning Rota List</li>
                        </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label>Single Select</label>
                               <select class="custom-select2 form-control" name="property_id" id="property_id" style="width: 100%; height: 38px;">
                                       @foreach($property as $item)
                                       <option value="{{$item->id}}">{{$item->name}}</option>
                                       @endforeach
                               </select>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="pb-20">
                    <table id="" class="data-table table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Dates</th>
                            <th>Nights</th>
                            <th>guest</th>
                            <th>Comments</th>
                        </tr>
                        </thead>
                        <tbody class="cleaning-rota">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
