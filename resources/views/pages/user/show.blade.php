@extends('layouts.app')
@section('title', 'Detail Data User')
@section('data', 'menu-open')
@section('user', 'active')
@section('content')
<div class="content-wrapper" style="min-height: 1345.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Detail Data User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="title">Nama</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Masukan Judul Layanan" name="title" value="{{ $user->name }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="title">NIK</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Masukan Judul Layanan" name="title" value="{{ $user->nik }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="title">Email</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Masukan Judul Layanan" name="title" value="{{ $user->email }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="title">Phone</label>
                                    <p>
                                        <input type="text" class="form-control" id="title"
                                            placeholder="Masukan Judul Layanan" name="title" value="{{ $user->phone }}"
                                            readonly>
                                    </p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="title">Alamat</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        readonly>{{$user->address}}</textarea>
                                </div>
                            </div>
                            <a href="{{ url()->previous() }}" type="button" class="btn btn-primary">Kembali</a>
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