@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fs-1 fw-bold mb-3">Dashboard</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Karyawan</a>
        <div>
            <a href="{{ route('employees.export-pdf') }}" class="btn btn-danger">Cetak PDF</a>
            <a href="{{ route('employees.export') }}" class="btn btn-success">Download Excel</a>
        </div>
    </div>
    

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Divisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->division->name }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus karyawan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection