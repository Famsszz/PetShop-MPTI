@extends('layouts.mainadmin')
@section('container')

<div class="container" style="min-height: 100vh;">
    <h3>Tambah Data Kasir</h3>
    <div class="box" style="opacity: 0.9;">
        <form action="/tambahkasirkedatabase" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">

                <label for="nama">Nama Kasir:</label>
                <input type="text" name="nama" id="nama" class="input-control" placeholder="Nama Kasir" required>

                <label for="username">Username:</label>
                <input type="text" name="usname" id="usname" class="input-control" placeholder="Username" required>

                <label for="password">Kata Sandi:</label>
                <input type="text" name="password" id="password" class="input-control" placeholder="Kata Sandi"
                    required>

                <label for="harga">No Telp:</label>
                <input type="text" name="nohp" id="nohp" class="input-control" placeholder="No Telepon" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="input-control" placeholder="Email" required>

                <input type="submit" name="submit" value="Submit" class="btn">
            </div>
        </form>
    </div>
</div>
@endsection