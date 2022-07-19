<div class="modal fade bs-example-modal-lg" id="payment-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Update Booking Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="booking-payment-form" method="post" action="{{route('update-booking')}}">
                <input type="hidden" name="booking_payment_id" id="booking_payment_id">
                <input type="hidden" name="remaining_price_hidden" id="remaining_price_hidden">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control">
                                <div class="text-danger clear-error" id="first_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control">
                                <div class="text-danger clear-error" id="last_name_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Balance Paid</label>
                                <input type="number" name="total_price" id="total_price_pay" class="form-control">
                                <div class="text-danger clear-error" id="total_price_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Remaining Balance Paid</label>
                                <input type="number" name="remaining_price" id="remaining_price_pay"
                                       class="form-control" readonly>
                                <div class="text-danger clear-error" id="remaining_price_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateBookingPayment()">Update</button>
                </div>
        </div>
        </form>
    </div>
</div>