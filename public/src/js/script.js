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

//Add Property
function addProperty() {

    var data =   new FormData($('#general-form')[0]); //$("#general-form").serialize();
    var url = $("#general-form").attr('action');
    var type = $("#general-form").attr('method');
    console.log(data)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: type,
        data: data,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response)
            if (response.status == '200'){
                $('#property-modal').modal('hide');
                getProperty();
                toastr.success(''+response.message+'', 'Success');
            }
        }, error :function (reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val){
                $("#" +key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Property Function
function editProperty(url) {
    $('#myLargeModalLabel').html('Update Property');
    var url = url;
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            $('.multi_images_main').html('');
            var cat = [];
            $('#category_names').select2('val',response.id);
            $.each(response.categories, function( index, value ) {
                console.log(value)
                cat.push(value.id)
            });
            console.log(cat)
            // $("#category_names").select2('data', cat);
            $('#category_names').val(cat).trigger('change');
            $('#feature_name').val(response.feature_name).trigger('change');
            $('#nearby_property').val(response.nearby_property_id).trigger('change');
            $.each(response, function( index, value ) {

                if(index != 'main_image' &&  index != 'images' )
                {
                    $('#'+index).val(value);
                    $('#general_id').val(response.id);
                }

            });
            var html='';
            var mainImage='';
            var bas_url=$('#general-form').attr('base_path');
            console.log(bas_url)
            $.each(response.images, function( index, value ) {

                html+=' <div class="image_div col-lg-2" id="'+value.id+'">\n' +
                    '     <img src="'+bas_url+'/images/multiple/'+value.images+'" width="150px">\n' +
                    '     <span class="close_icon delete-images"><i class="icon-copy fa fa-trash fa-2x" aria-hidden="true"></i></span>\n' +
                    '   </div>';
            });
             mainImage+=' <div class="image_div col-lg-4" id="\'+value.id+\'">\n' +
                ' <img src="'+bas_url+'/images/main/'+response.main_image+'" width="200px">\n' +
                ' </div>';

            $('.multi_images_main').html(html);
            $('.main-images').html(mainImage);
            console.log(html)
            $('#property-modal').modal('show');
        }
    });
}


//Delete Property propertyDelete
function propertyDelete(url) {
    var url = url;
    Swal.fire({
        title: 'Are you sure?',
        text:'Record will be deleted.?',
        type:'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) =>{
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    console.log(response)
                    getProperty();
                    toastr.success(''+response+'', 'Success');
                }
            });
        }
    })
}

//Get Property Data In DataTable
getProperty();
function getProperty()
{
    $(".get_property").DataTable().clear().destroy();
    var table = $('.get_property').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/property/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'short_code', name: 'short_code'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'post_code', name: 'post_code'},
            {data: 'special_category', name: 'special_category'},
            {data: 'utt_star_rating', name: 'utt_star_rating'},
            {data: 'is_visible', name: 'is_visible'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}
//Empty Property Forms
$('.reset_form').click( function (){
    $("#general-form")[0].reset();
    $('.multi_images_main').html('');
    $('.main-images').html('');
    $('#category_names').val(null).trigger('change');
    $('#nearby_property').val(null).trigger('change');
    $('#feature_name').val(null).trigger('change');
});

//Empty Customer Forms
$('.reset-customer-form').click( function (){
    $("#customer-form")[0].reset();
});

//Empty Owner Forms
$('.reset_owner').click( function (){
    $("#owner-form")[0].reset();
});
//Empty Property Category Form
$('.reset_category').click( function (){
    $("#property_category")[0].reset();
});
//Empty Feature Form
$('.reset_feature').click( function (){
    $("#property_feature")[0].reset();
});
//Empty User Form
$('.reset_user').click( function (){
    $("#user_form")[0].reset();
});

$('#proprty-button').click( function (){
    $('#myLargeModalLabel').html('Add Property');
});


//Multi Select Restrict

$(document).ready(function() {

    $("#nearby_property").select2({
        maximumSelectionLength: 3
    });
});

//delete Images
$(document).on("click", ".delete-images" , function() {
   var id  =  $(this).parent().attr('id');
   var url = '/property/image/delete/' + id + '';
    var parentDiv =  $(this).parent();
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            if(response.status == 200)
            {
                parentDiv.remove();
                toastr.success(''+response.message+'', 'Success');
            }
            console.log(response)

        }
    });
});

//End

//Add Or Update Property Category

function addCategory() {

    var data =  $("#property_category").serialize();
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
            if (response.status == 200){
                $('#property_category')[0].reset();
                $('#category').modal('hide');
                getCategory();
                toastr.success(''+response.message+'', 'Success');
            }
        }, error :function (reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val){
                $("#" +key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Property Category
function editPropertyCategory(url) {
    var url = url;
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            $.each(response, function( index, value ) {
                $('#'+index).val(value);
                $('#general_id').val(response.id);
            });
            $('#category').modal('show');
        }
    });
}

//Delete Property Category
function deletePropertyCategory(url) {
    var url = url;
    Swal.fire({
        title: 'Are you sure?',
        text:'Record will be deleted.?',
        type:'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) =>{
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200){
                        getCategory();
                        toastr.success(''+response.message+'', 'Success');
                    }
                }
            });
        }
    })
}

//Get Category
getCategory();
function getCategory()
{
    $(".get_category").DataTable().clear().destroy();
    var table = $('.get_category').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/category/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
            {data: 'standard_guests', name: 'standard_guests'},
            {data: 'minimum_guest', name: 'minimum_guest'},
            {data: 'room_layouts', name: 'room_layouts'},
            {data: 'childs', name: 'childs'},
            {data: 'infants', name: 'infants'},
            {data: 'pets', name: 'pets'},
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

    var data =  $("#property_feature").serialize();
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
            if (response.status == 200){
                $('#property_feature')[0].reset();
                $('#feature-modal').modal('hide');
                getFeature();
                toastr.success(''+response.message+'', 'Success');
            }
        }, error :function (reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val){
                $("#" +key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Property Feature
function editPropertyFeature(url) {
    var url = url;
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            $.each(response, function( index, value ) {
                $('#'+index).val(value);
                $('#feature_id').val(response.id);
            });
            $('#feature-modal').modal('show');
        }
    });

}

//Delete Property Feature

function deletePropertyFeature(url) {
    var url = url;
    Swal.fire({
        title: 'Are you sure?',
        text:'Record will be deleted.?',
        type:'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) =>{
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    console.log(response)
                    getFeature();
                    toastr.success(''+response+'', 'Success');
                }
            });
        }
    })
}

//Get Feature Data In DataTable
getFeature();
function getFeature()
{
    $(".get_feature").DataTable().clear().destroy();
    var table = $('.get_feature').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/property/feature/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'feature_name', name: 'feature_name'},
            {data: 'check_in_time', name: 'check_in_time'},
            {data: 'check_out_time', name: 'check_out_time'},
            {data: 'minimum_nights', name: 'minimum_nights'},
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

    var data =  $("#review_feature").serialize();
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
            console.log(response)
            $('#review_feature')[0].reset();
            $('#review-modal').modal('hide');
            getReview();
            toastr.success(''+response+'', 'Success');
        }
    });
}

//Edit Review
function editReview(url) {
    var url = url;
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            if (response.is_accept == '1'){
                $( "#is_accept" ).prop( "checked", true );
            }
            if (response.is_show == '1'){
                $( "#is_show" ).prop( "checked", true );
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
        var url = url;
        Swal.fire({
            title: 'Are you sure?',
            text:'Record will be deleted.?',
            type:'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) =>{
            if (result.value) {
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (response) {
                        console.log(response)
                        getFeature();
                        toastr.success(''+response+'', 'Success');
                    }
                });
            }
        })
    }

    //Get Review
    getReview();
    function getReview()
    {
        $(".get_review").DataTable().clear().destroy();
        var table = $('.get_review').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/review/get",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'comment', name: 'comment'},
                {data: 'star_rating', name: 'star_rating'},
                {data: 'is_accept', name: 'is_accept'},
                {data: 'is_show', name: 'is_show'},
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

    var data =  $("#customer-form").serialize();
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
            if (response.status == 200){
                $('#customer-form')[0].reset();
                $('#customer-modal').modal('hide');
                toastr.success(''+response.message+'', 'Success');
                getCustomer();
            }
        }, error :function (reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val){
                $("#" +key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Customer
function editCustomer(url) {
    var url = url;
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            $.each(response, function (index, value) {
                $('#' + index).val(value);

                $('#customer_id').val(response.user_id);
            });
            $.each(response.user, function (index, value) {
                $('#' + index).val(value);
            })
            $('#customer-modal').modal('show');
        }
    });
}

//Get Customer
getCustomer();
function getCustomer()
{
    $(".get_customer").DataTable().clear().destroy();
    var table = $('.get_customer').DataTable({
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

//Delete Customer
function deleteCustomer(url) {
    var url = url;
    Swal.fire({
        title: 'Are you sure?',
        text:'Record will be deleted.?',
        type:'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) =>{
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.status == 200){
                        getCustomer();
                        toastr.success(''+response+'', 'Success');
                    }

                }
            });
        }
    })
}

//Add Or Update Owner Data
function addOwner() {
    var data =  $("#owner-form").serialize();
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
            if (response.status == 200){
                $('#owner-form')[0].reset();
                $('#owner-modal').modal('hide');
                toastr.success(''+response.message+'', 'Success');
                getOwner();
            }
        }, error :function (reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val){
                $("#" +key + "_error").text(val[0]);
            });
        }
    });
}

//Edit Owner
function editOwner(url) {
    /*$('#main-password-div').();*/
    var url = url;
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            $.each(response, function (index, value) {
                $('#' + index).val(value);

                $('#owner_id').val(response.user_id);
            });
            $.each(response.user, function (index, value) {
                $('#' + index).val(value);
            })
            $('#owner-modal').modal('show');
        }
    });
}

//Delete Owner
function deleteCustomer(url) {
    var url = url;
    Swal.fire({
        title: 'Are you sure?',
        text:'Record will be deleted.?',
        type:'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) =>{
        if (result.value) {
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    console.log(response)
                    getOwner();
                    toastr.success(''+response+'', 'Success');
                }
            });
        }
    })
}

//Get Owners
getOwner();
function getOwner()
{
    $(".get_owner").DataTable().clear().destroy();
    var table = $('.get_owner').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/owner/get",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'address', name: 'address'},
            {data: 'main_contact_name', name: 'main_contact_name'},
            {data: 'main_contact_number', name: 'main_contact_number'},
            {data: 'secondary_contact_name', name: 'secondary_contact_name'},
            {data: 'secondary_contact_number', name: 'secondary_contact_number'},
            {data: 'emergency_contact_name', name: 'emergency_contact_name'},
            {data: 'emergency_contact_number', name: 'emergency_contact_number'},
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
    var data =  $("#user_form").serialize();
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
            console.log(response)
            $('#user_form')[0].reset();
            $('#user-modal').modal('hide');
            console.log(response)
            toastr.success(''+response+'', 'Success');
        }
    });
}

//User Edit
function editUser(id) {
    var url = '/user/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $.each(response, function (index, value) {
                $('#' + index).val(value);
                $('#user_id').val(response.id);
            });
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
            console.log(response)
            Swal.fire(
                response,
                '',
                'success'
            )
        }
    });
}

