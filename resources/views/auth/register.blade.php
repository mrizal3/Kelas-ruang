<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pendaftaran User &mdash; Peminjaman Ruang</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/components.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/izitoast/css/iziToast.min.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="{{ asset('') }}assets/logo.png" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Pendaftaran User</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" id="form-register">
                                    <div class="row">
                                        <div class="form-group col-6" id="nama">
                                            <label>Nama</label>
                                            <input type="text" class="form-control validation" name="nama" autocomplete="off">
                                        </div>
                                        <div class="form-group col-6" id="prodi">
                                            <label>Prodi</label>
                                            <select name="prodi" class="form-control validation">
                                                <option value="">--- Prodi ---</option>
                                                @foreach ($prodi as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-6" id="tipe_identitas">
                                            <label>Tipe Identitas</label>
                                            <select name="tipe_identitas" class="form-control validation">
                                                <option value="">--- Tipe Identitas ---</option>
                                                <option value="NIM">NIM</option>
                                                <option value="NIDN">NIDN</option>
                                                <option value="NIDK">NIDK</option>
                                                <option value="NIP">NIP</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6" id="no_identitas">
                                            <label>No Identitas</label>
                                            <input type="text" class="form-control validation" name="no_identitas"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6" id="no_hp">
                                            <label>No Hp</label>
                                            <input type="text" class="form-control validation" name="no_hp" autocomplete="off">
                                        </div>
                                        <div class="form-group col-6" id="jabatan">
                                            <label>Jabatan</label>
                                            <select name="jabatan" class="form-control validation">
                                                <option value="">--- Jabatan ---</option>
                                                @foreach ($jabatan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6" id="password">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control validation"
                                                data-indicator="pwindicator" name="password">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6" id="password2">
                                            <label for="password2" class="d-block">Ulangi Password</label>
                                            <input id="password2" type="password" class="form-control validation"
                                                name="password2">
                                        </div>
                                    </div>

                                    <div class="form-group" id="alamat">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control validation"
                                            style="height: 130px !important"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            &copy; 2020/2021 <div class="bullet text-"><i>Universitas Perjuangan</i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('') }}assets/backend/modules/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/popper.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/tooltip.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/moment.min.js"></script>
    <script src="{{ asset('') }}assets/backend/js/stisla.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/izitoast/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

    <script>
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
        $('#form-register').on('submit', function(e) {
            e.preventDefault();
            removeAddValidation();
            let url = '{{ url('register') }}';
            let data = new FormData(this);
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
                        successMessage('Berhasil Daftar')
                        window.location.replace("{{ url('login') }}");
                    }
                    else {
                        errorMessage('Server Error');
                    }
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
        })
    </script>
</body>

</html>