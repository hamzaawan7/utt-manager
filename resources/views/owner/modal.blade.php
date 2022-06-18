<div class="modal fade bs-example-modal-lg" id="owner-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Owner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="owner-form" method="post" action="{{route('owner-save')}}">
                <input type="hidden" name="owner_id" id="owner_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <div class="text-danger clear-error" id="name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                                <div class="text-danger clear-error" id="email_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="main-password-div">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="passwords" class="form-control" autocomplete="off">
                                <div class="text-danger clear-error" id="password_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control">
                                <div class="text-danger clear-error" id="password_confirmation_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                                <div class="text-danger clear-error" id="address_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Owner Contact Number</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                                <div class="text-danger clear-error" id="phone_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addOwner()">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>