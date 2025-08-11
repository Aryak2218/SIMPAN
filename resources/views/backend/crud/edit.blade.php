@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route ('index') }}">Back</a></li>
            <li class="breadcrumb-item active">Edit User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('user.update', ['id' => $data->id]) }}') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit User</h3>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">NIK</label>
                  <input type="text" name="NIK" class="form-control" id="exampleInputEmail1" placeholder="Masukkan NIK" value="{{ $data->NIK }}">
                  @error('NIK')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama" value="{{ $data->name }}">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="Masukkan Email" value="{{ $data->email }}">
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Kosongkan jika tidak diubah">
                  @error('password')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select name="role" class="form-control" id="role">
                    <option value="">-- Pilih Role --</option>
                    <option value="superadmin" {{ (old('role', $data->role) == 'superadmin') ? 'selected' : '' }}>Superadmin</option>
                    <option value="admin" {{ (old('role', $data->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ (old('role', $data->role) == 'user') ? 'selected' : '' }}>User</option>
                  </select>
                  @error('role')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection
