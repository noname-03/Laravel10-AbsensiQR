@extends('layouts.app')
@section('title', 'Data Jadwal')
@section('data.schedule', 'menu-open')
@section('schedule', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Jadwal</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="name">Nama</label>
                                    <div id="reader" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // $('#result').val('test');
            function onScanSuccess(decodedText, decodedResult) {
                // alert(decodedText);
                $('#result').val(decodedText);
                let id = decodedText;
                html5QrcodeScanner.clear().then(_ => {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('check.qr') }}",
                        type: 'POST',
                        data: {
                            _methode : "POST",
                            _token: CSRF_TOKEN,
                            code : id
                        },
                        success: function (response) {
                            console.log(response);
                            if(response.status == 200){
                                alert('Berhasil Melakukan Absensi');
                                location.replace('/home');
                                // var loc = window.location;
                                // window.location = loc.protocol+"//"+"127.0.0.1:8000/home";
                            }else{
                                alert('Gagal Silahkan Scan Ulang Atau Hubungi Admin');
                                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                            }

                        }
                    });
                }).catch(error => {
                    alert('something wrong');
                });

            }

            function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
                // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endpush