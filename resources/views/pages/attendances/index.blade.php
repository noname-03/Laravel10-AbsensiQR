@extends('layouts.app')
@section('title', 'Data Absensi')
@section('data.schedule', 'menu-open')
@section('schedule', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Absensi {{$schedule->user->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('schedule.index')}}">Jadwal</a></li>
                        <li class="breadcrumb-item active">Absensi</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 7%">No</th>
                                        <th style="width: 25%">Nama Guru</th>
                                        <th style="width: 10%">Nama Kelas</th>
                                        <th style="width: 3%">Status</th>
                                        <th style="width: 25%">Keterangan</th>
                                        <th style="width: 10%">Tanggal</th>
                                        <th style="width: 10%">Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule->attendances as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->user->name }}</td>
                                        <td>{{ $schedule->classEducation->title }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td style="text-align: center;">
                                            {{$item->created_at->format('d-m-Y H:i:s')}}
                                        </td>
                                        @if ($item->file)
                                        <td style="text-align: center;">
                                            <a class="btn btn-sm btn-primary" href="{{asset('file/' . $item->file)}}"
                                                target="_blank" rel="noopener noreferrer">Lampiran</a>
                                        </td>
                                        @else
                                        <td style="text-align: center;">
                                            Tidak Ada Lampiran
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
<script>
    $(function() {
        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                {extend: 'pdf'},
                {extend: 'excel'}],
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush