@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kategori Dokumen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profil Pengguna</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Profil Pengguna -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Profil Pengguna</h3>
        </div>
        <form class="form-horizontal">
          <div class="card-body">
            @php
              $user = Auth::user();
            @endphp

            <div class="form-group row">
              <label for="inputNIK" class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNIK" placeholder="NIK" value="{{ $user->NIK }}" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" value="{{ $user->name ?? '' }}" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $user->email ?? '' }}" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="********" value="********" readonly>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection
