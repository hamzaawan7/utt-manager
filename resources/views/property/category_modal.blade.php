<div class="modal fade bs-example-modal-lg" id="category" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Property Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="property_category" method="post" action="{{route('category-save')}}">
                <input type="hidden" name="category_id" id="category_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control">
                                <div class="text-danger clear-error" id="category_name_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       style="width: 20px; height: 20px; margin-top: 39px;"
                                       id="include_in_search_filter"
                                       name="include_in_search_filter">
                                <label class="form-check-label" for="include_in_search_filter"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Include In Search Filter</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       style="width: 20px; height: 20px; margin-top: 39px;"
                                       id="include_in_header"
                                       name="include_in_header">
                                <label class="form-check-label" for="include_in_header"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Include In Header</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addCategory()">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>