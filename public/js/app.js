// Ajax Setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    beforeSend: function() {
        // loading()
    },
    complete: function(xhr, stat) {
        // closeLoading()
    },
    success: function(result,status,xhr) {
        // closeLoading()
    }
});

// Show Loading Screen
const loading = () => {
    $.blockUI({
        baseZ: 2000,
        message: `<div class="spinner-border spinner-border-sm" role="status">
        <span class="sr-only">Loading...</span>
      </div> Loading...`,
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: '10px 15px',
            color: '#fff',
            backgroundColor: '#333',
        }
    }); 
}

// Close Loading Screen
const closeLoading = () => {
    $.unblockUI();
}

// Generate Data Table 
const generateTable = (table,url,column, pageLength  = 10,lengthChange = true) => {
    $('#'+table).DataTable({
        responsive: true,
        processing : true,
        serverSide : true,
        ajax : url,
        lengthChange : lengthChange,
        pageLength : pageLength,
        columns :column
    });
}

// Remove Validation
const removeValidation = () => {
    $('.invalid-feedback').remove();
    $('.validation').removeClass('is-valid').removeClass('is-invalid');
    $('#form-store').trigger('reset');
}

// Remove and Add Validation
const removeAddValidation = () => {
    $('.invalid-feedback').remove();
    $('.validation').addClass('is-valid').removeClass('is-invalid');
}

const successMessage = (message) => {
    iziToast.success({
        title: 'Success!',
        message: message,
        position: 'topRight'
      });
}

const errorMessage = (message) => {
    iziToast.error({
        title: 'Error!',
        message: message,
        position: 'topRight'
      });
}

// Store Data with Ajax (Form Master Data)
const storeData = (data,url) => {
    $.ajax({
        async:true,
        type:'POST',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        url: url,
        data : data,
        beforeSend:function(request) {
            loading();
        },
        success: function(data){
            closeLoading();
            if (data.status == true) {
                successMessage('Data berhasil disimpan')
            }
            else {
                errorMessage('Server Error');
            }
            $('#modal-store').modal('hide');
            $('#table').DataTable().ajax.reload();
        },
        error: function (error) {
        closeLoading();
            var res = error.responseJSON;
            if (error.status == 422) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .find('input')
                        .addClass('is-invalid').removeClass('is-valid');
                    $('#' + key)
                        .find('select')
                        .addClass('is-invalid').removeClass('is-valid');
                    $('#'+key).append(`<div class="invalid-feedback">${value}</div>`);
                });
            }
            else {
                errorMessage('Server Error');
                $('#modal-store').modal('hide');
            }
        },
    })
}

// Edit Data with Ajax(Master Data)

const editData = (url, optional = false, pathImage = null) => {
    $.get(url, function(result) {
        $('#id').val(result.id);
        $.each(result,function(key,value) {
            if (key != 'password') {
                $(`#${key} input[type="text"]`).val(value);
                $(`#${key} input[type="number"]`).val(value);
                $(`#${key} select`).val(value);
                let key_split = key.split('_');
                $(`#${key_split[0]} select`).val(value);
                $(`#${key} textarea`).val(value);
            }
            if(optional == true && key == 'gambar') {
                $('#gambar').html(`<label>Gambar</label><input type="file" name="gambar" class="border" data-default-file="${pathImage+value}" />`);
                $('#gambar_lama').val(value);
                $('#gambar input').dropify();
            }
        })
    })
    $('#modal-store').modal('show');
}

// Delete Data with Ajax(Master Data)
const deleteData = (url, id = null) => {
    $.ajax({
        type: "DELETE",
        url: url,
        success: function (data) {
            successMessage('Berhasil Hapus Data')
            $('#table').DataTable().ajax.reload();
        },
        error: function (data) {
           errorMessage('Gagal Hapus Data');
        }
    });
}

