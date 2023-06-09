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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jadwal</li>
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
                        @role('admin')
                        <div class="card-header">
                            <a href="{{ route('schedule.create') }}" type="button" class="btn btn-primary btn-sm">Tambah
                                Data</a>
                        </div>
                        @endrole
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 7%">No</th>
                                        <th style="width: 25%">Nama Guru</th>
                                        <th style="width: 25%">Nama Kelas</th>
                                        <th style="width: 25%">Hari</th>
                                        <th class='notexport' style="width: 18%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->classEducation->title }}</td>
                                        <td>{{ $item->day }}</td>
                                        <td style="text-align: center;">
                                            @role('admin')
                                            <form action="{{ route('schedule.destroy', $item->id) }}" method="POST">
                                                @method('DELETE') @csrf
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @if ($item->day == $dayNow)
                                                    <a href="{{route('generate.qr', [$item->id, $item->user_id])}}"
                                                        class="btn btn-sm btn-outline-info">
                                                        QR
                                                    </a>
                                                    @endif
                                                    <a href="{{route('attendance.index', $item->id)}}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Kehadiran
                                                    </a>
                                                    <a href="{{ route('schedule.edit', $item->id)}}"
                                                        class="btn btn-sm btn-outline-secondary">
                                                        Edit
                                                    </a>
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>
                                            @endrole
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @role('teacher')
                                                @if ($item->day == $dayNow)
                                                <a href="{{ route('scan.qr')}}"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    Scan QR
                                                </a>
                                                @endif
                                                <a href="{{route('attendance.index', $item->id)}}"
                                                    class="btn btn-sm btn-outline-success">
                                                    Kehadiran
                                                </a>
                                            </div>
                                            @endrole
                                        </td>
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
                {
                extend: 'pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }},
                {
                extend: 'excel',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }}],
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush