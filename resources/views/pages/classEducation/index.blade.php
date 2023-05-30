@extends('layouts.app')
@section('title', 'Data Kelas')
@section('data.class', 'menu-open')
@section('class', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kelas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('classEducation.create') }}" type="button"
                                class="btn btn-primary btn-sm">Tambah
                                Data</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 7%">No</th>
                                        <th style="width: 25%">Nama Kelas</th>
                                        <th style="width: 18%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classEducations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('classEducation.destroy', $item->id) }}"
                                                method="POST">
                                                @method('DELETE') @csrf
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('classEducation.edit', $item->id)}}"
                                                        class="btn btn-sm btn-outline-secondary">
                                                        Edit
                                                    </a>
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>

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