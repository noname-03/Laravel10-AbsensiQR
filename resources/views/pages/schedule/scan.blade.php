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
                <form method="POST" action="{{ route('check.qr') }}" enctype="multipart/form-data">
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="day">Status</label>
                                        <select class="form-control selectpicker" name="day" data-live-search="true"
                                            @error('day') is-invalid @enderror onchange="showFields(this.value)">
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12" id="fileField" style="display: none;">
                                        <label for="day">File</label><br>
                                        <input type="file" name="file" id="fileInput" accept="application/pdf">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="day">Keterangan</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            name="note"></textarea>

                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="name">Scan</label>
                                        <div id="reader"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')

<script src="{{asset('admin/bs/dist/js/bootstrap-select.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/bs/dist/css/bootstrap-select.css')}}">
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // $('#result').val('test');
    function onScanSuccess(decodedText, decodedResult) {
    $('#result').val(decodedText);
    let id = decodedText;
    html5QrcodeScanner.clear().then(_ => {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData();
        formData.append('_methode', 'POST');
        formData.append('_token', CSRF_TOKEN);
        formData.append('code', id);
        formData.append('status', $('select[name="day"]').val());
        formData.append('note', $('#exampleFormControlTextarea1').val());
        formData.append('file', $('#fileInput')[0].files[0]);

        $.ajax({
            url: "{{ route('check.qr') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if(response.status == 200){
                    alert('Berhasil Melakukan Absensi');
                    location.replace('/home');
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
<script>
    function showFields(value) {
        var fileField = document.getElementById("fileField");
        var keteranganField = document.getElementById("exampleFormControlTextarea1");

        if (value === "izin" || value === "sakit") {
            fileField.style.display = "block";
            keteranganField.value = "";
        } else {
            fileField.style.display = "none";
            keteranganField.value = "";
        }
    }
</script>
@endpush