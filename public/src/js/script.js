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

function editData(id) {
    var url = '/category/edit/' + id + '';
    $.ajax({
        url: url,
        method: 'get',
        success: function (response) {
            $('#category_name').val(response.category_name);
            $('#cat_id').val(response.id);
            $('#category').modal('show');
        }
    });

}

function deleteData(id) {
    var url = '/category/delete/' + id + '';
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