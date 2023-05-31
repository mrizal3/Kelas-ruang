@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Ganti Password</h3>
                <form id="ganti">
                    <div class="row mt-3">
                        <div class="col-md-4">

                            <div class="form-group" id="password_lama">
                                <label>Password Lama</label>
                                <input type="password" class="form-control validation" name="password_lama"
                                    autocomplete="off">
                            </div>

                            <div class="form-group" id="password_baru">
                                <label>Password Baru</label>
                                <input type="password" class="form-control validation" name="password_baru"
                                    autocomplete="off">
                            </div>

                            <div class="form-group" id="verifikasi_password_baru">
                                <label>Ulangi Password Baru</label>
                                <input type="password" class="form-control validation" name="verifikasi_password_baru"
                                    autocomplete="off">
                            </div>

                            <div class="form-group">
                                <button class="float-right btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@include('prodi.modal')
<script>
    $('#ganti').on('submit', function(e){
        e.preventDefault();
        removeAddValidation();
        let data = new FormData(this);
        let url = '{{ url('profile/ganti-password') }}';
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
                    errorMessage('Password Lama Salah');
                }
                $('#modal-store').modal('hide');
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
    });

</script>
@endpush