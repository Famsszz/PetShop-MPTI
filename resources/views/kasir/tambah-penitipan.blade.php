@extends('layouts.mainkasir')
@section('container')
<div class="container" style="min-height: 100vh;">
    <a href="/" style="margin-left:1280px; color:black"><i class="bi bi-arrow-left-square-fill"
            style="font-size:40px;"></i></a>
    <h2 style="margin-bottom: 20px;">Form Penitipan Hewan</h2>
    <form action="/penitipan-kasir" method="post" style="background-color: white; padding: 20px; opacity: 0.9;"
        enctype="multipart/form-data">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @csrf
        <table class="table mx-auto" style="background-color: white;">
            <tr>
                <td><label for="nama_hewan" class="form-label">Nama Peliharaan</label></td>
                <td><input type="text" name="Nama_Hewan" class="form-control" placeholder="jenis-hewan / nama-hewan">
                </td>
            </tr>
            <tr>
                <td><label for="tglmulai" class="form-label">Tanggal Mulai Penitipan</label></td>
                <td><input type="date" name="Tanggal" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="lamahari" class="form-label">Lama hari penitipan</label></td>
                <td><input type="number" name="Lama_Hari" placeholder="cth: 1" class="form-control" required min="1"></td>
            </tr>
            <tr>
                <td><label for="grooming" class="form-label">Layanan</label></td>
                <td>
                    <select class="form-select" id="layanan_grooming" name="Jenis_Layanan">
                        <option value="penitipan">Penitipan</option>
                        <option value="grooming">Grooming</option>
                        <option value="penitipan_dan_grooming">Penitipan dan Grooming</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gambar" class="form-label">Foto Hewan</label></td>
                <td><input type="file" name="gambar" id="gambar" class="form-control" required></td>
            </tr>
        </table>
        <div style="display: flex; justify-content: flex-end; width: 100%;">
            <input type="submit" class="btn" value="submit" style="margin-right: 10px;">
            <!-- <input type="hidden" name="ID_Transaksi" value="2"> -->
            <input type="hidden" name="ID_Pengguna" value="{{ Auth::user()->ID_Pengguna }}">
            <input type="hidden" name="Nama_Pengguna" value="{{ Auth::user()->Nama_Pengguna }}">
            <input type="hidden" name="Peran" value="{{ Auth::user()->Peran }}">
            <input type="hidden" name="Harga" value="0">
            <input type="hidden" name="status" value="Offline">
            <input type="reset" class="btn" value="Reset">
        </div>
    </form>
</div>
@endsection