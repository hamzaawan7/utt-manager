
//Common Function for add or Update Data
function addData() {

    var data = $("#general-form").serialize();
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
        success: function (response) {
            $('#general-form')[0].reset();
            $('#category').modal('hide');
            console.log(response)
            Swal.fire(
                response,
                '',
                'success'
            )
        }
    });

}
//Edit Property Category
function editPropertyCategory(id) {
    var url = '/category/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $('#name').val(response.name);
            $('#standard_guests').val(response.standard_guests);
            $('#minimum_guest').val(response.minimum_guest);
            $('#room_layouts').val(response.room_layouts);
            $('#childs').val(response.childs);
            $('#infants').val(response.infants);
            $('#pets').val(response.pets);
            $('#cat_id').val(response.id);
            $('#category').modal('show');
        }
    });

}

//Edit Features
function editPropertyCategory(id) {
    var url = '/property/feature/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $('#feature_name').val(response.feature_name);
            $('#minimum_nights').val(response.minimum_nights);
            $('#check_in_time').val(response.check_in_time);
            $('#check_out_time').val(response.check_out_time);
            $('#feature_id').val(response.id);
            $('#category').modal('show');
        }
    });

}

//User Edit

function editUserRole(id) {
    $('#password').hide();
    $('#confirm_password').hide();
    var url = '/user/role/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            console.log(response)
            $('#name').val(response.name);
            $('#last_name').val(response.last_name);
            $('#email').val(response.email);
            $('#city').val(response.city);
            $('#country').val(response.country);
            $('#user_id').val(response.id);
            $('#category').modal('show');
        }
    });
}


//Delete User

function deleteUser(id) {
    var url = '/user/role/delete/' + id + '';
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

//Edit Price Category
function editPriceCategory(id) {
    alert(id)
    var url = '/price/category/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $('#price_category').val(response.category);
            $('#cat_id').val(response.id);
            $('#category').modal('show');
        }
    });

}


//Edit Price Season
function editPriceSeason(id) {
    var url = '/price/season/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $('#name').val(response.name);
            $('#type').val(response.type);
            $('#from_date').val(response.from_date);
            $('#to_date').val(response.to_date);
            $('#season_id').val(response.id);
            $('#category').modal('show');
        }
    });

}


//Delete Common Function

$('.btn-delete').on('click',function(e){
    e.preventDefault();
    const url = $(this).attr('href')
    alert(url)
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
                    Swal.fire({
                        type: 'success',
                        title: 'success',
                        icon: 'success',
                        text: response
                    })
                }
            });
        }

    })
})


/*$( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});*/
