@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fs-1 fw-bold mb-3">Edit Karyawan</h2>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', $employee->name) }}" 
                        required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email', $employee->email) }}" 
                        required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Telepon -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Telepon</label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        class="form-control @error('phone') is-invalid @enderror" 
                        value="{{ old('phone', $employee->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Divisi -->
                <div class="mb-3">
                    <label for="division_id" class="form-label">Divisi</label>
                    <select 
                        name="division_id" 
                        id="division_id" 
                        class="form-select @error('division_id') is-invalid @enderror" 
                        required>
                        <option value="" disabled>Pilih Divisi</option>
                        @foreach ($divisions as $division)
                            <option 
                                value="{{ $division->id }}" 
                                {{ old('division_id', $employee->division_id) == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
