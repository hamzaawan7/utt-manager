toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};


//Property Form Submit
$("a[href='#finish']").click(function () {
    $('#property_form').submit();
});

//Empty Customer Forms
$('.reset-customer-form').click(function () {
    $("#passwords").removeAttr('readonly');
    $("#customer-form")[0].reset();
    $("#customer_id").val("");
    $(".clear-error").html('');
});

//Empty Owner Forms
$('.reset_owner').click(function () {
    $("#passwords").removeAttr('readonly');
    $("#password_confirmation").removeAttr('readonly');
    $("#owner-form")[0].reset();
    $("#owner_id").val('');
    $(".clear-error").html('');
});

//Empty Property Category Form
$('.reset_category').click(function () {
    $("#property_category")[0].reset();
    $("#category_id").val("");
    $(".clear-error").html('');
});

//Empty Feature Form
$('.reset_feature').click(function () {
    $("#property_feature")[0].reset();
    $("#feature_id").val('');
    $(".clear-error").html('');
});

//Empty User Form
$('.reset_user').click(function () {
    $("#passwords").removeAttr("readonly");
    $("#confirm_password").removeAttr("readonly");
    $("#user_form")[0].reset();
    $(".clear-error").html('');
});

//Empty Season Form
$('.reset_season').click(function () {
    $("#price_season")[0].reset();
    $("#season_id").val('');
    $('#type').val(null).trigger('change');
    $(".clear-error").html('');
});

$('#proprty-button').click(function () {
    $('#myLargeModalLabel').html('Add Property');
});

//delete Images
$(document).on("click", ".delete-images", function () {
    var id = $(this).parent().attr('id');
    var url = '/property/image/delete/' + id + '';
    var parentDiv = $(this).parent();
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            if (response.status === 200) {
                parentDiv.remove();
                toastr.success('' + response.message + '', 'Success');
            }
        }
    });
});

//Add Or Update Property Category
function addCategory() {
    var data = $("#property_category").serialize();
    var url = $("#property_category").attr('action');
    var type = $("#property_category").attr('method');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#property_category')[0].reset();
                $('#category').modal('hide');
                toastr.success('' + response.message + '', 'Success');
                getCategory();
            } else {
                toastr.warning('' + response.message + '', 'warning');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Property Category
function findPropertyCategory(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $("#include_in_search_filter").prop("checked", false);
            $("#include_in_header").prop("checked", false);
            if (response.include_in_search_filter === 1) {
                $("#include_in_search_filter").prop("checked", true);
            }
            if (response.include_in_header === 1) {
                $("#include_in_header").prop("checked", true);
            }
            $.each(response, function (index, value) {
                $('#' + index).val(value);
                $('#category_id').val(response.id);
            });
            $('#category').modal('show');
        }
    });
}

//Delete Property Category
function deletePropertyCategory(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status === 200) {
                        getCategory();
                        toastr.success('' + response.message + '', 'Success');
                    }
                    if (response.status === 422) {
                        toastr.warning('' + response.message + '', 'warning');
                    }
                }
            });
        }
    });
}

//Get Category
function getCategory() {
    $(".get_category").DataTable().clear().destroy();
    return $('.get_category').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/category/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
            {data: 'include_in_search_filter', name: 'include_in_search_filter'},
            {data: 'include_in_header', name: 'include_in_header'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Add Or Update Property Features
function addFeature() {
    var data = $("#property_feature").serialize();
    var url = $("#property_feature").attr('action');
    var type = $("#property_feature").attr('method');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#property_feature')[0].reset();
                $('#feature-modal').modal('hide');
                getFeature();
                toastr.success('' + response.message + '', 'Success');
            }  else {
                toastr.warning('' + response.message + '', 'warning');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Find Property Feature
function findPropertyFeature(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $.each(response, function (index, value) {
                $('#' + index).val(value);
                $('#feature_id').val(response.id);
            });
            $('#feature-modal').modal('show');
        }
    });
}

//Delete Property Feature
function deletePropertyFeature(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    getFeature();
                    toastr.success('' + response + '', 'Success');
                }
            });
        }
    });
}

//Get Feature Data In DataTable
function getFeature() {
    $(".get_feature").DataTable().clear().destroy();
    return $('.get_feature').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/property/feature/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'feature_name', name: 'feature_name'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Update Review
function addReview() {
    var data = $("#review_feature").serialize();
    var url = $("#review_feature").attr('action');
    var type = $("#review_feature").attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            $('#review_feature')[0].reset();
            $('#review-modal').modal('hide');
            getReview();
            toastr.success('' + response + '', 'Success');
        }
    });
}

