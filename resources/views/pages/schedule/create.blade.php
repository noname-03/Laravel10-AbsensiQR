@extends('layouts.app')
@section('title', 'Tambah Data Jadwal')
@section('data.schedule', 'menu-open')
@section('schedule', 'active')
@section('content')
<div class="content-wrapper" style="min-height: 1345.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formulir Jadwal</h1>
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
                    <h3 class="card-title">Tambah Data Jadwal</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('schedule.store')}}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="day">Hari</label>
                                        <select class="form-control selectpicker" name="day" data-live-search="true"
                                            @error('day') is-invalid @enderror>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jum'at</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                        @error('day')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="class_education">Kelas</label>
                                        <select class="form-control selectpicker" name="class_education_id"
                                            data-live-search="true" @error('class_education_id') is-invalid @enderror>
                                            @foreach ($classEducations as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach>
                                        </select>
                                        @error('class_education_id')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user">User</label>
                                        <select class="form-control selectpicker" name="user_id" data-live-search="true"
                                            @error('user_id') is-invalid @enderror>
                                            @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach>
                                        </select>
                                        @error('user_id')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                            </form>
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
<script src="{{asset('admin/bs/dist/js/bootstrap-select.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/bs/dist/css/bootstrap-select.css')}}">
@endpush