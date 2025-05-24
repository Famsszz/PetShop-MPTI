@extends('layouts.mainadmin')
@section('container')
@if (session()->has('failed'))
<div class="alert alert-danger alert-dismissible fade show mt-3 mb-4" role="alert">
    {{ session('failed') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mt-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Edit Data Kasir</h3>
        <div class="box" style="opacity: 0.9;">
            <form action="{{ route('edit.kasirdb', ['idp' =>$kasir->ID_Pengguna]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="nama" class="input-control" placeholder="Nama Kasir"
                    value="{{ $kasir->Nama_Akun }}">
                <input type="text" name="usname" class="input-control" placeholder="Username"
                    value="{{ $kasir->Nama_Pengguna }}">
                <input type="text" name="nohp" class="input-control" placeholder="No Telepon"
                    value="{{ $kasir->No_Telp }}">
                <input type="email" name="email" id="email" class="input-control" placeholder="Email"
                    value="{{ $kasir->email }}">
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
        </div>
    </div>
</div>
@endsection