//Edit Review
function findReview(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $("#is_accept").prop("checked", false);
            if (response.approve === '1') {
                $("#is_accept").prop("checked", true);
            }
            $.each(response, function (index, value) {
                $('#' + index).val(value);

                $('#review_id').val(response.id);
            });
            $('#review-modal').modal('show');
        }
    });
}

//Delete Review
function deleteReview(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    getFeature();
                    toastr.success('' + response + '', 'Success');
                }
            });
        }
    });
}

//Get Review
function getReview() {
    $(".get_review").DataTable().clear().destroy();
    return $('.get_review').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/review/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'comment', name: 'comment'},
            {data: 'approve', name: 'approve'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Add Or Update Customer Data
function addCustomer() {
    var data = $("#customer-form").serialize();
    var url = $("#customer-form").attr('action');
    var type = $("#customer-form").attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#customer-form')[0].reset();
                $('#customer-modal').modal('hide');
                toastr.success('' + response.message + '', 'Success');
                getCustomer();
            }else {
                toastr.warning('' + response.message + '', 'warning');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Customer
function findCustomer(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            if (response[0].user_id) {
                $("#passwords").prop("readonly", true);
                $('#passwords').val('');
            }
            $.each(response[0], function (index, value) {

                $('#' + index).val(value);

                $('#customer_id').val(response[0].user_id);
            });
            $.each(response[0].user, function (index, value) {
                $('#' + index).val(value);
            })
            $('#customer-modal').modal('show');
        }
    });
}

//Delete Customer
function deleteCustomer(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('' + response.message + '', 'Success');
                        getCustomer();
                    }

                }
            });
        }
    });
}

//Get Customer
function getCustomer() {
    $(".get_customer").DataTable().clear().destroy();
    return $('.get_customer').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/customer/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'post_code', name: 'post_code'},
            {data: 'city', name: 'city'},
            {data: 'country', name: 'country'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Add Or Update Owner Data
function addOwner() {
    var data = $("#owner-form").serialize();
    var url = $("#owner-form").attr('action');
    var type = $("#owner-form").attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                toastr.success('' + response.message + '', 'Success');
                $('#owner-form')[0].reset();
                $('#owner-modal').modal('hide');
                getOwner();
            } else {
                toastr.warning('' + response.message + '', 'warning');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Owner
function findOwner(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            if (response[0].id) {
                $("#passwords").prop("readonly", true);
                $('#passwords').val('');
                $("#password_confirmation").prop("readonly", true);
            }
            $.each(response[0], function (index, value) {
                $('#' + index).val(value);

                $('#owner_id').val(response[0].user_id);
            });
            $.each(response[0].user, function (index, value) {
                $('#' + index).val(value);
            });
            $('#owner-modal').modal('show');
        }
    });
}

//Delete Owner
function deleteOwner(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('' + response.message + '', 'Success');
                        getOwner();
                    }
                }
            });
        }
    });
}

//Get Owners
function getOwner() {
    $(".get_owner").DataTable().clear().destroy();
    return $('.get_owner').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/owner/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'owner_name', name: 'owner_name'},
            {data: 'address', name: 'address'},
            {data: 'phone', name: 'phone'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Add Or Update Users Data
function addUser() {
    var data = $("#user_form").serialize();
    var url = $("#user_form").attr('action');
    var type = $("#user_form").attr('method');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            $('#user_form')[0].reset();
            $('#user-modal').modal('hide');
            toastr.success('' + response + '', 'Success');
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//User Edit
function findUser(id) {
    var url = '/user/find/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            if (response.id) {
                $("#passwords").prop("readonly", true);
                $('#passwords').val('');
                $("#confirm_password").prop("readonly", true);
            }
            $.each(response, function (index, value) {
                $('#' + index).val(value);
                $('#user_id').val(response.id);
            });
            $('#role').val(response.roles[0].id);
            $('#user-modal').modal('show');
        }
    });
}

//Delete User
function deleteUser(id) {
    var url = '/user/delete/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            Swal.fire(
                response,
                '',
                'success'
            )
        }
    });
}

//Add Or Update Price Season
function addSeason() {
    var data = $("#price_season").serialize();
    var url = $("#price_season").attr('action');
    var type = $("#price_season").attr('method');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#price_season')[0].reset();
                $('#season-modal').modal('hide');
                getSeason();
                toastr.success('' + response.message + '', 'Success');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Seasons
function findPriceSeason(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $.each(response[0], function (index, value) {
                $('#' + index).val(value);

                $('#season_id').val(response[0].id);
            });
            var types = [];
            $.each(response[0].types, function (index, value) {
                types.push(value.id)
            });
            $('#type').val(types).trigger('change');
            $('#season-modal').modal('show');
        }
    });
}

//Delete Price Seasons
function deletePriceSeason(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('' + response.message + '', 'Success');
                        getSeason();
                    }
                }
            });
        }
    });
}

