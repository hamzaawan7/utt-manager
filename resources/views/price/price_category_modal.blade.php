<div class="modal fade bs-example-modal-xl" id="price-category" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="price_category" method="post" action="{{route('price-category-save')}}">
                <input type="hidden" name="price_category_id" id="price_category_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select class="custom-select2 form-control" name="category_id"
                                        id="category_id" style="width: 100%; height: 38px;">
                                    @foreach($categories as $item)
                                        <optgroup>
                                            <option value="{{$item->id.'_'.$item->category_name}}">{{$item->category_name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="standard-main">

                    </div>
                    <div class="flexible-main">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="AddPriceCategory()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>