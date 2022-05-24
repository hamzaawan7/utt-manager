<div class="modal fade bs-example-modal-lg" id="category" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Property Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="general-form" method="post" action="{{route('category-save')}}">
                <input type="hidden" name="cat_id" id="cat_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Standard Guest</label>
                                <input type="text" name="standard_guests" id="standard_guests" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Minimum Guest</label>
                                <input type="number" name="minimum_guest" id="minimum_guest" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Room Layout</label>
                                <select class="form-control" id="room_layouts" name="room_layouts">
                                    <option>Select</option>
                                    <option value="single_bed">Single Bed</option>
                                    <option value="double_bed">Double Bed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Childs</label>
                                <input type="number" name="childs" id="childs" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Infants</label>
                                <input type="number" name="infants" id="infants" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pets</label>
                                <input type="number" name="pets" id="pets" class="form-control">
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