//Get Season Data In DataTable
function getSeason() {
    $(".get_season").DataTable().clear().destroy();
    return $('.get_season').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/price/season/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'season_name', name: 'season_name'},
            {data: 'from_date', name: 'from_date'},
            {data: 'to_date', name: 'to_date'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Update Price Category
function AddPriceCategory() {
    var data = $("#price_category").serialize();
    var url = $("#price_category").attr('action');
    var type = $("#price_category").attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#price_category')[0].reset();
                $('#price-category').modal('hide');
                getPriceCategory();
                toastr.success('' + response.message + '', 'Success');
            }
        }
    });
}

//Find Price Category
function findPriceCategory(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            var data = response[0].category_name;
            var category = data[0].toString().toLowerCase();
            html = '';
            $('.standard-main').html(' ');
            $('.flexible-main').html(' ');
            if (category === 's') {
                $.each(response, function (index, value) {
                    html += '<div class="row">\n' +
                        '<input type="hidden" name="price_category_id[]" value="'+value.id+'">\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Type</label>\n' +
                        '                                    <input type="text" name="type" id="type1"\n' +
                        '                                           value='+value.type+' class="form-control" readonly>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Year</label>\n' +
                        '                                    <input type="text" name="years_'+index+'"\n' +
                        '                                           id="year" class="form-control year" value='+value.year+' readonly>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Price Seven Nights</label>\n' +
                        '                                    <input type="number" name="priceSevenNights_'+index+'"\n' +
                        '                                           id="utt_star_rating" value='+value.price_seven_night+' class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Price Monday To Friday</label>\n' +
                        '                                    <input type="number" name="mondayToFriday_'+index+'"\n' +
                        '                                           id="utt_star_rating" value='+value.price_monday_to_friday+' class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Price Friday To Monday</label>\n' +
                        '                                    <input type="number" name="fridayToMonday_'+index+'"\n' +
                        '                                           id="utt_star_rating" value='+value.price_friday_to_monday+' class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Category</label>\n' +
                        '                                    <input type="text" name="category"\n' +
                        '                                            value='+value.category_name+' class="form-control" readonly>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>';
                });

                $('.standard-main').html(html);
            } else {
                $.each(response, function(index, value) {
                    html += '<div class="row">\n' +
                        '<input type="hidden" name="price_category_id[]" value="'+value.id+'">\n' +
                        '                            <div class="col-md-1">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Type</label>\n' +
                        '                                    <input type="text" name="type" id="type"\n' +
                        '                                           value='+value.type+' class="form-control" readonly>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-1">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Year</label>\n' +
                        '                                    <input type="text" name="yearf_'+index+'"\n' +
                        '                                           id="year" value='+value.year+' class="form-control year">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Standing Charge</label>\n' +
                        '                                    <input type="number" name="standingCharge_'+index+'"\n' +
                        '                                          value='+value.price_standing_charge+' id="utt_star_rating" class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Sunday-to-Thursday</label>\n' +
                        '                                    <input type="number" name="sundayToThursday_'+index+'"\n' +
                        '                                         value='+value.price_sunday_to_thursday+'  id="utt_star_rating" class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Friday-to-Saturday</label>\n' +
                        '                                    <input type="number" name="fridayToSaturday_'+index+'"\n' +
                        '                                         value='+value.price_friday_to_saturday+'  id="utt_star_rating" class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-2">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Price-Seven-Nights</label>\n' +
                        '                                    <input type="number" name="sevenNightsPrice_'+index+'"\n' +
                        '                                          value='+value.price_seven_night+' id="utt_star_rating" class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-1">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Weekend</label>\n' +
                        '                                    <input type="number" name="weekendPrice_'+index+'"\n' +
                        '                                          value='+value.weekend_friday_to_monday+' id="utt_star_rating" class="form-control">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-1">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Category</label>\n' +
                        '                                    <input type="text" name="category"\n' +
                        '                                          value='+value.category_name+' id="category" class="form-control" readonly>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>';
                });

                $('.flexible-main').html(html);
            }

            $('#price_category_id').val(response[0].price_category_id);
            //$('#category_price_id').val(response[0].price_category_id);
            $('#category_price_id').val(response[0].price_category_id+'_'+response[0].category_name).trigger('change');
            $('#price-category').modal('show');
        }
    });
}

//Get Price Category Data In DataTable
function getPriceCategory() {
    $(".get_price_category").DataTable().clear().destroy();
    return $('.get_price_category').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/price/category/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Delete Price Category
function deletePriceCategory(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('' + response.message + '', 'Success');
                        getPriceCategory();
                    }
                }
            });
        }
    });
}

//Get Price Data In DataTable
function getPrice() {
    $(".get_price").DataTable().clear().destroy();
    return $('.get_price').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/price/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'price_seven_night', name: 'price_seven_night'},
            {data: 'price_monday_to_friday', name: 'price_monday_to_friday'},
            {data: 'price_friday_to_monday', name: 'price_friday_to_monday'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Find Price
function findPrice(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $.each(response, function (index, value) {
                $('#' + index).val(value);

                $('#price_id').val(response.id);
            });

            $('#price-modal').modal('show');
        }
    });
}

//Add Or Update Price Type
function addPrice() {
    var data = $("#type_form").serialize();
    var url = $("#type_form").attr('action');
    var type = $("#type_form").attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#type_form')[0].reset();
                $('#type-modal').modal('hide');
                toastr.success('' + response.message + '', 'Success');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Find Type
function findType(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $.each(response, function (index, value) {
                $('#' + index).val(value);

                $('#price_id').val(response.id);
            });

            $('#type-modal').modal('show');
        }
    });
}

//Get Price Type Data In DataTable
function getPrice() {
    $(".get_price").DataTable().clear().destroy();
    return $('.get_price').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/price/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
            {data: 'type', name: 'type'},
            {data: 'price_seven_night', name: 'price_seven_night'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Delete Price Type
function deleteType(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Record will be deleted.?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success('' + response.message + '', 'Success');
                        getPriceCategory();
                    }
                }
            });
        }
    });
}

$(document).ready(function () {
    getOwner();
    /*getProperty();*/
    getCustomer();
    getReview();
    getCategory();
    getFeature();
    getSeason();
    getPriceCategory();
    getPrice();
    getDiscount();
    $("#nearby_property").select2({
        maximumSelectionLength: 3
    });

    $("#type").select2({
        maximumSelectionLength: 1
    });
});

//Select Price Category
$('#price_category_id').on('change', function () {
    var data = $("#price_category_id option:selected").text().split(' ');
    var $category = data[0].toString().toLowerCase();
    if ($category === 'standard') {
        $('.main-standard').removeClass('hide');
        $('.main-flexible').addClass('hide');
    } else {
        $('.main-flexible').removeClass('hide');
        $('.main-standard').addClass('hide');
    }
});

//Display Only Years
$(".year").datepicker({
    language: "en",
    minView: "years",
    view: "years",
    autoClose: !0,
    dateFormat: "yyyy"
});

//Add Or Update Discount
function addDiscount() {
    var data = $("#discount").serialize();
    var url = $("#discount").attr('action');
    var type = $("#discount").attr('method');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        success: function (response) {
            if (response.status === 200) {
                $('#discount')[0].reset();
                $('#discount-modal').modal('hide');
                getDiscount();
                toastr.success('' + response.message + '', 'Success');
            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
}

//Find Discount
function findDiscount(url) {
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response);
            $.each(response, function (index, value) {
                $('#' + index).val(value);

                $('#discount_id').val(response.id);
            });
            var property = [];
            $.each(response.properties[0], function (index, value) {
                property.push(value.property_id);
            });
            $('#property_id').val(property).trigger('change');
            $('#discount-modal').modal('show');
        }
    });
}

//Get Discount Data In DataTable
function getDiscount() {
    $(".get_discount").DataTable().clear().destroy();
    return $('.get_discount').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/discount/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'reference_code', name: 'reference_code'},
            {data: 'is_active', name: 'is_active'},
            {data: 'value', name: 'value'},
            {data: 'expiry_date', name: 'expiry_date'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

//Check Booking availability
$('#availability').on('change', function () {
    var category = $("#availability option:selected").text().toLowerCase();
    if (category === 'standard') {
        $('.standard-availability').removeClass('hide');
        $('.flexible-availability').addClass('hide');
        $('.seven-night').addClass('hide');
    } else {
        $('.flexible-availability').removeClass('hide');
        $('.standard-availability').addClass('hide');
        $('.seven-night').addClass('hide');
    }
});

//Check Booking availability
$('#standardselect').on('change', function () {
    var data = $("#standardselect option:selected").text().split(' ');
    var category = data[0].toString().toLowerCase();
    if (category === 'seven') {
        $('.seven-night').removeClass('hide');
    }
});

//DateTimePicker
$(".datesevennight").datepicker({
    timepicker:!0,
    language:"en",
    autoClose:!0,
    dateFormat:"dd MM yyyy",
    format: {
        toDisplay: function (date, format, language) {
            var d = new Date(date);
            d.setDate(d.getDate() - 7);
            return d.toISOString();
        },
        toValue: function (date, format, language) {
            var d = new Date(date);
            d.setDate(d.getDate() + 7);
            return new Date(d);
        }
    }

});
