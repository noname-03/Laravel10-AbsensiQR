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
                                        <th style="width: 25%">Nama Kelas</th>
                                        <th style="width: 25%">Status</th>
                                        <th style="width: 18%">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule->attendances as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->user->name }}</td>
                                        <td>{{ $schedule->classEducation->title }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td style="text-align: center;">
                                            {{$item->created_at->format('d-m-y')}}
                                            {{-- @role('admin')
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
                                            @role('teacher')
                                            @if ($item->day == $dayNow)
                                            <a href="{{ route('scan.qr')}}" class="btn btn-sm btn-outline-secondary">
                                                Scan QR
                                            </a>
                                            @else
                                            <p>Tidak Ada Jadwal</p>
                                            @endif
                                            @endrole --}}
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
                {extend: 'pdf'},
                {extend: 'excel'}],
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush