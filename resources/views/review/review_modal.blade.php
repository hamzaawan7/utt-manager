<div class="modal fade bs-example-modal-lg" id="review-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Update Review</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="review_feature" method="post" action="{{route('review-save')}}">
                <input type="hidden" name="review_id" id="review_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Comment</label>
                                <input type="text" name="comment" id="comment" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Star Rating</label>
                                <input type="number" name="star_rating" id="star_rating" class="form-control">
                                <div class="text-danger" id="category_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox1"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="is_accept"
                                       name="is_accept">
                                <label class="form-check-label" for="is_accept"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Is Accept</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox1"
                                       style="width: 20px; height: 20px; margin-top: 39px;" id="is_show"
                                       name="is_show">
                                <label class="form-check-label" for="is_show"
                                       style="font-size: 20px; margin-left: 5px; margin-top: 34px;">Is Show</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addReview()">Save</button>
                </div>
        </div>
        </form>
    </div>
</div>